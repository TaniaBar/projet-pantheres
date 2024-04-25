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
        $winesWithDiscount = $entityManager->getRepository(Wines::class)->createQueryBuilder('w')
        ->where('w.discount > 0')
        ->getQuery()
        ->getResult();

        return $this->render('home/index.html.twig', [
            
            'wines' => $winesWithDiscount,
        ]);
    }
}
