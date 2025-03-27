<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleListing extends Component
{
    public function render()
    {
        $vehicles = Vehicle::paginate();

        return view('livewire.veiculos.listagem-veiculos', compact('vehicles'));
    }
}
