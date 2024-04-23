<?php

namespace App\Controller;

use App\Entity\Suppliers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/suppliers', name: 'app_suppliers_')]
class SuppliersController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $suppliers = $entityManager->getRepository(Suppliers::class)->findAll();

        return $this->render('suppliers/index.html.twig', [
            'suppliers' => $suppliers,
        ]);
    }
}
