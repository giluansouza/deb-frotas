<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class Edit extends Component
{
    public $plate, $renavam, $brand, $model, $year_manufacture, $year_model, $type, $fuel_type;
    public $tank_capacity, $administrative_unit, $ownership, $conservation_state, $visual_identity;

    public Vehicle $vehicle;

    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        $this->plate = $vehicle->plate;
        $this->renavam = $vehicle->renavam;
        $this->brand = $vehicle->brand;
        $this->model = $vehicle->model;
        $this->year_manufacture = $vehicle->year_manufacture;
        $this->year_model = $vehicle->year_model;
        $this->type = $vehicle->type;
        $this->fuel_type = $vehicle->fuel_type;
        $this->tank_capacity = $vehicle->tank_capacity;
        $this->administrative_unit = $vehicle->administrative_unit;
        $this->ownership = $vehicle->ownership;
        $this->conservation_state = $vehicle->conservation_state;
        $this->visual_identity = (bool) $vehicle->visual_identity;
    }

    protected $rules = [
        'plate' => 'required|string|max:7',
        'renavam' => 'required|string|max:11',
        'brand' => 'required|string|max:50',
        'model' => 'required|string|max:50',
        'year_manufacture' => 'required|integer|min:1900|max:2100',
        'year_model' => 'required|integer|min:1900|max:2100',
        'type' => 'required|string|max:50',
        'fuel_type' => 'required|string|max:50',
        'tank_capacity' => 'required|numeric|min:0',
        'administrative_unit' => 'required|string|max:50',
        'ownership' => 'required|string|max:50',
        'conservation_state' => 'required|string|max:50',
        'visual_identity' => 'nullable|boolean',
    ];

    protected function messages()
    {
        return [
            'plate.required' => 'A placa é obrigatória.',
            'renavam.required' => 'O renavam é obrigatório.',
            'brand.required' => 'A marca é obrigatória.',
            'model.required' => 'O modelo é obrigatório.',
            'year_manufacture.required' => 'O ano de fabricação é obrigatório.',
            'year_model.required' => 'O ano do modelo é obrigatório.',
            'type.required' => 'O tipo é obrigatório.',
            'fuel_type.required' => 'O tipo de combustível é obrigatório.',
            'tank_capacity.required' => 'A capacidade do tanque é obrigatória.',
            'administrative_unit.required' => 'A unidade administrativa é obrigatória.',
            'ownership.required' => 'A propriedade é obrigatória.',
            'conservation_state.required' => 'O estado de conservação é obrigatório.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'plate' => 'placa',
            'renavam' => 'renavam',
            'brand' => 'marca',
            'model' => 'modelo',
            'year_manufacture' => 'ano de fabricação',
            'year_model' => 'ano do modelo',
            'type' => 'tipo',
            'fuel_type' => 'tipo de combustível',
            'tank_capacity' => 'capacidade do tanque',
            'administrative_unit' => 'unidade administrativa',
            'ownership' => 'propriedade',
            'conservation_state' => 'estado de conservação',
            'visual_identity' => 'identidade visual',
        ];
    }

    public function update()
    {
        $validated = $this->validate();

        $validated['visual_identity'] = $this->visual_identity ? 1 : 0;

        $this->vehicle->update($validated);

        return redirect()->route('vehicle.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.vehicles.edit');
    }
}
