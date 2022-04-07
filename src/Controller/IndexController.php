<?php
// src/Controller/IndexController.php
namespace App\Controller;

use App\Service\FileReader\FileReader;
use App\Service\FileReader\JsonFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="schirra_test")
     */
    public function read()
    {
        // $fileType = $this->getParameter('app.file_type');
        // $jsonFile = new JsonFile(); 
        // $fileReader = new FileReader($jsonFile, $fileType);
        // var_dump($fileReader);
        // echo('<br>');
        // var_dump($fileReader->readFileType()); die;
        // var_dump($jsonData);
        // foreach($jsonData as $data){
        //     var_dump($data);
        // }
        return $this->render('home.html.twig');
    }
}