<?php
/**
 * A Symfony form class for searching for a film to stack.
 * 
 * @category   Form classes
 * @package    Filmstacks
 * @subpackage form
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.1.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class FsStacksSearchForm extends BaseFsStacksForm
{
  /**
   * Fills object variables used by other methods
   *
   * @return void
   */
  public function __construct()
  {
    self::configure();
  } 
   
  /**
   * Configures stack form elements
   *
   * @return void
   */
  public function configure()
  {
    // Set widgets for objects
    $widgets = array(
      'film_title' => new sfWidgetFormInput(array(), array('class' => 'float-left')),
    );
    $this->setWidgets($widgets);
    
    // Output style set to list rather than table
    $this->widgetSchema->setFormFormatterName('list');
    
    // Set labels for widgets
    $labels = array(
      'film_title' => 'Film'
    );
    $this->widgetSchema->setLabels($labels);
    
    // Set output name format
    $this->widgetSchema->setNameFormat('search_form[%s]');
    
    // Set validators for stack submission
    $validators = array(
      'film_title' => new sfValidatorString(array('required' => true, 'trim' => true)),
    );
    $this->setValidators($validators);
  }
}