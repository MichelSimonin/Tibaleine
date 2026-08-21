<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Enum\UserRole;
use App\Service\Facturation\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DocumentController extends AbstractController
{
    #[Route('/document/{id}.pdf', name: 'app_document_pdf', methods: ['GET'])]
    public function telecharger(Document $document, DocumentService $documents): Response
    {
        $utilisateur = $this->getUser();
        if (!$utilisateur instanceof Utilisateur) { throw $this->createAccessDeniedException(); }
        $interne = in_array($utilisateur->getRoleMetier(), [UserRole::ADMIN, UserRole::EMPLOYEE], true);
        $proprietaire = $document->getReservations()->exists(
            static fn (int $index, Reservation $reservation): bool => $reservation->getUtilisateur() === $utilisateur,
        );
        if (!$interne && !$proprietaire) { throw $this->createAccessDeniedException(); }

        return new Response($documents->genererPdf($document), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => HeaderUtils::makeDisposition(HeaderUtils::DISPOSITION_ATTACHMENT, $document->getReference().'.pdf'),
        ]);
    }
}
