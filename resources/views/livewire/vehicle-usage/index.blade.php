<div class="relative">
    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Utilizações de Veículos</h2>
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <div class="flex items-center gap-4 mb-6">
            <form wire:submit.prevent class="flex items-end gap-4 mb-6">
                <div>
                    <label>Status:</label>
                    <select wire:model.defer="status" class="input">
                        <option value="">Todos</option>
                        @foreach (App\VehicleUsageStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Buscar por placa:</label>
                    <input type="text" wire:model.defer="search" class="input w-64" placeholder="Buscar...">
                </div>

                <div>
                    <button type="submit"
                        class="flex gap-1 items-center cursor-pointer px-4 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700">
                        <flux:icon.search class="size-5" />
                        Filtrar
                    </button>
                </div>

                <div>
                    <button type="button" wire:click="$set('search', '')" class="flex gap-1 items-center cursor-pointer px-4 py-1.5 rounded bg-gray-300 hover:bg-gray-400">
                        <flux:icon.x class="size-5" />
                        Limpar
                    </button>
                </div>
            </form>
        </div>

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Data Saída</th>
                    <th class="p-2 border">Veículo</th>
                    <th class="p-2 border">Condutor</th>
                    <th class="p-2 border">Destino</th>
                    <th class="p-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usages as $usage)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $usage->departure_datetime?->format('d/m/Y H:i') }}</td>
                        <td class="p-2">{{ $usage->vehicle?->plate }}</td>
                        <td class="p-2">{{ $usage->driver?->name }}</td>
                        <td class="p-2">{{ $usage->destination }}</td>
                        <td class="p-2">
                            @if ($usage->status->isRejected())
                                <button wire:click="$set('selectedUsage', {{ $usage->id }})"
                                        class="{{ $usage->status->colorClass() }} hover:underline">
                                    {{ $usage->status->label() }}
                                </button>
                            @else
                                <span class="{{ $usage->status->colorClass() }}">
                                    {{ $usage->status->label() }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-zinc-500">Nenhuma utilização encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $usages->links() }}
        </div>
    </div>

    @if ($selectedUsage)
        @php $usage = $usages->find($selectedUsage); @endphp
        @if ($usage)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-zinc-200 dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 relative">
                    <h3 class="text-lg font-semibold mb-4 text-red-700 dark:text-red-400">
                        Motivo da Rejeição
                    </h3>

                    <p class="text-sm text-zinc-700 dark:text-zinc-300 mb-4">
                        {{ $usage->rejection_reason ?? 'Motivo não especificado.' }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <button wire:click="$set('selectedUsage', null)"
                                class="cursor-pointer px-4 py-2 text-sm rounded bg-zinc-300 dark:bg-zinc-600">
                            Fechar
                        </button>
                    </div>

                    <button wire:click="$set('selectedUsage', null)"
                            class="absolute top-2 right-2 text-zinc-500 hover:text-zinc-800 dark:hover:text-white">
                        ✖
                    </button>
                </div>
            </div>
        @endif
    @endif
</div>