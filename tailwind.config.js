import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                // Background principal (fundo de página)
                'tactical-dark': '#09090b',
                // Background de componentes (cards, painéis)
                'tactical-surface': '#18181b',
                // Cor "Verde Tropa" para fundos específicos
                'tactical-green': '#1b261b',
                // O "Dourado" para CTAs e estados ativos
                'rec-gold': {
                    400: '#d4b069',
                    600: '#C5A059',
                },
                // Texto de alto contraste
                'tactical-text': '#f4f4f5',
                'tactical-muted': '#a1a1aa',
            },
            fontFamily: {
                // Sans para textos longos, Mono para dados e IDs
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', 'monospace'],
            },
        },
    },
    plugins: [forms],
};
