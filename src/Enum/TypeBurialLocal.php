<?php

namespace App\Enum;

enum TypeBurialLocal: string
{
    case JAZIGO = 'jazigo';
    case ALA_INFANTIL = 'ala_infantil';
    case QUADRA = 'quadra';

    public function label(): string
    {
        return match($this) {
            self::JAZIGO => 'Jazigo',
            self::ALA_INFANTIL => 'Ala Infantil',
            self::QUADRA => 'Quadra',
        };
    }
}
