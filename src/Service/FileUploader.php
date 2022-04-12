<?php
// src/Service/FileUploader.php
namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    const JSON_DATA = 'json';
    const XML_DATA = 'xml';
    const XSL_DATA = 'xsl';

    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename;

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    
    //check file type before uploading
    public function getDataFileType($data){
        json_decode($data);

        if(json_last_error() === JSON_ERROR_NONE){
            return self::JSON_DATA;
        }elseif(substr($data, 0, 5) == "<?xml"){
            return self::XML_DATA;
        }else{
            return self::XSL_DATA;
        }
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}