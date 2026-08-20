<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Document;
use App\Entity\Reservation;

final class DocumentService
{
    public function genererJustificatifAcompte(Reservation $reservation): Document
    {
        return new Document(
            'justificatif_acompte',
            'J-' . $reservation->getMontantTotal(),
            $reservation->getMontantTotal(),
        );
    }

    public function genererFactureFinale(Reservation $reservation, string $canal = 'en_ligne'): Document
    {
        return new Document(
            'facture_finale',
            'F-' . $canal . '-' . $reservation->getMontantTotal(),
            $reservation->getMontantTotal(),
        );
    }
}
