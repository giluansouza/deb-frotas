<?php

namespace App\Livewire\Settings\RepairShop;

use App\Models\RepairShop;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $repairShops = RepairShop::all();
        $successMessage = session('success');

        return view('livewire.settings.repair-shop.index', compact('repairShops', 'successMessage'));
    }
}
