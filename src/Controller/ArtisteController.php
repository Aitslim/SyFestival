<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function index(ArtistRepository $artistsRepository, CategoryRepository $categoryRepository): Response
    {
        $artistes = $artistsRepository->findAll();
        $categories = $categoryRepository->findAll();

        // dd($categories);

        return $this->render('artiste/artistes.html.twig', [
            'artistes' => $artistes,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="categorie", requirements={"id"="\d+"})
     */
    public function artistes($id, ArtistRepository $artistsRepository, CategoryRepository $categoryRepository): Response
    {
        $artistes = $artistsRepository->findByCategory($id);
        $categories = $categoryRepository->findAll();

        // dd($artistes);

        return $this->render('artiste/artistes.html.twig', [
            'artistes' => $artistes,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agenda(): Response
    {
        return $this->render('artiste/agenda.html.twig', [
            'agenda' => "agenda",
        ]);
    }
}
