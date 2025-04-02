<?php

namespace App\Livewire\Settings\RepairShop;

use App\Models\RepairShop;
use App\RepairSpecialty;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $name, $cnpj, $location, $specialties, $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'cnpj' => 'required|string|unique:repair_shops,cnpj',
        'location' => 'required|string',
        'specialties' => 'required|string',
        'is_active' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        RepairShop::create([
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'location' => $this->location,
            'specialties' => $this->specialties,
            'is_active' => $this->is_active,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('repairshop.index')
            ->with('success', 'Oficina cadastrada com sucesso!');
    }

    public function render()
    {
        return view('livewire.settings.repair-shop.create', [
            'available_specialties' => RepairSpecialty::options(),
        ]);
    }
}
