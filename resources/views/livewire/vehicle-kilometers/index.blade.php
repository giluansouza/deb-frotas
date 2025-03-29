<div class="relative"> {{-- ROOT ÚNICO para o componente Livewire --}}

    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Controle Mensal de KM</h2>
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
                    <select wire:model.defer="month" class="border rounded p-1">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month((int) $m)->translatedFormat('F') }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Ano:</label>
                    <select wire:model.defer="year" class="border rounded p-1">
                        @foreach(range(now()->year - 1, now()->year + 1) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Status:</label>
                    <select wire:model.defer="status" class="border rounded p-1">
                        <option value="">Todos</option>
                        <option value="complete">Fechado</option>
                        <option value="partial">Aberto</option>
                        <option value="missing">Sem Dados</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="px-4 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700">
                        Filtrar
                    </button>
                </div>

                <div>
                    <button type="button" wire:click="clearFilters" class="px-4 py-1.5 rounded bg-gray-300 hover:bg-gray-400">
                        Limpar
                    </button>
                </div>
            </form>
        </div>

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Veículo</th>
                    <th class="p-2 border">Placa</th>
                    <th class="p-2 border">Km Inicial</th>
                    <th class="p-2 border">Km Final</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $item)
                    <tr class="border-b text-center">
                        <td class="p-2">{{ $item['vehicle']->model }}</td>
                        <td class="p-2">{{ $item['vehicle']->plate }}</td>
                        <td class="p-2">{{ $item['record']?->initial_km ?? '-' }}</td>
                        <td class="p-2">{{ $item['record']?->final_km ?? '-' }}</td>
                        <td class="p-2">
                            @switch($item['status'])
                                @case('complete')
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                        ✅ Fechado
                                    </span>
                                    @break

                                @case('partial')
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800">
                                        ⚠️ Aberto
                                    </span>
                                    @break

                                @default
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">
                                        ➕ Sem Dados
                                    </span>
                            @endswitch
                        </td>

                        <td class="p-2">
                            @if($item['record'])
                                <button wire:click="openEditModal({{ $item['record']->id }})"
                                        class="text-blue-600 hover:underline cursor-pointer">✏️ Editar</button>
                            @else
                                <button wire:click="openCreateModal({{ $item['vehicle']->id }})"
                                        class="text-green-600 hover:underline cursor-pointer">➕ Adicionar</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MODAL embutido --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-zinc-200 dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-lg p-6 relative">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $editMode ? 'Editar Quilometragem' : 'Registrar Quilometragem' }}
                </h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-zinc-700 dark:text-zinc-300">Veículo</label>
                        <p class="font-medium">
                            {{ \App\Models\Vehicle::find($vehicleId)?->model ?? '-' }}
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block text-sm">Mês</label>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                {{ \Carbon\Carbon::create()->month((int) $month)->translatedFormat('F') }}
                            </p>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm">Ano</label>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $year }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Km Inicial</label>
                        <input
                            type="number"
                            wire:model.defer="initial_km"
                            class="input" />
                        @error('initial_km') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Km Final</label>
                        <input
                            type="number"
                            wire:model.defer="final_km"
                            class="input"
                        />
                        @error('final_km') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button wire:click="resetModal" class="cursor-pointer px-4 py-2 text-sm rounded bg-zinc-200 dark:bg-zinc-600">
                        Cancelar
                    </button>
                    <button wire:click="save" class="cursor-pointer px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700">
                        Salvar
                    </button>
                </div>

                <button wire:click="resetModal" class="absolute top-2 right-2 text-zinc-500 hover:text-zinc-800 dark:hover:text-white">
                    ✖
                </button>
            </div>
        </div>
    @endif

</div>
