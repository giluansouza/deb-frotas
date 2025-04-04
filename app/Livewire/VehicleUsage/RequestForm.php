<?php

namespace App\Livewire\VehicleUsage;

use App\Models\Vehicle;
use App\Models\VehicleUsage;
use App\VehicleUsageStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestForm extends Component
{
    public ?int $vehicle_id = null;
    public string $purpose = '';
    public string $destination = '';
    public ?string $departure_datetime = '';
    public string $unit_name = '';

    protected function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'purpose' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_datetime' => 'required|date',
            'unit_name' => 'required|string|max:255',
        ];
    }

    public function mount(): void
    {
        $this->unit_name = Auth::user()->unit_name ?? '';
    }

    public function submit()
    {
        $this->authorize('create', VehicleUsage::class);

        $this->validate();

        $vehicleUsage = new VehicleUsage();
        $vehicleUsage->vehicle_id = $this->vehicle_id;
        $vehicleUsage->requested_by = Auth::id();
        $vehicleUsage->unit_name = $this->unit_name;
        $vehicleUsage->purpose = $this->purpose;
        $vehicleUsage->destination = $this->destination;
        $vehicleUsage->departure_datetime = $this->departure_datetime;
        $vehicleUsage->status = VehicleUsageStatus::Requested;

        if ($vehicleUsage->save()) {
            return redirect()->route('vehicle-usage.index')
                ->with('success', 'Solicitação de uso de veículo enviada com sucesso.');
        } else {
            return redirect()->back()
                ->with('error', 'Erro ao enviar a solicitação de uso de veículo.');
        }
    }

    public function render()
    {
        return view('livewire.vehicle-usage.request-form', [
            'vehicles' => Vehicle::all(),
        ]);
    }
}
