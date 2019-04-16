<?php
namespace Application\Model;

use Application\Model\Comment;
use DomainException;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\FileMimeType;
use Zend\Validator\FileSize;

class Text extends Comment
{
    public $file;

    private $inputFilter;
  
    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();
        
        $inputFilter->add([
            'name' => 'file',
            'type'     => 'Zend\InputFilter\FileInput',
            'required' => false,
            'filters'  => [                    
                [
                    'name' => 'FileRenameUpload',
                    'options' => [  
                        'target'=>'./public/files',
                        'useUploadName'=>true,
                        'useUploadExtension'=>true,
                        'overwrite'=>true,
                        'randomize'=>false
                    ]
                ]
            ], 
            'validators' => [
                [
                    'name' => 'FileMimeType',                        
                        'options' => [                            
                        'mimeType'  => ['text/plain']
                    ]
                ],
                
                [
                    'name' => 'FileSize',
                    'options' => [
                        'max' => '100kB',
                    ],
                ],
            ],
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
