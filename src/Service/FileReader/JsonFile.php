<?php
// src/Service/FileReader/JsonFile.php
namespace App\Service\FileReader;

use App\Entity\Users;

class JsonFile implements IFileReader
{
    public function readFile($fileType, $doctrine):array
    {        
        $json = file_get_contents('C:\xampp\htdocs\schirra_test\public\files\file1');
        // Decode the JSON file
        $jsonData = json_decode($json,true);
        $entityManager = $doctrine->getManager();

        foreach($jsonData["results"] as $data){
            $user = new Users;
            $user->setName($data['name']); 
            $user->setHeight($data['height']); 
            $user->setMass($data['mass']); 
            $user->setHairColor($data['hair_color']); 
            $user->setSkinColor($data['skin_color']); 
            $user->setEyeColor($data['eye_color']); 
            $user->setBirthYear($data['birth_year']); 
            $user->setGender($data['gender']); 
    
            $entityManager->persist($user);
            $entityManager->flush();
        }
        
        return $jsonData;
    }
}