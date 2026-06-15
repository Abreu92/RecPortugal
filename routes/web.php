<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;

// Página Inicial
Route::view('/', 'welcome');

// Rotas de Autenticação (Uso correto de Volt::route)
// O segundo argumento é o caminho da view dentro de resources/views/livewire/
Volt::route('login', 'pages.auth.login')->name('login');
Volt::route('register', 'pages.auth.register')->name('register');

// Logout (Definimos o nome 'logout' explicitamente)
Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Dashboard (Protegido)
Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
