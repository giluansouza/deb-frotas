<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Veículos</h2>
        {{-- <a href="#" class="bg-blue-500 cursor-pointer hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Novo motorista
        </a> --}}
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-zinc-200">
                <tr class="text-left">
                    <th class="px-4 py-2 font-medium text-gray-600">Marca/Modelo</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Placa</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Ano/Modelo</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Local</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Cond</th>
                    <th class="px-4 py-2 font-medium text-gray-600"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($vehicles as $vehicle)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->brand.'/'.$vehicle->model }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->placa }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->year_manufacture.'/'.$vehicle->year_model }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->administrative_unit }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $vehicle->conservation_state }}</td>
                        <td class="px-4 py-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">Editar</a>
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

