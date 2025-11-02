<?php

namespace App\Service;

use App\DTO\FilterDeceasedRequest;
use App\Repository\DeceasedRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeceasedService
{
    public function __construct(
        private readonly DeceasedRepository $deceasedRepository
    )
    {
    }

    public function filter(FilterDeceasedRequest $filter)
    {
        return $this->deceasedRepository->findAllByFilter($filter);
    }
}
