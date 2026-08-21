<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\UserRole;
use App\Enum\TypeDocument;
use App\Exception\RegleMetierException;
use App\Repository\DocumentRepository;
use App\Repository\ReservationRepository;
use App\Repository\SortieRepository;
use App\Repository\UtilisateurRepository;
use App\Service\Annulation\AnnulationSortieService;
use App\Service\Annulation\AnnulationReservationService;
use App\Service\Facturation\FacturationHotelService;
use App\Service\Notification\AlerteMeteoService;
use App\Service\Paiement\SoldeService;
use App\Service\Reservation\EmbarquementService;
use App\Service\Reservation\ModificationReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration')]
final class AdministrationController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    public function index(
        ReservationRepository $reservations,
        SortieRepository $sorties,
        UtilisateurRepository $utilisateurs,
        DocumentRepository $documents,
    ): Response
    {
        $maintenant = new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return $this->render('administration/index.html.twig', [
            'reservations' => $reservations->findBy([], ['id' => 'DESC']),
            'sorties' => $sorties->findUpcoming($maintenant),
            'hotels' => $utilisateurs->findBy(['role' => UserRole::HOTEL]),
            'factures_hotel' => $documents->findBy(['type' => TypeDocument::FACTURE_HOTEL_MENSUELLE], ['id' => 'DESC']),
        ]);
    }

    #[Route('/reservation/{id}/annuler', name: 'app_admin_annuler', methods: ['POST'])]
    public function annuler(Reservation $reservation, Request $request, AnnulationReservationService $annulations): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-annuler-'.$reservation->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException();
        }
        try {
            $calcul = $annulations->traiter($reservation);
            $this->addFlash('success', sprintf('Annulation enregistrée. Frais : %s €, remboursement : %s €, complément : %s €.', $calcul['frais'], $calcul['remboursement'], $calcul['complement']));
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/reservation/{id}/solde', name: 'app_admin_solde', methods: ['POST'])]
    public function enregistrerSolde(Reservation $reservation, Request $request, SoldeService $soldes): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-solde-'.$reservation->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try {
            $soldes->payerSurPlace($reservation);
            $this->addFlash('success', 'Solde sur place enregistré et facture finale générée.');
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/sortie/{id}/avertir', name: 'app_admin_avertir_sortie', methods: ['POST'])]
    public function avertir(Sortie $sortie, Request $request, AlerteMeteoService $alertes): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-avertir-'.$sortie->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try {
            $alertes->avertir($sortie, (string) $request->request->get('message'));
            $this->addFlash('success', 'Avertissement publié et notifications simulées enregistrées.');
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/sortie/{id}/annuler', name: 'app_admin_annuler_sortie', methods: ['POST'])]
    public function annulerSortie(Sortie $sortie, Request $request, AnnulationSortieService $annulations): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-annuler-sortie-'.$sortie->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try {
            $nombre = $annulations->annuler($sortie, (string) $request->request->get('motif'));
            $this->addFlash('success', sprintf('Sortie annulée : %d réservation(s) notifiée(s), en attente du choix remboursement/report.', $nombre));
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/reservation/{id}/modifier', name: 'app_admin_modifier', methods: ['POST'])]
    public function modifier(Reservation $reservation, Request $request, ModificationReservationService $modifications): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-modifier-'.$reservation->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try {
            $modifications->modifierParticipants($reservation, $request->request->getInt('adultes'), $request->request->getInt('enfants'));
            $this->addFlash('success', 'Participants et solde mis à jour sans modifier l’acompte.');
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/reservation/{id}/embarquement', name: 'app_admin_embarquement', methods: ['POST'])]
    public function embarquement(Reservation $reservation, Request $request, EmbarquementService $embarquements): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-embarquement-'.$reservation->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try { $embarquements->enregistrerParticipation($reservation); $this->addFlash('success', 'Participation enregistrée.'); }
        catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/hotel/{id}/facture', name: 'app_admin_facture_hotel', methods: ['POST'])]
    public function factureHotel(Utilisateur $hotel, Request $request, FacturationHotelService $facturation): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-facture-hotel-'.$hotel->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try {
            $facture = $facturation->generer($hotel, new \DateTimeImmutable((string) $request->request->get('mois').'-01'));
            $this->addFlash('success', sprintf('Facture %s générée : %s € après remise de 15 %.', $facture->getReference(), $facture->getMontant()));
        } catch (\Throwable $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/facture/{id}/reglement', name: 'app_admin_reglement_facture', methods: ['POST'])]
    public function reglerFacture(Document $facture, Request $request, FacturationHotelService $facturation): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-regler-facture-'.$facture->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try { $facturation->enregistrerReglement($facture); $this->addFlash('success', 'Règlement hôtel enregistré une seule fois.'); }
        catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }
}
