<?php

namespace App;

enum VehicleUsageStatus: string
{
    case Requested = 'requested';
    case Authorized = 'authorized';
    case Rejected = 'rejected';
    case InUse = 'in_use';
    case Returned = 'returned';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Requested => 'Solicitado',
            self::Authorized => 'Autorizado',
            self::Rejected => 'Rejeitado',
            self::InUse => 'Em uso',
            self::Returned => 'Devolvido',
            self::Cancelled => 'Cancelado',
        };
    }

    public function colorClass(): string
    {
        return match ($this) {
            self::Requested => 'text-blue-600',
            self::Authorized => 'text-green-600',
            self::Rejected => 'text-red-600',
            self::InUse => 'text-yellow-600',
            self::Returned => 'text-gray-600',
            self::Cancelled => 'text-red-600 line-through',
        };
    }

    public function isCancelled(): bool
    {
        return $this === self::Cancelled;
    }

    public function isRequested(): bool
    {
        return $this === self::Requested;
    }

    public function isAuthorized(): bool
    {
        return $this === self::Authorized;
    }

    public function isRejected(): bool
    {
        return $this === self::Rejected;
    }

    public function isInUse(): bool
    {
        return $this === self::InUse;
    }

    public function isReturned(): bool
    {
        return $this === self::Returned;
    }
}
