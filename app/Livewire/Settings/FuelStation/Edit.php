<?php

namespace App\Livewire\Settings\FuelStation;

use App\Models\FuelStation;
use Livewire\Component;

class Edit extends Component
{
    public FuelStation $fuelstation;

    public $name, $cnpj, $location, $is_active;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'cnpj' => ['required', 'string', 'max:20', 'unique:fuel_stations,cnpj,' . $this->fuelstation->id],
            'location' => 'required|string',
            'is_active' => 'boolean',
        ];
    }

    public function mount(FuelStation $fuelstation)
    {
        $this->fuelstation = $fuelstation;
        $this->name = $fuelstation->name;
        $this->cnpj = $fuelstation->cnpj;
        $this->location = $fuelstation->location;
        $this->is_active = (bool) $fuelstation->is_active;
    }

    public function update()
    {
        $this->validate();

        $this->fuelstation->update([
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'location' => $this->location,
            'is_active' => $this->is_active,
        ]);

        return redirect()->route('fuelstation.index')
            ->with('success', 'Posto atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.settings.fuel-station.edit');
    }
}
