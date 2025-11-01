<?php
declare(strict_types=1);
namespace App\Entity;

use App\Enum\TypeBurialLocal;
use App\Repository\BurialLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurialLocationRepository::class)]
class BurialLocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $block = null;

    #[ORM\Column]
    private ?int $section = null;
    #[ORM\Column]
    private ?int $number = null;

    /**
     * @var Collection<int, Deceased>
     */
    #[ORM\OneToMany(targetEntity: Deceased::class, mappedBy: 'local')]
    private Collection $deceaseds;

    /**
     * @var Collection<int, Locker>
     */
    #[ORM\OneToMany(targetEntity: Locker::class, mappedBy: 'local')]
    private Collection $lockers;

    public function __construct(
        #[ORM\Column(enumType: TypeBurialLocal::class)]
        private TypeBurialLocal $type
    )
    {
        $this->deceaseds = new ArrayCollection();
        $this->lockers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlock(): ?int
    {
        return $this->block;
    }

    public function setBlock(int $block): static
    {
        $this->block = $block;

        return $this;
    }

    public function getSection(): ?int
    {
        return $this->section;
    }

    public function setSection(int $section): static
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection<int, Deceased>
     */
    public function getDeceaseds(): Collection
    {
        return $this->deceaseds;
    }

    public function addDeceased(Deceased $deceased): static
    {
        if (!$this->deceaseds->contains($deceased)) {
            $this->deceaseds->add($deceased);
            $deceased->setLocal($this);
        }

        return $this;
    }

    public function removeDeceased(Deceased $deceased): static
    {
        if ($this->deceaseds->removeElement($deceased)) {
            // set the owning side to null (unless already changed)
            if ($deceased->getLocal() === $this) {
                $deceased->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Locker>
     */
    public function getLockers(): Collection
    {
        return $this->lockers;
    }

    public function addLocker(Locker $locker): static
    {
        if (!$this->lockers->contains($locker)) {
            $this->lockers->add($locker);
            $locker->setLocal($this);
        }

        return $this;
    }

    public function removeLocker(Locker $locker): static
    {
        if ($this->lockers->removeElement($locker)) {
            // set the owning side to null (unless already changed)
            if ($locker->getLocal() === $this) {
                $locker->setLocal(null);
            }
        }

        return $this;
    }

    public function getType(): ?TypeBurialLocal
    {
        return $this->type;
    }

    public function setType(TypeBurialLocal $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }
}
