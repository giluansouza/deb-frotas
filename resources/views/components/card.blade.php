<div class="bg-zinc-100 dark:bg-zinc-600 rounded-lg shadow-md p-4">
    <h2 class="text-xl font-bold mb-4">CNH próximas do vencimento</h2>
    @if($driversExpiring->isEmpty())
        <p class="text-gray-500">Nenhuma CNH vencendo nos próximos 90 dias.</p>
    @else
        <table class="min-w-full text-center">
            <thead>
                <tr class="border-b dark:border-zinc-500">
                    <th class="py-2">Motorista</th>
                    <th class="py-2">Validade</th>
                    <th class="py-2">Dias restantes</th>
                </tr>
            </thead>
            <tbody>
            @foreach($driversExpiring as $driver)
                @php
                    $daysLeft = \Carbon\Carbon::today()->diffInDays($driver->validity_cnh, false);

                    $bgClass = match(true) {
                        $daysLeft < 0   => 'bg-gray-500',
                        $daysLeft <= 30 => 'bg-red-500',
                        $daysLeft <= 60 => 'bg-yellow-500',
                        default         => 'bg-blue-500',
                    };
                @endphp
                <tr class="border-b dark:border-zinc-500">
                    <td class="py-2">
                        {{ $driver->name }}
                    </td>
                    <td class="py-2">
                        {{ $driver->validity_cnh->format('d/m/Y') }}
                    </td>
                    <td class="py-2">
                        <span class="inline-block px-2 py-1 text-white rounded {{ $bgClass }}">
                            {{ $daysLeft }} dias
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>