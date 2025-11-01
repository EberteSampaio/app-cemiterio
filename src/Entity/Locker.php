<?php

namespace App\Entity;

use App\Repository\LockerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LockerRepository::class)]
class Locker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $number = null;

    #[ORM\ManyToOne(inversedBy: 'lockers')]
    private ?BurialLocation $local = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getLocal(): ?BurialLocation
    {
        return $this->local;
    }

    public function setLocal(?BurialLocation $local): static
    {
        $this->local = $local;

        return $this;
    }
}
