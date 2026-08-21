<?php

declare(strict_types=1);

namespace App\Enum;

enum CanalNotification: string
{
    case SMS = 'sms';
    case EMAIL = 'email';
    case POPUP_SITE = 'popup_site';
    case TELEPHONE = 'telephone';
}
