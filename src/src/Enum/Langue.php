<?php

declare(strict_types=1);

namespace App\Enum;

enum Langue: string
{
    case FR = 'fr';
    case EN = 'en';

    public function label(): string
    {
        return $this === self::FR ? 'Français' : 'English';
    }
}
