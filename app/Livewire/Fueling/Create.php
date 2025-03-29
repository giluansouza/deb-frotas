<?php

namespace App\Livewire\Fueling;

use App\Models\Driver;
use App\Models\Fueling;
use App\Models\Vehicle;
use Livewire\Component;

class Create extends Component
{
    public $vehicle_id;
    public $driver_id;
    public $authorized_by;
    public $fueled_at;
    public $odometer_km;
    public $liters;
    public $price_per_liter;
    public $total_cost;
    public $fuel_type;
    public $fueling_station_name;
    public $invoice_number;


    public function mount()
    {
        $this->authorize('create', Fueling::class);
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
        } else {
            $this->total_cost = null;
        }
    }

    public function save()
    {
        $this->authorized_by = auth()->id();

        $validated = $this->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'authorized_by' => 'required|exists:users,id',
            'fueled_at' => 'required|date|before_or_equal:now',
            'odometer_km' => ['required', 'integer', 'min:0', function ($attribute, $value, $fail) {
                $lastFueling = Fueling::where('vehicle_id', $this->vehicle_id)->latest('fueled_at')->first();
                if ($lastFueling && $value <= $lastFueling->odometer_km) {
                    $fail('O hodômetro deve ser maior que o último abastecimento registrado.');
                }
            }],
            'liters' => 'required|numeric|min:0.01',
            'price_per_liter' => 'required|numeric|min:0.01',
            'total_cost' => 'nullable|numeric|min:0.01',
            'fuel_type' => 'required|string|max:50',
            'fueling_station_name' => 'required|string|max:100',
            'invoice_number' => 'nullable|string|max:100',
        ]);

        Fueling::create($validated);

        return redirect()->route('fueling.index')
            ->with('success', 'Abastecimento cadastrado com sucesso!');
    }

    public function render()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('livewire.fueling.create', compact('vehicles', 'drivers'));
    }
}
