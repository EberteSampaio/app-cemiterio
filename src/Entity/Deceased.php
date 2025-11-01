<?php

namespace App\Entity;

use App\Repository\DeceasedRepository;
use App\Utils\Timezone;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeceasedRepository::class)]
class Deceased
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private DateTime $created_at;

    #[ORM\Column]
    private DateTime $updated_at;

    #[ORM\ManyToOne(inversedBy: 'deceaseds')]
    private ?BurialLocation $local = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Locker $locker = null;

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $name,

        #[ORM\Column(type: Types::DATE_MUTABLE)]
        private DateTime $date_of_death
    )
    {
        $this->created_at = new DateTime('now',Timezone::AMERICA_SP->value);
        $this->updated_at = new DateTime('now',Timezone::AMERICA_SP->value);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLocalType()
    {
        return $this->local->getType()->label();
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDateOfDeath(): DateTime
    {
        return $this->date_of_death;
    }

    public function setDateOfDeath(\DateTime $date_of_death): static
    {
        $this->date_of_death = $date_of_death;

        return $this;
    }

    /**
     * @param BurialLocation|null $local
     * @return Deceased
     */
    public function setLocal(?BurialLocation $local): Deceased
    {
        $this->local = $local;
        return $this;
    }

    /**
     * @param Locker|null $locker
     * @return Deceased
     */
    public function setLocker(?Locker $locker): Deceased
    {
        $this->locker = $locker;
        return $this;
    }

    public function getLocalBlock() : int
    {
        return $this->local->getBlock();
    }
    public function getLocalSection() : int
    {
        return $this->local->getSection();
    }

    public function getLockerNumber() : int
    {
        return $this->locker->getNumber();
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
