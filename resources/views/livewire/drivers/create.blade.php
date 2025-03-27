<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Cadastrar Motorista</h2>
    </div>

    <form wire:submit.prevent="save">
        @include('livewire.drivers.form')

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('driver.index') }}" class="px-4 py-2 rounded text-gray-600 border">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 cursor-pointer">
                Salvar
            </button>
        </div>
    </form>
</div>
