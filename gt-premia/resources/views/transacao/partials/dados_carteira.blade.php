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