<?php
/**
 * Film module actions.
 *
 * @package    filmstacks
 * @subpackage film
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @version    
 * @copyright  2008-2009 Filmstacks
 */
class filmActions extends sfActions
{
 /**
  * Executes index action
  * The index action is the primary page for films
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	  // Select the correct DB record based on parameters
    $criteria = new Criteria();
    $criteria->add(FsFilmsPeer::FILM_ID, $request->getParameter('film_identifiers'), Criteria::EQUAL);
    $this->film = FsFilmsPeer::doSelectOne($criteria);

    // Sync Film
    $this->film->syncFilm();
    // Forward to 404 if film does not exist
    $this->forward404If(!$this->film);

    // Get the most recent four stacks of the film
    $recent_criteria = new Criteria();
    // Add the need for film_id to match
    $recent_criteria->add(FsStacksPeer::FILM_ID, $this->film->getFilmId(), Criteria::EQUAL);
    $recent_criteria->setLimit('4');
    $recent_criteria->addDescendingOrderByColumn(FsStacksPeer::CREATED_AT);
    $stacks = FsStacksPeer::doSelect($recent_criteria);
    $this->stacks = array();
    foreach ($stacks as $stack) {
      // Fetch the user related object
      $stack->fetchUserObject();
      // Fetch the word related object
      $stack->fetchWordObject();
      $this->stacks[] = $stack;
    }

    // Get the most reviews three reviews of the film
    $reviews_criteria = new Criteria();
    // Add the need for film_id to match
    $reviews_criteria->add(FsFilmsReviewsPeer::FILM_ID, $this->film->getFilmId(), Criteria::EQUAL);
    $reviews_criteria->setLimit('3');
    $reviews_criteria->addDescendingOrderByColumn(FsFilmsReviewsPeer::CREATED_AT);
    $reviews = FsFilmsReviewsPeer::doSelect($reviews_criteria);
    $this->reviews = array();
    foreach ($reviews as $review) {
      // Fetch the user related object
      $review->fetchUserObject();
      $this->reviews[] = $review;
    }
  }
  
  /**
   * Get film variables from film URI
   */
   protected function generateFilmVariables($film_title_and_year)
   { 
     $film_title_and_year = explode('(', $film_title_and_year);
     $film_title = str_replace('_', ' ', $film_title_and_year[0]);
     $film_title = trim($film_title);
     $film_year = str_replace(')', '', $film_title_and_year[1]);
     $this->film_year = $film_year;
     $this->film_title = $film_title;
   }
}