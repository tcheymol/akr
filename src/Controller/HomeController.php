<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/spots', name: 'spots')]
    public function spots(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/general-rules', name: 'general_rules')]
    public function generalRules(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
