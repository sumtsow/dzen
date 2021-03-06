<?php
namespace Application\Model;

use DomainException;
use Zend\Filter\DateTimeFormatter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;
use Zend\Validator\EmailAddress;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
use Zend\Validator\Uri;

class Comment implements InputFilterAwareInterface
{
	public $id;
	public $user_name;	
	public $user_ip;
        public $user_agent;
	public $email;
        public $home_page;
	public $text;
        public $file;
	public $parent;
        public $created_at;
        
        public $children;

        private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id           = !empty($data['id']) ? $data['id'] : null;
        $this->user_name    = !empty($data['user_name']) ? $data['user_name'] : null;
        $this->user_ip      = !empty($data['user_ip']) ? $data['user_ip'] : $_SERVER['REMOTE_ADDR'];
        $this->user_agent   = !empty($data['user_agent']) ? $data['user_agent'] : $_SERVER['HTTP_USER_AGENT'];
        $this->email        = !empty($data['email']) ? $data['email'] : null;
        $this->home_page    = !empty($data['home_page']) ? $data['home_page'] : null;
        $this->text         = !empty($data['text']) ? $data['text'] : null;
        $this->parent       = !empty($data['parent']) ? $data['parent'] : 0;
        $this->created_at   = !empty($data['created_at']) ? $data['created_at'] : date("Y-m-d H:i:s");
        
        if(!empty($data['file_name'])) {
            $this->file['name'] = $data['file_name'];
        }
        elseif(!empty($data['file']['name'])) {
            $this->file_name = $data['file']['name'];
        }
        
        if(!empty($data['file_type'])) {
            $this->file['type'] = $data['file_type'];
        }
        elseif(!empty($data['file']['type'])) {
            $this->file_type = $data['file']['type'];
        }
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }
  
    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'user_name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 4,
                        'max' => 128,
                    ],
                ],
                [
                    'name' => Regex::class,
                    'options' => ['pattern' => '/^[a-zA-Z\d]+$/'],
                ],                
            ],
        ]);

        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,

                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 5,
                        'max' => 128,
                    ],
                ],
                [
                    'name' => EmailAddress::class,
                    'type' => 'EmailAddress',
                ],          
            ],
        ]);

        $inputFilter->add([
            'name' => 'home_page',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 0,
                        'max' => 128,
                    ],
                ],
                [
                    'name' => Uri::class,
                    'options' => [
                        'allowAbsolute' => true,
                        'AllowRelative' => false,
                        ],                    
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'text',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 65535,
                    ],
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'created_at',
            'required' => false,
            'filters' => [
                ['name' => DateTimeFormatter::class]
            ],
            'validators' => [
                [
                    'name' => Date::class,
                    'type' => 'date',
                    'options' => [
                        'format' => 'Y-m-d H:i:s',
                    ],
                ]  
            ]
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
