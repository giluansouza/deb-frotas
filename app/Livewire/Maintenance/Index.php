<?php

namespace App\Livewire\Maintenance;

use App\Models\Maintenance;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $maintenances = Maintenance::paginate();

        $successMessage = session('success');

        return view('livewire.maintenance.index', compact('maintenances', 'successMessage'));
    }
}
