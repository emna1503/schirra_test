<?php
// src/Service/FileReader/JsonFile.php
namespace App\Service\FileReader;

class JsonFile implements IFileReader
{
    public function readFile($fileType):array
    {        
        $json = file_get_contents('C:\xampp\htdocs\schirra_test\public\files\file1');
        // var_dump($json);
        // Decode the JSON file
        $jsonData = json_decode($json,true);
        return $jsonData;
    }
}