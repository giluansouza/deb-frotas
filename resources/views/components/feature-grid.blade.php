@php

$features = [
  [
    'title' => 'Gestão de Veículos',
    'description' => 'Registre e controle veículos com facilidade, garantindo conformidade e disponibilidade.',
    'icon' => 'car',    // We'll reference Lucide icons by name, e.g. <x-lucide-car/>
    'image' => asset('images/dan-gold-kARZuSYMfrA-unsplash.jpg'),
  ],
  [
    'title' => 'Gestao de Motoristas',
    'description' => 'Gerencie atribuições de motoristas, qualificações e escalas para operações sem interrupções.',
    'icon' => 'users',
    'image' => asset('images/nighthawstudio-020qf9WwYyI-unsplash.jpg'),
  ],
  [
    'title' => 'GPS Tracking',
    'description' => 'Rastreamento de veículos em tempo real para maior segurança e otimização de rotas.',
    'icon' => 'map-pin',
    'image' => asset('images/tobias-CyX3ZAti5DA-unsplash.jpg'),
  ],
  [
    'title' => 'Monitoramento de Vídeos',
    'description' => 'Monitore o interior e os arredores dos veículos para segurança e registro de incidentes.',
    'icon' => 'video',
    'image' => asset('images/liubomyr-vovchak-g3IWWNdUc7U-unsplash.jpg'),
  ],
  [
    'title' => 'Gestão de Rotas',
    'description' => 'Coordene e rastreie os deslocamentos da sua frota de forma eficiente.',
    'icon' => 'truck',
    'image' => asset('images/oksana-gogu-me1WewCfdzc-unsplash.jpg'),
  ],
];
@endphp

<section id="features" class="py-20 bg-fleetpro-gray">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold mb-4">Recursos Abrangentes de Gestão de Frotas</h2>
      <p class="text-fleetpro-darkgray max-w-2xl mx-auto">
        Nossa solução integrada oferece tudo o que você precisa para gerenciar sua frota de forma eficiente e eficaz.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($features as $feature)
            {{-- Card container --}}
            <div class="feature-card overflow-hidden border border-gray-200">
                {{-- Image header --}}
                <div class="h-48 overflow-hidden">
                    <img
                        src="{{ $feature['image'] }}"
                        alt="{{ $feature['title'] }}"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                </div>

                {{-- Content --}}
                <div class="pb-2 px-4 pt-4">
                    <div class="flex items-center gap-2 mb-1">
                        {{-- <Flux:icon.{{ $feature['icon'] }} class="w-5 h-5 text-blue-300" /> --}}
                        <h3 class="text-xl font-semibold text-blue-400">
                            {{ $feature['title'] }}
                        </h3>
                    </div>
                </div>
                <div class="px-4 pb-4">
                    <p class="text-base text-gray-800 dark:text-zinc-300">
                        {{ $feature['description'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</section>

