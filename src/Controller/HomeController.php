<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Spot;
use App\Entity\Text;
use App\Form\TextType;
use App\Manager\TextManager;
use App\Repository\ImageRepository;
use App\Repository\PageRepository;
use App\Repository\SectionRepository;
use App\Repository\SpotRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    public function __construct(private readonly RequestStack $stack, private readonly PageRepository $pageRepository, private readonly SpotRepository $repository, private readonly SectionRepository $sectionRepository, private readonly TextManager $texts, private readonly ImageRepository $imageRepository, private readonly SluggerInterface $slugger, private readonly EntityManagerInterface $em)
    {
    }

    public function header(): Response
    {
        return $this->render('components/_header.html.twig', [
            'pages' => $this->pageRepository->findBy([], ['position' => Criteria::ASC]),
            'mainRequest' => $this->stack->getMainRequest(),
        ]);
    }

    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute('page', ['slug' => 'accueil']);
    }

    #[Route('/page/{slug}', name: 'page', methods: ['GET'])]
    public function licences(string $slug): Response
    {
        return $this->render('page/show.html.twig', ['page' => $this->pageRepository->findOneBySlug($slug)]);
    }

    #[Route('/spots', name: 'spots', methods: ['GET'])]
    public function spots(): Response
    {
        return $this->render('spots/index.html.twig', [
            'spotsIntro' => $this->texts->getByKey('spots_intro'),
            'spotsRecommendationsSection' => $this->sectionRepository->findOneBy(['name' => "Recommandations générales à l'ensemble des spots de l'île"]),
            'spots' => $this->repository->findAll(),
        ]);
    }

    #[Route('/spots/{id}', name: 'spot', methods: ['GET'])]
    public function spot(Spot $spot): Response
    {
        return $this->render('spots/show.html.twig', ['spot' => $spot]);
    }

    #[Route('/general-rules', name: 'general_rules', methods: ['GET'])]
    public function generalRules(): Response
    {
        return $this->render('general_rules/index.html.twig', [
            'importantNotices' => $this->texts->getByKey('important_notices'),
            'generalFrameContent' => $this->texts->getByKey('general_frame'),
        ]);
    }

    #[Route('/gallery', name: 'gallery', methods: ['GET'])]
    public function gallery(): Response
    {
        return $this->render('gallery/index.html.twig', ['images' => $this->imageRepository->findAll()]);
    }

    #[Route('/meteo', name: 'meteo', methods: ['GET'])]
    public function meteo(): Response
    {
        return $this->render('meteo/index.html.twig', [
            'intro1' => $this->texts->getByKey('meteo_intro_1'),
            'intro2' => $this->texts->getByKey('meteo_intro_2'),
            'section' => $this->sectionRepository->findOneBy(['name' => "Les vents d'Alizée"]),
            'section2' => $this->sectionRepository->findOneBy(['name' => 'Quel QUIVER pour la Réunion  ?']),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/upload-photos', name: 'upload_photos', methods: ['GET', 'POST'])]
    public function uploadPhotos(Request $request): Response
    {
        if (Request::METHOD_GET === $request->getMethod()) {
            return $this->render('admin/upload_photos.html.twig');
        }

        /** @var UploadedFile $file */
        foreach ($request->files as $file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $this->slugger->slug($originalFilename).'-'.uniqid().'.'.$file->guessExtension();
            try {
                $info = getimagesize($file);
                $image = (new Image())
                    ->setFileName($newFilename)
                    ->setOriginalName($originalFilename);
                if (false !== $info) {
                    [$x, $y] = $info;
                    $image->setHeight($y)->setWidth($x);
                }
                $this->em->persist($image);
                $this->em->flush();
                $file->move('images', $newFilename);
            } catch (\Exception $e) {
                dd($e);
            }
        }

        return new JsonResponse(['OK' => 'OK']);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/text/{id}', name: 'update_text', methods: ['GET', 'POST'])]
    public function updateText(Request $request, Text $text): Response
    {
        $form = $this->createForm(TextType::class, $text, [
            'action' => $this->generateUrl('update_text', ['id' => $text->getId()]),
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->render('components/_text_content.html.twig', ['text' => $text]);
        }

        return $this->render('components/_text_form.html.twig', ['form' => $form]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/image/{id}/remove', name: 'remove_image', methods: ['GET'])]
    public function removeImage(Image $image, string $publicDir): RedirectResponse
    {
        unlink(sprintf('%s/%s', $publicDir, $image->getUrl()));
        $this->em->remove($image);
        $this->em->flush();

        return $this->redirectToRoute('gallery');
    }
}
