<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Lista todas as encomendas para o Painel de Administração.
     */
    public function index()
    {
        $orders = Order::with('items.product')->latest()->get();
        return view('livewire.admin.orders.index', compact('orders'));
    }

    /**
     * Atualiza o estado da encomenda (utilizado no painel de admin).
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status da encomenda atualizado com sucesso.');
    }

    /**
     * Lista as encomendas do utilizador logado (Painel do Cliente).
     */
    public function myOrders()
    {
        // Busca apenas as encomendas do utilizador que está autenticado
        $orders = Auth::user()->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }
}
