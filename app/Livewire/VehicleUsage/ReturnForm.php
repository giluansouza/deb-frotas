<?php

namespace App\Livewire\VehicleUsage;

use App\Models\VehicleUsage;
use App\VehicleUsageStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ReturnForm extends Component
{
    use WithPagination;

    public ?int $selectedUsageId = null;
    public ?int $km_end = null;
    public string $return_observations = '';
    public bool $inspection_confirmed = false;

    protected function rules(): array
    {
        return [
            'km_end' => ['required', 'integer', 'min:0'],
            'return_observations' => ['nullable', 'string', 'max:1000'],
            'inspection_confirmed' => ['accepted'],
        ];
    }

    public function setUsage(int $id): void
    {
        $usage = VehicleUsage::findOrFail($id);

        $this->authorize('return', $usage);

        $this->selectedUsageId = $id;
        $this->km_end = $usage->km_end;
        $this->return_observations = $usage->return_observations ?? '';
        $this->inspection_confirmed = false;
    }

    public function confirmReturn(): void
    {
        $this->validate();

        $usage = VehicleUsage::findOrFail($this->selectedUsageId);
        $this->authorize('return', $usage);

        if ($this->km_end <= $usage->km_start) {
            $this->addError('km_end', 'O KM final deve ser maior ou igual ao KM inicial.');
            return;
        }

        $usage->km_end = $this->km_end;
        $usage->garage_in_by = Auth::id();
        $usage->status = VehicleUsageStatus::Returned;
        $usage->return_observations = $this->return_observations;
        $usage->inspection_confirmed = true;
        $usage->save();

        session()->flash('success', 'Retorno do veículo registrado com sucesso.');
        $this->reset(['selectedUsageId', 'km_end', 'return_observations', 'inspection_confirmed']);
    }

    public function render()
    {
        $query = VehicleUsage::with('vehicle')
            ->where('status', VehicleUsageStatus::InUse);

        if (Auth::user()->hasRole('driver')) {
            $query->where('driver_id', Auth::id());
        }

        return view('livewire.vehicle-usage.return-form', [
            'usages' => $query->latest()->paginate(10),
        ]);
    }
}
