<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeceasedController extends AbstractController
{
    #[Route('/deceased', name: 'app_deceased')]
    public function index(): Response
    {
        return $this->render('deceased/index.html.twig', [
            'controller_name' => 'DeceasedController',
        ]);
    }
}
