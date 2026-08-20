<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-LANG-02 — Le message d'alerte/annulation est envoyé dans la langue du client
 * Spécification : SPEC-LANG-01 — Critère d'acceptation : AC-02
 */
final class CaseLang02Test extends TestCase
{
    public function test_CASE_LANG_02(): void
    {
        $notification = (new \App\Service\NotificationService())->envoyerMessageDansLangue('en', 'annulation');
        $this->assertSame('en', $notification->getLangue());
    }
}
