<div x-data="{ open: false }">
    <!-- card -->
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Transações</h2>
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('rh'))
            <button @click="open = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Adicionar Transação
            </button>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div x-data="{ 
        valorSelecionado: null, 
        valores: {{ $valores->toJson() }}, // Converte valores para JSON
        get gtCoins() { 
            let item = this.valores.find(v => v.id == this.valorSelecionado);
            return item ? item.cotacao : 0;
        } 
    }">
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg text-white font-bold mb-4">Transação</h2>

                <form action="{{ route('transacao.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipo</label>
                            <select name="tipo" id="tipo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>
                            </select>
                        </div>

                        <div>
                            <label for="valor" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Valor</label>
                            <select name="valor" id="valor" x-model="valorSelecionado"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
                                <option value="">Selecione um valor</option>
                                @foreach ($valores as $valor)
                                <option value="{{ $valor->id }}">{{ $valor->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="gt_coins" class="block text-sm font-medium text-gray-700 dark:text-gray-200">GT Coins</label>
                            <input type="number" :value="gtCoins" disabled name="gt_coins" id="gt_coins"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
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
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        GT-coins
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
                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $transacao->valor_recebido->nome ?? $transacao->descricao }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($transacao->tipo == 'entrada')
                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $transacao->montante }}</div>
                        @else
                        <div class="text-sm text-gray-900 dark:text-gray-100">- {{ $transacao->montante }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($transacao->created_at)->format('d/m/Y') }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
