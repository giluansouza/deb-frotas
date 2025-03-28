<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
      <label class="block text-sm font-medium text-gray-700">Placa</label>
      <input type="text" wire:model.defer="plate" class="input" autofocus placeholder="Placa do veículo" />
      @error('plate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Renavam</label>
      <input type="text" wire:model.defer="renavam" class="input" placeholder="Número do Renavam" />
      @error('renavam') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Marca</label>
      <input type="text" wire:model.defer="brand" class="input" placeholder="Marca do veículo" />
      @error('brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Modelo</label>
      <input type="text" wire:model.defer="model" class="input" placeholder="Modelo do veículo" />
      @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Ano Fabricação</label>
        <input type="number" wire:model.defer="year_manufacture" class="input" placeholder="Ano de Fabricação" />
        @error('year_manufacture') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Ano Modelo</label>
      <input type="number" wire:model.defer="year_model" class="input" placeholder="Ano Modelo" />
      @error('year_model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
  {{-- </div> --}}

  <div>
      <label class="block text-sm font-medium text-gray-700">Tipo de Veículo</label>
      <select wire:model.defer="type" class="input">
          <option value="">Selecione o tipo</option>
          <option value="Automóvel">Automóvel</option>
          <option value="Caminhoneta">Caminhoneta</option>
          <option value="Camioneta">Camioneta</option>
          <option value="Caminhão">Caminhão</option>
          <option value="Micrônibus">Micrônibus</option>
          <option value="Motocicleta">Motocicleta</option>
          <option value="Ônibus">Ônibus</option>
          <option value="Utilitário">Utilitário</option>
      </select>
      @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Estado de conservação</label>
      <select wire:model.defer="conservation_state" class="input">
          <option value="">Selecione</option>
          <option value="Bom">Bom</option>
          <option value="Regular">Regular</option>
          <option value="Ruim">Ruim</option>
          <option value="Inativo">Inativo</option>
      </select>
      @error('conservation_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Capacidade do Tanque</label>
      <input type="number" wire:model.defer="tank_capacity" class="input" placeholder="Capacidade do tanque" />
      @error('tank_capacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Tipo de Combustível</label>
      <select wire:model.defer="fuel_type" class="input">
          <option value="">Selecione</option>
          <option value="gasoline">Gasolina</option>
          <option value="ethanol">Etanol</option>
          <option value="diesel">Diesel</option>
          <option value="flex">Flex</option>
          <option value="electric">Elétrico</option>
      </select>
      @error('fuel_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <label class="block text-sm font-medium text-gray-700">Propriedade</label>
      <select wire:model.defer="ownership" class="input">
          <option value="">Selecione a propriedade</option>
          <option value="Próprio">Próprio</option>
          <option value="Alugado">Alugado</option>
          <option value="Cedido">Cedido</option>
      </select>
      @error('ownership') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Unidade administrativa</label>
    <select wire:model.defer="administrative_unit" class="input">
        <option value="">Selecione a unidade administrativa</option>
        <option value="Saúde">Saúde</option>
        <option value="Educação">Educação</option>
        <option value="Transporte">Transporte</option>
        <option value="Infraestrutura">Infraestrutura</option>
    </select>
    @error('administrative_unit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>

  <div>
      <div class="flex items-center mt-4">
        <input type="checkbox" wire:model.defer="visual_identity" id="visual_identity" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200" />
        <label for="visual_identity" class="ml-2 block text-sm text-gray-700">Possui identidade visual?</label>
      </div>
      @error('visual_identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror     
  </div>
</div>