<?php

namespace App\Livewire\Reports;

use App\Exports\VehicleReportExport;
use App\Models\Vehicle;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Relatório de Veículos')]
class VehiclesReport extends Component
{
    public $vehicles;
    public $totalVehicles;
    public $averageAge;
    public $ownershipCount = [];

    public function mount()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.reports.vehicles-report');
    }

    public function exportToExcel()
    {
        return Excel::download(new VehicleReportExport, 'relatório-de-veículos.xlsx');
    }

    private function loadData()
    {
        $this->vehicles = Vehicle::get();

        $this->totalVehicles = $this->vehicles->count();

        $this->averageAge = round($this->vehicles->avg(function ($vehicle) {
            return now()->year - $vehicle->year_manufacture;
        }), 1);

        $this->ownershipCount = $this->vehicles->groupBy('ownership')->map->count()->toArray();
    }
}
