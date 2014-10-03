<?php
/**
 * A Symfony actions class for managing the actions of the Account module.
 * 
 * @category   Actions classes
 * @package    Filmstacks
 * @subpackage account
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.1.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class accountActions extends sfActions
{
  /**
   * Executes settings action
   * Settings action allows the user to make modifications to their account details
   *
   * @param sfRequest $request A request object
   * @return void
   */
  public function executeSettings(sfWebRequest $request)
  {
	  // Set form
	  $user = sfGuardUserPeer::retrieveByUsername($this->getUser()->getUsername());
	  $this->settings_form = new AccountSettingsForm($user);
	  $this->settings_form_protected = new AccountSettingsProtectedForm($user);
	  $this->settings_form_photo = new AccountSettingsPhotoForm($user);
	  
	  //Custom error holder
	  $this->custom_errors = array(
	    'protected_errors' => array(),
	    'normal_errors' => array(),
	    'photo_errors' => array()
	  );
	  
	  // Unless method is post we're not saving anything
      if ($request->isMethod('post')) {
          // Profile settings
          if ($request->getParameter('settings_form')) {
              // Bind form
                $this->settings_form->bind($request->getParameter('settings_form'));
                if ($this->settings_form->isValid())
                {
                    //Array of parameters
                    $params = array (
                      'settings_fname'   => trim($request->getParameter('settings_form[settings_fname]')),
                      'settings_lname'  => trim($request->getParameter('settings_form[settings_lname]')),
                      'settings_about'  => trim($request->getParameter('settings_form[settings_about]')),
                    );
                    //Set first name
                    $this->getUser()->getProfile()->setUserFirstName($params['settings_fname']);
                    //Set last name
                    $this->getUser()->getProfile()->setUserLastName($params['settings_lname']);
                    //Set about me
                    $this->getUser()->getProfile()->setUserAbout($params['settings_about']);
                    $this->getUser()->getProfile()->save();
               }
          }
          elseif ($request->getParameter('settings_protected_form')) {
              $this->settings_form_protected->bind($request->getParameter('settings_protected_form'));
              if ($this->settings_form_protected->isValid())
              {
                  //Array of parameters
                    $params = array (
                      'settings_curpass'   => trim($request->getParameter('settings_protected_form[settings_curpass]')),
                      'settings_newpass'  => trim($request->getParameter('settings_protected_form[settings_newpass]')),
                      'settings_email'  => trim($request->getParameter('settings_protected_form[settings_email]')),
                    );
                  // Check whether the entered current password matches the DB version - if not error it.
                  if (!$this->getUser()->checkPassword($params['settings_curpass'])) {
                      $this->custom_errors['protected_errors'][] = "The current password you entered did not match that of the one in our records.";
                  }
                  // Pasword matched
                  else
                  {
                      // Set email address
                      $this->getUser()->getProfile()->setUserEmail($params['settings_email']);
                      // If they set a new password
                      if ($params['settings_newpass']) {
                          $this->getUser()->setPassword($params['settings_newpass']);
                      }
                      $this->getUser()->getProfile()->save();
                  }
              }
          }
          elseif ($request->getFiles('settings_photo_form')) {
              $this->settings_form_photo->bind($request->getParameter('settings_photo_form'), $request->getFiles('settings_photo_form'));
              if ($this->settings_form_photo->isValid())
              {
                  // Get file object
                  $file = $this->settings_form_photo->getValue('settings_photo');
                  // create transform driver object for image manipulation
                  $image = Image_Transform::factory('GD');
                  // Load file image to $image
                  $image->load($file->getTempName());
                  
                  // If the width is greater than the height we scale the height
                  if($image->getImageWidth() >= $image->getImageHeight()) {
                     $image->scalebyY('400');
                     $image->crop('400', '400', 0, 0);
                  }
                  // And vice-versa
                  else {
                      $image->scalebyX('400');
                      $image->crop('400', '400', 0, 0);
                  }
                 
                  // Save a new temporary image
                  $image->save($file->getTempName().'400pxsquare', 'jpg');
                  $now = new Date();
                  
                  // Generate the filename
                  $filename = sha1($now->getDate()).'.jpg';
                  
                  // Amazon S3 object
                  $s3 = new S3 ('1QBXEDC38HN5WYTPBEG2', '9iu1+T24NnR8SJpPA2iUyPTNzXnBKTt9baDjsMEW', false);
                  // Upload the photo
                  $s3->putObjectFile($file->getTempName().'400pxsquare', 'userimages.filmstacks', $this->getUser()->getProfile()->getUserId()."/photos/{$filename}", S3::ACL_PUBLIC_READ);
                  
                  // Save the path of the new photo in the database
                  $this->getUser()->getProfile()->setUserAvatarFile("http://userimages.filmstacks.s3.amazonaws.com/{$this->getUser()->getProfile()->getUserId()}/photos/{$filename}");
                  $this->getUser()->getProfile()->save();
              }
          }
    	  
    }
  }
}
