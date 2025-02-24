 <!-- card -->
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Transações</h2>
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('rh'))
            <a href="#"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                @click.prevent="Livewire.dispatch('open-modal', { detail: 'modal_transacao' })">
                Adicionar Transação
            </a>
            @endif
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Saldo</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $carteira->saldo }}</p>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Saldo Retido</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $carteira->saldo_retido }}</p>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Valor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Data
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach ($transacoes as $transacao)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $transacao->tipo }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $transacao->valor }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $transacao->created_at }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
