import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import colors from 'tailwindcss/colors.js'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js'),
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",

        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
               sans: ['Nunito Sans', ...defaultTheme.fontFamily.sans],
                serif: ['Alexandria', ...defaultTheme.fontFamily.serif],
            },
            screens: {
                print: { raw: 'print' },
                screen: { raw: 'screen' },
            },
            colors: {
                primary: colors.emerald,
                secondary: colors.slate,
            },
        },
    },

    plugins: [forms, typography],
}
