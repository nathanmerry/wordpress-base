module.exports = {
  purge: {
    mode: 'all',
    content: [
      './app/Resources/views/**/*.blade.php',
      './app/Resources/js/**/*.js',
      './app/Resources/css/**/*.scss',
    ]
  },
  darkMode: false,
  theme: {
    fontFamily: {
      header: ['"Mulish"', 'sans-serif'],
      body: ['"Source Sans Pro"', 'sans-serif'],
    },
    container: {
      center: true,
      padding: '1rem',
      screens: {
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1300px',
        '2xl': '1336px'
     }
    },
    maxWidth: {
      logo: '15rem',
      'container-sm': '1100px',
      'container-xs': '775px'
    },
    extend: {
      colors: {
        primary: 'var(--theme-primary)',
        secondary: 'var(--theme-secondary)',
        tertiary: 'var(--theme-tertiary)',
        dark: 'var(--theme-dark)',
        'img-bg': '#1b223e',
        social: '#5E24EF'
      },
      zIndex: {
        '-1': '-1',
       } 
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
