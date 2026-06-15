<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Mostrar o formulário de criação
    public function create()
    {
        return view('admin.create-product');
    }

    // 2. Guardar o produto na base de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->back()->with('success', 'Produto registado na missão.');
    }
}
