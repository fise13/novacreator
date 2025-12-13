/**
 * Parallax эффект для hero-секций
 * GPU-optimized параллакс с поддержкой prefers-reduced-motion
 */

(function() {
    'use strict';
    
    // Проверяем поддержку reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) {
        return; // Отключаем параллакс для пользователей с reduced motion
    }
    
    // Находим все hero-секции с классом parallax-hero
    const heroSections = document.querySelectorAll('.parallax-hero, section[class*="hero"]');
    
    if (heroSections.length === 0) return;
    
    // Функция для применения параллакса
    function applyParallax() {
        const scrollY = window.pageYOffset || window.scrollY;
        
        heroSections.forEach(section => {
            const rect = section.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            
            if (!isVisible) return;
            
            // Вычисляем параллакс эффект
            const parallaxSpeed = 0.5; // Скорость параллакса (можно настроить)
            const offset = (scrollY - rect.top) * parallaxSpeed;
            
            // Применяем трансформацию к фоновым элементам
            const backgroundElements = section.querySelectorAll('.parallax-bg, .parallax-element');
            backgroundElements.forEach((el, index) => {
                const speed = parallaxSpeed * (0.3 + index * 0.2); // Разная скорость для разных слоев
                const yPos = (scrollY - rect.top) * speed;
                el.style.transform = `translate3d(0, ${yPos}px, 0)`;
            });
            
            // Применяем параллакс к основному контенту (более слабый эффект)
            const content = section.querySelector('.parallax-content');
            if (content) {
                const contentSpeed = parallaxSpeed * 0.2;
                const contentYPos = (scrollY - rect.top) * contentSpeed;
                content.style.transform = `translate3d(0, ${contentYPos}px, 0)`;
            }
        });
    }
    
    // Оптимизированный обработчик скролла с requestAnimationFrame
    let ticking = false;
    
    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                applyParallax();
                ticking = false;
            });
            ticking = true;
        }
    }
    
    // Инициализация
    function init() {
        // Применяем параллакс при загрузке
        applyParallax();
        
        // Слушаем скролл
        window.addEventListener('scroll', onScroll, { passive: true });
        
        // Применяем при изменении размера окна
        window.addEventListener('resize', applyParallax, { passive: true });
    }
    
    // Инициализируем когда DOM готов
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Экспорт для внешнего использования
    window.ParallaxHero = {
        init: init,
        apply: applyParallax
    };
})();

