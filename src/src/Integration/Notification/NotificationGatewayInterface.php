<?php

declare(strict_types=1);

namespace App\Integration\Notification;

use App\Entity\Utilisateur;
use App\Enum\CanalNotification;

interface NotificationGatewayInterface
{
    public function envoyer(CanalNotification $canal, ?Utilisateur $destinataire, string $contenu): bool;
}
