<?php

namespace App\Livewire\Fueling;

use App\Models\Driver;
use App\Models\Fueling;
use App\Models\Vehicle;
use Livewire\Component;

class Edit extends Component
{
    public Fueling $fueling;

    public $vehicle_id;
    public $driver_id;
    public $fueled_at;
    public $odometer_km;
    public $liters;
    public $price_per_liter;
    public $total_cost;
    public $fuel_type;
    public $fueling_station_name;
    public $invoice_number;
    public $authorized_by_id;

    public function mount(Fueling $fueling)
    {
        $this->authorize('update', $fueling);

        $this->fueling = $fueling;
        $this->fill($fueling->only([
            'vehicle_id',
            'driver_id',
            'fueled_at',
            'odometer_km',
            'liters',
            'price_per_liter',
            'total_cost',
            'fuel_type',
            'fueling_station_name',
            'invoice_number',
        ]));

        $this->fueled_at = $fueling->fueled_at->format('Y-m-d\TH:i');
    }

    public function updated($field)
    {
        if (in_array($field, ['liters', 'price_per_liter'])) {
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        if (is_numeric($this->liters) && is_numeric($this->price_per_liter)) {
            $this->total_cost = $this->liters * $this->price_per_liter;
        }
    }

    public function update()
    {
        $validated = $this->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'fueled_at' => 'required|date|before_or_equal:now',
            'odometer_km' => 'required|integer|min:0',
            'liters' => 'required|numeric|min:0.01',
            'price_per_liter' => 'required|numeric|min:0.01',
            'total_cost' => 'nullable|numeric|min:0.01',
            'fuel_type' => 'required|string|max:50',
            'fueling_station_name' => 'required|string|max:100',
            'invoice_number' => 'nullable|string|max:100',
        ]);

        $this->fueling->update($validated);

        return redirect()->route('fueling.index')
            ->with('success', 'Abastecimento atualizado com sucesso.');
    }

    public function render()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('livewire.fueling.edit', compact('vehicles', 'drivers'));
    }
}
