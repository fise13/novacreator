<?php
/**
 * Главная страница NovaCreator Studio
 * Современный дизайн с темной темой и неоновыми акцентами
 */
$pageTitle = 'Главная';
$pageMetaTitle = 'NovaCreator Studio - Digital агентство | SEO, разработка сайтов, маркетинг';
$pageMetaDescription = 'Профессиональное digital-агентство NovaCreator Studio. SEO-продвижение, разработка сайтов, Google Ads и маркетинговые стратегии. Молодая компания с большим стажем работы команды. Работаем онлайн по всему миру.';
$pageMetaKeywords = 'digital агентство, SEO продвижение, разработка сайтов, Google Ads, контекстная реклама, маркетинг, веб-разработка, интернет-маркетинг, продвижение сайтов';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
    <!-- Фоновые декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-neon-purple/20 rounded-full blur-3xl animate-pulse parallax" data-speed="0.3"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse parallax" data-speed="0.5" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-neon-purple/10 rounded-full blur-2xl animate-pulse parallax" data-speed="0.4" style="animation-delay: 0.5s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-5xl mx-auto animate-on-scroll">
            <?php
            // Варианты заголовков (ротация при каждом обновлении)
            $headlines = [
                [
                    'title' => 'Растим бизнес',
                    'subtitle' => 'в цифровом пространстве'
                ],
                [
                    'title' => 'Превращаем идеи',
                    'subtitle' => 'в цифровой успех'
                ],
                [
                    'title' => 'Увеличиваем продажи',
                    'subtitle' => 'через интернет-маркетинг'
                ],
                [
                    'title' => 'Выводим в топ',
                    'subtitle' => 'и привлекаем клиентов'
                ],
                [
                    'title' => 'Создаем сайты',
                    'subtitle' => 'которые продают'
                ]
            ];
            
            // Варианты подзаголовков
            $descriptions = [
                'SEO-продвижение, разработка сайтов и маркетинговые стратегии, которые приносят результат. Работаем с клиентами по всему Казахстану: Алматы, Астана, Шымкент и другие города. Ваш успех — наша миссия.',
                'Профессиональное digital-агентство с опытом работы более 10 лет. Помогаем бизнесу расти в интернете через SEO, контекстную рекламу и разработку. Работаем онлайн по всему Казахстану.',
                'Комплексные решения для digital-продвижения вашего бизнеса. От технического SEO до настройки рекламных кампаний — всё для роста вашей компании. Клиенты из Алматы, Астаны, Шымкента и других городов.',
                'Новое агентство с большим опытом команды. Выводим сайты в топ поисковых систем, создаем продающие сайты и настраиваем эффективную рекламу. Ваш рост — наша цель.',
                'Digital-маркетинг, который работает. SEO-оптимизация, разработка сайтов, Google Ads и аналитика. Работаем с компаниями по всему Казахстану и помогаем достигать результатов.'
            ];
            
            // Выбираем случайный вариант
            $randomHeadline = $headlines[array_rand($headlines)];
            $randomDescription = $descriptions[array_rand($descriptions)];
            ?>
            
            <!-- Заголовок H1 (главный для SEO) -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl font-bold mb-4 md:mb-6 leading-tight px-4 md:px-0">
                <span class="text-gradient"><?php echo htmlspecialchars($randomHeadline['title']); ?></span><br>
                <?php echo htmlspecialchars($randomHeadline['subtitle']); ?>
            </h1>
            
            <!-- Подзаголовок -->
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-400 mb-8 md:mb-12 max-w-3xl mx-auto leading-relaxed px-4 md:px-0">
                <?php echo htmlspecialchars($randomDescription); ?>
            </p>
            
            <!-- CTA кнопки - оптимизированы для мобильных -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4 md:gap-6 px-4 md:px-0">
                <a href="/contact" class="btn-neon text-center w-full sm:w-auto">
                    Начать проект
                </a>
                <a href="/portfolio" class="btn-outline text-center w-full sm:w-auto">
                    Посмотреть работы
                </a>
            </div>
        </div>
    </div>
    
    <!-- Стрелка вниз - скрыта на очень маленьких экранах -->
    <div class="absolute bottom-6 md:bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <svg class="w-5 h-5 md:w-6 md:h-6 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        
        <!-- Карточки услуг - оптимизированы для мобильных -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8 px-4 md:px-0">
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
                    технический аудит и постоянный мониторинг результатов. Работаем с клиентами 
                    по всему Казахстану: Алматы, Астана, Шымкент и другие города.
                </p>
                <a href="/seo" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
                <span class="text-gray-500 text-sm ml-4">или <a href="/calculator" class="text-neon-purple hover:text-neon-blue">рассчитать стоимость</a></span>
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
                <a href="/services#development" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
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
                <a href="/ads" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
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
                <a href="/services#marketing" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
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
                <a href="/services#analytics" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
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
                <a href="/services#conversion" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    Узнать больше →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Статистика -->
<section class="py-16 md:py-24 lg:py-32 bg-dark-surface relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
            <div class="text-center animate-on-scroll">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">Новая</div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg">Компания</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">
                    <span class="counter-number" data-target="10" data-suffix="+">0</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg">Лет опыта команды</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">
                    <span class="counter-number" data-target="2">0</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg">Профессионала</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">
                    <span class="counter-number" data-target="100" data-suffix="%">0</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg">Онлайн работа</p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы -->
<section class="py-16 md:py-24 lg:py-32">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16 lg:mb-20 animate-on-scroll">
            <h2 class="section-title">Как мы работаем</h2>
            <p class="section-subtitle">
                Четкий процесс от первого контакта до достижения результатов
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 px-4 md:px-0">
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

<!-- Гарантии и преимущества -->
<section class="py-16 md:py-24 lg:py-32 bg-dark-surface relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16 lg:mb-20 animate-on-scroll">
            <h2 class="section-title">Наши гарантии</h2>
            <p class="section-subtitle">
                Мы уверены в качестве нашей работы и готовы это доказать
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-5xl mx-auto">
            <!-- Пожизненная гарантия -->
            <div class="bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-2xl p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gradient">Пожизненная гарантия</h3>
                </div>
                <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                    Мы даем <strong class="text-white">пожизненную гарантию</strong> на все наши работы. 
                    Если возникнут проблемы с сайтом или продвижением, мы исправим их бесплатно. 
                    Ваш успех — наш приоритет.
                </p>
            </div>
            
            <!-- Поддержка для первых клиентов -->
            <div class="bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 border border-neon-blue/30 rounded-2xl p-6 md:p-8 animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gradient">6 месяцев поддержки</h3>
                </div>
                <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                    В честь открытия нашей компании, <strong class="text-white">первым клиентам</strong> мы предоставляем 
                    <strong class="text-white">бесплатную поддержку в течение 6 месяцев</strong>. 
                    Консультации, доработки и помощь — всё включено!
                </p>
                <div class="mt-4 pt-4 border-t border-neon-blue/30">
                    <span class="inline-block bg-neon-blue/20 text-neon-blue px-3 py-1 rounded-full text-sm font-semibold">
                        Ограниченное предложение
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-16 md:py-24 lg:py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 md:mb-6">
                Готовы начать расти?
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-300 mb-8 md:mb-12 px-4 md:px-0">
                Свяжитесь с нами сегодня и получите бесплатную консультацию 
                по продвижению вашего бизнеса в интернете.
            </p>
            <a href="/contact" class="btn-neon inline-block">
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

