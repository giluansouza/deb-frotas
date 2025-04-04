<?php

namespace App\Livewire\VehicleUsage;

use App\Models\VehicleUsage;
use App\VehicleUsageStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorizeTable extends Component
{
    use WithPagination;

    public string $rejection_reason = '';
    public int $selectedUsageId;

    public function approve(int $id)
    {
        $usage = VehicleUsage::findOrFail($id);

        $this->authorize('authorize', $usage);

        $usage->authorized_by = Auth::id();
        $usage->status = VehicleUsageStatus::Authorized;
        $usage->rejection_reason = null;
        $usage->save();

        session()->flash('success', 'Solicitação autorizada com sucesso.');
    }

    public function reject()
    {
        $usage = VehicleUsage::findOrFail($this->selectedUsageId);

        $this->authorize('authorize', $usage);

        $this->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $usage->authorized_by = Auth::id();
        $usage->status = VehicleUsageStatus::Rejected;
        $usage->rejection_reason = $this->rejection_reason;
        $usage->save();

        session()->flash('success', 'Solicitação rejeitada.');
        $this->reset('rejection_reason', 'selectedUsageId');
    }

    public function render()
    {
        $usages = VehicleUsage::with(['vehicle', 'driver'])
            ->where('status', VehicleUsageStatus::Requested)
            ->when(Auth::user()->hasRole('unit_manager'), function ($query) {
                $query->where('unit_name', Auth::user()->unit_name);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.vehicle-usage.authorize-table', [
            'usages' => $usages,
        ]);
    }
}
