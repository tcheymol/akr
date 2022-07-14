<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Spot;
use App\Manager\TextManager;
use App\Repository\ImageRepository;
use App\Repository\SpotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(TextManager $texts): Response
    {
        return $this->render('home/index.html.twig', [
            'landingText' => $texts->getContent('landing'),
        ]);
    }

    #[Route('/spots', name: 'spots', methods: ['GET'])]
    public function spots(SpotRepository $repository, TextManager $texts): Response
    {
        return $this->render('spots/index.html.twig', [
            'spotsIntro' => $texts->getContent('spots_intro'),
            'spotsRecommendations' => $texts->getContent('spots_recommendations'),
            'spots' => $repository->findAll()
        ]);
    }

    #[Route('/spots/{id}', name: 'spot', methods: ['GET'])]
    public function spot(Spot $spot): Response
    {
        return $this->render('spots/show.html.twig', [
            'spot' => $spot,
        ]);
    }

    #[Route('/general-rules', name: 'general_rules', methods: ['GET'])]
    public function generalRules(TextManager $texts): Response
    {
        return $this->render('general_rules/index.html.twig', [
            'importantNotices' => $texts->getContent('important_notices'),
            'generalFrameContent' => $texts->getContent('general_frame'),
        ]);
    }

    #[Route('/association', name: 'association', methods: ['GET'])]
    public function association(TextManager $texts): Response
    {
        return $this->render('association/index.html.twig', [
            'associationIntro' => $texts->getContent('association_intro'),
            'associationBody' => $texts->getContent('association_body'),
        ]);
    }

    #[Route('/gallery', name: 'gallery', methods: ['GET'])]
    public function gallery(ImageRepository $imageRepository): Response
    {
        return $this->render('gallery/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    #[Route('/meteo', name: 'meteo', methods: ['GET'])]
    public function meteo(TextManager $texts): Response
    {
        return $this->render('meteo/index.html.twig', [
            'intro1' => $texts->getContent('meteo_intro_1'),
            'intro2' => $texts->getContent('meteo_intro_2'),
            'body' => $texts->getContent('meteo_body'),
        ]);
    }

    #[Route('/upload-photos', name: 'upload_photos', methods: ['GET', 'POST'])]
    public function uploadPhotos(Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {
        if (Request::METHOD_GET === $request->getMethod()) {
            return $this->render('admin/upload_photos.html.twig');
        }

        /** @var UploadedFile $file */
        foreach ($request->files as $file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $slugger->slug($originalFilename).'-'.uniqid().'.'.$file->guessExtension();
            try {
                $info = getimagesize($file);
                list($x, $y) = $info;
                $image = (new Image())
                    ->setFileName($newFilename)
                    ->setOriginalName($originalFilename)
                    ->setHeight($y)
                    ->setWidth($x);
                $em->persist($image);
                $em->flush();
                $file->move('images', $newFilename);
            } catch (\Exception $e) {
                dd($e);
            }
        }

        return new JsonResponse(['OK' => 'OK']);
    }
}
