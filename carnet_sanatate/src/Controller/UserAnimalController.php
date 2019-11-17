<?php

namespace App\Controller;

use App\Entity\UserAnimal;
use App\Form\UserAnimalType;
use App\Repository\UserAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/animal")
 */
class UserAnimalController extends AbstractController
{
    /**
     * @Route("/", name="user_animal_index", methods={"GET"})
     */
    public function index(UserAnimalRepository $userAnimalRepository): Response
    {
        return $this->render('user_animal/index.html.twig', [
            'user_animals' => $userAnimalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_animal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userAnimal = new UserAnimal();
        $form = $this->createForm(UserAnimalType::class, $userAnimal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userAnimal);
            $entityManager->flush();

            return $this->redirectToRoute('user_animal_index');
        }

        return $this->render('user_animal/new.html.twig', [
            'user_animal' => $userAnimal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_animal_show", methods={"GET"})
     */
    public function show(UserAnimal $userAnimal): Response
    {
        return $this->render('user_animal/show.html.twig', [
            'user_animal' => $userAnimal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_animal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserAnimal $userAnimal): Response
    {
        $form = $this->createForm(UserAnimalType::class, $userAnimal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_animal_index');
        }

        return $this->render('user_animal/edit.html.twig', [
            'user_animal' => $userAnimal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_animal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserAnimal $userAnimal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userAnimal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userAnimal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_animal_index');
    }
}
