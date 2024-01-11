<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquesRepository::class)]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?marques $modele = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Année = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?marques
    {
        return $this->modele;
    }

    public function setModele(?marques $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnée(): ?string
    {
        return $this->Année;
    }

    public function setAnnée(?string $Année): static
    {
        $this->Année = $Année;

        return $this;
    }
}
