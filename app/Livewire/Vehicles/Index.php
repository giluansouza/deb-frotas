<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $vehicles = Vehicle::paginate();

        return view('livewire.vehicles.index', [
            'vehicles' => $vehicles,
            'successMessage' => session('success'),
        ]);
    }
}
