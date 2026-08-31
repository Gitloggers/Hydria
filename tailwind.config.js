module.exports = {
  content: [
    "./api/**/*.php",
    "./api/*.php",
    "./*.php",
    "./*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#0A3D7C',
        'primary-dark': '#061327',
        accent: '#F15A24',
        'accent-hover': '#D84A19',
      },
      fontFamily: {
        display: ['Bebas Neue', 'sans-serif'],
        sans: ['Inter', 'sans-serif'],
      }
    },
  },
  plugins: [],
}

