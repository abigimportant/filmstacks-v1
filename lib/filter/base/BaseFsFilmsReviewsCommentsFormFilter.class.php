<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FsFilmsReviewsComments filter form base class.
 *
 * @package    Filmstacks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFsFilmsReviewsCommentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'review_id'         => new sfWidgetFormPropelChoice(array('model' => 'FsFilmsReviews', 'add_empty' => true)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'review_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'FsFilmsReviews', 'column' => 'review_id')),
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('fs_films_reviews_comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsFilmsReviewsComments';
  }

  public function getFields()
  {
    return array(
      'review_comment_id' => 'Number',
      'review_id'         => 'ForeignKey',
      'user_id'           => 'ForeignKey',
      'created_at'        => 'Date',
    );
  }
}
