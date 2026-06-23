<div class="py-12 bg-black min-h-screen text-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-2xl font-bold border-l-4 border-yellow-600 pl-4">
                PAINEL DE ADMINISTRAÇÃO
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('admin.create-product') }}"
               class="bg-gray-900 border border-gray-800 p-6 rounded-lg hover:border-yellow-600 transition duration-300">
                <div class="text-yellow-600 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-bold">Novo Equipamento</h2>
                <p class="text-sm text-gray-400 mt-1">Adicionar novo produto e variantes.</p>
            </a>

            <a href="{{ route('admin.products') }}" wire:navigate
               class="bg-gray-900 border border-gray-800 p-6 rounded-lg hover:border-yellow-600 transition duration-300">
                <div class="text-yellow-600 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-bold">Gerir Stock</h2>
                <p class="text-sm text-gray-400 mt-1">Ver, editar e apagar equipamentos.</p>
            </a>

        </div>
    </div>
</div>
