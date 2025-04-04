<?php

namespace App\Livewire\VehicleUsage;

use App\Models\Driver;
use App\Models\User;
use App\Models\VehicleUsage;
use App\VehicleUsageStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Dispatch extends Component
{
    use WithPagination;

    public ?int $selectedUsageId = null;
    public ?int $driver_id = null;
    public ?int $km_start = null;

    protected function rules(): array
    {
        return [
            'driver_id' => 'required|exists:users,id',
            'km_start' => 'required|integer|min:0',
        ];
    }

    public function setUsage(int $id): void
    {
        $usage = VehicleUsage::findOrFail($id);

        $this->authorize('dispatch', $usage);

        $this->selectedUsageId = $id;
        $this->driver_id = $usage->driver_id;
        $this->km_start = $usage->km_start;
    }

    public function confirmDispatch()
    {

        $this->validate();

        $usage = VehicleUsage::findOrFail($this->selectedUsageId);

        $this->authorize('dispatch', $usage);

        $usage->driver_id = $this->driver_id;
        $usage->km_start = $this->km_start;
        $usage->status = VehicleUsageStatus::InUse;
        $usage->garage_out_by = Auth::id();

        if ($usage->save()) {
            session()->flash('success', 'Veículo despachado com sucesso.');
            return redirect()->route('vehicle-usage.index');
        } else {
            session()->flash('error', 'Erro ao despachar o veículo.');
        }
    }

    public function render()
    {
        return view('livewire.vehicle-usage.dispatch', [
            'usages' => VehicleUsage::with('vehicle')
                ->where('status', VehicleUsageStatus::Authorized)
                ->latest()
                ->paginate(10),
            'drivers' => User::role('driver')->get(),
        ]);
    }
}
