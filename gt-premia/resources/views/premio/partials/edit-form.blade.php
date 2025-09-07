<form method="POST" action="{{ route('premio.update', $premio->id) }}">
    @csrf
    @method('PUT')

    <div class="space-y-4">
        <!-- Nome -->
        <div>
        <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Premio</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $premio->nome) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600">
            @error('nome')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descrição -->
        <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
            <input type="text" id="descricao" name="descricao" 
                value="{{ old('descricao', $premio->descricao) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600">
            @error('descricao')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <select id="status" name="status" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                <option value="disponivel" {{ old('status', $premio->status) == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                <option value="indisponivel" {{ old('status', $premio->status) == 'indisponivel' ? 'selected' : '' }}>Indisponível</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Preço -->
        <div>
            <label for="preco" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preço</label>
            <input type="text" id="preco" name="preco" 
                value="{{ old('preco', $premio->preco) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600">
            @error('preco')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Quantidade -->
        <div>
            <label for="quantidade" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" 
                value="{{ old('quantidade', $premio->quantidade) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600">
            @error('quantidade')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Atualizar') }}
        </x-primary-button>
    </div>
</form>
