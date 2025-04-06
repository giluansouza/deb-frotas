<?php

namespace App\Exports;

use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MaintenanceExport implements FromView
{
    public function __construct(protected int $month, protected int $year) {}

    public function view(): View
    {
        $startDate = Carbon::create($this->year, $this->month)->startOfMonth();
        $endDate = Carbon::create($this->year, $this->month)->endOfMonth();

        $maintenances = Maintenance::with(['vehicle'])
            ->whereBetween('start_date', [$startDate, $endDate])
            ->get();

        $totalValue = $maintenances->sum('cost');
        $totalValue = number_format($totalValue, 2, ',', '.');

        $maintenancesReport = $maintenances->map(function ($maintenance) {
            return [
                'unit' => $maintenance->vehicle->unit->name ?? '-',
                'vehicle' => $maintenance->vehicle->brand . '/' . $maintenance->vehicle->model,
                'plate' => $maintenance->vehicle->plate,
                'type' => ucfirst($maintenance->type->label() ?? '-'),
                'description' => $maintenance->solution_description ?? '-',
                'start_date' => $maintenance->start_date->format('d/m/Y'),
                'cost' => number_format($maintenance->cost, 2, ',', '.'),
            ];
        })->toArray();

        return view('exports.maintenance-report', [
            'maintenancesReport' => $maintenancesReport,
            'totalValue' => $totalValue,
        ]);
    }
}
