<?php
namespace Application\Model;

use Application\Model\Comment;
use Zend\InputFilter\InputFilter;
use Zend\Http\PhpEnvironment\Request;

    define('MAX_WIDTH', 320);
    define('MAX_HEIGHT', 240);
    
class Image extends Comment
{
   
    public $file;

    private $inputFilter;
  
    // Возвращает путь к каталогу сохранения файлов изображений
    static function getSaveToDir() 
    {
        $request = new Request();
        return $request->getServer('DOCUMENT_ROOT').'/files/img/';
    }
    
    // Возвращает путь к сохраненному файлу изображения.
    static function getImagePathByName($fName) 
    {
        // Принимаем меры предосторожности, чтобы сделать файл безопасным.
        $fName = str_replace("/", "", $fName);  // Убираем слеши.
        $fName = str_replace("\\", "", $fName); // Убираем обратные слеши.
                
        // Возвращаем сцепленные имя каталога и имя файла.
        return self::getSaveToDir() . $fName;                
    }
    
    // Возвращает содержимое файла изображения или false при ошибке
    static function getImageFileContent($fPath) 
    {
        return file_get_contents($fPath);
    }
    
    // Извлекает информацию о файле (размер, MIME-тип) по его пути.
    static function getImageFileInfo($fPath) 
    {
        // Пробуем открыть файл        
        if (!is_readable($fPath)) {            
            return false;
        }
            
        // Получаем размер файла в байтах.
        $fSize = filesize($fPath);

        // Получаем MIME-тип файла.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $fPath);
        if($mimeType===false)
            $mimeType = 'application/octet-stream';
    
        return [
            'size' => $fSize,
            'type' => $mimeType 
        ];
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
                        'mimeType'  => ['image/jpg', 'image/jpeg', 'image/gif', 'image/png']
                    ]
                ],
                
                [
                    'name'    => 'FileImageSize',
                    'options' => [
                        'minWidth'  => 32,
                        'minHeight' => 24,
                    ]
                ],
            ],
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
    
    //  Изменяет размер изображения, сохраняя соотношение сторон.
    static function resizeImage($fPath) 
    {
        // Получаем исходную размерность файла.
        list($width, $height) = getimagesize($fPath);

        // Вычисляем соотношение сторон.
        $aspectRatio = $width/$height;
        
        if($width > MAX_WIDTH) {
        // Вычисляем получившуюся ширину и высоту.
            $newWidth = MAX_WIDTH;
            $newHeight = $newWidth/$aspectRatio;
        }
        else {
            $newHeight = MAX_HEIGHT;
            $newWidth = $newHeight*$aspectRatio;
        }

        // Получаем информацию об изображении
        $fInfo = self::getImageFileInfo($fPath);
        
        // Изменяем размер изображения.
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        if (substr($fInfo['type'], 0, 9) =='image/png')
            $image = imagecreatefrompng($fPath);
        elseif(substr($fInfo['type'], 0, 9) =='image/gif')
            $image = imagecreatefromgif($fPath);
        else
            $image = imagecreatefromjpeg($fPath);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Сохраняем измененное изображение во временное хранилище.
        $tmpFileName = tempnam("/tmp", "FOO");
        imagejpeg($newImage, $tmpFileName, 80);
        
        // Возвращает путь к получившемуся изображению.
        return $tmpFileName;
    }
    
    static function save($fName) {
        $fPath = self::getImagePathByName($fName);
        list($width, $height) = getimagesize($fPath);
        if($width > MAX_WIDTH or $height > MAX_HEIGHT) {
            $tmpPath = self::resizeImage($fPath);
            unlink($fPath);
        }
        copy($tmpPath, $fPath);
        unlink($tmpPath);
    }
}
