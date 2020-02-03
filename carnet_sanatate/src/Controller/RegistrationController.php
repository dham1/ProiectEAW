<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegistrationFormType;
use App\Helpers\SendEmailHelper;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            $emailSender = new SendEmailHelper();
            $displayName = $user->getUsername();
            $subject = "Welcome to Animal Health Card";
            $content = "Welcome!<br> You are registered successfully! <br> Your username is: <b>".$displayName."</b><br> To check your account click <a href='http://localhost:8000/dashboard'>here</a>";
            $emailSender->sendMail($user->getEmail(),$displayName,$subject,$content);


            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
