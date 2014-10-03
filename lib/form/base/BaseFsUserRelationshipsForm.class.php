<?php

/**
 * FsUserRelationships form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsUserRelationshipsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'relationship_id'     => new sfWidgetFormInputHidden(),
      'first_user_id'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'second_user_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'relationship_status' => new sfWidgetFormInput(),
      'created_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'relationship_id'     => new sfValidatorPropelChoice(array('model' => 'FsUserRelationships', 'column' => 'relationship_id', 'required' => false)),
      'first_user_id'       => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'second_user_id'      => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'relationship_status' => new sfValidatorInteger(),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_user_relationships[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsUserRelationships';
  }


}
