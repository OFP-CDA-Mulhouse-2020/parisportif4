<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields="email", message="Email already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZÀ-ÿ-]{2,16}$/")
     * @Groups({"naming"})
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Groups({"email"})
     */
    private ?string $email;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\LessThanOrEqual(value="-18 years")
     */
    private ?DateTimeInterface $birthDate;
    /**
     * @ORM\Column (type="string", unique=true)
     * @Assert\NotBlank ()
     * @Assert\Regex(
     *     pattern="^/((\+)33|0)[1-9](\d{2}){4}$/")
     * @Groups({"naming"})
     */
    private string $phone;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Groups({"date"})
     */
    private DateTimeInterface $createDate;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     * @Groups({"date"})
     */
    private bool $userValidation = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $userValidationDate = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $userSuspended = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $userSuspendedDate = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $userDeleted = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $userDeletedDate = null;

    /**
     * @ORM\Column(type="json")
     */
    private ?array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="8",max="20")
     * @Assert\Regex(
     * pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/")
     * @Groups({"pass"})
     */
    private $plainPassword;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->createDate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): ?self
    {

        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): ?self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getPhone () : string
    {
        return $this -> phone;
    }

    public function setPhone ( string $phone ) : self
    {
        $this -> phone = $phone;
        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function getUserValidation(): ?bool
    {
        return $this->userValidation;
    }

    public function setUserValidation(): ?bool
    {
        return $this->userValidation = true;


    }

    public function getUserValidationDate(): ?\DateTimeInterface
    {
        return $this->userValidationDate;
    }

    public function isUserValidated(): self
    {
        $this->userValidation = true;
        $this->userValidationDate = new DateTime();

        return $this;
    }

    public function getUserSuspended(): ?bool
    {
        return $this->userSuspended;
    }

    public function setUserSuspended(): ?bool
    {
        return $this->userSuspended = true;
    }

    public function getUserSuspendedDate(): ?\DateTimeInterface
    {
        return $this->userSuspendedDate;
    }

    public function isUserSuspended(): self
    {
        $this->userSuspended = true;
        $this->userSuspendedDate = new DateTime();

        return $this;
    }

    public function getUserDeleted(): ?bool
    {
        return $this->userDeleted;
    }

    public function setUserDeleted(): ?bool
    {
        return $this->userDeleted = true;
    }

    public function getUserDeletedDate(): ?\DateTimeInterface
    {
        return $this->userDeletedDate;
    }

    public function isUserDeleted(): self
    {
        $this->userDeleted = true;
        $this->userDeletedDate = new DateTime();

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;// not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }
}
