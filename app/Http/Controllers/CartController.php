<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // MOSTRAR O CARRINHO
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('livewire.shop.cart', compact('cart'));
    }

    // ADICIONAR AO CARRINHO
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $variantId = $request->variant_id;

        // Chave única para evitar duplicados da mesma variante
        $cartKey = $product->id . '_' . $variantId;

        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'variant_id' => $variantId,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Adicionado ao arsenal!');
    }

    // ATUALIZAR QUANTIDADE
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Se o utilizador colocar 0 ou menos, removemos o item
            if ($request->quantity <= 0) {
                unset($cart[$id]);
            } else {
                // Caso contrário, atualizamos a quantidade
                $cart[$id]['quantity'] = $request->quantity;
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Quantidade atualizada!');
    }

    // REMOVER ITEM
    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removido!');
    }
}
