<?php
// src/Service/FileReader/FileReader.php
namespace App\Service\FileReader;

class FileReader
{
    private $fileReader;
    private $fileType;

    public function __construct(IFileReader $fileReader , $contentFile)
    {
        $this->fileReader = $fileReader;
        $this->fileType = $contentFile;
    }

    public function setFileReader($fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function readFileType()
    {
        $this->fileReader->readFile($this->fileType);
    }
    
}
