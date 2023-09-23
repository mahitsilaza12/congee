<?php

namespace App\Entity;

use App\Repository\DeleteCommandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\MaxDepth as MaxDepth;

#[ORM\Entity(repositoryClass: DeleteCommandRepository::class)]
#[Serializer\ExclusionPolicy("all")]
class DeleteCommand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $quantite = null;


    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Groups(['list'])]
    #[Serializer\Expose]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Groups(['list'])]
    #[Serializer\Expose]
    private ?string $produitName = null;

    #[ORM\Column(nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'deleteCommands')]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?\DateTimeInterface $dateCommande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }
    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProduitName(): ?string
    {
        return $this->produitName;
    }

    public function setProduitName(string $produitName): self
    {
        $this->produitName = $produitName;

        return $this;
    }
}

