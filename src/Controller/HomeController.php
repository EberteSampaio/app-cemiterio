<?php

namespace App\Controller;

use App\DTO\FilterDeceasedRequest;
use App\Service\DeceasedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private readonly DeceasedService $deceasedService
    )
    {
    }

    #[Route('/home', name: 'app_home')]
    public function index(Request $request): Response
    {
       if($request->query->has('full_name')){
           $deceasedList = $this->deceasedService->filter(
               FilterDeceasedRequest::fromRequest($request)
           );
//           dd($deceasedList);
           return $this->render(
               'externo/home/index.html.twig',[
                   'deceasedList' => $deceasedList
               ]
           );
       }

        return $this->render('externo/home/index.html.twig');
    }
}
