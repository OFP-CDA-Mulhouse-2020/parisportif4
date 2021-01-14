<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WalletRepository", repositoryClass=WalletRepository::class)
 */
class Wallet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;
    /**
     * @ORM\Column(type="integer", length=10)
     * @Assert\PositiveOrZero
     */
    private ?int $credit = 0;
    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Assert\Positive
     * @Assert\LessThanOrEqual(value="50000")
     */
    private ?int $addMoney = null;
    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\LessThanOrEqual(value="50000")
     */
    private ?int $withdrawMoney = null;

    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Assert\PositiveOrZero
     */
    private ?int $drawBet = null;

    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Assert\PositiveOrZero
     */
    private ?int $withAddEarnings = null;

    private bool $isValid ;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCredit(): ?int
    {
        return $this -> credit / 100;
    }

    public function getAddMoney(): ?int
    {
        return $this -> addMoney / 100;
    }

    public function AddMoney(?float $addMoney): self
    {
        $this -> addMoney = $addMoney * 100;
        $this->credit += ($addMoney * 100);
        return $this;
    }

    public function getDrawMoney(): ?int
    {
        return $this -> withdrawMoney / 100;
    }

    public function Drawmoney(?int $drawmoney): self
    {
        if ($drawmoney > $this->getCredit()) {
            $this->isValid = false;
        } else {
            $this->withdrawMoney = $drawmoney * 100;
            $this->credit -= ($drawmoney * 100);

            $this->isValid = true;
        }
        return $this;
    }

    public function isValiddrawmoney(): bool
    {
        return $this->isValid ;
    }

    public function getDrawBet(): ?float
    {
        return $this -> drawBet / 100;
    }


    public function isValidDrawBet(?int $drawBet, bool $valide): void
    {
        if ($valide == true) {
            $this -> drawBet = $drawBet;
        }
    }


    public function getAddEarnings(): ?float
    {
        return $this -> withAddEarnings / 100;
    }

    public function AddEarnings(?int $Earnings, bool $statusEarnings)
    {
        $result = false;
        if ($statusEarnings == true) {
            $this -> withAddEarnings = $Earnings * 100;
            $this->credit += ($Earnings * 100);
            $result = true;
        }

        return $result;
    }
}
