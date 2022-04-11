<?php
// src/Service/FileReader/JsonFile.php
namespace App\Service\FileReader;

use App\Entity\Users;

class JsonFile implements IFileReader
{
    public function readFile($fileType, $doctrine)
    {        
        $json = file_get_contents($fileType);
        $jsonData = json_decode($json,true);
        $entityManager = $doctrine->getManager();
        $dataEntityManager = new DataEntityManager;
        $datas = $jsonData["results"];
        $dataEntityManager->save($entityManager, $datas);
    }
}