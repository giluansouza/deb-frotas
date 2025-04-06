<div class="relative">

    <div class="max-w-9xl mx-auto p-6 bg-zinc-200 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Relatório de Abastecimentos</h2>
        </div>

        <div class="flex flex-row gap-4 items-end mb-6">
            <form wire:submit.prevent="filter" class="flex items-end gap-4">
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
            <div class="flex justify-end gap-2">
                {{-- <button wire:click="exportPdf" class="cursor-pointer px-4 py-1.5 bg-red-500 text-white rounded hover:bg-red-600">Exportar PDF</button> --}}
                <button wire:click="exportToExcel" class="cursor-pointer px-4 py-1.5 bg-green-500 text-white rounded hover:bg-green-600">Exportar Excel</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Unidade</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Veículo</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Placa</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Litros</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Valor Total (R$)</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">KM Inicial</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">KM Final</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">KM Rodado</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Consumo Médio (km/l)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($vehicleReports as $report)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $report['unit'] }}</td>
                            <td class="px-4 py-2">{{ $report['vehicle'] }}</td>
                            <td class="px-4 py-2">{{ $report['plate'] }}</td>
                            <td class="px-4 py-2">{{ $report['fuel_type'] }}</td>
                            <td class="px-4 py-2">{{ number_format($report['liters'], 2, ',', '.') }}</td>
                            <td class="px-4 py-2">R$ {{ number_format($report['cost'], 2, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $report['km_start'] ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $report['km_end'] ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $report['km_driven'] ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if($report['average_consumption'] !== null)
                                    {{ number_format($report['average_consumption'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-gray-500">Nenhum registro encontrado para este mês.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
