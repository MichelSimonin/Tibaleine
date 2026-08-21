<?php

declare(strict_types=1);

namespace App\Enum;

enum UserRole: string
{
    case CLIENT = 'utilisateur';
    case HOTEL = 'hotel';
    case EMPLOYEE = 'employe';
    case ADMIN = 'administrateur';

    public function securityRole(): string
    {
        return match ($this) {
            self::CLIENT => 'ROLE_USER',
            self::HOTEL => 'ROLE_HOTEL',
            self::EMPLOYEE => 'ROLE_EMPLOYEE',
            self::ADMIN => 'ROLE_ADMIN',
        };
    }
}
