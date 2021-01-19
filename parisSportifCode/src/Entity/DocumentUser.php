<?php

namespace App\Entity;

use App\Repository\DocumentUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DocumentUserRepository::class)
 */
class DocumentUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $Document;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private ?bool $isValid = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocument()
    {
        return $this->Document;
    }

    public function setDocument($Document): self
    {
        $this->Document = $Document;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this -> isValid;
    }


    public function isValid(): self
    {
        $this -> isValid = true;
        return $this;
    }
}
