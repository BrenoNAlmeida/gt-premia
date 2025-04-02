<div x-data="{ open: false, feedbackSelecionado: '' }">
    <!-- Tabela de Feedbacks -->
    <div class="mt-4">
        <table id="feedbackTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Nome
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
                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($feedback->feedback, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                            @click="feedbackSelecionado = {{ json_encode($feedback->feedback) }}; open = true">
                            Ver
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     <!-- Modal -->
     <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <div>
                <label class="block text-sm font-medium text-gray-700  dark:text-gray-200">Feedback</label>
                <p class="mt-2 text-gray-900 dark:text-gray-300" x-text="feedbackSelecionado"></p>
            </div>
            <div class="mt-4 flex justify-between">
                <button type="button" @click="open = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Importação do DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#feedbackTable').DataTable({
            responsive: true,
            language: {
                search: "Pesquisar:",
                lengthMenu: "Mostrar _MENU_ registros por página",
                zeroRecords: "Nenhum feedback encontrado",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "Nenhum registro disponível",
                infoFiltered: "(filtrado de _MAX_ registros totais)",
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior"
                }
            }
        });
    });
</script>
