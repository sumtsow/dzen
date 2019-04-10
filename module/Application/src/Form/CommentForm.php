<?php

namespace Album\Form;

use Zend\Form\Form;

class CommentForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('comment');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'user_name',
            'type' => 'text',
            'options' => [
                'label' => 'User Name',
            ],
        ]);
        $this->add([
            'type' => Element\Email::class,
            'name' => 'email',
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
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Add &raquo;',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
