<?php

namespace App\Livewire\Reports;

use App\Exports\FuelReportExport;
use App\Models\Vehicle;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Relatório de Abastecimentos')]
class FuelReport extends Component
{
    public $month;
    public $year;

    public $vehicleReports = [];

    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        $startDate = Carbon::create($this->year, $this->month)->startOfMonth();
        $endDate = Carbon::create($this->year, $this->month)->endOfMonth();

        $vehicles = Vehicle::with([
            'fuelings' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('fueled_at', [$startDate, $endDate]);
            },
            'monthlyKilometers' => function ($query) {
                $query->where('month', $this->month)->where('year', $this->year);
            }
        ])->get();

        // Prepara os relatórios por veículo
        $this->vehicleReports = $vehicles->map(function ($vehicle) {
            $monthlyKm = $vehicle->monthlyKilometers->first();

            $initialKm = $monthlyKm?->initial_km ?? null;
            $finalKm = $monthlyKm?->final_km ?? null;
            $kmDriven = ($initialKm !== null && $finalKm !== null) ? ($finalKm - $initialKm) : null;

            $fuel_type = $vehicle->fuel_type;
            $liters = $vehicle->fuelings->sum('liters');
            $cost = $vehicle->fuelings->sum('total_cost');

            $averageConsumption = ($liters > 0 && $kmDriven !== null)
                ? round($kmDriven / $liters, 2)
                : null;

            return [
                'unit' => $vehicle->unit->name ?? '-',
                'vehicle' => $vehicle->brand . '/' . $vehicle->model,
                'plate' => $vehicle->plate,
                'fuel_type' => $fuel_type,
                'liters' => $liters,
                'cost' => $cost,
                'km_start' => $initialKm,
                'km_end' => $finalKm,
                'km_driven' => $kmDriven,
                'average_consumption' => $averageConsumption,
            ];
        });

        return view('livewire.reports.fuel-report');
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->resetPage();
    }

    public function exportPdf()
    {
        // TODO
    }

    public function exportToExcel()
    {
        return Excel::download(
            new FuelReportExport($this->month, $this->year),
            'relatorio-de-combustivel.xlsx'
        );
    }
}
