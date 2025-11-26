<?php
/**
 * Главная страница NovaCreator Studio
 * Современный дизайн с темной темой и неоновыми акцентами
 */

// Подключаем локализацию
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('seo.pages.index.breadcrumb');
$pageMetaTitle = t('seo.pages.index.title');
$pageMetaDescription = t('seo.pages.index.description');
$pageMetaKeywords = t('seo.pages.index.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24">
    <!-- Фоновые декоративные элементы - оптимизированы для мобильных -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 md:w-96 md:h-96 bg-neon-purple/20 rounded-full blur-2xl md:blur-3xl animate-pulse parallax" data-speed="0.3"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 md:w-96 md:h-96 bg-neon-blue/20 rounded-full blur-2xl md:blur-3xl animate-pulse parallax" data-speed="0.5" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-48 h-48 md:w-64 md:h-64 bg-neon-purple/10 rounded-full blur-xl md:blur-2xl animate-pulse parallax" data-speed="0.4" style="animation-delay: 0.5s;"></div>
        
        <!-- Плавающие частицы -->
        <div class="floating-particles" id="floatingParticles"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-5xl mx-auto animate-on-scroll">
            <?php
            // Загружаем варианты заголовков из переводов
            $headlinesData = json_decode(file_get_contents(__DIR__ . '/lang/' . $currentLang . '.json'), true);
            $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
            $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
            
            // Выбираем случайный вариант
            $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => '', 'subtitle' => ''];
            $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : '';
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
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon text-center w-full sm:w-auto min-h-[48px] flex items-center justify-center">
                    <?php echo htmlspecialchars(t('common.getStarted')); ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="btn-outline text-center w-full sm:w-auto min-h-[48px] flex items-center justify-center">
                    <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
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
            <h2 class="section-title"><?php echo htmlspecialchars(t('home.services.title')); ?></h2>
            <p class="section-subtitle">
                <?php echo htmlspecialchars(t('home.services.subtitle')); ?>
            </p>
        </div>
        
        <!-- Карточки услуг - оптимизированы для мобильных -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 lg:gap-8 px-4 md:px-0">
            <!-- SEO-оптимизация -->
            <div class="service-card animate-on-scroll">
                <div class="icon-wrapper w-14 h-14 md:w-16 md:h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-5 md:mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('home.services.seo.title')); ?></h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    <?php echo htmlspecialchars(t('common.readMore')); ?> →
                </a>
                <span class="text-gray-500 text-sm ml-4"><?php echo htmlspecialchars(t('common.or')); ?> <a href="<?php echo getLocalizedUrl($currentLang, '/calculator'); ?>" class="text-neon-purple hover:text-neon-blue"><?php echo htmlspecialchars(t('common.calculateCost')); ?></a></span>
            </div>
            
            <!-- Разработка сайтов -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="icon-wrapper w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('home.services.development.title')); ?></h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    <?php echo htmlspecialchars(t('common.readMore')); ?> →
                </a>
            </div>
            
            <!-- Google Ads -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="icon-wrapper w-14 h-14 md:w-16 md:h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-5 md:mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('home.services.ads.title')); ?></h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    <?php echo htmlspecialchars(t('common.readMore')); ?> →
                </a>
            </div>
            
            <!-- Маркетинг -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="icon-wrapper w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('home.services.marketing.title')); ?></h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    <?php echo htmlspecialchars(t('common.readMore')); ?> →
                </a>
            </div>
            
            <!-- Аналитика -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="icon-wrapper w-14 h-14 md:w-16 md:h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-5 md:mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('home.services.analytics.title')); ?></h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    <?php echo htmlspecialchars(t('common.readMore')); ?> →
                </a>
            </div>
            
            <!-- Конверсии -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.5s;">
                <div class="icon-wrapper w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('home.services.conversion.title')); ?></h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.services.conversion.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#conversion'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                    <?php echo htmlspecialchars(t('common.readMore')); ?> →
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
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4"><?php echo htmlspecialchars(t('home.stats.newCompany')); ?></div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg"><?php echo htmlspecialchars(t('home.stats.company')); ?></p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">
                    <span class="counter-number" data-target="10" data-suffix="+">0</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg"><?php echo htmlspecialchars(t('home.stats.yearsExperience')); ?></p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">
                    <span class="counter-number" data-target="2">0</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg"><?php echo htmlspecialchars(t('home.stats.professionals')); ?></p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gradient mb-2 md:mb-4">
                    <span class="counter-number" data-target="100" data-suffix="%">0</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base lg:text-lg"><?php echo htmlspecialchars(t('home.stats.onlineWork')); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы -->
