<div>
    <h1 class="text-xl font-bold mb-4">
        {{ $isEdit ? 'Editar Manutenção #'.$maintenance->id : 'Criar Nova Manutenção' }}
    </h1>

    @if (session('message'))
        <div class="bg-green-200 p-2 mb-2">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        {{-- 1) Campos SEMPRE exibidos --}}

        <div class="mb-2">
            <label>Veículo</label>
            <select wire:model="maintenance.vehicle_id" class="input">
                <option value="">-- selecione --</option>
                @foreach($vehicles as $v)
                    <option value="{{ $v->id }}">{{ $v->plate }} - {{ $v->model }}</option>
                @endforeach
            </select>
            @error('maintenance.vehicle_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Oficina</label>
            <select wire:model="maintenance.repair_shop_id" class="input">
                <option value="">-- selecione --</option>
                @foreach($repairshops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
            @error('maintenance.repair_shop_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Tipo</label>
            <select wire:model="maintenance.type" class="input">
                <option value="preventive">Preventiva</option>
                <option value="corrective">Corretiva</option>
            </select>
            @error('maintenance.type') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Data de Início</label>
            <input type="date" wire:model="maintenance.start_date" class="input">
            @error('maintenance.start_date') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Hodômetro</label>
            <input type="number" wire:model="maintenance.odometer" class="input">
            @error('maintenance.odometer') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Descrição do Problema</label>
            <textarea wire:model="maintenance.problem_description" class="input"></textarea>
            @error('maintenance.problem_description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Custo</label>
            <input type="number" step="0.01" wire:model="maintenance.cost" class="input">
            @error('maintenance.cost') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label>Status</label>
            <select wire:model="maintenance.status" class="input" wire:change="updatedMaintenanceStatus($event.target.value)">
                <option value="pending">Pendente</option>
                <option value="in_progress">Em andamento</option>
                <option value="completed">Concluído</option>
            </select>
            @error('maintenance.status') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        {{-- 2) Campos que só aparecem se status != 'pending' --}}
        @if($maintenance->status !== 'pending')
            <div class="mb-2">
                <label>Descrição da Solução</label>
                <textarea wire:model="maintenance.solution_description" class="input"></textarea>
                @error('maintenance.solution_description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        @endif

        {{-- 3) Campos que só aparecem se status = 'completed' --}}
        @if($maintenance->status === 'completed')
            <div class="mb-2">
                <label>Data de Término</label>
                <input type="date" wire:model="maintenance.end_date" class="input">
                @error('maintenance.end_date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-2">
                <label>Número da NF</label>
                <input type="text" wire:model="maintenance.invoice_number" class="input">
                @error('maintenance.invoice_number') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-2">
                <label>Data da NF</label>
                <input type="date" wire:model="maintenance.invoice_date" class="input">
                @error('maintenance.invoice_date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white">
                {{ $isEdit ? 'Atualizar' : 'Salvar' }}
            </button>
            <a href="{{ route('maintenance.index') }}" class="px-4 py-2 bg-gray-300">Cancelar</a>
        </div>
    </form>
</div>
