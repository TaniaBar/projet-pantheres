<?php

namespace App\Controller;

use App\Entity\Wines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wines', name: 'app_wines_')]
class WinesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $wines = $entityManager->getRepository(Wines::class)->findAll();

        return $this->render('wines/index.html.twig', [
            'wines' => $wines,
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(Wines $wine): Response
    {
        $supplier = $wine->getSuppliers();
        // dd($wine);
        return $this->render('wines/details.html.twig', [
            'wine' => $wine,
            'supplier' => $supplier,
        ]
        //  compact('wine'),
        );
    }
}
