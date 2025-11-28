import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'roboto-condensed': ['"Roboto Condensed"', 'sans-serif'],
            },
            colors: {
                aurora: {
                    light: '#a5f3fc',
                    DEFAULT: '#22d3ee',
                    deep: '#0ea5e9',
                },
                abyss: '#020617',
                midnight: '#0f172a',
                glacier: '#1f2937'
            },
            backgroundImage: {
                'aurora-wave': 'linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(14,165,233,0.35) 40%, rgba(20,184,166,0.2) 100%)',
                'aurora-accent': 'linear-gradient(120deg, rgba(14,165,233,0.8), rgba(6,182,212,0.8))'
            },
            dropShadow: {
                glow: '0 0 35px rgba(94,234,212,0.55)',
            },
            boxShadow: {
                glass: '0 25px 65px rgba(2,6,23,0.55)',
            },
            objectPosition: {
                'right-30': '35% center',
                // Add more as needed
            }
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography'),
    ],
};
