<?php

namespace App\Controller;

use App\Manager\TextManager;
use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TextManager $texts): Response
    {
        return $this->render('home/index.html.twig', [
            'landingText' => $texts->getContent('landing'),
        ]);
    }

    #[Route('/spots', name: 'spots')]
    public function spots(SpotRepository $repository, TextManager $texts): Response
    {
        return $this->render('spots/index.html.twig', [
            'spotsIntro' => $texts->getContent('spots_intro'),
            'spotsRecommendations' => $texts->getContent('spots_recommendations'),
            'spots' => $repository->findAll()
        ]);
    }

    #[Route('/general-rules', name: 'general_rules')]
    public function generalRules(TextManager $texts): Response
    {
        return $this->render('general_rules/index.html.twig', [
            'importantNotices' => $texts->getContent('important_notices'),
            'generalFrameContent' => $texts->getContent('general_frame'),
        ]);
    }
}
