<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha;

class CommentForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('comment');
        $this->setAttributes([
            'method' => 'post',
            //'enctype' => 'multipart/form-data',
            ]);

        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                'timeout' => 600,
                ],
            ],
        ]);
        
        $this->add([
            'name' => 'user_name',
            'id' => 'user_name',
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
            'type' => 'text',
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
            'name' => 'file',
            'type' => Element\File::class,
            'options' => [
                'label' => 'File',
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
            'name' => 'user_agent',
            'type' => 'text',
            'options' => [
                'label' => 'User Agent',
            ],
        ]);
        
        $this->add([
            'name' => 'parent',
            'type' => 'hidden',
        ]);  
        
        /*$this->add([
            'name' => 'created_at',
            'type' => Element\DateTime::class,
            'options' => [
                'label' => 'Date/Time',
                'format' => 'Y-m-d H:i:s',
            ],
        ]);*/
        
        $this->add([
            'name' => 'captcha',
            'type' => 'Zend\Form\Element\Captcha',
            'options' => [
                'label' => 'Captcha',
                'captcha' => new Captcha\Dumb(),
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
