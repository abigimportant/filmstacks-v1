<?php
/**
 * A Symfony form class for making account protected detail modifications.
 * 
 * @category   Form classes
 * @package    Filmstacks
 * @subpackage form
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.1.1
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class AccountSettingsProtectedForm extends sfForm
{
  /**
   * User object for account
   * 
   * @var    array    $user
   */
   static protected $user;
   
  /**
   * Fills object variables used by other methods
   *
   * @return void
   */
  public function __construct($user)
  {
	self::$user = $user;
    self::configure();
  }
  /**
   * Configures stack form elements
   *
   * @return void
   */
  public function configure()
  {
    // Set widgets for objects
    $widgets = array(
      'settings_curpass' => new sfWidgetFormInputPassword(array(), array("class" => 'textbox')),
      'settings_email' => new sfWidgetFormInput(array(), array("class" => 'textbox')),
      'settings_newpass' => new sfWidgetFormInputPassword(array(), array("class" => 'textbox')),
    );
    $this->setWidgets($widgets);
    
    // Set labels for widgets
    $labels = array(
      'settings_curpass' => 'Current password:',
      'settings_email'   => 'Email address:',
      'settings_newpass' => 'New password:'
    );
    
    $this->widgetSchema->setLabels($labels);
    
    // Set output name format
    $this->widgetSchema->setNameFormat('settings_protected_form[%s]');
    
    // Set default values
    $defaults = array(
      'settings_email' => self::$user->getProfile()->getUserEmail(),
    );
    $this->setDefaults($defaults);
    
    // Set Validators
    $validators = array(
        'settings_curpass'   => new sfValidatorString(array('required' => true, 'min_length' => 8, 'max_length' => 25, 'trim' => true), array('required' => 'You must enter your current password to modify these details.', 'min_length' => 'The current password you entered was incorrect.', 'max_length' => 'The current password you entered was incorrect.')),
        'settings_newpass'  => new sfValidatorString(array('required' => false, 'min_length' => 8, 'max_length' => 25, 'trim' => true), array('min_length' => 'The new password you entered was too short (8 character minimum).', 'max_length' => "The new password you entered was too long (25 characters maximum).")),
        'settings_email'  => new sfValidatorEmail(array('required' => true, 'trim' => true), array('required' => 'You must enter a valid email address.')),
    );
    $this->setValidators($validators);
  }
}
?>