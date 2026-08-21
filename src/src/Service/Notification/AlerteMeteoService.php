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

    public function avertir(Sortie $sortie, string $message): void
    {
        if ($sortie->getEtat() !== EtatSortie::PLANIFIEE || $sortie->getDepart() <= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'))) {
            throw new RegleMetierException('Cette sortie ne peut pas recevoir un avertissement.');
        }
        $message = trim($message) ?: 'Météo incertaine : la sortie reste maintenue pour le moment. Vous pouvez annuler sans frais.';
        $sortie->setEtat(EtatSortie::AVERTIE);
        $this->notifications->tracerAvertissement($sortie, $message);
        $this->em->flush();
    }
}
