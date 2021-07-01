<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservation' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/Reservation/add", name="Reservation_add")
     */
    public function addReservation(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $Resreservationervation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($reservation);
            $reservation->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Votre réservation est prise en compte !');

            return $this->redirectToRoute('reservation');
        }

        // ici add
        return $this->render('/Reservation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
