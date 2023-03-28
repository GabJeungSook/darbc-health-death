const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
        montserrat: ['Montserrat', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        danger: colors.rose,
        primary: colors.blue,
        success: colors.green,
        warning: colors.yellow,
        sidebar: '#220068',
      },
    },
  },

  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
