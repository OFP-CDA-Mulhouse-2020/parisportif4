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
    private DateTimeInterface $amountBetDate;
    /**
     * @ORM\Column(type="integer", length=5)
     * @Assert\Positive()
     * @Assert\LessThanOrEqual(value="10000")
     */
    private ?int $amountBet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type(type="bool")
     */
    private ?bool $statusBet;

    /**
     * @ORM\Column(type="integer", length=10)
     * @Assert\Positive()
     */
    private ?int $Earnings;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->amountBetDate = new DateTime();
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->amountBetDate;
    }

    public function getAmountBet () : ?float
    {
        return $this -> amountBet/100;
    }

    public function setAmountBet ( ?int $amountBet, int $amountUser) : bool
    {
        $result = false;
        if($amountBet <= $amountUser){
           $this -> amountBet = ($amountBet*100);
            $result = true;
        }
        return $result;

    }

    public function getStatusBet () : ?bool
    {
        return $this -> statusBet;
    }

    public function setStatusBet ( ?bool $statusBet ) : self
    {
        $this -> statusBet = $statusBet;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getEarnings () : ?float
    {
        return $this -> Earnings/100;
    }

    public function setEarnings ( ?int $Earnings, ?float $cote) : void
    {
        $this -> Earnings = ($Earnings*100)*$cote;
    }


}
