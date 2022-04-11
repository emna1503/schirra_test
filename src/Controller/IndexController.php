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
     * @Route("/home", name="app_home")
     */
    public function new(Request $request, FileUploader $fileUploader, ManagerRegistry $doctrine)
    {
        $fileData = new FileData;
        $form = $this->createForm(FileDataType::class, $fileData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileType = $this->getParameter('files_directory');
            $fileName = $form->get('name')->getData();

            if ($fileName) {
                $file = $fileUploader->upload($fileName, $doctrine);
                $fileData->setName($file);
                $fileType = $fileType.'/'.$file;
                $datas = file_get_contents($fileType);
                $type = $fileUploader->getDataFileType($datas);

                if($type == $fileUploader::JSON_DATA){
                    $typeFile = new JsonFile;
                }elseif($type == $fileUploader::XML_DATA){
                    $typeFile = new XmlFile;
                }else{
                    $typeFile = new XslFile; 
                }
            
                $fileReader = new FileReader($typeFile, $fileType);
                $fileReader->readFileType($doctrine);  
            }
        }
  
        return $this->renderForm('home.html.twig', [
            'form' => $form,
        ]);
    }
}