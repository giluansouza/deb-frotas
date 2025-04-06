<?php

namespace App\Exports;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FuelReportExport implements FromView
{
    public function __construct(protected int $month, protected int $year) {}

    public function view(): View
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
        $vehicleReports = $vehicles->map(function ($vehicle) {
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

        return view('exports.fuel-report', [
            'vehicleReports' => $vehicleReports,
            'month' => $this->month,
            'year' => $this->year,
        ]);
    }
}
