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

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agenda(): Response
    {
        $agenda = array(
            array("20/08/21", "16h - 18h", "Réserver"),
            array("20/08/21", "18h - 20h", "Réserver"),
            array("20/08/21", "21h - 23h", "Réserver"),
            array("21/08/21", "16h - 18h", "Réserver"),
            array("21/08/21", "18h - 20h", "Réserver"),
            array("21/08/21", "21h - 23h", "Réserver"),
            array("22/08/21", "16h - 18h", "Réserver"),
            array("22/08/21", "18h - 20h", "Réserver"),
            array("22/08/21", "21h - 23h", "Réserver")
        );

        return $this->render('artiste/agenda.html.twig', [
            'agenda' => $agenda,
        ]);
    }
}
