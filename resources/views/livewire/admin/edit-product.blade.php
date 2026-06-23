<div class="py-12 bg-black min-h-screen text-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 p-4 md:p-8 rounded shadow-xl">

            <h1 class="text-xl font-bold border-l-4 border-yellow-600 pl-4 mb-6">
                EDITAR EQUIPAMENTO: {{ $name }}
            </h1>

            <form wire:submit="update" class="space-y-6">
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

                    <div class="space-y-4">
                        @foreach ($variants as $index => $variant)
                            <div class="flex flex-col md:grid md:grid-cols-12 gap-3 pb-4 border-b border-gray-800 relative">
                                <div class="md:col-span-5">
                                    <input type="text" wire:model="variants.{{$index}}.name" class="w-full bg-black border border-gray-700 p-2 rounded focus:border-yellow-600 text-sm">
                                </div>
                                <div class="md:col-span-3">
                                    <input type="number" wire:model="variants.{{$index}}.stock" class="w-full bg-black border border-gray-700 p-2 rounded focus:border-yellow-600 text-sm">
                                </div>
                                <div class="md:col-span-3">
                                    <input type="number" step="0.01" wire:model="variants.{{$index}}.price" class="w-full bg-black border border-gray-700 p-2 rounded focus:border-yellow-600 text-sm">
                                </div>
                                <button type="button" wire:click="removeVariant({{$index}})" class="text-red-500 font-bold">X</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-6 flex justify-center">
                    <button type="submit" class="w-full md:w-auto bg-yellow-600 hover:bg-yellow-500 text-black font-bold py-3 px-12 rounded shadow-lg transition">
                        Guardar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
