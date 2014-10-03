<?php
/**
 * A Symfony form class for making account photo changes.
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
class AccountSettingsPhotoForm extends sfForm
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
      'settings_photo' => new sfWidgetFormInputFile(array(), array("class" => 'file_upload')),
    );
    $this->setWidgets($widgets);
    
    // Set labels for widgets
    $labels = array(
      'settings_photo' => 'Profile photo:',
    );
    
    $this->widgetSchema->setLabels($labels);
    
    // Set output name format
    $this->widgetSchema->setNameFormat('settings_photo_form[%s]');
    
    // Set Validators
    $validators = array(
        'settings_photo'   => new sfValidatorFile(array('required' => false))
    );
    $this->setValidators($validators);
  }
}
?>