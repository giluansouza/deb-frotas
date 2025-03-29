<div class="space-y-4">

    <div>
        <label class="block font-medium">Veículo *</label>
        <select wire:model.defer="vehicle_id" class="input">
            <option value="">Selecione</option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->plate }}</option>
            @endforeach
        </select>
        @error('vehicle_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">Motorista *</label>
        <select wire:model.defer="driver_id" class="input">
            <option value="">Selecione</option>
            @foreach ($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>
        @error('driver_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">Data e Hora do Abastecimento *</label>
        <input type="datetime-local" wire:model.defer="fueled_at" class="input">
        @error('fueled_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">Hodômetro (km) *</label>
        <input type="number" wire:model.defer="odometer_km" class="input">
        @error('odometer_km') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-medium">Litros *</label>
            <input type="number" step="0.01" wire:model="liters" class="input">
            @error('liters') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium">Preço por Litro *</label>
            <input type="number" step="0.01" wire:model="price_per_liter" class="input">
            @error('price_per_liter') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <div>
        <label class="block font-medium">Custo Total</label>
        <input type="text" wire:model="total_cost" class="input bg-gray-100" readonly>
    </div>

    <div>
        <label class="block font-medium">Tipo de Combustível *</label>
        <input type="text" wire:model.defer="fuel_type" class="input">
        @error('fuel_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">Nome do Posto *</label>
        <input type="text" wire:model.defer="fueling_station_name" class="input">
        @error('fueling_station_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">Número da Nota Fiscal</label>
        <input type="text" wire:model.defer="invoice_number" class="input">
        @error('invoice_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

</div>
