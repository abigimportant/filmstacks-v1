<?php
/**
 * A Symfony model class for FsFilms.
 * 
 * @category   Model classes
 * @package    Filmstacks
 * @subpackage model
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.3.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 * @todo       Move $this->wikipediaApi to a application global object
 * @todo       Go through and fully comment/standardize code
 * @todo       Add a setting value for next_sync too self::setWikipediaContent()
 * @todo       Check image fetcher for irregularities
 */
class FsFilms extends BaseFsFilms
{
  /**
   * Words that can be associated with stacks
   * 
   * @var    string    $wikipediaContent
   * @link   http://wikipedia.org
   */
  protected $wikipediaContent;
  
  /**
   * Object for communications with Wikipedia API
   * 
   * @var    object    $wikipediaApi
   * @link   http://www.mediawiki.org/wiki/API
   */
  protected $wikipediaApi;

  /**
   * Fills object variables used by other methods
   *
   * @return void
   */
  public function __construct()
  {
	  $this->wikipediaApi = new sxWiki();
  }

  /**
   * Fetches the latest revision id of the article
   *
   * @return string
   */  	
 	public function fetchLatestRevisionId($wiki_title = null)
	{
	    if (!$wiki_title) {
	        $wiki_title = $this->getFilmWikipediaTitle();
	    }
		$api_call_parameters = array('action' => 'query', 'prop' => 'revisions', 'rvprop' => 'ids', 'titles' => $wiki_title, 'redirects' => 'true');
        $api_call_return     = $this->wikipediaApi->callAPI($api_call_parameters);

        // Extract revision id from prior API call data  
        foreach ($api_call_return['query']['pages'] as $key => $array) {
          return $array['revisions']['0']['revid'];
        }
	}

  /**
   * Fetches the poster filename from $this->wikipediaContent and gets its location
   *
   * @return string
   */  	
 	public function fetchFilmPoster()
	{
		preg_match('/\|.*?image.*?=(.*?)\n/ms', $this->wikipediaContent, $match);
		$match[1] = str_replace('|', '', $match[1]);
		if (!$match[1]) {
		    preg_match('/.*?image.*?=(.*?)\|\n/ms', $this->wikipediaContent, $match);
		}
		$filename = trim($match[1]);
		$api_call_parameters = array('action' => 'query', 'prop' => 'imageinfo', 'titles' => "File: {$filename}", 'iiprop'=>'url', 'redirects' => 'true');
		$api_call_return     = $this->wikipediaApi->callAPI($api_call_parameters);
		
		foreach($api_call_return['query']['pages'] as $key => $array) {
			return $array['imageinfo'][0]['url'];
		}
	}
	
	/**
   * Fetches the film summary from $this->wikipediaContent and formats it correctly
   *
   * @return string
   */
	public function fetchFilmSummary()
	{
	  $text_wiki_mediawiki = new Text_Wiki_Mediawiki();
		preg_match('/{{Infobox.*?}}.*?\'\'\'\'\'(.*?)==/ms', $this->wikipediaContent, $summary);
		//Add formating
    $summary = '\'\'\'\'\''.$summary[1];
    $summary = $text_wiki_mediawiki->transform($summary);
    //Strip links, references, language references and broken wiki formatting tags
    $summary = preg_replace('/<a.*?>.*?<\/a>/ms', '', $summary);
    $summary = preg_replace('/&lt;ref.*?&lt;\/ref&gt;/ms', '', $summary); 
    $summary = preg_replace('/{{IPA.*?}};\s+/ms', '', $summary);
    $summary = preg_replace('/{{.*?}}\s+/ms', '', $summary);
    $summary = preg_replace('/&lt;\!\-\-.*?\-\-&gt;/ms', '', $summary);
    $summary = preg_replace('/\({{.*?}}\)/ms', '', $summary);
    $summary = str_replace('[[', '', $summary);
    $summary = strip_tags(trim($summary));
    return $summary;
	}
	
