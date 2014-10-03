<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FsStacksGroups filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFsStacksGroupsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'stack_id'       => new sfWidgetFormPropelChoice(array('model' => 'FsStacks', 'add_empty' => true)),
      'group_user_ids' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'stack_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'FsStacks', 'column' => 'stack_id')),
      'group_user_ids' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks_groups_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacksGroups';
  }

  public function getFields()
  {
    return array(
      'group_id'       => 'Number',
      'stack_id'       => 'ForeignKey',
      'group_user_ids' => 'Text',
    );
  }
}
