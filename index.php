<?php
/**
 * Главная страница NovaCreator Studio
 * Современный дизайн с темной темой и неоновыми акцентами
 */
$pageTitle = 'Главная';
$pageMetaTitle = 'NovaCreator Studio - Digital агентство | SEO, разработка сайтов, маркетинг';
$pageMetaDescription = 'Профессиональное digital-агентство NovaCreator Studio. SEO-продвижение, разработка сайтов, Google Ads и маркетинговые стратегии. Работаем онлайн по всему миру. Опыт работы с motorland.kz.';
$pageMetaKeywords = 'digital агентство, SEO продвижение, разработка сайтов, Google Ads, контекстная реклама, маркетинг, веб-разработка, интернет-маркетинг, продвижение сайтов';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
    <!-- Фоновые декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-neon-purple/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-5xl mx-auto animate-on-scroll">
            <!-- Заголовок -->
            <h1 class="text-5xl md:text-6xl lg:text-8xl font-bold mb-6 leading-tight">
                <span class="text-gradient">Растим бизнес</span><br>
                в цифровом пространстве
            </h1>
            
            <!-- Подзаголовок -->
            <p class="text-xl md:text-2xl text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed">
                SEO-продвижение, разработка сайтов и маркетинговые стратегии, 
                которые приносят результат. Ваш успех — наша миссия.
            </p>
            
            <!-- CTA кнопки -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="contact.php" class="btn-neon">
                    Начать проект
                </a>
                <a href="portfolio.php" class="btn-outline">
                    Посмотреть работы
                </a>
            </div>
        </div>
    </div>
    
    <!-- Стрелка вниз -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Услуги -->
<section id="services" class="py-32 relative">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <!-- Заголовок секции -->
        <div class="text-center mb-20 animate-on-scroll">
            <h2 class="section-title">Наши услуги</h2>
            <p class="section-subtitle">
                Комплексные решения для digital-продвижения вашего бизнеса
            </p>
        </div>
        
        <!-- Карточки услуг -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- SEO-оптимизация -->
            <div class="service-card animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">SEO-оптимизация</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Выводим ваш сайт в топ поисковых систем. Комплексная оптимизация, 
                    технический аудит и постоянный мониторинг результатов.
                </p>
                <a href="seo.php" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
            
            <!-- Разработка сайтов -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Разработка сайтов</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Современные, быстрые и адаптивные сайты. От лендингов до сложных 
                    веб-приложений. Качество и скорость в каждом проекте.
                </p>
                <a href="services.php#development" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
            
            <!-- Google Ads -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Google Ads</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Контекстная реклама под ключ. Настройка, запуск и оптимизация 
                    кампаний для максимальной конверсии и ROI.
                </p>
                <a href="ads.php" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
            
            <!-- Маркетинг -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Маркетинг</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Разработка и внедрение маркетинговых стратегий. SMM, контент-маркетинг, 
                    email-рассылки и многое другое.
                </p>
                <a href="services.php#marketing" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
            
            <!-- Аналитика -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Аналитика</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Глубокий анализ данных и метрик. Отслеживание конверсий, 
                    оптимизация воронок продаж и рост эффективности.
                </p>
                <a href="services.php#analytics" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
            
            <!-- Конверсии -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.5s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Рост конверсий</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Увеличиваем конверсию сайта через A/B тестирование, 
                    оптимизацию UX и внедрение лучших практик.
                </p>
                <a href="services.php#conversion" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Статистика -->
<section class="py-32 bg-dark-surface relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">Новая</div>
                <p class="text-gray-400 text-lg">Компания</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4" data-target="10">0</div>
                <p class="text-gray-400 text-lg">Лет опыта команды</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">2</div>
                <p class="text-gray-400 text-lg">Профессионала</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">100%</div>
                <p class="text-gray-400 text-lg">Онлайн работа</p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы -->
<section class="py-32">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-20 animate-on-scroll">
            <h2 class="section-title">Как мы работаем</h2>
            <p class="section-subtitle">
                Четкий процесс от первого контакта до достижения результатов
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    1
                </div>
                <h3 class="text-xl font-bold mb-4">Анализ</h3>
                <p class="text-gray-400">
                    Изучаем ваш бизнес, конкурентов и целевую аудиторию
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    2
                </div>
                <h3 class="text-xl font-bold mb-4">Стратегия</h3>
                <p class="text-gray-400">
                    Разрабатываем индивидуальную стратегию продвижения
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    3
                </div>
                <h3 class="text-xl font-bold mb-4">Реализация</h3>
                <p class="text-gray-400">
                    Внедряем решения и запускаем кампании
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    4
                </div>
                <h3 class="text-xl font-bold mb-4">Оптимизация</h3>
                <p class="text-gray-400">
                    Постоянно улучшаем результаты и масштабируем успех
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Готовы начать расти?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Свяжитесь с нами сегодня и получите бесплатную консультацию 
                по продвижению вашего бизнеса в интернете.
            </p>
            <a href="contact.php" class="btn-neon inline-block">
                Получить консультацию
            </a>
        </div>
    </div>
</section>

<!-- Скрипт для анимации счетчиков -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('[data-target]');
    
    const animateCounter = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    };
    
    // Создаем observer для запуска анимации при появлении
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.textContent === '0') {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
});
</script>

<?php include 'includes/footer.php'; ?>

