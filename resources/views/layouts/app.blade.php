<!DOCTYPE html>
<html lang="pt" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REC. PORTUGAL | TACTICAL GEAR</title>

    {{-- Google Fonts: Importa o Inter e JetBrains Mono aqui se não estiverem no teu CSS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

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

    <x-header />

    <main class="min-h-screen pt-20">
        {{ $slot }}
    </main>

    <x-footer />

</body>
</html>
