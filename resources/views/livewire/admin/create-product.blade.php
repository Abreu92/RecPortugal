<div class="py-12 bg-black min-h-screen text-white"
     x-data
     @scroll-to-top.window="window.scrollTo({top: 0, behavior: 'smooth'});">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-gray-900 border border-gray-800 p-4 md:p-8 rounded shadow-xl">

            <div class="mb-8">
                <h1 class="text-xl font-bold border-l-4 border-yellow-600 pl-4 mb-6">
                    1. DETALHES DO NOVO EQUIPAMENTO
                </h1>

                @if (session()->has('message'))
                    <div class="p-4 bg-green-900/30 border border-green-700 text-green-400 rounded-lg flex items-center shadow-lg animate-pulse">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-bold">{{ session('message') }}</span>
                    </div>
                @endif
            </div>

            <form wire:submit="save" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">NOME DO ARTIGO</label>
                        <input type="text" wire:model="name" class="w-full bg-black border border-gray-700 p-3 rounded focus:border-yellow-600 focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">URL AMIGÁVEL (SLUG)</label>
                        <input type="text" wire:model="slug" class="w-full bg-black border border-gray-700 p-3 rounded focus:border-yellow-600 focus:ring-0">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">DESCRIÇÃO TÉCNICA</label>
                    <textarea wire:model="description" rows="4" class="w-full bg-black border border-gray-700 p-3 rounded focus:border-yellow-600 focus:ring-0"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">PREÇO BASE (€)</label>
                        <input type="number" step="0.01" wire:model="price" class="w-full bg-black border border-gray-700 p-3 rounded focus:border-yellow-600 focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">STOCK INICIAL</label>
                        <input type="number" wire:model="stock" class="w-full bg-black border border-gray-700 p-3 rounded focus:border-yellow-600 focus:ring-0">
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-800 pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <label class="text-xs font-bold text-gray-400 uppercase">VARIANTES</label>
                        <button type="button" wire:click="addVariant" class="bg-yellow-600 hover:bg-yellow-500 text-black text-xs font-bold py-2 px-4 rounded transition">
                            + ADICIONAR
                        </button>
                    </div>

                    <div class="hidden md:grid grid-cols-12 gap-4 mb-2 px-2 text-xs font-bold text-gray-400 uppercase">
                        <div class="col-span-5">Cor/Tamanho</div>
                        <div class="col-span-3">Stock</div>
                        <div class="col-span-3">Preço</div>
                    </div>

                    <div class="space-y-4">
                        @foreach ($variants as $index => $variant)
                            <div class="flex flex-col md:grid md:grid-cols-12 gap-3 bg-black p-3 rounded border border-gray-800 relative">
                                <div class="md:col-span-5">
                                    <label class="md:hidden text-[10px] text-gray-500 uppercase font-bold">Cor/Tamanho</label>
                                    <input type="text" wire:model="variants.{{$index}}.name" placeholder="Ex: XL" class="w-full bg-gray-900 border border-gray-700 p-2 rounded focus:border-yellow-600 text-sm">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="md:hidden text-[10px] text-gray-500 uppercase font-bold">Stock</label>
                                    <input type="number" wire:model="variants.{{$index}}.stock" placeholder="0" class="w-full bg-gray-900 border border-gray-700 p-2 rounded focus:border-yellow-600 text-sm">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="md:hidden text-[10px] text-gray-500 uppercase font-bold">Preço</label>
                                    <input type="number" wire:model="variants.{{$index}}.price" placeholder="0.00" class="w-full bg-gray-900 border border-gray-700 p-2 rounded focus:border-yellow-600 text-sm">
                                </div>
                                <button type="button" wire:click="removeVariant({{$index}})" class="absolute top-2 right-2 md:static md:col-span-1 text-red-500 hover:text-red-400 font-bold">
                                    X
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">FOTOGRAFIA</label>
                    <input type="file" wire:model="cover_image" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-yellow-600 file:text-black hover:file:bg-yellow-500 cursor-pointer">

                    @if ($cover_image)
                        <div class="mt-4">
                            <img src="{{ $cover_image->temporaryUrl() }}" class="h-32 w-32 object-cover border border-yellow-600 rounded">
                        </div>
                    @endif
                </div>

                <div class="pt-6 flex justify-center">
                    <button type="submit" class="w-full md:w-auto bg-yellow-600 hover:bg-yellow-500 text-black font-bold py-3 px-12 rounded shadow-lg transition duration-200">
                        Guardar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
