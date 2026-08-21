<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Enum\EtatReservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Paiement\SoldeService;
use App\Enum\UserRole;
use App\Enum\OrigineAnnulation;
use App\Exception\RegleMetierException;
use App\Service\Annulation\AnnulationSortieService;
use App\Repository\SortieRepository;
use App\Service\Paiement\ComplementService;

final class CompteController extends AbstractController
{
    #[Route('/mon-compte', name: 'app_compte')]
    public function index(SoldeService $soldes, ComplementService $complements, SortieRepository $sorties): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur || in_array($user->getRoleMetier(), [UserRole::EMPLOYEE, UserRole::ADMIN], true)) { throw $this->createAccessDeniedException(); }
        $paiementSoldeOuvert = [];
        $complementEnAttente = [];
        foreach ($user->getReservations() as $reservation) {
            $paiementSoldeOuvert[$reservation->getId()] = $soldes->paiementEnLigneOuvert($reservation);
            $complementEnAttente[$reservation->getId()] = $complements->complementEnAttente($reservation) !== null;
        }
        $maintenant = new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return $this->render('compte/index.html.twig', [
            'reservations' => $user->getReservations(), 'paiement_solde_ouvert' => $paiementSoldeOuvert,
            'complement_en_attente' => $complementEnAttente, 'sorties_report' => $sorties->findUpcoming($maintenant, 28),
        ]);
    }

    #[Route('/mon-compte/reservation/{id}/annulation', name: 'app_demande_annulation', methods: ['POST'])]
    public function demanderAnnulation(Reservation $reservation, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur || $user->getRoleMetier() !== UserRole::CLIENT || $reservation->getUtilisateur() !== $user) { throw $this->createAccessDeniedException(); }
        if (!$this->isCsrfTokenValid('annulation-'.$reservation->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }
        if ($reservation->getEtat() !== EtatReservation::RESERVEE || $reservation->getSortie()->getDepart() <= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'))) {
            $this->addFlash('error', 'Cette réservation ne peut plus faire l’objet d’une demande.');
        } else {
            $motif = trim((string) $request->request->get('motif'));
            if ($motif === '') { $this->addFlash('error', 'Le motif est obligatoire.'); }
            else { $reservation->setMotifAnnulation($motif); $em->flush(); $this->addFlash('success', 'Votre demande a été transmise à l’équipe.'); }
        }
        return $this->redirectToRoute('app_compte');
    }

    #[Route('/mon-compte/reservation/{id}/remboursement', name: 'app_choix_remboursement', methods: ['POST'])]
    public function choisirRemboursement(Reservation $reservation, Request $request, AnnulationSortieService $annulations): Response
    {
        $this->verifierProprietaire($reservation);
        if (!$this->isCsrfTokenValid('remboursement-'.$reservation->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        try { $montant = $annulations->rembourser($reservation); $this->addFlash('success', 'Remboursement enregistré : '.$montant.' €.'); }
        catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_compte');
    }

    #[Route('/mon-compte/reservation/{id}/report', name: 'app_choix_report', methods: ['POST'])]
    public function choisirReport(Reservation $reservation, Request $request, AnnulationSortieService $annulations, SortieRepository $sorties): Response
    {
        $this->verifierProprietaire($reservation);
        if (!$this->isCsrfTokenValid('report-'.$reservation->getId(), (string) $request->request->get('_token'))) { throw $this->createAccessDeniedException(); }
        $sortie = $sorties->find($request->request->getInt('sortie'));
        try {
            if ($sortie === null) { throw new RegleMetierException('Nouveau créneau introuvable.'); }
            $annulations->reporter($reservation, $sortie);
            $this->addFlash('success', 'Réservation reportée sur le nouveau créneau.');
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_compte');
    }

    private function verifierProprietaire(Reservation $reservation): void
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur || $reservation->getUtilisateur() !== $user || $reservation->getOrigineAnnulation() !== OrigineAnnulation::PRESTATAIRE) {
            throw $this->createAccessDeniedException();
        }
    }
}
