<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Exception\AccesRefuseException;

final class ConsultationService
{
    public function listerReservations(Utilisateur $utilisateur, array $reservations): array { if (in_array($utilisateur->getRole(), ['employe', 'administrateur'], true)) { return $reservations; } return array_values(array_filter($reservations, fn (Reservation $r) => $r->getUtilisateur() === $utilisateur || ($utilisateur->getProfil() === 'hotel' && $r->getUtilisateur() === $utilisateur))); }
    public function actionsDeGestionDisponibles(Utilisateur $utilisateur): bool { return $utilisateur->getRole() === 'administrateur'; }
    public function accederReservation(Utilisateur $utilisateur, Reservation $reservation): Reservation { if ($reservation->getUtilisateur() !== $utilisateur) { throw new AccesRefuseException(); } return $reservation; }
    public function modifierReservation(Utilisateur $utilisateur, Reservation $reservation): Reservation { if ($utilisateur->getRole() !== 'administrateur') { throw new AccesRefuseException(); } return $reservation; }
    public function getDisponibilite(Sortie $sortie): Sortie { return $sortie; }
}