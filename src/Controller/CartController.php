<?php

namespace App\Controller;

use App\Entity\Wines;
use App\Repository\WinesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, WinesRepository $winesRepository)
    {
        $panier = $session->get('panier', []);
        // dd($panier);

        $data = [];
        $total = 0;
        
        foreach($panier as $id => $quantity) {
            $wine = $winesRepository->find($id);

            $data[] = [
                'wine' => $wine,
                'quantity' => $quantity,
            ];
            $total += $wine->getPrice() * $quantity;
        }
        // dd($data);
        return $this->render('cart/index.html.twig', compact('data', 'total'));
    }


    #[Route('/add/{id}', name: 'add')]
    public function add(Wines $wines, SessionInterface $session)
    {  
        // recuperer id wine
        $id = $wines->getId();

        // on recuper le panier s'il exist deja
        $panier = $session->get('panier', []);

        // on ajout le produit dans le panier s'il n'y est pas encore, sinon on increment la quantité
        if(empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);
        // dd($session);

        return $this->redirectToRoute('cart_index');
    }
}
