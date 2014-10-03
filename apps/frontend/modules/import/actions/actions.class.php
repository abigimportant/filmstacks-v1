<?php
/**
 * A Symfony actions class for managing user module actions.
 * 
 * @category   Actions classes
 * @package    Filmstacks
 * @subpackage user
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.5.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class importActions extends sfActions
{
    /**
     * Executes index action
     * Index is the main profile feed for a user
     *
     * @param sfRequest $request A request object
     * @return void
     */
     public function executeIndex(sfWebRequest $request)
     {
         //Run through films 1915 to 2010
         for($year = 1993; $year <= 1993; $year++)
         {
            // SxWiki()
            $wiki  = new sxWiki();
         	//Get films listed in category with regards to $year
         	$films = $wiki->getCat($year.'_films');
         	//Foreach film in $films submit all data to filmstacks DB
         	foreach($films as $key => $wiki_title) 
         	{
         	    // Check it's not another category/list
         	    preg_match('/Category:.*?/ms', $wiki_title, $film_check_category);
         	    preg_match('/List of.*?/ms', $wiki_title, $film_check_list);
         	    preg_match('/films of.*?/ms', $wiki_title, $film_check_year);
         	    if($film_check_category[0] == 'Category:' || $film_check_list[0] == "List of" || $film_check_year[0] == "films of") {
         	    }
         	    else {
         	        // Make Film title
         	        preg_match('/.*?\((.*?)\)/ms', $wiki_title, $brackets_content);
         	        $film_title = str_replace($brackets_content[1], '', $wiki_title);
         	        $film_title = str_replace(' (', '', $film_title);
         	        $film_title = str_replace(')', '', $film_title);
             		//New Film array for components
             		$new_film = array(
             			'film_title' => $film_title,
             			'film_release'  => $year.'-01-01',
             		    'wiki_title' => str_replace(' ', '_', $wiki_title)
             		);
             		
             		$film = new FsFilms();
             		$film->setWikipediaContent(null, $new_film['wiki_title'], $new_film);
         	    }
         	}
         }
     }
}