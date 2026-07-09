<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;

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
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

// Rotas de Autenticação
Volt::route('login', 'pages.auth.login')->name('login');
Volt::route('register', 'pages.auth.register')->name('register');
Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');
Volt::route('reset-password/{token}', 'pages.auth.password-reset')->name('password.reset');

// Rotas de Autenticação (Google)
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Logout
Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Rotas de Utilizador Comum (Protegidas)
Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Minhas Encomendas
    Route::get('/minhas-encomendas', [OrderController::class, 'myOrders'])->name('orders.index');

    // Checkout e Pagamento (Protegidos)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
});

// Rotas de Admin (Protegidas)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('products/create', CreateProduct::class)->name('admin.create-product');
    Route::get('products', ListProducts::class)->name('admin.products');
    Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
});

// Outros
Route::get('/limpar', function () { session()->forget('cart'); return "Carrinho limpo!"; });
Route::get('/faq', function () { return view('faq'); })->name('faq');
Route::get('/politicas', function () { return view('politicas'); })->name('politicas');
Route::get('/protocolos', function () { return view('protocolos'); })->name('protocolos');
// Adiciona isto ao teu routes/web.php
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
