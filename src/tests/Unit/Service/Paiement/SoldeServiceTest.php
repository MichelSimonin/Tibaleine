<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Paiement;

use App\Entity\Bateau;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Enum\TypeSortie;
use App\Service\Paiement\SoldeService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class SoldeServiceTest extends TestCase
{
    public function test_CASE_PAY_09_lien_solde_ouvert_entre_h24_et_h12_uniquement(): void
    {
        $service = new SoldeService($this->createStub(EntityManagerInterface::class));
        $maintenant = new \DateTimeImmutable('2026-08-21 10:00', new \DateTimeZone('Indian/Reunion'));
        self::assertTrue($service->paiementEnLigneOuvert($this->reservationAuDepart($maintenant->modify('+24 hours')), $maintenant));
        self::assertTrue($service->paiementEnLigneOuvert($this->reservationAuDepart($maintenant->modify('+12 hours +1 minute')), $maintenant));
        self::assertFalse($service->paiementEnLigneOuvert($this->reservationAuDepart($maintenant->modify('+12 hours')), $maintenant));
        self::assertFalse($service->paiementEnLigneOuvert($this->reservationAuDepart($maintenant->modify('+24 hours +1 minute')), $maintenant));
    }

    private function reservationAuDepart(\DateTimeImmutable $depart): Reservation
    {
        $sortie = (new Sortie())->setType(TypeSortie::DAUPHIN)->setBateau(new Bateau('Test', 12))
            ->setDate($depart->setTime(0, 0))->setHeureDepart(new \DateTimeImmutable($depart->format('H:i'), $depart->getTimezone()));
        return (new Reservation())->setSortie($sortie)->setSolde('70.00');
    }
}
