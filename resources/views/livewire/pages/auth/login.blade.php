<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // LÓGICA DE REDIRECIONAMENTO PERSONALIZADA
        if (auth()->user()->role === 'admin') {
            $this->redirect('/admin/dashboard', navigate: true);
        } else {
            $this->redirect('/dashboard', navigate: true);
        }
    }
}; ?>

<div class="min-h-[calc(100vh-150px)] w-full bg-tactical-green flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-tactical-surface border border-slate-800 border-t-4 border-t-rec-gold-600 p-8 shadow-2xl">

        <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-8">
            Iniciar <span class="text-rec-gold-600">Sessão</span>
        </h2>

        <form wire:submit="login" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email</label>
                <input type="email" wire:model="form.email" required autofocus
                       class="w-full bg-tactical-dark border border-slate-700 text-white p-3 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">
                @error('form.email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Password</label>
                <input type="password" wire:model="form.password" required
                       class="w-full bg-tactical-dark border border-slate-700 text-white p-3 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">
                @error('form.password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                    class="w-full py-4 bg-rec-gold-600 text-black font-black uppercase tracking-widest hover:bg-white transition-all duration-300">
                Aceder
            </button>
        </form>

        <p class="mt-6 text-center text-slate-500 text-sm">
            Sem conta? <a href="{{ route('register') }}" class="text-rec-gold-600 hover:underline">Regista-te já</a>
        </p>
    </div>
</div>
