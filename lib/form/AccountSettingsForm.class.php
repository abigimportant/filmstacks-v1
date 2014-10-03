<?php
/**
 * A Symfony form class for making account detail modifications.
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
class AccountSettingsForm extends sfForm
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
      'settings_fname' => new sfWidgetFormInput(array(), array("class" => 'textbox')),
      'settings_lname' => new sfWidgetFormInput(array(), array("class" => 'textbox')),
      'settings_about'  => new sfWidgetFormInput(array(), array("class" => 'textbox')),
    );
    $this->setWidgets($widgets);
    
    // Set labels for widgets
    $labels = array(
      'settings_fname' => 'First name:',
      'settings_lname' => 'Surname:',
      'settings_about'  => 'About me:',
    );
    $this->widgetSchema->setLabels($labels);
    
    // Set output name format
    $this->widgetSchema->setNameFormat('settings_form[%s]');
    
    // Set default values
    $defaults = array(
      'settings_fname' => self::$user->getProfile()->getUserFirstName(),
      'settings_lname' => self::$user->getProfile()->getUserLastName(),
      'settings_about' => self::$user->getProfile()->getUserAbout()
    );
    $this->setDefaults($defaults);
    
    // Set Validators
    $validators = array(
        'settings_fname'   => new sfValidatorString(array('required' => false, 'min_length' => 3, 'max_length' => 25, 'trim' => true), array('min_length' => 'The first name you entered was too short (3 characters minimum).', 'max_length' => 'The first name you entered was too long (25 characters maximum).')),
        'settings_lname'  => new sfValidatorString(array('required' => false, 'min_length' => 3, 'max_length' => 25, 'trim' => true), array('min_length' => 'The surname name you entered was too short (3 characters minimum).', 'max_length' => "The surname you entered was too long (25 characters maximum).")),
        'settings_about'  => new sfValidatorString(array('required' => false, 'trim' => true, 'max_length' => 140), array('max_length' => 'Your about me exceeds the maximum of 140 characters in length.')),
    );
    $this->setValidators($validators);
  }
}
?>