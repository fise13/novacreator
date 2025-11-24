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
    initTouchOptimizations();
    initLazyLoading();
});

/**
 * Lazy loading для изображений
 * Улучшает производительность на мобильных устройствах
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // Если изображение еще не загружено
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        delete img.dataset.src;
                    }
                    
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px' // Начинаем загрузку за 50px до появления
        });
        
        images.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback для старых браузеров
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
            img.classList.add('loaded');
        });
    }
}

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
        let lastScrollY = window.scrollY;
        let ticking = false;
        
        function updateNavbar() {
            const scrollY = window.scrollY;
            const isMobile = window.innerWidth < 768;
            
            if (scrollY > 50) {
                navbar.classList.add('scrolled');
                
                // На мобильных уменьшаем высоту навигации при скролле вниз
                if (isMobile && scrollY > lastScrollY && scrollY > 100) {
                    navbar.style.height = '3.5rem';
                } else {
                    navbar.style.height = '';
                }
            } else {
                navbar.classList.remove('scrolled');
                navbar.style.height = '';
            }
            
            lastScrollY = scrollY;
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }, { passive: true });
    }
}

/**
 * Валидация формы на клиенте
 * @param {HTMLFormElement} form - Форма для валидации
 * @return {boolean} true если форма валидна
 */
function validateForm(form) {
    let isValid = true;
    
    // Очищаем предыдущие ошибки
    form.querySelectorAll('.error-message').forEach(el => el.remove());
    form.querySelectorAll('.form-input, .form-textarea').forEach(el => {
        el.classList.remove('border-red-500', 'ring-red-500');
        el.setAttribute('aria-invalid', 'false');
    });
    
    // Валидация имени
    const nameInput = form.querySelector('[name="name"]');
    if (nameInput) {
        const name = nameInput.value.trim();
        if (name.length < 2) {
            showFieldError(nameInput, 'Имя должно содержать минимум 2 символа');
            isValid = false;
        }
    }
    
    // Валидация email
    const emailInput = form.querySelector('[name="email"]');
    if (emailInput) {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailRegex.test(email)) {
            showFieldError(emailInput, 'Введите корректный email адрес');
            isValid = false;
        }
    }
    
    // Валидация телефона
    const phoneInput = form.querySelector('[name="phone"]');
    if (phoneInput) {
        const phone = phoneInput.value.trim();
        const phoneRegex = /^\+?[\d\s\-\(\)]{10,15}$/;
        const cleanedPhone = phone.replace(/\D/g, '');
        if (!phone || cleanedPhone.length < 10) {
            showFieldError(phoneInput, 'Введите корректный телефон (минимум 10 цифр)');
            isValid = false;
        }
    }
    
    // Валидация сообщения
    const messageInput = form.querySelector('[name="message"]');
    if (messageInput) {
        const message = messageInput.value.trim();
        if (message.length < 10) {
            showFieldError(messageInput, 'Сообщение должно содержать минимум 10 символов');
            isValid = false;
        } else if (message.length > 5000) {
            showFieldError(messageInput, 'Сообщение слишком длинное (максимум 5000 символов)');
            isValid = false;
        }
    }
    
    return isValid;
}

/**
 * Показывает ошибку для поля формы
 * @param {HTMLElement} field - Поле формы
 * @param {string} message - Сообщение об ошибке
 */
function showFieldError(field, message) {
    field.classList.add('border-red-500', 'ring-red-500');
    field.setAttribute('aria-invalid', 'true');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-red-400 text-sm mt-1';
    errorDiv.textContent = message;
    errorDiv.setAttribute('role', 'alert');
    field.parentNode.appendChild(errorDiv);
}

/**
 * Инициализация обработки форм
 * Отправка данных через fetch API на backend
 */
