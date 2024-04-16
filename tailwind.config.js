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
            },
        },
        // colors: {
        //     primary: '#38a37f', // Replace with your primary color
        //     secondary: '#7c9732', // Replace with your secondary color
        //     // Add more colors as needed
        // },
    },

    plugins: [forms],
    darkMode: 'class',
};
