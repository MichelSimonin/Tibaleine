<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SortieRepository;
use App\Repository\NotificationRepository;
use App\Enum\CanalNotification;
use App\Enum\EtatSortie;
use App\Enum\TypeNotification;
use App\Service\Reservation\DisponibiliteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    #[Route('/planning/hotel', name: 'app_planning_hotel', defaults: ['hotel' => true])]
    public function index(
        Request $request,
        SortieRepository $sorties,
        NotificationRepository $notifications,
        DisponibiliteService $disponibilite,
        bool $hotel = false,
    ): Response
    {
        $timezone = new \DateTimeZone('Indian/Reunion');
        try { $date = new \DateTimeImmutable((string) $request->query->get('semaine', 'now'), $timezone); }
        catch (\Throwable) { $date = new \DateTimeImmutable('now', $timezone); }
        $start = $date->modify('monday this week')->setTime(0, 0);
        $parDate = [];
        $sortiesSemaine = $sorties->findForWeek($start);
        foreach ($sortiesSemaine as $sortie) {
            $key = $sortie->getDate()->format('Y-m-d');
            $parDate[$key][] = [
                'sortie' => $sortie,
                'places' => $disponibilite->placesRestantes($sortie),
                'reservable' => $disponibilite->estReservable($sortie, 2),
            ];
        }
        $jours = [];
        $nomsJours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
        for ($i = 0; $i < 7; ++$i) {
            $jour = $start->modify("+{$i} days");
            $jours[] = ['date' => $jour, 'libelle' => $nomsJours[$i], 'creneaux' => $parDate[$jour->format('Y-m-d')] ?? []];
        }
        $alertes = [];
        foreach ($sortiesSemaine as $sortie) {
            if ($sortie->getEtat() !== EtatSortie::AVERTIE) { continue; }
            $notification = $notifications->findOneBy([
                'sortie' => $sortie,
                'type' => TypeNotification::AVERTISSEMENT,
                'canal' => CanalNotification::POPUP_SITE,
            ], ['dateEnvoi' => 'DESC']);
            $alertes[] = ['sortie' => $sortie, 'message' => $notification?->getContenu()];
        }
        return $this->render('planning/index.html.twig', [
            'jours' => $jours, 'debut' => $start, 'hotel' => $hotel,
            'precedent' => $start->modify('-7 days'), 'suivant' => $start->modify('+7 days'),
            'alertes' => $alertes,
        ]);
    }
}
