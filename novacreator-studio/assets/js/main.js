/**
 * Основной JavaScript файл для NovaCreator Studio
 * Содержит анимации, интерактивность и обработку форм
 */

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    initAnimations();
    initNavigation();
    initForms();
    initScrollEffects();
    initCounters();
    initProgressBars();
    initScrollProgress();
    initBackToTop();
    initPageLoadAnimation();
    initMagneticButtons();
});

/**
 * Инициализация анимаций при скролле
 * Элементы появляются плавно при прокрутке страницы
 * Оптимизировано для мобильных устройств
 */
function initAnimations() {
    // Проверяем, поддерживает ли устройство анимации (для экономии ресурсов на слабых устройствах)
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Создаем Intersection Observer для отслеживания видимости элементов
    // На мобильных используем более агрессивные настройки для производительности
    const isMobile = window.innerWidth < 768;
    const observerOptions = {
        threshold: isMobile ? 0.05 : 0.1, // На мобильных срабатывает раньше
        rootMargin: isMobile ? '0px 0px -30px 0px' : '0px 0px -50px 0px' // Меньший отступ на мобильных
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Добавляем класс для анимации
                entry.target.classList.add('animate-fade-in');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                // Отключаем наблюдение после анимации
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Находим все элементы с классом для анимации
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    animatedElements.forEach(element => {
        // Пропускаем анимацию, если пользователь предпочитает уменьшенное движение
        if (prefersReducedMotion) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
            return;
        }
        
        // Устанавливаем начальное состояние
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        // На мобильных используем более короткую анимацию для лучшей производительности
        const duration = isMobile ? '0.4s' : '0.6s';
        element.style.transition = `opacity ${duration} ease-out, transform ${duration} ease-out`;
        
        // Начинаем наблюдение
        observer.observe(element);
    });
}

/**
 * Инициализация навигации
 * Плавная прокрутка к якорям и активное состояние меню
 */
function initNavigation() {
    // Обработка кликов по ссылкам с якорями
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Пропускаем пустые якоря
            if (href === '#') return;
            
            e.preventDefault();
            
            const target = document.querySelector(href);
            if (target) {
                // Плавная прокрутка к элементу
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Изменение стиля навигации при скролле
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
}

/**
 * Инициализация обработки форм
 * Отправка данных через fetch API на backend
 */
function initForms() {
    const forms = document.querySelectorAll('.contact-form');
    
    forms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault(); // Предотвращаем стандартную отправку формы
            
            // Получаем кнопку отправки
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Показываем состояние загрузки
            submitBtn.disabled = true;
            submitBtn.textContent = 'Отправка...';
            
            // Собираем данные формы
            const formData = new FormData(form);
            
            try {
                // Отправляем запрос на сервер
                // Используем относительный путь для корректной работы на всех страницах
                const formAction = form.getAttribute('action') || './backend/send.php';
                const response = await fetch(formAction, {
                    method: 'POST',
                    body: formData
                });
                
                // Парсим JSON ответ
                const result = await response.json();
                
                if (result.success) {
                    // Успешная отправка
                    showNotification('Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.', 'success');
                    form.reset(); // Очищаем форму
                } else {
                    // Ошибка на сервере
                    showNotification(result.message || 'Произошла ошибка при отправке. Попробуйте позже.', 'error');
                }
            } catch (error) {
                // Ошибка сети или другая ошибка
                console.error('Ошибка отправки формы:', error);
                showNotification('Ошибка соединения. Проверьте интернет и попробуйте снова.', 'error');
            } finally {
                // Восстанавливаем кнопку
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    });
}

/**
 * Показ уведомления пользователю
 * Оптимизировано для мобильных устройств
 * @param {string} message - Текст уведомления
 * @param {string} type - Тип: 'success' или 'error'
 */
function showNotification(message, type = 'success') {
    // Определяем позицию для мобильных и десктопа
    const isMobile = window.innerWidth < 768;
    const positionClass = isMobile 
        ? 'top-4 left-4 right-4' // На мобильных занимает всю ширину
        : 'top-4 right-4'; // На десктопе справа
    
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `fixed ${positionClass} z-50 px-4 py-3 md:px-6 md:py-4 rounded-lg shadow-lg transform transition-all duration-300 text-sm md:text-base ${
        type === 'success' 
            ? 'bg-green-600 text-white' 
            : 'bg-red-600 text-white'
    }`;
    notification.textContent = message;
    
    // Добавляем на страницу
    document.body.appendChild(notification);
    
    // Анимация появления
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateX(0)';
    }, 10);
    
    // Удаляем через 5 секунд
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
}

/**
 * Дополнительные эффекты при скролле
 * Параллакс эффекты и другие визуальные улучшения
 */
function initScrollEffects() {
    // Эффект параллакса для фоновых элементов
    const parallaxElements = document.querySelectorAll('.parallax');
    
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });
    
    // Подсветка активного раздела в навигации
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    window.addEventListener('scroll', function() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (window.pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
}

/**
 * Плавное появление чисел (для статистики)
 * Анимация счетчика от 0 до целевого значения
 * @param {HTMLElement} element - Элемент для анимации
 * @param {number} target - Целевое значение
 * @param {string} prefix - Префикс (например, "+" или "-")
 * @param {string} suffix - Суффикс (например, "%")
 * @param {number} duration - Длительность анимации в миллисекундах
 */
function animateCounter(element, target, prefix = '', suffix = '', duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16); // 60 FPS для плавной анимации
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = prefix + target + suffix;
            clearInterval(timer);
        } else {
            element.textContent = prefix + Math.floor(start) + suffix;
        }
    }, 16);
}

