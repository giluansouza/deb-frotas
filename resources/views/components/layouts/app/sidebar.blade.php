<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-200 dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Início') }}
                </flux:navlist.item>

                @hasanyrole('admin|fleet_manager|unit_manager|garage_manager|driver')
                    <flux:navlist.item icon="clipboard-document-list" :href="route('vehicle-usage.index')"
                        :current="request()->routeIs('vehicle-usage.index')" wire:navigate>
                        {{ __('Utilizações') }}
                    </flux:navlist.item>
                @endhasanyrole

                @hasrole('admin|fleet_manager|unit_manager|driver')
                    <flux:navlist.item icon="clipboard-document-check" :href="route('vehicle-usage.request')"
                        :current="request()->routeIs('vehicle-usage.request')" wire:navigate>
                        {{ __('Solicitar Veículo') }}
                    </flux:navlist.item>
                @endhasrole

                @hasanyrole('fleet_manager|unit_manager')
                    <flux:navlist.item icon="check-circle" :href="route('vehicle-usage.authorize')"
                        :current="request()->routeIs('vehicle-usage.authorize')" wire:navigate>
                        {{ __('Autorizar Solicitações') }}
                    </flux:navlist.item>
                @endhasanyrole

                @hasrole('garage_manager')
                    <flux:navlist.item icon="truck" :href="route('vehicle-usage.dispatch')"
                        :current="request()->routeIs('vehicle-usage.dispatch')" wire:navigate>
                        {{ __('Saídas de Veículos') }}
                    </flux:navlist.item>
                @endhasrole

                @hasrole('garage_manager|driver')
                    <flux:navlist.item icon="truck" :href="route('vehicle-usage.return')"
                        :current="request()->routeIs('vehicle-usage.return')" wire:navigate>
                        {{ __('Retornos de Veículos') }}
                    </flux:navlist.item>
                @endhasrole

                @hasanyrole('admin|fleet_manager')
                    <flux:navlist.item icon="truck" :href="route('vehicle.index')"
                        :current="request()->routeIs('vehicle')" wire:navigate>{{ __('Veículos') }}</flux:navlist.item>
                    <flux:navlist.item icon="user-group" :href="route('driver.index')"
                        :current="request()->routeIs('driver')" wire:navigate>{{ __('Motoristas') }}</flux:navlist.item>
                @endhasanyrole

                @hasanyrole('admin|fleet_manager')
                    <flux:navlist.item icon="document-chart-bar" :href="route('reports.index')"
                        :current="request()->routeIs('reports.*')" wire:navigate>
                        {{ __('Relatórios') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="clipboard-document-check" :href="route('vkm.index')"
                        :current="request()->routeIs('vkm.*')" wire:navigate>
                        {{ __('Controle Km') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="wrench-screwdriver" :href="route('maintenance.index')"
                        :current="request()->routeIs('maintenance.*')" wire:navigate>
                        {{ __('Manutenções') }}
                    </flux:navlist.item>
                @endhasanyrole

                @hasanyrole('admin|fleet_manager|driver')
                    <flux:navlist.item icon="fuel" :href="route('fueling.index')"
                        :current="request()->routeIs('fueling.*')" wire:navigate>
                        {{ __('Abastecimentos') }}
                    </flux:navlist.item>
                @endhasanyrole

                @hasanyrole('admin')
                    <flux:navlist.group heading="{{ __('Configurações') }}">
                        <flux:navlist.item icon="users" :href="route('user.index')"
                            :current="request()->routeIs('users')" wire:navigate>
                            {{ __('Usuários') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="fuel" :href="route('fuelstation.index')"
                            :current="request()->routeIs('fuelstation.*')" wire:navigate>
                            {{ __('Postos de Combustível') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="wrench" :href="route('repairshop.index')"
                            :current="request()->routeIs('repairshop.*')" wire:navigate>
                            {{ __('Oficinas') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                @endhasanyrole

            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            {{-- <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item> --}}

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                {{ __('Cartilha Gestão de Frotas') }}
            </flux:navlist.item>
        </flux:navlist>

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Perfil') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Sair') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Configurações') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Sair') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
