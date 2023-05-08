<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column]
    private ?int $peso_min = null;

    #[ORM\Column]
    private ?int $peso_max = null;

    #[ORM\Column]
    private ?int $edad_min = null;

    #[ORM\Column]
    private ?int $edad_max = null;

    #[ORM\Column(length: 255)]
    private ?string $sexo = null;

    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getPesoMin(): ?int
    {
        return $this->peso_min;
    }

    public function setPesoMin(int $peso_min): self
    {
        $this->peso_min = $peso_min;

        return $this;
    }

    public function getPesoMax(): ?int
    {
        return $this->peso_max;
    }

    public function setPesoMax(int $peso_max): self
    {
        $this->peso_max = $peso_max;

        return $this;
    }

    public function getEdadMin(): ?int
    {
        return $this->edad_min;
    }

    public function setEdadMin(int $edad_min): self
    {
        $this->edad_min = $edad_min;

        return $this;
    }

    public function getEdadMax(): ?int
    {
        return $this->edad_max;
    }

    public function setEdadMax(int $edad_max): self
    {
        $this->edad_max = $edad_max;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCategoria($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCategoria() === $this) {
                $user->setCategoria(null);
            }
        }

        return $this;
    }
}
