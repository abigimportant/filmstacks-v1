<?php

/**
 * FsStacks form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsStacksForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'stack_id'         => new sfWidgetFormInputHidden(),
      'film_id'          => new sfWidgetFormPropelChoice(array('model' => 'FsFilms', 'add_empty' => false)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'word_id'          => new sfWidgetFormPropelChoice(array('model' => 'FsStacksWords', 'add_empty' => true)),
      'group_id'         => new sfWidgetFormInput(),
      'stack_seen_count' => new sfWidgetFormInput(),
      'stack_watchdate'  => new sfWidgetFormDate(),
      'stack_recommend'  => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'stack_id'         => new sfValidatorPropelChoice(array('model' => 'FsStacks', 'column' => 'stack_id', 'required' => false)),
      'film_id'          => new sfValidatorPropelChoice(array('model' => 'FsFilms', 'column' => 'film_id')),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'word_id'          => new sfValidatorPropelChoice(array('model' => 'FsStacksWords', 'column' => 'word_id', 'required' => false)),
      'group_id'         => new sfValidatorInteger(array('required' => false)),
      'stack_seen_count' => new sfValidatorInteger(array('required' => false)),
      'stack_watchdate'  => new sfValidatorDate(),
      'stack_recommend'  => new sfValidatorBoolean(),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacks';
  }


}
