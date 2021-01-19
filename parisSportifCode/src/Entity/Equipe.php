<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $name;

    /**
     * @ORM\OneToMany(targetEntity=Joueurs::class, mappedBy="equipe")
     * @var Collection<int, Joueurs>|null
     */
    private ?Collection $joueurs;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class)
     */
    private ?Sport $sport;

    /**
     * @ORM\ManyToMany(targetEntity=EvenementSport::class, inversedBy="equipes")
     */
    private $evenement;



    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->evenement = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<int, Joueurs>|Joueurs[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueurs $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setJoueursEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueurs $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getJoueursEquipe() === $this) {
                $joueur->setJoueursEquipe(null);
            }
        }

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return Collection|EvenementSport[]
     */
    public function getEvenement(): Collection
    {
        return $this->evenement;
    }

    public function addEvenement(EvenementSport $evenement): self
    {
        if (!$this->evenement->contains($evenement)) {
            $this->evenement[] = $evenement;
        }

        return $this;
    }

    public function removeEvenement(EvenementSport $evenement): self
    {
        $this->evenement->removeElement($evenement);

        return $this;
    }
}
