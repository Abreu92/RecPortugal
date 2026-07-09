<x-layouts.app>
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <h2 class="text-3xl font-bold text-white uppercase tracking-widest mb-8 text-center border-b border-gray-800 pb-4">
                Finalizar <span class="text-rec-gold-600">Pagamento</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="bg-tactical-surface p-8 rounded border border-gray-800 shadow-2xl h-fit">
                    <h3 class="text-rec-gold-600 font-bold mb-6 uppercase tracking-wider text-lg">Resumo da Encomenda</h3>
                    <div class="space-y-4 text-white">
                        <div class="flex justify-between border-b border-gray-800 pb-2">
                            <span>Referência</span>
                            <span class="font-mono text-gray-400">#{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between text-2xl pt-4">
                            <span class="font-bold">Total</span>
                            <span class="text-rec-gold-600 font-bold">{{ number_format($order->total_price, 2) }} €</span>
                        </div>
                    </div>
                </div>

                <div class="bg-tactical-surface p-8 rounded border border-gray-800 shadow-2xl">
                    <form id="payment-form" class="space-y-6">
                        <div id="payment-element" class="bg-tactical-dark p-2 rounded">
                            </div>

                        <button id="submit" class="w-full bg-rec-gold-600 text-black font-bold py-4 rounded uppercase hover:bg-rec-gold-500 transition duration-300 flex justify-center items-center gap-2">
                            <span id="button-text">Pagar Agora</span>
                        </button>

                        <div id="payment-message" class="hidden mt-4 text-red-500 text-sm text-center font-bold"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe("{{ config('services.stripe.key') }}");

            // Estilização do Stripe
            const appearance = {
                theme: 'night',
                variables: {
                    colorPrimary: '#ca8a04',
                    colorBackground: '#09090b',
                    colorText: '#ffffff',
                    fontFamily: 'Inter, sans-serif',
                },
            };

            const elements = stripe.elements({ appearance, clientSecret: "{{ $clientSecret }}" });
            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");

            // Submissão
            const form = document.getElementById("payment-form");
            form.addEventListener("submit", async (e) => {
                e.preventDefault();
                const btn = document.getElementById("submit");
                btn.disabled = true;
                btn.innerText = "A processar...";

                const { error } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: "{{ route('checkout.success') }}",
                    },
                });

                if (error) {
                    const message = document.getElementById("payment-message");
                    message.classList.remove('hidden');
                    message.innerText = error.message;
                    btn.disabled = false;
                    btn.innerText = "Pagar Agora";
                }
            });
        </script>
    @endpush
</x-layouts.app>
