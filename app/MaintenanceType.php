<?php

namespace App;

enum MaintenanceType: string
{
    case Preventive = 'preventive';
    case Corrective = 'corrective';

    public function label(): string
    {
        return match ($this) {
            self::Preventive => 'Preventiva',
            self::Corrective => 'Corretiva',
        };
    }
}
