<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Supplement;
use App\Entity\Remboursement;
use App\Exception\LimitePlacesDepasseeException;

final class ReservationService
{
    private array $blocages = [];
    public function reserver(Reservation $reservation): Reservation { $reservation->setEtat('en attente'); return $reservation; }
    public function reserverPourHotel(array $creneaux): array { $reussies = []; $echouees = []; foreach ($creneaux as $creneau) { if (($creneau['nb'] ?? 0) <= 6) { $reussies[] = $creneau; } else { $echouees[] = $creneau; } } return ['reussies' => $reussies, 'echouees' => $echouees]; }
    public function bloquerPlace(Sortie $sortie, int $nombre, \DateTimeImmutable $date): void { $sortie->decrementerPlaces($nombre); $this->blocages[spl_object_id($sortie)] = ['nombre' => $nombre, 'date' => $date]; }
    public function libererSiExpire(Sortie $sortie, \DateTimeImmutable $date): void { $blocage = $this->blocages[spl_object_id($sortie)] ?? null; if ($blocage !== null && $date->getTimestamp() - $blocage['date']->getTimestamp() >= 900) { $sortie->incrementerPlaces($blocage['nombre']); unset($this->blocages[spl_object_id($sortie)]); } }
    public function canalDemandeModification(Reservation $reservation): string { return 'telephone'; }
    public function modifier(Reservation $reservation, array $modifications): Reservation { if (isset($modifications['ajouter_adultes'])) { $reservation->setNbAdultes($reservation->getNbAdultes() + (int) $modifications['ajouter_adultes']); } return $reservation; }
    public function ajouterParticipant(Reservation $reservation, int $nombre): Supplement { return new Supplement(); }
    public function supprimerParticipant(Reservation $reservation, int $nombre): Remboursement { $reservation->setNbAdultes(max(0, $reservation->getNbAdultes() - $nombre)); return new Remboursement(1.0); }
}