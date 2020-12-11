<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WalletRepository::class)
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
    private ?int $withdraw = null;

    private ?bool $isValid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCredit () : ?int
    {
        return $this -> credit;
    }

    public function getAddMoney () : ?int
    {
        return $this -> addMoney;
    }

    public function AddMoney ( ?int $addMoney ) : self
    {
        $this -> addMoney = $addMoney*100;
        $this->credit += ($addMoney*100);
        return $this;
    }



}
