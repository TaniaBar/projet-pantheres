<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\OrdersDetails;
use Symfony\Component\Uid\Uuid;
use App\Repository\BoxesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/box-orders', name: 'box_orders_')]
class BoxOrdersController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(SessionInterface $session, BoxesRepository $boxesRepository, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);

        if($panier === []) {
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_home');
        }

        $boxOrder = new Orders();

        $boxOrder->setCreatedAt(new \DateTimeImmutable());
        $boxOrder->setUser($this->getUser());
        $boxOrder->setReference('ORD-' . Uuid::v4());

        foreach($panier as $item => $quantity) {
            $boxOrderDetails = new OrdersDetails();

            $box = $boxesRepository->find($item);
            $price = $box->getPrice();

            $boxOrderDetails->setBoxes($box);
            $boxOrderDetails->setPrice($price);
            $boxOrderDetails->setQuantity($quantity);

            $boxOrder->addOrdersDetail($boxOrderDetails);
        }

        $em->persist($boxOrder);
        $em->flush();

        $session->remove('panier');

        $this->addFlash('message', 'Commande crée avec succes');

        return $this->render('box_orders/index.html.twig', [
            'controller_name' => 'BoxOrdersController',
        ]);
    }
}
