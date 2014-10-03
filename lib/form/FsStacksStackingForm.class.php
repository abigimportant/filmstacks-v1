<?php
/**
 * A Symfony form class for stacking a film.
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
class FsStacksStackingForm extends BaseFsStacksForm
{
  /**
   * Words that can be associated with stacks
   * 
   * @var    array    $words
   * @see    FsStacksForm::__construct()
   */
   static protected $words = array();
   
   /**
    * Fills object variables used by other methods
    *
    * @return void
    */
   public function __construct()
   {
     $criteria    = new Criteria();
     $results     = FsStacksWordsPeer::doSelect($criteria);

     foreach ($results as $result) {
       self::$words[$result->getWordId()] = $result->getWordWord();
     }

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
       'film_words'     => new sfWidgetFormSelect(array('choices' => self::$words)),
       'film_recommend' => new sfWidgetFormSelect(array('choices' => array('0' => 'Yes', '1' => 'No')))
     );
     $this->setWidgets($widgets);

     // Set labels for widgets
     $labels = array(
       'film_words' => 'One word to describe the film...',
       'film_recommend' => 'Would you recommend this to someone else?'
     );
     $this->widgetSchema->setLabels($labels);

     // Set output name format
     $this->widgetSchema->setNameFormat('stacking_form[%s]');

     // Set validators for stack submission
     $validators = array(
       'film_words' => new sfValidatorChoice(array('choices'  => array_keys(self::$words)))
     );
     $this->setValidators($validators);
   }
}