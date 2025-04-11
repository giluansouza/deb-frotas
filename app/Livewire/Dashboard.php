<?php

namespace App\Livewire;

use App\MaintenanceStatus;
use App\Models\Driver;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $driversExpiring;
    public $vehiclesForMaintenance;
    public $vehiclesActive;
    public $driversActive;
    public $scheduledMaintenance;

    public function mount()
    {
        $today = Carbon::today();
        $in90Days = $today->copy()->addDays(90);

        $this->driversExpiring = Driver::whereBetween('validity_cnh', [$today, $in90Days])
            ->orderby('validity_cnh', 'asc')
            ->get();

        $this->vehiclesForMaintenance = Maintenance::where('start_date', '<=', $today->addDays(30))
            ->orderBy('start_date', 'asc')
            ->with(['vehicle', 'repairShop'])
            ->get();

        // $this->vehiclesActive = Vehicle::where('status', 'active')->count();
        // $this->driversActive = Driver::where('status', 'active')->count();
        $this->scheduledMaintenance = Maintenance::where('status', MaintenanceStatus::Pending)->count();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'driversExpiring' => $this->driversExpiring,
            'vehiclesForMaintenance' => $this->vehiclesForMaintenance,
            // 'vehiclesActive' => $this->vehiclesActive,
            // 'driversActive' => $this->driversActive,
            'scheduledMaintenance' => $this->scheduledMaintenance,
        ]);
    }
}
