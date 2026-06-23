<div class="max-w-7xl mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold text-white mb-6">Lista de Produtos</h2>

    {{-- Mensagem de Sucesso --}}
    @if (session()->has('message'))
        <div class="bg-green-600 text-white p-4 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-tactical-dark border border-tactical-surface overflow-hidden shadow-sm sm:rounded-lg">
        <table class="w-full text-left text-tactical-text">
            <thead class="bg-black/30">
                <tr>
                    <th class="p-4">Nome</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Preço</th>
                    <th class="p-4">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-tactical-surface">
                @foreach($products as $product)
                    <tr>
                        <td class="p-4">{{ $product->name }}</td>
                        <td class="p-4">{{ $product->stock }}</td>
                        <td class="p-4">{{ $product->price }} €</td>
                        <td class="p-4 flex space-x-2">

                            {{-- Link Editar --}}
                            <a href="{{ route('admin.edit-product', $product->id) }}"
                               class="text-blue-500 hover:text-blue-300 font-bold">
                                Editar
                            </a>

                            {{-- Botão Eliminar com Confirmação --}}
                            <button wire:click="deleteProduct({{ $product->id }})"
                                    wire:confirm="Tens a certeza que queres eliminar este produto?"
                                    class="text-red-500 hover:text-red-300 font-bold">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
