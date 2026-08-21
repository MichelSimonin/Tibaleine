<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\UserRole;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'uniq_utilisateur_email', columns: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse email est déjà utilisée.')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $nom = '';

    #[ORM\Column(length: 100)]
    private string $prenom = '';

    #[ORM\Column(length: 180, unique: true)]
    private string $email = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motDePasse = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(enumType: UserRole::class)]
    private UserRole $role = UserRole::CLIENT;

    /** @var Collection<int, Reservation> */
    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = trim($nom); return $this; }
    public function getPrenom(): string { return $this->prenom; }
    public function setPrenom(string $prenom): self { $this->prenom = trim($prenom); return $this; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = mb_strtolower(trim($email)); return $this; }
    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): self { $this->telephone = $telephone ? trim($telephone) : null; return $this; }
    public function getRoleMetier(): UserRole { return $this->role; }
    public function setRoleMetier(UserRole $role): self { $this->role = $role; return $this; }
    public function getPassword(): ?string { return $this->motDePasse; }
    public function setPassword(?string $password): self { $this->motDePasse = $password; return $this; }
    public function getUserIdentifier(): string { return $this->email; }
    public function getRoles(): array { return array_values(array_unique(['ROLE_USER', $this->role->securityRole()])); }
    public function eraseCredentials(): void {}
    /** @return Collection<int, Reservation> */
    public function getReservations(): Collection { return $this->reservations; }
    public function getNomComplet(): string { return trim($this->prenom.' '.$this->nom); }
}
