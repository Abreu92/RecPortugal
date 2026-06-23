<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
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

        // CORREÇÃO: Usamos ->get() ou garantimos que a relação retorna uma collection
        // Se a relação estiver bem definida no modelo, isto funcionará
        $this->variants = $product->variants ? $product->variants->toArray() : [];
    }

    // ... (restante do código: addVariant, removeVariant, update, render)
}
