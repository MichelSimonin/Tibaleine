<?php

declare(strict_types=1);

namespace App\Service\Annulation;

use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Enum\CanalPaiement;
use App\Enum\ChoixAnnulation;
use App\Enum\EtatReservation;
use App\Enum\OrigineAnnulation;
use App\Enum\StatutPaiement;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use App\Service\Reservation\DisponibiliteService;
use Doctrine\ORM\EntityManagerInterface;

final class AnnulationReservationService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly PolitiqueAnnulation $politique,
        private readonly DisponibiliteService $disponibilite,
    ) {}

    /** @return array{frais: string, remboursement: string, complement: string} */
    public function traiter(Reservation $reservation, ?\DateTimeImmutable $maintenant = null): array
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($reservation->getEtat() !== EtatReservation::RESERVEE || $reservation->getSortie()->getDepart() <= $maintenant) {
            throw new RegleMetierException('Cette réservation ne peut plus être annulée.');
        }
        $sortieEtaitComplete = $this->disponibilite->placesRestantes($reservation->getSortie(), $maintenant) === 0;
        $calcul = $this->politique->calculer($reservation, $maintenant);
        $reservation->setEtat(EtatReservation::ANNULEE)->setOrigineAnnulation(OrigineAnnulation::CLIENT)
            ->setChoixAnnulation(ChoixAnnulation::REMBOURSEMENT)
            ->setMotifAnnulation($reservation->getMotifAnnulation() ?: 'Annulation client traitée par le patron');
        if ($sortieEtaitComplete) { $reservation->getSortie()->setNouvellePlaceDisponible(true); }
        if ((float) $calcul['remboursement'] > 0) {
            $reservation->addPaiement((new Paiement())->setType(TypePaiement::REMBOURSEMENT)->setCanal(CanalPaiement::EN_LIGNE)
                ->setMontant($calcul['remboursement'])->setReferenceExterne('remb_client_'.$reservation->getId())->confirmer())
                ->setStatutPaiement(StatutPaiement::REMBOURSE);
        }
        if ((float) $calcul['complement'] > 0) {
            $reservation->addPaiement((new Paiement())->setType(TypePaiement::COMPLEMENT)->setCanal(CanalPaiement::EN_LIGNE)
                ->setMontant($calcul['complement'])->setReferenceExterne('complement_'.$reservation->getId()));
        }
        $this->em->flush();
        return $calcul;
    }
}
