<?php

namespace App\Entity;

use App\Repository\AbsenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: AbsenceRepository::class)]
#[Serializer\ExclusionPolicy("all")]
class Absence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\ManyToOne(inversedBy: 'absences')]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?user $user = null;

    #[ORM\Column(type:"boolean", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $status1 = false;

    #[ORM\Column(type:"boolean", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $status2 = false;

    #[ORM\Column(type:"text")]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $motif = null;

    #[ORM\Column()]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $nombreJ = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
    
    public function getStatus1(): ?bool
    {
        return $this->status1;
    }
    public function isStatus1(): ?bool
    {
        return $this->status1;
    }

    public function setStatus1(bool $status1): self
    {
        $this->status1 = $status1;

        return $this;
    }

    public function getStatus2(): ?bool
    {
        return $this->status2;
    }
    public function isStatus2(): ?bool
    {
        return $this->status2;
    }

    public function setStatus2(bool $status2): self
    {
        $this->status2 = $status2;

        return $this;
    }
    public function getMotif(): string
    {
        return (string) $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getNombreJ(): ?int
    {
        return $this->nombreJ;
    }

    public function setNombreJ(int $nombreJ): self
    {
        $this->nombreJ = $nombreJ;

        return $this;
    }
}
