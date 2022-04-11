<?php
// src/Controller/IndexController.php
namespace App\Controller;

use App\Entity\FileData;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Users;
use App\Form\FileDataType;
use App\Service\FileReader\FileReader;
use App\Service\FileReader\JsonFile;
use App\Service\FileReader\XmlFile;
use App\Service\FileReader\XslFile;
use App\Service\FileUploader as ServiceFileUploader;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FileUploadError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/emna", name="schirra_test")
     */
    public function read(ManagerRegistry $doctrine)
    {
        // $fileType = $this->getParameter('app.file_type');
        // $xmlFile = new XmlFile();
        // $jsonFile = new JsonFile(); 
        // $xslFile = new XslFile(); 
        // // $fileReader = new FileReader($jsonFile, $fileType);
        // // $fileReader = new FileReader($xmlFile, $fileType);
        // $fileReader = new FileReader($xslFile, $fileType);
        // $fileReader->readFileType($doctrine);   
    
        // return $this->render('home.html.twig');
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function new(Request $request, ServiceFileUploader $fileUploader, ManagerRegistry $doctrine)
    {
        $fileData = new FileData;
        $form = $this->createForm(FileDataType::class, $fileData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $fileName = $form->get('name')->getData();

            if ($fileName) {
                $file = $fileUploader->upload($fileName, $doctrine);
                $fileData->setName($file);
                // $fileType = $this->getParameter('app.file_type');
                // $xmlFile = new XmlFile();
                // $jsonFile = new JsonFile(); 
                // $xslFile = new XslFile(); 
                // if($jsonFile->isJson())//ken json taaml lecture json , ken xml taaml lecture xml ..
                // $fileReader = new FileReader($jsonFile, $fileType);
                // $fileReader = new FileReader($xmlFile, $fileType);
                // $fileReader = new FileReader($xslFile, $fileType);
                // $fileReader->readFileType($doctrine);  
            }
        }

        
        return $this->renderForm('home.html.twig', [
            'form' => $form,
        ]);
    }
}