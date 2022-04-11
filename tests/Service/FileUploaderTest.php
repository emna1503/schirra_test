<?php

namespace Tests\Service;

use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;


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
        $this->jsonFile = new UploadedFile('/path/to/file.json', 'file.json', 'application/json', filesize("'/path/to/file.json'"));
        $this->xmlFile = new UploadedFile('/path/to/file.xml', 'file.json', 'application/xml', filesize("'/path/to/file.xml'"));
        $this->csvFile = new UploadedFile('/path/to/file.csv', 'file.json', 'text/csv', filesize("'/path/to/file.csv'"));


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
        $rndXml = '<?xml version="1.0" encoding="UTF-8"?><root><string>Hello World</string></root>';
        $rndCsv = 'string Hello World';

        $isJson = $this->fileUploader->getDataFileType($rndJson);
        $isXml = $this->fileUploader->getDataFileType($rndXml);
        $isCsv = $this->fileUploader->getDataFileType($rndCsv);

        $this->assertTrue($isJson, 'Could not detect JSON correctly');
        $this->assertTrue($isXml, 'Could not detect XML correctly');
        $this->assertTrue($isCsv, 'Could not detect CSV correctly');
    }
}