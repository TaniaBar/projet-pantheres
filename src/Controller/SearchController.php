<?php

namespace App\Controller;

use App\Entity\Wines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/search', name: 'app_search_')]
class SearchController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // #[Route('/', name: 'index')]
    // public function index(Request $request): Response
    // {
    //     $searchTerm = $request->query->get('q');

    //     $wines = $this->entityManager
    //         ->getRepository(Wines::class)
    //         ->findBySearchTerm($searchTerm);

    //         $suppliers = [];
    //         foreach ($wines as $wine) {
    //             $suppliers[] = $wine->getSuppliers();
    //         }

    //     return $this->render('search/index.html.twig', [
    //         'wines' => $wine,
    //         'supplier' => $suppliers,
    //     ]);

    // }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $searchTerm = $request->query->get('q');

        $wines = $this->entityManager
            ->getRepository(Wines::class)
            ->findOneBySearchTerm($searchTerm);

        if (!$wines) {
            return $this->render('search/index.html.twig', [
                'error' => 'No wine found with that search term.',
            ]);
        }

        $supplier = [];
        foreach ($wines as $wine) {
            $supplier[] = $wine->getSuppliers();
        };

        return $this->render('search/index.html.twig', [
            'query' => $searchTerm,
            'wines' => $wines,
            'supplier' => $supplier,
        ]);
    }
}
