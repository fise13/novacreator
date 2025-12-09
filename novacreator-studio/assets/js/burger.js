/**
 * Burger Menu Module
 * Консолидированная логика для мобильного меню
 * Включает focus trap, scroll lock, и accessibility улучшения
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
     * Focus trap - ловит фокус внутри меню
     */
    function trapFocus(e) {
        if (!isOpen) return;

        const focusableElements = burgerMenu.querySelectorAll(SELECTORS.focusableElements);
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

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
        }
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
     * Проверка prefers-reduced-motion
     */
    function prefersReducedMotion() {
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
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
        const reducedMotion = prefersReducedMotion();
        const menuItems = burgerMenu.querySelectorAll(SELECTORS.mobileMenuItems);
        
        if (!reducedMotion) {
            menuItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'all 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 50 + (index * 30));
            });
        } else {
            menuItems.forEach(item => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            });
        }

        // Анимация языка
        if (burgerLangGroup && !reducedMotion) {
            setTimeout(() => {
                burgerLangGroup.classList.add('lang-show');
            }, 80);
        } else if (burgerLangGroup) {
            burgerLangGroup.classList.add('lang-show');
        }

        // Устанавливаем стили
        setTimeout(() => {
            burgerOverlay.style.opacity = '1';
        }, 10);

        // Фокус на первый элемент
        const firstFocusable = burgerMenu.querySelector(SELECTORS.focusableElements);
        if (firstFocusable) {
            setTimeout(() => firstFocusable.focus(), 100);
        }

        // Добавляем обработчик для focus trap
        document.addEventListener('keydown', trapFocus);
    }

    /**
     * Закрытие меню
     */
    function closeMenu() {
        if (!isOpen) return;

        isOpen = false;

        // Обновляем aria атрибуты
        burgerBtn.setAttribute('aria-expanded', 'false');
        burgerMenu.setAttribute('aria-hidden', 'true');

        // Разблокируем скролл
        unlockBodyScroll();

        // Показываем navbar
        if (mainNavbar) {
            mainNavbar.style.display = '';
        }

        // Скрываем overlay и меню
        burgerOverlay.style.opacity = '0';

        if (burgerLangGroup) {
            burgerLangGroup.classList.remove('lang-show');
        }

        setTimeout(() => {
            burgerMenu.classList.add('hidden');
            burgerOverlay.classList.add('hidden');
        }, 300);

        // Удаляем обработчик focus trap
        document.removeEventListener('keydown', trapFocus);

        // Возвращаем фокус на кнопку открытия
        if (previousActiveElement && previousActiveElement !== document.body) {
            previousActiveElement.focus();
        } else {
            burgerBtn?.focus();
        }
    }

    /**
     * Инициализация
     */
    function init() {
        // Устанавливаем начальные aria атрибуты
        burgerBtn.setAttribute('aria-expanded', 'false');
        burgerBtn.setAttribute('aria-controls', 'burgerMenu');
        burgerMenu.setAttribute('aria-hidden', 'true');
        burgerMenu.setAttribute('role', 'dialog');
        burgerMenu.setAttribute('aria-modal', 'true');
        burgerMenu.setAttribute('aria-labelledby', 'burgerMenuTitle');

        // Обработчики событий
        burgerBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (isOpen) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        if (burgerCloseBtn) {
            burgerCloseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                closeMenu();
            });
        }

        if (burgerOverlay) {
            burgerOverlay.addEventListener('click', () => {
                closeMenu();
            });
        }

        // Закрытие по Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isOpen) {
                closeMenu();
            }
        });

        // Закрытие при клике на ссылку
        const menuLinks = burgerMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMenu();
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
                if (!prefersReducedMotion() && 'vibrate' in navigator) {
                    navigator.vibrate(10);
                }
            });
        }
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

    // Экспорт функций для внешнего использования
    window.BurgerMenu = {
        open: openMenu,
        close: closeMenu,
        isOpen: () => isOpen
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

