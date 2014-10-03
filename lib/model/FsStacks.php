<?php
/**
 * A Symfony model class for FsStacks.
 * 
 * @category   Model classes
 * @package    Filmstacks
 * @subpackage model
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.3.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class FsStacks extends BaseFsStacks
{
    /**
     * Object of word related to stack
     * 
     * @var    object $wordObject
     * @see    FsStacksWords::__construct()
     */
    public $wordObject;
     
    /**
     * Object of film related to stack
     * 
     * @var    object $filmObject
     * @see    FsFilms::__construct()
     */
    public $filmObject;
      
    /**
     * Object of user related to stack
     * 
     * @var    object $userObject
     * @see    sfGuardUser::__construct()
     */
    public $userObject;
       
    /**
     * Object of group (if exists) related to stack
     * 
     * @var    object $groupObject
     * @see    FsStacksGroups::__construct()
     */
    public $groupObject;
  
    /**
     * Array of group members (if group exists)
     * 
     * @var    array $groupMembers
     */
    public $groupMembers = array();
   
    /**
     * Array of comment objects related to stack (if exist)
     * 
     * @var    array $commentObjects
     * @see    FsStacksComments::__construct()
     */
    public $commentObjects;
    
    /**
     * Fetches the relative film object of the stack
     *
     * @return void
     */
    public function fetchFilmObject()
    {
      $film_criteria = new Criteria();
      $film_criteria->add(FsFilmsPeer::FILM_ID, $this->getFilmId(), Criteria::EQUAL);
      $this->filmObject = FsFilmsPeer::doSelectOne($film_criteria);
    }
    
    /**
     * Fetches the relative user object of the stack
     *
     * @return void
     */
     public function fetchUserObject()
     {
       $user_criteria = new Criteria();
       $user_criteria->add(sfGuardUserPeer::ID, $this->getUserId(), Criteria::EQUAL);
       $this->userObject = sfGuardUserPeer::doSelectOne($user_criteria);
     }
     
     /**
      * Fetches the relative word object of the stack
      *
      * @return void
      */
     public function fetchWordObject()
     {
       $word_criteria = new Criteria();
       $word_criteria->add(FsStacksWordsPeer::WORD_ID, $this->getWordId(), Criteria::EQUAL);
       $this->wordObject = FsStacksWordsPeer::doSelectOne($word_criteria);
     }
     
     /**
      * Fetches the relative group object of the stack
      *
      * @return void
      */
     public function fetchGroupObject()
     {
       if ($this->getGroupId() != 0) {
         $group_criteria = new Criteria();
         $group_criteria->add(FsStacksGroupsPeer::GROUP_ID, $this->getGroupId(), Criteria::EQUAL);
         $this->groupObject = FsStacksGroupsPeer::doSelectOne($group_criteria);
       }
     }
     
     /**
      * Fetches the members of the group relative to the stack (if said group exists)
      *
      * @param  object $user
      * @return void
      */
     public function fetchGroupMembers($user = null)
     {
       if (!$user) {
         $user = $this->userObject;
       }
       if ($this->getGroupId() != 0) {
         $group_member_ids = explode('||', $this->groupObject->getGroupUserIds());
         foreach ($group_member_ids as $group_member_id) {
           if ($group_member_id != $user->getId()) {
             $this->groupMembers[] = sfGuardUserPeer::retrieveByPk($group_member_id);
           }
         }
       }
     }
     
     /**
      * Fetches the relative comment objects of the stack
      *
      * @return void
      */
     public function fetchCommentObjects()
     {
       $comments_criteria = new Criteria();
       $comments_criteria->add(FsStacksCommentsPeer::STACK_ID, $this->getStackId(), Criteria::EQUAL);
       $comments_criteria->addDescendingOrderByColumn(FsStacksCommentsPeer::CREATED_AT);
       $this->commentObjects = FsStacksCommentsPeer::doSelect($comments_criteria);
     }
     
     /**
      * Gets the amount of comments the stack has
      *
      * @return integer
      */
      public function getCommentCount()
      {
        if (!$this->commentObjects) {
          $comments_criteria = new Criteria();
          $comments_criteria->add(FsStacksCommentsPeer::STACK_ID, $this->getStackId(), Criteria::EQUAL);
          return FsStacksCommentsPeer::doCount($comments_criteria);
        } else {
          return count($this->commentObjects);
        }
      }
      
      /**
       * Gets the amount of time since the stack was made in words
       *
       * @return integer
       */
      public function getTimeSince()
      {
        $stacked_date = new Date($this->getCreatedAt());
        $current_date = new Date();

        $span = new Date_Span();
        $span->setFromDateDiff($stacked_date, $current_date);
        if ($span->toDays() >= 7) {
          $span_parts = explode('.', $span->toDays());
          $span_parts[0] = $span_parts[0]/7;
          if ($span_parts[0] == 1) {
            return $span_parts[0].' week';
          }
          else {
            return $span_parts[0].' weeks';
          }
        }
        else if ($span->toDays() >= 1) {
          $span_parts = explode('.', $span->toDays());
          if ($span_parts[0] == 1) {
            return $span_parts[0].' day';
          }
          else {
            return $span_parts[0].' days';
          }
        }
        else if ($span->toHours() >= 1) {
          $span_parts = explode('.', $span->toHours());
          if ($span_parts[0] == 1) {
            return $span_parts[0].' hour';
          }
          else {
            return $span_parts[0].' hours';
          }
        }
        else if ($span->toMinutes() >= 1) {
          $span_parts = explode('.', $span->toMinutes());
          if ($span_parts[0] == 1) {
            return $span_parts[0].' minute';
          }
          else {
            return $span_parts[0].' minutes';
          }
        }
        else if ($span->toSeconds() >= 1) {
          $span_parts = explode('.', $span->toSeconds());
          if ($span_parts[0] == 1) {
            return $span_parts[0].' second';
          }
          else {
            return $span_parts[0].' seconds';
          }
        }
      }
}
