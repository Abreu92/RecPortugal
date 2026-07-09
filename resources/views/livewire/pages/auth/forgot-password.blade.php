<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component
{
    public string $email = '';

    public function sendResetLink(): void
    {
        $this->validate(['email' => ['required', 'email']]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __("Enviámos o link de recuperação para o teu email."));
        } else {
            $this->addError('email', __("Não conseguimos encontrar um utilizador com esse email."));
        }
    }
}; ?>

<div class="min-h-[calc(100vh-150px)] w-full bg-tactical-green flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-tactical-surface border border-slate-800 border-t-4 border-t-rec-gold-600 p-8 shadow-2xl">
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-4">Recuperar <span class="text-rec-gold-600">Acesso</span></h2>
        <p class="text-slate-400 text-sm mb-6">Esqueceste a tua palavra-passe? Sem problema. Diz-nos o teu email e enviamos um link para criares uma nova.</p>

        @if (session('status'))
            <div class="mb-4 text-green-500 font-bold text-sm">{{ session('status') }}</div>
        @endif

        <form wire:submit="sendResetLink" class="space-y-6">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email</label>
                <input type="email" wire:model="email" required class="w-full bg-tactical-dark border border-slate-700 text-white p-3 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full py-4 bg-rec-gold-600 text-black font-black uppercase tracking-widest hover:bg-white transition-all duration-300">
                Enviar Link
            </button>
        </form>
    </div>
</div>
