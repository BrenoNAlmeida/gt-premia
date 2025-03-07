<!-- Adicione o CSS do DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<div class='py-6'>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class='h-full flex flex-col'>
                    <table id="usuariosTable" class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th class="text-left px-4 py-2">Nome</th>
                                <th class="text-left px-4 py-2">e-mail</th>
                                <th class="text-left px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-900">
                            @foreach ($usuarios as $usuario)
                            <tr class="hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $usuario->name }}</td>
                                <td class="px-4 py-2">{{ $usuario->email }}</td>
                            
                                <td class="px-4 py-2">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mr-1">
                                        Editar
                                    </a>

                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="bg-yellow-600 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">
                                        Detalhes
                                    </a>

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
        $('#usuariosTable').DataTable({
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