<x-app-layout>
    <div class="bg-zinc-950 min-h-screen py-20 text-white">
        <div class="max-w-4xl mx-auto px-4">

            <header class="flex justify-between items-end mb-8">
                <h1 class="text-4xl font-black uppercase tracking-tight">O Teu Arsenal</h1>
                <a href="{{ route('shop') }}" class="text-sm text-zinc-500 hover:text-rec-gold-600 transition">← Continuar a explorar</a>
            </header>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-4">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp

                            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4 flex items-center gap-4 transition hover:border-zinc-700">

                                <div class="w-20 h-20 bg-zinc-800 rounded-lg overflow-hidden flex-shrink-0">
                                    @if(isset($details['image']))
                                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg">{{ $details['name'] }}</h3>
                                    <p class="text-rec-gold-600 font-mono font-bold">{{ number_format($details['price'], 2) }} €</p>
                                </div>

                                <div class="text-right flex flex-col items-end gap-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                                               class="w-16 bg-zinc-950 border border-zinc-700 text-center rounded-lg p-2 text-sm focus:border-rec-gold-600 outline-none transition">
                                        <button type="submit" class="text-xs text-zinc-500 hover:text-white transition">Atualizar</button>
                                    </form>

                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500/80 hover:text-red-500 text-xs transition">Remover</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 sticky top-20">
                            <h2 class="text-xl font-bold mb-6">Resumo da Encomenda</h2>
                            <div class="flex justify-between items-center mb-6 text-2xl font-black">
                                <span>Total</span>
                                <span class="text-rec-gold-600">{{ number_format($total, 2) }} €</span>
                            </div>
                            <a href="#" class="block w-full text-center bg-rec-gold-600 text-black font-bold py-4 rounded-xl hover:bg-rec-gold-500 transition uppercase tracking-widest text-sm">
                                Finalizar Compra
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20 bg-zinc-900 rounded-2xl border border-zinc-800">
                    <p class="text-zinc-500 text-lg">O teu arsenal está vazio.</p>
                    <a href="{{ route('shop') }}" class="mt-6 inline-block bg-zinc-800 px-6 py-2 rounded-lg hover:bg-zinc-700 transition">Voltar à Loja</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
