<?php

namespace App\Entity;

use App\Repository\SportCollectifRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SportCollectifRepository::class)
 */
class SportCollectif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(
     *     message="Le nombre de joueurs ne peut pas être vide"
     * )
     * @Assert\GreaterThanOrEqual(1)(
     *     message="Le nombre de joueurs doit être supérieur ou égal à 1"
     * )
     * @Groups({"nbJoueurs"})
     */
    private ?int $nombreJoueurs;

    public function getNombreJoueurs(): ?int
    {
        return $this->nombreJoueurs;
    }

    public function setNombreJoueurs(?int $nombreJoueurs): self
    {
        $this->nombreJoueurs = $nombreJoueurs;
        return $this;
    }
}
