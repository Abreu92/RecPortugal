<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Importação dos componentes Admin
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\CreateProduct;
use App\Livewire\Admin\ListProducts;
use App\Livewire\Admin\EditProduct;

// Importação dos componentes de Loja
use App\Livewire\Shop\Catalog;

// Página Inicial
Route::view('/', 'welcome');

// Rota da Loja (Pública)
Route::get('/shop', Catalog::class)->name('shop');

// Rota de Detalhes do Produto
Route::get('/produto/{product}', [ProductController::class, 'show'])->name('product.show');

// ROTAS DO CARRINHO
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update'); // <--- A ROTA QUE FALTAVA

// Rotas de Autenticação
Volt::route('login', 'pages.auth.login')->name('login');
Volt::route('register', 'pages.auth.register')->name('register');

// Logout
Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Rotas de Utilizador Comum
Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Rotas de Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard do Admin
    Route::get('dashboard', Dashboard::class)->name('admin.dashboard');

    // Rotas de Gestão de Produtos
    Route::get('products/create', CreateProduct::class)->name('admin.create-product');

    // Rota da Lista
    Route::get('products', ListProducts::class)->name('admin.products');

    // Rota de Edição
    Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');

});

// Rota para limpar o carrinho (útil para debug)
Route::get('/limpar', function () {
    session()->forget('cart');
    return "Carrinho limpo com sucesso!";
});

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/politicas', function () {
    return view('politicas');
})->name('politicas');

Route::get('/protocolos', function () {
    return view('protocolos');
})->name('protocolos');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
