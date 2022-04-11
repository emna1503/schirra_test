<?php
// src/Service/FileReader/XmlFile.php
namespace App\Service\FileReader;

use App\Entity\Users;
use SimpleXMLElement;
use XMLReader;

class XmlFile implements IFileReader
{
    public function readFile($fileType, $doctrine)
    {
        $xml = file_get_contents($fileType);
        $xmlReader = new SimpleXMLElement($xml);
        $xmlData = (array) $xmlReader->results;
        $xmlDataObjects = (array) $xmlData["result"];
        $entityManager = $doctrine->getManager();
        $dataEntityManager = new DataEntityManager;
        $datas = $xmlDataObjects;
        $dataEntityManager->save($entityManager, $datas, true);
    }
}