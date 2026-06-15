<x-app-layout>
    <div class="py-12 bg-black min-h-screen text-white">
        <div class="max-w-5xl mx-auto px-4">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Bloco 1: DETALHES -->
                <div class="bg-[#121212] border border-zinc-800 p-8 shadow-xl">
                    <div class="mb-8 border-l-4 border-rec-gold-600 pl-4">
                        <h2 class="text-lg font-bold uppercase tracking-widest text-white">
                            1. DETALHES DO NOVO EQUIPAMENTO
                        </h2>
                    </div>

                    <div class="grid grid-cols-2 gap-8 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">NOME DO ARTIGO</label>
                            <input type="text" name="name" required class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-white focus:border-rec-gold-600 outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">URL AMIGÁVEL (SLUG)</label>
                            <input type="text" name="slug" class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-white focus:border-rec-gold-600 outline-none transition-colors">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">DESCRIÇÃO TÉCNICA</label>
                        <textarea name="description" rows="4" class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-white focus:border-rec-gold-600 outline-none transition-colors"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">PREÇO BASE (€)</label>
                            <input type="number" name="price" step="0.01" required class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-white focus:border-rec-gold-600 outline-none transition-colors">
                        </div>
                        <!-- Campo para Coleção foi removido conforme pedido -->
                        <div></div>
                    </div>

                    <div class="mt-8">
                        <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">FOTOGRAFIA TÁTICA DO PRODUTO</label>
                        <div class="flex gap-4">
                            <input type="file" name="image" class="flex-1 bg-[#0a0a0a] border border-zinc-800 p-3 text-white cursor-pointer file:mr-4 file:py-1 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700">
                        </div>
                    </div>
                </div>

                <!-- Bloco 2: INVENTÁRIO -->
                <div class="bg-[#121212] border border-zinc-800 p-8 shadow-xl">
                    <div class="flex justify-between items-center mb-8 border-l-4 border-rec-gold-600 pl-4">
                        <h2 class="text-lg font-bold uppercase tracking-widest text-white">
                            2. INVENTÁRIO DE TAMANHOS E CORES
                        </h2>
                        <button type="button" class="bg-zinc-800 hover:bg-zinc-700 text-xs px-6 py-2 border border-zinc-700 font-bold uppercase transition-all">
                            + ADICIONAR LINHA
                        </button>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">SKU</label>
                            <input type="text" placeholder="REC-1143-S" class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-sm text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">TAMANHO</label>
                            <input type="text" placeholder="M, L, XL" class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-sm text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">COR</label>
                            <input type="text" placeholder="Preto" class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-sm text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-2">STOCK</label>
                            <input type="number" placeholder="100" class="w-full bg-[#0a0a0a] border border-zinc-800 p-3 text-sm text-white">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-rec-gold-600 hover:bg-rec-gold-500 text-black font-black py-4 uppercase tracking-[0.2em] transition-all">
                    GUARDAR ALTERAÇÕES
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
