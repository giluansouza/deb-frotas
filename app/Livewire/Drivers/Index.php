<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $drivers = Driver::orderBy('name', 'ASC')->paginate();

        $successMessage = session('success');

        return view('livewire.drivers.index', [
            'drivers' => $drivers,
            'successMessage' => $successMessage,
        ]);
    }
}
