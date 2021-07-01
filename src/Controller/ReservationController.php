<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
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
        $reservation = $reservationRepository->findAll();

        // dd($reservation);

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservation,
        ]);
    }

    /**
     * @Route("/reservation/add", name="reservation_add")
     */
    public function addReservation(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        // dd($reservation);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setUser($this->getUser());

            dd($reservation);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Votre réservation est prise en compte !');

            return $this->redirectToRoute('reservation');
        }

        // dd($reservation);

        return $this->render('/reservation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
