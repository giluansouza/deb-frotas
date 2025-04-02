<?php

namespace App\Models;

use App\MaintenanceStatus;
use App\MaintenanceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'repair_shop_id',
        'authorized_by',
        'type',
        'start_date',
        'end_date',
        'odometer',
        'problem_description',
        'solution_description',
        'cost',
        'status',
        'invoice_number',
        'invoice_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'invoice_date' => 'date',
        'cost' => 'decimal:2',
        'type' => MaintenanceType::class,
        'status' => MaintenanceStatus::class,
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function repairShop()
    {
        return $this->belongsTo(RepairShop::class);
    }

    public function authorizedBy()
    {
        return $this->belongsTo(User::class, 'authorized_by');
    }

    public function delete()
    {
        if ($this->status !== 'pending') {
            throw new \Exception('Não é possível excluir uma manutenção que não esteja pendente.');
        }

        return parent::delete();
    }
}
