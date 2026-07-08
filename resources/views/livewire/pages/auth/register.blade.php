<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    // Estados para controlar a visibilidade
    public bool $showPassword = false;
    public bool $showConfirm = false;

    #[Computed]
    public function passwordStrength(): int
    {
        if (empty($this->password)) return 0;
        $strength = 0;
        if (strlen($this->password) >= 8) $strength++;
        if (preg_match('/[A-Z]/', $this->password)) $strength++;
        if (preg_match('/[0-9]/', $this->password)) $strength++;
        if (preg_match('/[^A-Za-z0-9]/', $this->password)) $strength++;
        return $strength;
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        // Mensagem de sucesso
        session()->flash('success', 'Conta criada com sucesso! Bem-vindo.');

        if ($user->role === 'admin') {
            $this->redirect('/admin/dashboard', navigate: true);
        } else {
            $this->redirect('/', navigate: true);
        }
    }
}; ?>

<div class="min-h-[calc(100vh-150px)] w-full bg-tactical-green flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-tactical-surface border border-slate-800 border-t-4 border-t-rec-gold-600 p-8 shadow-2xl">

        <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-8">
            Registar <span class="text-rec-gold-600">Conta</span>
        </h2>

        <form wire:submit="register" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nome Completo</label>
                <input type="text" wire:model="name" required class="w-full bg-tactical-dark border border-slate-700 text-white p-3 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email</label>
                <input type="email" wire:model="email" required class="w-full bg-tactical-dark border border-slate-700 text-white p-3 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Password</label>
                <div class="relative">
                    <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model.live="password" required
                           class="w-full bg-tactical-dark border border-slate-700 text-white p-3 pr-10 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">

                    <button type="button" wire:click="$toggle('showPassword')" class="absolute right-3 top-0 h-full flex items-center text-slate-500 hover:text-rec-gold-600 transition-colors">
                        @if($showPassword)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        @endif
                    </button>
                </div>
                @if($password)
                    <div class="mt-2 flex gap-1 h-1">
                        <div class="flex-1 h-full {{ $this->passwordStrength >= 1 ? 'bg-red-500' : 'bg-slate-800' }}"></div>
                        <div class="flex-1 h-full {{ $this->passwordStrength >= 2 ? 'bg-orange-500' : 'bg-slate-800' }}"></div>
                        <div class="flex-1 h-full {{ $this->passwordStrength >= 3 ? 'bg-yellow-500' : 'bg-slate-800' }}"></div>
                        <div class="flex-1 h-full {{ $this->passwordStrength >= 4 ? 'bg-green-500' : 'bg-slate-800' }}"></div>
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Confirmar Password</label>
                <div class="relative">
                    <input type="{{ $showConfirm ? 'text' : 'password' }}" wire:model.live="password_confirmation" required
                           class="w-full bg-tactical-dark border border-slate-700 text-white p-3 pr-10 focus:border-rec-gold-600 focus:ring-1 focus:ring-rec-gold-600 transition-all">

                    <button type="button" wire:click="$toggle('showConfirm')" class="absolute right-3 top-0 h-full flex items-center text-slate-500 hover:text-rec-gold-600 transition-colors">
                        @if($showConfirm)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        @endif
                    </button>
                </div>
                @if($password && $password_confirmation && $password !== $password_confirmation)
                    <p class="text-red-500 text-[10px] mt-1 uppercase font-bold tracking-widest">As palavras-passe não coincidem.</p>
                @endif
            </div>

            <button type="submit" class="w-full py-4 bg-rec-gold-600 text-black font-black uppercase tracking-widest hover:bg-white transition-all duration-300">
                Registar
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
            Registar com Google
        </a>

        <p class="mt-6 text-center text-slate-500 text-sm">
            Já tens conta? <a href="{{ route('login') }}" class="text-rec-gold-600 hover:underline">Entra aqui</a>
        </p>
    </div>
</div>
