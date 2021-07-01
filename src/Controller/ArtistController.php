<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     * @Route("/categorie/{id}", name="categorie", requirements={"id"="\d+"})
     * @Route("/reservation/{id}", name="reservation", requirements={"id"="\d+"})
     * @Route("/billeterie", name="billeterie")
     */
    public function index(ArtistRepository $artistsRepository, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        if (isset($_GET['id'])) {
            $artistes = $artistsRepository->findBy(['category' => $_GET['id']]);
        } else {
            $artistes = $artistsRepository->findAll();
        }

        return $this->render('artiste/liste.html.twig', [
            'artistes' => $artistes,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/artiste/{id}", name="artiste", requirements={"id"="\d+"})
     */
    public function artiste($id, ArtistRepository $artistsRepository): Response
    {
        $artisteDescription = $artistsRepository->findOneBy(['id' => $id]);

        return $this->render('artiste/fiche.html.twig', [
            'artiste' => $artisteDescription
        ]);
    }
}
