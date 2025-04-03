<div class="space-y-4">

    <div>
        <label class="block font-medium">Autorizado por *</label>
        <input type="text" disabled value="{{ auth()->user()->name }}" class="input">
    </div>

    <div class="mb-4">
        <label class="block font-medium">Status</label>

        @if($isEdit)
            <select wire:model.defer="status" class="input">
                @foreach($statuses as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        @else
            <input type="text" value="Pendente" class="input" disabled>
        @endif
    </div>

    <div class="mb-4">
        <label class="block font-medium">Tipo de Manutenção *</label>
        <select wire:model.defer="type" class="input" @disabled($isEdit)>
            <option value="">Selecione...</option>
            @foreach($types as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Veículo *</label>
        <select wire:model.defer="vehicle_id" class="input" @disabled($isEdit)>
            <option value="">Selecione...</option>
            @foreach($vehicles as $item)
                <option value="{{ $item['id'] }}">{{ $item['plate'].' - '.$item['model'] }}</option>
            @endforeach
        </select>
        @error('vehicle_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Oficina *</label>
        <select wire:model.defer="repair_shop_id" class="input" @disabled($isEdit)>
            <option value="">Selecione...</option>
            @foreach($repairshops as $item)
                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
            @endforeach
        </select>
        @error('repair_shop_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Data da Manutenção *</label>
        <input type="date" wire:model.defer="start_date" class="input">
        @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Hodômetro *</label>
        <input type="number" wire:model.defer="odometer" class="input" @disabled($isEdit)>
        @error('odometer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Descrição do Problema *</label>
        <textarea wire:model.defer="problem_description" class="input"></textarea>
        @error('problem_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Custo Estimado *</label>
        <input type="number" wire:model.defer="cost" class="input">
        @error('cost') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Descrição da Solução</label>
        <textarea wire:model.defer="solution_description" class="input"  @disabled(!$isEdit)></textarea>
        @error('solution_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Data de Conclusão</label>
        <input type="date" wire:model.defer="end_date" class="input" @disabled(!$isEdit)>
        @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Número da Nota Fiscal</label>
        <input type="text" wire:model.defer="invoice_number" class="input" placeholder="Número da nota fiscal" @disabled(!$isEdit)>
        @error('invoice_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium">Data da Nota Fiscal</label>
        <input type="date" wire:model.defer="invoice_date" class="input" @disabled(!$isEdit)>
        @error('invoice_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

</div>