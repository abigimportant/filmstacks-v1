<?php

/**
 * FsStacksWords form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsStacksWordsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'word_id'    => new sfWidgetFormInputHidden(),
      'word_word'  => new sfWidgetFormInput(),
      'word_value' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'word_id'    => new sfValidatorPropelChoice(array('model' => 'FsStacksWords', 'column' => 'word_id', 'required' => false)),
      'word_word'  => new sfValidatorString(array('max_length' => 32)),
      'word_value' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks_words[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacksWords';
  }


}
