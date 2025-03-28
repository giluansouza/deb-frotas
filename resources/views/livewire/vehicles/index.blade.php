<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Veículos</h2>
        <a href="{{ route('vehicle.create') }}" class="bg-blue-500 cursor-pointer hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Novo veículo
        </a>
    </div>

    @if ($successMessage)
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700 border border-green-300 shadow-sm">
            {{ $successMessage }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="px-4 py-2 font-medium text-gray-600">Marca/Modelo</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Placa</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Ano/Modelo</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Local</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Cond</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Propriedade</th>
                    <th class="px-4 py-2 font-medium text-gray-600">IV</th>
                    <th class="px-4 py-2 font-medium text-gray-600"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($vehicles as $vehicle)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->brand.'/'.$vehicle->model }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->plate }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->year_manufacture.'/'.$vehicle->year_model }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->administrative_unit }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->conservation_state }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->ownership }}</td>
                        <td class="px-4 py-3 text-gray-700">
                            @if ($vehicle->visual_identity)
                                <span class="inline-block bg-blue-100 text-blue-500 text-xs px-4 py-1 rounded-full font-semibold">
                                    SIM
                                </span>
                            @else
                                <span class="inline-block bg-orange-100 text-orange-500 text-xs px-4 py-1 rounded-full font-semibold">
                                    NÃO
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('vehicle.edit', $vehicle) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($vehicles->hasPages())
            <div class="bg-zinc-200 px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $vehicles->links() }}
            </div>
        @endif
    </div>
</div>

