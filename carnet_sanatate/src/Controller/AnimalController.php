<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\Animal3Type;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/animal")
 */
class AnimalController extends AbstractController
{
    /**
     * @Route("/", name="animal_index", methods={"GET"})
     */
    public function index(AnimalRepository $animalRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="animal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $animal = new Animal();
        $form = $this->createForm(Animal3Type::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('user_animal_new');
        }

        return $this->render('animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animal_show", methods={"GET"})
     */
    public function show(Animal $animal): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="animal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Animal $animal): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(Animal3Type::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('dashboard');
        }

        return $this->render('animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Animal $animal): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dashboard');
    }
}
