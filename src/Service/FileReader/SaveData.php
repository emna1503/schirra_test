<?php
// src/Service/FileReader/JsonFile.php
namespace App\Service\FileReader;

use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;

class SaveData
{
    private $xmlFile;
    private $jsonFile;
    private $xlsFile;

    public function __construct(XmlFile $xmlFile, JsonFile $jsonFile, XslFile $xlsFile )
    {
        $this->xmlFile = $xmlFile;
        $this->jsonFile = $jsonFile;
        $this->xlsFile = $xlsFile;
    }

    public function save($entityManager, $user, $datas)
    {
        switch ($datas['extension'])
        {
            case 'json':
                $jsonFileService = $this->jsonFile->readFile($datas , $entityManager);
            break;
            case 'xml':
                $xmlFileService = $this->xmlFile->readFile($datas , $entityManager);
            break;
            default:
                $xlsFileService = $this->xlsFile->readFile($datas , $entityManager);
            break;
        }       
    }
}