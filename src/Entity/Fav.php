<?php

namespace App\Entity;

use App\Repository\FavRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavRepository::class)]
class Fav
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livres $book = null;

    #[ORM\ManyToOne(inversedBy: 'favs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $adddate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?Livres
    {
        return $this->book;
    }

    public function setBook(?Livres $book): static
    {
        $this->book = $book;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getAdddate(): ?\DateTimeImmutable
    {
        return $this->adddate;
    }

    public function setAdddate(\DateTimeImmutable $adddate): static
    {
        $this->adddate = $adddate;

        return $this;
    }
}
