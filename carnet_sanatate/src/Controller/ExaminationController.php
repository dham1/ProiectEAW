<?php

namespace App\Controller;

use App\Entity\Examination;
use App\Form\Examination1Type;
use App\Helpers\ZendLuceneSearch;
use App\Repository\ExaminationRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('examination/index.html.twig', [
            'examinations' => $examinationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="examination_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $examination = new Examination();
        $form = $this->createForm(Examination1Type::class, $examination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($examination);
            $entityManager->flush();

            return $this->redirectToRoute('health_card_examination', ['HealthCard' => $examination->getHealthCard()->getId()]);
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
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('examination/show.html.twig', [
            'examination' => $examination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="examination_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Examination $examination): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(Examination1Type::class, $examination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('health_card_examination', ['HealthCard' => $examination->getHealthCard()->getId()]);
        }

        return $this->render('examination/edit.html.twig', [
            'examination' => $examination,
            'form' => $form->createView(),
            'health_card_id' => $examination->getHealthCard()->getId(),
        ]);
    }

    /**
     * @Route("/{id}", name="examination_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Examination $examination): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isCsrfTokenValid('delete' . $examination->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($examination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route("/cardId/{HealthCard}", name="health_card_examination", methods={"GET"})
     */
    public function findExaminationsByCard(ExaminationRepository $examinationRepository, $HealthCard): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $examinations = $examinationRepository->findExaminationsByCardId($HealthCard);
        return $this->render('examination/health_card_examinations.html.twig', [
            'health_card_examination' => $examinations,
            'health_card_id' => $HealthCard
        ]);
    }

    /**
     * @Route("/search/{HealthCard}", name="examination_search", methods={"POST"})
     */
    public function search(ExaminationRepository $examinationRepository, $HealthCard): Response
    {
        $allExaminations = $examinationRepository->findAll();
        foreach ($allExaminations as $examination) {
            ZendLuceneSearch::updateLuceneIndex($examination);
        }

        $searchTerm = $_POST["searchTerm"];
        $hits = ZendLuceneSearch::getLuceneIndex()->find($searchTerm);

        $results = new ArrayCollection();
        foreach ($hits as $hit) {
            $document = $hit->getDocument();
            $res = $examinationRepository->find($document->key);
            $results->add($res);
        }

        return $this->render('examination/health_card_examinations.html.twig', [
            'health_card_examination' => $results,
            'health_card_id' => $HealthCard,

        ]);
    }
}
