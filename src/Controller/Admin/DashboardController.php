<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(private readonly AdminUrlGenerator $adminUrlGenerator)
    {
    }

    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(SpotCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Akr')
            ->setFaviconPath('favicon.ico');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkTo(SpotCrudController::class, 'spots', 'fas fa-umbrella-beach');
        yield MenuItem::linkTo(PageCrudController::class, 'pages', 'fas fa-scroll');
        yield MenuItem::linkTo(SectionCrudController::class, 'sections', 'fas fa-bars');
        yield MenuItem::linkTo(TextCrudController::class, 'texts', 'fas fa-pencil');
        yield MenuItem::linkTo(UserCrudController::class, 'users', 'fas fa-users');
        yield MenuItem::linkTo(ImageCrudController::class, 'gallery', 'fas fa-image');
        yield MenuItem::linkToRoute('upload_photos', 'fas fa-image', 'upload_photos');
    }
}
