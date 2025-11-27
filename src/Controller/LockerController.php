<?php

namespace App\Controller;

use App\Entity\Locker;
use App\Form\LockerType;
use App\Repository\LockerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/locker')]
final class LockerController extends AbstractController
{
    #[Route(name: 'app_locker_index', methods: ['GET'])]
    public function index(LockerRepository $lockerRepository): Response
    {
        return $this->render('locker/index.html.twig', [
            'lockers' => $lockerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_locker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $locker = new Locker();
        $form = $this->createForm(LockerType::class, $locker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($locker);
            $entityManager->flush();

            return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('locker/new.html.twig', [
            'locker' => $locker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_locker_show', methods: ['GET'])]
    public function show(Locker $locker): Response
    {
        return $this->render('locker/show.html.twig', [
            'locker' => $locker,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_locker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Locker $locker, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LockerType::class, $locker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('locker/edit.html.twig', [
            'locker' => $locker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_locker_delete', methods: ['POST'])]
    public function delete(Request $request, Locker $locker, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locker->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($locker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_locker_index', [], Response::HTTP_SEE_OTHER);
    }
}
