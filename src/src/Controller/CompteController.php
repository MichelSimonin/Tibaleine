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

final class CompteController extends AbstractController
{
    #[Route('/mon-compte', name: 'app_compte')]
    public function index(SoldeService $soldes): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur) { throw $this->createAccessDeniedException(); }
        $paiementSoldeOuvert = [];
        foreach ($user->getReservations() as $reservation) { $paiementSoldeOuvert[$reservation->getId()] = $soldes->paiementEnLigneOuvert($reservation); }
        return $this->render('compte/index.html.twig', ['reservations' => $user->getReservations(), 'paiement_solde_ouvert' => $paiementSoldeOuvert]);
    }

    #[Route('/mon-compte/reservation/{id}/annulation', name: 'app_demande_annulation', methods: ['POST'])]
    public function demanderAnnulation(Reservation $reservation, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur || $reservation->getUtilisateur() !== $user) { throw $this->createAccessDeniedException(); }
        if (!$this->isCsrfTokenValid('annulation-'.$reservation->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }
        if ($reservation->getEtat() !== EtatReservation::RESERVEE || $reservation->getSortie()->getDepart() <= new \DateTimeImmutable()) {
            $this->addFlash('error', 'Cette réservation ne peut plus faire l’objet d’une demande.');
        } else {
            $motif = trim((string) $request->request->get('motif'));
            if ($motif === '') { $this->addFlash('error', 'Le motif est obligatoire.'); }
            else { $reservation->setMotifAnnulation($motif); $em->flush(); $this->addFlash('success', 'Votre demande a été transmise à l’équipe.'); }
        }
        return $this->redirectToRoute('app_compte');
    }
}
