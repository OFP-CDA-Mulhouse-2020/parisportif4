<?php

namespace App\Entity;

use App\Repository\SportIndividuelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportIndividuelRepository::class)
 */
class SportIndividuel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="sportIndividuels")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Sport $sport_individuel;

    /**
     * @ORM\OneToMany(targetEntity=Joueurs::class, mappedBy="joueurs")
     */
    private ArrayCollection $joueurs;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSportIndividuel(): ?Sport
    {
        return $this->sport_individuel;
    }

    public function setSportIndividuel(?Sport $sport_individuel): self
    {
        $this->sport_individuel = $sport_individuel;

        return $this;
    }

    /**
     * @return Collection|Joueurs[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueurs $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setJoueurs($this);
        }

        return $this;
    }

    public function removeJoueur(Joueurs $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getJoueurs() === $this) {
                $joueur->setJoueurs(null);
            }
        }

        return $this;
    }
}
