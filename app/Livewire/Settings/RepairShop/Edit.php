<?php

namespace App\Livewire\Settings\RepairShop;

use App\Models\RepairShop;
use App\RepairSpecialty;
use Livewire\Component;

class Edit extends Component
{
    public RepairShop $repairshop;

    public $name, $cnpj, $location, $specialties, $is_active = true;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:repair_shops,cnpj,' . $this->repairshop->id,
            'location' => 'required|string',
            'specialties' => 'required|string',
            'is_active' => 'boolean',
        ];
    }

    public function mount(RepairShop $repairshop)
    {
        $this->repairshop = $repairshop;
        $this->name = $repairshop->name;
        $this->cnpj = $repairshop->cnpj;
        $this->location = $repairshop->location;
        $this->specialties = (string) $repairshop->specialties;
        $this->is_active = (bool) $repairshop->is_active;
    }

    public function update()
    {
        $this->validate();

        $this->repairshop->update([
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'location' => $this->location,
            'specialties' => $this->specialties,
            'is_active' => $this->is_active,
        ]);

        return redirect()->route('repairshop.index')
            ->with('success', 'Oficina atualizada com sucesso!');
    }

    public function render()
    {
        return view('livewire.settings.repair-shop.edit', [
            'available_specialties' => RepairSpecialty::options(),
        ]);
    }
}
