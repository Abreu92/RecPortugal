<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component
{
    public string $token;
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $status = Password::reset(
            ['token' => $this->token, 'email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation],
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', __("Palavra-passe alterada com sucesso!"));
            $this->redirect('/login');
        } else {
            $this->addError('email', __("O link de reset é inválido ou expirou."));
        }
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-tactical-green p-6">
    <div class="w-full max-w-md bg-tactical-surface p-8 shadow-2xl">
        <h2 class="text-2xl font-black text-white mb-6">Nova Password</h2>

        <form wire:submit="resetPassword" class="space-y-4">
            <input type="hidden" wire:model="token">

            <div>
                <label class="text-xs text-slate-400">Email</label>
                <input type="email" wire:model="email" class="w-full bg-tactical-dark border border-slate-700 text-white p-2">
            </div>

            <div>
                <label class="text-xs text-slate-400">Nova Password</label>
                <input type="password" wire:model="password" class="w-full bg-tactical-dark border border-slate-700 text-white p-2">
            </div>

            <div>
                <label class="text-xs text-slate-400">Confirmar Password</label>
                <input type="password" wire:model="password_confirmation" class="w-full bg-tactical-dark border border-slate-700 text-white p-2">
            </div>

            <button type="submit" class="w-full py-3 bg-rec-gold-600 text-black font-black uppercase">
                Atualizar Password
            </button>
        </form>
    </div>
</div>
