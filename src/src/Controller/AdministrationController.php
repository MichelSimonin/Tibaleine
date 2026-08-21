<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Enum\CanalPaiement;
use App\Enum\EtatReservation;
use App\Enum\StatutPaiement;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use App\Repository\ReservationRepository;
use App\Repository\SortieRepository;
use App\Service\Annulation\AnnulationSortieService;
use App\Service\Annulation\PolitiqueAnnulation;
use App\Service\Notification\AlerteMeteoService;
use App\Service\Paiement\SoldeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration')]
final class AdministrationController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    public function index(ReservationRepository $reservations, SortieRepository $sorties): Response
    {
        $maintenant = new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return $this->render('administration/index.html.twig', [
            'reservations' => $reservations->findBy([], ['id' => 'DESC']),
            'sorties' => $sorties->findUpcoming($maintenant),
        ]);
    }

    #[Route('/reservation/{id}/annuler', name: 'app_admin_annuler', methods: ['POST'])]
    public function annuler(Reservation $reservation, Request $request, PolitiqueAnnulation $politique, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if (!$this->isCsrfTokenValid('admin-annuler-'.$reservation->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException();
        }
        if ($reservation->getEtat() !== EtatReservation::RESERVEE || $reservation->getSortie()->getDepart() <= new \DateTimeImmutable()) {
            $this->addFlash('error', 'Cette réservation ne peut plus être annulée.');
            return $this->redirectToRoute('app_admin');
        }
        $calcul = $politique->calculer($reservation, new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion')));
        $reservation->setEtat(EtatReservation::ANNULEE)->setMotifAnnulation($reservation->getMotifAnnulation() ?: 'Annulation traitée par le patron');
        if ((float) $calcul['remboursement'] > 0) {
            $paiement = (new Paiement())->setType(TypePaiement::REMBOURSEMENT)->setCanal(CanalPaiement::EN_LIGNE)
                ->setMontant($calcul['remboursement'])->setReferenceExterne('test_remb_'.bin2hex(random_bytes(8)))->confirmer();
            $reservation->addPaiement($paiement)->setStatutPaiement(StatutPaiement::REMBOURSE);
        }
        $em->flush();
        $this->addFlash('success', sprintf('Annulation enregistrée. Frais : %s €, remboursement simulé : %s €.', $calcul['frais'], $calcul['remboursement']));
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
            $nombre = $annulations->annulerEtRembourser($sortie, (string) $request->request->get('motif'));
            $this->addFlash('success', sprintf('Sortie annulée : %d réservation(s) remboursée(s) et notifiée(s).', $nombre));
        } catch (RegleMetierException $e) { $this->addFlash('error', $e->getMessage()); }
        return $this->redirectToRoute('app_admin');
    }
}
