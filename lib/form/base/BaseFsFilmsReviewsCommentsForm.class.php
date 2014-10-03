<?php

/**
 * FsFilmsReviewsComments form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsFilmsReviewsCommentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'review_comment_id' => new sfWidgetFormInputHidden(),
      'review_id'         => new sfWidgetFormPropelChoice(array('model' => 'FsFilmsReviews', 'add_empty' => false)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'review_comment_id' => new sfValidatorPropelChoice(array('model' => 'FsFilmsReviewsComments', 'column' => 'review_comment_id', 'required' => false)),
      'review_id'         => new sfValidatorPropelChoice(array('model' => 'FsFilmsReviews', 'column' => 'review_id')),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_films_reviews_comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsFilmsReviewsComments';
  }


}
