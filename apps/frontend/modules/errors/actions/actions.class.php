<?php
/**
 * A Symfony actions class for managing site errors.
 * 
 * @category   Actions classes
 * @package    Filmstacks
 * @subpackage user
 * @author     Nicholas Pellant <contact@nickpellant.com>
 * @copyright  2007-2009 Filmstacks <staff@filmstacks.tv>
 * @version    0.5.0
 * @link       http://filmstacks.tv
 * @link       http://symfony-project.com 
 */
class errorsActions extends sfActions
{
    /**
     * Executes an error404
     *
     * @param sfRequest $request A request object
     * @return void
     */
     public function executeError404(sfWebRequest $request)
     {
     }
     
     /**
      * Executes an error500
      *
      * @param sfRequest $request A request object
      * @return void
      */
      public function executeError500(sfWebRequest $request)
      {
      }
}