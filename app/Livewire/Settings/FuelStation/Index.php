<?php

namespace App\Livewire\Settings\FuelStation;

use App\Models\FuelStation;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $fuelStations = FuelStation::all();

        $successMessage = session('success');

        return view(
            'livewire.settings.fuel-station.index',
            compact('successMessage', 'fuelStations')
        );
    }
}
