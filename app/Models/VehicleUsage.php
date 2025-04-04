<?php

namespace App\Models;

use App\VehicleUsageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'requested_by',
        'authorized_by',
        'garage_out_by',
        'garage_in_by',
        'unit_name',
        'purpose',
        'destination',
        'departure_datetime',
        'return_datetime',
        'km_start',
        'km_end',
        'status',
        'observations',
        'rejection_reason',
        'return_observations',
        'inspection_confirmed',
    ];

    protected $casts = [
        'departure_datetime' => 'datetime',
        'return_datetime' => 'datetime',
        'status' => VehicleUsageStatus::class,
        'inspection_confirmed' => 'boolean',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function authorizedBy()
    {
        return $this->belongsTo(User::class, 'authorized_by');
    }

    public function garageOutBy()
    {
        return $this->belongsTo(User::class, 'garage_out_by');
    }

    public function garageInBy()
    {
        return $this->belongsTo(User::class, 'garage_in_by');
    }

    protected static function booted(): void
    {
        static::saving(function (self $usage) {
            if (
                $usage->status === VehicleUsageStatus::Cancelled->value &&
                empty($usage->rejection_reason)
            ) {
                throw new \Exception('O motivo da rejeição é obrigatório quando o status for "Cancelado".');
            }
        });
    }
}
