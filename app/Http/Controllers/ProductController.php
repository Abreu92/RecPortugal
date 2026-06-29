<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importante: Importa o teu modelo aqui
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Este método já tinhas (para criar produtos)
    public function store(Request $request)
    {
        dd($request->all());
    }

    // ADICIONA ESTE MÉTODO ABAIXO
    // Este é o método que recebe o ID do produto e mostra a página
    public function show(Product $product)
    {
    // Adicionamos 'livewire.' no início do caminho
    return view('livewire.shop.show', compact('product'));
    }
}
