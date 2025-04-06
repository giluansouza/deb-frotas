<?php

namespace App\Livewire\Reports;

use App\Exports\MaintenanceExport;
use App\Models\Maintenance;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Relatório de Manutenções')]
class MaintenanceReport extends Component
{
    public $month;
    public $year;
    public $maintenancesReport = [];
    public $totalValue;

    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->loadData();
    }

    public function loadData()
    {
        $startDate = Carbon::create($this->year, $this->month)->startOfMonth();
        $endDate = Carbon::create($this->year, $this->month)->endOfMonth();

        $maintenances = Maintenance::with(['vehicle'])
            ->whereBetween('start_date', [$startDate, $endDate])
            ->get();

        $this->totalValue = $maintenances->sum('cost');

        $this->maintenancesReport = $maintenances->map(function ($maintenance) {
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
    }

    public function render()
    {
        return view('livewire.reports.maintenance-report');
    }

    public function filter()
    {
        $this->loadData();
    }

    public function clearFilters()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->loadData();
    }

    public function exportToExcel()
    {
        return Excel::download(new MaintenanceExport($this->month, $this->year), 'relatorio-de-manutencao.xlsx');
    }
}
