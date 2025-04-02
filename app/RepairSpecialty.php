<?php

namespace App;

enum RepairSpecialty: string
{
    case GERAL = 'geral';
    case MOTOR = 'motor';
    case ELETRICA = 'eletrica';
    case FREIO = 'freio';
    case SUSPENSAO = 'suspensao';
    case CLIMATIZACAO = 'climatizacao';

    public function label(): string
    {
        return match ($this) {
            self::GERAL => 'Geral',
            self::MOTOR => 'Motor',
            self::ELETRICA => 'Elétrica',
            self::FREIO => 'Freio',
            self::SUSPENSAO => 'Suspensão',
            self::CLIMATIZACAO => 'Climatização',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn($case) => ['id' => $case->value, 'name' => $case->label()],
            self::cases()
        );
    }
}
