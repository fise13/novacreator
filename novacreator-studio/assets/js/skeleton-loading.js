/**
 * Skeleton Loading
 * Показывает skeleton элементы во время загрузки контента
 */

(function() {
    'use strict';
    
    // Проверяем поддержку reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Функция для создания skeleton элементов
    function createSkeleton(type, count = 1) {
        const skeletons = [];
        for (let i = 0; i < count; i++) {
            const skeleton = document.createElement('div');
            skeleton.className = `skeleton skeleton-${type}`;
            skeletons.push(skeleton);
        }
        return skeletons;
    }
    
    // Функция для показа skeleton при загрузке
    function showSkeleton(container, skeletonType, count = 1) {
        if (!container) return;
        
        const skeletons = createSkeleton(skeletonType, count);
        skeletons.forEach(skeleton => {
            container.appendChild(skeleton);
        });
        
        // Помечаем контейнер как загружающийся
        container.classList.add('loading');
    }
    
    // Функция для скрытия skeleton после загрузки
    function hideSkeleton(container) {
        if (!container) return;
        
        const skeletons = container.querySelectorAll('.skeleton');
        skeletons.forEach(skeleton => {
            skeleton.classList.add('skeleton-hidden');
            setTimeout(() => {
                skeleton.remove();
            }, 300);
        });
        
        container.classList.remove('loading');
        container.classList.add('content-loaded');
    }
    
    // Автоматическое скрытие skeleton после загрузки страницы
    function initAutoHide() {
        // Скрываем все skeleton после полной загрузки
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.querySelectorAll('.skeleton').forEach(skeleton => {
                    const container = skeleton.closest('.loading');
                    if (container) {
                        hideSkeleton(container);
                    } else {
                        skeleton.classList.add('skeleton-hidden');
                        setTimeout(() => skeleton.remove(), 300);
                    }
                });
            }, 500);
        });
    }
    
    // Функция для создания skeleton портфолио карточки
    function createPortfolioSkeleton() {
        const skeleton = document.createElement('div');
        skeleton.className = 'skeleton-portfolio-card skeleton';
        skeleton.innerHTML = `
            <div class="skeleton-portfolio-image skeleton"></div>
            <div class="skeleton-portfolio-content">
                <div class="skeleton-portfolio-title skeleton"></div>
                <div class="skeleton-portfolio-text skeleton"></div>
                <div class="skeleton-portfolio-text skeleton"></div>
                <div class="skeleton-portfolio-text skeleton"></div>
                <div class="skeleton-portfolio-tags">
                    <div class="skeleton-portfolio-tag skeleton"></div>
                    <div class="skeleton-portfolio-tag skeleton"></div>
                    <div class="skeleton-portfolio-tag skeleton"></div>
                </div>
            </div>
        `;
        return skeleton;
    }
    
    // Показываем skeleton для портфолио если контент еще не загружен
    function initPortfolioSkeleton() {
        const portfolioContainer = document.getElementById('portfolioProjects');
        if (!portfolioContainer) return;
        
        // Проверяем, есть ли уже карточки
        const existingCards = portfolioContainer.querySelectorAll('.portfolio-item');
        if (existingCards.length === 0) {
            // Показываем skeleton карточки
            for (let i = 0; i < 3; i++) {
                const skeleton = createPortfolioSkeleton();
                portfolioContainer.appendChild(skeleton);
            }
            portfolioContainer.classList.add('loading');
        }
    }
    
    // Инициализация
    function init() {
        if (prefersReducedMotion) {
            // Отключаем skeleton анимации для reduced motion
            document.querySelectorAll('.skeleton').forEach(skeleton => {
                skeleton.style.animation = 'none';
            });
        }
        
        initAutoHide();
        initPortfolioSkeleton();
    }
    
    // Инициализируем когда DOM готов
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Экспорт для внешнего использования
    window.SkeletonLoading = {
        show: showSkeleton,
        hide: hideSkeleton,
        createPortfolio: createPortfolioSkeleton
    };
})();

