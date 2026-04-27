import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import containerQueries from '@tailwindcss/container-queries';

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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                outfit: ['Outfit', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ghooo: {
                    50: '#fdf8f5',
                    100: '#f8ede3',
                    200: '#eed5c2',
                    300: '#e0b698',
                    400: '#d09069',
                    500: '#c27142',
                    600: '#b55a35',
                    700: '#97452d',
                    800: '#7a3a29',
                    900: '#623223',
                    950: '#35170f',
                },
                accent: {
                    light: '#fbbf24',
                    DEFAULT: '#d97706',
                    dark: '#92400e',
                }
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'fade-in': 'fadeIn 1s ease-out forwards',
                'float': 'float 6s ease-in-out infinite',
                'blob': 'blob 7s infinite',
            },
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: 0, transform: 'translateY(30px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%': { opacity: 0 },
                    '100%': { opacity: 1 },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                blob: {
                    '0%': { transform: 'translate(0px, 0px) scale(1)' },
                    '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                    '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                    '100%': { transform: 'translate(0px, 0px) scale(1)' },
                }
            }
        },
    },
    plugins: [forms, containerQueries],
};
