<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\CommentForm;
use Application\Model\Comment;
use Application\Model\CommentTable;
use Application\Model\Image;
use Application\Model\Text;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\Paginator\Adapter;
use Zend\Paginator\Paginator;
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
        // FSUC i know
        $request = $this->getRequest();
        $form = new CommentForm(); 
        $page = ($this->params()->fromRoute('page')) ? $this->params()->fromRoute('page') : 1;
        $container = new Container();
        
        if(!is_array($container->params)) {
            $container->params = array();
        }
        
        $container->params['user_name'] = (isset($container->params['user_name'])) ? $container->params['user_name']: 'DESC';
        $container->params['created_at'] = (isset($container->params['created_at'])) ? $container->params['created_at']: 'DESC';
        $container->params['email'] = (isset($container->params['email'])) ? $container->params['email']: 'DESC';
        
        if(empty($container->params['last'])) {
            $container->params['last'] = 'created_at';
        }
        
        $comments = $this->table->getHierarchy('0', $container->params['last'], $container->params[$container->params['last']]);
        $paginator = new Paginator(new Adapter\ArrayAdapter($comments));
        $dir = strstr(__DIR__, '/module/Application/src/Controller', true);
        $confArray = include $dir.'/config/autoload/paginator.global.php';        
        $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($confArray['per_page'])
            ->setPageRange(ceil(count($comments)/$confArray['per_page']));
        $vm = new ViewModel();
        
        if ($request->isPost()) {
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $comment = new Comment();
            if($post['file']['type'] === 'text/plain') {
                $text = new Text();
                $form->setInputFilter($text->getInputFilter());
            }
            elseif(false !== strpos($post['file']['type'], 'image')) {
                $text = new Image();
                $form->setInputFilter($text->getInputFilter());                
            }
            else {
                $form->setInputFilter($comment->getInputFilter());
            }
            $form->setData($post);
            if (!$form->isValid()) {
                $vm->setVariable('error_input', [
                    'field' => key($form->getMessages()),
                    'parent' => $request->getPost('parent'),
                ]);
            }
            else {
                $comment->exchangeArray($form->getData());
                $this->table->saveComment($comment);
            }
        }
        
        $vm->setVariables([
            'paginator' => $paginator,
            'form' => $form,
            'sortParams' => $container->params,
        ]);
        return $vm;
    }
        
    public function viewAction()
    {
        $request = $this->getRequest();
        $form = new CommentForm();
        $parent = $this->table->getComment($this->params()->fromRoute('id'));
        $request = $this->getRequest();
        $comments = $this->table->getHierarchy($this->params()->fromRoute('id'), 'created_at', 'DESC');
        $vm = new ViewModel();
        
        if ($request->isPost()) {
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $comment = new Comment();
            
            if($post['file']['type'] === 'text/plain') {
                $text = new Text();
                $form->setInputFilter($text->getInputFilter());
            }
            elseif(false !== strpos($post['file']['type'], 'image')) {
                $text = new Image();
                $form->setInputFilter($text->getInputFilter());                
            }
            else {
                $form->setInputFilter($comment->getInputFilter());
            }
            
            $form->setData($post);
            
            if (!$form->isValid()) {
                $vm->setVariable('error_input', [
                    'field' => key($form->getMessages()),
                    'parent' => $request->getPost('parent'),
                ]);
            }
            else {
                $comment->exchangeArray($form->getData());
                $this->table->saveComment($comment);
            }
            
        }
        $vm->setVariables([
            'parent' => $parent,
            'comments' => $comments,
            'form' => $form,
        ]);
        return $vm;
    }
     
    public function switchAction()
    {
        $sort = ($this->params()->fromQuery('sort')) ? $this->params()->fromQuery('sort') : 'created_at';
        $page = $this->params()->fromRoute('page');
        $container = new Container();
        $container->params[$sort] = ($container->params[$sort] === 'ASC') ? 'DESC' : 'ASC';
        $container->params['last'] = $sort;
        return $this->redirect()->toUrl('/index/'.$page);
    }
    
}
