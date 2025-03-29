<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Motoristas</h2>
        @hasanyrole('admin|fleet_manager')
            <a href="{{ route("driver.create")}}" class="bg-blue-500 cursor-pointer hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Novo motorista
            </a>
        @endhasanyrole
    </div>

    @if ($successMessage)
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700 border border-green-300 shadow-sm">
            {{ $successMessage }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-zinc-200">
                <tr class="text-left">
                    <th class="px-4 py-2 font-medium text-gray-600">Nome</th>
                    <th class="px-4 py-2 font-medium text-gray-600">CPF</th>
                    <th class="px-4 py-2 font-medium text-gray-600">CNH</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Val CNH</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Cat CNH</th>
                    <th class="px-4 py-2 font-medium text-gray-600"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($drivers as $driver)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $driver->name }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $driver->cpf }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $driver->number_cnh }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $driver->category_cnh }}</td>
                        <td class="px-4 py-3 text-gray-700">
                            @if ($driver->validity_cnh && $driver->cnh_will_expire_soon)
                                <span class="inline-block bg-orange-100 text-orange-500 text-xs px-4 py-1 rounded-full font-semibold">
                                    {{ $driver->validity_cnh->format('d/m/Y') }}
                                </span>
                            @elseif ($driver->validity_cnh && $driver->validity_cnh->isFuture())
                                <span class="inline-block bg-blue-100 text-gray-500 text-xs px-4 py-1 rounded-full font-semibold">
                                    {{ $driver->validity_cnh->format('d/m/Y') }}
                                </span>
                            @else
                                <span class="inline-block bg-red-100 text-red-500 text-xs px-4 py-1 rounded-full">
                                    {{ $driver->validity_cnh ? $driver->validity_cnh->format('d/m/Y') : 'Sem validade' }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('driver.edit', $driver) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($drivers->hasPages())
            <div class="bg-zinc-200 px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $drivers->links() }}
            </div>
        @endif
    </div>
</div>
