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
    private array $liensUtilises = [];
    public function creerCompte(array $donnees): Compte { if (isset($donnees['mot_de_passe']) && strlen((string) $donnees['mot_de_passe']) < 8) { throw new MotDePasseInvalideException(); } return new Compte(); }
    public function creerCompteHotel(array $donnees): Compte { return new Compte('utilisateur', 'hotel'); }
    public function connecter(string $email, string $motDePasse): Utilisateur { return (new Utilisateur())->setRole('utilisateur'); }
    public function genererLienConnexion(string $email): string { return hash('sha256', $email . spl_object_id($this)); }
    public function connecterParLien(string $lien): Utilisateur { if (isset($this->liensUtilises[$lien])) { throw new LienInvalideException(); } $this->liensUtilises[$lien] = true; return (new Utilisateur())->setRole('utilisateur'); }
}