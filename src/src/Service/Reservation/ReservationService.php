<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Document;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\CanalPaiement;
use App\Enum\StatutPaiement;
use App\Enum\TypeDocument;
use App\Enum\TypePaiement;
use App\Enum\TypeSortie;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use App\Model\ReservationRequest;
use App\Repository\UtilisateurRepository;
use App\Service\Notification\NotificationService;
use App\Service\Paiement\CalculAcompte;
use App\Service\Paiement\Montant;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class ReservationService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UtilisateurRepository $utilisateurs,
        private readonly DisponibiliteService $disponibilite,
        private readonly TarificationService $tarification,
        private readonly CalculAcompte $calculAcompte,
        private readonly NotificationService $notifications,
        private readonly UserPasswordHasherInterface $hasher,
    ) {}

    public function reserver(Sortie $sortie, ReservationRequest $demande, ?Utilisateur $connecte = null): Reservation
    {
        $places = $demande->nbAdultes + $demande->nbEnfants;
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->lock($sortie, LockMode::PESSIMISTIC_WRITE);
            if (!$this->disponibilite->estReservable($sortie, $places)) {
                throw new RegleMetierException('Ce créneau ne dispose plus du nombre de places demandé ou le départ est trop proche.');
            }

            $utilisateur = $connecte ?? $this->utilisateurs->findOneBy(['email' => mb_strtolower($demande->email)]);
            if ($utilisateur === null) {
                $utilisateur = (new Utilisateur())->setPrenom($demande->prenom)->setNom($demande->nom)
                    ->setEmail($demande->email)->setTelephone($demande->telephone);
                if ($demande->motDePasse) { $utilisateur->setPassword($this->hasher->hashPassword($utilisateur, $demande->motDePasse)); }
                $this->em->persist($utilisateur);
            }

            $hotel = $utilisateur->getRoleMetier() === UserRole::HOTEL;
            if ($hotel && ($places > 6 || $sortie->getType() === TypeSortie::PRIVATISATION)) {
                throw new RegleMetierException('Un hôtel réserve au maximum 6 places et ne peut pas privatiser un bateau.');
            }

            $montant = $this->tarification->calculer($sortie, $demande->nbAdultes, $demande->nbEnfants);
            $acompte = $hotel ? '0.00' : $this->calculAcompte->calculer($montant, $sortie->getType());
            $reservation = (new Reservation())->setUtilisateur($utilisateur)->setSortie($sortie)
                ->setNbAdultes($demande->nbAdultes)->setNbEnfants($demande->nbEnfants)
                ->setMontantInitial($montant)->setMontantCourant($montant)->setAcompte($acompte)
                ->setSolde($hotel ? $montant : Montant::depuisCentimes(Montant::enCentimes($montant) - Montant::enCentimes($acompte)))
                ->setStatutPaiement($hotel ? StatutPaiement::EN_ATTENTE : StatutPaiement::ACOMPTE_PAYE);
            $this->em->persist($reservation);

            if (!$hotel) {
                $paiement = (new Paiement())->setType(TypePaiement::ACOMPTE)->setCanal(CanalPaiement::EN_LIGNE)
                    ->setMontant($acompte)->setReferenceExterne('test_acompte_'.bin2hex(random_bytes(8)))->confirmer();
                $reservation->addPaiement($paiement);
                $document = (new Document())->setType(TypeDocument::JUSTIFICATIF_ACOMPTE)
                    ->setReference('JUS-'.strtoupper(bin2hex(random_bytes(5))));
                $reservation->setDocument($document);
                $this->em->persist($document);
            }

            $this->em->flush();
            $patron = $this->utilisateurs->findOneBy(['role' => UserRole::ADMIN]);
            $this->notifications->tracerConfirmation($reservation, $patron);
            $this->em->flush();
            $this->em->getConnection()->commit();
            return $reservation;
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }
}
