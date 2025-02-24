<!-- mostra um card com os dados do colaborador -->

<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Detalhes do usuário</h2>
        <a href="{{ route('usuarios.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Voltar
        </a>
    </div>
    <div class="mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nome</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $usuario->name }}</p>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">E-mail</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $usuario->email }}</p>
            </div>
        </div>

        
    </div>
    
    
    <!-- detalhes da carteira do usuario -->
    
</div>
