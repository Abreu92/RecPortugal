<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.app')]
class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;
    public $name, $slug, $description, $price, $stock;
    public $variants = [];
    public $cover_image;
    public $existing_image;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->existing_image = $product->cover_image;
        $this->variants = $product->variants ? $product->variants->toArray() : [];
    }

    public function update()
    {
        // 1. Validação
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|max:1024', // 1MB Max
        ]);

        // 2. Lógica de Imagem
        $imagePath = $this->existing_image;
        if ($this->cover_image) {
            // Apaga a antiga se existir
            if ($this->existing_image) {
                Storage::delete($this->existing_image);
            }
            $imagePath = $this->cover_image->store('products', 'public');
        }

        // 3. Atualizar Produto
        $this->product->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'cover_image' => $imagePath,
        ]);

        // Feedback
        session()->flash('message', 'Produto atualizado com sucesso!');
        return redirect()->route('admin.products');
    }

    public function addVariant()
    {
        $this->variants[] = ['name' => '', 'price' => 0];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function render()
    {
        return view('livewire.admin.edit-product');
    }
}
