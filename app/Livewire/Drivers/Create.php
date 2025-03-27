<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        $drivers = Driver::paginate();

        return view('livewire.condutores.listagem-condutores', compact('drivers'));
    }
}
