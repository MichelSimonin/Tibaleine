<?php

declare(strict_types=1);

namespace App\Service\Annulation;

use App\Entity\Paiement;
use App\Entity\Sortie;
use App\Enum\CanalPaiement;
use App\Enum\EtatReservation;
use App\Enum\EtatSortie;
use App\Enum\StatutOperation;
use App\Enum\StatutPaiement;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use App\Service\Notification\NotificationService;
use App\Service\Paiement\Montant;
use Doctrine\ORM\EntityManagerInterface;

final class AnnulationSortieService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly NotificationService $notifications,
    ) {}

    public function annulerEtRembourser(Sortie $sortie, string $motif): int
    {
        if ($sortie->getEtat() === EtatSortie::ANNULEE || $sortie->getDepart() <= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'))) {
            throw new RegleMetierException('Cette sortie ne peut plus être annulée.');
        }
        $sortie->setEtat(EtatSortie::ANNULEE);
        $nombre = 0;
        foreach ($sortie->getReservations() as $reservation) {
            if ($reservation->getEtat() !== EtatReservation::RESERVEE) {
                continue;
            }
            $encaisse = 0;
            foreach ($reservation->getPaiements() as $paiement) {
                if ($paiement->getStatut() === StatutOperation::PAYE && $paiement->getType() !== TypePaiement::REMBOURSEMENT) {
                    $encaisse += Montant::enCentimes($paiement->getMontant());
                }
            }
            $reservation->setEtat(EtatReservation::ANNULEE)->setMotifAnnulation(trim($motif) ?: 'Annulation de la sortie par Ti Baleine');
            if ($encaisse > 0) {
                $reservation->addPaiement((new Paiement())->setType(TypePaiement::REMBOURSEMENT)->setCanal(CanalPaiement::EN_LIGNE)
                    ->setMontant(Montant::depuisCentimes($encaisse))->setReferenceExterne('test_remb_sortie_'.bin2hex(random_bytes(8)))->confirmer());
                $reservation->setStatutPaiement(StatutPaiement::REMBOURSE);
            }
            $this->notifications->tracerAnnulationSortie($sortie, $reservation, $reservation->getMotifAnnulation() ?? 'Sortie annulée');
            ++$nombre;
        }
        $this->em->flush();

        return $nombre;
    }
}
