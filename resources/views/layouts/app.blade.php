<!DOCTYPE html>
<html lang="pt" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>REC. PORTUGAL | TACTICAL GEAR</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- O Livewire e Alpine são injetados automaticamente pelo @vite no app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Scrollbar estilo "Command Center" */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #3f3f46; }
    </style>
</head>
<body class="h-full bg-tactical-dark text-tactical-text font-sans antialiased selection:bg-rec-gold-600 selection:text-black">

    {{-- Mensagem de Sucesso (Toast Automático) --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 3000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-20 right-6 z-[9999]">

            <div class="bg-tactical-surface border-l-4 border-rec-gold-600 text-white p-4 shadow-2xl flex items-center gap-3">
                <svg class="w-6 h-6 text-rec-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-bold uppercase tracking-widest text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <x-header />

    <main class="min-h-screen pt-20">
        {{ $slot }}
    </main>

    <x-footer />

</body>
</html>
