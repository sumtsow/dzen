<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Services;

/**
 * Description of ImageManager
 *
 * @author https://olegkrivtsov.github.io/using-zend-framework-3-book/html/ru/
 * Выгрузка_файлов_на_сервер_с_помощью_форм/Пример__Image_Gallery.html
 * #Добавление_правил_валидации_к_модели_ImageForm
 */

class ImageManager 
{
    // Каталог, куда мы сохраняем файлы изображений.
    private $saveToDir = './public/files/img/';
        
    // Возвращаем путь к каталогу, куда мы сохраняем файлы изображений.
    public function getSaveToDir() 
    {
        return $this->saveToDir;
    }
    
        // Возвращает массив имен выгруженных на сервер файлов.
    public function getSavedFiles() 
    {
        // Каталог, куда мы планируем сохранять выгруженные файлы..
        
        // Проверяем, существует ли уже каталог, и, если нет, то
        // создаем его.
        if(!is_dir($this->saveToDir)) {
            if(!mkdir($this->saveToDir)) {
                throw new \Exception('Could not create directory for uploads: ' . 
                             error_get_last());
            }
        }
        
        // Просматриваем каталог и создаем список выгруженных файлов. 
        $files = [];        
        $handle  = opendir($this->saveToDir);
        while (false !== ($entry = readdir($handle))) {
            
            if($entry=='.' || $entry=='..')
                continue; // Пропускаем текущий и родительский каталоги.
            
            $files[] = $entry;
        }
        
        // Возвращаем список выгруженных файлов.
        return $files;
    }
    
        // Возвращает путь к сохраненному файлу изображения.
    public function getImagePathByName($fileName) 
    {
        // Принимаем меры предосторожности, чтобы сделать файл безопасным.
        $fileName = str_replace("/", "", $fileName);  // Убираем слеши.
        $fileName = str_replace("\\", "", $fileName); // Убираем обратные слеши.
                
        // Возвращаем сцепленные имя каталога и имя файла.
        return $this->saveToDir . $fileName;                
    }
  
    // Возвращает содержимое файла изображения. При ошибке возвращает булевое false. 
    public function getImageFileContent($filePath) 
    {
        return file_get_contents($filePath);
    }
    
    // Извлекает информацию о файле (размер, MIME-тип) по его пути.
    public function getImageFileInfo($filePath) 
    {
        // Пробуем открыть файл        
        if (!is_readable($filePath)) {            
            return false;
        }
            
        // Получаем размер файла в байтах.
        $fileSize = filesize($filePath);

        // Получаем MIME-тип файла.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $filePath);
        if($mimeType===false)
            $mimeType = 'application/octet-stream';
    
        return [
            'size' => $fileSize,
            'type' => $mimeType 
        ];
    }
  
    //  Изменяет размер изображения, сохраняя соотношение сторон.
    public  function resizeImage($filePath, $desiredWidth = 320) 
    {
        // Получаем исходную размерность файла.
        list($originalWidth, $originalHeight) = getimagesize($filePath);

        // Вычисляем соотношение сторон.
        $aspectRatio = $originalWidth/$originalHeight;
        // Вычисляем получившуюся высоту.
        $desiredHeight = $desiredWidth/$aspectRatio;

        // Получаем информацию об изображении
        $fileInfo = $this->getImageFileInfo($filePath);
        
        // Изменяем размер изображения.
        $resultingImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
        if (substr($fileInfo['type'], 0, 9) =='image/png')
            $originalImage = imagecreatefrompng($filePath);
        else
            $originalImage = imagecreatefromjpeg($filePath);
        imagecopyresampled($resultingImage, $originalImage, 0, 0, 0, 0, 
                $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

        // Сохраняем измененное изображение во временное хранилище.
        $tmpFileName = tempnam("/tmp", "FOO");
        imagejpeg($resultingImage, $tmpFileName, 80);
        
        // Возвращаем путь к получившемуся изображению.
        return $tmpFileName;
    }
}