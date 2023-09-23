<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\MaxDepth as MaxDepth;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[Serializer\ExclusionPolicy("all")]
class Commande
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

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\ManyToOne(inversedBy: 'commandes', targetEntity: Client::class)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?Client $idclient = null;

    #[ORM\ManyToOne(inversedBy: 'commande', targetEntity: Produit::class)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?Produit $idProduit = null;
    
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

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getIdclient(): ?client
    {
        return $this->idclient;
    }

    public function setIdclient(?client $idclient): self
    {
        $this->idclient = $idclient;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }
}
