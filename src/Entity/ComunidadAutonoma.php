<?php

namespace App\Entity;

use App\Repository\ComunidadAutonomaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComunidadAutonomaRepository::class)]
class ComunidadAutonoma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\OneToMany(mappedBy: 'comunidadAutonoma', targetEntity: Provincia::class)]
    private Collection $provincia;

    #[ORM\OneToMany(mappedBy: 'Comunidad_Autonoma', targetEntity: Campeonato::class)]
    private Collection $campeonatos;

    public function __construct()
    {
        $this->provincia = new ArrayCollection();
        $this->campeonatos = new ArrayCollection();
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

    /**
     * @return Collection<int, Provincia>
     */
    public function getProvincia(): Collection
    {
        return $this->provincia;
    }

    public function addProvincium(Provincia $provincium): self
    {
        if (!$this->provincia->contains($provincium)) {
            $this->provincia->add($provincium);
            $provincium->setComunidadAutonoma($this);
        }

        return $this;
    }

    public function removeProvincium(Provincia $provincium): self
    {
        if ($this->provincia->removeElement($provincium)) {
            // set the owning side to null (unless already changed)
            if ($provincium->getComunidadAutonoma() === $this) {
                $provincium->setComunidadAutonoma(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->Nombre;
    }

    /**
     * @return Collection<int, Campeonato>
     */
    public function getCampeonatos(): Collection
    {
        return $this->campeonatos;
    }

    public function addCampeonato(Campeonato $campeonato): self
    {
        if (!$this->campeonatos->contains($campeonato)) {
            $this->campeonatos->add($campeonato);
            $campeonato->setComunidadAutonoma($this);
        }

        return $this;
    }

    public function removeCampeonato(Campeonato $campeonato): self
    {
        if ($this->campeonatos->removeElement($campeonato)) {
            // set the owning side to null (unless already changed)
            if ($campeonato->getComunidadAutonoma() === $this) {
                $campeonato->setComunidadAutonoma(null);
            }
        }

        return $this;
    }
}
