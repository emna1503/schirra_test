<?php
// src/Service/FileReader/FileReader.php
namespace App\Service\FileReader;

interface IFileReader
{
    public function readFile($fileType);
}