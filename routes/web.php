<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Página Inicial
Route::view('/', 'welcome');

// Rotas de Administração de Produtos
// Nota: Adicionei o middleware 'auth' para garantir que só tu (logado) possas criar produtos.
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/produto/novo', [ProductController::class, 'create']);
    Route::post('/admin/produto/guardar', [ProductController::class, 'store'])->name('product.store');
});

// Rotas de Autenticação/Dashboard do Breeze
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
