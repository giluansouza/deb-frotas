<div class="relative">
    <div class="max-w-7xl mx-auto p-6 bg-zinc-200 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Relatório de Manutenções</h2>
            <button wire:click="exportToExcel" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Exportar Excel
            </button>
        </div>

        {{-- Filtros --}}
        <form wire:submit.prevent="filter" class="flex items-end gap-4 mb-6">
            <div>
                <label>Mês</label>
                <select wire:model.defer="month" class="input">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
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

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filtrar
            </button>

            <button type="button" wire:click="clearFilters" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                Limpar
            </button>
        </form>

        {{-- Indicadores --}}
        <div class="mb-4 text-right">
            <span class="text-md text-gray-700 font-medium">Valor total das manutenções: </span>
            <span class="text-xl text-gray-900 font-bold">R$ {{ number_format($totalValue, 2, ',', '.') }}</span>
        </div>

        {{-- Tabela de manutenções --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Unidade</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Veículo</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Placa</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Tipo de manutenção</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Serviços</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Data</th>
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Valor (R$)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($maintenancesReport as $report)
                        <tr class="hover:bg-gray-50">
                            <td>{{ $report['unit'] ?? '-' }}</td>
                            <td>{{ $report['vehicle'] }}</td>
                            <td>{{ $report['plate'] }}</td>
                            <td>{{ $report['type'] ?? '-' }}</td>
                            <td>{{ $report['description'] ?? '-' }}</td>
                            <td>{{ $report['start_date'] }}</td>
                            <td>R$ {{ $report['cost'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-gray-500">Nenhuma manutenção encontrada neste mês.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
