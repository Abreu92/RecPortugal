<header x-data="{ mobileMenuOpen: false }"
        class="fixed top-0 w-full z-50 border-b border-tactical-surface/50 bg-tactical-dark/80 backdrop-blur-md">

    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <!-- LOGOTIPO -->
        <a href="/" class="flex items-center group">
            <img src="{{ asset('images/iconSite.png') }}"
                 alt="REC. Portugal Logo"
                 class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>

        <!-- NAVEGAÇÃO DESKTOP -->
        <nav class="hidden md:flex items-center space-x-8">
            <a href="#" class="text-sm uppercase tracking-widest text-tactical-text hover:text-rec-gold-400 transition-colors">Arsenal</a>
            <a href="#" class="text-sm uppercase tracking-widest text-tactical-text hover:text-rec-gold-400 transition-colors">Missões</a>
            <a href="#" class="text-sm uppercase tracking-widest text-tactical-text hover:text-rec-gold-400 transition-colors">Intel</a>

            <a href="#" class="px-4 py-2 bg-tactical-surface border border-rec-gold-600/30 text-rec-gold-600 hover:bg-rec-gold-600 hover:text-black transition-all duration-300 text-sm font-bold uppercase tracking-widest">
                Acesso
            </a>
        </nav>

        <!-- BOTÃO MOBILE (Hamburger) -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-tactical-text focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- MENU MOBILE (Dropdown) -->
    <div x-show="mobileMenuOpen"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-4"
     class="md:hidden bg-tactical-dark border-b border-tactical-surface p-6 space-y-4">

    <a href="#" class="block text-tactical-text hover:text-rec-gold-400 transition-colors">Arsenal</a>
    <a href="#" class="block text-tactical-text hover:text-rec-gold-400 transition-colors">Missões</a>
    <a href="#" class="block text-tactical-text hover:text-rec-gold-400 transition-colors">Intel</a>
    </div>
</header>
