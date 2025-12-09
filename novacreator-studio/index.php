<?php
/**
 * Главная страница NovaCreator Studio
 * Новый дизайн в стиле holymedia.kz/seo
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

<!-- Hero секция - новый дизайн -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-white pt-20 md:pt-24">
    <!-- Фоновые декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Градиентные круги -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] bg-blue-100 rounded-full blur-3xl animate-pulse opacity-40" style="animation-duration: 4s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] bg-purple-100 rounded-full blur-3xl animate-pulse opacity-40" style="animation-delay: 1.5s; animation-duration: 5s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="text-center animate-on-scroll">
                <?php
                // Загружаем варианты заголовков из переводов
                $headlinesData = json_decode(file_get_contents(__DIR__ . '/lang/' . $currentLang . '.json'), true);
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                
                // Выбираем случайный вариант
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => '', 'subtitle' => ''];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : '';
                ?>
                
                <!-- Бейдж -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200 mb-8 animate-on-scroll" style="animation-delay: 0.1s;">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs uppercase tracking-wider text-blue-600 font-semibold">
                        <?php echo $currentLang === 'en' ? 'Digital Agency' : 'Цифровое агентство'; ?>
                    </span>
                </div>
                
                <!-- Заголовок H1 -->
                <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold mb-8 md:mb-10 leading-tight animate-on-scroll" style="animation-delay: 0.2s;">
                    <span class="block mb-4 text-gray-900"><?php echo htmlspecialchars($randomHeadline['title']); ?></span>
                    <span class="block bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-clip-text text-transparent animate-gradient"><?php echo htmlspecialchars($randomHeadline['subtitle']); ?></span>
                </h1>
                
                <!-- Подзаголовок -->
                <p class="text-xl sm:text-2xl md:text-3xl text-gray-600 mb-12 md:mb-16 max-w-4xl mx-auto leading-relaxed animate-on-scroll" style="animation-delay: 0.3s;">
                    <?php echo htmlspecialchars($randomDescription); ?>
                </p>
                
                <!-- CTA кнопки -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 md:gap-8 animate-on-scroll" style="animation-delay: 0.4s;">
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative px-8 py-4 md:px-12 md:py-5 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-lg md:text-xl font-semibold rounded-2xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 min-h-[56px] flex items-center justify-center">
                        <span class="relative z-10"><?php echo htmlspecialchars(t('common.getStarted')); ?></span>
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    </a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="px-8 py-4 md:px-12 md:py-5 border-2 border-gray-300 text-gray-700 text-lg md:text-xl font-semibold rounded-2xl hover:border-blue-600 hover:text-blue-600 transform hover:scale-105 transition-all duration-300 min-h-[56px] flex items-center justify-center group">
                        <span class="relative z-10"><?php echo htmlspecialchars(t('common.viewPortfolio')); ?></span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Быстрые метрики -->
                <div class="grid grid-cols-3 gap-8 md:gap-12 mt-16 md:mt-20 animate-on-scroll" style="animation-delay: 0.5s;">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                            <span class="counter-number" data-target="10" data-suffix="+">0</span>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 font-medium"><?php echo htmlspecialchars(t('home.stats.yearsExperience')); ?></p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                            <span class="counter-number" data-target="100" data-suffix="%">0</span>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 font-medium"><?php echo htmlspecialchars(t('home.stats.onlineWork')); ?></p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                            <span class="counter-number" data-target="50" data-suffix="+">0</span>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 font-medium"><?php echo $currentLang === 'en' ? 'Projects' : 'Проектов'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Стрелка вниз -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-12 h-12 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center shadow-lg hover:border-blue-600 transition-colors cursor-pointer">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<!-- Услуги - новый дизайн -->
<section id="services" class="py-24 md:py-32 bg-gray-50 relative">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <!-- Заголовок секции -->
        <div class="text-center mb-16 md:mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200 mb-6">
                <span class="text-xs uppercase tracking-wider text-blue-600 font-semibold">
                    <?php echo $currentLang === 'en' ? 'What We Do' : 'Наши услуги'; ?>
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 text-gray-900"><?php echo htmlspecialchars(t('home.services.title')); ?></h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('home.services.subtitle')); ?>
            </p>
        </div>
        
        <!-- Карточки услуг -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            <!-- SEO-оптимизация -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars(t('home.services.seo.title')); ?></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 transition-colors font-semibold group/link">
                    <?php echo htmlspecialchars(t('common.readMore')); ?>
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Разработка сайтов -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars(t('home.services.development.title')); ?></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 transition-colors font-semibold group/link">
                    <?php echo htmlspecialchars(t('common.readMore')); ?>
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Google Ads -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars(t('home.services.ads.title')); ?></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 transition-colors font-semibold group/link">
                    <?php echo htmlspecialchars(t('common.readMore')); ?>
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Маркетинг -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars(t('home.services.marketing.title')); ?></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 transition-colors font-semibold group/link">
                    <?php echo htmlspecialchars(t('common.readMore')); ?>
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Аналитика -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.4s;">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars(t('home.services.analytics.title')); ?></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 transition-colors font-semibold group/link">
                    <?php echo htmlspecialchars(t('common.readMore')); ?>
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Конверсии -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.5s;">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars(t('home.services.conversion.title')); ?></h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.services.conversion.description')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services#conversion'); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 transition-colors font-semibold group/link">
                    <?php echo htmlspecialchars(t('common.readMore')); ?>
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Статистика - новый дизайн -->
<section class="py-20 md:py-28 lg:py-32 bg-white relative overflow-hidden">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 opacity-30 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-100 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-100 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-20 max-w-5xl mx-auto">
            <div class="text-center animate-on-scroll">
                <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    <span class="counter-number" data-target="10" data-suffix="+">0</span>
                </div>
                <p class="text-gray-600 text-lg md:text-xl lg:text-2xl font-medium">
                    <?php echo htmlspecialchars(t('home.stats.yearsExperience')); ?>
                </p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    <span class="counter-number" data-target="100" data-suffix="%">0</span>
                </div>
                <p class="text-gray-600 text-lg md:text-xl lg:text-2xl font-medium">
                    <?php echo htmlspecialchars(t('home.stats.onlineWork')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - новый дизайн -->
<section class="py-20 md:py-28 lg:py-32 bg-gray-50 relative">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 md:mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200 mb-6">
                <span class="text-xs uppercase tracking-wider text-blue-600 font-semibold">
                    <?php echo $currentLang === 'en' ? 'How We Work' : 'Как мы работаем'; ?>
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 text-gray-900"><?php echo htmlspecialchars(t('home.process.title')); ?></h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('home.process.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">
            <div class="text-center animate-on-scroll group">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        1
                    </div>
                    <!-- Соединительная линия (скрыта на мобильных) -->
                    <div class="hidden lg:block absolute top-1/2 left-full w-full h-1 bg-gradient-to-r from-blue-200 to-transparent -z-10"></div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars(t('home.process.step1.title')); ?></h3>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.1s;">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-purple-600 to-blue-600 rounded-3xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        2
                    </div>
                    <div class="hidden lg:block absolute top-1/2 left-full w-full h-1 bg-gradient-to-r from-purple-200 to-transparent -z-10"></div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars(t('home.process.step2.title')); ?></h3>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.2s;">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        3
                    </div>
                    <div class="hidden lg:block absolute top-1/2 left-full w-full h-1 bg-gradient-to-r from-blue-200 to-transparent -z-10"></div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars(t('home.process.step3.title')); ?></h3>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.3s;">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-purple-600 to-blue-600 rounded-3xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        4
                    </div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars(t('home.process.step4.title')); ?></h3>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step4.description')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии и преимущества - новый дизайн -->
<section class="py-20 md:py-28 lg:py-32 bg-white relative overflow-hidden">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-100 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-purple-100 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 md:mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200 mb-6">
                <span class="text-xs uppercase tracking-wider text-blue-600 font-semibold">
                    <?php echo $currentLang === 'en' ? 'Our Guarantees' : 'Наши гарантии'; ?>
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 text-gray-900"><?php echo htmlspecialchars(t('home.guarantees.title')); ?></h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('home.guarantees.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 max-w-6xl mx-auto">
            <!-- Пожизненная гарантия -->
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 border-2 border-blue-200 rounded-3xl p-8 md:p-10 animate-on-scroll group hover:border-blue-400 transition-all duration-300 shadow-xl hover:shadow-2xl">
                <div class="flex items-start mb-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?></h3>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
                </p>
            </div>
            
            <!-- Поддержка для первых клиентов -->
            <div class="bg-gradient-to-br from-purple-50 to-blue-50 border-2 border-purple-200 rounded-3xl p-8 md:p-10 animate-on-scroll group hover:border-purple-400 transition-all duration-300 shadow-xl hover:shadow-2xl" style="animation-delay: 0.1s;">
                <div class="flex items-start mb-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors"><?php echo htmlspecialchars(t('home.guarantees.support.title')); ?></h3>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed text-base md:text-lg mb-6">
                    <?php echo htmlspecialchars(t('home.guarantees.support.description')); ?>
                </p>
                <div class="pt-6 border-t border-purple-200">
                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-100 to-blue-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold border border-purple-300">
                        <span class="w-2 h-2 rounded-full bg-purple-600 animate-pulse"></span>
                        <?php echo htmlspecialchars(t('common.limitedOffer')); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - новый дизайн -->
<section class="py-20 md:py-28 lg:py-32 relative overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-blue-600">
    <!-- Декоративные элементы -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 mb-8">
                <span class="text-xs uppercase tracking-wider text-white font-semibold">
                    <?php echo $currentLang === 'en' ? 'Ready to Start?' : 'Готовы начать?'; ?>
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 md:mb-8 text-white">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-10 md:mb-12 px-4 md:px-0 leading-relaxed">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="px-10 py-5 md:px-12 md:py-6 bg-white text-blue-600 text-lg md:text-xl font-bold rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 min-h-[56px] flex items-center justify-center group relative overflow-hidden">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getConsultation')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="px-10 py-5 md:px-12 md:py-6 border-2 border-white/30 text-white text-lg md:text-xl font-bold rounded-2xl hover:bg-white/10 backdrop-blur-sm transform hover:scale-105 transition-all duration-300 min-h-[56px] flex items-center justify-center group">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.viewPortfolio')); ?></span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
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

// Скрипт для анимации появления элементов при скролле
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>

<style>
@keyframes gradient {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}
</style>

<?php include 'includes/footer.php'; ?>
