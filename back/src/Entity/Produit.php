<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\MaxDepth as MaxDepth;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[Serializer\ExclusionPolicy("all")]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?string $design = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'idProduit', targetEntity: Commande::class)]
    private Collection $commandes;


    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setIdProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIdProduit() === $this) {
                $commande->setIdProduit(null);
            }
        }

        return $this;
    }
}
