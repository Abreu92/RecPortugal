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

            <h1 class="text-4xl font-bold text-white mb-8 border-l-4 border-rec-gold-600 pl-4">Protocolos de Segurança</h1>

            <div class="space-y-8 text-gray-400">

                <section>
                    <h2 class="text-xl font-bold text-rec-gold-500 mb-3">1. Manuseamento de Equipamento</h2>
                    <p>Todos os equipamentos táticos devem ser utilizados de acordo com o manual de instruções. A utilização indevida pode comprometer a integridade do material e a segurança do utilizador.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-rec-gold-500 mb-3">2. Transporte e Armazenamento</h2>
                    <p>Recomendamos o armazenamento em local seco e ventilado. Em caso de transporte, assegure-se de que todos os componentes sensíveis estão protegidos contra impactos e humidade extrema.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-rec-gold-500 mb-3">3. Manutenção Preventiva</h2>
                    <p>Para garantir a longevidade e fiabilidade dos equipamentos REC.PORTUGAL, sugerimos uma inspeção visual após cada utilização intensiva e limpeza de acordo com as especificações técnicas fornecidas.</p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
