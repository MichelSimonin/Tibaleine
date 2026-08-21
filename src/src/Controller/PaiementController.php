<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Exception\RegleMetierException;
use App\Service\Paiement\SoldeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PaiementController extends AbstractController
{
    #[Route('/paiement/solde/{id}', name: 'app_payer_solde', methods: ['POST'])]
    public function payerSolde(Reservation $reservation, Request $request, SoldeService $soldes): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur || $reservation->getUtilisateur() !== $user) { throw $this->createAccessDeniedException(); }
        if (!$this->isCsrfTokenValid('payer-solde-'.$reservation->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try {
            $soldes->payerEnLigne($reservation);
            $this->addFlash('success', 'Solde payé en ligne (simulation) et facture finale générée.');
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_compte');
    }
}
