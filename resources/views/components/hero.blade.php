<section x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
         class="relative min-h-[85vh] flex items-center justify-center overflow-hidden bg-black">

    <div class="absolute inset-0 pointer-events-none z-10 opacity-20 scanlines"></div>

    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat grayscale-[50%] contrast-125 brightness-60"
         style="background-image: url('{{ asset('images/fundo.png') }}');">
    </div>

    <div class="absolute inset-0 z-10 bg-gradient-to-t from-black via-black/70 to-transparent"></div>

    <div class="relative z-20 max-w-4xl px-6 text-center"
         x-show="show"
         x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 translate-y-10"
         x-transition:enter-end="opacity-0 translate-y-0">

        <h1 class="text-5xl md:text-7xl font-black text-white mb-8 uppercase tracking-tighter drop-shadow-2xl shadow-black">
            Equipamento <span class="text-rec-gold-600">Tático</span> de Elite
        </h1>

        <p class="text-lg md:text-xl text-gray-100 mb-12 leading-relaxed max-w-2xl mx-auto font-medium tracking-wide drop-shadow-md">
            A tecnologia que a tua missão exige. Rigor, durabilidade e precisão desenhadas para quem opera no limite.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/arsenal" class="w-full sm:w-auto px-10 py-4 bg-rec-gold-600 text-black font-bold uppercase tracking-widest hover:bg-white transition-all duration-300 shadow-[0_0_20px_rgba(202,138,4,0.4)]">
                Ver Arsenal
            </a>

            <a href="#sobre-nos" class="w-full sm:w-auto px-10 py-4 bg-transparent border-2 border-rec-gold-600 text-white font-bold uppercase tracking-widest hover:bg-rec-gold-600 hover:text-black transition-all duration-300 drop-shadow-md">
                Sobre Nós
            </a>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 animate-bounce cursor-pointer">
        <a href="#sobre-nos" class="text-white/70 hover:text-rec-gold-600 transition-colors duration-300 drop-shadow-md">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</section>
