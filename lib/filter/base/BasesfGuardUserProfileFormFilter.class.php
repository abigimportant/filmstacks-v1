<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'user_email'         => new sfWidgetFormFilterInput(),
      'user_about'         => new sfWidgetFormFilterInput(),
      'user_country'       => new sfWidgetFormFilterInput(),
      'user_first_name'    => new sfWidgetFormFilterInput(),
      'user_last_name'     => new sfWidgetFormFilterInput(),
      'user_twitter_uname' => new sfWidgetFormFilterInput(),
      'user_twitter_pword' => new sfWidgetFormFilterInput(),
      'user_twitter_bool'  => new sfWidgetFormFilterInput(),
      'user_avatar_file'   => new sfWidgetFormFilterInput(),
      'user_dob'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'user_privacy_level' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'user_email'         => new sfValidatorPass(array('required' => false)),
      'user_about'         => new sfValidatorPass(array('required' => false)),
      'user_country'       => new sfValidatorPass(array('required' => false)),
      'user_first_name'    => new sfValidatorPass(array('required' => false)),
      'user_last_name'     => new sfValidatorPass(array('required' => false)),
      'user_twitter_uname' => new sfValidatorPass(array('required' => false)),
      'user_twitter_pword' => new sfValidatorPass(array('required' => false)),
      'user_twitter_bool'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_avatar_file'   => new sfValidatorPass(array('required' => false)),
      'user_dob'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_privacy_level' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'ForeignKey',
      'user_email'         => 'Text',
      'user_about'         => 'Text',
      'user_country'       => 'Text',
      'user_first_name'    => 'Text',
      'user_last_name'     => 'Text',
      'user_twitter_uname' => 'Text',
      'user_twitter_pword' => 'Text',
      'user_twitter_bool'  => 'Number',
      'user_avatar_file'   => 'Text',
      'user_dob'           => 'Date',
      'user_privacy_level' => 'Number',
    );
  }
}
