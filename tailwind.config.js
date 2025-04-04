import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    corePlugins: {
        preflight: false,
    },
    prefix: 'tw-',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            'tablet': {'max' : '640px'},
            // => @media (min-width: 640px) { ... }
    
            'laptop': {'max' : '1024px'},
            // => @media (min-width: 1024px) { ... }
            'desktop': {'max' : '1280px'},
      // => @media (min-width: 1280px) { ... }
            },
    extend: {
        backgroundImage: {
            'background': "url('../public/css/images/body-bg.gif')",
        },
        colors: {
            backgroundColor: "#F0F0F0",
            stroke: "#BFBFBF",
            success: "#5EDA4A",
            warning: "#FFC300",
            danger: "#D74848",
            primary: "#FFC300",
            white: "#FDFDFD",
            black: "#010101"
        },
        },
        plugins: [forms],
    }


};
