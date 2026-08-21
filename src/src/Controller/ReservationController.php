<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Exception\RegleMetierException;
use App\Form\ReservationType;
use App\Model\ReservationRequest;
use App\Service\Reservation\DisponibiliteService;
use App\Service\Reservation\ReservationService;
use App\Service\Reservation\TarificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation', requirements: ['id' => '\\d+'])]
    public function reserver(
        Sortie $sortie,
        Request $request,
        ReservationService $service,
        DisponibiliteService $disponibilite,
        TarificationService $tarification,
    ): Response {
        $data = new ReservationRequest();
        $user = $this->getUser();
        if ($user instanceof Utilisateur) {
            $data->prenom = $user->getPrenom(); $data->nom = $user->getNom();
            $data->email = $user->getEmail(); $data->telephone = $user->getTelephone() ?? '';
        }
        $form = $this->createForm(ReservationType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $reservation = $service->reserver($sortie, $data, $user instanceof Utilisateur ? $user : null);
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
