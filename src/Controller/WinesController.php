<?php

namespace App\Controller;

use App\Entity\Wines;
use App\Repository\WinesRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/wines', name: 'app_wines_')]
class WinesController extends AbstractController
{
    #[Route('/', name: 'index')]
    // public function index(EntityManagerInterface $entityManager): Response
    // {
    //     $wines = $entityManager->getRepository(Wines::class)->findAll();

    //     return $this->render('wines/index.html.twig', [
    //         'wines' => $wines,
    //     ]);
    // }
    public function index(EntityManagerInterface $entityManager): Response
    {
        $wines = $entityManager->getRepository(Wines::class)->findAllByPriceAsc();
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
        ]);
    }

    #[Route('/category/{category}', name: 'find_category')]
    public function findCategory(CategoriesRepository $categoriesRepo, WinesRepository $winesRepo, string $category): Response
    {
        $categoryEntity = $categoriesRepo->findOneBy(['name' =>$category]);

        if(!$categoryEntity) {
            throw $this->createNotFoundException('catégorie de vin introuvable');
        }

        $wines = $winesRepo->findBy(['categories' => $categoryEntity]);

        return $this->render('wines/index.html.twig', [
            'wines' => $wines,
            'category' => ucfirst($category),
        ]);
    }

    #[Route('/wines/filter', name: 'filter')]
    public function filter(Request $request, WinesRepository $winesRepo): Response
    {
        // Valori di esempio, puoi prenderli dal form o da altre fonti
        $minPrice = $request->query->get('minPrice', 0);
        $maxPrice = $request->query->get('maxPrice', 1000);

        $wines = $winesRepo->findByPriceRange($minPrice, $maxPrice);

        return $this->render('wines/filterPrix.html.twig', [
            'wines' => $wines,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
}


