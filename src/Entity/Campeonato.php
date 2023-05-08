<?php

namespace App\Entity;

use App\Repository\CampeonatoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampeonatoRepository::class)]
class Campeonato
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $N_max_participantes = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha_inicio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Cartel = null;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: Participa::class)]
    private Collection $participaciones;

    #[ORM\Column(length: 255)]
    private ?string $Tipo = null;

    #[ORM\ManyToOne(inversedBy: 'campeonatos')]
    private ?ComunidadAutonoma $Comunidad_Autonoma = null;

    public function __construct()
    {
        $this->participaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNMaxParticipantes(): ?int
    {
        return $this->N_max_participantes;
    }

    public function setNMaxParticipantes(int $N_max_participantes): self
    {
        $this->N_max_participantes = $N_max_participantes;

        return $this;
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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->Fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $Fecha_inicio): self
    {
        $this->Fecha_inicio = $Fecha_inicio;

        return $this;
    }

    public function getCartel(): ?string
    {
        return $this->Cartel;
    }

    public function setCartel(?string $Cartel): self
    {
        $this->Cartel = $Cartel;

        return $this;
    }

    /**
     * @return Collection<int, Participa>
     */
    public function getParticipaciones(): Collection
    {
        return $this->participaciones;
    }

    public function addParticipacione(Participa $participacione): self
    {
        if (!$this->participaciones->contains($participacione)) {
            $this->participaciones->add($participacione);
            $participacione->setRelation($this);
        }

        return $this;
    }

    public function removeParticipacione(Participa $participacione): self
    {
        if ($this->participaciones->removeElement($participacione)) {
            // set the owning side to null (unless already changed)
            if ($participacione->getRelation() === $this) {
                $participacione->setRelation(null);
            }
        }

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->Tipo;
    }

    public function setTipo(?string $Tipo): self
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    public function getComunidadAutonoma(): ?ComunidadAutonoma
    {
        return $this->Comunidad_Autonoma;
    }

    public function setComunidadAutonoma(?ComunidadAutonoma $Comunidad_Autonoma): self
    {
        $this->Comunidad_Autonoma = $Comunidad_Autonoma;

        return $this;
    }
}
