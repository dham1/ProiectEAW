<?php

namespace App\Controller;

use App\Entity\UserDetails;
use App\Form\UserDetails2Type;
use App\Repository\UserDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/details")
 */
class UserDetailsController extends AbstractController
{
    /**
     * @Route("/", name="user_details_index", methods={"GET"})
     */
    public function index(UserDetailsRepository $userDetailsRepository): Response
    {
        return $this->render('user_details/index.html.twig', [
            'user_details' => $userDetailsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_details_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userDetail = new UserDetails();
        $form = $this->createForm(UserDetails2Type::class, $userDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userDetail);
            $entityManager->flush();

            return $this->redirectToRoute('user_details_index');
        }

        return $this->render('user_details/new.html.twig', [
            'user_detail' => $userDetail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_details_show", methods={"GET"})
     */
    public function show(UserDetails $userDetail): Response
    {
        return $this->render('user_details/show.html.twig', [
            'user_detail' => $userDetail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_details_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserDetails $userDetail): Response
    {
        $form = $this->createForm(UserDetails2Type::class, $userDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_details_show', array('id' => $userDetail->getId()));
        }

        return $this->render('user_details/edit.html.twig', [
            'user_detail' => $userDetail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_details_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserDetails $userDetail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userDetail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userDetail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_details_index');
    }
}
