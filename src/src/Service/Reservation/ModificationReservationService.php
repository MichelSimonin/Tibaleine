<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Enum\CanalPaiement;
use App\Enum\EtatReservation;
use App\Enum\StatutOperation;
use App\Enum\StatutPaiement;
use App\Enum\TypePaiement;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use App\Service\Paiement\Montant;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

final class ModificationReservationService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly TarificationService $tarification,
        private readonly DisponibiliteService $disponibilite,
    ) {}

    public function modifierParticipants(Reservation $reservation, int $adultes, int $enfants, ?\DateTimeImmutable $maintenant = null): void
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $nouveauNombre = $adultes + $enfants;
        if ($reservation->getEtat() !== EtatReservation::RESERVEE || $nouveauNombre < 2 || $reservation->getSortie()->getDepart() <= $maintenant->modify('+2 hours')) {
            throw new RegleMetierException('La modification est impossible ou ne respecte pas le minimum de deux personnes.');
        }
        $this->em->getConnection()->beginTransaction();
        try {
            $sortie = $reservation->getSortie();
            $this->em->lock($sortie, LockMode::PESSIMISTIC_WRITE);
            $placesAvant = $this->disponibilite->placesRestantes($sortie, $maintenant);
            $ancienNombre = $reservation->getNombreParticipants();
            $placesMobilisables = $placesAvant + $ancienNombre;
            if ($nouveauNombre > $placesMobilisables) { throw new RegleMetierException('La capacité du bateau serait dépassée.'); }
            $nouveauMontant = $this->tarification->calculer($sortie, $adultes, $enfants);
            $encaisseNet = 0;
            foreach ($reservation->getPaiements() as $paiement) {
                if ($paiement->getStatut() !== StatutOperation::PAYE) { continue; }
                $signe = $paiement->getType() === TypePaiement::REMBOURSEMENT ? -1 : 1;
                $encaisseNet += $signe * Montant::enCentimes($paiement->getMontant());
            }
            $reservation->setNbAdultes($adultes)->setNbEnfants($enfants)->setMontantCourant($nouveauMontant);
            if ($placesAvant === 0 && $nouveauNombre < $ancienNombre) { $sortie->setNouvellePlaceDisponible(true); }
            $difference = Montant::enCentimes($nouveauMontant) - $encaisseNet;
            if ($difference < 0) {
                $reservation->addPaiement((new Paiement())->setType(TypePaiement::REMBOURSEMENT)->setCanal(CanalPaiement::EN_LIGNE)
                    ->setMontant(Montant::depuisCentimes(-$difference))->setReferenceExterne('remb_modif_'.$reservation->getId().'_'.bin2hex(random_bytes(4)))->confirmer());
                $difference = 0;
            }
            $reservation->setSolde(Montant::depuisCentimes($difference));
            if ($difference === 0) {
                $reservation->setStatutPaiement(StatutPaiement::INTEGRALEMENT_PAYE);
            } else {
                $reservation->setStatutPaiement($reservation->getUtilisateur()->getRoleMetier() === UserRole::HOTEL
                    ? StatutPaiement::EN_ATTENTE : StatutPaiement::ACOMPTE_PAYE);
            }
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }
}
