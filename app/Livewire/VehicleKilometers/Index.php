<?php

namespace App\Livewire\VehicleKilometers;

use App\Models\Vehicle;
use App\Models\VehicleMonthlyKilometer;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Component;

class Index extends Component
{
    public $month;
    public $year;

    public $showModal = false;
    public $editMode = false;

    public $recordId = null;
    public $vehicleId;
    public $initial_km;
    public $final_km;

    public $filteredMonth;
    public $filteredYear;
    public $status;

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->filteredMonth = $this->month;
        $this->filteredYear = $this->year;
        $this->status = '';
    }

    public function applyFilters()
    {
        $this->filteredMonth = (int) $this->month;
        $this->filteredYear = (int) $this->year;
    }

    public function clearFilters()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->filteredMonth = $this->month;
        $this->filteredYear = $this->year;
        $this->status = '';
    }

    public function render()
    {
        return view('livewire.vehicle-kilometers.index', [
            'records' => $this->getRecords(),
        ]);
    }

    public function getRecords(): SupportCollection
    {
        return Vehicle::with(['monthlyKilometers' => function ($query) {
            $query->where('month', $this->filteredMonth)
                ->where('year', $this->filteredYear);
        }])
            ->get()
            ->map(function ($vehicle) {
                $record = $vehicle->monthlyKilometers->first();
                $status = $this->getStatus($record);

                return [
                    'vehicle' => $vehicle,
                    'record' => $record,
                    'status' => $status,
                ];
            })
            ->filter(function ($item) {
                return $this->status === '' || $item['status'] === $this->status;
            });
    }

    private function getStatus($record)
    {
        if (!$record) return 'missing';
        if ($record->initial_km && $record->final_km) return 'complete';
        return 'partial';
    }

    public function openCreateModal($vehicleId)
    {
        $this->resetModal();
        $this->vehicleId = $vehicleId;
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openEditModal($recordId)
    {
        $this->resetModal();
        $record = VehicleMonthlyKilometer::findOrFail($recordId);
        $this->recordId = $record->id;
        $this->vehicleId = $record->vehicle_id;
        $this->month = (int) $record->month;
        $this->year = (int) $record->year;
        $this->initial_km = $record->initial_km;
        $this->final_km = $record->final_km;
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'initial_km' => 'required|integer|min:0',
            'final_km' => 'nullable|integer|gte:initial_km',
        ]);

        VehicleMonthlyKilometer::updateOrCreate(
            [
                'id' => $this->recordId,
            ],
            [
                'vehicle_id' => $this->vehicleId,
                'month' => $this->month,
                'year' => $this->year,
                'initial_km' => $this->initial_km,
                'final_km' => $this->final_km,
            ]
        );

        $this->resetModal();
    }

    public function resetModal()
    {
        $this->reset([
            'recordId',
            'vehicleId',
            'initial_km',
            'final_km',
            'editMode',
            'showModal',
        ]);
    }
}
