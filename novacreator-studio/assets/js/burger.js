/**
 * Улучшенный Burger Menu Module
 * Включает все улучшения: жесты, оптимизацию, доступность, анимации
 */

(function() {
    'use strict';

    const SELECTORS = {
        burgerBtn: '#burgerBtn',
        burgerMenu: '#burgerMenu',
        burgerOverlay: '#burgerOverlay',
        burgerCloseBtn: '#burgerCloseBtn',
        burgerThemeToggle: '#burgerThemeToggle',
        burgerLangGroup: '#burgerLangGroup',
        mainNavbar: '#mainNavbar',
        mobileMenuItems: '.mobile-menu-item',
        focusableElements: 'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
    };

    let isOpen = false;
    let previousActiveElement = null;
    let scrollY = 0;
    let animationFrameId = null;

    const burgerBtn = document.querySelector(SELECTORS.burgerBtn);
    const burgerMenu = document.querySelector(SELECTORS.burgerMenu);
    const burgerOverlay = document.querySelector(SELECTORS.burgerOverlay);
    const burgerCloseBtn = document.querySelector(SELECTORS.burgerCloseBtn);
    const burgerThemeToggle = document.querySelector(SELECTORS.burgerThemeToggle);
    const burgerLangGroup = document.querySelector(SELECTORS.burgerLangGroup);
    const mainNavbar = document.querySelector(SELECTORS.mainNavbar);

    if (!burgerBtn || !burgerMenu || !burgerOverlay) {
        return; // Элементы не найдены, выходим
    }

    /**
     * Улучшенная тактильная обратная связь
     */
    function provideHapticFeedback(intensity = 'light') {
        if ('vibrate' in navigator && 
            !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            const patterns = { light: 10, medium: 20, strong: 30 };
            navigator.vibrate(patterns[intensity] || patterns.light);
        }
    }

    /**
     * Объявления для screen readers
     */
    function announceToScreenReader(message, priority = 'polite') {
        const announcement = document.createElement('div');
        announcement.setAttribute('role', 'status');
        announcement.setAttribute('aria-live', priority);
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'sr-only';
        announcement.textContent = message;
        
        document.body.appendChild(announcement);
        setTimeout(() => {
            if (announcement.parentNode) {
                document.body.removeChild(announcement);
            }
        }, 1000);
    }

    /**
     * Проверка prefers-reduced-motion
     */
    function prefersReducedMotion() {
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    }

    /**
     * Lock body scroll
     */
    function lockBodyScroll() {
        scrollY = window.scrollY;
        document.body.style.position = 'fixed';
        document.body.style.top = `-${scrollY}px`;
        document.body.style.width = '100%';
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    }

    /**
     * Unlock body scroll
     */
    function unlockBodyScroll() {
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
        window.scrollTo(0, scrollY);
    }

    /**
     * Улучшенная анимация открытия с requestAnimationFrame
     */
    function animateMenuOpen(callback) {
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }

        const startTime = performance.now();
        const duration = prefersReducedMotion() ? 150 : 300;
        const menuItems = burgerMenu.querySelectorAll(SELECTORS.mobileMenuItems);
        const reducedMotion = prefersReducedMotion();

        function animate(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeOut = reducedMotion ? progress : 1 - Math.pow(1 - progress, 3);

            burgerOverlay.style.opacity = easeOut.toString();

            // Stagger анимация для элементов
            if (!reducedMotion) {
                menuItems.forEach((item, index) => {
                    const itemDelay = index * 50;
                    const itemProgress = Math.max(0, Math.min(1, (elapsed - itemDelay) / 200));
                    const itemEase = 1 - Math.pow(1 - itemProgress, 3);
                    
                    if (itemProgress > 0) {
                        item.style.opacity = itemEase.toString();
                        item.style.transform = `translateY(${(1 - itemEase) * 20}px)`;
                    }
                });
            } else {
                menuItems.forEach(item => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                });
            }

            if (progress < 1) {
                animationFrameId = requestAnimationFrame(animate);
            } else {
                animationFrameId = null;
                // Убираем will-change после анимации
                menuItems.forEach(item => {
                    item.classList.add('animated');
                    item.style.willChange = 'auto';
                });
                if (callback) callback();
            }
        }

        // Инициализируем элементы для анимации
        menuItems.forEach(item => {
            item.style.willChange = 'transform, opacity';
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
        });

        animationFrameId = requestAnimationFrame(animate);
    }

    /**
     * Focus trap - ловит фокус внутри меню с улучшенной навигацией
     */
    function trapFocus(e) {
        if (!isOpen) return;

        const focusableElements = Array.from(burgerMenu.querySelectorAll(SELECTORS.focusableElements));
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];
        const currentIndex = focusableElements.indexOf(document.activeElement);

        if (e.key === 'Tab') {
            if (e.shiftKey) {
                // Shift + Tab
                if (document.activeElement === firstFocusable) {
                    e.preventDefault();
                    lastFocusable?.focus();
                }
            } else {
                // Tab
                if (document.activeElement === lastFocusable) {
                    e.preventDefault();
                    firstFocusable?.focus();
                }
            }
        } else if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = (currentIndex + 1) % focusableElements.length;
            focusableElements[nextIndex]?.focus();
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIndex = (currentIndex - 1 + focusableElements.length) % focusableElements.length;
            focusableElements[prevIndex]?.focus();
        } else if (e.key === 'Home') {
            e.preventDefault();
            firstFocusable?.focus();
        } else if (e.key === 'End') {
            e.preventDefault();
            lastFocusable?.focus();
        }
    }

    /**
     * Улучшенная навигация с клавиатуры для элементов меню
     */
    function enhanceKeyboardNavigation() {
        const menuItems = burgerMenu.querySelectorAll(SELECTORS.mobileMenuItems);
        
        menuItems.forEach((item, index) => {
            item.addEventListener('keydown', (e) => {
                let targetIndex = -1;
                
                switch(e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        targetIndex = (index + 1) % menuItems.length;
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        targetIndex = (index - 1 + menuItems.length) % menuItems.length;
                        break;
                    case 'Home':
                        e.preventDefault();
                        targetIndex = 0;
                        break;
                    case 'End':
                        e.preventDefault();
                        targetIndex = menuItems.length - 1;
                        break;
                }
                
                if (targetIndex >= 0) {
                    menuItems[targetIndex].focus();
                    menuItems[targetIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            });
            
            // Прокрутка в область видимости при фокусе
            item.addEventListener('focus', () => {
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        });
    }

    /**
     * Класс для обработки swipe жестов
     */
    class BurgerMenuGestures {
        constructor(menuElement) {
            this.menu = menuElement;
            this.startX = 0;
            this.startY = 0;
            this.currentX = 0;
            this.currentY = 0;
            this.isDragging = false;
            this.threshold = 100; // Минимальное расстояние для закрытия
            
            this.init();
        }
        
        init() {
            this.menu.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: true });
            this.menu.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
            this.menu.addEventListener('touchend', this.handleTouchEnd.bind(this), { passive: true });
        }
        
        handleTouchStart(e) {
            const touch = e.touches[0];
            this.startX = touch.clientX;
            this.startY = touch.clientY;
            this.isDragging = true;
        }
        
        handleTouchMove(e) {
            if (!this.isDragging) return;
            
            const touch = e.touches[0];
            this.currentX = touch.clientX;
            this.currentY = touch.clientY;
            
            const deltaX = this.currentX - this.startX;
            const deltaY = this.currentY - this.startY;
            
            // Проверяем, что это горизонтальный свайп (не вертикальный скролл)
            if (Math.abs(deltaX) > Math.abs(deltaY) && deltaX > 0) {
                e.preventDefault();
                
                // Ограничиваем движение только вправо
                const translateX = Math.min(deltaX, this.menu.offsetWidth);
                this.menu.style.transform = `translateX(${translateX}px)`;
                this.menu.style.opacity = (1 - (translateX / this.menu.offsetWidth) * 0.5).toString();
            }
        }
        
        handleTouchEnd(e) {
            if (!this.isDragging) return;
            
            const deltaX = this.currentX - this.startX;
            
            // Если свайп достаточно большой, закрываем меню
            if (deltaX > this.threshold) {
                window.BurgerMenu?.close();
                provideHapticFeedback('medium');
            } else {
                // Возвращаем меню в исходное положение
                this.menu.style.transform = '';
                this.menu.style.opacity = '';
            }
            
            this.isDragging = false;
            this.startX = 0;
            this.startY = 0;
        }
    }

    /**
     * Открытие меню
     */
    function openMenu() {
        if (isOpen) return;

        isOpen = true;
        previousActiveElement = document.activeElement;

        // Обновляем aria атрибуты
        burgerBtn.setAttribute('aria-expanded', 'true');
        burgerMenu.setAttribute('aria-hidden', 'false');
        burgerMenu.classList.add('opening');

        // Блокируем скролл
        lockBodyScroll();

        // Скрываем navbar
        if (mainNavbar) {
            mainNavbar.style.display = 'none';
        }

        // Показываем overlay и меню
        burgerOverlay.classList.remove('hidden');
        burgerMenu.classList.remove('hidden');

        // Анимация появления
        animateMenuOpen(() => {
            burgerMenu.classList.remove('opening');
            burgerMenu.classList.add('open');
            
            // Фокус на первый элемент
            const firstFocusable = burgerMenu.querySelector(SELECTORS.focusableElements);
            if (firstFocusable) {
                setTimeout(() => firstFocusable.focus(), 100);
            }
        });

        // Анимация языка
        if (burgerLangGroup && !prefersReducedMotion()) {
            setTimeout(() => {
                burgerLangGroup.classList.add('lang-show');
            }, 80);
        } else if (burgerLangGroup) {
            burgerLangGroup.classList.add('lang-show');
        }


        // Тактильная обратная связь
        provideHapticFeedback('light');

        // Добавляем обработчик для focus trap
        document.addEventListener('keydown', trapFocus);

        // Инициализируем жесты
        if (!window.burgerMenuGestures) {
            window.burgerMenuGestures = new BurgerMenuGestures(burgerMenu);
        }
    }

    /**
     * Закрытие меню с красивой анимацией ухода
     */
    function closeMenu() {
        if (!isOpen) return;

        isOpen = false;
        burgerMenu.classList.add('closing');

        // Обновляем aria атрибуты
        burgerBtn.setAttribute('aria-expanded', 'false');
        burgerMenu.setAttribute('aria-hidden', 'true');

        // Анимация ухода элементов меню (обратная stagger)
        const menuItems = burgerMenu.querySelectorAll(SELECTORS.mobileMenuItems);
        const reducedMotion = prefersReducedMotion();
        
        if (!reducedMotion) {
            menuItems.forEach((item, index) => {
                const delay = (menuItems.length - index - 1) * 30;
                setTimeout(() => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(20px)';
                    item.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                }, delay);
            });
        }

        // Анимация языка
        if (burgerLangGroup) {
            burgerLangGroup.classList.remove('lang-show');
        }

        // Анимация overlay (fade out)
        burgerOverlay.style.opacity = '0';
        burgerOverlay.style.transition = 'opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)';

        // Анимация самого меню (slide out вправо + fade out)
        burgerMenu.classList.remove('open');
        burgerMenu.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        
        // Принудительный reflow для запуска анимации
        burgerMenu.offsetHeight;
        
        // Анимация ухода вправо
        burgerMenu.style.transform = 'translateX(100%)';
        burgerMenu.style.opacity = '0';

        // Разблокируем скролл после начала анимации
        setTimeout(() => {
            unlockBodyScroll();
        }, 100);

        // Показываем navbar после начала анимации
        setTimeout(() => {
            if (mainNavbar) {
                mainNavbar.style.display = '';
            }
        }, 150);

        // Полное скрытие после завершения анимации
        setTimeout(() => {
            burgerMenu.classList.add('hidden');
            burgerOverlay.classList.add('hidden');
            burgerMenu.classList.remove('closing');
            
            // Сбрасываем стили
            burgerMenu.style.transform = '';
            burgerMenu.style.opacity = '';
            burgerMenu.style.transition = '';
            burgerOverlay.style.transition = '';
            
            menuItems.forEach(item => {
                item.style.opacity = '';
                item.style.transform = '';
                item.style.transition = '';
                item.style.willChange = '';
                item.classList.remove('animated');
            });
        }, 400);

        // Удаляем обработчик focus trap
        document.removeEventListener('keydown', trapFocus);

        // Возвращаем фокус на кнопку открытия
        setTimeout(() => {
            if (previousActiveElement && previousActiveElement !== document.body) {
                previousActiveElement.focus();
            } else {
                burgerBtn?.focus();
            }
        }, 450);

        // Тактильная обратная связь
        provideHapticFeedback('light');
    }

    /**
     * Обновление иконок темы
     */
    function updateThemeIcons() {
        const lightIcon = document.getElementById('burgerThemeIconLight');
        const darkIcon = document.getElementById('burgerThemeIconDark');
        
        if (!lightIcon || !darkIcon) return;
        
        const isLight = document.documentElement.classList.contains('light');
        if (isLight) {
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
        } else {
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
        }
    }

    /**
     * Переключение иконки бургера
     */
    function toggleBurgerIcon(isOpen) {
        const burgerIcon = document.getElementById('burgerIcon');
        const closeIcon = document.getElementById('burgerCloseIcon');
        
        if (burgerIcon && closeIcon) {
            if (isOpen) {
                burgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                burgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }
    }

    /**
     * Инициализация
     */
    function init() {
        // Устанавливаем начальные aria атрибуты
        burgerBtn.setAttribute('aria-expanded', 'false');
        burgerBtn.setAttribute('aria-controls', 'burgerMenu');
        burgerBtn.setAttribute('aria-label', burgerBtn.getAttribute('aria-label') || 'Открыть главное меню навигации');
        
        burgerMenu.setAttribute('aria-hidden', 'true');
        burgerMenu.setAttribute('role', 'dialog');
        burgerMenu.setAttribute('aria-modal', 'true');
        burgerMenu.setAttribute('aria-labelledby', 'burgerMenuTitle');
        burgerMenu.setAttribute('aria-describedby', 'burgerMenuDescription');

        // Улучшенная навигация с клавиатуры
        enhanceKeyboardNavigation();

        // Обработчики событий
        burgerBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (isOpen) {
                closeMenu();
            } else {
                openMenu();
            }
            toggleBurgerIcon(isOpen);
        });

        if (burgerCloseBtn) {
            burgerCloseBtn.setAttribute('aria-label', 'Закрыть главное меню навигации');
            burgerCloseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                closeMenu();
                toggleBurgerIcon(false);
            });
        }

        if (burgerOverlay) {
            burgerOverlay.addEventListener('click', () => {
                closeMenu();
                toggleBurgerIcon(false);
            });
        }

        // Закрытие по Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isOpen) {
                closeMenu();
                toggleBurgerIcon(false);
            }
        });

        // Закрытие при клике на ссылку
        const menuLinks = burgerMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMenu();
                toggleBurgerIcon(false);
            });
        });

        // Переключение темы в меню
        if (burgerThemeToggle && window.setTheme) {
            burgerThemeToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const currentTheme = window.getTheme();
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                window.setTheme(newTheme);
                
                // Обновляем иконки темы
                updateThemeIcons();
                
                // Haptic feedback (с учетом reduced-motion)
                provideHapticFeedback('light');
            });
        }

        // Обработка изменения ориентации
        function handleOrientationChange() {
            const isLandscape = window.innerWidth > window.innerHeight;
            if (isLandscape && isOpen) {
                burgerMenu.classList.toggle('landscape-mode', isLandscape);
            }
        }

        window.addEventListener('orientationchange', () => {
            setTimeout(handleOrientationChange, 100);
        });

        // Debounce для resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(handleOrientationChange, 250);
        });
    }

    // Экспорт функций для внешнего использования
    window.BurgerMenu = {
        open: openMenu,
        close: closeMenu,
        isOpen: () => isOpen,
        toggle: () => {
            if (isOpen) {
                closeMenu();
                toggleBurgerIcon(false);
            } else {
                openMenu();
                toggleBurgerIcon(true);
            }
        }
    };

    // Инициализация при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Слушаем изменения темы для обновления иконок
    if (window.MutationObserver) {
        const observer = new MutationObserver(() => {
            if (isOpen) {
                updateThemeIcons();
            }
        });
        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });
    }
})();
