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
        $form = new CommentForm();
        $page = ($this->params()->fromRoute('page')) ? $this->params()->fromRoute('page') : 1; 
        $sort = ($this->params()->fromQuery('sort')) ? $this->params()->fromQuery('sort') : 'created_at';
        $order = ($this->params()->fromQuery('order')) ? $this->params()->fromQuery('order') : 'ASC';        
        $comments = $this->table->getHierarchy('0', $sort, $order);
        $paginator = new Paginator(new Adapter\ArrayAdapter($comments));
        $dir = strstr(__DIR__, '/module/Application/src/Controller', true);
        $confArray = include $dir.'/config/autoload/paginator.global.php';        
        $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($confArray['per_page'])
            ->setPageRange(ceil(count($comments)/$confArray['per_page']));
        return ([
            'paginator' => $paginator,
            'form' => $form,
            'order' => $order,
            'sort' => $sort,
        ]);
    }
        
    public function viewAction()
    {
        $form = new CommentForm();
        $id = $this->params()->fromRoute('id');
        $parent = $this->table->getComment($id);
        return new ViewModel([
            'parent' => $parent,
            'comments' => $this->table->getHierarchy($id),
            'form' => $form,
        ]);
    }
        
    public function switchAction()
    {
        $sort = ($this->params()->fromQuery('sort')) ? $this->params()->fromQuery('sort') : 'created_at';
        $order = ($this->params()->fromQuery('order')) ? $this->params()->fromQuery('order') : 'ASC';
        $page = $this->params()->fromRoute('page');
        if($order === 'DESC') {
            $order = 'ASC';
        }
        elseif($order === 'ASC') {
            $order = 'DESC';
        }
        return $this->redirect()->toUrl('/index/'.$page.'?sort='.$sort.'&order='.$order);
    }
    
    public function addAction()
    {
        $form = new CommentForm();
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->redirect()->toRoute('home');
        }
        $page = ($this->params()->fromRoute('page')) ? $this->params()->fromRoute('page') : 1;       
        $sort = ($this->params()->fromQuery('sort')) ? $this->params()->fromQuery('sort') : 'created_at';
        $order = ($this->params()->fromQuery('order')) ? $this->params()->fromQuery('order') : 'ASC'; 
        $comment = new Comment();
        $comments = $this->table->getHierarchy('0');
        $paginator = new Paginator(new Adapter\ArrayAdapter($comments));
        $dir = strstr(__DIR__, '/module/Application/src/Controller', true);
        $confArray = include $dir.'/config/autoload/paginator.global.php';        
        $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($confArray['per_page'])
            ->setPageRange(ceil(count($comments)/$confArray['per_page']));
        $form->setInputFilter($comment->getInputFilter());
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ([
                'paginator' => $paginator,
                'form' => $form,
                'error_input' => [
                    'field' => key($form->getMessages()),
                    'parent' => $request->getPost('parent'),
                    'order' => $order,
                    'sort' => $sort,
                ]
            ]);
        }

        $comment->exchangeArray($form->getData());
        $this->table->saveComment($comment);
        return $this->redirect()->toRoute('home');
    }
    
}
