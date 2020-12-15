<?php

namespace App\Entity;

use App\Repository\BetUserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BetUserRepository::class)
 */
class BetUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createDate;
    /**
     * @ORM\Column(type="integer", length=5)
     * @Assert\Positive()
     * @Assert\LessThanOrEqual(value="10000")
     */
    private ?int $amountBet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->createDate = new DateTime();
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function getAmountBet () : ?float
    {
        return $this -> amountBet/100;
    }

    public function setAmountBet ( ?int $amountBet ) : self
    {
        $this -> amountBet = ($amountBet*100);
        return $this;
    }

}
