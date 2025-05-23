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
