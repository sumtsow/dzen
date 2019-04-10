<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Csrf;

class CommentForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('comment');
        $this->setAttributes(['method' => 'post', 'action' => '/add']);
        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                'timeout' => 600,
                ],
            ],
        ]);
        /*$this->add([
            'name' => 'id',
            'type' => 'hidden',
            'value' => 0,
        ]);*/
        $this->add([
            'name' => 'user_name',
            'type' => 'text',
            'options' => [
                'label' => 'User Name',
            ],
        ]);
        $this->add([
            'name' => 'email',            
            'type' => Element\Email::class,
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'home_page',
            'type' => Element\Url::class,
            'options' => [
                'label' => 'Home Page',
            ],
        ]);
        $this->add([
            'name' => 'text',
            'type' => 'textarea',
            'options' => [
                'label' => 'Text',
            ],
        ]);
        $this->add([
            'name' => 'user_ip',
            'type' => 'text',
            'options' => [
                'label' => 'User IP',
            ],
        ]);
        $this->add([
            'name' => 'parent',
            'type' => 'hidden',
        ]);        
        $this->add([
            'name' => 'created_at',
            'type' => Element\DateTime::class,
            'options' => [
                'label' => 'Date/Time',
                'format' => 'Y-m-d\TH:iP',
            ],
            'attributes' => [
                //'min' => '2019-01-01T00:00:00Z',
                //'max' => '2019-12-31T00:00:00Z',
                //'step' => '1',
            ],
        ]);
        $this->add([
            'id' => 'submitbutton',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id'    => 'submitbutton',
            ],
        ]);       
    }
}
