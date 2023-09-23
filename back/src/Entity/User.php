<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\MaxDepth as MaxDepth;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Serializer\ExclusionPolicy("all")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(type:"string")]
    private ?string $password = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $username = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $nom = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $prenom = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $grade = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $adress = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $budget = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $service = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $men = null;

    #[ORM\Column(type:"string", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $echelon = null;

    #[ORM\Column(type:"integer", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $cin = null;

    #[ORM\Column(type:"integer", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $phone = null;

    #[ORM\Column(type:"integer", nullable:true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $im = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Serializer\Expose]
    #[Serializer\Groups(['list'])]
    private $createdAt = null;

    #[ORM\Column(type: 'integer',  nullable:true)]
    #[Serializer\Expose]
    private $jourTotal = null;

    #[ORM\Column(type: 'integer',  nullable:true)]
    #[Serializer\Expose]
    private $jourRestant = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Congee::class)]
    private Collection $congees;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Absence::class)]
    private Collection $absences;

    public function __construct()
    {
        $this->roles = [
            'ROLE_USER'
        ];
        $this->createdAt = new \DateTime();
        $this->congees = new ArrayCollection();
        $this->absences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
        /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getNom(): string
    {
        return (string) $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): string
    {
        return (string) $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhone(): int
    {
        return (string) $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIm(): int
    {
        return (string) $this->im;
    }

    public function setIm(int $im): self
    {
        $this->im = $im;

        return $this;
    }

    public function getGrade(): string
    {
        return (string) $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getAdress(): string
    {
        return (string) $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getBudget(): string
    {
        return (string) $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getService(): string
    {
        return (string) $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }


    public function getMen(): string
    {
        return (string) $this->men;
    }

    public function setMen(string $men): self
    {
        $this->men = $men;

        return $this;
    }

    public function getEchelon(): string
    {
        return (string) $this->echelon;
    }

    public function setEchelon(string $echelon): self
    {
        $this->echelon = $echelon;

        return $this;
    }
    public function getCin(): string
    {
        return (string) $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function getJourTotal(): int
    {
        return $this->jourTotal;
    }

    public function setJourTotal(int $jourTotal): self
    {
        $this->jourTotal = $jourTotal;

        return $this;
    }
    public function getJourRestant(): int
    {
        return $this->jourRestant;
    }

    public function setJourRestant(int $jourRestant): self
    {
        $this->jourRestant = $jourRestant;

        return $this;
    }

    /**
     * @return Collection<int, Congee>
     */
    public function getCongees(): Collection
    {
        return $this->congees;
    }

    public function addCongee(Congee $congee): self
    {
        if (!$this->congees->contains($congee)) {
            $this->congees->add($congee);
            $congee->setUserId($this);
        }

        return $this;
    }

    public function removeCongee(Congee $congee): self
    {
        if ($this->congees->removeElement($congee)) {
            // set the owning side to null (unless already changed)
            if ($congee->getUserId() === $this) {
                $congee->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Absence>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences->add($absence);
            $absence->setUser($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getUser() === $this) {
                $absence->setUser(null);
            }
        }

        return $this;
    }
}
