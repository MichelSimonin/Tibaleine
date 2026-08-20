<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Utilisateur;

final class AutorisationService
{
    public function peutConsulter(Utilisateur $u): bool { return in_array($u->getRole(), ['employe', 'administrateur'], true); }
    public function peutModifier(Utilisateur $u): bool { return $u->getRole() === 'administrateur'; }
    public function peutAnnuler(Utilisateur $u): bool { return $u->getRole() === 'administrateur'; }
    public function peutAccederEspaceGestion(Utilisateur $u): bool { return in_array($u->getRole(), ['employe', 'administrateur'], true); }
}