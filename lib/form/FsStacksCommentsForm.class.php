<?php
/**
 * A Symfony form class for making a comment on a stack.
 * 
 * @category   Form classes
 * @package    Filmstacks
 * @subpackage form
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.1.1
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class FsStacksCommentsForm extends sfForm
{
  /**
   * Stack object for account
   * 
   * @var    array    $stack
   */
   static protected $stack;
   
  /**
   * Fills object variables used by other methods
   *
   * @return void
   */
  public function __construct($stack)
  {
	self::$stack = $stack;
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
      'comment_field' => new sfWidgetFormTextarea(array(), array("class" => 'comment_textarea')),
    );
    $this->setWidgets($widgets);
    
    // Set labels for widgets
    $labels = array(
      'comment_field' => 'Comment box:',
    );
    $this->widgetSchema->setLabels($labels);
    
    // Set output name format
    $this->widgetSchema->setNameFormat('comment_form[%s]');
    
    // Set Validators
    $validators = array(
        'comment_field'  => new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 500, 'min_length' => 10), array('required' => 'When commenting you must enter content for the comment to be submitted.', 'max_length' => 'Your comment exceeds 500 characters - keep it short please!', 'min_length' => 'Your comment is under 10 characters long - say a bit more!')),
    );
    $this->setValidators($validators);
  }
}
?>