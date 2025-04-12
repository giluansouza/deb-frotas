<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <h1 class="text-2xl font-bold text-blue-950 dark:text-white mb-2">Prefeitura Municipal de Exemplo</h1>

    {{-- Card Drivers --}}

    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        {{-- Card Drivers --}}
        <div class="bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-800/20">
                <flux:icon.id-card class="w-6 h-6" />
            </div>

            <div class="flex-1">
                <h2 class="text-sm font-medium text-zinc-600 dark:text-zinc-300 mb-1">Motoristas Ativos</h2>

                @if ($driversActive === 0)
                    <p class="text-zinc-400 text-sm">Nenhuma</p>
                @else
                    <p class="text-2xl font-semibold text-zinc-800">Total: {{ $driversActive }}</p>
                @endif
            </div>
        </div>

        {{-- Card Vehicles --}}
        <div class="bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-800/20">
                <flux:icon.truck class="w-6 h-6" />
            </div>

            <div class="flex-1">
                <h2 class="text-sm font-medium text-zinc-600 dark:text-zinc-300 mb-1">Veículos Ativos</h2>

                @if ($vehiclesActive === 0)
                    <p class="text-zinc-400 text-sm">Nenhum</p>
                @else
                    <p class="text-2xl font-semibold text-zinc-800">Total: {{ $vehiclesActive }}</p>
                @endif
            </div>
        </div>

        {{-- Card Maintenance --}}
        <div class="bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-800/20">
                <flux:icon.wrench class="w-6 h-6" />
            </div>

            <div class="flex-1">
                <h2 class="text-sm font-medium text-zinc-600 dark:text-zinc-300 mb-1">Manutenções Agendadas</h2>

                @if ($scheduledMaintenance === 0)
                    <p class="text-zinc-400 text-sm">Nenhuma</p>
                @else
                    <p class="text-2xl font-semibold text-zinc-800">Total: {{ $scheduledMaintenance }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Card Drivers License Expiring --}}
    <div <div class="bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow p-6 items-center gap-4">
        <h2 class="text-xl font-medium text-zinc-600 dark:text-zinc-300 mb-1">CNH próximas do vencimento</h2>
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
    <div class="bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow p-6 items-center gap-4">
        <h2 class="text-xl font-medium text-zinc-600 dark:text-zinc-300 mb-1">Próximas Manutenções</h2>
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
