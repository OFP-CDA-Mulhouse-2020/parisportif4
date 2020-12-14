<?php

namespace App\Entity;

use App\Repository\BetRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BetRepository::class)
 */
class Bet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank ()
     * @Assert\Regex(
     *     pattern="/^(?!\s*$)[-a-zA-Z\s]{1,100}$/")
     */
    private ?string $nameBet;
    /**
     * @ORM\Column(type="integer", length=3)
     * @Assert\NotBlank ()
     * @Assert\Positive
     * @Assert\GreaterThanOrEqual(value="110")
     */
    private ?int $cote;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private DateTimeInterface $createDate;

    public function __construct()
    {
        $this->createDate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBet () : ?string
    {
        return $this -> nameBet;
    }

    public function setNameBet ( ?string $nameBet ) : self
    {
        $this -> nameBet = $nameBet;
        return $this;
    }

    public function getCote () : ?int
    {
        return $this -> cote/100;
    }

    public function setCote ( ?int $cote ) : self
    {
        $this -> cote = $cote*100;
        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }
}
