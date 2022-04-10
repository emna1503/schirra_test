<?php
// src/Controller/IndexController.php
namespace App\Controller;

use App\Entity\FileData;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\FileDataType;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */

    public function addNewFile(Request $request, FileUploader $fileUploader, ManagerRegistry $doctrine)
    {
        $fileData = new FileData;
        $form = $this->createForm(FileDataType::class, $fileData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileName = $form->get('name')->getData();

            if ($fileName) {
                $file = $fileUploader->upload($fileName, $doctrine);
                $fileData->setName($file);
            }
        }
        
        return $this->renderForm('home.html.twig', [
            'form' => $form,
        ]);
    }
}