<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Notification;
use App\Entity\Reservation;
use App\Entity\Sortie;

final class NotificationService
{
    private bool $smsIndisponible = false;
    private array $tracesEnvoi = [];

    public function envoyerAvertissement(Sortie $sortie, \DateTimeImmutable $date): array
    {
        $sortie->setAvertissementEnvoye($date)->afficherAlerte();
        $notifications = [];
        foreach ($sortie->getReservations() as $reservation) {
            if ($reservation->getEtat() !== 'payée' && $reservation->getEtat() !== 'réservée') {
                continue;
            }
            if ($reservation->estReservationHotel()) {
                $sortie->appelerHotel();
                continue;
            }
            $canal = $this->smsIndisponible ? 'email' : 'sms';
            $notifications[] = new Notification('avertissement', $reservation, $date, $reservation->getLangueClient(), '', $canal);
        }
        return $notifications;
    }

    public function envoyerAvertissementPersonnalise(Sortie $sortie, string $message, \DateTimeImmutable $date): array
    {
        return array_map(
            static fn (Reservation $reservation): Notification => new Notification(
                'avertissement',
                $reservation,
                $date,
                $reservation->getLangueClient() ?? 'fr',
                ($reservation->getLangueClient() === 'en' ? 'Weather warning: ' : 'Avertissement météo : ') . $message,
            ),
            $sortie->getReservations(),
        );
    }

    public function envoyerAvertissementAuClient(Reservation $reservation, \DateTimeImmutable $date): Notification
    {
        $reservation->setAvertissementRecu(true);
        $notification = new Notification('avertissement', $reservation, $date);
        $this->tracesEnvoi[] = $notification;
        return $notification;
    }

    public function getTracesEnvoi(): array { return $this->tracesEnvoi; }

    public function envoyerAnnulation(Sortie $sortie, \DateTimeImmutable $date): array
    {
        $sortie->setEtat('annulée');
        $notifications = [];
        foreach ($sortie->getReservations() as $reservation) {
            $reservation->setEtat('annulée');
            if ($reservation->estReservationHotel()) {
                $sortie->appelerHotel();
                continue;
            }
            $notifications[] = new Notification('annulation', $reservation, $date, null, 'Annulation sans frais');
        }
        return $notifications;
    }

    public function notifierNouveauClient(Reservation $reservation, \DateTimeImmutable $date): array
    {
        $reservation->getSortie()?->afficherAlerte();
        return [];
    }

    public function envoyerConfirmation(Reservation $reservation): Notification
    {
        return new Notification('confirmation', $reservation, null, $reservation->getLangueClient(), 'Acompte confirmé');
    }

    public function notifierPatron(Reservation $reservation): array
    {
        return [new Notification('information', $reservation, null, null, 'Nouvelle réservation', 'admin', 'patron')];
    }

    public function envoyerMessageDansLangue(string $langue, string $message): Notification
    {
        return new Notification($message, null, null, $langue, $message);
    }

    public function simulerIndisponibiliteSms(bool $indisponible): void { $this->smsIndisponible = $indisponible; }
}
