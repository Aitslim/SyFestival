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
     * @Route("/categorie/{id}", name="categorie", requirements={"id"="\d+"})
     */
    public function index(ArtistRepository $artistsRepository, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        if (isset($_GET['id'])) {
            $artistes = $artistsRepository->findBy(['category' => $_GET['id']]);
        } else {
            $artistes = $artistsRepository->findAll();
        }

        return $this->render('artiste/artistes.html.twig', [
            'artistes' => $artistes,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/artiste/{id}", name="ficheartiste", requirements={"id"="\d+"})
     */
    public function fiche_artiste($id, ArtistRepository $artistsRepository): Response
    {
        $artisteDescription = $artistsRepository->findOneBy(['id' => $id]);
    
        return $this->render('artiste/ficheartiste.html.twig', [
            'artiste' => $artisteDescription
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
