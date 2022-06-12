<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Manager\TextManager;
use App\Repository\ImageRepository;
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

    #[Route('/spots/{id}', name: 'spot')]
    public function spot(Spot $spot): Response
    {
        return $this->render('spots/show.html.twig', [
            'spot' => $spot,
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

    #[Route('/association', name: 'association')]
    public function association(TextManager $texts): Response
    {
        return $this->render('association/index.html.twig', [
            'pitch' => $texts->getContent('pitch'),
            'office' => $texts->getContent('office'),
            'licences' => $texts->getContent('licences'),
            'events' => $texts->getContent('events'),
        ]);
    }

    #[Route('/navigate', name: 'navigate')]
    public function navigate(TextManager $texts): Response
    {
        return $this->render('navigate/index.html.twig', [
            'begin' => $texts->getContent('begin'),
            'lessons' => $texts->getContent('lessons'),
            'general' => $texts->getContent('general'),
        ]);
    }

    #[Route('/gallery', name: 'gallery')]
    public function gallery(ImageRepository $imageRepository): Response
    {
        return $this->render('gallery/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }
}
