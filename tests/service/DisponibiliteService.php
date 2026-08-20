<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Sortie;

final class DisponibiliteService
{
    public function estDisponible(Sortie $sortie): bool { return $sortie->getPlacesRestantes() > 0; }
    public function libererPlace(Sortie $sortie): void { $sortie->incrementerPlaces(1); }
    public function estReservable(Sortie $sortie, \DateTimeImmutable $maintenant): bool { return $sortie->getDate() === null || $sortie->getDate()->getTimestamp() - $maintenant->getTimestamp() > 7200; }
    public function verifierServiceExterne(string $service): string { return $service === 'paiement' ? 'indisponible' : 'disponible'; }
    public function messageIndisponibilite(string $service): string { return $service . ' indisponible'; }
}