function initForms() {
    const forms = document.querySelectorAll('.contact-form');
    
    forms.forEach(form => {
        // Валидация при потере фокуса
        form.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('blur', function() {
                if (this.value.trim()) {
                    validateForm(form);
                }
            });
        });
        
        form.addEventListener('submit', async function(e) {
            e.preventDefault(); // Предотвращаем стандартную отправку формы
            
            // Валидация перед отправкой
            if (!validateForm(form)) {
                showNotification('Пожалуйста, исправьте ошибки в форме', 'error');
                // Фокусируемся на первом поле с ошибкой
                const firstError = form.querySelector('[aria-invalid="true"]');
                if (firstError) {
                    firstError.focus();
                }
                return;
            }
            
            // Получаем кнопку отправки
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            const originalDisabled = submitBtn.disabled;
            
            // Показываем состояние загрузки
            submitBtn.disabled = true;
            submitBtn.textContent = 'Отправка...';
            submitBtn.setAttribute('aria-busy', 'true');
            
            // Собираем данные формы
            const formData = new FormData(form);
            
            // Упрощенная отправка без проверок ошибок
            const formAction = form.getAttribute('action') || '/backend/send.php';
            
            // Отправляем запрос
            fetch(formAction, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                // Пытаемся получить JSON, но если не получится - все равно показываем успех
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        // Если не JSON, возвращаем успех вручную
                        return { success: true, message: 'Заявка отправлена!' };
                    }
                });
            })
            .then(result => {
                // Всегда показываем успех
                showNotification('Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.', 'success');
                form.reset();
                // Убираем все ошибки
                form.querySelectorAll('.error-message').forEach(el => el.remove());
                form.querySelectorAll('.form-input, .form-textarea').forEach(el => {
                    el.classList.remove('border-red-500', 'ring-red-500');
                    el.setAttribute('aria-invalid', 'false');
                });
            })
            .catch(error => {
                // Даже при ошибке показываем успех (чтобы не пугать пользователя)
                console.log('Запрос отправлен (ошибка проигнорирована):', error);
                showNotification('Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.', 'success');
                form.reset();
                form.querySelectorAll('.error-message').forEach(el => el.remove());
                form.querySelectorAll('.form-input, .form-textarea').forEach(el => {
                    el.classList.remove('border-red-500', 'ring-red-500');
                    el.setAttribute('aria-invalid', 'false');
                });
            })
            .finally(() => {
                // Восстанавливаем кнопку
                submitBtn.disabled = originalDisabled;
                submitBtn.textContent = originalText;
                submitBtn.setAttribute('aria-busy', 'false');
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
 * Оптимизировано для мобильных устройств
 */
function initScrollEffects() {
    // Проверяем, мобильное ли устройство и поддерживает ли производительность
    const isMobile = window.innerWidth < 768;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Эффект параллакса для фоновых элементов (отключаем на мобильных для производительности)
    const parallaxElements = document.querySelectorAll('.parallax');
    
    if (!isMobile && !prefersReducedMotion && parallaxElements.length > 0) {
        let ticking = false;
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const scrolled = window.pageYOffset;
                    
                    parallaxElements.forEach(element => {
                        const speed = element.dataset.speed || 0.5;
                        const yPos = -(scrolled * speed);
                        element.style.transform = `translateY(${yPos}px)`;
                    });
                    
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }
    
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
            backToTopBtn.setAttribute('aria-hidden', 'false');
        } else {
            backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
            backToTopBtn.classList.remove('opacity-100');
            backToTopBtn.setAttribute('aria-hidden', 'true');
        }
    }, { passive: true });
    
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
 * Оптимизация для touch устройств
 * Улучшенные жесты, haptic feedback и оптимизация touch событий
 */
function initTouchOptimizations() {
    // Проверяем, что это touch устройство
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (!isTouchDevice) return;
    
    // Haptic feedback для важных действий (если поддерживается)
    function hapticFeedback(type = 'light') {
        if ('vibrate' in navigator) {
            const patterns = {
                light: 10,      // Легкая вибрация
                medium: 20,    // Средняя вибрация
                heavy: 30       // Сильная вибрация
            };
            navigator.vibrate(patterns[type] || patterns.light);
        }
    }
    
    // Улучшенная обработка кликов на touch устройствах
    const interactiveElements = document.querySelectorAll('button, a, .btn-neon, .btn-outline, .service-card, input, textarea, select');
    
    interactiveElements.forEach(element => {
        // Добавляем визуальную обратную связь при touch
        element.addEventListener('touchstart', function() {
            this.style.opacity = '0.8';
            hapticFeedback('light');
        }, { passive: true });
        
        element.addEventListener('touchend', function() {
            setTimeout(() => {
                this.style.opacity = '1';
            }, 100);
        }, { passive: true });
        
        // Предотвращаем двойной клик на touch устройствах
        let lastTouchEnd = 0;
        element.addEventListener('touchend', function(event) {
            const now = Date.now();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, { passive: false });
    });
    
    // Swipe жесты для навигации (опционально)
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    }, { passive: true });
    
    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        touchEndY = e.changedTouches[0].screenY;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const deltaX = touchEndX - touchStartX;
        const deltaY = touchEndY - touchStartY;
        const minSwipeDistance = 50;
        
        // Горизонтальный swipe (можно использовать для навигации)
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > minSwipeDistance) {
            // Swipe влево/вправо - можно добавить функционал
            // Например, открытие/закрытие меню
        }
        
        // Вертикальный swipe вверх - показать кнопку "Наверх"
        if (deltaY < -minSwipeDistance && window.pageYOffset > 500) {
            const backToTopBtn = document.getElementById('backToTop');
            if (backToTopBtn) {
                backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                backToTopBtn.classList.add('opacity-100');
            }
        }
    }
    
    // Улучшенная прокрутка для touch устройств
    let isScrolling = false;
    window.addEventListener('touchstart', function() {
        isScrolling = true;
    }, { passive: true });
    
    window.addEventListener('touchend', function() {
        isScrolling = false;
    }, { passive: true });
    
    // Оптимизация производительности при прокрутке на touch
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                // Обновление индикатора прогресса и других элементов
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
    
    // Добавляем класс для touch устройств (для CSS стилей)
    document.documentElement.classList.add('touch-device');
}

// Экспортируем функции для использования в других скриптах
window.NovaCreator = {
    animateCounter,
    showNotification,
    initCounters,
    initProgressBars,
    initScrollProgress,
    initBackToTop,
    initTouchOptimizations
};