/**
 * Инициализация счетчиков на странице
 * Анимация запускается, когда элемент появляется в viewport
 */
function initCounters() {
    const counterElements = document.querySelectorAll('.counter-number');
    
    if (counterElements.length === 0) return;
    
    // Сначала показываем финальные значения (для SEO и доступности)
    counterElements.forEach(element => {
        const target = parseInt(element.getAttribute('data-target')) || 0;
        const prefix = element.getAttribute('data-prefix') || '';
        const suffix = element.getAttribute('data-suffix') || '';
        // Показываем финальное значение по умолчанию
        element.textContent = prefix + target + suffix;
    });
    
    // Создаем Intersection Observer для отслеживания видимости
    const observerOptions = {
        threshold: 0.2, // Запускаем анимацию, когда элемент виден на 20%
        rootMargin: '0px 0px -100px 0px' // Запускаем раньше, когда элемент еще не полностью виден
    };
    
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const target = parseInt(element.getAttribute('data-target')) || 0;
                const prefix = element.getAttribute('data-prefix') || '';
                const suffix = element.getAttribute('data-suffix') || '';
                const duration = parseInt(element.getAttribute('data-duration')) || 2000;
                
                // Проверяем, не была ли уже запущена анимация
                if (!element.classList.contains('counter-animated')) {
                    element.classList.add('counter-animated');
                    // Устанавливаем 0 перед анимацией
                    element.textContent = prefix + '0' + suffix;
                    // Небольшая задержка для плавности
                    setTimeout(() => {
                        // Запускаем анимацию
                        animateCounter(element, target, prefix, suffix, duration);
                    }, 100);
                }
                
                // Отключаем наблюдение после запуска анимации
                counterObserver.unobserve(element);
            }
        });
    }, observerOptions);
    
    // Начинаем наблюдение за каждым счетчиком
    counterElements.forEach(element => {
        counterObserver.observe(element);
    });
}

/**
 * Инициализация анимации прогресс-баров
 * Прогресс-бары заполняются при появлении в viewport
 */
function initProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');
    
    if (progressBars.length === 0) return;
    
    // Создаем Intersection Observer для отслеживания видимости
    const observerOptions = {
        threshold: 0.2, // Запускаем когда видно 20%
        rootMargin: '0px 0px -50px 0px'
    };
    
    const progressObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const targetWidth = parseInt(bar.getAttribute('data-width')) || 0;
                
                // Проверяем, не была ли уже запущена анимация
                if (!bar.classList.contains('progress-animated')) {
                    bar.classList.add('progress-animated');
                    
                    // Устанавливаем начальную ширину 0
                    bar.style.width = '0%';
                    
                    // Небольшая задержка для плавности
                    setTimeout(() => {
                        // Анимация заполнения прогресс-бара
                        let currentWidth = 0;
                        const duration = 2000; // 2 секунды для плавности
                        const increment = targetWidth / (duration / 16); // 60 FPS
                        
                        const timer = setInterval(() => {
                            currentWidth += increment;
                            if (currentWidth >= targetWidth) {
                                bar.style.width = targetWidth + '%';
                                clearInterval(timer);
                            } else {
                                bar.style.width = Math.floor(currentWidth) + '%';
                            }
                        }, 16);
                    }, 200); // Задержка 200ms для синхронизации со счетчиками
                }
                
                // Отключаем наблюдение после запуска анимации
                progressObserver.unobserve(bar);
            }
        });
    }, observerOptions);
    
    // Начинаем наблюдение за каждым прогресс-баром
    progressBars.forEach(bar => {
        progressObserver.observe(bar);
    });
}

/**
 * Индикатор прогресса прокрутки страницы
 * Показывает, сколько страницы уже прочитано
 */
function initScrollProgress() {
    const progressBar = document.querySelector('.scroll-progress-bar');
    if (!progressBar) return;
    
    window.addEventListener('scroll', function() {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.pageYOffset / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });
}

/**
 * Кнопка "Наверх"
 * Появляется при скролле вниз и плавно прокручивает наверх
 */
function initBackToTop() {
    const backToTopBtn = document.getElementById('backToTop');
    if (!backToTopBtn) return;
    
    // Показываем/скрываем кнопку при скролле
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            backToTopBtn.classList.add('opacity-100');
        } else {
            backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
            backToTopBtn.classList.remove('opacity-100');
        }
    });
    
    // Плавная прокрутка наверх при клике
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Анимация загрузки страницы
 * Плавное появление контента при первой загрузке
 */
function initPageLoadAnimation() {
    // Добавляем класс для анимации загрузки
    document.body.classList.add('page-loaded');
    
    // Плавное появление основных элементов
    const mainElements = document.querySelectorAll('section, header, footer');
    mainElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 50); // Последовательное появление
    });
}

/**
 * Эффект "магнитного" курсора для кнопок
 * Кнопки слегка притягивают курсор при наведении
 */
function initMagneticButtons() {
    const magneticButtons = document.querySelectorAll('.btn-neon, .btn-outline, a[href^="#"]');
    
    magneticButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transition = 'transform 0.3s ease-out';
        });
        
        button.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            // Небольшое смещение (магнитный эффект)
            const moveX = x * 0.15;
            const moveY = y * 0.15;
            
            this.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.05)`;
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(0, 0) scale(1)';
        });
    });
}

// Экспортируем функции для использования в других скриптах
window.NovaCreator = {
    animateCounter,
    showNotification,
    initCounters,
    initProgressBars,
    initScrollProgress,
    initBackToTop,
    initMagneticButtons
};

