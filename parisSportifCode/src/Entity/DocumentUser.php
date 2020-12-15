<?php

namespace App\Entity;

use App\Repository\DocumentUserRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $Document;

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
}
