<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Document;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\TypeDocument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DocumentDownloadTest extends WebTestCase
{
    public function test_CASE_JUSTIF_01_pdf_telechargeable_uniquement_par_son_proprietaire(): void
    {
        $client = static::createClient();
        $client->disableReboot();
        $em = static::getContainer()->get(EntityManagerInterface::class);
        $sortie = $em->getRepository(Sortie::class)->findOneBy([]);
        $proprietaire = $em->getRepository(Utilisateur::class)->findOneBy(['email' => 'client@tibaleine.test']);
        $autre = $em->getRepository(Utilisateur::class)->findOneBy(['email' => 'hotel@tibaleine.test']);
        self::assertNotNull($sortie);
        self::assertNotNull($proprietaire);
        self::assertNotNull($autre);

        $document = (new Document())->setType(TypeDocument::JUSTIFICATIF_ACOMPTE)
            ->setReference('JUS-HTTP-'.strtoupper(bin2hex(random_bytes(5))))->setMontant('39.00');
        $reservation = (new Reservation())->setUtilisateur($proprietaire)->setSortie($sortie)->setNbAdultes(2)
            ->setMontantInitial('130.00')->setMontantCourant('130.00')->setAcompte('39.00')->setSolde('91.00')->addDocument($document);
        $em->persist($document);
        $em->persist($reservation);
        $em->flush();

        $client->loginUser($proprietaire);
        $client->request('GET', '/document/'.$document->getId().'.pdf');
        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('Content-Type', 'application/pdf');
        self::assertStringStartsWith('%PDF-1.4', (string) $client->getResponse()->getContent());

        $client->loginUser($autre);
        $client->request('GET', '/document/'.$document->getId().'.pdf');
        self::assertResponseStatusCodeSame(403);

        $reservation = $em->find(Reservation::class, $reservation->getId());
        $document = $em->find(Document::class, $document->getId());
        self::assertNotNull($reservation);
        self::assertNotNull($document);
        $em->remove($reservation);
        $em->flush();
        $em->remove($document);
        $em->flush();
    }
}
