<section class="bg-zinc-900 py-16 border-t border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-12 border-l-4 border-rec-gold-600 pl-6">
            <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">
                Arsenal <span class="text-rec-gold-600">Disponível</span>
            </h2>
            <p class="text-gray-400 mt-2 tracking-wide uppercase text-sm">Equipamento de alta performance pronto para a missão.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8">
            @forelse($products as $product)
                <div class="group bg-zinc-800/60 backdrop-blur-sm border border-white/20 rounded-xl overflow-hidden hover:border-rec-gold-600 hover:bg-zinc-800/80 transition-all duration-300 hover:shadow-2xl hover:shadow-rec-gold-600/20">

                    <div class="h-40 md:h-64 overflow-hidden relative">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 to-transparent"></div>
                    </div>

                    <div class="p-3 md:p-6 flex flex-col h-auto">
                        <h3 class="text-xs md:text-lg font-bold text-white mb-1 uppercase tracking-tight truncate">{{ $product->name }}</h3>
                        <p class="text-rec-gold-600 font-mono text-sm md:text-2xl font-black mb-4">{{ number_format($product->price, 2) }} €</p>

                        <button class="w-full py-2 md:py-3 bg-zinc-900 border border-rec-gold-600/50 text-white font-bold uppercase tracking-widest text-[10px] md:text-sm hover:bg-rec-gold-600 hover:text-black transition duration-300">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500 uppercase tracking-widest">Nenhum equipamento disponível no momento.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
