<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FsStacks filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFsStacksFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'film_id'          => new sfWidgetFormPropelChoice(array('model' => 'FsFilms', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'word_id'          => new sfWidgetFormPropelChoice(array('model' => 'FsStacksWords', 'add_empty' => true)),
      'group_id'         => new sfWidgetFormFilterInput(),
      'stack_seen_count' => new sfWidgetFormFilterInput(),
      'stack_watchdate'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'stack_recommend'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'film_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'FsFilms', 'column' => 'film_id')),
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'word_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'FsStacksWords', 'column' => 'word_id')),
      'group_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stack_seen_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stack_watchdate'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'stack_recommend'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('fs_stacks_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsStacks';
  }

  public function getFields()
  {
    return array(
      'stack_id'         => 'Number',
      'film_id'          => 'ForeignKey',
      'user_id'          => 'ForeignKey',
      'word_id'          => 'ForeignKey',
      'group_id'         => 'Number',
      'stack_seen_count' => 'Number',
      'stack_watchdate'  => 'Date',
      'stack_recommend'  => 'Boolean',
      'created_at'       => 'Date',
    );
  }
}
