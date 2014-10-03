<?php

/**
 * FsFilms form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsFilmsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'film_id'                 => new sfWidgetFormInputHidden(),
      'film_title'              => new sfWidgetFormInput(),
      'film_wikipedia_title'    => new sfWidgetFormInput(),
      'film_wikipedia_poster'   => new sfWidgetFormInput(),
      'film_wikipedia_summary'  => new sfWidgetFormTextarea(),
      'film_release'            => new sfWidgetFormDate(),
      'film_wikipedia_revision' => new sfWidgetFormInput(),
      'next_sync'               => new sfWidgetFormDateTime(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'film_id'                 => new sfValidatorPropelChoice(array('model' => 'FsFilms', 'column' => 'film_id', 'required' => false)),
      'film_title'              => new sfValidatorString(array('max_length' => 64)),
      'film_wikipedia_title'    => new sfValidatorString(array('max_length' => 64)),
      'film_wikipedia_poster'   => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'film_wikipedia_summary'  => new sfValidatorString(array('required' => false)),
      'film_release'            => new sfValidatorDate(),
      'film_wikipedia_revision' => new sfValidatorInteger(array('required' => false)),
      'next_sync'               => new sfValidatorDateTime(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_films[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsFilms';
  }


}
