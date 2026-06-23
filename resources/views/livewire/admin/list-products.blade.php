<div class="py-12 bg-black min-h-screen text-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold border-l-4 border-yellow-500 pl-4">Gestão de Stock</h2>
            <a href="{{ route('admin.create-product') }}" class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-lg transition duration-300">
                + Novo Produto
            </a>
        </div>

        <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg border border-gray-800">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-800 text-gray-300 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Imagem</th>
                        <th class="px-6 py-4">Nome</th>
                        <th class="px-6 py-4">Preço</th>
                        <th class="px-6 py-4 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-800 transition duration-150">
                            <td class="px-6 py-4">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" class="w-16 h-16 object-cover rounded-md border border-gray-700" alt="{{ $product->name }}">
                                @else
                                    <div class="w-16 h-16 bg-gray-800 rounded-md flex items-center justify-center text-gray-500 text-xs">Sem foto</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-yellow-500">{{ number_format($product->price, 2, ',', '.') }}€</td>
                            <td class="px-6 py-4 text-center space-x-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-400 hover:text-blue-300 font-bold">Editar</a>
                                <button wire:click="delete({{ $product->id }})" wire:confirm="Tens a certeza que queres eliminar este produto?" class="text-red-500 hover:text-red-400 font-bold">
                                    Apagar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">Nenhum produto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
