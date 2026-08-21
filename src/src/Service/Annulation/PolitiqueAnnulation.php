<?php

declare(strict_types=1);

namespace App\Service\Annulation;

use App\Entity\Reservation;
use App\Enum\EtatSortie;
use App\Service\Paiement\Montant;

final class PolitiqueAnnulation
{
    /** @return array{frais: string, remboursement: string, complement: string} */
    public function calculer(Reservation $reservation, \DateTimeImmutable $maintenant): array
    {
        $depart = $reservation->getSortie()->getDepart();
        $secondes = $depart->getTimestamp() - $maintenant->getTimestamp();
        $taux = $reservation->getSortie()->getEtat() === EtatSortie::AVERTIE
            ? 0
            : ($secondes > 7 * 86400 ? 0 : ($secondes >= 48 * 3600 ? 25 : 50));
        $initial = Montant::enCentimes($reservation->getMontantInitial());
        $frais = (int) round($initial * $taux / 100, 0, PHP_ROUND_HALF_UP);
        $encaisse = array_sum(array_map(
            static fn ($p): int => $p->getStatut()->value === 'paye' && $p->getType()->value !== 'remboursement' ? Montant::enCentimes($p->getMontant()) : 0,
            $reservation->getPaiements()->toArray(),
        ));
        return [
            'frais' => Montant::depuisCentimes($frais),
            'remboursement' => Montant::depuisCentimes(max(0, $encaisse - $frais)),
            'complement' => Montant::depuisCentimes(max(0, $frais - $encaisse)),
        ];
    }
}
