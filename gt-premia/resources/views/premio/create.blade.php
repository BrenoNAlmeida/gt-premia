<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Premios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- botao para redirecionar para a criação de premio -->
                <div class="flex justify-end">
                    <a href="{{ route('premio.create') }}" class="bg-green-700 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Cadastrar prêmio
                    </a>
                </div> <!-- data table que mostra os premios cadastrados com os campos nome, quantidade ações -->
                @include('premio.partials.create-form')
            </div>
        </div>

</x-app-layout>