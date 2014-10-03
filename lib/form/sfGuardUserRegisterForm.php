<?php
/**
 * A Symfony form class for registering too Filmstacks.
 * 
 * @category   Form classes
 * @package    Filmstacks
 * @subpackage form
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.1.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class sfGuardUserRegistrationForm extends sfForm
{
  public function configure()
  {
    // Set widgets for objects
    $widgets = array(
      'signup_code' => new sfWidgetFormInput(array(), array('class' => 'textbox')),
      'signup_uname' => new sfWidgetFormInput(array(), array('class' => 'textbox')),
      'signup_email' => new sfWidgetFormInput(array(), array('class' => 'textbox')),
    );
    $this->setWidgets($widgets);
    
    // Set labels for widgets
    $labels = array(
      'signup_code'  => 'Invitation code:',
      'signup_uname' => 'Desired username:',
      'signup_email' => 'Email address:'
    );
    $this->widgetSchema->setLabels($labels);
    
    // Set output name format
    $this->widgetSchema->setNameFormat('signup_form[%s]');
    
    // Set Validators
    $validators = array(
        'signup_code'   => new sfValidatorString(array('required' => true, 'min_length' => 16, 'max_length' => 16, 'trim' => true), array('required' => 'You must enter an invitation code to register.', 'min_length' => 'The invitation code you entered was too short.', 'max_length' => 'The invitation code you entered was too long.')),
        'signup_uname'  => new sfValidatorString(array('required' => true, 'min_length' => 4, 'max_length' => 25, 'trim' => true), array('required' => 'You must enter a desired username to register.', 'min_length' => 'The username you entered was too short (4 characters minimum).', 'max_length' => "The username you entered was too long (25 characters maximum).")),
        'signup_email'  => new sfValidatorEmail(array('required' => true, 'trim' => true), array('required' => 'You must enter a valid email address to register.')),
    );
    $this->setValidators($validators);
  }
}
