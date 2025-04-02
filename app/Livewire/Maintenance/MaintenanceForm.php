<?php

namespace App\Livewire\Maintenance;

use App\Models\Maintenance;
use App\Models\RepairShop;
use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;

class MaintenanceForm extends Component
{
    public Maintenance $maintenance;

    public $isEdit = false;

    public $vehicles;
    public $repairshops;
    public $users;

    public function mount(Maintenance $maintenance = null)
    {
        if (!$maintenance->exists) {
            // CREATE
            $this->maintenance = new Maintenance();
            $this->maintenance->status = 'pending';
            $this->maintenance->type = 'preventive';
            $this->isEdit = false;
        } else {
            // EDIT
            $this->maintenance = $maintenance;
            $this->isEdit = true;
        }

        $this->vehicles = Vehicle::all();
        $this->repairshops = RepairShop::all();
        $this->users = User::all();
    }

    public function rules()
    {
        // Podemos fazer regras condicionais baseadas no $this->maintenance->status
        return [
            'maintenance.vehicle_id'          => 'required|exists:vehicles,id',
            'maintenance.repair_shop_id'      => 'required|exists:repair_shops,id',
            'maintenance.authorized_by'       => 'required|exists:users,id',
            'maintenance.type'                => 'required|in:preventive,corrective',
            'maintenance.start_date'          => 'required|date',
            'maintenance.odometer'            => 'required|integer|min:0',
            'maintenance.problem_description' => 'required|string',
            'maintenance.cost'                => 'required|numeric|min:0',
            'maintenance.status'              => 'required|in:pending,in_progress,completed',

            // Campos que só fazem sentido quando "in_progress" ou "completed"
            'maintenance.solution_description' => 'nullable|string',

            // Campos que só fazem sentido quando "completed"
            'maintenance.end_date' => 'nullable|date|after_or_equal:maintenance.start_date',
            'maintenance.invoice_number' => 'nullable|string|max:255',
            'maintenance.invoice_date'   => 'nullable|date|after_or_equal:maintenance.start_date',
        ];
    }

    public function updatedMaintenanceStatus($value)
    {
        // Se mudar status para "completed", podemos forçar 'end_date' -> hoje, se quiser
        if ($value === 'completed' && !$this->maintenance->end_date) {
            $this->maintenance->end_date = now()->format('Y-m-d');
        }
    }

    public function save()
    {
        $this->validate();

        // Regras extras: se status = completed, end_date não pode estar nula
        if ($this->maintenance->status === 'completed' && !$this->maintenance->end_date) {
            $this->addError('maintenance.end_date', 'Data de conclusão é obrigatória ao finalizar');
            return;
        }

        // Salva no BD
        $this->maintenance->save();

        return redirect()->route('maintenance.index')
            ->with('message', $this->isEdit
                ? 'Manutenção atualizada com sucesso!'
                : 'Manutenção criada com sucesso!');
    }

    public function render()
    {
        return view('livewire.maintenance.maintenance-form');
    }
}
