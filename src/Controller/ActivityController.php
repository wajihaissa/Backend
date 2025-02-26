<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    #[Route('/activity', name: 'activity_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $activities = $entityManager->getRepository(Activity::class)->findAll();

        return $this->render('activity/index.html.twig', [
            'activities' => $activities,
        ]);
    }

    #[Route('/activity/new', name: 'activity_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('activity_index');
        }

        return $this->render('activity/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/activity/{id}/edit', name: 'activity_edit')]
    public function edit(Request $request, Activity $activity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActivityType::class, $activity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('activity_index');
        }

        return $this->render('activity/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/activity/{id}/delete', name: 'activity_delete')]
    public function delete(Activity $activity, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($activity);
        $entityManager->flush();

        return $this->redirectToRoute('activity_index');
    }
}
