<?php

namespace App\Controller;

use App\Entity\HealthCard;
use App\Form\HealthCard2Type;
use App\Repository\HealthCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/animal/card")
 */
class HealthCardController extends AbstractController
{
    /**
     * @Route("/", name="health_card_index", methods={"GET"})
     */
    public function index(HealthCardRepository $healthCardRepository): Response
    {
        return $this->render('health_card/index.html.twig', [
            'health_cards' => $healthCardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="health_card_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $healthCard = new HealthCard();
        $form = $this->createForm(HealthCard2Type::class, $healthCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($healthCard);
            $entityManager->flush();

            return $this->redirectToRoute('health_card_index');
        }

        return $this->render('health_card/new.html.twig', [
            'health_card' => $healthCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="health_card_show", methods={"GET"})
     */
    public function show(HealthCard $healthCard): Response
    {
        return $this->render('health_card/show.html.twig', [
            'health_card' => $healthCard,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="health_card_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HealthCard $healthCard): Response
    {
        $form = $this->createForm(HealthCard2Type::class, $healthCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('health_card_index');
        }

        return $this->render('health_card/edit.html.twig', [
            'health_card' => $healthCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="health_card_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HealthCard $healthCard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$healthCard->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($healthCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('health_card_index');
    }
}
