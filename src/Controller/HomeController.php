<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Spot;
use App\Entity\Text;
use App\Form\TextType;
use App\Manager\TextManager;
use App\Repository\ImageRepository;
use App\Repository\SpotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use function sprintf;
use function unlink;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(TextManager $texts): Response
    {
        return $this->render('home/index.html.twig', [
            'landingText' => $texts->getByKey('landing'),
        ]);
    }

    #[Route('/spots', name: 'spots', methods: ['GET'])]
    public function spots(SpotRepository $repository, TextManager $texts): Response
    {
        return $this->render('spots/index.html.twig', [
            'spotsIntro' => $texts->getByKey('spots_intro'),
            'spotsRecommendations' => $texts->getByKey('spots_recommendations'),
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
            'importantNotices' => $texts->getByKey('important_notices'),
            'generalFrameContent' => $texts->getByKey('general_frame'),
        ]);
    }

    #[Route('/association', name: 'association', methods: ['GET'])]
    public function association(TextManager $texts): Response
    {
        return $this->render('association/index.html.twig', [
            'associationIntro' => $texts->getByKey('association_intro'),
            'associationBody' => $texts->getByKey('association_body'),
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
            'intro1' => $texts->getByKey('meteo_intro_1'),
            'intro2' => $texts->getByKey('meteo_intro_2'),
            'body' => $texts->getByKey('meteo_body'),
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

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/text/{id}', name: 'update_text', methods: ['GET', 'POST'])]
    public function updateText(Request $request, Text $text, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TextType::class, $text, [
            'action' => $this->generateUrl('update_text', ['id' => $text->getId()]),
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->render('components/_text_content.html.twig', ['text' => $text]);
        }

        return $this->renderForm('components/_text_form.html.twig', ['form' => $form]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/image/{id}/remove', name: 'remove_image', methods: ['GET'])]
    public function removeImage(Image $image, EntityManagerInterface $em, string $publicDir): RedirectResponse
    {
        unlink(sprintf('%s/%s', $publicDir, $image->getUrl()));
        $em->remove($image);
        $em->flush();

        return $this->redirectToRoute('gallery');
    }
}
