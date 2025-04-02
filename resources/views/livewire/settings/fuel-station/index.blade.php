<div class="relative">

    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Postos de Combustíveis</h2>

            <a href="{{ route('fuelstation.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Novo Posto
            </a>
        </div>

        @if ($successMessage)
            <div class="mb-4 p-4 rounded bg-green-100 text-green-700 border border-green-300 shadow-sm">
                {{ $successMessage }}
            </div>
        @endif

        {{-- <div class="flex items-center gap-4 mb-6">
            <form wire:submit.prevent="applyFilters" class="flex items-end gap-4 mb-6">
                <div>
                    <label>Buscar por placa ou motorista:</label>
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
        </div> --}}

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Nome</th>
                    <th class="p-2 border">CNPJ</th>
                    <th class="p-2 border">Endereço</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fuelStations as $fuelStation)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $fuelStation->name }}</td>
                        <td class="p-2">{{ $fuelStation->cnpj }}</td>
                        <td class="p-2 text-left">{{ $fuelStation->location }}</td>
                        <td class="p-2">
                            @if ($fuelStation->is_active)
                                <span class="inline-flex items-center rounded-full bg-zinc-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                    <flux:icon.badge-check />
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-zinc-100 px-2 py-0.5 text-xs font-medium text-red-800">
                                    <flux:icon.badge-x />
                                </span>
                            @endif
                        </td>
                        <td class="p-2">
                            <a
                                href="{{ route('fuelstation.edit', $fuelStation->id) }}"
                                class="text-blue-600 hover:underline flex gap-1">
                                <flux:icon.pencil class="size-5" /> Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="p-4 text-center text-zinc-500">Nenhum posto de combustível encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- <div class="mt-4">
            {{ $fuelStations->links() }}
        </div> --}}
    </div>
</div>
