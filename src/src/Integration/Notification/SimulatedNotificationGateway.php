<?php

declare(strict_types=1);

namespace App\Integration\Notification;

use App\Entity\Utilisateur;
use App\Enum\CanalNotification;

final class SimulatedNotificationGateway implements NotificationGatewayInterface
{
    public function __construct(
        private readonly bool $smsDisponible = true,
        private readonly bool $emailDisponible = true,
    ) {}

    public function envoyer(CanalNotification $canal, ?Utilisateur $destinataire, string $contenu): bool
    {
        return match ($canal) {
            CanalNotification::SMS => $this->smsDisponible,
            CanalNotification::EMAIL => $this->emailDisponible,
            CanalNotification::POPUP_SITE => true,
            CanalNotification::TELEPHONE => false,
        };
    }
}
