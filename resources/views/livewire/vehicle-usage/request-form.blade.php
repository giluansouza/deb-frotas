<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Solicitar Veículo</h2>
    </div>

    @if (session()->has('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    @if (session()->has('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <form wire:submit.prevent="submit">
        <div class="space-y-4">
            <div class="mb-4">
                <label class="block font-medium">Veículo *</label>
                <select wire:model.defer="vehicle_id" class="input">
                    <option value="">Selecione um veículo</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->plate }} - {{ $vehicle->model }}</option>
                    @endforeach
                </select>
                @error('vehicle_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">Finalidade *</label>
                <input type="text" wire:model.defer="purpose" class="input" placeholder="Finalidade da viagem">
                @error('purpose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">Destino *</label>
                <input type="text" wire:model.defer="destination" class="input" placeholder="Local de destino">
                @error('destination') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">Data e Hora de Saída *</label>
                <input type="datetime-local" wire:model.defer="departure_datetime" class="input">
                @error('departure_datetime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">Unidade solicitante *</label>
                <input type="text" wire:model.defer="unit_name" class="input" placeholder="Nome da unidade">
                @error('unit_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('vehicle-usage.index') }}" class="px-4 py-2 rounded text-gray-600 border">Cancelar</a>
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 cursor-pointer">
                Enviar Solicitação
            </button>
        </div>
    </form>
</div>
