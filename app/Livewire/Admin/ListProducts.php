<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout; // Importação necessária para o Layout
use Illuminate\Support\Facades\Storage; // Importação necessária para o Storage

#[Layout('layouts.app')] // Define o layout aqui e resolve o MissingLayoutException
class ListProducts extends Component
{
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Remove a imagem se existir
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Remove variantes antes de apagar o produto para evitar erros de integridade
        $product->variants()->delete();

        // Remove o produto
        $product->delete();

        session()->flash('message', 'Produto eliminado com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin.list-products', [
            'products' => Product::latest()->get()
        ]);
    }
}
