<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full text-center bg-gray-900 p-10 rounded-3xl border border-gray-800 shadow-xl">
            <div class="w-20 h-20 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-2">Pagamento Efetuado!</h1>
            <p class="text-gray-400 mb-8">A tua encomenda foi processada com sucesso. Obrigado pela confiança.</p>

            <a href="{{ url('/') }}" class="inline-block px-8 py-3 bg-white text-black font-bold rounded-full hover:bg-gray-200 transition">
                Voltar à Página Inicial
            </a>
        </div>
    </div>
</x-layouts.app>
