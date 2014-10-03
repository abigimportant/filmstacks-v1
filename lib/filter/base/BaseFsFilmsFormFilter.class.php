<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FsFilms filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFsFilmsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'film_title'              => new sfWidgetFormFilterInput(),
      'film_wikipedia_title'    => new sfWidgetFormFilterInput(),
      'film_wikipedia_poster'   => new sfWidgetFormFilterInput(),
      'film_wikipedia_summary'  => new sfWidgetFormFilterInput(),
      'film_release'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'film_wikipedia_revision' => new sfWidgetFormFilterInput(),
      'next_sync'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'film_title'              => new sfValidatorPass(array('required' => false)),
      'film_wikipedia_title'    => new sfValidatorPass(array('required' => false)),
      'film_wikipedia_poster'   => new sfValidatorPass(array('required' => false)),
      'film_wikipedia_summary'  => new sfValidatorPass(array('required' => false)),
      'film_release'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'film_wikipedia_revision' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'next_sync'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('fs_films_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsFilms';
  }

  public function getFields()
  {
    return array(
      'film_id'                 => 'Number',
      'film_title'              => 'Text',
      'film_wikipedia_title'    => 'Text',
      'film_wikipedia_poster'   => 'Text',
      'film_wikipedia_summary'  => 'Text',
      'film_release'            => 'Date',
      'film_wikipedia_revision' => 'Number',
      'next_sync'               => 'Date',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
