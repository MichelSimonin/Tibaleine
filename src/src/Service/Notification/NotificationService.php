<?php

declare(strict_types=1);

namespace App\Service\Notification;

use App\Entity\Notification;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\CanalNotification;
use App\Enum\TypeNotification;
use Doctrine\ORM\EntityManagerInterface;

final class NotificationService
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function tracerConfirmation(Reservation $reservation, ?Utilisateur $patron): void
    {
        $client = (new Notification())->setType(TypeNotification::CONFIRMATION)->setCanal(CanalNotification::EMAIL)
            ->setUtilisateur($reservation->getUtilisateur())->setReservation($reservation)->setSortie($reservation->getSortie())
            ->setContenu('Confirmation de la réservation #'.$reservation->getId().' (envoi simulé).');
        $this->em->persist($client);

        if ($patron !== null) {
            $admin = (new Notification())->setType(TypeNotification::CONFIRMATION)->setCanal(CanalNotification::SMS)
                ->setUtilisateur($patron)->setReservation($reservation)->setSortie($reservation->getSortie())
                ->setContenu('Nouvelle réservation confirmée (SMS simulé).');
            $this->em->persist($admin);
        }
    }

    public function tracerAvertissement(Sortie $sortie, string $message): void
    {
        $this->em->persist((new Notification())->setType(TypeNotification::AVERTISSEMENT)->setCanal(CanalNotification::POPUP_SITE)
            ->setSortie($sortie)->setContenu($message));
        foreach ($sortie->getReservations() as $reservation) {
            $this->em->persist((new Notification())->setType(TypeNotification::AVERTISSEMENT)->setCanal(CanalNotification::SMS)
                ->setUtilisateur($reservation->getUtilisateur())->setReservation($reservation)->setSortie($sortie)
                ->setContenu($message.' / Weather warning: free cancellation is available. (envoi simulé)'));
        }
    }

    public function tracerAnnulationSortie(Sortie $sortie, Reservation $reservation, string $message): void
    {
        $this->em->persist((new Notification())->setType(TypeNotification::ANNULATION)->setCanal(CanalNotification::EMAIL)
            ->setUtilisateur($reservation->getUtilisateur())->setReservation($reservation)->setSortie($sortie)
            ->setContenu($message.' / Trip cancelled: full refund recorded. (envoi simulé)'));
    }

    public function tracerLienSolde(Reservation $reservation): void
    {
        $this->em->persist((new Notification())->setType(TypeNotification::LIEN_SOLDE)->setCanal(CanalNotification::EMAIL)
            ->setUtilisateur($reservation->getUtilisateur())->setReservation($reservation)->setSortie($reservation->getSortie())
            ->setContenu('Votre solde peut être payé en ligne jusqu’à 12 h avant le départ. Après cette échéance, il sera à régler sur place. / Your balance can be paid online until H-12. (envoi simulé)'));
    }
}
