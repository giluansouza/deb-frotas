<?php

namespace App;

enum MaintenanceStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendente',
            self::InProgress => 'Em andamento',
            self::Completed => 'Concluída',
        };
    }

    public function colorClass(): string
    {
        return match ($this) {
            self::Pending => 'text-red-600',
            self::InProgress => 'text-yellow-600',
            self::Completed => 'text-green-600',
        };
    }
}
