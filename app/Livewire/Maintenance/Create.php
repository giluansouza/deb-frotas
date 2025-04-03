<?php

namespace App\Livewire\Maintenance;

use App\MaintenanceStatus;
use App\MaintenanceType;
use App\Models\Maintenance;
use App\Models\RepairShop;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $vehicle_id;
    public $repair_shop_id;
    public $type;
    public $start_date;
    public $odometer;
    public $problem_description;
    public $cost;

    public $invoice_number;
    public $invoice_date;
    public $solution_description;
    public $end_date;

    public array $vehicles = [];
    public array $repairshops = [];
    public array $types = [];

    public function mount()
    {
        $this->vehicles = Vehicle::all()->toArray();
        $this->repairshops = RepairShop::all()->toArray();

        $this->types = collect(MaintenanceType::cases())
            ->mapWithKeys(fn($type) => [$type->value => $type->label()])
            ->toArray();
    }

    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'repair_shop_id' => 'required|exists:repair_shops,id',
            'type' => 'required|in:preventive,corrective',
            'start_date' => 'required|date',
            'odometer' => 'required|integer|min:0',
            'problem_description' => 'required|string',
            'cost' => 'required|numeric|min:0',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'vehicle_id' => 'veículo',
            'repair_shop_id' => 'oficina',
            'type' => 'tipo de manutenção',
            'start_date' => 'data da manutenção',
            'odometer' => 'hodômetro',
            'problem_description' => 'descrição do problema',
            'cost' => 'custo',
        ];
    }

    public function validationMessages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O :attribute selecionado é inválido.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'in' => 'O campo :attribute contém um valor inválido.',
        ];
    }

    public function save()
    {
        $this->validate(
            $this->rules(),
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $maintenance = new Maintenance([
            'vehicle_id' => $this->vehicle_id,
            'repair_shop_id' => $this->repair_shop_id,
            'authorized_by' => Auth::id(),
            'type' => MaintenanceType::from($this->type),
            'start_date' => $this->start_date,
            'odometer' => $this->odometer,
            'problem_description' => $this->problem_description,
            'cost' => $this->cost,
            'status' => MaintenanceStatus::Pending,
        ]);

        $maintenance->save();

        return redirect()->route('maintenance.index')
            ->with('message', 'Manutenção criada com sucesso!');
    }

    public function render()
    {
        return view('livewire.maintenance.create', [
            'isEdit' => false,
        ]);
    }
}
