<?php
namespace Application\Model;

use Application\Model\Comment;
use DomainException;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\FileMimeType;
use Zend\Validator\FileImageSize;

class Image extends Comment
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
                        'mimeType'  => ['image/jpg', 'image/jpeg', 'image/gif', 'image/png']
                    ]
                ],
                
                [
                    'name'    => 'FileImageSize',
                    'options' => [
                        'minWidth'  => 32,
                        'minHeight' => 24,
                        'maxWidth'  => 320,
                        'maxHeight' => 240,
                    ]
                ],
            ],
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
