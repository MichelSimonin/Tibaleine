<?php

declare(strict_types=1);

namespace App\Service\Notification;

use App\Entity\Notification;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\CanalNotification;
use App\Enum\EtatReservation;
use App\Enum\Langue;
use App\Enum\TypeNotification;
use App\Enum\UserRole;
use App\Integration\Notification\NotificationGatewayInterface;
use Doctrine\ORM\EntityManagerInterface;

final class NotificationService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly NotificationGatewayInterface $gateway,
    ) {}

    /** @return list<Notification> */
    public function tracerConfirmation(Reservation $reservation, ?Utilisateur $patron): array
    {
        $langue = $reservation->getUtilisateur()->getLangue();
        $notifications = [$this->envoyer(TypeNotification::CONFIRMATION, CanalNotification::EMAIL,
            $reservation->getUtilisateur(), $reservation, $reservation->getSortie(),
            $langue === Langue::EN ? 'Booking #'.$reservation->getId().' confirmed.' : 'Réservation n°'.$reservation->getId().' confirmée.')];
        if ($patron !== null) {
            $notifications[] = $this->envoyer(TypeNotification::CONFIRMATION, CanalNotification::SMS,
                $patron, $reservation, $reservation->getSortie(), 'Nouvelle réservation confirmée.');
        }
        return $notifications;
    }

    /** @return list<Notification> */
    public function tracerAvertissement(Sortie $sortie, string $message, ?\DateTimeImmutable $date = null): array
    {
        $date ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $notifications = [$this->envoyer(TypeNotification::AVERTISSEMENT, CanalNotification::POPUP_SITE, null, null, $sortie, $message, $date)];
        foreach ($sortie->getReservations() as $reservation) {
            if ($reservation->getEtat() !== EtatReservation::RESERVEE) { continue; }
            $utilisateur = $reservation->getUtilisateur();
            if ($utilisateur->getRoleMetier() === UserRole::HOTEL) {
                $notifications[] = $this->appelManuel(TypeNotification::AVERTISSEMENT, $utilisateur, $reservation, $sortie, 'Appeler l’hôtel partenaire pour l’avertissement météo.', $date);
                continue;
            }
            $contenu = $utilisateur->getLangue() === Langue::EN
                ? 'Weather warning: '.$message.' Free cancellation is available.'
                : 'Avertissement météo : '.$message.' Vous pouvez annuler sans frais.';
            $sms = $this->envoyer(TypeNotification::AVERTISSEMENT, CanalNotification::SMS, $utilisateur, $reservation, $sortie, $contenu, $date);
            $notifications[] = $sms;
            if ($sms->getStatut()->value === 'echec') {
                $notifications[] = $this->envoyer(TypeNotification::AVERTISSEMENT, CanalNotification::EMAIL, $utilisateur, $reservation, $sortie, $contenu, $date);
            }
        }
        return $notifications;
    }

    /** @return list<Notification> */
    public function tracerAnnulationSortie(Sortie $sortie, Reservation $reservation, string $message, ?\DateTimeImmutable $date = null): array
    {
        $date ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $utilisateur = $reservation->getUtilisateur();
        if ($utilisateur->getRoleMetier() === UserRole::HOTEL) {
            return [$this->appelManuel(TypeNotification::ANNULATION, $utilisateur, $reservation, $sortie, 'Appeler l’hôtel partenaire : '.$message, $date)];
        }
        $contenu = $utilisateur->getLangue() === Langue::EN
            ? 'Trip cancelled: '.$message.'. Choose a full refund or a new date.'
            : 'Sortie annulée : '.$message.'. Choisissez un remboursement intégral ou un report.';
        $notification = $this->envoyer(TypeNotification::ANNULATION, CanalNotification::SMS, $utilisateur, $reservation, $sortie, $contenu, $date);
        if ($notification->getStatut()->value === 'echec') {
            return [$notification, $this->envoyer(TypeNotification::ANNULATION, CanalNotification::EMAIL, $utilisateur, $reservation, $sortie, $contenu, $date)];
        }
        return [$notification];
    }

    public function tracerLienSolde(Reservation $reservation): Notification
    {
        $contenu = $reservation->getUtilisateur()->getLangue() === Langue::EN
            ? 'Your balance can be paid online until H-12. It will then be payable on site.'
            : 'Votre solde peut être payé en ligne jusqu’à H-12. Il sera ensuite à régler sur place.';
        return $this->envoyer(TypeNotification::LIEN_SOLDE, CanalNotification::EMAIL, $reservation->getUtilisateur(), $reservation, $reservation->getSortie(), $contenu);
    }

    private function envoyer(TypeNotification $type, CanalNotification $canal, ?Utilisateur $utilisateur, ?Reservation $reservation, ?Sortie $sortie, string $contenu, ?\DateTimeImmutable $date = null): Notification
    {
        $notification = (new Notification())->setType($type)->setCanal($canal)->setUtilisateur($utilisateur)
            ->setReservation($reservation)->setSortie($sortie)->setContenu($contenu);
        if ($date !== null) { $notification->setDateEnvoi($date); }
        if ($this->gateway->envoyer($canal, $utilisateur, $contenu)) { $notification->marquerEnvoyee(); }
        else { $notification->marquerEchec('Canal '.$canal->value.' indisponible.'); }
        $this->em->persist($notification);
        return $notification;
    }

    private function appelManuel(TypeNotification $type, Utilisateur $utilisateur, Reservation $reservation, Sortie $sortie, string $contenu, \DateTimeImmutable $date): Notification
    {
        $notification = (new Notification())->setType($type)->setCanal(CanalNotification::TELEPHONE)->setUtilisateur($utilisateur)
            ->setReservation($reservation)->setSortie($sortie)->setContenu($contenu)->setDateEnvoi($date);
        $this->em->persist($notification);
        return $notification;
    }
}
