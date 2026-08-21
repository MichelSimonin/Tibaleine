<?php

declare(strict_types=1);

namespace App\Service\Paiement;

use App\Entity\Document;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Enum\CanalPaiement;
use App\Enum\EtatReservation;
use App\Enum\StatutOperation;
use App\Enum\StatutPaiement;
use App\Enum\TypeDocument;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

final class SoldeService
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function paiementEnLigneOuvert(Reservation $reservation, ?\DateTimeImmutable $maintenant = null): bool
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $secondes = $reservation->getSortie()->getDepart()->getTimestamp() - $maintenant->getTimestamp();
        return $reservation->getEtat() === EtatReservation::RESERVEE
            && Montant::enCentimes($reservation->getSolde()) > 0
            && $secondes <= 24 * 3600 && $secondes > 12 * 3600;
    }

    public function payerEnLigne(Reservation $reservation): Paiement
    {
        return $this->enregistrer($reservation, CanalPaiement::EN_LIGNE, 'solde_online_'.$reservation->getId(), true);
    }

    public function payerSurPlace(Reservation $reservation): Paiement
    {
        return $this->enregistrer($reservation, CanalPaiement::SUR_PLACE, 'solde_place_'.$reservation->getId(), false);
    }

    private function enregistrer(Reservation $reservation, CanalPaiement $canal, string $reference, bool $verifierFenetre): Paiement
    {
        $paiements = $this->em->getRepository(Paiement::class);
        $existant = $paiements->findOneBy(['referenceExterne' => $reference]);
        if ($existant !== null && $existant->getStatut() === StatutOperation::PAYE) { return $existant; }
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->lock($reservation, LockMode::PESSIMISTIC_WRITE);
            $operationExistante = $paiements->findOneBy(['reservation' => $reservation, 'type' => TypePaiement::SOLDE], ['id' => 'DESC']);
            if ($operationExistante !== null && $operationExistante->getStatut() === StatutOperation::PAYE) {
                $this->em->getConnection()->commit();
                return $operationExistante;
            }
            if ($canal === CanalPaiement::SUR_PLACE && $operationExistante !== null && $operationExistante->getStatut() === StatutOperation::EN_ATTENTE) {
                throw new RegleMetierException('Une tentative de paiement en ligne du solde est déjà en cours.');
            }
            if ($verifierFenetre && !$this->paiementEnLigneOuvert($reservation)) {
                throw new RegleMetierException('Le paiement en ligne du solde est disponible uniquement entre H-24 et H-12.');
            }
            if ($reservation->getEtat() !== EtatReservation::RESERVEE || Montant::enCentimes($reservation->getSolde()) <= 0) {
                throw new RegleMetierException('Le solde ne peut pas être enregistré.');
            }
            $paiement = (new Paiement())->setType(TypePaiement::SOLDE)->setCanal($canal)->setMontant($reservation->getSolde())
                ->setReferenceExterne($reference)->confirmer();
            $reservation->addPaiement($paiement)->setSolde('0.00')->setStatutPaiement(StatutPaiement::INTEGRALEMENT_PAYE);
            $facturePresente = $reservation->getDocuments()->exists(static fn (int $index, Document $document): bool => $document->getType() === TypeDocument::FACTURE_FINALE);
            if (!$facturePresente) {
                $reservation->addDocument((new Document())->setType(TypeDocument::FACTURE_FINALE)
                    ->setReference('FAC-'.strtoupper(bin2hex(random_bytes(5))))->setMontant($reservation->getMontantCourant()));
            }
            $this->em->flush();
            $this->em->getConnection()->commit();
            return $paiement;
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }
}
