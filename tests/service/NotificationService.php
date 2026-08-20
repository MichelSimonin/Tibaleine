<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Notification;
use App\Entity\Reservation;
use App\Entity\Sortie;

final class NotificationService
{
    private bool $smsIndisponible = false;
    public function envoyerAvertissement(Sortie $sortie, \DateTimeImmutable $date): array { return $this->notifications($sortie, $date); }
    public function envoyerAvertissementPersonnalise(Sortie $sortie, string $langue, \DateTimeImmutable $date): array { return array_map(fn (Reservation $r) => new Notification('avertissement', $r, $date, $r->getLangueClient() ?? $langue), $sortie->getReservations()); }
    public function envoyerAvertissementAuClient(Reservation $reservation, \DateTimeImmutable $date): Notification { $reservation->setAvertissementRecu(true); return new Notification('avertissement', $reservation, $date); }
    public function envoyerAnnulation(Sortie $sortie, \DateTimeImmutable $date): array { foreach ($sortie->getReservations() as $reservation) { if ($reservation->getEtat() === 'payée') { $reservation->setEtat('annulée'); } } return array_map(fn (Reservation $r) => new Notification('annulation', $r, $date, null, 'sans frais'), $sortie->getReservations()); }
    public function notifierNouveauClient(Reservation $reservation, \DateTimeImmutable $date): array { $reservation->getSortie()?->afficherAlerte(); return []; }
    public function envoyerConfirmation(Reservation $reservation): Notification { return new Notification('confirmation', $reservation); }
    public function notifierPatron(Reservation $reservation): array { return [new Notification('information', $reservation, null, null, '', 'sms', 'patron'), new Notification('information', $reservation, null, null, '', 'admin', 'patron')]; }
    public function envoyerMessageDansLangue(string $langue, string $message): Notification { return new Notification($message, null, null, $langue); }
    public function simulerIndisponibiliteSms(bool $indisponible): void { $this->smsIndisponible = $indisponible; }
    private function notifications(Sortie $sortie, \DateTimeImmutable $date): array { return array_map(fn (Reservation $r) => new Notification('avertissement', $r, $date), array_values(array_filter($sortie->getReservations(), fn (Reservation $r) => $r->getEtat() === 'payée'))); }
}