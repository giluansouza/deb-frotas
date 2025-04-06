<div class="relative">
    <div class="max-w-9xl mx-auto p-6 bg-zinc-200 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Relatório de Veículos</h2>
            <div>
                <button wire:click="exportToExcel" class="cursor-pointer bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Exportar para Excel
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow rounded-xl p-4">
                <h3 class="text-md font-medium text-gray-500">Total de Veículos</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalVehicles }}</p>
            </div>
            <div class="bg-white shadow rounded-xl p-4">
                <h3 class="text-md font-medium text-gray-500">Tempo Médio da Frota</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $averageAge }} anos</p>
            </div>
            <div class="bg-white shadow rounded-xl p-4">
                <h3 class="text-md font-medium text-gray-500">Distribuição por Vínculo</h3>
                <ul class="text-sm mt-1 text-gray-700 space-y-1">
                    <li>Próprios: {{ $ownershipCount['Próprio'] ?? 0 }}</li>
                    <li>Locados: {{ $ownershipCount['Locado'] ?? 0 }}</li>
                    <li>Cedidos: {{ $ownershipCount['Cedido'] ?? 0 }}</li>
                </ul>
            </div>
        </div>

        {{-- Tabela --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-center">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Unidade</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Modelo</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Placa</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Renavam</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Ano</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Vínculo</th>
                        {{-- <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Situação</th> --}}
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Conservação</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-center">
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $vehicle->unit->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $vehicle->brand.'/'.$vehicle->model }}</td>
                            <td class="px-4 py-2">{{ $vehicle->plate }}</td>
                            <td class="px-4 py-2">{{ $vehicle->renavam }}</td>
                            <td class="px-4 py-2">{{ $vehicle->year_manufacture.' / '.$vehicle->year_model }}</td>
                            <td class="px-4 py-2">{{ ucfirst($vehicle->ownership) }}</td>
                            {{-- <td class="px-4 py-2">{{ $vehicle->status }}</td> --}}
                            <td class="px-4 py-2">{{ ucfirst($vehicle->conservation_state ?? 'Não informado') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-gray-500">Nenhum veículo encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
