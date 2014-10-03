<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'user_email'         => new sfWidgetFormInput(),
      'user_about'         => new sfWidgetFormInput(),
      'user_country'       => new sfWidgetFormInput(),
      'user_first_name'    => new sfWidgetFormInput(),
      'user_last_name'     => new sfWidgetFormInput(),
      'user_twitter_uname' => new sfWidgetFormInput(),
      'user_twitter_pword' => new sfWidgetFormInput(),
      'user_twitter_bool'  => new sfWidgetFormInput(),
      'user_avatar_file'   => new sfWidgetFormInput(),
      'user_dob'           => new sfWidgetFormDate(),
      'user_privacy_level' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'id', 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'user_email'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'user_about'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'user_country'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'user_first_name'    => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'user_last_name'     => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'user_twitter_uname' => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'user_twitter_pword' => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'user_twitter_bool'  => new sfValidatorInteger(array('required' => false)),
      'user_avatar_file'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'user_dob'           => new sfValidatorDate(array('required' => false)),
      'user_privacy_level' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


}
