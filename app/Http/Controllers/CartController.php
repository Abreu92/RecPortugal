<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // Valida se o produto foi enviado
        $request->validate([
            'product_id' => 'required',
            'variant_id' => 'required',
        ]);

        // Recupera o carrinho atual da sessão (ou cria um vazio se não existir)
        $cart = session()->get('cart', []);

        // Adiciona o novo item ao carrinho
        $cart[] = [
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
        ];

        // Guarda o carrinho de volta na sessão
        session()->put('cart', $cart);

        // Retorna para a página anterior com uma mensagem de sucesso
        return back()->with('success', 'Item adicionado ao arsenal com sucesso!');
    }
}
