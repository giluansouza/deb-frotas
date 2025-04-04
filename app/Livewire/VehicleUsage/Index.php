<?php

namespace App\Livewire\VehicleUsage;

use App\Models\VehicleUsage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public ?int $selectedUsage = null;

    public function updated($field)
    {
        if (in_array($field, ['search', 'status'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = VehicleUsage::with(['vehicle', 'driver'])->latest();

        $user = Auth::user();

        if ($user->hasRole('driver')) {
            $query->where('driver_id', $user->id);
        }

        if ($user->hasRole('unit_manager')) {
            $query->where('requested_by', $user->id);
        }

        if ($this->search) {
            $query->whereHas('vehicle', fn($q) => $q->where('plate', 'like', "%{$this->search}%"));
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return view('livewire.vehicle-usage.index', [
            'usages' => $query->paginate(10),
        ]);
    }
}
