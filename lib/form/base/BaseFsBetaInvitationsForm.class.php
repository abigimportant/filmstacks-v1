<?php

/**
 * FsBetaInvitations form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsBetaInvitationsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'invite_id'        => new sfWidgetFormInputHidden(),
      'invite_code'      => new sfWidgetFormInput(),
      'invite_allowance' => new sfWidgetFormInput(),
      'invite_used'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'invite_id'        => new sfValidatorPropelChoice(array('model' => 'FsBetaInvitations', 'column' => 'invite_id', 'required' => false)),
      'invite_code'      => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'invite_allowance' => new sfValidatorInteger(array('required' => false)),
      'invite_used'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_beta_invitations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsBetaInvitations';
  }


}
