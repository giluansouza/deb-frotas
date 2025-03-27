<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Editar Motorista</h2>
    </div>

    <form wire:submit.prevent="update">
        @include('livewire.drivers.form')

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('driver.index') }}" class="px-4 py-2 rounded text-gray-600 border">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 cursor-pointer">
                Salvar alterações
            </button>
        </div>
    </form>
    <hr class="my-6">
    
    <div class="mt-6 bg-red-50 border border-red-300 p-4 rounded shadow-sm">
        <h3 class="text-lg font-semibold text-red-700 mb-2">Ação perigosa</h3>
        <p class="text-sm text-red-600 mb-4">Esta ação irá desativar o motorista. Ele será marcado como excluído, mas poderá ser restaurado futuramente.</p>
    
        <button
            wire:click="deleteDriver"
            onclick="return confirm('Tem certeza que deseja excluir este motorista?')"
            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer"
        >
            Excluir motorista
        </button>
    </div>
</div>

