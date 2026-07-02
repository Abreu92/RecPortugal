<div class="py-12 bg-black min-h-screen text-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-6 px-4">
            <h2 class="text-2xl font-bold border-l-4 border-yellow-500 pl-4">Gestão de Stock</h2>
        </div>

        {{-- Container com scroll horizontal para telemóveis --}}
        <div class="bg-gray-900 shadow-xl border border-gray-800 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-800 text-gray-300 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-5 whitespace-nowrap">Imagem</th>
                        <th class="px-6 py-5 whitespace-nowrap">Nome</th>
                        <th class="px-6 py-5 whitespace-nowrap">Preço</th>
                        <th class="px-6 py-5 text-center whitespace-nowrap">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-800 transition duration-150">
                            {{-- Aumentei a altura do padding (py-5) --}}
                            <td class="px-6 py-5 align-middle">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" class="w-14 h-14 object-cover rounded-md border border-gray-700" alt="{{ $product->name }}">
                                @else
                                    <div class="w-14 h-14 bg-gray-800 rounded-md flex items-center justify-center text-gray-500 text-xs">Sem foto</div>
                                @endif
                            </td>
                            <td class="px-6 py-5 align-middle font-medium text-base">{{ $product->name }}</td>
                            <td class="px-6 py-5 align-middle text-yellow-500 font-semibold whitespace-nowrap text-base">{{ number_format($product->price, 2, ',', '.') }}€</td>
                            <td class="px-6 py-5 align-middle text-center space-x-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-400 hover:text-blue-300 font-bold transition">Editar</a>

                        <button type="button"
                            onclick="Swal.fire({
                                title: 'Tens a certeza?',
                                text: 'Esta ação não poderá ser revertida!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#dc2626',
                                confirmButtonText: 'Sim, eliminar!',
                                cancelButtonText: 'Cancelar',
                                // ... restantes configurações ...
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // USAR DISPATCH AQUI
                                    Livewire.dispatch('delete-product', { id: {{ $product->id }} });
                                }
                            })"
                            class="text-red-500 hover:text-red-400 font-bold transition">
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
