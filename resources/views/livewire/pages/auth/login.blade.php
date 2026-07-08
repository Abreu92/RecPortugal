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

        // LÓGICA DE REDIRECIONAMENTO
        if (auth()->user()->role === 'admin') {
            $this->redirect('/admin/dashboard', navigate: true);
        } else {
            // Alterado para redirecionar para o carrinho para utilizadores comuns
            $this->redirect(route('cart.index'), navigate: true);
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
                <div class="relative">
                    <input type="password" id="passwordInput" wire:model="form.password" required
                           class="w-full bg-tactical-dark border border-slate-700 text-white p-3 pr-12 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">

                    {{-- Botão Olho --}}
                    <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition">
                        <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                @error('form.password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Abaixo do campo da password --}}
            <div class="flex justify-end mt-2">
                <a href="{{ route('password.request') }}" class="text-xs text-slate-500 hover:text-rec-gold-600 transition-colors uppercase font-bold tracking-widest">
                    Esqueceste a password?
                </a>
            </div>

            <button type="submit"
                    class="w-full py-4 bg-rec-gold-600 text-black font-black uppercase tracking-widest hover:bg-white transition-all duration-300">
                Aceder
            </button>
        </form>

        {{-- Divisor --}}
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-700"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase text-slate-500">
                <span class="bg-tactical-surface px-2">ou</span>
            </div>
        </div>

        {{-- Botão Google --}}
        <a href="{{ route('google.login') }}"
           class="w-full py-4 bg-white text-black font-black uppercase tracking-widest hover:bg-slate-200 transition-all duration-300 flex items-center justify-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-5 h-5 mr-3" alt="Google">
            Login com Google
        </a>

        <p class="mt-6 text-center text-slate-500 text-sm">
            Sem conta? <a href="{{ route('register') }}" class="text-rec-gold-600 hover:underline">Regista-te já</a>
        </p>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('eyeIcon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.add('text-rec-gold-600');
        } else {
            input.type = 'password';
            icon.classList.remove('text-rec-gold-600');
        }
    }
</script>
