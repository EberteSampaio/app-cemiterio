<?php

namespace App\Service;

use App\Entity\DTO\FalecidoCriteriaFilter;
use App\Entity\Dto\FalecidoRequest;
use App\Entity\Falecido;
use App\Repository\FalecidoRepository;
use Doctrine\ORM\EntityManagerInterface;

class FalecidoService
{
    private FalecidoRepository $falecidoRepository;
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager, FalecidoRepository $falecidoRepository){
        $this->entityManager = $entityManager;
        $this->falecidoRepository = $falecidoRepository;
    }

    public function listarTodos(): array
    {
        return $this->falecidoRepository->findAll();
    }
    public function registrar(FalecidoRequest $request) : Falecido
    {
        $falecido = Falecido::fromDtoRequest($request);
        $this->entityManager->persist($falecido);
        $this->entityManager->flush();

        dd($falecido);
    }

    public function filtrar(FalecidoCriteriaFilter $filter)
    {
        return $this->falecidoRepository->findByCriteria($filter);

    }

}
