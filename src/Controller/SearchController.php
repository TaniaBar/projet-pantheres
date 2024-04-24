<?php

namespace App\Controller;

use App\Entity\Wines;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    // #[Route('/search', name: 'app_search')]
    // public function index(Request $request): Response
    // {
    //     $searchTerm = $request->query->get('q');

        // $wines = $this->getDoctrine()
            // ->getRepository(Wines::class)
            // ->findBySearchTerm($searchTerm); // Metodo da implementare

        // return $this->render('search/results.html.twig', [
        //     'wines' => $wines,
        // ]);

        // return $this->render('search/index.html.twig', [
        //     'controller_name' => 'SearchController',
        // ]);
    // }
}
