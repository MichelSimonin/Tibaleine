<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Compte;
use App\Entity\Utilisateur;
use App\Exception\EmailDejaUtiliseException;
use App\Exception\LienInvalideException;
use App\Exception\MotDePasseInvalideException;

final class CompteService
{
    private array $comptes = [];
    private array $utilisateurs = [];
    private array $liens = [];

    public function creerCompte(array $donnees): Compte
    {
        $email = (string) ($donnees['email'] ?? '');
        if (isset($this->comptes[$email])) {
            throw new EmailDejaUtiliseException('Cet email est déjà utilisé.');
        }

        $motDePasse = $donnees['mot_de_passe'] ?? null;
        if ($motDePasse !== null && (strlen((string) $motDePasse) < 8 || preg_match('/[^a-zA-Z0-9]/', (string) $motDePasse) !== 1)) {
            throw new MotDePasseInvalideException('Le mot de passe doit contenir au moins huit caractères et un caractère spécial.');
        }

        $compte = new Compte('utilisateur', null, $motDePasse === null ? null : (string) $motDePasse, $email);
        $this->comptes[$email] = $compte;
        $this->utilisateurs[$email] = (new Utilisateur())->setEmail($email)->setRole('utilisateur');
        return $compte;
    }

    public function creerCompteHotel(array $donnees): Compte
    {
        return new Compte('hotel', null, null, (string) ($donnees['email'] ?? ''));
    }

    public function enregistrerUtilisateur(Utilisateur $utilisateur, string $motDePasse): void
    {
        $email = (string) $utilisateur->getEmail();
        $this->utilisateurs[$email] = $utilisateur;
        $this->comptes[$email] = new Compte((string) $utilisateur->getRole(), null, $motDePasse, $email);
    }

    public function connecter(string $email, string $motDePasse): Utilisateur
    {
        $compte = $this->comptes[$email] ?? null;
        if ($compte === null || $compte->getMotDePasse() !== $motDePasse) {
            throw new MotDePasseInvalideException('Identifiants invalides.');
        }
        return $this->utilisateurs[$email];
    }

    public function genererLienConnexion(string $email): string
    {
        $lien = hash('sha256', $email . spl_object_id($this) . count($this->liens));
        $this->liens[$lien] = ['email' => $email, 'utilise' => false];
        return $lien;
    }

    public function connecterParLien(string $lien): Utilisateur
    {
        if (!isset($this->liens[$lien]) || $this->liens[$lien]['utilise']) {
            throw new LienInvalideException('Lien invalide ou déjà utilisé.');
        }
        $this->liens[$lien]['utilise'] = true;
        $email = $this->liens[$lien]['email'];
        return $this->utilisateurs[$email] ?? (new Utilisateur())->setEmail($email)->setRole('utilisateur');
    }

    public function nombreComptes(): int { return count($this->comptes); }
}
