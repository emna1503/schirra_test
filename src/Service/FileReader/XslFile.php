<?php
// src/Service/FileReader/XslFile.php
namespace App\Service\FileReader;

use App\Entity\Users;

class XslFile implements IFileReader
{
    public function readFile($fileType,  $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $row = 1;
        if (($handle = fopen($fileType, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                if($row != 2){
                    $user = new Users;
                    $user->setName($data[0]); 
                    $user->setHeight($data[1].''); 
                    $user->setMass($data[2]);  
                    $user->setHairColor($data[3]); 
                    $user->setSkinColor($data[4]); 
                    $user->setEyeColor($data[5]); 
                    $user->setBirthYear($data[6]); 
                    $user->setGender($data[7]);

                    $entityManager->persist($user);
                    $entityManager->flush();
                }
            }
        fclose($handle);
        }
    }
}
