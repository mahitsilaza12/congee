<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\MaxDepth as MaxDepth;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[Serializer\ExclusionPolicy("all")]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Groups(['list'])]
    #[Serializer\Expose]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?string $adress = null;

    #[ORM\Column(nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?string $numero = null;

    #[ORM\OneToMany(mappedBy: 'idclient', targetEntity: Commande::class)]
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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
            $commande->setIdclient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIdclient() === $this) {
                $commande->setIdclient(null);
            }
        }

        return $this;
    }
}
