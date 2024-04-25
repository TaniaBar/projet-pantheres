<?php

namespace App\Controller;

use App\Entity\Wines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $wines = $entityManager->getRepository(Wines::class)->findAll();
                return $this->render('home/index.html.twig', [
            'message' => 'Hello World!',
            'wines' => $wines,
        ]);
    }
}
