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
        if (!$this->isDeletable()) {
            throw new \Exception('Não é possível excluir uma manutenção que não esteja pendente ou cancelada.');
        }

        return parent::delete();
    }

    public function isDeletable(): bool
    {
        return $this->status->canBeDeleted();
    }

    // public static function validationRules(bool $scoped = true): array
    // {
    //     $prefix = $scoped ? 'maintenance.' : '';

    //     return [
    //         $prefix . 'vehicle_id' => 'required|exists:vehicles,id',
    //         $prefix . 'repair_shop_id' => 'required|exists:repair_shops,id',
    //         $prefix . 'authorized_by' => 'required|exists:users,id',
    //         $prefix . 'type' => 'required|in:preventive,corrective',
    //         $prefix . 'start_date' => 'required|date',
    //         $prefix . 'odometer' => 'required|integer|min:0',
    //         $prefix . 'problem_description' => 'required|string',
    //         $prefix . 'cost' => 'required|numeric|min:0',
    //         $prefix . 'status' => 'required|in:pending,in_progress,completed',
    //         $prefix . 'solution_description' => 'nullable|string',
    //         $prefix . 'end_date' => 'nullable|date|after_or_equal:start_date',
    //         $prefix . 'invoice_number' => 'nullable|string|max:255',
    //         $prefix . 'invoice_date' => 'nullable|date|after_or_equal:start_date',
    //     ];
    // }

    // public static function validationMessages(): array
    // {
    //     return [
    //         'required' => 'O campo :attribute é obrigatório.',
    //         'exists' => 'O :attribute selecionado é inválido.',
    //         'integer' => 'O campo :attribute deve ser um número inteiro.',
    //         'numeric' => 'O campo :attribute deve ser numérico.',
    //         'date' => 'O campo :attribute deve ser uma data válida.',
    //         'after_or_equal' => 'O campo :attribute deve ser igual ou posterior a :date.',
    //         'in' => 'O campo :attribute contém um valor inválido.',
    //     ];
    // }

    // public static function validationAttributes(): array
    // {
    //     return [
    //         'maintenance.vehicle_id' => 'veículo',
    //         'maintenance.repair_shop_id' => 'oficina',
    //         'maintenance.authorized_by' => 'responsável',
    //         'maintenance.type' => 'tipo de manutenção',
    //         'maintenance.start_date' => 'data da manutenção',
    //         'maintenance.end_date' => 'data de conclusão',
    //         'maintenance.odometer' => 'hodômetro',
    //         'maintenance.problem_description' => 'descrição do problema',
    //         'maintenance.solution_description' => 'descrição da solução',
    //         'maintenance.cost' => 'custo',
    //         'maintenance.status' => 'status',
    //         'maintenance.invoice_number' => 'número da nota fiscal',
    //         'maintenance.invoice_date' => 'data da nota fiscal',
    //     ];
    // }
}
