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
    private ?int $credit;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCredit () : ?int
    {
        return $this -> credit;
    }

    public function setCredit ( ?int $credit ) : self
    {
        $this -> credit = $credit*100;
        return $this;
    }
}
