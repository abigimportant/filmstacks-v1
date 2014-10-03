<?php
/**
 * A Symfony actions class for managing home module actions.
 * 
 * @category   Actions classes
 * @package    Filmstacks
 * @subpackage home
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.4.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class homeActions extends sfActions
{
    /**
     * Executes betaindex action
     * Betaindex is the front splash page while the site is under beta
     *
     * @param sfRequest $request A request object
     * @return void
     */
    public function executeBetaindex(sfWebRequest $request)
    {
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect("user_home");
        }
        $this->signup_form = new sfGuardUserRegistrationForm();
        
        // Unless method is post we're not saving anything
        if ($request->isMethod('post')) {
            $this->signup_form = new sfGuardUserRegistrationForm();
            $this->signup_form->bind($request->getParameter('signup_form'));
            if ($this->signup_form->isValid())
            {
                //Array of parameters
                $params = array (
                  'signup_code'   => trim($request->getParameter('signup_form[signup_code]')),
                  'signup_uname'  => trim($request->getParameter('signup_form[signup_uname]')),
                  'signup_email'  => trim($request->getParameter('signup_form[signup_email]')),
                );

                // Find potential film matches
                $criteria   = new Criteria();
                $criteria->add(FsBetaInvitationsPeer::INVITE_CODE, $params['signup_code'], Criteria::EQUAL);
                $invitation = FsBetaInvitationsPeer::doSelectOne($criteria);

                // Check whether invite exists
                if (count($invitation) == 0) {
                }
                // Check whether there are any invites left
                elseif ($invitation->getInviteAllowance() <= $invitation->getInviteUsed()) {
                }
                // Both the invitation code exists and has slots open - process the registration
                else {
                  // Generate fresh user objects
                  $user         = new sfGuardUser();
                  $user_profile = new sfGuardUserProfile();

                  // Generate password for account
                  $password = Text_Password::create();

                  // Set variables for the user account
                  $user->setUsername($params['signup_uname']);
                  $user->setPassword($password);

                  // Save variables for the database
                  $user->save();

                  // Set user profile variables
                  $user_profile->setUserId($user->getId());
                  $user_profile->setUserEmail($params['signup_email']);
                  $user_profile->save();

                  // Email class initialization
                  $mailer    = new Swift(new Swift_Connection_NativeMail());

                  $mail_body = "{$params['signup_uname']}, <br />
        Welcome to Filmstacks! It's great to have you with us participating in our beta. Please find below your login details - you may modify these after your first login:<br />
        <br />
            Username: {$params['signup_uname']}<br />
            Password: {$password}<br />
        <br />
        Enjoy!<br />
        -- <br />
        The Filmstacks Team<br />
        http://filmstacks.tv";

                  $message   = new Swift_Message('Welcome to Filmstacks!', $mail_body, 'text/html');
                  $mailer->send($message, $params['signup_email'], 'no-reply@filmstacks.tv');
                  $mailer->disconnect();

                  $invites_used = $invitation->getInviteUsed();
                  $invites_used++;
                  $invitation->setInviteUsed($invites_used);
                  $invitation->save();
                  // Return a success
                } 
            }
            else {
            }
        }
    }
    
    /**
     * Executes betaregistrationsubmit action
     * Betaregistrationsubmit is the registration processing of a user
     *
     * @param sfRequest $request A request object
     * @return void
     */
    public function executeBetaregistrationsubmit(sfWebRequest $request)
    {
        if ($request->isMethod('post') == false) {
            $this->forward404();
        }

    }
    
    public function handleErrorBetaregistrationsubmit() {
      $this->forward('home', 'betaindex');
    }
    
    /**
     * Executes homefeed action
     * Homefeed is the homepage for a logged in user and displays his and his friends stacks
     *
     * @param sfRequest $request A request object
     * @return void
     */
    public function executeHomefeed(sfWebRequest $request)
    {
        // Fetch friends from database via Criteria()
        $criteria = new Criteria();
        $crit     = array();
        $crit[0]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::FIRST_USER_ID, $this->getUser()->getProfile()->getUserId());
        $crit[1]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::RELATIONSHIP_STATUS, '1');
        $crit[2]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::RELATIONSHIP_STATUS, '3');
        
        $crit[1]->addOr($crit[2]);

        $crit[0]->addAnd($crit[1]);
        $crit[3]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::SECOND_USER_ID, $this->getUser()->getProfile()->getUserId());
        $crit[4]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::RELATIONSHIP_STATUS, '2');
        $crit[5]  = $criteria->getNewCriterion(FsUserRelationshipsPeer::RELATIONSHIP_STATUS, '3');
        
        $crit[4]->addOr($crit[5]);
        
        $crit[3]->addAnd($crit[4]);
        
        $crit[0]->addOr($crit[3]);
        
        // Add new criterion to Criteria()
        $criteria->add($crit[0]);
        // Array containing all friends returned from Criteria()
        $results  = FsUserRelationshipsPeer::doSelect($criteria);
        
        // Retrieve the most recent stacks of the friends via Criteria()
        $criteria = new Criteria();
        $crit     = array();
        
        // Foreach friend returned
        foreach ($results as $friend) {
            // Check whether the ID we want is from first_user_id or second_user_id
            if ($friend->getFirstUserId() != $this->getUser()->getProfile()->getUserId()) {
                $crit[] = $criteria->getNewCriterion(FsStacksPeer::USER_ID, $friend->getFirstUserId());
            }
            else {
                $crit[] = $criteria->getNewCriterion(FsStacksPeer::USER_ID, $friend->getSecondUserId());
            }
        }

        // Create a counter to monitor the amount crits being added
        $crit_counter = 0;
        // Add the logged in user to the crit[]
        $crit[]       = $criteria->getNewCriterion(FsStacksPeer::USER_ID, $this->getUser()->getProfile()->getUserId());

        // If there is more than a single criteria to be run
        if (count($crit) > 1) {
            //Foreach crit...
            foreach ($crit as $s_crit) {
                // Check whether it is our first
                if ($crit_count == 0) {
                    $crit0 = $s_crit;
                }
                else {
                    $crit0->addOr($s_crit);
                }
                // Add one to our counter
                $crit_count++;
            }
            // Add all of the above to our Criteria()
            $criteria->add($crit0);
        }
        // There is one one criteria
        else {
            // Add our crit to Criteria()
            $criteria->add($crit[0]);
        }

        // Make sure we're only getting the most recent stacks
        $criteria->addDescendingOrderByColumn(FsStacksPeer::CREATED_AT);

        // If not $amount is set make $amount 20 as per default
        if (!$amount) {
            $amount = 20;
        }

        // Activate pager to manage pagination
        $stacks_pager = new sfPropelPager('FsStacks', $amount);
        // Set criteria for pager to previous $criteria object
        $stacks_pager->setCriteria($criteria);
        $stacks_pager->setPage($this->getRequestParameter('page', 1));
        $stacks_pager->init();
        $this->current_page = $this->getRequestParameter('page', 1);
        $this->stacks_pager = $stacks_pager;

        /* We need to get the associated values for each feed item
         * This includes the word, group and film values
         * We will do this by excecuting some match queries */
        // Create a baseline for how many results we have
        $stacks_counter = 0; 
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
    
  public function executeIndexsubmit(sfWebRequest $request)
  {
    // Unless method is post we're not saving anything
    if ($request->isMethod('post')) {
      //Array of parameters
      $params = array (
        'signup_code'   => trim($request->getParameter('signup_form[signup_code]')),
        'signup_uname'  => trim($request->getParameter('signup_form[signup_uname]')),
        'signup_email'  => trim($request->getParameter('signup_form[signup_email]')),
      );

      // Find potential film matches
      $criteria   = new Criteria();
      $criteria->add(FsBetaInvitationsPeer::INVITE_CODE, $params['signup_code'], Criteria::EQUAL);
      $invitation = FsBetaInvitationsPeer::doSelectOne($criteria);

      // Check whether invite exists
      if (!$invitation) {
        return sfView::FAILURE;
      }
      // Check whether there are any invites left
      elseif ($invitation->getInviteAllowance() <= $invitation->getInviteUsed()) {
        return sfView::FAILURE;  
      }
      // Both the invitation code exists and has slots open - process the registration
      else {
        // Generate fresh user objects
        $user         = new sfGuardUser();
        $user_profile = new sfGuardUserProfile();

        // Generate password for account
        $password = Text_Password::create();

        // Set variables for the user account
        $user->setUsername($params['signup_uname']);
        $user->setPassword($password);

        // Save variables for the database
        $user->save();

        // Set user profile variables
        $user_profile->setUserId($user->getId());
        $user_profile->setUserEmail($params['signup_email']);
        $user_profile->save();

        // Email class initialization
        $mail = new sfMail();
        $mail->initialize();
        $mail->setMailer('sendmail');
        $mail->setCharset('utf-8');

        // Set required parameters
        $mail->setSender('no-reply@filmstacks.tv', 'Filmstacks (No Reply)');
        $mail->setFrom('no-reply@filmstacks.tv', 'Filmstacks');
        $mail->addAddress($params['signup_email']);

        $mail->setSubject('Welcome to Filmstacks!');
        $mail->setBody("
  {$params['signup_uname']},
  Welcome to Filmstacks! It's great to have you with us participating in our beta. Please find below your login details - you may modify these after your first login:

  Username: {$params['signup_uname']}
  Password: {$password}

  Enjoy!
  - The Filmstacks Team
  http://filmstacks.tv");

        $mail->send();

        $invites_used = $invitation->getInviteUsed();
        $invites_used++;
        $invitation->setInviteUsed($invites_used);
        $invitation->save();
        // Return a success
        return $this->redirect('homepage');
      }
    }
  }
  
  public function handleErrorIndexsubmit() {
    $this->forward('beta_home', 'index');
  }
}
