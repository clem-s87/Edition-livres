<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
class Users
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

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $iduser = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'iduser')]
    private Collection $commandes;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->favs = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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
            // set the owning side to null (unless already changed)
            if ($fav->getUsers() === $this) {
                $fav->setUsers(null);
            }
        }

        return $this;
    }

    public function getIduser(): ?self
    {
        return $this->iduser;
    }

    public function setIduser(?self $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(self $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setIduser($this);
        }

        return $this;
    }

    public function removeCommande(self $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIduser() === $this) {
                $commande->setIduser(null);
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
}
