<?php

namespace App\Controller;

use App\Form\ClientType;
use App\Form\ProviderType;
use App\Entity\Client;
use App\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Ensure the redirection logic is commented out for testing
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('homepage'); // Change 'homepage' to the route you want to redirect to
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last email entered by the user
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error,
        ]);
    }

    #[Route('/register/provider', name: 'register_provider')]
    #[Route('/register/client', name: 'register_client')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, string $type): Response
    {
        $entity = $type === 'provider' ? new Provider() : new Client();
        $formType = $type === 'provider' ? ProviderType::class : ClientType::class;
        $form = $this->createForm($formType, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setPassword(
                $passwordHasher->hashPassword($entity, $entity->getPassword())
            );
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
