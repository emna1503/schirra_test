<?php
// src/Controller/IndexController.php
namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Users;
use App\Service\FileReader\FileReader;
use App\Service\FileReader\JsonFile;
use App\Service\FileReader\XmlFile;
use App\Service\FileReader\XslFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/emna", name="schirra_test")
     */
    public function read(ManagerRegistry $doctrine)
    {
        $fileType = $this->getParameter('app.file_type');
        $xmlFile = new XmlFile();
        $jsonFile = new JsonFile(); 
        $xslFile = new XslFile(); 
        // $fileReader = new FileReader($jsonFile, $fileType);
        // $fileReader = new FileReader($xmlFile, $fileType);
        $fileReader = new FileReader($xslFile, $fileType);
        $fileReader->readFileType($doctrine);   
    
        return $this->render('home.html.twig');
    }
}