<?php
declare(strict_types=1);
namespace App\Entity;

final class Compte
{
    public function __construct(private string $role = 'utilisateur', private ?string $profil = null, private ?string $motDePasse = null, private ?string $email = null) {}
    public function getRole(): string { return $this->role; }
    public function getProfil(): ?string { return $this->profil; }
    public function getMotDePasse(): ?string { return $this->motDePasse; }
    public function getEmail(): ?string { return $this->email; }
}
