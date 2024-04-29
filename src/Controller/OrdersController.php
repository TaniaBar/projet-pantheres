<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\OrdersDetails;
use App\Repository\WinesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/orders', name: 'orders_')]
class OrdersController extends AbstractController
{
    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, WinesRepository $winesRepository, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);
        // dd($panier);
        if($panier === []) {
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_home');
        }

        // si le panier n'est pas vide on crée la commande
        $order = new Orders();

        // on rempli la commande
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setUser($this->getUser());
        $order->setReference('ORD-' . Uuid::v4());

        $totalPrice = 0;

        // on parcourt le panier pour créer le detail de commande
        foreach($panier as $item => $quantity) {
            $orderDetails = new OrdersDetails();

            // on va chercher le produit
            $wine = $winesRepository->find($item);
            // dd($wine);
            $price = $wine->getPrice();

            // on crée le detail de commande
            $orderDetails->setWines($wine);
            $orderDetails->setPrice($price);
            $orderDetails->setQuantity($quantity);

            // on ajout les details dans la commande
            $order->addOrdersDetail($orderDetails);

            $totalPrice += $wine->getPrice() * $quantity;
        }

        $em->persist($order);
        $em->flush();

        $session->remove('panier');

        return $this->render('orders/index.html.twig', [
            'order_reference' => $order->getReference(),
            'order_created_at' => $order->getCreatedAt(),
            'order_total' => $totalPrice,
        ]);
    }
}
