<?php

namespace App\Controller;

use App\Entity\Boxes;
use App\Repository\BoxesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/boxcart', name: 'boxcart_')]
class BoxcartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, BoxesRepository $boxesRepository) 
    {
        $panier = $session->get('panier', []);
        // dd($panier);
        $data = [];
        $total = 0;
        //$session->set('panier', []);

        foreach($panier as $id => $quantity) 
        {
            $box = $boxesRepository->find($id); 

            $data[] = [
                'box' => $box,
                'quantity' => $quantity,
            ];
            $total += $box->getPrice() * $quantity;     
        }
        //dd($data);
        return $this->render('boxcart/index.html.twig', compact('data', 'total'));
    }


    #[Route('/add/{id}', name: 'add')]
    public function add(Boxes $box, SessionInterface $session)
    {
        $id = $box->getId();
        $panier = $session->get('panier');
        
        if(empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }
        
        $session->set('panier', $panier);
        //dd($panier);
        return $this->redirectToRoute('boxcart_index');
    }


    
    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Boxes $box, SessionInterface $session)
    {  
      
        $id = $box->getId();
        $panier = $session->get('panier', []);
        
        if(!empty($panier[$id])) {
            if($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);  
        return $this->redirectToRoute('boxcart_index');
    }

    
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Boxes $box, SessionInterface $session)
    {  
        
        $id = $box->getId();

        $panier = $session->get('panier', []);
    
        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('boxcart_index');
    }

   
    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session): Response
    {
        $session->remove('panier');
        return $this->redirectToRoute('boxcart_index');
    }
}
