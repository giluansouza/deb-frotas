<div class="relative">

    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Manutenções</h2>

            <a href="{{ route('maintenance.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nova Manutenção
            </a>
        </div>

        @if ($successMessage)
            <div class="mb-4 p-4 rounded bg-green-100 text-green-700 border border-green-300 shadow-sm">
                {{ $successMessage }}
            </div>
        @endif

        <div class="flex items-center gap-4 mb-6">
            <form wire:submit.prevent="applyFilters" class="flex items-end gap-4 mb-6">

                <div>
                    <label>Mês:</label>
                    <select wire:model.defer="month" class="input">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month((int) $m)->translatedFormat('F') }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Ano:</label>
                    <select wire:model.defer="year" class="input">
                        @foreach(range(now()->year - 1, now()->year + 1) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Buscar por placa:</label>
                    <input type="text" wire:model.defer="search" class="input w-64" placeholder="Buscar...">
                </div>

                <div>
                    <button type="submit" class="cursor-pointer px-4 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700">
                        <Flux:icon.search class="size-5" />
                        Filtrar
                    </button>
                </div>

                <div>
                    <button type="button" wire:click="clearFilters" class="cursor-pointer px-4 py-1.5 rounded bg-gray-300 hover:bg-gray-400">
                        <Flux:icon.x class="size-5" />
                        Limpar
                    </button>
                </div>

            </form>
        </div>

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Inicio</th>
                    <th class="p-2 border">Veículo</th>
                    <th class="p-2 border">Tipo</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenances as $maintenance)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $maintenance->start_date->format('d/m/Y') }}</td>
                        <td class="p-2">{{ $maintenance->vehicle->plate }}</td>
                        <td class="p-2">{{ $maintenance->type->label() }}</td>
                        <td class="p-2">
                            <span class="{{ $maintenance->status->colorClass() }}">
                                {{ $maintenance->status->label() }}
                            </span>
                        </td>
                        <td class="p-2">
                            <a
                                href="{{ route('maintenance.edit', $maintenance->id) }}"
                                class="text-blue-600 hover:underline flex gap-1">
                                <flux:icon.pencil class="size-5" /> Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="p-4 text-center text-zinc-500">Nenhuma manutenção encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $maintenances->links() }}
        </div>
    </div>
</div>