	/**
   * Fetches the film title from $this->wikipediaContent and formats it correctly
   *
   * @return string
   */
	public function fetchFilmTitle()
	{
	  $text_wiki_mediawiki = new Text_Wiki_Mediawiki();
		preg_match('/{{Infobox.*?}}.*?\'\'\'\'\'(.*?)==/ms', $this->wikipediaContent, $summary_match);
		preg_match('/\'\'\'\'\'(.*?)\'\'\'\'\'/ms', $summary_match, $title_match);
    $title = strip_tags(trim($title_match[1]));
    return $title;
	}
	
	/**
  	 * Function formats wikipedia summary for output
  	 *
  	 * @param    string    $summary    Film summary
  	 * @return   string
  	 */
    public function formatWikipediaSummary($summary)
  	{
        $summary = str_ireplace("\n", "<br />", $summary);
        return $summary;
  	}
  	
	/**
	 * Generates the film path and returns
	 *
	 * @return   string
	 */
	public function getFilmPath()
  {
    return "/film/".$this->getFilmId();
  }
  
	/**
	 * Calculates and returns percentages of who would recommend the film
	 *
	 * @param    string    $type    positive or negative
	 * @return   bool
	 */
	public function getRecommendationTotals()
	{
    // Retrieve all stacks 
    $criteria    = new Criteria();
    $crit0       = $criteria->getNewCriterion(FsStacksPeer::FILM_ID, $this->getFilmId());
    $criteria->add($crit0);
    $results     = FsStacksPeer::doSelect($criteria);
    
    $stack_count = count($results);
    $positive_count = 0;
    $negative_count = 0;
    
    // Decide whether each stack is postive or negative
    foreach ($results as $stack) {
      if($stack->getStackRecommend() == 0) {
        $positive_count++;
      }
      else {
        $negative_count++;
      }
    }
    
    // Calculate percentages
    $positive_percentage = (100/$stack_count) * $positive_count;
    $positive_percentage = explode('.', $positive_percentage);
    $negative_percentage = (100/$stack_count) * $negative_count;
    $negative_percentage = explode('.', $negative_percentage);
    
    if (substr($positive_percentage[1], 0, 2) > 50) {
      $positive_percentage[0]++;
    } elseif ($positive_percentage[0] != 100 && substr($negative_percentage[1], 0, 2) > 50) {
      $negative_percentage[0]++;
    }
    
    // Set object variables of both percentages
    $this->positive_percentage = $positive_percentage[0];
    $this->negative_percentage = $negative_percentage[0];
    
    // Return that we were effective
    return true;
	}

	/**
	 * Calculates total times stacked globally and returns
	 *
	 * @return   integer
	 */
	public function getTotalStackCount()
  {
    $criteria = new Criteria();
    $criteria->add(FsStacksPeer::FILM_ID, $this->getFilmId(), Criteria::EQUAL);
    $count    = FsStacksPeer::doCount($criteria);
    
    return $count;
  }
  
    /**
    * Returns the film poster src
    *
    * @return   integer
    */
	public function getFilmPosterSrc()
  {
    if ($this->getFilmWikipediaPoster()) {
        return $this->getFilmWikipediaPoster();
    }
    else {
        return "/images/global/no_poster.jpg";
    }
  }
  /**
	 * Returns the year the film was released
	 *
	 * @return   integer
	 */
  public function getFilmReleaseYear()
  {
    if(!$this->getFilmRelease()){
        return false;
    }
    else {
      $film_release_parts = explode('-', $this->getFilmRelease());
    }
    return $film_release_parts[0];
  }

	/**
	 * Function returns a shortened version of the film summary
	 *
	 * @param    integer    $character_length    The amount of characters for it to be shortened too
	 * @param    bool       $formatting          Whether to format the return or not
	 */
	public function getFilmWikipediaSummaryCutdown($character_length, $formatting = false)
  {
    if(!$this->getFilmWikipediaSummary()){
        return false;
    }
    else if ($this->getFilmWikipediaSummary() == '\'') {
        return false;
    }
    else {
      if (strlen($this->getFilmWikipediaSummary()) <= $character_length) {
        $summary = $this->getFilmWikipediaSummary();
      }
      else {
        $summary = substr($this->getFilmWikipediaSummary(), 0, $character_length).'<strong>...</strong>';
      }
      
      // Switch in e accents
      $summary = str_replace('&Atilde;&copy;', 'é', $summary);
      if ($formatting == true) {
          return strip_tags($this->formatWikipediaSummary($summary));
      }
      else {
          return strip_tags($summary);
      }
    }
  }
  