<section class="py-16 md:py-24 lg:py-32">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16 lg:mb-20 animate-on-scroll">
            <h2 class="section-title"><?php echo htmlspecialchars(t('home.process.title')); ?></h2>
            <p class="section-subtitle">
                <?php echo htmlspecialchars(t('home.process.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 px-4 md:px-0">
            <div class="text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    1
                </div>
                <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars(t('home.process.step1.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    2
                </div>
                <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars(t('home.process.step2.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    3
                </div>
                <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars(t('home.process.step3.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                    4
                </div>
                <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars(t('home.process.step4.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('home.process.step4.description')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии и преимущества -->
<section class="py-16 md:py-24 lg:py-32 bg-dark-surface relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16 lg:mb-20 animate-on-scroll">
            <h2 class="section-title"><?php echo htmlspecialchars(t('home.guarantees.title')); ?></h2>
            <p class="section-subtitle">
                <?php echo htmlspecialchars(t('home.guarantees.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-5xl mx-auto">
            <!-- Пожизненная гарантия -->
            <div class="bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-2xl p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center mb-4">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gradient"><?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?></h3>
                </div>
                <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
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
                    <h3 class="text-2xl md:text-3xl font-bold text-gradient"><?php echo htmlspecialchars(t('home.guarantees.support.title')); ?></h3>
                </div>
                <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.guarantees.support.description')); ?>
                </p>
                <div class="mt-4 pt-4 border-t border-neon-blue/30">
                    <span class="inline-block bg-neon-blue/20 text-neon-blue px-3 py-1 rounded-full text-sm font-semibold">
                        <?php echo htmlspecialchars(t('common.limitedOffer')); ?>
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
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-300 mb-8 md:mb-12 px-4 md:px-0">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('common.getConsultation')); ?>
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
        const prefix = element.getAttribute('data-prefix') || '';
        const suffix = element.getAttribute('data-suffix') || '';
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = prefix + target + suffix;
                clearInterval(timer);
            } else {
                element.textContent = prefix + Math.floor(current) + suffix;
            }
        }, 16);
    };
    
    // Создаем observer для запуска анимации при появлении
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const currentText = entry.target.textContent.trim();
                // Проверяем, что счетчик еще не анимирован (начинается с 0 или пустой)
                if (currentText === '0' || currentText === '' || /^[+\-]?0[%]?$/.test(currentText)) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
});

// Скрипт для плавающих частиц в hero секции
document.addEventListener('DOMContentLoaded', function() {
    const particlesContainer = document.getElementById('floatingParticles');
    if (!particlesContainer) return;
    
    // Количество частиц (меньше на мобильных для производительности)
    const particleCount = window.innerWidth < 768 ? 15 : 30;
    const particles = [];
    
    // Создаем частицы
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Случайный размер
        const size = Math.random() < 0.4 ? 'particle-small' : 
                     Math.random() < 0.7 ? 'particle-medium' : 'particle-large';
        particle.classList.add(size);
        
        // Случайная начальная позиция
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        
        // Случайная задержка анимации
        particle.style.animationDelay = Math.random() * 5 + 's';
        particle.style.animationDuration = (12 + Math.random() * 13) + 's';
        
        particlesContainer.appendChild(particle);
        particles.push(particle);
    }
    
    // Анимация частиц при скролле (parallax эффект)
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const scrolled = window.pageYOffset;
                particles.forEach((particle, index) => {
                    const speed = 0.1 + (index % 3) * 0.05;
                    const yPos = -(scrolled * speed);
                    particle.style.transform = `translateY(${yPos}px)`;
                });
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
    
    // Анимация частиц при движении мыши (только на десктопе)
    if (window.innerWidth >= 768) {
        particlesContainer.addEventListener('mousemove', function(e) {
            const rect = particlesContainer.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            particles.forEach((particle, index) => {
                const rectParticle = particle.getBoundingClientRect();
                const particleX = rectParticle.left + rectParticle.width / 2;
                const particleY = rectParticle.top + rectParticle.height / 2;
                
                const dx = x - particleX;
                const dy = y - particleY;
                const distance = Math.sqrt(dx * dx + dy * dy);
                const maxDistance = 200;
                
                if (distance < maxDistance) {
                    const force = (maxDistance - distance) / maxDistance;
                    const moveX = (dx / distance) * force * 20;
                    const moveY = (dy / distance) * force * 20;
                    
                    particle.style.transform = `translate(${moveX}px, ${moveY}px)`;
                }
            });
        }, { passive: true });
    }
});
</script>

<?php include 'includes/footer.php'; ?>

