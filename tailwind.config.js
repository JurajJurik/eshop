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
                sans: [
                    'Figtree',
                    {
                        fontFeatureSettings: '"liga" 1, "kern" 1',
                        fontVariationSettings: '"wght" 600',
                        appearance: 'auto'
                    },
                    ...defaultTheme.fontFamily.sans
                ]
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'beige': '#ede8d0',
                'darkerBeige': '#c9c5b1'
            },
            fontSize: {
                '2xs': '0.6rem',
            },
        },
    },

    plugins: [forms],
};
