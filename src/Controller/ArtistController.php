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
     * @Route("/artistes/{id}", name="artistes_list")
     */
    public function list(int $id = null, ArtistRepository $artistsRepository, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        if ($id) {
            $artistes = $artistsRepository->findBy(['category' => $id]);
        } else {
            $artistes = $artistsRepository->findAll();
        }

        return $this->render('artiste/liste.html.twig', [
            'artistes' => $artistes,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/fiche/{id}", name="artiste_fiche", requirements={"id"="\d+"})
     */
    public function artiste($id, ArtistRepository $artistsRepository): Response
    {
        $artisteDescription = $artistsRepository->findOneBy(['id' => $id]);

        return $this->render('artiste/fiche.html.twig', [
            'artiste' => $artisteDescription
        ]);
    }
}
