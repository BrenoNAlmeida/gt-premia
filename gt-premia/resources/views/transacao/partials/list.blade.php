{{-- lista todos as transações --}}
<!-- Adicione o CSS do DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<div class='py-6'>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class='h-full flex flex-col'>
                    <table id="transacoesTable" class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th class="text-left px-4 py-2">Colaborador</th>
                                <th class="text-left px-4 py-2">Status</th>
                                <th class="text-left px-4 py-2">tipo</th>
                                <th class="text-left px-4 py-2">Descrição</th>
                                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('rh'))
                                <th class="text-left px-4 py-2">Ações</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @foreach ($transacoes as $transacao)
                            <tr class="hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $transacao->carteira->user->name}}</td>
                                @if($transacao->status == 'aprovado')
                                <td class="p-1 text-center">
                                    <span class="bg-green-600 hover:bg-green-700 text-white font-bold px-2 py-1 rounded inline-block">
                                        {{ $transacao->status }}
                                    </span>
                                </td>
                                @elseif ($transacao->status == 'pendente')
                                <td class="p-1 text-center">
                                    <span class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold px-2 py-1 rounded inline-block">
                                        {{ $transacao->status }}
                                    </span>
                                </td>
                                @elseif ($transacao->status == 'reprovado')
                                <td class="p-1 text-center">
                                    <span class="bg-red-600 hover:bg-red-700 text-white font-bold px-2 py-1 rounded inline-block">
                                        {{ $transacao->status }}
                                    </span>
                                </td>
                                @endif
                                <td class="px-4 py-2">{{ $transacao->tipo ?? ''}}</td>
                                @if($transacao->descricao == 'Retirada de prêmio')
                                <td class="px-4 py-2">{{ $transacao->descricao . ' ' . $transacao->premio_retirado->nome }}</td>
                                @else
                                <td class="px-4 py-2">{{ $transacao->descricao ?? ''}}</td>
                                @endif
                                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('rh'))
                                <td class="px-4 py-2">
                                        @if($transacao->status == 'pendente')
                                        <form action="{{ route('transacao.aprovar', $transacao->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mr-1">
                                                aprovar
                                            </button>
                                        </form>
                                        <form action="{{ route('transacao.reprovar', $transacao->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded mr-1">
                                                reprovar
                                            </button>
                                        </form>
                                        @else
                                        <span></span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Adicione o JS do DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transacoesTable').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Pesquisar:",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            },
            "dom": "<'flex justify-between items-center px-4'<'w-1/2'l><'w-1/2'f>>" +
                "<'mt-2'tr>" +
                "<'flex justify-between items-center px-4'<'w-1/2'i><'w-1/2'p>>"
        });
    });
</script>