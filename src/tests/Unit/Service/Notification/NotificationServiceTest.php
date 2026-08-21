<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Notification;

use App\Entity\Bateau;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\CanalNotification;
use App\Enum\Langue;
use App\Enum\StatutNotification;
use App\Enum\TypeSortie;
use App\Exception\RegleMetierException;
use App\Integration\Notification\NotificationGatewayInterface;
use App\Service\Notification\AlerteMeteoService;
use App\Service\Notification\NotificationService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class NotificationServiceTest extends TestCase
{
    public function test_CASE_SYST_02_un_sms_en_echec_bascule_sur_email_et_conserve_la_trace(): void
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects(self::exactly(3))->method('persist');
        $gateway = new class implements NotificationGatewayInterface {
            public function envoyer(CanalNotification $canal, ?Utilisateur $destinataire, string $contenu): bool
            {
                return $canal !== CanalNotification::SMS;
            }
        };
        $service = new NotificationService($em, $gateway);
        $sortie = $this->sortie(new \DateTimeImmutable('2030-01-02 10:00'));
        (new Reservation())->setUtilisateur((new Utilisateur())->setLangue(Langue::EN))->setSortie($sortie);

        $notifications = $service->tracerAvertissement($sortie, 'Heavy swell', new \DateTimeImmutable('2030-01-01 18:00'));
        self::assertCount(3, $notifications);
        self::assertSame(StatutNotification::ECHEC, $notifications[1]->getStatut());
        self::assertSame(CanalNotification::EMAIL, $notifications[2]->getCanal());
        self::assertSame(StatutNotification::ENVOYEE, $notifications[2]->getStatut());
    }

    public function test_CASE_ALERT_01_avertissement_refuse_hors_de_18h_la_veille(): void
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects(self::never())->method('persist');
        $em->expects(self::never())->method('flush');
        $gateway = new class implements NotificationGatewayInterface {
            public function envoyer(CanalNotification $canal, ?Utilisateur $destinataire, string $contenu): bool { return true; }
        };
        $alertes = new AlerteMeteoService($em, new NotificationService($em, $gateway));
        $instant = new \DateTimeImmutable('2030-01-01 17:59', new \DateTimeZone('Indian/Reunion'));

        $this->expectException(RegleMetierException::class);
        $alertes->avertir($this->sortie($instant->modify('+1 day')), 'Houle', $instant);
    }

    private function sortie(\DateTimeImmutable $depart): Sortie
    {
        return (new Sortie())->setType(TypeSortie::DAUPHIN)->setBateau(new Bateau('Test', 12))
            ->setDate($depart->setTime(0, 0))->setHeureDepart(new \DateTimeImmutable($depart->format('H:i'), $depart->getTimezone()));
    }
}
