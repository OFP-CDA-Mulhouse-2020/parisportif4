<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompetitionRepository::class)
 */
class Competition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *      message="Nom vide",
     * )
     * @Assert\Regex(
     *  pattern =  "/^[a-zA-Z0-9À-ÿ '-]{2,40}$/",
     *  message="Format Nom incorrect",
     * )
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *      message="Date start vide",
     * )
     * @Assert\Type(
     *     type="datetime",
     *     message="Format incorrect"
     * )
     */
    private DateTimeInterface $startAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *      message="Date start vide",
     * )
     * @Assert\GreaterThan(propertyPath="startAt",
     *     message="Incorrect"
     * )
     */
    private DateTimeInterface $endAt;

    /**
     * @ORM\OneToMany(targetEntity=EvenementSport::class, mappedBy="competionn", orphanRemoval=true)
     */
    private $evenement;

    public function __construct()
    {
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartAt(): ?DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

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
            $evenement->setCompetionn($this);
        }

        return $this;
    }

    public function removeEvenement(EvenementSport $evenement): self
    {
        if ($this->evenement->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getCompetionn() === $this) {
                $evenement->setCompetionn(null);
            }
        }

        return $this;
    }



}