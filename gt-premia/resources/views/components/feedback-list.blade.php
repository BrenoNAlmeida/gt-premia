<div x-data="{ 
        openCadastro: false, 
        openVisualizacao: false, 
        feedbackUserId: null, 
        valorSelecionado: null,
        feedback: '',
        feedbackSelecionado: ''
    }">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Feedbacks</h2>
            <button @click="openCadastro = true; feedbackUserId = {{ $usuario->id }}" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cadastrar Feedback
            </button>
        </div>

        <!-- listagem dos feedbacks -->
        <div class="mt-4">
        <table id="feedbackTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Valor indicado
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Feedback
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @foreach ($feedbacks as $feedback)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $feedback->user->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $feedback->valor_indicacao->nome }}</div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($feedback->feedback, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                            @click="feedbackSelecionado = {{ json_encode($feedback->feedback) }}; openVisualizacao = true">
                            Ver
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>

    <!-- Modal cadastro -->
    <div x-show="openCadastro" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" x-cloak>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg text-white font-bold mb-4">Novo Feedback</h2>

            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf

                    <!-- Campo para selecionar um valor -->
                    <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Selecione um valor</label>
                    <select 
                        name="valor_id" 
                        x-model="valorSelecionado"
                        class="mt-2 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                        required>
                        <option value="">Selecione um valor</option>
                        @foreach ($valores as $valor)
                            <option value="{{ $valor->id }}">{{ $valor->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Campo Feedback -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Feedback</label>
                    <textarea 
                        name="feedback" 
                        x-model="feedback"
                        class="mt-2 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                        rows="4" 
                        placeholder="Digite seu feedback..."
                        required></textarea>
                </div>

                <!-- Campo oculto para passar o id do usuário -->
                <input type="hidden" name="user_id" :value="feedbackUserId" />

                <div class="mt-4 flex justify-between">
                    <button type="button" @click="openCadastro = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Fechar
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal visualização-->
    <div x-show="openVisualizacao" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" x-cloak>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Feedback</label>
                <p class="mt-2 text-gray-900 dark:text-gray-300" x-text="feedbackSelecionado"></p>
            </div>
            <div class="mt-4 flex justify-between">
                <button type="button" @click="openVisualizacao = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Fechar
                </button>
            </div>
        </div>
    </div>
    
</div>
