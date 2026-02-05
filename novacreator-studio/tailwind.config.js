/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./assets/js/**/*.js"
  ],
  safelist: [
    { pattern: /^font-(radio|serif|geist)$/ }
  ],
  theme: {
    extend: {
      // ============================================
      // ЦВЕТОВАЯ СИСТЕМА (Design Tokens)
      // ============================================
      colors: {
        // Неоновые акцентные цвета с полной палитрой
        neon: {
          purple: {
            DEFAULT: '#8B5CF6',
            light: '#A78BFA',
            dark: '#6D28D9',
            darker: '#5B21B6',
            glow: 'rgba(139, 92, 246, 0.5)',
            glowLight: 'rgba(139, 92, 246, 0.3)',
            glowDark: 'rgba(139, 92, 246, 0.7)',
          },
          blue: {
            DEFAULT: '#06B6D4',
            light: '#22D3EE',
            dark: '#0891B2',
            darker: '#0E7490',
            glow: 'rgba(6, 182, 212, 0.5)',
            glowLight: 'rgba(6, 182, 212, 0.3)',
            glowDark: 'rgba(6, 182, 212, 0.7)',
          },
        },
        // Темная палитра с градациями (использует CSS переменные)
        dark: {
          bg: {
            DEFAULT: 'var(--color-bg)',
            lighter: 'var(--color-bg-lighter)',
            lightest: '#14141A',
          },
          surface: {
            DEFAULT: 'var(--color-surface)',
            lighter: 'var(--color-surface-lighter)',
            lightest: '#1B1B28',
            hover: '#1A1A24',
          },
          border: {
            DEFAULT: 'var(--color-border)',
            lighter: 'var(--color-border-lighter)',
            lightest: '#35354A',
            hover: '#3A3A50',
          },
        },
        // Семантические цвета
        semantic: {
          success: '#10B981',
          error: '#EF4444',
          warning: '#F59E0B',
          info: '#3B82F6',
        },
        // Градации серого для текста
        gray: {
          50: '#F9FAFB',
          100: '#F3F4F6',
          200: '#E5E7EB',
          300: '#D1D5DB',
          400: '#9CA3AF',
          500: '#6B7280',
          600: '#4B5563',
          700: '#374151',
          800: '#1F2937',
          900: '#111827',
        },
      },
      
      // ============================================
      // ТИПОГРАФИКА (Figma: Radio Canada Big, Source Serif 4, Geist Mono)
      // ============================================
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
        display: ['Inter', 'system-ui', 'sans-serif'],
        radio: ['"Radio Canada Big"', 'sans-serif'],
        serif: ['"Source Serif 4"', 'serif'],
        geist: ['"Geist Mono"', 'monospace'],
      },
      fontSize: {
        // Единая типографическая шкала
        'xs': ['0.75rem', { lineHeight: '1.5', letterSpacing: '0.05em' }],
        'sm': ['0.875rem', { lineHeight: '1.5', letterSpacing: '0.025em' }],
        'base': ['1rem', { lineHeight: '1.6', letterSpacing: '0' }],
        'lg': ['1.125rem', { lineHeight: '1.6', letterSpacing: '0' }],
        'xl': ['1.25rem', { lineHeight: '1.6', letterSpacing: '-0.025em' }],
        '2xl': ['1.5rem', { lineHeight: '1.5', letterSpacing: '-0.025em' }],
        '3xl': ['1.875rem', { lineHeight: '1.4', letterSpacing: '-0.05em' }],
        '4xl': ['2.25rem', { lineHeight: '1.3', letterSpacing: '-0.05em' }],
        '5xl': ['3rem', { lineHeight: '1.2', letterSpacing: '-0.05em' }],
        '6xl': ['3.75rem', { lineHeight: '1.1', letterSpacing: '-0.05em' }],
        '7xl': ['4.5rem', { lineHeight: '1.1', letterSpacing: '-0.05em' }],
        '8xl': ['6rem', { lineHeight: '1', letterSpacing: '-0.05em' }],
      },
      fontWeight: {
        light: '300',
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
        extrabold: '800',
        black: '900',
      },
      
      // ============================================
      // SPACING SYSTEM (8px базовая единица)
      // ============================================
      spacing: {
        '0.5': '0.125rem',   // 2px
        '1': '0.25rem',      // 4px
        '1.5': '0.375rem',   // 6px
        '2': '0.5rem',       // 8px
        '2.5': '0.625rem',   // 10px
        '3': '0.75rem',      // 12px
        '3.5': '0.875rem',   // 14px
        '4': '1rem',         // 16px
        '5': '1.25rem',      // 20px
        '6': '1.5rem',       // 24px
        '7': '1.75rem',      // 28px
        '8': '2rem',         // 32px
        '9': '2.25rem',      // 36px
        '10': '2.5rem',       // 40px
        '11': '2.75rem',      // 44px
        '12': '3rem',        // 48px
        '14': '3.5rem',      // 56px
        '16': '4rem',        // 64px
        '20': '5rem',        // 80px
        '24': '6rem',        // 96px
        '28': '7rem',        // 112px
        '32': '8rem',        // 128px
      },
      
      // ============================================
      // BORDER RADIUS (единая система)
      // ============================================
      borderRadius: {
        'none': '0',
        'sm': '0.375rem',    // 6px
        'DEFAULT': '0.5rem',  // 8px
        'md': '0.625rem',     // 10px
        'lg': '0.75rem',      // 12px
        'xl': '1rem',        // 16px
        '2xl': '1.25rem',    // 20px
        '3xl': '1.5rem',     // 24px
        'full': '9999px',
      },
      
      // ============================================
      // SHADOWS (единая система теней)
      // ============================================
      boxShadow: {
        'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.3)',
        'DEFAULT': '0 2px 4px 0 rgba(0, 0, 0, 0.4)',
        'md': '0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.3)',
        'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.4)',
        'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.6), 0 10px 10px -5px rgba(0, 0, 0, 0.4)',
        '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.7)',
        'inner': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.3)',
        // Неоновые тени
        'neon-purple': '0 0 20px rgba(139, 92, 246, 0.5), 0 0 40px rgba(139, 92, 246, 0.3)',
        'neon-blue': '0 0 20px rgba(6, 182, 212, 0.5), 0 0 40px rgba(6, 182, 212, 0.3)',
        'neon-purple-lg': '0 0 30px rgba(139, 92, 246, 0.4), 0 0 60px rgba(139, 92, 246, 0.2)',
        'neon-blue-lg': '0 0 30px rgba(6, 182, 212, 0.4), 0 0 60px rgba(6, 182, 212, 0.2)',
      },
      
      // ============================================
      // АНИМАЦИИ И ПЕРЕХОДЫ
      // ============================================
      transitionDuration: {
        '0': '0ms',
        '75': '75ms',
        '100': '100ms',
        '150': '150ms',
        '200': '200ms',
        '250': '250ms',
        '300': '300ms',
        '350': '350ms',
        '400': '400ms',
        '500': '500ms',
        '600': '600ms',
        '700': '700ms',
        '800': '800ms',
        '900': '900ms',
        '1000': '1000ms',
      },
      transitionTimingFunction: {
        'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
        'bounce-in': 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
        'bounce-out': 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
      },
      animation: {
        'fade-in': 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
        'fade-in-slow': 'fadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1)',
        'slide-up': 'slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
        'slide-up-slow': 'slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1)',
        'slide-down': 'slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
        'scale-in': 'scaleIn 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
        'glow': 'glow 2s ease-in-out infinite alternate',
        'glow-pulse': 'glowPulse 2s ease-in-out infinite',
        'float': 'float 6s ease-in-out infinite',
        'fade-left': 'fadeInLeft 0.8s cubic-bezier(0.25, 0.1, 0.25, 1) forwards',
        'fade-right': 'fadeInRight 0.8s cubic-bezier(0.25, 0.1, 0.25, 1) forwards',
        'fade-up': 'fadeInUp 0.8s cubic-bezier(0.25, 0.1, 0.25, 1) forwards',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideDown: {
          '0%': { transform: 'translateY(-20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        scaleIn: {
          '0%': { transform: 'scale(0.95)', opacity: '0' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
        glow: {
          '0%': { 
            boxShadow: '0 0 10px rgba(139, 92, 246, 0.4), 0 0 20px rgba(139, 92, 246, 0.2)',
            filter: 'brightness(1)',
          },
          '100%': { 
            boxShadow: '0 0 20px rgba(139, 92, 246, 0.6), 0 0 40px rgba(139, 92, 246, 0.4)',
            filter: 'brightness(1.1)',
          },
        },
        glowPulse: {
          '0%, 100%': { 
            opacity: '0.6',
            filter: 'brightness(1)',
          },
          '50%': { 
            opacity: '1',
            filter: 'brightness(1.2)',
          },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-20px)' },
        },
        fadeInLeft: {
          '0%': { 
            transform: 'translateX(-40px)',
            opacity: '0',
          },
          '100%': { 
            transform: 'translateX(0)',
            opacity: '1',
          },
        },
        fadeInRight: {
          '0%': { 
            transform: 'translateX(40px)',
            opacity: '0',
          },
          '100%': { 
            transform: 'translateX(0)',
            opacity: '1',
          },
        },
        fadeInUp: {
          '0%': { 
            transform: 'translateY(40px)',
            opacity: '0',
          },
          '100%': { 
            transform: 'translateY(0)',
            opacity: '1',
          },
        },
      },
      
      // ============================================
      // Z-INDEX SCALE
      // ============================================
      zIndex: {
        '0': '0',
        '10': '10',
        '20': '20',
        '30': '30',
        '40': '40',
        '50': '50',
        'auto': 'auto',
      },
    },
  },
  plugins: [],
}

