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

            <h1 class="text-4xl font-bold text-white mb-8 border-l-4 border-rec-gold-600 pl-4">Políticas e Termos</h1>

            <div class="space-y-8 text-gray-400">

                <section>
                    <h2 class="text-xl font-bold text-rec-gold-500 mb-3">1. Termos de Utilização</h2>
                    <p>Ao utilizar o site da REC.PORTUGAL, concorda com os nossos termos de serviço. O equipamento tático disponibilizado destina-se a fins legais e o utilizador é responsável pelo cumprimento das leis locais.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-rec-gold-500 mb-3">2. Privacidade e Dados</h2>
                    <p>Levamos a sua privacidade a sério. Os dados recolhidos (nome, morada, email) são utilizados apenas para processar encomendas e melhorar a sua experiência de navegação. Não partilhamos os seus dados com terceiros sem autorização.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-rec-gold-500 mb-3">3. Propriedade Intelectual</h2>
                    <p>Todo o conteúdo, logótipos e design presentes neste site são propriedade exclusiva da REC.PORTUGAL e estão protegidos pelas leis de direitos de autor.</p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
