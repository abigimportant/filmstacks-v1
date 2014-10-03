<?php

/**
 * stack actions.
 *
 * @package    filmstacks
 * @subpackage stack
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class stackActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->stack = FsStacksPeer::retrieveByPk($request->getParameter('stack_id'));
    $this->forward404If(!$this->stack);
    $this->stack->fetchFilmObject();
    $this->stack->fetchUserObject();
    $this->stack->fetchWordObject();
    $this->stack->fetchGroupObject();
    $this->stack->fetchGroupMembers();
    $this->stack->fetchCommentObjects();
    
    $this->comment_form = new FsStacksCommentsForm($this->stack);

	// Unless method is post we're not saving anything
    if ($request->isMethod('post')) {
        $this->comment_form->bind($request->getParameter('comment_form'));
        if ($this->comment_form->isValid())
        {
            $params = $this->comment_form->getValues();
            $comment = new FsStacksComments();
            $comment->setUserId($this->getUser()->getProfile()->getUserId());
            $comment->setStackCommentComment($params['comment_field']);
            $comment->setStackId($this->stack->getStackId());
            $comment->save();
            
            $this->redirect('/stack/'.$this->stack->getStackId());
        }
    }
  }
}
