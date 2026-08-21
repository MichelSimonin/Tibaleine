<?php

declare(strict_types=1);

namespace App\Service\Facturation;

use App\Entity\Document;
use App\Integration\Pdf\SimplePdfGenerator;

final class DocumentService
{
    public function __construct(private readonly SimplePdfGenerator $pdf) {}

    public function genererPdf(Document $document): string
    {
        $lignes = [
            'Ti Baleine App',
            $document->getType()->value === 'justificatif_acompte' ? "Justificatif d'acompte" : 'Facture',
            'Reference : '.$document->getReference(),
            'Date : '.$document->getDateEmission()->format('d/m/Y'),
        ];
        if ($document->getMontant() !== null) { $lignes[] = 'Montant : '.$document->getMontant().' EUR'; }
        $reservations = $document->getReservations()->toArray();
        foreach (array_slice($reservations, 0, 12) as $reservation) {
            $lignes[] = sprintf('Reservation #%d - %s - %s - %s', $reservation->getId(), $reservation->getUtilisateur()->getNomComplet(),
                $reservation->getSortie()->getType()->label(), $reservation->getSortie()->getDate()->format('d/m/Y'));
        }
        if (count($reservations) > 12) { $lignes[] = sprintf('+ %d reservation(s) supplementaire(s)', count($reservations) - 12); }
        return $this->pdf->generer($lignes);
    }
}
