<?php

namespace App\Controller;

use App\Entity\BurialLocation;
use App\Form\BurialLocationType;
use App\Repository\BurialLocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burial/location')]
final class BurialLocationController extends AbstractController
{
    #[Route(name: 'app_burial_location_index', methods: ['GET'])]
    public function index(BurialLocationRepository $burialLocationRepository): Response
    {
        return $this->render('burial_location/index.html.twig', [
            'burial_locations' => $burialLocationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_burial_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $burialLocation = new BurialLocation();
        $form = $this->createForm(BurialLocationType::class, $burialLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($burialLocation);
            $entityManager->flush();

            return $this->redirectToRoute('app_burial_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('burial_location/new.html.twig', [
            'burial_location' => $burialLocation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_burial_location_show', methods: ['GET'])]
    public function show(BurialLocation $burialLocation): Response
    {
        return $this->render('burial_location/show.html.twig', [
            'burial_location' => $burialLocation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_burial_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BurialLocation $burialLocation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BurialLocationType::class, $burialLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_burial_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('burial_location/edit.html.twig', [
            'burial_location' => $burialLocation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_burial_location_delete', methods: ['POST'])]
    public function delete(Request $request, BurialLocation $burialLocation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$burialLocation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($burialLocation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_burial_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
