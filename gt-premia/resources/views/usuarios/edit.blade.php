<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- CPF -->
                    <div class="mt-4">
                        <x-input-label for="cpf" :value="__('CPF')" />
                        <x-text-input
                            id="cpf"
                            class="block mt-1 w-full"
                            type="text"
                            name="cpf"
                            :value="old('cpf', $user->cpf)"
                            required
                            autocomplete="cpf" />
                        <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                    </div>
                    <!-- Grupo -->
                    <div class="mt-4">
                        <x-input-label for="grupo" :value="__('Grupo')" />
                        <select name="grupo" id="grupo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
                            <option value="rh" {{ old('grupo', $user->roles[0]->name) == 'RH' ? 'selected' : '' }}>RH</option>
                            <option value="colaborador" {{ old('grupo', $user->roles[0]->name) == 'colaborador' ? 'selected' : '' }}>Colaborador</option>
                        </select>
                        <x-input-error :messages="$errors->get('grupo')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Atualizar') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="flex items-center justify-end mt-4">
                    <form action="{{ route('usuarios.resetar_senha', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Redefinir Senha') }}
                        </button>
                    </form>
                </div>
            </div> 
        </div>
    </div>

    <!-- Novo link para o Inputmask -->
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cpfInput = document.getElementById('cpf');
            if (cpfInput) {
                Inputmask('999.999.999-99').mask(cpfInput);
            }
        });
    </script>
</x-app-layout>
