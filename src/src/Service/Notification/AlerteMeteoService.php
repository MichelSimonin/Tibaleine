<?php

declare(strict_types=1);

namespace App\Service\Notification;

use App\Entity\Sortie;
use App\Enum\EtatSortie;
use App\Exception\RegleMetierException;
use Doctrine\ORM\EntityManagerInterface;

final class AlerteMeteoService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly NotificationService $notifications,
    ) {}

    public function avertir(Sortie $sortie, string $message, ?\DateTimeImmutable $maintenant = null): void
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($sortie->getEtat() !== EtatSortie::PLANIFIEE
            || $sortie->getDate()->format('Y-m-d') !== $maintenant->modify('+1 day')->format('Y-m-d')
            || $maintenant->format('H:i') !== '18:00') {
            throw new RegleMetierException('Cette sortie ne peut pas recevoir un avertissement.');
        }
        $message = trim($message) ?: 'Météo incertaine : la sortie reste maintenue pour le moment. Vous pouvez annuler sans frais.';
        $sortie->setEtat(EtatSortie::AVERTIE);
        $this->notifications->tracerAvertissement($sortie, $message, $maintenant);
        $this->em->flush();
    }
}
