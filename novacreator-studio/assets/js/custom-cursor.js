/**
 * Кастомные курсоры для интерактивных элементов
 * Создает динамические курсоры, которые следуют за мышью
 */

(function() {
    'use strict';
    
    // Проверяем, что это не мобильное устройство
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || 
                     (window.matchMedia && window.matchMedia('(pointer: coarse)').matches);
    
    if (isMobile) {
        return; // Не используем кастомные курсоры на мобильных
    }
    
    // Проверяем поддержку reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Создаем кастомный курсор
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.innerHTML = '<div class="cursor-dot"></div><div class="cursor-outline"></div>';
    document.body.appendChild(cursor);
    
    // Создаем курсор для клика
    const cursorClick = document.createElement('div');
    cursorClick.className = 'custom-cursor-click';
    document.body.appendChild(cursorClick);
    
    let mouseX = 0;
    let mouseY = 0;
    let cursorX = 0;
    let cursorY = 0;
    let outlineX = 0;
    let outlineY = 0;
    let isHovering = false;
    let isClicking = false;
    
    // Получаем элементы курсора
    const cursorDot = cursor.querySelector('.cursor-dot');
    const cursorOutline = cursor.querySelector('.cursor-outline');
    
    // Функция для обновления позиции курсора
    function updateCursor() {
        // Плавное следование точки за мышью
        cursorX += (mouseX - cursorX) * 0.1;
        cursorY += (mouseY - cursorY) * 0.1;
        
        // Более медленное следование обводки
        outlineX += (mouseX - outlineX) * 0.05;
        outlineY += (mouseY - outlineY) * 0.05;
        
        // Применяем позиции
        if (cursorDot) {
            cursorDot.style.transform = `translate(${cursorX}px, ${cursorY}px)`;
        }
        if (cursorOutline) {
            cursorOutline.style.transform = `translate(${outlineX}px, ${outlineY}px)`;
        }
        if (cursorClick) {
            cursorClick.style.transform = `translate(${mouseX}px, ${mouseY}px)`;
        }
        
        requestAnimationFrame(updateCursor);
    }
    
    // Отслеживание движения мыши
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });
    
    // Определение интерактивных элементов
    const interactiveSelectors = [
        'a',
        'button',
        '[role="button"]',
        'input[type="submit"]',
        'input[type="button"]',
        '.btn-apple',
        '.service-card-option',
        '.portfolio-item',
        '.nav-link',
        'select',
        'textarea',
        '[onclick]',
        '[tabindex]:not([tabindex="-1"])'
    ];
    
    // Функция для проверки, является ли элемент интерактивным
    function isInteractive(element) {
        if (!element) return false;
        
        // Проверяем по селекторам
        for (const selector of interactiveSelectors) {
            if (element.matches && element.matches(selector)) {
                return true;
            }
        }
        
        // Проверяем родительские элементы
        let parent = element.parentElement;
        while (parent && parent !== document.body) {
            for (const selector of interactiveSelectors) {
                if (parent.matches && parent.matches(selector)) {
                    return true;
                }
            }
            parent = parent.parentElement;
        }
        
        return false;
    }
    
    // Обработка наведения на элементы
    function handleMouseEnter(e) {
        const element = e.target;
        
        if (isInteractive(element)) {
            isHovering = true;
            cursor.classList.add('cursor-hover');
            
            // Специальные стили для разных типов элементов
            if (element.matches('a[href^="http"]') || element.matches('a[href^="/"]')) {
                cursor.classList.add('cursor-link');
            } else if (element.matches('button') || element.matches('[role="button"]')) {
                cursor.classList.add('cursor-button');
            } else if (element.matches('input') || element.matches('textarea') || element.matches('select')) {
                cursor.classList.add('cursor-input');
            } else if (element.matches('.portfolio-item') || element.matches('.service-card-option')) {
                cursor.classList.add('cursor-card');
            }
        }
    }
    
    function handleMouseLeave(e) {
        isHovering = false;
        cursor.classList.remove('cursor-hover', 'cursor-link', 'cursor-button', 'cursor-input', 'cursor-card');
    }
    
    // Обработка клика
    function handleMouseDown() {
        isClicking = true;
        cursor.classList.add('cursor-click');
        cursorClick.classList.add('active');
    }
    
    function handleMouseUp() {
        isClicking = false;
        cursor.classList.remove('cursor-click');
        cursorClick.classList.remove('active');
    }
    
    // Добавляем обработчики событий
    document.addEventListener('mouseenter', handleMouseEnter, true);
    document.addEventListener('mouseleave', handleMouseLeave, true);
    document.addEventListener('mousedown', handleMouseDown);
    document.addEventListener('mouseup', handleMouseUp);
    
    // Скрываем стандартный курсор
    document.body.style.cursor = 'none';
    
    // Показываем кастомный курсор
    cursor.style.opacity = '1';
    
    // Запускаем анимацию
    updateCursor();
    
    // Скрываем курсор при выходе за пределы окна
    document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
    });
    
    document.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
    });
    
    // Экспорт для внешнего использования
    window.CustomCursor = {
        show: () => { cursor.style.opacity = '1'; },
        hide: () => { cursor.style.opacity = '0'; },
        setHover: (hover) => {
            if (hover) {
                cursor.classList.add('cursor-hover');
            } else {
                cursor.classList.remove('cursor-hover');
            }
        }
    };
})();

