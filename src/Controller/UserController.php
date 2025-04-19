<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Provider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/clients', name: 'show_clients')]
    public function showClients(EntityManagerInterface $entityManager): Response
    {
        $clients = $entityManager->getRepository(Client::class)->findAll();

        return $this->render('user/clients.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/providers', name: 'show_providers')]
    public function showProviders(EntityManagerInterface $entityManager): Response
    {
        $providers = $entityManager->getRepository(Provider::class)->findAll();

        return $this->render('user/providers.html.twig', [
            'providers' => $providers,
        ]);
    }
}
