<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SecurityAccessTest extends WebTestCase
{
    public function test_CASE_AUTH_07_employe_consulte_sans_action_de_gestion(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);
        $employe = $em->getRepository(Utilisateur::class)->findOneBy(['email' => 'employe@tibaleine.test']);
        self::assertNotNull($employe);
        $client->loginUser($employe);
        $client->request('GET', '/administration');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Gestion des réservations');
        self::assertSelectorTextNotContains('body', 'Annuler le créneau');
        self::assertSelectorTextNotContains('body', 'Solde payé');
    }

    public function test_CASE_AUTH_08_redirection_selon_le_role(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);
        foreach ([
            'client@tibaleine.test' => '/mon-compte',
            'hotel@tibaleine.test' => '/planning/hotel',
            'employe@tibaleine.test' => '/administration',
            'admin@tibaleine.test' => '/administration',
        ] as $email => $destination) {
            $utilisateur = $em->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);
            self::assertNotNull($utilisateur);
            $client->loginUser($utilisateur);
            $client->request('GET', '/connexion');
            self::assertResponseRedirects($destination);
        }
    }
}
