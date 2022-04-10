<?php
// src/Service/FileReader/FileReader.php
namespace App\Service\FileReader;

use Doctrine\ORM\EntityManager;

interface IFileReader
{
    public function readFile($fileType ,EntityManager $EntityManager);
}