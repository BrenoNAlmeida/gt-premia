<x-modal  name="modal_transacao">
    <x-slot name="title">
        Transação
    </x-slot>
    <x-slot name="content">
        <form action="{{ route('transacao.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipo</label>
                    <select name="tipo" id="tipo" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
                        <option value="credito">Crédito</option>
                        <option value="debito">Débito</option>
                    </select>
                </div>
                <div>
                    <label for="valor" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Valor</label>
                    <input type="text" name="valor" id="valor" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                    dark:bg-gray-800 dark:text-gray-200">
                </div>
            </div>
            <input type="hidden" name="carteira_id" value="{{ $carteira->id }}">
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Adicionar
                </button>

            </div>
        </form>
    </x-slot>
</x-modal>