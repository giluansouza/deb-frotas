<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Motoristas')]
class Index extends Component
{
    public function mount()
    {
        if (!auth()->user()->hasAnyRole(['admin', 'fleet_manager'])) {
            abort(403, 'Você não tem permissão para acessar esta página.');
        }
    }

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
