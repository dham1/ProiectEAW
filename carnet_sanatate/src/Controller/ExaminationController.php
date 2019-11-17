<?php

namespace App\Controller;

use App\Entity\Examination;
use App\Form\Examination1Type;
use App\Repository\ExaminationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/examination")
 */
class ExaminationController extends AbstractController
{
    /**
     * @Route("/", name="examination_index", methods={"GET"})
     */
    public function index(ExaminationRepository $examinationRepository): Response
    {
        return $this->render('examination/index.html.twig', [
            'examinations' => $examinationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="examination_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $examination = new Examination();
        $form = $this->createForm(Examination1Type::class, $examination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($examination);
            $entityManager->flush();

            return $this->redirectToRoute('examination_index');
        }

        return $this->render('examination/new.html.twig', [
            'examination' => $examination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="examination_show", methods={"GET"})
     */
    public function show(Examination $examination): Response
    {
        return $this->render('examination/show.html.twig', [
            'examination' => $examination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="examination_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Examination $examination): Response
    {
        $form = $this->createForm(Examination1Type::class, $examination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examination_index');
        }

        return $this->render('examination/edit.html.twig', [
            'examination' => $examination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="examination_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Examination $examination): Response
    {
        if ($this->isCsrfTokenValid('delete'.$examination->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($examination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('examination_index');
    }
}
