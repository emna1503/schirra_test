<?php
// src/Service/FileReader/JsonFile.php
namespace App\Service\FileReader;

use App\Entity\Users;

class JsonFile {

    public function readFile($fileContent, $entityManager)
    {        
        // Decode the JSON file
        $jsonData = json_decode($fileContent['content'],true);

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