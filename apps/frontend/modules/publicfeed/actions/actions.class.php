<?php
/**
 * publicfeed actions.
 * The public feed displays all stacks from all users.
 * @package    filmstacks
 * @subpackage publicfeed
 * @author     Nicholas Pellant <contact@nickpellant.com>
 */
class publicfeedActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // Retrieve all stacks
    $criteria = new Criteria();
    // Make sure we're only getting the most recent stacks
    $criteria->addDescendingOrderByColumn(FsStacksPeer::CREATED_AT);
    
    // Activate pager to manage pagination
    $stacks_pager = new sfPropelPager('FsStacks', 20);
    // Set criteria for pager to previous $criteria object
    $stacks_pager->setCriteria($criteria);
    $stacks_pager->setPage($this->getRequestParameter('page', 1));
    $stacks_pager->init();
    $this->current_page = $this->getRequestParameter('page', 1);
    $this->stacks_pager = $stacks_pager;
    
    // Create a new variable to store the stacks
    $this->stacks = array();
    // Foreach result that the pager has produced let's use process it
    foreach ($stacks_pager->getResults() as $stack) {
      // Fetch the film related object
      $stack->fetchFilmObject();
      // Fetch the word related object
      $stack->fetchWordObject();
      // Fetch the group related object (if exists)
      $stack->fetchGroupObject();
      // Fetch the user object
      $stack->fetchUserObject();
      // Fetch the group members (if exists)
      $stack->fetchGroupMembers($this->profile_user);

      // Check whether we're synced with Wikipedia - if not then perform a API call
      $stack->filmObject->syncFilm();

      $this->stacks[] = $stack;
      $stacks_counter++;
    }
  }
}
