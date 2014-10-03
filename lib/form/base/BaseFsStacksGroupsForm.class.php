<?php

/**
 * FsStacksGroups form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsStacksGroupsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'       => new sfWidgetFormInputHidden(),
      'stack_id'       => new sfWidgetFormPropelChoice(array('model' => 'FsStacks', 'add_empty' => false)),
      'group_user_ids' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'group_id'       => new sfValidatorPropelChoice(array('model' => 'FsStacksGroups', 'column' => 'group_id', 'required' => false)),
      'stack_id'       => new sfValidatorPropelChoice(array('model' => 'FsStacks', 'column' => 'stack_id')),
      'group_user_ids' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks_groups[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacksGroups';
  }


}
