<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // Verifica se o carrinho existe e não está vazio
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->route('cart.index')->with('error', 'O seu carrinho está vazio.');
        }

        return view('livewire.shop.checkout');
    }

    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => ['required', 'regex:/^[0-9]{4}-[0-9]{3}$/'],
        ]);

        // 2. Segurança: Verifica se o carrinho ainda existe na sessão
        $cart = session('cart');
        if (!$cart || count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'O seu carrinho está vazio.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        try {
            // 3. Transação de Base de Dados
            DB::transaction(function () use ($request, $cart, $total) {
                $order = Order::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'street' => $request->street,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'total_price' => $total,
                    'status' => 'pending',
                ]);

                foreach ($cart as $id => $details) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        // Removemos o explode se o ID já for tratado,
                        // mantemos conforme o teu original caso o ID na sessão contenha o variant_id
                        'product_id' => explode('_', $id)[0],
                        'variant_id' => $details['variant_id'] ?? null,
                        'quantity' => $details['quantity'],
                        'price' => $details['price'],
                    ]);
                }
            });

            // 4. Limpeza e Redirecionamento
            session()->forget('cart');
            return redirect()->route('welcome')->with('success', 'Compra realizada com sucesso!');

        } catch (\Exception $e) {
            // Se algo falhar na base de dados, devolve o utilizador com uma mensagem de erro
            return back()->with('error', 'Ocorreu um erro ao processar a encomenda. Por favor, tente novamente.');
        }
    }
}
