<footer class="p-4 border-t border-zinc-300">
    <div class="container mx-auto flex justify-between items-center">
        <span>
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
        </span>
        <nav>
            <ul class="flex space-x-4 text-gray-600 dark:text-gray-200">
                <li>
                    <a href="#" class="hover:text-blue-500">Política de Privacidade</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-500">Termos de Serviço</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-500">Contato</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>
