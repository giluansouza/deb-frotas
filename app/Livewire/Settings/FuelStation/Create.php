<?php

namespace App\Livewire\Settings\FuelStation;

use App\Models\FuelStation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $name, $cnpj, $location, $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'cnpj' => 'required|string|unique:fuel_stations,cnpj',
        'location' => 'required|string',
        'is_active' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        FuelStation::create([
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'location' => $this->location,
            'is_active' => $this->is_active,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('fuelstation.index')
            ->with('success', 'Posto cadastrado com sucesso!');
    }

    public function render()
    {
        return view('livewire.settings.fuel-station.create');
    }
}
