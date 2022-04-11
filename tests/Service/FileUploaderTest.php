<?php

namespace Tests\Service;

use App\Services\FileUploader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploaderTest extends TestCase
{
    // public function testUpload($file){
    //     $this->assertInstanceOf(UploadedFile, $file);
    // }

    public function testUpload(){
        // public $slugger;
        $fileUploader = new FileUploader('C:\xampp\htdocs\schirra_test\public\files', FileUploader::JSON_DATA);
        $result = $fileUploader->upload('file1');

        $this->$this->assertResponseOk();
    }
    public function testGetDataFileType($data){
        $slug = 'file1';
        $fileUploader = new FileUploader('C:\xampp\htdocs\schirra_test\public\files', FileUploader::JSON_DATA);
        $result = $fileUploader->getDataFileType();

        $this->assertSame(true , $result);
    }
}