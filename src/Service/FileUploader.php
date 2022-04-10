<?php
// src/Service/FileUploader.php
namespace App\Services;

use App\Entity\Users;
use App\Service\FileReader\SaveData;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;
    private $extension;
    private $saveData;
    public function __construct($targetDirectory, SluggerInterface $slugger, SaveData $saveData )
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->saveData = $saveData;
    }
    
    public function upload(UploadedFile $file, $doctrine)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        $user = new Users;
        try {
            $file->move($this->getTargetDirectory(), $fileName);
            $fileUploadReader = $this->readFiles($this->getTargetDirectory()."/".$fileName);
            $entityManager = $doctrine->getManager();
            $this->saveData->save($entityManager, $user, $fileUploadReader);
        } catch (FileException $e) {
            echo('exception something happens during file upload');
        }

        return $fileName;
    }

    public function readFiles($path_file)
    {
        clearstatcache();
        ignore_user_abort(true);
            if (file_exists($path_file)) {
                $fh = fopen($path_file, 'r+');
                while(1) {
                    if (flock($fh, LOCK_EX)) {
                    $contentFile = chop(fread($fh, filesize($path_file)));
                    $contentFile++;
                    rewind($fh);
                    fwrite($fh, $contentFile);
                    fflush($fh);
                    ftruncate($fh, ftell($fh));    
                    flock($fh, LOCK_UN);
                    break;
                    }
                }
            }
            else {
                $fh = fopen($path_file, 'w+');
                fwrite($fh, "1");
                $contentFile="1";
            }
        fclose($fh);
               
        $fileExtension= $this->findFileType($contentFile);
        return  array('linkfile'=>$path_file,'content'=>$contentFile, 'extension'=>$fileExtension);
    }

    public function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function isXml($string)
    {
        if(substr($string, 0, 5) == "<?xml") {
            return true;
        } else {
            return false;
        }
    }
    
    public function findFileType($contentFile)
    {
        if($this->isJson($contentFile) == true){
            $this->extension = 'json';
        }elseif($this->isXml($contentFile) == true){
            $this->extension = 'xml';
        }else{
            $this->extension = 'xls';
        }
        return $this->extension;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}