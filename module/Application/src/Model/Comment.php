<?php
namespace Application\Model;

use Application\Model\CommentTable;

class Comment
{
	public $id;
	public $user_name;	
	public $user_ip;
	public $email;
        public $home_page;
	public $text;
	public $parent;	
        public $created_at;
        public $updated_at;
        public $children;

    public function exchangeArray($data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->user_name = !empty($data['user_name']) ? $data['user_name'] : null;
        $this->user_ip = !empty($data['user_ip']) ? $data['user_ip'] : null;
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->home_page = !empty($data['home_page']) ? $data['home_page'] : null;
        $this->text = !empty($data['text']) ? $data['text'] : null;
        $this->parent = !empty($data['parent']) ? $data['parent'] : null;
        $this->created_at = !empty($data['created_at']) ? $data['created_at'] : null;
        $this->updated_at = !empty($data['updated_at']) ? $data['updated_at'] : null;        
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }
    
/*    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
 */
    
    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => false,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

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
            ],
        ]);

        $inputFilter->add([
            'name' => 'home_page',
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
                        'min' => 8,
                        'max' => 128,
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
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
