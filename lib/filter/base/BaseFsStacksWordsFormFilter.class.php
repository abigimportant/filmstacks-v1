<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FsStacksWords filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFsStacksWordsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'word_word'  => new sfWidgetFormFilterInput(),
      'word_value' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'word_word'  => new sfValidatorPass(array('required' => false)),
      'word_value' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks_words_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacksWords';
  }

  public function getFields()
  {
    return array(
      'word_id'    => 'Number',
      'word_word'  => 'Text',
      'word_value' => 'Number',
    );
  }
}
