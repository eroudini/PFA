<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquesRepository::class)]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'Marque', targetEntity: Cars::class)]
    private Collection $descriptions;

    public function __construct()
    {
        $this->descriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Cars>
     */
    public function getDescriptions(): Collection
    {
        return $this->descriptions;
    }

    public function addDescription(Cars $description): static
    {
        if (!$this->descriptions->contains($description)) {
            $this->descriptions->add($description);
            $description->setMarque($this);
        }

        return $this;
    }

    public function removeDescription(Cars $description): static
    {
        if ($this->descriptions->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getMarque() === $this) {
                $description->setMarque(null);
            }
        }

        return $this;
    }
}
