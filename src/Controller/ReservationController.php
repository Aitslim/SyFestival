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
    public function liste(ReservationRepository $reservationRepository): Response
    {
        // A REVOIR : provoque une exception, msg = "Access Denied" sans la condition ci-dessous !.
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $reservation = $reservationRepository->findBy(['user' => $this->getUser()]);

        return $this->render('reservation/liste.html.twig', [
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

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Votre réservation est prise en compte !');

            return $this->redirectToRoute('reservation');
        }

        return $this->render('/reservation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reservation/remove/{id}", name="reservation_remove", requirements={"id"="\d+"})"
     */
    public function removeReservation(Reservation $reservation): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();
        $this->addFlash('success', 'Réservation supprimé !');
        return $this->redirectToRoute('reservation');
    }

    /**
     * @Route("/reservation/update/{id}", name="reservation_update", requirements={"id"="\d+"})
     */
    public function updateReservation(Reservation $reservation, Request $request): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Votre reservation a été modifiée avec succès !');

            return $this->redirectToRoute('reservation');
        }

        return $this->render('/reservation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
