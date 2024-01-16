<?php

namespace App\Entity;

use App\Repository\DisponibleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisponibleRepository::class)]
class Disponible
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?voitures $voiture = null;

    #[ORM\Column(length: 255)]
    private ?string $vendu_le = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiture(): ?voitures
    {
        return $this->voiture;
    }

    public function setVoiture(?voitures $voiture): static
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getVenduLe(): ?string
    {
        return $this->vendu_le;
    }

    public function setVenduLe(string $vendu_le): static
    {
        $this->vendu_le = $vendu_le;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
