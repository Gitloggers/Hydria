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
        'ink': '#1A1D1F',
        'paper': '#F4F2EE',
        'slate-custom': '#D1D1CB',
        'link-blue': '#0047FF',
      },
      fontFamily: {
        display: ['Bebas Neue', 'sans-serif'],
        sans: ['Inter', 'sans-serif'],
        serif: ['Georgia', 'Times New Roman', 'serif'],
        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace'],
      }
    },
  },
  plugins: [],
}

