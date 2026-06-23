<div class="py-12 bg-black min-h-screen text-white"
     x-data
     @scroll-to-top.window="window.scrollTo({top: 0, behavior: 'smooth'});">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 p-4 md:p-8 rounded shadow-xl">

            <h1 class="text-xl font-bold border-l-4 border-yellow-600 pl-4 mb-6">
                1. DETALHES DO NOVO EQUIPAMENTO
            </h1>

            {{-- Mensagens de Sucesso --}}
            @if (session()->has('message'))
                <div class="p-4 mb-6 bg-green-900/30 border border-green-700 text-green-400 rounded-lg flex items-center shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('message') }}
                </div>
            @endif

            {{-- Formulário --}}
            <form wire:submit="save" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">NOME DO ARTIGO</label>
                        <input type="text" wire:model="name" class="w-full bg-black border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-700' }} p-3 rounded focus:border-yellow-600 focus:ring-0">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
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
                        <input type="number" step="0.01" wire:model="price" class="w-full bg-black border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-700' }} p-3 rounded focus:border-yellow-600 focus:ring-0">
                        @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">STOCK INICIAL</label>
                        <input type="number" wire:model="stock" class="w-full bg-black border {{ $errors->has('stock') ? 'border-red-500' : 'border-gray-700' }} p-3 rounded focus:border-yellow-600 focus:ring-0">
                        @error('stock') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Variantes --}}
                <div class="mt-8 border-t border-gray-800 pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <label class="text-xs font-bold text-gray-400 uppercase">VARIANTES</label>
                        <button type="button" wire:click="addVariant" class="bg-yellow-600 hover:bg-yellow-500 text-black text-xs font-bold py-2 px-4 rounded transition">
                            + ADICIONAR
                        </button>
                    </div>

                    <div class="space-y-4">
                        @foreach ($variants as $index => $variant)
                            <div class="flex flex-col md:grid md:grid-cols-12 gap-3 pb-4 border-b border-gray-800 relative">
                                <div class="md:col-span-5">
                                    <input type="text" wire:model="variants.{{$index}}.name" placeholder="Ex: XL" class="w-full bg-black border border-gray-700 p-2 rounded text-sm focus:border-yellow-600 focus:ring-0">
                                    @error("variants.$index.name") <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-3">
                                    <input type="number" wire:model="variants.{{$index}}.stock" placeholder="Stock" class="w-full bg-black border border-gray-700 p-2 rounded text-sm focus:border-yellow-600 focus:ring-0">
                                </div>
                                <div class="md:col-span-3">
                                    <input type="number" step="0.01" wire:model="variants.{{$index}}.price" placeholder="Preço" class="w-full bg-black border border-gray-700 p-2 rounded text-sm focus:border-yellow-600 focus:ring-0">
                                </div>
                                <button type="button" wire:click="removeVariant({{$index}})" class="text-red-500 hover:text-red-400 font-bold">X</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Imagem --}}
                <div class="mt-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">FOTOGRAFIA</label>
                    <input type="file" wire:model="cover_image" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:bg-yellow-600 file:text-black file:cursor-pointer">
                    @if ($cover_image)
                        <img src="{{ $cover_image->temporaryUrl() }}" class="mt-4 h-32 w-32 object-cover border border-yellow-600 rounded">
                    @endif
                </div>

                {{-- Botão Guardar --}}
                <div class="pt-6 flex justify-center">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full md:w-auto bg-yellow-600 hover:bg-yellow-500 disabled:opacity-50 text-black font-bold py-3 px-12 rounded shadow-lg transition duration-200">
                        <span wire:loading.remove>Guardar Produto</span>
                        <span wire:loading>A Guardar...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
