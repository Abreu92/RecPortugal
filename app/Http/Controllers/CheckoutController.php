<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->route('cart.index')->with('error', 'O seu carrinho está vazio.');
        }

        return view('livewire.shop.checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => ['required', 'regex:/^[0-9]{4}-[0-9]{3}$/'],
        ]);

        $cart = session('cart');
        if (!$cart || count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'O seu carrinho está vazio.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        try {
            $order = DB::transaction(function () use ($request, $cart, $total) {
                $newOrder = Order::create([
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
                        'order_id' => $newOrder->id,
                        'product_id' => explode('_', $id)[0],
                        'variant_id' => $details['variant_id'] ?? null,
                        'quantity' => $details['quantity'],
                        'price' => $details['price'],
                    ]);
                }
                return $newOrder;
            });

            session()->forget('cart');

            return redirect()->route('checkout.payment', $order->id);

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar encomenda: ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        try {
            $order = Order::findOrFail($id);

            Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = PaymentIntent::create([
                'amount' => (int)($order->total_price * 100),
                'currency' => 'eur',
                'automatic_payment_methods' => ['enabled' => true],
                'metadata' => ['order_id' => $order->id],
            ]);

            return view('livewire.shop.payment', [
                'order' => $order,
                'clientSecret' => $paymentIntent->client_secret
            ]);

        } catch (\Exception $e) {
            dd("Erro ao carregar a página de pagamento: " . $e->getMessage());
        }
    }

    // ADICIONADO: Método para a página de sucesso
    public function success()
    {
        return view('livewire.shop.success');
    }
}
