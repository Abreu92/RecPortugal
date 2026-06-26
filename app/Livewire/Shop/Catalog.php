<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] // Usamos o mesmo layout do admin
class Catalog extends Component
{
    public function render()
    {
        return view('livewire.shop.catalog', [
            'products' => Product::latest()->get()
        ]);
    }
}
