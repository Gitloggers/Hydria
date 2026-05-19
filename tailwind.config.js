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
        primary: '#0D1B4B',
        accent: '#C9A84C',
      },
      fontFamily: {
        display: ['Bebas Neue', 'sans-serif'],
        sans: ['Inter', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
