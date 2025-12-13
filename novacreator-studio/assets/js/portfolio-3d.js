/**
 * 3D эффекты для карточек портфолио
 * Интерактивные 3D трансформации при движении мыши
 */

(function() {
    'use strict';
    
    // Проверяем поддержку reduced motion и мобильные устройства
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isMobile = window.innerWidth < 768 || 'ontouchstart' in window;
    
    if (prefersReducedMotion || isMobile) {
        return; // Отключаем 3D эффекты для мобильных и reduced motion
    }
    
    // Находим все карточки портфолио
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    if (portfolioItems.length === 0) return;
    
    // Функция для применения 3D эффекта
    function apply3DEffect(card, event) {
        if (!card || !event) return;
        
        const rect = card.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        
        // Вычисляем процентные координаты (0-1)
        const xPercent = (x / rect.width) - 0.5;
        const yPercent = (y / rect.height) - 0.5;
        
        // Максимальный угол наклона (в градусах)
        const maxRotateX = 5;
        const maxRotateY = 5;
        
        // Вычисляем углы наклона
        const rotateX = -yPercent * maxRotateX;
        const rotateY = xPercent * maxRotateY;
        
        // Применяем трансформацию
        card.style.transform = `
            perspective(1000px)
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            translateZ(10px)
            scale(1.02)
        `;
        
        // Добавляем атрибут для отслеживания
        card.setAttribute('data-tilt', 'true');
    }
    
    // Функция для сброса 3D эффекта
    function reset3DEffect(card) {
        if (!card) return;
        
        card.style.transform = '';
        card.removeAttribute('data-tilt');
    }
    
    // Инициализация 3D эффектов для каждой карточки
    portfolioItems.forEach(card => {
        // Добавляем класс для 3D эффекта
        card.classList.add('portfolio-item-3d');
        
        // Обработчик движения мыши
        card.addEventListener('mousemove', function(e) {
            apply3DEffect(this, e);
        }, { passive: true });
        
        // Сброс при уходе мыши
        card.addEventListener('mouseleave', function() {
            reset3DEffect(this);
        }, { passive: true });
        
        // Сброс при потере фокуса
        card.addEventListener('mouseout', function() {
            reset3DEffect(this);
        }, { passive: true });
    });
    
    // Функция для обновления 3D эффектов при изменении размера окна
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Сбрасываем все 3D эффекты при изменении размера
            portfolioItems.forEach(card => {
                reset3DEffect(card);
            });
        }, 250);
    }, { passive: true });
    
    // Экспорт для внешнего использования
    window.Portfolio3D = {
        apply: apply3DEffect,
        reset: reset3DEffect
    };
})();

