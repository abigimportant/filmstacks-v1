<?php
/**
 * A Symfony actions class for managing the actions of the update module.
 * 
 * @category   Action classes
 * @package    Filmstacks
 * @subpackage update
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.4.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class updateActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param  sfRequest $request A request object
  * @see    FsStacksForm::__construct()
  */
  public function executeIndex(sfWebRequest $request)
  {
    // Default state that there are no films
    $this->returned_films = false;
    $this->stage = 1;
    // Unless method is post they haven't started searching
    if ($request->isMethod('post')) {
      // Submission stage
      if($request->getParameter('stacking_form_film_id')) {
          //Array of parameters from form
          $params = array (
            'word_id'         => $request->getParameter('stacking_form[film_words]'),
            'stack_recommend' => $request->getParameter('stacking_form[film_recommend]'),
            );
            
          // Count the amount of times the film has previously been stacked using Criteria()
           $criteria = new Criteria();
           $criteria->add(FsStacksPeer::FILM_ID, $request->getParameter('stacking_form_film_id'), Criteria::EQUAL);
           $criteria->add(FsStacksPeer::USER_ID, $this->getUser()->getProfile()->getUserId(), Criteria::EQUAL);
           $count = FsStacksPeer::doCount($criteria);
           // Add one too the value of $count
           $count++;

           // We've matched the film and done the logic - we now need too stack the film
           $new_stack = new FsStacks();
           $new_stack->setFilmId($request->getParameter('stacking_form_film_id'));
           $new_stack->setUserId($this->getUser()->getGuardUser()->getId());
       	   $new_stack->setWordId($params['word_id']);
       	   $new_stack->setStackSeenCount($count);
       	   $new_stack->setStackRecommend($request->getParameter('stacking_form[film_recommend]'));
       	   $new_stack->save();
       	   
       	   $this->redirect('user_home');
      }
      // Stacking stage
      if($request->getParameter('selection_form[film_id]')) {
          // Set stage
          $this->stage = 3;
          
          // Generate the stacking form
          $this->form  = new FsStacksStackingForm();
          
          // Pull the film information for the selected title
          $this->film  = FsFilmsPeer::retrieveByPk($request->getParameter('selection_form[film_id]'));
      }
      // Selection stage
      else if ($request->getParameter('search_form[film_title]')) {
          // Set stage
          $this->stage = 2;
          
          //Array of parameters
          $params = array (
            'film_title' => strtolower(trim($request->getParameter('search_form[film_title]'))),
            'film_word'  => $request->getParameter('search_form[stack_words]'),
          );

          // Attempt to find film
          $criteria = new Criteria();
          $criteria->add(FsFilmsPeer::FILM_TITLE, $params['film_title'], Criteria::EQUAL);
          $this->returned_films = FsFilmsPeer::doSelect($criteria);

          // There is more than one film with that title
          if (count($this->returned_films) > 1) {

          } 
          // There was one film returned
          else if (count($this->returned_films) == 1) {

          }
          // There are no films to match title - try again with a more open search
          else {
            $criteria = new Criteria();
            $criteria->add(FsFilmsPeer::FILM_TITLE, '%'.$params['film_title'].'%', Criteria::LIKE);
            $this->returned_films = FsFilmsPeer::doSelect($criteria);

            // More than one match
            if (count($this->returned_films) > 1) {

            }
            else if (count($this->returned_films) == 1) {

            }
            else {
              $this->returned_films = false;
            }
          }
          return sfView::SUCCESS;
      }
      // Search stage
      else {
          // Set stage
          $this->stage = 1;
          // Generate a fresh stack form object
          $this->form  = new FsStacksSearchForm();
      }
    }
    else {
        $this->form = new FsStacksSearchForm();
    }
  }
}
