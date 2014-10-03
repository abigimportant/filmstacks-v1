<?php

/**
 * FsStacksComments form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsStacksCommentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'stack_comment_id'      => new sfWidgetFormInputHidden(),
      'stack_id'              => new sfWidgetFormPropelChoice(array('model' => 'FsStacks', 'add_empty' => false)),
      'user_id'               => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'stack_comment_comment' => new sfWidgetFormInput(),
      'created_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'stack_comment_id'      => new sfValidatorPropelChoice(array('model' => 'FsStacksComments', 'column' => 'stack_comment_id', 'required' => false)),
      'stack_id'              => new sfValidatorPropelChoice(array('model' => 'FsStacks', 'column' => 'stack_id')),
      'user_id'               => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'stack_comment_comment' => new sfValidatorString(array('max_length' => 180)),
      'created_at'            => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks_comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacksComments';
  }


}
