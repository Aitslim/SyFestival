<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function index(ArtistRepository $artistsRepository): Response
    {
        $artists = $artistsRepository->findAll();
        // dd($artists);

        return $this->render('artiste/artistes.html.twig', [
            'artistes' => $artists,
        ]);
    }
}
