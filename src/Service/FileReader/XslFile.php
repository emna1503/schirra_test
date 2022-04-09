<?php
// src/Service/FileReader/XslFile.php
namespace App\Service\FileReader;

use App\Entity\Users;

class XslFile implements IFileReader
{
    public function readFile($fileType,  $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $xsl = file_get_contents('C:\xampp\htdocs\schirra_test\public\files\file3');
        $row = 1;
        if (($handle = fopen("C:/xampp/htdocs/schirra_test/public/files/file3", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                // for ($c=0; $c < $num; $c++) {
                    // echo $c.' '.$data[$c].' '.$row .'<br>';
                    // echo $data[$c] . "<br />\n";
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

        // foreach($xmlDataObjects as $data){
        //     $data = (array) $data;
        //     $user = new Users;
        //     $user->setName($data['name']); 
        //     $user->getHeight($data['height']); 
        //     $user->setMass($data['mass']); 
        //     $user->setHairColor($data['hair_color']); 
        //     $user->setSkinColor($data['skin_color']); 
        //     $user->setEyeColor($data['eye_color']); 
        //     $user->setBirthYear($data['birth_year']); 
        //     $user->setGender($data['gender']); 
    
        //     $entityManager->persist($user);
        //     $entityManager->flush();
        // }
    }
}
