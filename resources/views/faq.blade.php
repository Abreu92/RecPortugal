<x-app-layout>
    <div class="py-16 bg-black min-h-screen text-gray-300">
        <div class="max-w-3xl mx-auto px-6">

            {{-- Botão Voltar --}}
            <a href="/" class="inline-flex items-center text-sm font-bold uppercase tracking-widest text-rec-gold-600 hover:text-white transition-colors mb-6 group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Voltar à Página Inicial
            </a>

            <h1 class="text-4xl font-bold text-white mb-8 border-l-4 border-rec-gold-600 pl-4">Perguntas Frequentes</h1>
            <p class="mb-10 text-gray-400">Encontra aqui as respostas para as dúvidas mais comuns sobre os nossos equipamentos e serviços.</p>

            <div class="space-y-4" x-data="{ selected: null }">

                {{-- FAQ Item 1 --}}
                <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
                    <button @click="selected !== 1 ? selected = 1 : selected = null" class="w-full text-left p-6 flex justify-between items-center hover:bg-gray-800 transition">
                        <span class="font-bold text-rec-gold-500">Qual é o prazo de entrega?</span>
                        <span x-text="selected === 1 ? '−' : '+'" class="text-xl"></span>
                    </button>
                    <div x-show="selected === 1" class="px-6 pb-6 text-gray-400 border-t border-gray-800 pt-4" x-cloak>
                        O nosso prazo de envio habitual é de 3 a 5 dias úteis para Portugal Continental. Durante períodos de elevada procura, este prazo pode estender-se ligeiramente.
                    </div>
                </div>

                {{-- FAQ Item 2 --}}
                <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
                    <button @click="selected !== 2 ? selected = 2 : selected = null" class="w-full text-left p-6 flex justify-between items-center hover:bg-gray-800 transition">
                        <span class="font-bold text-rec-gold-500">Como posso devolver um produto?</span>
                        <span x-text="selected === 2 ? '−' : '+'" class="text-xl"></span>
                    </button>
                    <div x-show="selected === 2" class="px-6 pb-6 text-gray-400 border-t border-gray-800 pt-4" x-cloak>
                        Tens 14 dias após a receção para solicitar a devolução. O produto deve estar em estado original e com as etiquetas intactas. Entra em contacto através do nosso email de suporte.
                    </div>
                </div>

                {{-- FAQ Item 3 --}}
                <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
                    <button @click="selected !== 3 ? selected = 3 : selected = null" class="w-full text-left p-6 flex justify-between items-center hover:bg-gray-800 transition">
                        <span class="font-bold text-rec-gold-500">Os produtos têm garantia?</span>
                        <span x-text="selected === 3 ? '−' : '+'" class="text-xl"></span>
                    </button>
                    <div x-show="selected === 3" class="px-6 pb-6 text-gray-400 border-t border-gray-800 pt-4" x-cloak>
                        Sim, todos os equipamentos REC.PORTUGAL possuem garantia de 2 anos contra defeitos de fabrico, conforme a legislação em vigor.
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
