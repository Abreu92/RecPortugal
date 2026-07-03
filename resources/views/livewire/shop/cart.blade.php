<x-app-layout>
    <div class="bg-zinc-950 min-h-screen py-20 text-white">
        <div class="max-w-5xl mx-auto px-4">

            <header class="mb-10">
                <h1 class="text-4xl font-black uppercase tracking-tight">O Teu Arsenal</h1>
                <p class="text-zinc-500 mt-2">Revisão dos equipamentos selecionados.</p>
            </header>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-4">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php
                                $price = $details['price'] ?? 0;
                                $qty = $details['quantity'] ?? 1;
                                $total += $price * $qty;
                                $rawPath = $details['image'] ?? '';
                                $cleanPath = str_replace('public/', '', $rawPath);
                                $fullUrl = asset('storage/' . $cleanPath);
                            @endphp

                            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center transition hover:border-zinc-700">

                                {{-- Imagem com Debug Visual --}}
                                <div class="md:col-span-2 w-full aspect-square bg-zinc-800 rounded-lg overflow-hidden relative group">
                                    @if(!empty($details['image']))
                                        <img src="{{ $fullUrl }}"
                                             alt="{{ $details['name'] ?? 'Produto' }}"
                                             class="w-full h-full object-cover">

                                        {{-- DEBUG VISUAL: Isto vai aparecer sobre a imagem para sabermos o caminho --}}
                                        <div class="absolute inset-0 bg-black/80 text-[10px] p-1 break-all flex flex-col justify-center opacity-0 group-hover:opacity-100 transition-opacity overflow-hidden">
                                            <span class="text-yellow-500">Caminho:</span> {{ $cleanPath }}
                                            <span class="text-green-500 mt-2">URL Final:</span> {{ $fullUrl }}
                                        </div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                            <span>Sem Img</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Detalhes --}}
                                <div class="md:col-span-4">
                                    <h3 class="font-bold text-base md:text-lg leading-tight">{{ $details['name'] ?? 'Produto' }}</h3>
                                    <p class="text-rec-gold-600 font-mono font-bold mt-1">{{ number_format($price, 2) }} €</p>
                                </div>

                                {{-- Quantidade --}}
                                <div class="md:col-span-4">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $qty }}" min="1"
                                               class="w-16 bg-zinc-950 border border-zinc-700 text-center rounded-lg p-2 text-sm focus:border-rec-gold-600 outline-none transition">
                                        <button type="submit" class="text-xs bg-zinc-800 hover:bg-zinc-700 px-3 py-2 rounded-lg transition text-zinc-300">Atualizar</button>
                                    </form>
                                </div>

                                <div class="md:col-span-2 text-right">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500/70 hover:text-red-500 text-xs uppercase tracking-widest font-bold transition">Remover</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Resumo --}}
                    <div class="lg:col-span-1">
                        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 sticky top-24">
                            <h2 class="text-lg font-bold mb-6 border-b border-zinc-800 pb-4">Resumo</h2>
                            <div class="flex justify-between items-center mb-6 text-2xl font-black">
                                <span class="text-zinc-400 font-medium">Total</span>
                                <span class="text-rec-gold-600">{{ number_format($total, 2) }} €</span>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="block w-full text-center bg-rec-gold-600 text-black font-bold py-4 rounded-xl hover:bg-rec-gold-500 transition uppercase tracking-widest text-sm shadow-lg shadow-rec-gold-600/20">
                                Finalizar Compra
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20 bg-zinc-900/50 rounded-2xl border border-dashed border-zinc-800">
                    <p class="text-zinc-500 text-lg">O teu arsenal está vazio.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
