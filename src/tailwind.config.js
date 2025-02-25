/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./views/**/*.twig'],
  important: false,
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
        sans: ['Inter'],
        serif: ['Inter'],
        mono: ['Inter'],
        display: ['Inter'],
        body: ['Inter']
      },
      colors: {
        'firm_bg': '#12181F',
        'firm_blue': '#2563EB'
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}

