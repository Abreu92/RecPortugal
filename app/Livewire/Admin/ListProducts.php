<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Layout; // 1. Importa isto

#[Layout('layouts.app')] // 2. Define o layout aqui em cima
class ListProducts extends Component
{
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            session()->flash('message', 'Produto eliminado com sucesso!');
        }
    }

    public function render()
    {
    // Usa ->latest() para que o novo produto apareça sempre no topo
    $products = \App\Models\Product::latest()->get();

    return view('livewire.admin.list-products', [
        'products' => $products
    ]);
    }
}
