<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;

// Importação dos teus componentes Livewire
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\CreateProduct;
use App\Livewire\Admin\ListProducts;
use App\Livewire\Admin\EditProduct;

// Página Inicial
Route::view('/', 'welcome');

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

    // Rota da Lista (Corrigida: removido o ->layout que causava erro)
    Route::get('products', ListProducts::class)->name('admin.products');

    // Rota de Edição
    Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');

});
