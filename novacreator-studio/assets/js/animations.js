/**
 * GPU-Optimized Animations Module
 * Все анимации используют только transform и opacity для максимальной производительности
 */

(function() {
    'use strict';
    
    // Проверка поддержки и предпочтений пользователя
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isMobile = window.innerWidth <= 768;
    
    // Единый easing для всех анимаций
    const EASING = 'cubic-bezier(0.25, 0.1, 0.25, 1)';
    
    /**
     * Оптимизированная анимация счетчика с requestAnimationFrame
     * Исправлена для правильного отображения префиксов и суффиксов
     */
    function animateCounter(element, target, prefix = '', suffix = '', duration = 2000) {
        const startTime = performance.now();
        const startValue = 0;
        
        // Определяем, является ли значение отрицательным (через target или prefix)
        const isNegativeTarget = target < 0;
        const isNegativePrefix = prefix === '-';
        const isNegative = isNegativeTarget || isNegativePrefix;
        
        // Используем абсолютное значение для анимации
        const absTarget = Math.abs(target);
        
        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Используем easing функцию для плавности
            const easedProgress = easeInOutCubic(progress);
            const currentValue = Math.floor(startValue + absTarget * easedProgress);
            
            // Правильно формируем текст с учетом префикса и суффикса
            let displayText = '';
            
            // Если есть префикс (кроме минуса, который обрабатывается отдельно), добавляем его
            if (prefix && prefix !== '-') {
                displayText = prefix;
            }
            
            // Добавляем значение с учетом знака
            if (isNegative) {
                displayText += '-' + currentValue;
            } else {
                displayText += currentValue;
            }
            
            // Если есть суффикс, добавляем его
            if (suffix) {
                displayText += suffix;
            }
            
            element.textContent = displayText;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                // Финальное значение - гарантируем правильный формат
                let finalText = '';
                
                // Если есть префикс (кроме минуса), добавляем его
                if (prefix && prefix !== '-') {
                    finalText = prefix;
                }
                
                // Добавляем финальное значение
                if (isNegative) {
                    finalText += '-' + absTarget;
                } else {
                    finalText += target;
                }
                
                // Если есть суффикс, добавляем его
                if (suffix) {
                    finalText += suffix;
                }
                
                element.textContent = finalText;
                element.style.willChange = 'auto';
            }
        }
        
        element.style.willChange = 'contents';
        requestAnimationFrame(updateCounter);
    }
    
    /**
     * Easing функция для плавной анимации
     */
    function easeInOutCubic(t) {
        return t < 0.5
            ? 4 * t * t * t
            : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }
    
    /**
     * Инициализация счетчиков с IntersectionObserver
     */
    function initCounters() {
        const counters = document.querySelectorAll('[data-target]');
        if (counters.length === 0) return;
        
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counter-animated')) {
                    entry.target.classList.add('counter-animated');
                    
                    const target = parseInt(entry.target.getAttribute('data-target')) || 0;
                    const prefix = entry.target.getAttribute('data-prefix') || '';
                    const suffix = entry.target.getAttribute('data-suffix') || '';
                    const duration = parseInt(entry.target.getAttribute('data-duration')) || (isMobile ? 1500 : 2000);
                    
                    // Проверяем текущее значение - если оно уже установлено (не "0"), используем его как начальное
                    const currentText = entry.target.textContent.trim();
                    const hasInitialValue = currentText && currentText !== '0' && !/^[+\-]?0[%+\-x\/]?$/.test(currentText);
                    
                    // Устанавливаем начальное значение правильно
                    const isNegativePrefix = prefix === '-';
                    let initialText = '';
                    
                    if (!hasInitialValue) {
                        // Если есть префикс (кроме минуса), добавляем его
                        if (prefix && prefix !== '-') {
                            initialText = prefix;
                        }
                        
                        // Добавляем ноль (если префикс минус, то будет "-0")
                        if (isNegativePrefix) {
                            initialText += '-0';
                        } else {
                            initialText += '0';
                        }
                        
                        // Если есть суффикс, добавляем его
                        if (suffix) {
                            initialText += suffix;
                        }
                        
                        entry.target.textContent = initialText;
                    }
                    
                    // Небольшая задержка для плавности
                    requestAnimationFrame(() => {
                        animateCounter(entry.target, target, prefix, suffix, duration);
                    });
                    
                    counterObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: isMobile ? 0.3 : 0.5,
            rootMargin: '0px 0px -50px 0px'
        });
        
        counters.forEach(counter => counterObserver.observe(counter));
    }
    
    /**
     * Оптимизированная анимация появления элементов при скролле
     */
    function initScrollAnimations() {
        if (prefersReducedMotion) {
            // Показываем все элементы сразу без анимации
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                el.classList.add('visible');
                el.style.opacity = '1';
                el.style.transform = 'translate3d(0, 0, 0)';
            });
            return;
        }
        
        const observerOptions = {
            threshold: isMobile ? 0.05 : 0.1,
            rootMargin: isMobile ? '0px 0px -40px 0px' : '0px 0px -80px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    const delay = isMobile ? index * 20 : index * 50;
                    
                    // Используем requestAnimationFrame для синхронизации с браузером
                    requestAnimationFrame(() => {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                            // Убираем will-change после анимации
                            setTimeout(() => {
                                entry.target.style.willChange = 'auto';
                            }, 600);
                        }, delay);
                    });
                    
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    }
    
    /**
     * Оптимизированный параллакс эффект (только для десктопа)
     */
    function initParallax() {
        if (isMobile || prefersReducedMotion) return;
        
        const parallaxElements = document.querySelectorAll('.parallax');
        if (parallaxElements.length === 0) return;
        
        let ticking = false;
        let lastScrollY = 0;
        
        function updateParallax() {
            const scrollY = window.scrollY;
            
            // Обновляем только если скролл изменился
            if (Math.abs(scrollY - lastScrollY) < 1) {
                ticking = false;
                return;
            }
            
            parallaxElements.forEach(element => {
                const speed = parseFloat(element.dataset.speed) || 0.5;
                const yPos = -(scrollY * speed);
                
                // Используем translate3d для GPU ускорения
                element.style.transform = `translate3d(0, ${yPos}px, 0)`;
            });
            
            lastScrollY = scrollY;
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });
    }
    
    /**
     * Оптимизированный индикатор прогресса прокрутки
     */
    function initScrollProgress() {
        const progressBar = document.querySelector('.scroll-progress-bar');
        const progressCircle = document.getElementById('scrollProgressCircle');
        
        if (!progressBar && !progressCircle) return;
        
        let ticking = false;
        let lastProgress = 0;
        
        function updateProgress() {
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollY = window.scrollY;
            const progress = Math.min((scrollY / scrollHeight) * 100, 100);
            
            // Обновляем только если прогресс изменился значительно
            if (Math.abs(progress - lastProgress) < 0.1) {
                ticking = false;
                return;
            }
            
            // Прогресс-бар через transform scaleX
            if (progressBar) {
                progressBar.style.setProperty('--progress', progress + '%');
                progressBar.style.transform = `scaleX(${progress / 100})`;
            }
            
            // Круг прогресса
            if (progressCircle) {
                const circumference = 2 * Math.PI * 45;
                const offset = circumference - (progress / 100) * circumference;
                progressCircle.style.strokeDashoffset = offset;
            }
            
            lastProgress = progress;
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateProgress);
                ticking = true;
            }
        }, { passive: true });
    }
    
    /**
     * Кнопка "Наверх" с оптимизированной анимацией
     */
    function initBackToTop() {
        const backToTopBtn = document.getElementById('backToTop');
        if (!backToTopBtn || window.innerWidth <= 767) return;
        
        let ticking = false;
        let isVisible = false;
        
        function updateButton() {
            const scrollY = window.scrollY;
            const shouldShow = scrollY > 300;
            
            if (shouldShow !== isVisible) {
                isVisible = shouldShow;
                
                if (shouldShow) {
                    backToTopBtn.style.opacity = '1';
                    backToTopBtn.style.pointerEvents = 'auto';
                    backToTopBtn.style.transform = 'translate3d(0, 0, 0)';
                } else {
                    backToTopBtn.style.opacity = '0';
                    backToTopBtn.style.pointerEvents = 'none';
                }
            }
            
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateButton);
                ticking = true;
            }
        }, { passive: true });
        
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    /**
     * Lazy loading для изображений
     */
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    delete img.dataset.src;
                }
            });
        } else {
            // Fallback с IntersectionObserver
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.add('loaded');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            }, { rootMargin: '50px' });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }
    
    /**
     * Плавная прокрутка для якорных ссылок
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || href.length <= 1) return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const isMobile = window.innerWidth <= 768;
                    const offsetTop = target.offsetTop - (isMobile ? 60 : 80);
                    
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
    
    /**
     * Инициализация всех анимаций
     */
    function init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }
        
        initScrollAnimations();
        initCounters();
        initParallax();
        initScrollProgress();
        initBackToTop();
        initLazyLoading();
        initSmoothScroll();
    }
    
    // Экспорт для использования в других модулях
    window.Animations = {
        init,
        animateCounter,
        initScrollAnimations,
        initParallax
    };
    
    // Автоматическая инициализация
    init();
})();

