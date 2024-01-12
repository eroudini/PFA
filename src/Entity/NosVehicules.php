<?php

namespace App\Entity;

use App\Repository\NosVehiculesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NosVehiculesRepository::class)]
class NosVehicules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $images = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Marques = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Prix = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Circulation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Kilometrage = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Carburant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getMarques(): ?string
    {
        return $this->Marques;
    }

    public function setMarques(string $Marques): static
    {
        $this->Marques = $Marques;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getCirculation(): ?string
    {
        return $this->Circulation;
    }

    public function setCirculation(string $Circulation): static
    {
        $this->Circulation = $Circulation;

        return $this;
    }

    public function getKilometrage(): ?string
    {
        return $this->Kilometrage;
    }

    public function setKilometrage(string $Kilometrage): static
    {
        $this->Kilometrage = $Kilometrage;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->Carburant;
    }

    public function setCarburant(string $Carburant): static
    {
        $this->Carburant = $Carburant;

        return $this;
    }
}
