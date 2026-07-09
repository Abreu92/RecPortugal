<!DOCTYPE html>
<html lang="pt" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="images/png" href="{{ asset('images/iconSite.png') }}">

    <title>REC. PORTUGAL | TACTICAL GEAR</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #3f3f46; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full bg-tactical-dark text-tactical-text font-sans antialiased selection:bg-rec-gold-600 selection:text-black">

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    {{-- Mensagem de Sucesso (Toast) --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 3000)"
             x-show="show"
             class="fixed top-20 right-6 z-[9999]">
            <div class="bg-tactical-surface border-l-4 border-rec-gold-600 text-white p-4 shadow-2xl flex items-center gap-3">
                <p class="font-bold uppercase tracking-widest text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <x-header />

    <main class="min-h-screen pt-20">
        {{ $slot }}
    </main>

    <x-footer />

    {{-- Script de Logout --}}
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Terminar sessão?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ca8a04',
                background: '#09090b',
                color: '#ffffff',
                customClass: { popup: 'max-w-md' }
            }).then((result) => {
                if (result.isConfirmed) { document.getElementById('logout-form').submit(); }
            });
        }
    </script>

    {{-- Ponto de Injeção de Scripts (Crucial para o Stripe) --}}
    @stack('scripts')
</body>
</html>
