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
                    light: '#c7d2fe',
                    DEFAULT: '#60a5fa',
                    deep: '#1e3a8a',
                },
                abyss: '#020617',
                midnight: '#0f172a',
                glacier: '#1f2937'
            },
            backgroundImage: {
                'aurora-wave': 'linear-gradient(135deg, rgba(8,20,44,0.95) 0%, rgba(96,165,250,0.4) 45%, rgba(30,64,175,0.35) 100%)',
                'aurora-accent': 'linear-gradient(120deg, rgba(96,165,250,0.9), rgba(59,130,246,0.85))'
            },
            dropShadow: {
                glow: '0 0 35px rgba(96,165,250,0.35)',
            },
            boxShadow: {
                glass: 'none',
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
