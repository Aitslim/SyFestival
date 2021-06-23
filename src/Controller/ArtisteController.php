<?php

namespace App\Controller;

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
        // dd($artists);

        return $this->render('artiste/artistes.html.twig', [
            'artistes' => $artistes,
            'categories' => $categories
        ]);
    }
}
