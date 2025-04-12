<x-layouts.app.sidebar :title="'FleetPro | ' . ($title ?? null)">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
