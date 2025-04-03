<?php

namespace App;

enum MaintenanceStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendente',
            self::InProgress => 'Em andamento',
            self::Completed => 'Concluída',
            self::Cancelled => 'Cancelada',
        };
    }

    public function colorClass(): string
    {
        return match ($this) {
            self::Pending => 'text-red-600',
            self::InProgress => 'text-yellow-600',
            self::Completed => 'text-green-600',
            self::Cancelled => 'text-gray-600 line-through',
        };
    }

    public function isCancelled(): bool
    {
        return $this === self::Cancelled;
    }

    public function isPending(): bool
    {
        return $this === self::Pending;
    }

    public function isCompleted(): bool
    {
        return $this === self::Completed;
    }

    public function canBeDeleted(): bool
    {
        return $this->isPending() || $this->isCancelled();
    }
}
