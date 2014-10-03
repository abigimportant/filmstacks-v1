<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FsBetaInvitations filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFsBetaInvitationsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'invite_code'      => new sfWidgetFormFilterInput(),
      'invite_allowance' => new sfWidgetFormFilterInput(),
      'invite_used'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'invite_code'      => new sfValidatorPass(array('required' => false)),
      'invite_allowance' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invite_used'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('fs_beta_invitations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsBetaInvitations';
  }

  public function getFields()
  {
    return array(
      'invite_id'        => 'Number',
      'invite_code'      => 'Text',
      'invite_allowance' => 'Number',
      'invite_used'      => 'Number',
    );
  }
}
