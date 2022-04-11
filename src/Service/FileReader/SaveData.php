<?php
// src/Service/FileReader/JsonFile.php
namespace App\Service\FileReader;

class SaveData
{
    public function save($entityManager, $user, $datas, $isXml = null)
    {
        foreach($datas as $data){
            if($isXml){
                $data = (array) $data;
            }

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
        
    }
}