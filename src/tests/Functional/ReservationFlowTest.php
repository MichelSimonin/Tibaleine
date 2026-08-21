<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Notification;
use App\Enum\TypeSortie;
use App\Repository\SortieRepository;
use App\Service\Reservation\DisponibiliteCreneauService;
use App\Enum\StatutPaiement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReservationFlowTest extends WebTestCase
{
    public function test_CASE_BOOK_01_A1_client_reserve_et_paie_acompte_simule(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);
        /** @var SortieRepository $sorties */
        $sorties = $em->getRepository(Sortie::class);
        $disponibilite = static::getContainer()->get(DisponibiliteCreneauService::class);
        $sortie = null;
        foreach ($sorties->findBy(['type' => null], ['date' => 'DESC', 'heureDepart' => 'DESC']) as $candidate) {
            $options = $disponibilite->options($sorties->findForCreneau($candidate));
            if (array_filter($options, static fn (array $option): bool => $option['type'] === TypeSortie::DAUPHIN)) {
                $sortie = $candidate;
                break;
            }
        }
        self::assertNotNull($sortie);

        $crawler = $client->request('GET', '/reservation/'.$sortie->getId().'/'.TypeSortie::DAUPHIN->value);
        self::assertResponseIsSuccessful();
        $email = 'parcours+'.bin2hex(random_bytes(5)).'@tibaleine.test';
        $form = $crawler->selectButton('Valider et simuler le paiement')->form([
            'reservation[prenom]' => 'Nina',
            'reservation[nom]' => 'Test',
            'reservation[email]' => $email,
            'reservation[telephone]' => '0692123456',
            'reservation[nbAdultes]' => 2,
            'reservation[nbEnfants]' => 0,
            'reservation[motDePasse]' => 'Test1234!',
        ]);
        $client->submit($form);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'À bientôt sur l’océan !');
        $reservation = $em->getRepository(Reservation::class)->findOneBy([], ['id' => 'DESC']);
        self::assertNotNull($reservation);
        self::assertSame(StatutPaiement::ACOMPTE_PAYE, $reservation->getStatutPaiement());
        self::assertCount(1, $reservation->getPaiements());
        self::assertNotNull($reservation->getDocument());

        // Le test reste répétable sans remplir progressivement le créneau de démo.
        $utilisateur = $reservation->getUtilisateur();
        $document = $reservation->getDocument();
        $sortieReservee = $reservation->getSortie();
        foreach ($em->getRepository(Notification::class)->findBy(['reservation' => $reservation]) as $notification) { $em->remove($notification); }
        foreach ($reservation->getPaiements() as $paiement) { $em->remove($paiement); }
        $em->remove($reservation);
        if ($document !== null) { $em->remove($document); }
        $em->remove($utilisateur);
        $sortieReservee->libererType();
        $em->flush();
    }
}
