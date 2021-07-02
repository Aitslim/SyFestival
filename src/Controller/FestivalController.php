<?php

namespace App\Controller;

use App\Repository\ConcertRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FestivalController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agenda(ConcertRepository $concertRepository): Response
    {
        $agenda = $concertRepository->findAll();

        return $this->render('artiste/agenda.html.twig', [
            'agenda' => $agenda,
        ]);
    }
}
