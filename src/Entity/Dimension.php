<?php

namespace App\Entity;

use App\Repository\DimensionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Livres;

#[ORM\Entity(repositoryClass: DimensionRepository::class)]
class Dimension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $height = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $width = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $thickness = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $weight = null;

    #[ORM\OneToOne(inversedBy: "dimension", targetEntity: Livres::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livres $livre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(?string $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function getThickness(): ?string
    {
        return $this->thickness;
    }

    public function setThickness(?string $thickness): static
    {
        $this->thickness = $thickness;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getLivre(): ?Livres
    {
        return $this->livre;
    }

    public function setLivre(Livres $livre): static
    {
        $this->livre = $livre;

        return $this;
    }
}
