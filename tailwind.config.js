/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./public/**/*.css",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'theme-dark-blue': '#181b33',
        'theme-blue': '#282d49',
        'light': '#2F90A3',
      },
    },
    fontSize: {
      sm: '0.8rem',
      base: '1rem',
      xl: '1.25rem',
      '2xl': '1.563rem',
      '3xl': '1.953rem',
      '4xl': '2.441rem',
      '5xl': '3.052rem',
    }
  },
  plugins: [],
}

