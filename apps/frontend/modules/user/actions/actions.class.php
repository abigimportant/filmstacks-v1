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
class userActions extends sfActions
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
         // Select user information from database based on the supplied username
         $this->profile_user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
         // If user does not exist then forward to a 404
         $this->forward404If(!$this->profile_user);
         // Relationship if there is one
          $this->profile_user->getProfile()->getRelationshipObject($this->getUser());
          
         // Create new Criteria() object
         $stacks_criteria = new Criteria();
         // Add the need for user_id to match $profile_user->getId()
         $stacks_criteria->add(FsStacksPeer::USER_ID, $this->profile_user->getId(), Criteria::EQUAL);
         $stacks_criteria->addDescendingOrderByColumn(FsStacksPeer::STACK_ID);
     
         $stacks_pager = new sfPropelPager('FsStacks', 10);
         // Set criteria for pager to previous $stacks_criteria object
         $stacks_pager->setCriteria($stacks_criteria);
         $stacks_pager->setPage($this->getRequestParameter('page', 1));
         $stacks_pager->init();
         $this->current_page = $this->getRequestParameter('page', 1);
         $this->stacks_pager = $stacks_pager;
         // Check whether any stacks where returned for the feed
         if (count($this->stacks_pager) < 1) {
           // It appears we hit a wall and nothing came back - let's log the fault for analysis later
           $this->actions_errors['major'][] = array(
               'action' => 'Index',
               'error_cause' => 'Failed to retrieve user feed.',
               'user_id' => $this->profile_user->getId(),
             );
         }
         // We now have the feed items which means we can proceed
         else {
           /* We need to get the associated values for each feed item
            * This includes the word, group and film values
            * We will do this by excecuting some match queries */
           // Create a baseline for how many results we have
           $stacks_count = 0; 
           // Create a new array object to store our fresh information
           $this->stacks = array(
             "most_recent_stack" => '',
             "feed_stacks" => '',
             );
           // Foreach result that the pager has produced let's use process it
           foreach ($stacks_pager->getResults() as $stack) {
             // Fetch the film related object
             $stack->fetchFilmObject();
             // Fetch the word related object
             $stack->fetchWordObject();
             // Fetch the group related object (if exist)
             $stack->fetchGroupObject();
             // Fetch the group members (if exist)
             $stack->fetchGroupMembers($this->profile_user);

             // Check whether we're synced with Wikipedia - if not then perform a API call
             $stack->filmObject->syncFilm();

             // If it is the most recent stack we need to treat it properly
             if ($stacks_count == 0 && $this->current_page == 1) {
               $this->stacks["most_recent_stack"] = $stack;
               $stacks_count++;
             }
             // It's an oldie so we'll stick it with the other stacks
             else {
               $this->stacks["feed_stacks"][] = $stack;
               $stacks_count++;
             }
           }
         }
     }
     
     /**
      * Executes add action
      * Adds the user to the logged in users friend list
      *
      * @param sfRequest $request A request object
      * @return void
      */
      public function executeAddfriend(sfWebRequest $request)
      { 
          // Select user information from database based on the supplied username
          $this->profile_user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
          
          if ($this->profile_user->getId() == $this->getUser()->getProfile()->getUserId()) {
              $this->redirect('/user/'.$this->profile_user->getUsername());
          }
          
          // Relationship if there is one
          $this->profile_user->getProfile()->getRelationshipObject($this->getUser());
          
          // If a relationship already exists
          if ($this->profile_user->getProfile()->relationshipObject) {
              // If the user already follows the user in question ignore request and redirect back
              if (($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 1 && $this->profile_user->getProfile()->relationshipObject->getFirstUserId() == $this->getUser()->getProfile()->getUserId()) || ($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 3) || ($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 2 && $this->profile_user->getProfile()->relationshipObject->getSecondUserId() == $this->getUser()->getProfile()->getId())) {
                  $this->redirect('/user/'.$this->profile_user->getUsername());
              }
              else {
                  if ($this->profile_user->getProfile()->relationshipObject->getFirstUserId() == $this->getUser()->getProfile()->getUserId() && $this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() != 2) {
                      $this->profile_user->getProfile()->relationshipObject->setRelationshipStatus(1);
                  } else if ($this->profile_user->getProfile()->relationshipObject->getSecondUserId() == $this->getUser()->getProfile()->getUserId() && $this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() != 1) {
                      $this->profile_user->getProfile()->relationshipObject->setRelationshipStatus(2);
                  } else {
                      $this->profile_user->getProfile()->relationshipObject->setRelationshipStatus(3);
                  }
              }
              $this->profile_user->getProfile()->relationshipObject->save();
              $this->redirect('/user/'.$this->profile_user->getUsername());
          }
          // Create a new relationship for the user
          else {
              $relationship = new FsUserRelationships();
              $relationship->setFirstUserId($this->getUser()->getProfile()->getId());
              $relationship->setSecondUserId($this->profile_user->getId());
              $relationship->setRelationshipStatus(1);
              $relationship->save();
              $this->redirect('/user/'.$this->profile_user->getUsername());
          }
      }
       
    /**
    * Executes remove action
    * Removes the user from the logged in users friend list
    *
    * @param sfRequest $request A request object
    * @return void
    */
    public function executeRemovefriend(sfWebRequest $request)
    { 
        // Select user information from database based on the supplied username
        $this->profile_user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));

        if ($this->profile_user->getId() == $this->getUser()->getProfile()->getUserId()) {
            $this->redirect('/user/'.$this->profile_user->getUsername());
        }

        // Relationship if there is one
        $this->profile_user->getProfile()->getRelationshipObject($this->getUser());

        // If a relationship already exists
        if ($this->profile_user->getProfile()->relationshipObject) {
            // Check that the user does indeed follow the other
            if (($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 1 && $this->profile_user->getProfile()->relationshipObject->getFirstUserId() == $this->getUser()->getProfile()->getUserId()) || ($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 3) || ($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 2 && $this->profile_user->getProfile()->relationshipObject->getSecondUserId() == $this->getUser()->getProfile()->getId())) {
                
                // If it's only one way
                if($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() != 3) {
                    $this->profile_user->getProfile()->relationshipObject->setRelationshipStatus(0);
                    $this->profile_user->getProfile()->relationshipObject->save();
                }
                else if ($this->profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 3) {
                    if($this->profile_user->getProfile()->relationshipObject->getFirstUserId() == $this->getUser()->getProfile()->getUserId()) {
                        $this->profile_user->getProfile()->relationshipObject->setRelationshipStatus(2);
                        $this->profile_user->getProfile()->relationshipObject->save();
                    }
                    else {
                        $this->profile_user->getProfile()->relationshipObject->setRelationshipStatus(1);
                        $this->profile_user->getProfile()->relationshipObject->save();
                    }
                }
                $this->redirect('/user/'.$this->profile_user->getUsername());
            }
        }
        // Create a new relationship for the user
        else {
            $relationship = new FsUserRelationships();
            $relationship->setFirstUserId($this->getUser()->getProfile()->getId());
            $relationship->setSecondUserId($this->profile_user->getId());
            $relationship->setRelationshipStatus(1);
            $relationship->save();
            $this->redirect('/user/'.$this->profile_user->getUsername());
        }
    }
           
     /**
      * Executes friends action
      * Friends lists the various friends of the user
      *
      * @param sfRequest $request A request object
      * @return void
      */
      public function executeFriends(sfWebRequest $request)
      {
        // Select user information from database based on the supplied username
        $this->profile_user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
        // If user does not exist then forward to a 404
        $this->forward404If(!$this->profile_user);

        // Fetch friends from database via Criteria()
        $criteria = new Criteria();
        $crit     = array();
        $crit[0]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::FIRST_USER_ID, $this->getUser()->getProfile()->getUserId());
        $crit[1]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::SECOND_USER_ID, $this->getUser()->getProfile()->getUserId());

        // Make $crit[0] and $crit[1] as or statements
        $crit[0]->addOr($crit[1]);
        // Add new criterion to Criteria()
        $criteria->add($crit[0]);

        // Array containing all friends returned from Criteria()
        $relationships = FsUserRelationshipsPeer::doSelect($criteria);

        $friends = array();
        foreach ($relationships as $relationship) {
          if ($relationship->getFirstUserId() != $this->profile_user->getProfile()->getUserId()) {
            $friends[] = sfGuardUserPeer::retrieveByPk($relationship->getFirstUserId());
          }
          else {
            $friends[] = sfGuardUserPeer::retrieveByPk($relationship->getSecondUserId());
          }
        }
        $this->friends = $friends;
      }
}