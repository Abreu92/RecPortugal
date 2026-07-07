<x-app-layout>
    <div class="py-12 bg-zinc-950 min-h-screen text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-extrabold text-white">Gestão de Encomendas</h1>
                <span class="text-sm text-zinc-500">{{ count($orders) }} encomendas totais</span>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-zinc-800/50 text-xs font-semibold uppercase tracking-wider text-zinc-400">
                        <tr>
                            <th class="p-5">Ref.</th>
                            <th class="p-5">Cliente</th>
                            <th class="p-5">Morada</th>
                            <th class="p-5">Items</th>
                            <th class="p-5 text-center">Estado</th>
                            <th class="p-5 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/60">
                        @foreach($orders as $order)
                        <tr class="hover:bg-zinc-800/30 transition-colors duration-200">
                            <td class="p-5 font-mono text-blue-400 font-medium">#{{ $order->id }}</td>

                            <td class="p-5">
                                <div class="font-bold text-zinc-100">{{ $order->name }}</div>
                                <div class="text-xs text-zinc-400 mt-0.5">{{ $order->email }}</div>
                                <div class="text-xs text-zinc-500">{{ $order->phone }}</div>
                            </td>

                            <td class="p-5 text-sm text-zinc-300">
                                <div class="leading-relaxed">
                                    {{ $order->street }}<br>
                                    {{ $order->city }}<br>
                                    <span class="font-medium text-zinc-100">{{ $order->postal_code }}</span>
                                </div>
                            </td>

                            <td class="p-5">
                                <ul class="text-sm space-y-1.5">
                                    @foreach($order->items as $item)
                                        <li class="flex justify-between items-center bg-zinc-950/50 px-2 py-1 rounded">
                                            <span class="text-zinc-300 text-xs">{{ $item->quantity }}x {{ $item->product->name ?? 'Prod. Removido' }}</span>
                                            <span class="text-zinc-500 text-xs font-mono">{{ number_format($item->price, 2) }}€</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            <td class="p-5 text-center">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="grid grid-cols-2 gap-2 w-48 mx-auto">
                                    @csrf

                                    @php
                                        // Definimos aqui as classes explícitas para o Tailwind reconhecer
                                        $states = [
                                            'pending' => ['label' => 'Pendente', 'active_classes' => 'bg-yellow-600 border-yellow-500'],
                                            'processing' => ['label' => 'Processar', 'active_classes' => 'bg-blue-600 border-blue-500'],
                                            'completed' => ['label' => 'Enviado', 'active_classes' => 'bg-green-600 border-green-500'],
                                            'cancelled' => ['label' => 'Cancelado', 'active_classes' => 'bg-red-600 border-red-500']
                                        ];
                                    @endphp

                                    @foreach($states as $value => $meta)
                                        <button type="submit" name="status" value="{{ $value }}"
                                            class="px-2 py-1.5 text-[10px] font-bold uppercase rounded border transition-all duration-200
                                            {{ $order->status === $value
                                                ? $meta['active_classes'] . ' text-white shadow-md ring-1 ring-white/20'
                                                : 'bg-zinc-800 border-zinc-700 text-zinc-500 hover:bg-zinc-700 hover:text-zinc-300' }}">
                                            {{ $meta['label'] }}
                                        </button>
                                    @endforeach
                                </form>
                            </td>

                            <td class="p-5 text-right font-bold text-lg text-emerald-400">
                                {{ number_format($order->total_price, 2) }}€
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
