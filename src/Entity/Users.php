<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\State\UserProcessor;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource(
    processor: UserProcessor::class
)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(length: 255, nullable: false)]
    private string $password;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, Fav>
     */
    #[ORM\OneToMany(targetEntity: Fav::class, mappedBy: 'users', orphanRemoval: true)]
    private Collection $favs;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->favs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    // PasswordAuthenticatedUserInterface
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Collection<int, Fav>
     */
    public function getFavs(): Collection
    {
        return $this->favs;
    }

    public function addFav(Fav $fav): static
    {
        if (!$this->favs->contains($fav)) {
            $this->favs->add($fav);
            $fav->setUsers($this);
        }
        return $this;
    }

    public function removeFav(Fav $fav): static
    {
        if ($this->favs->removeElement($fav)) {
            if ($fav->getUsers() === $this) {
                $fav->setUsers(null);
            }
        }
        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;
        return $this;
    }

  // --- Méthodes obligatoires de UserInterface ---
public function getUserIdentifier(): string
{
    return $this->email;
}

public function eraseCredentials(): void
{
    // Si tu avais un champ plainPassword temporaire, tu le viderais ici.
    // Comme tu n’as pas de champ temporaire, tu peux laisser vide.
}

// ... ton code jusqu'à getRoles()

public function getRoles(): array
{
    // Récupère le rôle pour Symfony, par défaut ROLE_USER
    return [$this->role?->getName() ?? 'ROLE_USER'];
}
} // <-- fermeture de la classe Users

