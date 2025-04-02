<div class="space-y-4">

    <div>
        <label class="block font-medium">Nome *</label>
        <input type="text" wire:model.defer="name" class="input">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">CNPJ *</label>
        <input type="text" wire:model.defer="cnpj" class="input">
        @error('cnpj') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-medium">Endereço *</label>
        <input type="text" wire:model.defer="location" class="input">
        @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <div class="flex items-center mt-4">
          <input type="checkbox" wire:model.defer="is_active" id="is_active" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200" />
          <label for="is_active" class="ml-2 block text-sm text-gray-700">Posto ativo</label>
        </div>
        @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

</div>
