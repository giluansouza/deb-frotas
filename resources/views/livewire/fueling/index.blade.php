<div class="relative">

    <div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
        <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800">Abastecimentos</h2>

            <a href="{{ route('fueling.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Novo Abastecimento
            </a>
        </div>

        <div class="flex items-end gap-4 mb-6">
            <div>
                <label>Mês:</label>
                <select wire:model="month" class="input">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Ano:</label>
                <select wire:model="year" class="input">
                    @foreach(range(now()->year - 1, now()->year + 1) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <label>Buscar por placa ou motorista:</label>
                <input type="text" wire:model.debounce.500ms="search" class="input w-full" placeholder="Buscar...">
            </div>
        </div>

        <table class="w-full table-auto border-collapse">
            <thead class="bg-zinc-200">
                <tr class="text-center">
                    <th class="p-2 border">Data</th>
                    <th class="p-2 border">Veículo</th>
                    <th class="p-2 border">Motorista</th>
                    <th class="p-2 border">Litros</th>
                    <th class="p-2 border">Preço/L</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Autorizado por</th>
                    <th class="p-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fuelings as $f)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $f->fueled_at->format('d/m/Y H:i') }}</td>
                        <td class="p-2">{{ $f->vehicle->plate }}</td>
                        <td class="p-2">{{ $f->driver->name }}</td>
                        <td class="p-2">{{ number_format($f->liters, 2, ',', '.') }}</td>
                        <td class="p-2">R$ {{ number_format($f->price_per_liter, 2, ',', '.') }}</td>
                        <td class="p-2">R$ {{ number_format($f->total_cost, 2, ',', '.') }}</td>
                        <td class="p-2">{{ $f->authorizedBy->name }}</td>
                        <td class="p-2">
                            <a href="{{ route('fueling.edit', $f->id) }}" class="text-blue-600 hover:underline">✏️ Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="p-4 text-center text-zinc-500">Nenhum abastecimento encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $fuelings->links() }}
        </div>
    </div>
</div>
