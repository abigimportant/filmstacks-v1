<?php
/**
 * A Symfony model class for sfGuardUserProfile.
 * 
 * @category   Model classes
 * @package    Filmstacks
 * @subpackage model
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.3.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 * @todo       Build getAge() function
 */
class sfGuardUserProfile extends BasesfGuardUserProfile
{    
    /**
     * Object of relationship between user logged in and this user
     * 
     * @var    object $relationshipObject
     */
    public $relationshipObject;
    
    /**
     * Fetches the age of the user
     *
     * @return integer
     */
    public function getAge()
    {
    }

    /**
     * Checks whether the logged in user follows this user
     *
     * @return bool
     */
    public function getRelationshipObject($logged_in_user)
    {
        // Check whether there is a relationship already there
        $criteria = new Criteria();
        $crit     = array();
        
        $crit[0]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::FIRST_USER_ID, $logged_in_user->getProfile()->getUserId());
        $crit[1]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::SECOND_USER_ID, $this->getUserId());
        
        $crit[0]->addAnd($crit[1]);
        
        $crit[2]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::FIRST_USER_ID, $this->getUserId());
        $crit[3]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::SECOND_USER_ID, $logged_in_user->getProfile()->getUserId());
        
        $crit[2]->addAnd($crit[3]);
        
        $crit[0]->addOr($crit[2]);
        
        $criteria->add($crit[0]);
        
        $this->relationshipObject = FsUserRelationshipsPeer::doSelectOne($criteria);
    }
    
    /**
     * Gets the total amount of friends the user has
     *
     * @return integer
     */
    public function getFriendTotal()
    {
        // Fetch friends from database via Criteria()
         $criteria = new Criteria();
         $crit     = array();
         $crit[0]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::FIRST_USER_ID, $this->getUserId());
         $crit[1]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::SECOND_USER_ID, $this->getUserId());
         $crit[2]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::RELATIONSHIP_STATUS, '3');
         // Make $crit[0] and $crit[1] as or statements
         $crit[0]->addOr($crit[1]);
         $crit[0]->addAnd($crit[2]);
         // Add new criterion to Criteria()
         $criteria->add($crit[0]);

         // Return count of rows returned
         return FsUserRelationshipsPeer::doCount($criteria);
    }
    
    /**
     * Gets the total amount of stacks the user has made
     *
     * @return integer
     */
    public function getStackCount()
    {
        $count_criteria = new Criteria();
        $count_criteria->add(FsStacksPeer::USER_ID, $this->getId(), Criteria::EQUAL);
        $count_return = FsStacksPeer::doCount($count_criteria);
        return $count_return;
    }
    
    /**
     * Gets the amount of times the user has viewed the film
     *
     * @param  integer  $film_id
     * @param  bool     $use_words
     * @return mixed
     */
    public function getStackCountFilm($film_id, $use_words = false)
    {
        $count_criteria = new Criteria();
        $count_criteria->add(FsStacksPeer::FILM_ID, $film_id, Criteria::EQUAL);
        $count_criteria->add(FsStacksPeer::USER_ID, $this->getId(), Criteria::EQUAL);
        $count_return = FsStacksPeer::doCount($count_criteria);

        if ($count_return == 1 && $use_words == true) {
          return 'for the first time';
        }
        else if ($count_return > 1 && $use_words == true) {
          return $count_return.' times';
        }
        else {
          return $count_return;
        }
    }
    
    /**
     * Retrieves the users avatar SRC
     *
     * @param  integer  $dimensions
     * @return string
     */
    public function getUserAvatarSrc($dimensions)
    {
         if ($this->getUserAvatarFile()) {
            return $this->getUserAvatarFile();
          }
          else {
            $avatar_src = "http://www.gravatar.com/avatar.php?gravatar_id=";
            $avatar_src .= md5($this->getUserEmail());
            $avatar_src .= "&amp;size=".$dimensions;
            $avatar_src .= "&amp;default=identicon";
            return $avatar_src;
          }
    }
}
