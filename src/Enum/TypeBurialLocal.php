<?php

namespace App\Enum;

enum TypeBurialLocal: string
{
    case JAZIGO = 'jazigo';
    case ALA_INFANTIL = 'ala_infantil';
    case QUADRA = 'quadra';
    case OSSUARIO_ADULTO = 'ossuario_adulto';
    case OSSUARIO_INFANTIL = 'ossuario_infantil';

    public function label(): string
    {
        return match($this) {
            self::JAZIGO => 'Jazigo',
            self::ALA_INFANTIL => 'Ala Infantil',
            self::QUADRA => 'Quadra',
            self::OSSUARIO_ADULTO => 'Ossuário Adulto',
            self::OSSUARIO_INFANTIL => 'Ossuário Infantil',
        };
    }
}
