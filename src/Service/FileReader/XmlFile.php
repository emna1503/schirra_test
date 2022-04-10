<?php
// src/Service/FileReader/XmlFile.php
namespace App\Service\FileReader;

use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use SimpleXMLElement;


class XmlFile implements IFileReader
{
    public function readFile($contentFile, $entityManager)
    {
        $xmlReader = new SimpleXMLElement($contentFile['content']);
        $xmlData = (array) $xmlReader->results;
        $xmlDataObjects = (array) $xmlData["result"];

        foreach($xmlDataObjects as $data){
            $data = (array) $data;
            $user = new Users;
            $user->setName($data['name']); 
            $user->getHeight($data['height']); 
            $user->setMass($data['mass']); 
            $user->setHairColor($data['hair_color']); 
            $user->setSkinColor($data['skin_color']); 
            $user->setEyeColor($data['eye_color']); 
            $user->setBirthYear($data['birth_year']); 
            $user->setGender($data['gender']); 
    
            $entityManager->persist($user);
            $entityManager->flush();
        }
        unlink($contentFile['linkfile']);
    }
}