 /**
   * Builds and returns a HTML word cloud of tag words associated to the film
   *
   * @return string
   */	
	public function getWordCloud()
	{
	  // Generate a fresh cloud object
    $cloud = new HTML_TagCloud();
    
    // Fetch all words
    $criteria   = new Criteria();
    $words_list = FsStacksWordsPeer::doSelect($criteria);
    
    // Fetch relative stacks
    $criteria = new Criteria();
    $crit0 = $criteria->getNewCriterion(FsStacksPeer::WORD_ID, null, Criteria::ISNOTNULL);
    $crit1 = $criteria->getNewCriterion(FsStacksPeer::FILM_ID, $this->getFilmId());
    $crit0->addAnd($crit1);
    $criteria->add($crit0);
    $stacks = FsStacksPeer::doSelect($criteria);
    
    // Words array container
    $words = array();
    
    // Add each word and it's ID too $words
    foreach($stacks as $stack) {
      if(!$words[$stack->getWordId()]['id'] == $stack->getWordId()) {
        $words[$stack->getWordId()]['id'] = $stack->getWordId();
        $words[$stack->getWordId()]['count'] = 1;
      } else {
        $words[$stack->getWordId()]['count']++;
      }
    }
    
    // Foreach returned word count find it's matching word
    foreach($words_list as $word) {
      if (array_key_exists($word->getWordId(), $words)) {
        $cloud->addElement($word->getWordWord(), '#', $words[$word->getWordId()]['count']);
      } 
    }
    
    // return HTML and CSS
    return $cloud->buildHTML();     
	}
	
  /**
   * Calculates current sync state and syncs dependent on if needed
   *
   * @return   void
   */
  public function syncFilm()
  {
    $last_sync = new Date($this->getUpdatedAt());
    $next_sync = new Date($this->getNextSync());
    $curr_date = new Date();
    $date_span = new Date_Span();
    
    // Calculate difference between last sync and next sync
    $date_span->setFromDateDiff($curr_date, $next_sync);
    
    // We need to sync due to the next sync date being passed
    if ($date_span->toSeconds() < 0) {
      // Fetch latest Revision id
      $latest_rev = $this->fetchLatestRevisionId();
      
      // Doesn't match our current revision - update film data
      if ($this->getFilmWikipediaRevision() != $latest_rev) {
        $this->setWikipediaContent($latest_rev);
      }
    }
	}
	
	/**
	 * Function sets wikipedia content for film
	 *
	 * @param    integer    $latest_rev    latest revision of article in Wikipedia
	 */
    public function setWikipediaContent($latest_rev = null, $wiki_title = null, $initial_import_params = null)
	{
	    if (!$wiki_title) {
	        $this->wikipediaContent = $this->wikipediaApi->getPage($this->getFilmWikipediaTitle());
	    }
	    else {
	        $this->wikipediaContent = $this->wikipediaApi->getPage($wiki_title);
	    }
		if ($initial_import_params != null) {
		    $this->setFilmTitle($initial_import_params['film_title']);
		    $this->setFilmWikipediaTitle($wiki_title);
		    $this->setFilmRelease($initial_import_params['film_release']);
		}
		// Set film poster location
		$this->setFilmWikipediaPoster($this->fetchFilmPoster($this->wikipediaApi));
		// Set film wikipedia summary
		$this->setFilmWikipediaSummary($this->fetchFilmSummary($this->wikipediaApi));
		
		// Set film wikipedia revision
		$this->setFilmWikipediaRevision($this->fetchLatestRevisionId($wiki_title));
		
		// Set next sync
		$now = new Date();
	    $now->addDays(30);
	    
	    $this->setNextSync($now->getDate());
	    
		// Save all of the previous to the database
		$this->save();
	}
}