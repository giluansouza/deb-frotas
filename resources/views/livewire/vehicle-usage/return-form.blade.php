<div class="relative">
    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Devolução de Veículos</h2>
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Data Saída</th>
                    <th class="p-2 border">Veículo</th>
                    <th class="p-2 border">KM Inicial</th>
                    <th class="p-2 border">Condutor</th>
                    <th class="p-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usages as $usage)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $usage->departure_datetime?->format('d/m/Y H:i') }}</td>
                        <td class="p-2">{{ $usage->vehicle?->plate }}</td>
                        <td class="p-2">{{ $usage->km_start }}</td>
                        <td class="p-2">{{ $usage->driver?->name }}</td>
                        <td class="p-2 flex justify-center">
                            <button wire:click="setUsage({{ $usage->id }})"
                                class="text-blue-600 hover:underline flex gap-1 justify-center items-center">
                                <flux:icon.rotate-ccw class="size-5" /> Registrar Retorno
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-zinc-500">Nenhuma utilização pendente de retorno.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $usages->links() }}
        </div>
    </div>

    @if ($selectedUsageId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-zinc-200 dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 relative">
                <h3 class="text-lg font-semibold mb-4 text-blue-700 dark:text-blue-400">
                    Registrar Retorno do Veículo
                </h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Km Final *</label>
                    <input type="number" wire:model.defer="km_end" class="input w-full">
                    @error('km_end') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Observações / Ocorrências</label>
                    <textarea wire:model.defer="return_observations" rows="4" class="input w-full"></textarea>
                    @error('return_observations') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.defer="inspection_confirmed" class="mr-2">
                        Confirmei que realizei a vistoria do veículo no momento da devolução
                    </label>
                    @error('inspection_confirmed') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button wire:click="$set('selectedUsageId', null)"
                            class="cursor-pointer px-4 py-2 text-sm rounded bg-zinc-300 dark:bg-zinc-600">
                        Cancelar
                    </button>
                    <button wire:click="confirmReturn"
                            class="cursor-pointer px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700">
                        Confirmar Retorno
                    </button>
                </div>

                <button wire:click="$set('selectedUsageId', null)"
                        class="absolute top-2 right-2 text-zinc-500 hover:text-zinc-800 dark:hover:text-white">
                    ✖
                </button>
            </div>
        </div>
    @endif
</div>
