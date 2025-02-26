<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Provider;
use App\Form\ClientType;
use App\Form\ProviderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/register/client', name: 'register_client')]
    public function registerClient(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client->hashPassword($passwordEncoder, $client->getPassword());
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/register/provider', name: 'register_provider')]
    public function registerProvider(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $provider->hashPassword($passwordEncoder, $provider->getPassword());
            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
