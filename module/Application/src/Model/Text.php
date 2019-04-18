<?php
namespace Application\Model;

use Application\Model\Comment;
use Zend\InputFilter\InputFilter;
use Zend\Http\PhpEnvironment\Request;

class Text extends Comment
{
    public $file;

    private $inputFilter;
  
    // Возвращает путь к каталогу сохранения файлов
    static function getSaveToDir() 
    {
        $request = new Request();
        return $request->getServer('DOCUMENT_ROOT').'/files/txt/';
    }
    
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
                        'target'=>self::getSaveToDir(),
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
