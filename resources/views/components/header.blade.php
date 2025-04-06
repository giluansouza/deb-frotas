<flux:header container class="bg-zinc-50 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <div class="flex items-center space-x-2">
        <h1 class="text-2xl font-bold text-fleetpro-blue">FleetPro</h1>
        <span class="hidden md:inline text-fleetpro-darkgray">Gestão de Frotas</span>
    </div>

    {{-- <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
        <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
        <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
        <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>
        <flux:separator vertical variant="subtle" class="my-2"/>
        <flux:dropdown class="max-lg:hidden">
            <flux:navbar.item icon:trailing="chevron-down">Favorites</flux:navbar.item>
            <flux:navmenu>
                <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:navbar> --}}

    <flux:spacer />

    <flux:navbar class="-mb-px max-lg:hidden">
        @if (Auth::check())
            <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:navbar.item>
        @else
            <flux:navbar.item :href="route('login')" :current="request()->routeIs('login')" wire:navigate>
                {{ __('Entrar') }}
            </flux:navbar.item>
            <flux:navbar.item :href="route('register')" :current="request()->routeIs('register')" wire:navigate class="bg-gray-200">
                {{ __('Criar conta') }}
            </flux:navbar.item>
        @endif
    </flux:navbar>
</flux:header>