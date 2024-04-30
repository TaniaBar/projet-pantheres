<?php

namespace App\Controller;

use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile', name: 'profile_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $recent_orders = $em->getRepository(Orders::class)->findBy(['user' => $user]);

        $reference = null;
        $createdAt = null;
        if (!empty($recent_orders)) {
            $firstOrder = $recent_orders[0];
            $reference = $firstOrder->getReference();
            $createdAt = $firstOrder->getCreatedAt();
            // dd($firstOrder); 
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'recent_orders' => $recent_orders,
            'reference' => $reference,
            'created_at' => $createdAt,
        ]);
    }
}
