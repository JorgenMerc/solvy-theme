/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./views/**/*.twig'],
  important: true,
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        lg: '0',
      },
    },
    extend: {
      fontFamily: {
        sans: ['Montserrat'],
        serif: ['Montserrat'],
        mono: ['Montserrat'],
        display: ['Montserrat'],
        body: ['Montserrat']
      },
      colors: {
        'background': '#EEEBE5',
        'ink_blue': '#5336AC',
        'pine_green': '#229297',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}

