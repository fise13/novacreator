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
});

/**
 * Инициализация анимаций при скролле
 * Элементы появляются плавно при прокрутке страницы
 */
function initAnimations() {
    // Создаем Intersection Observer для отслеживания видимости элементов
    const observerOptions = {
        threshold: 0.1, // Элемент считается видимым при 10% появления
        rootMargin: '0px 0px -50px 0px' // Небольшой отступ снизу
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
        // Устанавливаем начальное состояние
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        
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
                const response = await fetch('/backend/send.php', {
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
 * @param {string} message - Текст уведомления
 * @param {string} type - Тип: 'success' или 'error'
 */
function showNotification(message, type = 'success') {
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ${
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
 */
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16); // 60 FPS
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// Экспортируем функции для использования в других скриптах
window.NovaCreator = {
    animateCounter,
    showNotification
};

