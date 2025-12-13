/**
 * Улучшенные touch-жесты и swipe-функции
 * - Swipe для галерей
 * - Pull-to-refresh
 * - Улучшенные touch-события
 */

(function() {
    'use strict';
    
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (!isTouchDevice) return;
    
    // ============================================
    // 1. Swipe жесты для галерей
    // ============================================
    function initSwipeGalleries() {
        const galleries = document.querySelectorAll('.gallery, .carousel, [data-swipe]');
        
        galleries.forEach(gallery => {
            let startX = 0;
            let startY = 0;
            let currentX = 0;
            let currentY = 0;
            let isDragging = false;
            let startScrollLeft = 0;
            let startScrollTop = 0;
            
            gallery.addEventListener('touchstart', (e) => {
                isDragging = true;
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                startScrollLeft = gallery.scrollLeft;
                startScrollTop = gallery.scrollTop;
                gallery.style.scrollBehavior = 'auto';
                gallery.style.cursor = 'grabbing';
            }, { passive: true });
            
            gallery.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                
                e.preventDefault();
                currentX = e.touches[0].clientX;
                currentY = e.touches[0].clientY;
                
                const diffX = startX - currentX;
                const diffY = startY - currentY;
                
                // Горизонтальный swipe для галерей
                if (Math.abs(diffX) > Math.abs(diffY)) {
                    gallery.scrollLeft = startScrollLeft + diffX;
                }
            }, { passive: false });
            
            gallery.addEventListener('touchend', () => {
                if (!isDragging) return;
                
                isDragging = false;
                gallery.style.scrollBehavior = 'smooth';
                gallery.style.cursor = 'grab';
                
                const diffX = startX - currentX;
                const diffY = startY - currentY;
                const threshold = 50;
                
                // Определяем направление swipe
                if (Math.abs(diffX) > threshold || Math.abs(diffY) > threshold) {
                    if (Math.abs(diffX) > Math.abs(diffY)) {
                        // Горизонтальный swipe
                        const items = gallery.querySelectorAll('.gallery-item, .carousel-item, [data-item]');
                        const itemWidth = items[0]?.offsetWidth || gallery.offsetWidth;
                        const currentIndex = Math.round(gallery.scrollLeft / itemWidth);
                        
                        if (diffX > threshold && currentIndex < items.length - 1) {
                            // Swipe влево - следующий элемент
                            gallery.scrollTo({
                                left: (currentIndex + 1) * itemWidth,
                                behavior: 'smooth'
                            });
                        } else if (diffX < -threshold && currentIndex > 0) {
                            // Swipe вправо - предыдущий элемент
                            gallery.scrollTo({
                                left: (currentIndex - 1) * itemWidth,
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            }, { passive: true });
        });
    }
    
    // ============================================
    // 2. Pull-to-refresh
    // ============================================
    function initPullToRefresh() {
        const pullToRefreshElements = document.querySelectorAll('[data-pull-to-refresh]');
        
        pullToRefreshElements.forEach(element => {
            let startY = 0;
            let currentY = 0;
            let isPulling = false;
            let pullDistance = 0;
            const threshold = 80;
            const maxPull = 120;
            
            // Создаем индикатор
            const indicator = document.createElement('div');
            indicator.className = 'pull-to-refresh-indicator';
            indicator.innerHTML = `
                <div style="text-align: center; padding: 20px; color: var(--color-text-secondary);">
                    <svg style="width: 24px; height: 24px; margin: 0 auto 8px; display: block; animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span style="font-size: 14px;">Потяните для обновления</span>
                </div>
            `;
            indicator.style.cssText = `
                position: absolute;
                top: -100px;
                left: 0;
                right: 0;
                height: 100px;
                background: var(--color-bg-lighter);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: top 0.3s ease;
                z-index: 1000;
            `;
            
            const container = element.parentElement || document.body;
            container.style.position = 'relative';
            container.insertBefore(indicator, container.firstChild);
            
            element.addEventListener('touchstart', (e) => {
                if (element.scrollTop === 0) {
                    startY = e.touches[0].clientY;
                    isPulling = true;
                }
            }, { passive: true });
            
            element.addEventListener('touchmove', (e) => {
                if (!isPulling || element.scrollTop > 0) {
                    isPulling = false;
                    return;
                }
                
                currentY = e.touches[0].clientY;
                pullDistance = currentY - startY;
                
                if (pullDistance > 0) {
                    e.preventDefault();
                    const pullProgress = Math.min(pullDistance / threshold, 1);
                    indicator.style.top = `${Math.min(pullDistance, maxPull) - 100}px`;
                    indicator.style.opacity = pullProgress;
                    
                    if (pullDistance >= threshold) {
                        indicator.querySelector('span').textContent = 'Отпустите для обновления';
                    } else {
                        indicator.querySelector('span').textContent = 'Потяните для обновления';
                    }
                }
            }, { passive: false });
            
            element.addEventListener('touchend', () => {
                if (!isPulling) return;
                
                if (pullDistance >= threshold) {
                    // Запускаем обновление
                    indicator.querySelector('span').textContent = 'Обновление...';
                    
                    // Вызываем событие для обработки
                    const refreshEvent = new CustomEvent('pulltorefresh', {
                        detail: { element }
                    });
                    element.dispatchEvent(refreshEvent);
                    
                    // Если есть callback функция
                    const callback = element.dataset.pullToRefreshCallback;
                    if (callback && typeof window[callback] === 'function') {
                        window[callback](element);
                    }
                }
                
                // Возвращаем индикатор в исходное положение
                indicator.style.top = '-100px';
                indicator.style.opacity = '0';
                pullDistance = 0;
                isPulling = false;
            }, { passive: true });
        });
    }
    
    // ============================================
    // 3. Улучшенные touch-события для всех интерактивных элементов
    // ============================================
    function enhanceTouchEvents() {
        const interactiveElements = document.querySelectorAll(
            'button, a, .btn, input, textarea, select, [role="button"], [tabindex]'
        );
        
        interactiveElements.forEach(element => {
            // Улучшенная визуальная обратная связь
            element.addEventListener('touchstart', function() {
                this.style.transition = 'all 0.15s ease';
                this.style.transform = 'scale(0.97)';
                this.style.opacity = '0.8';
                
                // Haptic feedback (если поддерживается)
                if ('vibrate' in navigator) {
                    navigator.vibrate(10);
                }
            }, { passive: true });
            
            element.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                    this.style.opacity = '1';
                }, 150);
            }, { passive: true });
            
            element.addEventListener('touchcancel', function() {
                this.style.transform = 'scale(1)';
                this.style.opacity = '1';
            }, { passive: true });
            
            // Предотвращение двойного клика
            let lastTouchEnd = 0;
            element.addEventListener('touchend', function(e) {
                const now = Date.now();
                if (now - lastTouchEnd <= 300) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                lastTouchEnd = now;
            }, { passive: false });
        });
        
        // Улучшенная обработка длинного нажатия
        let longPressTimer = null;
        const longPressElements = document.querySelectorAll('[data-long-press]');
        
        longPressElements.forEach(element => {
            element.addEventListener('touchstart', function() {
                longPressTimer = setTimeout(() => {
                    const event = new CustomEvent('longpress', {
                        detail: { element: this }
                    });
                    this.dispatchEvent(event);
                    
                    if ('vibrate' in navigator) {
                        navigator.vibrate(20);
                    }
                }, 500);
            }, { passive: true });
            
            element.addEventListener('touchend', function() {
                if (longPressTimer) {
                    clearTimeout(longPressTimer);
                    longPressTimer = null;
                }
            }, { passive: true });
            
            element.addEventListener('touchcancel', function() {
                if (longPressTimer) {
                    clearTimeout(longPressTimer);
                    longPressTimer = null;
                }
            }, { passive: true });
        });
    }
    
    // ============================================
    // 4. Swipe для навигации назад/вперед
    // ============================================
    function initSwipeNavigation() {
        let startX = 0;
        let startY = 0;
        let startTime = 0;
        const threshold = 100;
        const maxVertical = 30;
        const minSwipeTime = 100;
        const maxSwipeTime = 500;
        
        document.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            startTime = Date.now();
        }, { passive: true });
        
        document.addEventListener('touchend', (e) => {
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            const endTime = Date.now();
            const deltaX = endX - startX;
            const deltaY = endY - startY;
            const deltaTime = endTime - startTime;
            
            // Проверяем, что это горизонтальный swipe
            if (Math.abs(deltaX) > Math.abs(deltaY) && 
                Math.abs(deltaY) < maxVertical &&
                deltaTime >= minSwipeTime && 
                deltaTime <= maxSwipeTime) {
                
                if (Math.abs(deltaX) > threshold) {
                    if (deltaX > 0) {
                        // Swipe вправо - назад
                        const backEvent = new CustomEvent('swiperight');
                        document.dispatchEvent(backEvent);
                        
                        // Если есть кнопка "назад" в истории
                        if (window.history.length > 1) {
                            // Можно добавить логику навигации назад
                        }
                    } else {
                        // Swipe влево - вперед
                        const forwardEvent = new CustomEvent('swipeleft');
                        document.dispatchEvent(forwardEvent);
                    }
                    
                    // Haptic feedback
                    if ('vibrate' in navigator) {
                        navigator.vibrate(15);
                    }
                }
            }
        }, { passive: true });
    }
    
    // Инициализация
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initSwipeGalleries();
            initPullToRefresh();
            enhanceTouchEvents();
            initSwipeNavigation();
        });
    } else {
        initSwipeGalleries();
        initPullToRefresh();
        enhanceTouchEvents();
        initSwipeNavigation();
    }
    
    // Добавляем класс для стилизации touch-устройств
    document.documentElement.classList.add('touch-device');
})();

