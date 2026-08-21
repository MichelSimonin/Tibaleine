<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PublicPagesTest extends WebTestCase
{
    public function test_CASE_DISP_01_pages_publiques_et_creneaux_accessibles(): void
    {
        $client = static::createClient();
        foreach (['/' => 'Bienvenue sur Ti Baleine App', '/planning' => 'Réservation de la semaine', '/informations' => 'Informations pratiques', '/contact' => 'Contact', '/connexion' => 'Se connecter'] as $url => $titre) {
            $client->request('GET', $url);
            self::assertResponseIsSuccessful($url);
            self::assertSelectorTextContains('h1', $titre);
        }
    }

    public function test_CASE_HOTEL_02_planning_hotel_demande_connexion(): void
    {
        $client = static::createClient();
        $client->request('GET', '/planning/hotel');
        self::assertResponseRedirects('http://localhost/connexion');
    }

    public function test_CASE_BOOK_01_planning_propose_les_types_dynamiquement_par_creneau(): void
    {
        $client = static::createClient();
        $client->request('GET', '/planning');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('.planning-help', 'horaire');
        self::assertSelectorExists('.slot-group');
        self::assertSelectorTextContains('.planning-page', 'Baleines');
        self::assertSelectorTextContains('.planning-page', 'Dauphins');
        self::assertSelectorTextContains('.planning-page', 'Privatisation');
    }
}
