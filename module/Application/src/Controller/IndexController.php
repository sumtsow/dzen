<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\Comment;
use Application\Model\CommentTable;
use Application\Form\CommentForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $table;
    
    public function __construct(CommentTable $table)
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        //$form = ($this->params()->fromRoute('form')) ? $this->params()->fromRoute('form') : new CommentForm();
        $form = new CommentForm();
        return new ViewModel([
            'comments' => $this->table->getHierarchy(),
            'form' => $form,
        ]);
    }
    
    public function addAction()
    {
        $form = new CommentForm();
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->redirect()->toRoute('home');
        }

        $comment = new Comment();
        $form->setInputFilter($comment->getInputFilter());
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $this->redirect()->toRoute('home', ['form' => $form]);
        }

        $comment->exchangeArray($form->getData());
        $this->table->saveComment($comment);
        return $this->redirect()->toRoute('home');
    }
    
}
