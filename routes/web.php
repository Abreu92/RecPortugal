<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;
use App\Livewire\Admin\CreateProduct;

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
    Route::view('dashboard', 'admin.dashboard')->name('admin.dashboard');

    // Rota direta para o componente Livewire de criação de produtos
    // Não precisa de rota 'post' extra pois o Livewire gere o formulário via wire:submit
    Route::get('products', CreateProduct::class)->name('admin.products');

});
