<?php
namespace Application\Model;

class Comment
{
	protected $id;
	public $user_name;	
	public $user_ip;
	public $email;
        public $home_page;
	public $text;
	public $parent;	
        public $created_at;
        public $updated_at;        

    public function exchangeArray($data)
    {
        $this->user_name = !empty($data['user_name']) ? $data['user_name'] : null;
        $this->user_ip = !empty($data['user_ip']) ? $data['user_ip'] : null;
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->home_page = !empty($data['home_page']) ? $data['home_page'] : null;
        $this->text = !empty($data['text']) ? $data['text'] : null;
        $this->parent = !empty($data['parent']) ? $data['parent'] : null;
    }

/*    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
	
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'id_school',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'author',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
			
            $inputFilter->add($factory->createInput(array(
                'name'     => 'text',
                'required' => false,
                'filters'  => array(
                    //array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 0,
                            'max'      => 1023,
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'visible',
                'required' => false,
            )));
			
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
*/    
}
