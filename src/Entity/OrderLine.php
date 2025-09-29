<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderLineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderLineRepository::class)]
#[ApiResource]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $orderid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $unitprice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function setOrderid(int $orderid): static
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitprice(): ?string
    {
        return $this->unitprice;
    }

    public function setUnitprice(string $unitprice): static
    {
        $this->unitprice = $unitprice;

        return $this;
    }
}
