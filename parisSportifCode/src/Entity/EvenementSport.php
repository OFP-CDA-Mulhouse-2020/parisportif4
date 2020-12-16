<?php

namespace App\Entity;

use App\Repository\EvenementSportRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=EvenementSportRepository::class)
 */
class EvenementSport
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
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Groups({"beginDate"})
     */
    private ?DateTimeInterface $beginDate;

    /**
     * @ORM\Column(type="string, length=255")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $lieu;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): ?self
    {
        $this->name = $name;

        return $this;
    }
    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }
    public function setBeginDate(?\DateTimeInterface $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }
    public function getLieu(): ?string
    {
        return $this->lieu;
    }
    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }
}
