<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $drivers = Driver::paginate();

        $successMessage = session('success');

        return view('livewire.drivers.index', [
            'drivers' => Driver::paginate(),
            'successMessage' => $successMessage,
        ]);
    }
}
