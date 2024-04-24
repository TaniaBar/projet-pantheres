<?php

namespace App\Controller\Admin;

use App\Entity\Boxes;
use App\Entity\Categories;
use App\Entity\Images;
use App\Entity\Suppliers;
use App\Entity\User;
use App\Entity\Wines;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet Pantheres');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Coffrets', 'fa-solid fa-box-open', Boxes::class);
        yield MenuItem::linkToCrud('Catégories', 'fa-solid fa-list', Categories::class);
        yield MenuItem::linkToCrud('Fournisseurs', 'fa-solid fa-user', Suppliers::class);
        yield MenuItem::linkToCrud('Vins', 'fa-solid fa-wine-bottle', Wines::class);
        yield MenuItem::linkToCrud('Images', 'fa-solid fa-image', Images::class);
    }
}
