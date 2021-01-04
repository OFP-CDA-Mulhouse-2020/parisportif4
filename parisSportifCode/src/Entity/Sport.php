<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SportRepository::class)
 */
class Sport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $name;

    /**
     * @ORM\OneToMany(targetEntity=EvenementSport::class, mappedBy="sport")
     */
    private ArrayCollection $evenement;

    /**
     * @ORM\OneToMany(targetEntity=SportIndividuel::class, mappedBy="sport_individuel")
     */
    private ArrayCollection $sportIndividuels;

    public function __construct()
    {
        $this->evenement = new ArrayCollection();
        $this->sportIndividuels = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
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
            $evenement->setSport($this);
        }

        return $this;
    }

    public function removeEvenement(EvenementSport $evenement): self
    {
        if ($this->evenement->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getSport() === $this) {
                $evenement->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SportIndividuel[]
     */
    public function getSportIndividuels(): Collection
    {
        return $this->sportIndividuels;
    }

    public function addSportIndividuel(SportIndividuel $sportIndividuel): self
    {
        if (!$this->sportIndividuels->contains($sportIndividuel)) {
            $this->sportIndividuels[] = $sportIndividuel;
            $sportIndividuel->setSportIndividuel($this);
        }

        return $this;
    }

    public function removeSportIndividuel(SportIndividuel $sportIndividuel): self
    {
        if ($this->sportIndividuels->removeElement($sportIndividuel)) {
            // set the owning side to null (unless already changed)
            if ($sportIndividuel->getSportIndividuel() === $this) {
                $sportIndividuel->setSportIndividuel(null);
            }
        }

        return $this;
    }

}
