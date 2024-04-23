<?php

namespace App\Controller;

use App\Entity\Boxes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/boxes', name: 'app_boxes_')]
class BoxesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $boxes = $entityManager->getRepository(Boxes::class)->findAll(); 
        
        return $this->render('boxes/index.html.twig', [
            'boxes' => $boxes,
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(Boxes $box): Response
    {
       
        // dd($boxes);
        return $this->render('boxes/details.html.twig', [
            'box' => $box,  
            ]
        );
    }
}
