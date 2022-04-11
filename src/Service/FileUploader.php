<?php

namespace App\Tests\Service;

use App\Services\FileUploader;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


class FileUploaderTest extends KernelTestCase
{
    /**
     * @var UploadedFile
     */
    private $jsonFile;
    /**
     * @var UploadedFile
     */
    private $xmlFile;
    /**
     * @var UploadedFile
     */
    private $csvFile;
    /**
     * @var FileUploader
     */
    private $fileUploader;

    public function __construct()
    {
        $this->jsonFile = new UploadedFile('C:\xampp\htdocs\schirra_test\public\files\file1', 'file.json', 'application/json', filesize("'/path/to/file.json'"));
        $this->xmlFile = new UploadedFile('C:\xampp\htdocs\schirra_test\public\files\file2', 'file.json', 'application/xml', filesize("'/path/to/file.xml'"));
        $this->csvFile = new UploadedFile('C:\xampp\htdocs\schirra_test\public\files\file3', 'file.json', 'text/csv', filesize("'/path/to/file.csv'"));


        self::bootKernel();

        $container = static::getContainer();

        $this->fileUploader = $container->get(FileUploader::class);
    }

    public function testUpload()
    {
        $resultingFile = $this->fileUploader->upload($this->xmlFile);

        $this->assertNotEmpty($resultingFile, 'The file was not uploaded.');

    }

    public function testRecognition()
    {
        $rndJson = '{"string":"Hello World"}';
        $rndXml = '<?xml version="1.0" encoding="UTF-8"?>
<root><string>Hello World</string></root>';
        $rndCsv = 'string
Hello World';

        $isJson = $this->fileUploader->getDataFileType($rndJson);
        $isXml = $this->fileUploader->getDataFileType($rndXml);
        $isCsv = $this->fileUploader->getDataFileType($rndCsv);

        $this->assertTrue($isJson, 'Could not detect JSON correctly');
        $this->assertTrue($isXml, 'Could not detect XML correctly');
        $this->assertTrue($isCsv, 'Could not detect CSV correctly');
    }

    // public function testGetDataFileType($data)
    // {
    //     $slug = 'file1';
    //     $fileUploader = new FileUploader('C:\xampp\htdocs\schirra_test\public\files', FileUploader::JSON_DATA);
    //     $result = $fileUploader->getDataFileType();

    //     $this->assertSame(true, $result);
    // }
}