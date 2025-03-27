<div class="max-w-7xl mx-auto p-6 bg-zinc-100 rounded-xl shadow-md">
    <div class="border-b border-gray-200 pb-3 mb-5">
        <h2 class="text-3xl font-semibold text-gray-800">Usuários</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-zinc-200">
                <tr class="text-left">
                    <th class="px-4 py-2 font-medium text-gray-600">Nome</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Email</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Tipo</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @forelse ($user->getRoleNames() as $role)
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 rounded-full font-semibold">
                                    {{ $role }}
                                </span>
                            @empty
                                <span class="inline-block bg-gray-100 text-gray-500 text-xs px-2 rounded-full">
                                    Sem Role
                                </span>
                            @endforelse
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>