<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheArtisteController extends AbstractController
{
    /**
     * @Route("/ficheartiste", name="fiche_artiste")
     */
    public function index(): Response
    {
        return $this->render('artiste/ficheartiste.html.twig', [
            'controller_name' => 'FicheArtisteController',
        ]);
    }
}
