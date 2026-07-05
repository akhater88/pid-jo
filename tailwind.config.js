/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['var(--font-body)', 'Poppins', 'Inter', 'system-ui', 'sans-serif'],
        arabic: ['IBM Plex Sans Arabic', 'system-ui', 'sans-serif'],
        poppins: ['Poppins', 'system-ui', 'sans-serif'],
      },
      colors: {
        // Pesaro Brand Colors - Exact match from design
        primary: {
          DEFAULT: '#c09a5b', // Gold/Amber - Main brand color
          dark: '#a88447', // Hover state
          50: '#FAF7F2',
          100: '#F4EFE5',
          200: '#E9DFCB',
          300: '#DDCFB1',
          400: '#D2BF97',
          500: '#c09a5b', // Main
          600: '#A87F42',
          700: '#7E5F32',
          800: '#544021',
          900: '#2A2011',
        },
        secondary: {
          DEFAULT: '#333333', // Dark gray surface for cards
          lighter: '#3a3a3a',
          darker: '#2a2a2a',
        },
        dark: {
          DEFAULT: '#1a1a1a', // Primary dark background
          lighter: '#2a2a2a', // Section backgrounds
          darker: '#000000',
        },
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '104': '26rem', // 416px for hero padding
        '112': '28rem',
        '128': '32rem',
        '130': '32.5rem', // 520px for hero content spacing
      },
      maxWidth: {
        '8xl': '88rem',
        '9xl': '96rem',
        'hero': '1440px', // Container max-width from design
      },
      minHeight: {
        'hero': '747px', // Hero section minimum height
      },
      borderRadius: {
        'sm': '0.25rem',
        DEFAULT: '0.375rem',
        'md': '0.5rem',
        'lg': '0.75rem',
        'xl': '1rem',
        '2xl': '1.5rem',
        '3xl': '1.75rem',
        '34': '34px', // Button border radius
        '51': '51px', // Badge border radius
        '101': '101px', // Hero button radius
      },
      letterSpacing: {
        'tight-custom': '-0.21px',
      },
      keyframes: {
        bounce: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-10px)' },
        },
      },
      animation: {
        'bounce-slow': 'bounce 2s infinite',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
}
