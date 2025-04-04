<?php

namespace App\Livewire\Reports;

use App\Models\Fueling;
use App\Models\Vehicle;
use App\Models\VehicleMonthlyKilometer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class FuelReport extends Component
{
    use WithPagination;

    public $vehicle_id;
    public $fuel_type;
    public $month;
    public $year;

    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        $startDate = Carbon::create($this->year, $this->month, 1)->startOfMonth();
        $endDate = Carbon::create($this->year, $this->month, 1)->endOfMonth();

        $query = Fueling::query()
            ->select('vehicle_id', DB::raw('SUM(liters) as total_liters'), DB::raw('SUM(total_cost) as total_value'))
            ->with('vehicle')
            ->whereBetween('fueled_at', [$startDate, $endDate])
            ->groupBy('vehicle_id');

        if ($this->vehicle_id) {
            $query->where('vehicle_id', $this->vehicle_id);
        }

        if ($this->fuel_type) {
            $query->where('fuel_type', $this->fuel_type);
        }

        $fuelings = $query->paginate(10);

        foreach ($fuelings as $fueling) {
            $kmRecord = VehicleMonthlyKilometer::where('vehicle_id', $fueling->vehicle_id)
                ->where('month', $this->month)
                ->where('year', $this->year)
                ->first();

            $fueling->km_start = $kmRecord->initial_km ?? null;
            $fueling->km_end = $kmRecord->final_km ?? null;
        }

        $vehicles = Vehicle::all();

        return view('livewire.reports.fuel-report', compact('fuelings', 'vehicles'));
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['vehicle_id', 'fuel_type']);
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->resetPage();
    }

    public function exportPdf()
    {
        // Implementação futura da exportação em PDF
    }

    public function exportExcel()
    {
        // Implementação futura da exportação em Excel
    }
}
