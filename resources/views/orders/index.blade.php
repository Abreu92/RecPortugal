<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-end mb-6">
                <h1 class="text-2xl font-bold text-white border-l-4 border-yellow-600 pl-4">As Minhas Encomendas</h1>
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition">← Voltar ao início</a>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800/50 text-gray-400 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-6">Referência</th>
                            <th class="p-6">Data</th>
                            <th class="p-6">Estado</th>
                            <th class="p-6 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-800/30 transition-colors">
                                <td class="p-6 font-mono font-bold text-yellow-600">#{{ $order->id }}</td>
                                <td class="p-6 text-gray-300">{{ $order->created_at->format('d M, Y') }}</td>
                                <td class="p-6">
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full
                                        {{ $order->status == 'completed' ? 'bg-green-900/50 text-green-400 border border-green-800' :
                                           ($order->status == 'pending' ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-800' : 'bg-blue-900/50 text-blue-400 border border-blue-800') }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-6 text-right font-bold text-white">{{ number_format($order->total_price, 2) }}€</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <span class="text-4xl mb-4">🛒</span>
                                        <p>Ainda não tens encomendas realizadas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
