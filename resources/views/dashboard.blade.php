<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-xl">
                <h1 class="text-3xl font-bold text-white">Olá novamente! 👋</h1>
                <p class="text-gray-400 mt-2">Bem-vindo à tua área pessoal. Aqui podes consultar as tuas compras.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <a href="{{ route('orders.index') }}"
                   class="group bg-gray-900 border border-gray-800 p-6 rounded-2xl hover:border-yellow-600 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-900/20">
                    <div class="text-yellow-600 mb-4 text-3xl">📦</div>
                    <h2 class="text-lg font-bold text-white group-hover:text-yellow-500 transition-colors">As Minhas Encomendas</h2>
                    <p class="text-sm text-gray-400 mt-1">Acompanha o estado das tuas compras.</p>
                </a>

                <div class="bg-gray-900 border border-gray-800 p-6 rounded-2xl opacity-50 cursor-not-allowed">
                    <div class="text-gray-600 mb-4 text-3xl">⚙️</div>
                    <h2 class="text-lg font-bold text-gray-500">Definições</h2>
                    <p class="text-sm text-gray-500 mt-1">Brevemente disponível.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
