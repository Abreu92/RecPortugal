<header class="fixed top-0 w-full z-50 border-b border-tactical-surface/50 bg-tactical-dark/80 backdrop-blur-md">

    {{-- Formulário de Logout Invisível (Solução Segura) --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- Conteúdo do Header --}}
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="/" class="flex items-center group">
            <img src="{{ asset('images/iconSite.png') }}" alt="REC. Portugal Logo" class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>

        {{-- Navegação Desktop --}}
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('cart.index') }}" class="text-sm uppercase tracking-widest text-tactical-text hover:text-rec-gold-400 transition-colors">Carrinho</a>

            @guest
                <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-tactical-text hover:text-rec-gold-400 transition-colors">Entrar</a>
                <a href="{{ route('register') }}" class="px-4 py-2 border border-rec-gold-600 text-rec-gold-600 hover:bg-rec-gold-600 hover:text-black transition-all duration-300 text-sm font-bold uppercase tracking-widest">Registar</a>
            @else
                {{-- Botão Desktop com SweetAlert2 --}}
                <button type="button"
                        onclick="Swal.fire({
                            title: 'Terminar sessão?',
                            text: 'Estás prestes a sair da tua conta.',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#d97706',
                            cancelButtonColor: '#374151',
                            confirmButtonText: 'Sim, sair',
                            cancelButtonText: 'Cancelar',
                            background: '#111827',
                            color: '#ffffff'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('logout-form').submit();
                            }
                        })"
                        class="text-white hover:text-yellow-500 transition font-bold uppercase tracking-widest text-sm">
                    Sair
                </button>

                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                   class="text-rec-gold-600 hover:text-white transition-colors"
                   title="Perfil">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
            @endguest
        </nav>

        {{-- Botão Menu Mobile (Seguro) --}}
        <button onclick="const menu = document.getElementById('mobileMenu'); if(menu) { menu.classList.toggle('hidden'); }"
                class="md:hidden text-tactical-text focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </div>

    {{-- Menu Mobile --}}
    <div id="mobileMenu"
         class="hidden md:hidden bg-tactical-dark border-b border-tactical-surface p-6 space-y-4">
        <a href="{{ route('cart.index') }}" class="block text-tactical-text hover:text-rec-gold-400">Carrinho</a>
        @guest
            <a href="{{ route('login') }}" class="block text-rec-gold-600 font-bold">Entrar</a>
            <a href="{{ route('register') }}" class="block text-tactical-text">Registar</a>
        @else
            {{-- Botão Mobile com SweetAlert2 --}}
            <button type="button"
                    onclick="Swal.fire({
                        title: 'Terminar sessão?',
                        text: 'Estás prestes a sair da tua conta.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d97706',
                        cancelButtonColor: '#374151',
                        confirmButtonText: 'Sim, sair',
                        cancelButtonText: 'Cancelar',
                        background: '#111827',
                        color: '#ffffff'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    })"
                    class="block text-tactical-text hover:text-red-500 w-full text-left font-bold">
                Sair
            </button>

            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
               class="block text-rec-gold-600 font-bold">
                Perfil
            </a>
        @endguest
    </div>
</header>
