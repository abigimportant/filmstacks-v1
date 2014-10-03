<?php

/**
 * FsFilmsReviews form base class.
 *
 * @package    Filmstacks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFsFilmsReviewsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'review_id'      => new sfWidgetFormInputHidden(),
      'film_id'        => new sfWidgetFormPropelChoice(array('model' => 'FsFilms', 'add_empty' => false)),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'review_content' => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'review_id'      => new sfValidatorPropelChoice(array('model' => 'FsFilmsReviews', 'column' => 'review_id', 'required' => false)),
      'film_id'        => new sfValidatorPropelChoice(array('model' => 'FsFilms', 'column' => 'film_id')),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'review_content' => new sfValidatorString(),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fs_films_reviews[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FsFilmsReviews';
  }


}
