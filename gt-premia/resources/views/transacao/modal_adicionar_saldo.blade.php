
<!-- Modal -->

<div x-data="{ open: false }">
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-bold p-4 sm:p-8 bg-white mb-4">Transação</h2>
            
            <form action="{{ route('transacao.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipo</label>
                        <select name="tipo" id="tipo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
                            <option value="credito">Crédito</option>
                            <option value="debito">Débito</option>
                        </select>
                    </div>
                    <div>
                        <label for="valor" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Valor</label>
                        <input type="text" name="valor" id="valor" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
                    </div>
                </div>
                <input type="hidden" name="carteira_id" value="{{ $carteira->id }}">

                <div class="mt-4 flex justify-between">
                    <button type="button" @click="open = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Fechar
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Adicionar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>