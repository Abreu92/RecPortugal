<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Product;          // ADICIONADO: Import do modelo Product
use App\Models\ProductVariant;   // ADICIONADO: Import do modelo ProductVariant

#[Layout('components.layouts.app')]
class CreateProduct extends Component
{
    use WithFileUploads;

    public $name, $slug, $description, $price, $stock, $cover_image;
    public $variants = [];

    public function mount() {
        $this->addVariant();
    }

    public function addVariant()
    {
        $this->variants[] = ['name' => '', 'stock' => '', 'price' => ''];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'variants.*.name' => 'required',
            'variants.*.stock' => 'required|numeric',
            'variants.*.price' => 'required|numeric',
        ]);

        $path = $this->cover_image ? $this->cover_image->store('products', 'public') : null;

        // Agora o 'Product' será reconhecido sem erros
        $product = Product::create([
            'name' => $this->name,
            'slug' => $this->slug ?: Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image_path' => $path,
            'is_active' => true,
        ]);

        foreach ($this->variants as $variant) {
            $product->variants()->create([
                'name' => $variant['name'],
                'stock' => $variant['stock'],
                'price' => $variant['price'],
            ]);
        }

        session()->flash('message', 'Equipamento e variantes guardados com sucesso!');
        $this->reset(['name', 'slug', 'description', 'price', 'stock', 'cover_image']);
        $this->variants = [];
        $this->addVariant();
    }

    public function render()
    {
        return view('livewire.admin.create-product');
    }
}
