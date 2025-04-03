<?php

namespace App\Livewire\Maintenance;

use App\MaintenanceStatus;
use App\MaintenanceType;
use App\Models\Maintenance;
use App\Models\RepairShop;
use App\Models\Vehicle;
use Livewire\Component;

class Edit extends Component
{
    public Maintenance $maintenance;

    public $vehicle_id;
    public $repair_shop_id;
    public $type;
    public $start_date;
    public $odometer;
    public $problem_description;
    public $cost;

    public $solution_description;
    public $end_date;
    public $invoice_number;
    public $invoice_date;
    public $status;

    public array $statuses = [];
    public array $types = [];
    public array $repairshops = [];
    public array $vehicles = [];

    public function mount(Maintenance $maintenance)
    {
        $this->authorize('update', $maintenance);

        $this->maintenance = $maintenance;

        $this->vehicle_id = $maintenance->vehicle_id;
        $this->repair_shop_id = $maintenance->repair_shop_id;
        $this->type = $maintenance->type->value;
        $this->start_date = $maintenance->start_date->format('Y-m-d');
        $this->odometer = $maintenance->odometer;
        $this->problem_description = $maintenance->problem_description;
        $this->cost = $maintenance->cost;

        $this->solution_description = $maintenance->solution_description;
        $this->end_date = optional($maintenance->end_date)?->format('Y-m-d');
        $this->invoice_number = $maintenance->invoice_number;
        $this->invoice_date = optional($maintenance->invoice_date)?->format('Y-m-d');
        $this->status = $maintenance->status->value;

        $this->vehicles = Vehicle::all()->toArray();
        $this->repairshops = RepairShop::all()->toArray();

        $this->types = collect(MaintenanceType::cases())
            ->mapWithKeys(fn($type) => [$type->value => $type->label()])
            ->toArray();

        $this->statuses = collect(MaintenanceStatus::cases())
            ->mapWithKeys(fn($status) => [$status->value => $status->label()])
            ->toArray();
    }

    protected function rules()
    {
        $rules = [
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'vehicle_id' => 'required|exists:vehicles,id',
            'repair_shop_id' => 'required|exists:repair_shops,id',
            'type' => 'required|in:preventive,corrective',
            'start_date' => 'required|date',
            'odometer' => 'required|integer|min:0',
            'problem_description' => 'required|string',
            'cost' => 'required|numeric|min:0',
        ];

        if ($this->status === MaintenanceStatus::InProgress->value) {
            $rules['solution_description'] = 'nullable|string';
        }

        if ($this->status === MaintenanceStatus::Completed->value) {
            $rules['solution_description'] = 'required|string';
            $rules['end_date'] = 'required|date|after_or_equal:' . $this->maintenance->start_date->format('Y-m-d');
            $rules['invoice_number'] = 'required|string|max:255';
            $rules['invoice_date'] = 'required|date|after_or_equal:' . $this->maintenance->start_date->format('Y-m-d');
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'solution_description.required' => 'A descrição da solução é obrigatória.',
            'end_date.required' => 'A data de conclusão é obrigatória.',
            'invoice_number.required' => 'O número da nota fiscal é obrigatório.',
            'invoice_date.required' => 'A data da nota fiscal é obrigatória.',
            'invoice_date.after_or_equal' => 'A data da nota fiscal deve ser igual ou posterior à data de início.',
            'end_date.after_or_equal' => 'A data de conclusão deve ser igual ou posterior à data de início.',
            'status.required' => 'O status é obrigatório.',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->maintenance->status = MaintenanceStatus::from($this->status);
        $this->maintenance->solution_description = $this->solution_description;

        if ($this->status === MaintenanceStatus::Completed->value) {
            $this->maintenance->end_date = $this->end_date;
            $this->maintenance->invoice_number = $this->invoice_number;
            $this->maintenance->invoice_date = $this->invoice_date;
        }

        $this->maintenance->save();

        return redirect()->route('maintenance.index')
            ->with('message', 'Manutenção atualizada com sucesso!');
    }

    public function render()
    {
        return view('livewire.maintenance.edit', [
            'isEdit' => true,
            'types' => $this->types,
        ]);
    }
}
