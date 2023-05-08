<?php

namespace App\Entity;

use App\Repository\ParticipaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipaRepository::class)]
class Participa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participaciones')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'participaciones')]
    private ?Campeonato $campeonato = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setParticipa(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCampeonato(): ?campeonato
    {
        return $this->campeonato;
    }

    public function setCampeonato(?campeonato $campeonato): self
    {
        $this->campeonato = $campeonato;

        return $this;
    }
}
