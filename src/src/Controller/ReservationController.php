<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\TypeSortie;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use App\Form\ReservationType;
use App\Model\ReservationRequest;
use App\Service\Reservation\DisponibiliteService;
use App\Service\Reservation\ReservationService;
use App\Service\Reservation\TarificationService;
use App\Service\Reservation\BlocagePlacesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}/{type}', name: 'app_reservation', requirements: ['id' => '\\d+', 'type' => 'baleine|dauphin|privatisation'])]
    public function reserver(
        Sortie $sortie,
        TypeSortie $type,
        Request $request,
        ReservationService $service,
        DisponibiliteService $disponibilite,
        TarificationService $tarification,
        BlocagePlacesService $blocages,
    ): Response {
        $data = new ReservationRequest();
        $user = $this->getUser();
        $hotel = $user instanceof Utilisateur && $user->getRoleMetier() === UserRole::HOTEL;
        if ($hotel && $type === TypeSortie::PRIVATISATION) {
            $this->addFlash('error', 'La privatisation n’est pas disponible pour les réservations hôtel.');
            return $this->redirectToRoute('app_planning_hotel');
        }
        if ($user instanceof Utilisateur) {
            $data->prenom = $user->getPrenom(); $data->nom = $user->getNom();
            $data->email = $user->getEmail(); $data->telephone = $user->getTelephone() ?? '';
            $data->langue = $user->getLangue();
        }
        try {
            $bateauId = $request->query->getInt('bateau') ?: null;
            $sessionKey = sprintf('blocage_creneau_%d_%s_%s', $sortie->getId(), $type->value, $bateauId ?? 'auto');
            $blocage = $blocages->demarrerPourCreneau($sortie, $type, $bateauId, $request->getSession()->get($sessionKey));
            $request->getSession()->set($sessionKey, $blocage->getJeton());
            $data->blocageToken = $blocage->getJeton();
            $sortie = $blocage->getSortie();
        } catch (RegleMetierException $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute($hotel ? 'app_planning_hotel' : 'app_planning');
        }
        $form = $this->createForm(ReservationType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $reservation = $service->reserver($sortie, $data, $user instanceof Utilisateur ? $user : null);
                $request->getSession()->remove($sessionKey);
                return $this->render('reservation/success.html.twig', ['reservation' => $reservation]);
            } catch (RegleMetierException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }
        $prixExemple = null;
        try { $prixExemple = $tarification->calculer($sortie, 2, 0); } catch (\Throwable) {}
        return $this->render('reservation/form.html.twig', [
            'sortie' => $sortie, 'form' => $form, 'places' => $disponibilite->placesRestantes($sortie), 'prix_exemple' => $prixExemple,
        ]);
    }
}
