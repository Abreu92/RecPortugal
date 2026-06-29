<x-app-layout>
    <div class="bg-zinc-950 min-h-screen text-white py-12 md:py-20 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-rec-gold-600/10 blur-[120px] rounded-full"></div>

        <div class="max-w-6xl mx-auto px-4 relative z-10">
            <a href="{{ url('/') }}" class="flex items-center text-gray-500 hover:text-rec-gold-600 transition-colors mb-8 group">
                <span class="mr-2">&larr;</span>
                <span class="uppercase tracking-widest text-xs font-bold border-b border-gray-800 group-hover:border-rec-gold-600">Voltar para a Página Inicial</span>
            </a>

            <form action="{{ route('cart.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="relative group rounded-2xl overflow-hidden border border-white/10 bg-zinc-900/50 p-2">
                    <img src="{{ asset('storage/' . $product->image_path) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-auto object-cover rounded-xl">
                </div>

                <div class="flex flex-col h-full">
                    <div class="mb-8">
                        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter mb-2">{{ $product->name }}</h1>
                        <p class="text-rec-gold-600 font-mono text-3xl font-black">{{ number_format($product->price, 2) }} €</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                        <div class="bg-zinc-900/50 p-4 border border-white/10 rounded-lg">
                            <span class="block text-gray-500 text-[10px] uppercase tracking-widest mb-1">Disponibilidade</span>
                            @if($product->stock > 0)
                                <span class="text-green-500 font-bold flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Em Stock ({{ $product->stock }} unidades)
                                </span>
                            @else
                                <span class="text-red-500 font-bold flex items-center">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span> Esgotado
                                </span>
                            @endif
                        </div>

                        <div class="bg-zinc-900/50 p-4 border border-white/10 rounded-lg">
                            <label for="variant" class="block text-gray-500 text-[10px] uppercase tracking-widest mb-2">Selecionar Especificação</label>
                            <select id="variant" name="variant_id" class="w-full bg-zinc-950 border border-white/10 text-white p-2 rounded text-sm focus:border-rec-gold-600 outline-none">
                                @forelse($product->variants as $variant)
                                    <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                @empty
                                    <option disabled>Sem opções disponíveis</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="border-t border-white/10 py-6 mb-6">
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Descrição da Missão</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $product->description ?? 'Sem especificações.' }}</p>
                    </div>

                    @if($product->stock > 0)
                        <button type="submit" class="w-full py-4 bg-rec-gold-600 text-black font-black uppercase tracking-widest text-lg hover:bg-white transition-all duration-300">
                            Adicionar ao Arsenal
                        </button>
                    @else
                        <button type="button" disabled class="w-full py-4 bg-zinc-800 text-gray-500 font-black uppercase tracking-widest text-lg cursor-not-allowed">
                            Fora de Stock
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
