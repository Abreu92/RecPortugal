<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
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
        $this->variants[] = ['name' => '', 'stock' => 0, 'price' => 0];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function save()
    {
        // 1. Validação
        $this->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'variants.*.name' => 'required',
            'variants.*.stock' => 'required|numeric',
            'variants.*.price' => 'required|numeric',
        ]);

        // 2. Lógica de Gravação (Substitui com o teu Modelo)
        // Exemplo:
        /*
        $path = $this->cover_image ? $this->cover_image->store('products', 'public') : null;

        $product = Product::create([
            'name' => $this->name,
            'slug' => $this->slug ?: Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $path,
        ]);

        foreach ($this->variants as $variant) {
            $product->variants()->create($variant);
        }
        */

        // 3. Feedback de sucesso
        session()->flash('message', 'Equipamento e variantes guardados com sucesso!');

        $this->dispatch('scroll-to-top');

        // 4. Reset do formulário
        $this->reset(['name', 'slug', 'description', 'price', 'stock', 'cover_image']);

        // 5. Reiniciar as variantes para o estado inicial
        $this->variants = [];
        $this->addVariant();
    }

    public function render()
    {
        return view('livewire.admin.create-product');
    }
}
