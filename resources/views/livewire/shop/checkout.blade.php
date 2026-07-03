<x-app-layout>
    <div class="bg-zinc-950 min-h-screen py-20 text-white">
        <div class="max-w-2xl mx-auto px-4">
            <h1 class="text-3xl font-black mb-8 uppercase">Finalizar Compra</h1>

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6 bg-zinc-900 p-8 rounded-xl border border-zinc-800">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-zinc-500 uppercase">Nome Completo</label>
                        <input type="text" name="name" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg p-3 text-white focus:border-rec-gold-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-zinc-500 uppercase">E-mail</label>
                        <input type="email" name="email" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg p-3 text-white focus:border-rec-gold-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase">Morada (Rua e número)</label>
                    <input type="text" name="street" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg p-3 text-white focus:border-rec-gold-600 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-zinc-500 uppercase">Cidade</label>
                        <input type="text" name="city" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg p-3 text-white focus:border-rec-gold-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-zinc-500 uppercase">Cód. Postal (0000-000)</label>
                        <input type="text" name="postal_code" placeholder="0000-000" required pattern="\d{4}-\d{3}" class="w-full bg-zinc-950 border border-zinc-700 rounded-lg p-3 text-white focus:border-rec-gold-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase">Telemóvel</label>
                    <input type="tel" name="phone" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg p-3 text-white focus:border-rec-gold-600 outline-none">
                </div>

                <button type="submit" class="w-full bg-rec-gold-600 text-black font-bold py-4 rounded-xl hover:bg-rec-gold-500 transition uppercase tracking-widest">
                    Pagar Encomenda
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
