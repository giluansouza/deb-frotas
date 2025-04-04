<div class="relative">

    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Relatório de Abastecimentos</h2>
        </div>

        {{-- Filtros --}}
        <form wire:submit.prevent="filter" class="flex items-end gap-4 mb-6">

            <div>
                <label>Veículo</label>
                <select wire:model.defer="vehicle_id" class="input">
                    <option value="">Todos</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->model }} - {{ $vehicle->plate }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Tipo Combustível</label>
                <select wire:model.defer="fuel_type" class="input">
                    <option value="">Todos</option>
                    <option value="gasolina">Gasolina</option>
                    <option value="diesel">Diesel</option>
                    <option value="etanol">Etanol</option>
                </select>
            </div>

            <div>
                <label>Mês</label>
                <select wire:model.defer="month" class="input">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month((int) $m)->translatedFormat('F') }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Ano</label>
                <select wire:model.defer="year" class="input">
                    @foreach(range(now()->year - 1, now()->year + 1) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
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

        {{-- Botões Exportar --}}
        <div class="flex justify-end mb-4 gap-2">
            <button wire:click="exportPdf" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Exportar PDF</button>
            <button wire:click="exportExcel" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Exportar Excel</button>
        </div>

        {{-- Tabela de Abastecimentos --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Veículo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Placa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">KM Inicial</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">KM Final</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Litros Abastecidos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valor Total (R$)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($fuelings as $fueling)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $fueling->vehicle->model }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $fueling->vehicle->plate }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $fueling->km_start ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $fueling->km_end ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $fueling->total_liters }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($fueling->total_value, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="mt-4">
            {{ $fuelings->links() }}
        </div>

    </div>

</div>
