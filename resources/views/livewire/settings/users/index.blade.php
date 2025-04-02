<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="flex justify-between border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Oficinas</h2>

        <a href="{{ route('user.create') }}" class="flex gap-1 items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <flux:icon.plus class="w-5 h-5" /> Novo Usuário
        </a>
    </div>

    @if ($successMessage)
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700 border border-green-300 shadow-sm">
            {{ $successMessage }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-zinc-200">
                <tr class="text-left">
                    <th class="px-4 py-2 font-medium text-gray-600">Nome</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Email</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Tipo</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @forelse ($user->getRoleNames() as $role)
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-semibold">
                                    {{ $role }}
                                </span>
                            @empty
                                <span class="inline-block bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full">
                                    Sem Role
                                </span>
                            @endforelse
                        </td>
                        <td class="px-4 py-3">
                            <a
                                href="{{ route('user.edit', $user->id) }}"
                                class="text-blue-600 hover:underline flex gap-1">
                                <flux:icon.pencil class="size-5" /> Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>