<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Entity\Bateau;
use App\Entity\Document;
use App\Entity\Notification;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\CanalNotification;
use App\Enum\CanalPaiement;
use App\Enum\ChoixAnnulation;
use App\Enum\EtatReservation;
use App\Enum\EtatSortie;
use App\Enum\Langue;
use App\Enum\StatutNotification;
use App\Enum\StatutPaiement;
use App\Enum\TypeDocument;
use App\Enum\TypeNotification;
use App\Enum\TypePaiement;
use App\Enum\TypeSortie;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use App\Service\Annulation\AnnulationReservationService;
use App\Service\Annulation\AnnulationSortieService;
use App\Service\Facturation\FacturationHotelService;
use App\Service\Notification\AlerteMeteoService;
use App\Service\Paiement\SoldeService;
use App\Service\Reservation\BlocagePlacesService;
use App\Service\Reservation\EmbarquementService;
use App\Service\Reservation\ModificationReservationService;
use App\Service\Reservation\PlanningService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CorrectifsAuditTest extends KernelTestCase
{
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->em = self::getContainer()->get(EntityManagerInterface::class);
        $this->em->getConnection()->beginTransaction();
    }

    protected function tearDown(): void
    {
        $connection = $this->em->getConnection();
        while ($connection->getTransactionNestingLevel() > 0) { $connection->rollBack(); }
        $this->em->clear();
        parent::tearDown();
    }

    public function test_CASE_BOOK_06_et_07_blocages_deux_phases_et_expiration(): void
    {
        $maintenant = new \DateTimeImmutable('2030-01-01 10:00', new \DateTimeZone('Indian/Reunion'));
        $sortie = $this->sortie($maintenant->modify('+1 day'), 12);
        $this->reservation($sortie, $this->utilisateur(), 8);
        $this->em->flush();

        $blocages = self::getContainer()->get(BlocagePlacesService::class);
        $premier = $blocages->demarrer($sortie, null, $maintenant);
        $second = $blocages->demarrer($sortie, null, $maintenant);
        self::assertNotSame($premier->getJeton(), $second->getJeton());
        self::assertSame('formulaire', $premier->getPhase()->value);
        self::assertSame(2, $premier->getNombrePlaces());

        try {
            $blocages->demarrer($sortie, null, $maintenant);
            self::fail('Un troisième blocage devait dépasser la capacité.');
        } catch (RegleMetierException) {
            self::assertSame(2, $blocages->nettoyer($maintenant->modify('+15 minutes')));
        }
    }

    public function test_CASE_ALERT_01_03_et_HOTEL_notifications_ciblees_bilingues(): void
    {
        $instant = new \DateTimeImmutable('2030-02-10 18:00', new \DateTimeZone('Indian/Reunion'));
        $sortie = $this->sortie($instant->modify('+1 day'), 24);
        $this->reservation($sortie, $this->utilisateur(Langue::FR), 2);
        $this->reservation($sortie, $this->utilisateur(Langue::EN), 2);
        $this->reservation($sortie, $this->utilisateur(Langue::FR, UserRole::HOTEL), 2);
        $annulee = $this->reservation($sortie, $this->utilisateur(), 2);
        $annulee->setEtat(EtatReservation::ANNULEE);
        $this->em->flush();

        self::getContainer()->get(AlerteMeteoService::class)->avertir($sortie, 'Forte houle', $instant);
        $notifications = $this->em->getRepository(Notification::class)->findBy(['sortie' => $sortie, 'type' => TypeNotification::AVERTISSEMENT]);
        self::assertCount(4, $notifications);
        self::assertSame(EtatSortie::AVERTIE, $sortie->getEtat());
        self::assertCount(1, array_filter($notifications, static fn (Notification $n): bool => $n->getCanal() === CanalNotification::POPUP_SITE));
        self::assertCount(1, array_filter($notifications, static fn (Notification $n): bool => $n->getCanal() === CanalNotification::TELEPHONE && $n->getStatut() === StatutNotification::EN_ATTENTE));
        self::assertNotEmpty(array_filter($notifications, static fn (Notification $n): bool => str_contains((string) $n->getContenu(), 'Weather warning')));
        self::assertNotEmpty(array_filter($notifications, static fn (Notification $n): bool => str_contains((string) $n->getContenu(), 'Avertissement météo')));
    }

    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_rembourse_integral_et_libere_un_creneau_complet(): void
    {
        $maintenant = new \DateTimeImmutable('2030-03-01 10:00', new \DateTimeZone('Indian/Reunion'));
        $sortie = $this->sortie($maintenant->modify('+1 day'), 12)->setEtat(EtatSortie::AVERTIE);
        $reservation = $this->reservation($sortie, $this->utilisateur(), 12, '780.00', '234.00');
        $this->em->flush();

        $calcul = self::getContainer()->get(AnnulationReservationService::class)->traiter($reservation, $maintenant);
        self::assertSame('0.00', $calcul['frais']);
        self::assertSame('234.00', $calcul['remboursement']);
        self::assertSame(EtatReservation::ANNULEE, $reservation->getEtat());
        self::assertTrue($sortie->hasNouvellePlaceDisponible());
    }

    public function test_CASE_CANCEL_PRESTATAIRE_remboursement_integral_est_idempotent_et_exclusif(): void
    {
        $maintenant = new \DateTimeImmutable('2030-04-01 10:00', new \DateTimeZone('Indian/Reunion'));
        $sortie = $this->sortie($maintenant->modify('+1 day'), 12);
        $reservation = $this->reservation($sortie, $this->utilisateur(), 2, '130.00', '39.00');
        $this->em->flush();

        $service = self::getContainer()->get(AnnulationSortieService::class);
        self::assertSame(1, $service->annuler($sortie, 'Problème technique', $maintenant));
        self::assertSame('39.00', $service->rembourser($reservation));
        self::assertSame('39.00', $service->rembourser($reservation));
        self::assertSame(ChoixAnnulation::REMBOURSEMENT, $reservation->getChoixAnnulation());
        self::assertCount(1, array_filter($reservation->getPaiements()->toArray(), static fn (Paiement $p): bool => $p->getType() === TypePaiement::REMBOURSEMENT));

        $this->expectException(RegleMetierException::class);
        $service->reporter($reservation, $this->sortie($maintenant->modify('+2 days'), 12), $maintenant);
    }

    public function test_CASE_FACT_01_02_facture_hotel_remisee_et_reglement_idempotent(): void
    {
        $hotel = $this->utilisateur(Langue::FR, UserRole::HOTEL);
        $sortie = $this->sortie(new \DateTimeImmutable('2030-05-15 10:00', new \DateTimeZone('Indian/Reunion')), 12);
        $reservation = $this->reservation($sortie, $hotel, 2, '100.00', '0.00', StatutPaiement::EN_ATTENTE);
        $reservation->setSolde('100.00');
        $this->em->flush();

        $service = self::getContainer()->get(FacturationHotelService::class);
        $facture = $service->generer($hotel, new \DateTimeImmutable('2030-05-01'));
        self::assertSame('85.00', $facture->getMontant());
        self::assertSame('85.00', $reservation->getSolde());
        self::assertSame($facture, $service->generer($hotel, new \DateTimeImmutable('2030-05-01')));
        $service->enregistrerReglement($facture);
        $service->enregistrerReglement($facture);
        self::assertTrue($facture->estRegle());
        self::assertCount(1, $reservation->getPaiements());
    }

    public function test_CASE_PAY_09_JUSTIF_02_solde_idempotent_conserve_les_deux_documents(): void
    {
        $depart = new \DateTimeImmutable('+18 hours', new \DateTimeZone('Indian/Reunion'));
        $reservation = $this->reservation($this->sortie($depart, 12), $this->utilisateur(), 2, '100.00', '30.00');
        $reservation->setSolde('70.00')->addDocument((new Document())->setType(TypeDocument::JUSTIFICATIF_ACOMPTE)->setReference('JUS-'.bin2hex(random_bytes(6))));
        $this->em->flush();

        $service = self::getContainer()->get(SoldeService::class);
        $paiement = $service->payerEnLigne($reservation);
        self::assertSame($paiement, $service->payerEnLigne($reservation));
        self::assertSame(StatutPaiement::INTEGRALEMENT_PAYE, $reservation->getStatutPaiement());
        self::assertCount(2, $reservation->getDocuments());
        self::assertCount(1, array_filter($reservation->getDocuments()->toArray(), static fn (Document $d): bool => $d->getType() === TypeDocument::FACTURE_FINALE));
    }

    public function test_CASE_PAY_13_solde_impaye_refuse_embarquement(): void
    {
        $reservation = $this->reservation($this->sortie(new \DateTimeImmutable('+1 day'), 12), $this->utilisateur(), 2, '100.00', '30.00');
        $this->em->flush();
        try {
            self::getContainer()->get(EmbarquementService::class)->enregistrerParticipation($reservation);
            self::fail('L’embarquement devait être refusé.');
        } catch (RegleMetierException) {
            self::assertSame(EtatReservation::ANNULEE, $reservation->getEtat());
            self::assertStringContainsString('solde impayé', (string) $reservation->getMotifAnnulation());
        }
    }

    public function test_CASE_MODIF_02_03_acompte_fige_solde_recalcule_et_badge_place_liberee(): void
    {
        $maintenant = new \DateTimeImmutable('2030-06-01 10:00', new \DateTimeZone('Indian/Reunion'));
        $sortie = $this->sortie($maintenant->modify('+1 day'), 12);
        $reservation = $this->reservation($sortie, $this->utilisateur(), 12, '600.00', '180.00');
        $this->em->flush();

        self::getContainer()->get(ModificationReservationService::class)->modifierParticipants($reservation, 10, 0, $maintenant);
        self::assertSame('600.00', $reservation->getMontantInitial());
        self::assertSame('500.00', $reservation->getMontantCourant());
        self::assertSame('180.00', $reservation->getAcompte());
        self::assertSame('320.00', $reservation->getSolde());
        self::assertSame(StatutPaiement::ACOMPTE_PAYE, $reservation->getStatutPaiement());
        self::assertTrue($sortie->hasNouvellePlaceDisponible());
    }

    public function test_CASE_BOOK_11_17_planning_refuse_capacite_inconnue_et_double_creneau_baleine(): void
    {
        $planning = new PlanningService($this->em, $this->em->getRepository(Sortie::class));
        $date = new \DateTimeImmutable('2030-07-01', new \DateTimeZone('Indian/Reunion'));
        $heure = new \DateTimeImmutable('07:00', new \DateTimeZone('Indian/Reunion'));
        $premier = new Bateau('Planning-'.bin2hex(random_bytes(5)), 12);
        $second = new Bateau('Planning-'.bin2hex(random_bytes(5)), 24);
        $this->em->persist($premier);
        $this->em->persist($second);
        $this->em->flush();
        $planning->creer(TypeSortie::BALEINE, $date, $heure, $premier);

        try {
            $planning->creer(TypeSortie::BALEINE, $date, $heure, $second);
            self::fail('Le second créneau baleine devait être refusé.');
        } catch (RegleMetierException) {
            self::assertSame('02:30', $premier->getSorties()->first()->getDuree()->format('H:i'));
        }

        $this->expectException(RegleMetierException::class);
        $planning->creer(TypeSortie::DAUPHIN, $date->modify('+1 day'), $heure, new Bateau('Invalide', 18));
    }

    private function utilisateur(Langue $langue = Langue::FR, UserRole $role = UserRole::CLIENT): Utilisateur
    {
        $utilisateur = (new Utilisateur())->setPrenom('Test')->setNom('Audit')->setEmail(bin2hex(random_bytes(6)).'@audit.test')
            ->setTelephone('0692000000')->setLangue($langue)->setRoleMetier($role);
        $this->em->persist($utilisateur);
        return $utilisateur;
    }

    private function sortie(\DateTimeImmutable $depart, int $capacite): Sortie
    {
        $bateau = new Bateau('Audit-'.bin2hex(random_bytes(6)), $capacite);
        $sortie = (new Sortie())->setType(TypeSortie::DAUPHIN)->setDate($depart->setTime(0, 0))
            ->setHeureDepart(new \DateTimeImmutable($depart->format('H:i'), $depart->getTimezone()))
            ->setDuree(new \DateTimeImmutable('02:00', $depart->getTimezone()))->setBateau($bateau);
        $this->em->persist($bateau);
        $this->em->persist($sortie);
        return $sortie;
    }

    private function reservation(
        Sortie $sortie,
        Utilisateur $utilisateur,
        int $participants,
        string $montant = '100.00',
        string $acompte = '30.00',
        StatutPaiement $statut = StatutPaiement::ACOMPTE_PAYE,
    ): Reservation {
        $reservation = (new Reservation())->setUtilisateur($utilisateur)->setSortie($sortie)->setNbAdultes($participants)
            ->setMontantInitial($montant)->setMontantCourant($montant)->setAcompte($acompte)
            ->setSolde((string) number_format(max(0, (float) $montant - (float) $acompte), 2, '.', ''))->setStatutPaiement($statut);
        if ((float) $acompte > 0) {
            $reservation->addPaiement((new Paiement())->setType(TypePaiement::ACOMPTE)->setCanal(CanalPaiement::EN_LIGNE)
                ->setMontant($acompte)->setReferenceExterne('audit_'.bin2hex(random_bytes(8)))->confirmer());
        }
        $this->em->persist($reservation);
        return $reservation;
    }
}
