/**
 * Анимированные SVG иконки для услуг
 * Создает и управляет анимацией SVG иконок
 */

(function() {
    'use strict';
    
    // Проверяем поддержку reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // SVG иконки для услуг
    const serviceIcons = {
        seo: `
            <svg class="service-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle class="icon-circle" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                <circle class="icon-dot" cx="12" cy="12" r="3" fill="currentColor"/>
                <path class="icon-line" d="M12 2 L12 6 M12 18 L12 22 M2 12 L6 12 M18 12 L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        `,
        development: `
            <svg class="service-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect class="icon-screen" x="3" y="4" width="18" height="14" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                <path class="icon-code" d="M8 8 L12 12 L8 16 M16 8 L12 12 L16 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `,
        ads: `
            <svg class="service-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="icon-megaphone" d="M3 11 L21 3 L17 21 L3 11 Z" stroke="currentColor" stroke-width="2" fill="none" stroke-linejoin="round"/>
                <circle class="icon-circle" cx="17" cy="7" r="2" fill="currentColor"/>
            </svg>
        `,
        marketing: `
            <svg class="service-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="icon-chart" d="M3 3 L3 21 L21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="icon-line" d="M7 16 L12 11 L16 15 L21 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
        `,
        analytics: `
            <svg class="service-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect class="icon-bar" x="3" y="12" width="4" height="8" rx="1" fill="currentColor"/>
                <rect class="icon-bar" x="9" y="8" width="4" height="12" rx="1" fill="currentColor"/>
                <rect class="icon-bar" x="15" y="4" width="4" height="16" rx="1" fill="currentColor"/>
            </svg>
        `
    };
    
    // CSS для анимаций
    const animationStyles = `
        <style>
            .service-icon {
                width: 48px;
                height: 48px;
                transition: all 0.3s ease;
            }
            
            .service-icon .icon-circle,
            .service-icon .icon-dot,
            .service-icon .icon-line,
            .service-icon .icon-screen,
            .service-icon .icon-code,
            .service-icon .icon-megaphone,
            .service-icon .icon-chart,
            .service-icon .icon-bar {
                transition: all 0.3s ease;
            }
            
            .service-icon-container {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: transform 0.3s ease;
            }
            
            .service-icon-container:hover .service-icon {
                transform: scale(1.1) rotate(5deg);
            }
            
            .service-icon-container:hover .icon-circle {
                stroke-dasharray: 62.83;
                stroke-dashoffset: 0;
                animation: rotateCircle 2s linear infinite;
            }
            
            .service-icon-container:hover .icon-dot {
                animation: pulse 1.5s ease-in-out infinite;
            }
            
            .service-icon-container:hover .icon-line {
                stroke-dasharray: 10;
                stroke-dashoffset: 0;
                animation: dash 1s linear infinite;
            }
            
            .service-icon-container:hover .icon-code {
                animation: codePulse 1s ease-in-out infinite;
            }
            
            .service-icon-container:hover .icon-megaphone {
                animation: shake 0.5s ease-in-out infinite;
            }
            
            .service-icon-container:hover .icon-chart {
                animation: chartGrow 1s ease-in-out infinite;
            }
            
            .service-icon-container:hover .icon-bar {
                animation: barGrow 1s ease-in-out infinite;
            }
            
            @keyframes rotateCircle {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }
            
            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                    transform: scale(1);
                }
                50% {
                    opacity: 0.7;
                    transform: scale(1.2);
                }
            }
            
            @keyframes dash {
                to {
                    stroke-dashoffset: -20;
                }
            }
            
            @keyframes codePulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.5;
                }
            }
            
            @keyframes shake {
                0%, 100% {
                    transform: translateX(0);
                }
                25% {
                    transform: translateX(-2px);
                }
                75% {
                    transform: translateX(2px);
                }
            }
            
            @keyframes chartGrow {
                0%, 100% {
                    transform: scaleY(1);
                }
                50% {
                    transform: scaleY(1.1);
                }
            }
            
            @keyframes barGrow {
                0%, 100% {
                    transform: scaleY(1);
                }
                50% {
                    transform: scaleY(1.15);
                }
            }
            
            @media (prefers-reduced-motion: reduce) {
                .service-icon,
                .service-icon * {
                    animation: none !important;
                    transition: none !important;
                }
            }
        </style>
    `;
    
    // Функция для создания иконки
    function createServiceIcon(serviceType) {
        const iconHTML = serviceIcons[serviceType];
        if (!iconHTML) return '';
        
        return `<div class="service-icon-container">${iconHTML}</div>`;
    }
    
    // Функция для инициализации иконок на странице
    function initServiceIcons() {
        // Добавляем стили
        if (!document.getElementById('animated-icons-styles')) {
            const styleElement = document.createElement('div');
            styleElement.id = 'animated-icons-styles';
            styleElement.innerHTML = animationStyles;
            document.head.appendChild(styleElement.firstElementChild);
        }
        
        // Находим секции услуг и добавляем иконки
        const seoSection = document.getElementById('seo');
        const devSection = document.getElementById('development');
        const adsSection = document.getElementById('ads');
        const marketingSection = document.getElementById('marketing');
        const analyticsSection = document.getElementById('analytics');
        
        // Добавляем иконки к заголовкам секций
        if (seoSection) {
            const title = seoSection.querySelector('h2');
            if (title && !title.querySelector('.service-icon-container')) {
                title.insertAdjacentHTML('afterbegin', createServiceIcon('seo'));
            }
        }
        
        if (devSection) {
            const title = devSection.querySelector('h2');
            if (title && !title.querySelector('.service-icon-container')) {
                title.insertAdjacentHTML('afterbegin', createServiceIcon('development'));
            }
        }
        
        if (adsSection) {
            const title = adsSection.querySelector('h2');
            if (title && !title.querySelector('.service-icon-container')) {
                title.insertAdjacentHTML('afterbegin', createServiceIcon('ads'));
            }
        }
        
        if (marketingSection) {
            const title = marketingSection.querySelector('h2');
            if (title && !title.querySelector('.service-icon-container')) {
                title.insertAdjacentHTML('afterbegin', createServiceIcon('marketing'));
            }
        }
        
        if (analyticsSection) {
            const title = analyticsSection.querySelector('h2');
            if (title && !title.querySelector('.service-icon-container')) {
                title.insertAdjacentHTML('afterbegin', createServiceIcon('analytics'));
            }
        }
    }
    
    // Инициализация
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initServiceIcons);
    } else {
        initServiceIcons();
    }
    
    // Экспорт для внешнего использования
    window.AnimatedServiceIcons = {
        init: initServiceIcons,
        create: createServiceIcon
    };
})();

