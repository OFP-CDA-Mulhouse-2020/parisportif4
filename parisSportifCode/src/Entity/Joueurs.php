<?php

namespace App\Entity;

use App\Repository\JoueursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=JoueursRepository::class)
 */
class Joueurs
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
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\ExpressionLanguageSyntax(
     *     allowedVariables={"titulaire", "remplaçant", "suspendu", "blessé"}
     * )
     * @Groups({"status"})
     */
    private ?string $status;

    /**
     * @ORM\ManyToOne(targetEntity=SportIndividuel::class, inversedBy="joueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?SportIndividuel $joueurs;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="joueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Equipe $joueurs_equipe;

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getJoueurs(): ?SportIndividuel
    {
        return $this->joueurs;
    }

    public function setJoueurs(?SportIndividuel $joueurs): self
    {
        $this->joueurs = $joueurs;

        return $this;
    }

    public function getJoueursEquipe(): ?Equipe
    {
        return $this->joueurs_equipe;
    }

    public function setJoueursEquipe(?Equipe $joueurs_equipe): self
    {
        $this->joueurs_equipe = $joueurs_equipe;

        return $this;
    }


}
