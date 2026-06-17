<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Por agora, só um teste para ver se funciona
        dd($request->all());
    }
}
