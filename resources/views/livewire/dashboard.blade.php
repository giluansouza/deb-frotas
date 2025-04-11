<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <h1 class="text-2xl font-bold text-blue-950 dark:text-white mb-2">Prefeitura Municipal de Exemplo</h1>

    {{-- Card Drivers --}}

    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        {{-- Card Drivers --}}
        <div class="bg-blue-50 dark:bg-zinc-600 rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-4 text-blue-900 dark:text-blue-100">Motoristas Disponíveis</h2>

        </div>

        {{-- Card Vehicles --}}
        <div class="bg-blue-50 dark:bg-zinc-600 rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-4 text-blue-900 dark:text-blue-100">Veículos disponíveis</h2>

        </div>

        {{-- Card Vehicles --}}
        <div class="bg-blue-50 dark:bg-zinc-600 rounded-lg shadow-md p-4">
            <h2 class="text-lg font-bold mb-4 text-blue-900 dark:text-blue-100">Manutenções agendadas</h2>
            @if ($scheduledMaintenance == 0)
                <p class="text-gray-500">Nenhuma manutenção agendada.</p>
            @else
                <span class="text-2xl font-bold text-blue-800 dark:text-blue-50">Total: {{$scheduledMaintenance}}</span>
            @endif
        </div>
    </div>

    {{-- Card Drivers License Expiring --}}
    <div class="bg-blue-50 dark:bg-zinc-600 rounded-lg shadow-md p-4">
        <h2 class="text-xl font-bold mb-4 text-blue-900 dark:text-blue-100">CNH próximas do vencimento</h2>
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

    {{-- Card Vehicles Maintenance --}}
    <div class="bg-blue-50 dark:bg-zinc-600 rounded-lg shadow-md p-4">
        <h2 class="text-xl font-bold mb-4 text-blue-900">Manutenções agendadas</h2>
        @if($vehiclesForMaintenance->isEmpty())
            <p class="text-gray-500">Nenhuma manutenção programada nos próximos 30 dias.</p>
        @else
            <table class="min-w-full text-center">
                <thead>
                    <tr class="border-b dark:border-zinc-500">
                        <th class="py-2">Veículo</th>
                        <th class="py-2">Placa</th>
                        <th class="py-2">Oficina</th>
                        <th class="py-2">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiclesForMaintenance as $maintenance)
                        <tr class="border-b">
                            <td class="py-2">
                                {{ $maintenance->vehicle->brand.'/'.$maintenance->vehicle->model }}
                            </td>
                            <td class="py-2">
                                {{ $maintenance->vehicle->plate }}
                            </td>
                            <td class="py-2">
                                {{ $maintenance->repairShop->name }}
                            </td>
                            <td class="py-2">
                                {{ optional($maintenance->start_date)->format('d/m/Y') }}
                                @if($maintenance->start_date &&
                                    $maintenance->start_date->isPast())
                                    <span class="ml-2 text-red-500 font-semibold">Atrasada</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
