<div class="relative">
    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Autorizar Solicitações</h2>
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Data Saída</th>
                    <th class="p-2 border">Veículo</th>
                    <th class="p-2 border">Finalidade</th>
                    <th class="p-2 border">Destino</th>
                    <th class="p-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usages as $usage)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $usage->departure_datetime?->format('d/m/Y H:i') }}</td>
                        <td class="p-2">{{ $usage->vehicle?->plate }}</td>
                        <td class="p-2">{{ $usage->purpose }}</td>
                        <td class="p-2">{{ $usage->destination }}</td>
                        <td class="p-2 flex justify-center gap-2">
                            <button wire:click="approve({{ $usage->id }})"
                                class="text-green-700 hover:underline flex gap-1 items-center">
                                <flux:icon.check class="size-5" /> Autorizar
                            </button>

                            <button wire:click="$set('selectedUsageId', {{ $usage->id }})"
                                class="text-red-700 hover:underline flex gap-1 items-center">
                                <flux:icon.x class="size-5" /> Rejeitar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-zinc-500">Nenhuma solicitação encontrada.</td>
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
                <h3 class="text-lg font-semibold mb-4 text-red-700 dark:text-red-400">
                    Rejeitar Solicitação
                </h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Motivo da Rejeição *</label>
                    <textarea wire:model.defer="rejection_reason" rows="4" class="input w-full"></textarea>
                    @error('rejection_reason')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button wire:click="$set('selectedUsageId', null)"
                        class="cursor-pointer px-4 py-2 text-sm rounded bg-zinc-300 dark:bg-zinc-600">
                        Cancelar
                    </button>
                    <button wire:click="reject"
                        class="cursor-pointer px-4 py-2 text-sm rounded bg-red-600 text-white hover:bg-red-700">
                        Confirmar Rejeição
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