<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On; // Importação necessária
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class ListProducts extends Component
{
    // Ouve o evento disparado pelo botão no Blade
    #[On('delete-product')]
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Remove a imagem se existir
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Remove variantes antes de apagar o produto
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
