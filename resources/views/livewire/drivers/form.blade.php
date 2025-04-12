<div class="flex flex-col gap-4">
    <div class="w-1/2">
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select wire:model.defer="status" class="input">
            <option value="">Selecione o status</option>
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label class="block text-sm font-medium text-gray-700">Nome do motorista</label>
            <input type="text" wire:model.defer="name" class="input" autofocus placeholder="Nome do motorista" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Matrícula</label>
            <input type="text" wire:model.defer="register" class="input" placeholder="Matrícula" />
            @error('register') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">CPF</label>
            <input type="text" wire:model.defer="cpf" class="input" placeholder="CPF" />
            @error('cpf') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">RG</label>
            <input type="text" wire:model.defer="rg" class="input" placeholder="RG" />
            @error('rg') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Número da CNH</label>
            <input type="text" wire:model.defer="number_cnh" class="input" placeholder="Número do CNH" />
            @error('number_cnh') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Categoria CNH</label>
            <input type="text" wire:model.defer="category_cnh" class="input" placeholder="Categoria da CNH" />
            @error('category_cnh') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Data da 1ª CNH</label>
            <input type="date" wire:model.defer="first_cnh" class="input" placeholder="Data da 1ª CNH" />
            @error('first_cnh') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Validade da CNH</label>
            <input type="date" wire:model.defer="validity_cnh" class="input" placeholder="Validade da CNH" />
            @error('validity_cnh') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
