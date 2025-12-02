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

<!-- Hero секция - полностью переработанный дизайн -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24">
    <!-- Фоновые декоративные элементы - улучшенные -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Анимированные градиентные круги -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] bg-neon-purple/25 rounded-full blur-3xl animate-pulse parallax" data-speed="0.3" style="animation-duration: 4s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] bg-neon-blue/25 rounded-full blur-3xl animate-pulse parallax" data-speed="0.5" style="animation-delay: 1.5s; animation-duration: 5s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-80 md:h-80 bg-neon-purple/15 rounded-full blur-2xl animate-pulse parallax" data-speed="0.4" style="animation-delay: 0.8s; animation-duration: 6s;"></div>
        
        <!-- Сетка для глубины -->
        <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(139, 92, 246, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(139, 92, 246, 0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <!-- Плавающие частицы -->
        <div class="floating-particles" id="floatingParticles"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Левая колонка - текст -->
                <div class="text-center lg:text-left animate-on-scroll">
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
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 mb-6 animate-on-scroll" style="animation-delay: 0.1s;">
                        <span class="w-2 h-2 rounded-full bg-neon-purple animate-pulse"></span>
                        <span class="text-xs uppercase tracking-wider text-gray-300">
                            <?php echo $currentLang === 'en' ? 'Digital Agency' : 'Цифровое агентство'; ?>
                        </span>
                    </div>
                    
                    <!-- Заголовок H1 -->
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold mb-6 md:mb-8 leading-tight animate-on-scroll" style="animation-delay: 0.2s;">
                        <span class="text-gradient block mb-2"><?php echo htmlspecialchars($randomHeadline['title']); ?></span>
                        <span class="text-white block"><?php echo htmlspecialchars($randomHeadline['subtitle']); ?></span>
                    </h1>
                    
                    <!-- Подзаголовок -->
                    <p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-8 md:mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed animate-on-scroll" style="animation-delay: 0.3s;">
                        <?php echo htmlspecialchars($randomDescription); ?>
                    </p>
                    
                    <!-- CTA кнопки -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 md:gap-6 animate-on-scroll" style="animation-delay: 0.4s;">
                        <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon text-center w-full sm:w-auto min-h-[52px] flex items-center justify-center group relative overflow-hidden">
                            <span class="relative z-10"><?php echo htmlspecialchars(t('common.getStarted')); ?></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-neon-blue to-neon-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </a>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="btn-outline text-center w-full sm:w-auto min-h-[52px] flex items-center justify-center group">
                            <span class="relative z-10"><?php echo htmlspecialchars(t('common.viewPortfolio')); ?></span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Быстрые метрики -->
                    <div class="grid grid-cols-3 gap-4 mt-10 md:mt-12 animate-on-scroll" style="animation-delay: 0.5s;">
                        <div class="text-center lg:text-left">
                            <div class="text-2xl md:text-3xl font-bold text-gradient mb-1">
                                <span class="counter-number" data-target="10" data-suffix="+">0</span>
                            </div>
                            <p class="text-xs md:text-sm text-gray-400"><?php echo htmlspecialchars(t('home.stats.yearsExperience')); ?></p>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-2xl md:text-3xl font-bold text-gradient mb-1">
                                <span class="counter-number" data-target="100" data-suffix="%">0</span>
                            </div>
                            <p class="text-xs md:text-sm text-gray-400"><?php echo htmlspecialchars(t('home.stats.onlineWork')); ?></p>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-2xl md:text-3xl font-bold text-gradient mb-1">
                                <span class="counter-number" data-target="50" data-suffix="+">0</span>
                            </div>
                            <p class="text-xs md:text-sm text-gray-400"><?php echo $currentLang === 'en' ? 'Projects' : 'Проектов'; ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Правая колонка - визуальный элемент -->
                <div class="hidden lg:block relative animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="relative">
                        <!-- Основной визуальный блок -->
                        <div class="relative rounded-3xl bg-gradient-to-br from-neon-purple/20 via-dark-surface/90 to-neon-blue/20 border border-neon-purple/30 p-8 shadow-2xl backdrop-blur-sm">
                            <!-- Имитация интерфейса -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-400/80"></div>
                                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                    </div>
                                    <div class="text-xs text-gray-400">novacreator-studio.com</div>
                                </div>
                                
                                <!-- Карточки услуг в миниатюре -->
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-dark-bg/80 rounded-xl p-4 border border-dark-border/50 hover:border-neon-purple/50 transition-colors">
                                        <div class="w-8 h-8 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg mb-3"></div>
                                        <div class="h-2 bg-dark-border rounded w-3/4 mb-2"></div>
                                        <div class="h-2 bg-dark-border rounded w-1/2"></div>
                                    </div>
                                    <div class="bg-dark-bg/80 rounded-xl p-4 border border-dark-border/50 hover:border-neon-blue/50 transition-colors">
                                        <div class="w-8 h-8 bg-gradient-to-r from-neon-blue to-neon-purple rounded-lg mb-3"></div>
                                        <div class="h-2 bg-dark-border rounded w-3/4 mb-2"></div>
                                        <div class="h-2 bg-dark-border rounded w-1/2"></div>
                                    </div>
                                    <div class="bg-dark-bg/80 rounded-xl p-4 border border-dark-border/50 hover:border-neon-purple/50 transition-colors">
                                        <div class="w-8 h-8 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg mb-3"></div>
                                        <div class="h-2 bg-dark-border rounded w-3/4 mb-2"></div>
                                        <div class="h-2 bg-dark-border rounded w-1/2"></div>
                                    </div>
                                    <div class="bg-dark-bg/80 rounded-xl p-4 border border-dark-border/50 hover:border-neon-blue/50 transition-colors">
                                        <div class="w-8 h-8 bg-gradient-to-r from-neon-blue to-neon-purple rounded-lg mb-3"></div>
                                        <div class="h-2 bg-dark-border rounded w-3/4 mb-2"></div>
                                        <div class="h-2 bg-dark-border rounded w-1/2"></div>
                                    </div>
                                </div>
                                
                                <!-- График/статистика -->
                                <div class="mt-6 pt-6 border-t border-dark-border/50">
                                    <div class="flex items-end justify-between gap-2 h-20">
                                        <div class="flex-1 bg-gradient-to-t from-neon-purple/40 to-neon-purple/20 rounded-t" style="height: 60%;"></div>
                                        <div class="flex-1 bg-gradient-to-t from-neon-blue/40 to-neon-blue/20 rounded-t" style="height: 80%;"></div>
                                        <div class="flex-1 bg-gradient-to-t from-neon-purple/40 to-neon-purple/20 rounded-t" style="height: 45%;"></div>
                                        <div class="flex-1 bg-gradient-to-t from-neon-blue/40 to-neon-blue/20 rounded-t" style="height: 90%;"></div>
                                        <div class="flex-1 bg-gradient-to-t from-neon-purple/40 to-neon-purple/20 rounded-t" style="height: 70%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Декоративные элементы вокруг -->
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-neon-purple/20 rounded-full blur-2xl -z-10"></div>
                        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-neon-blue/20 rounded-full blur-2xl -z-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Стрелка вниз -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-10 h-10 rounded-full bg-dark-surface/80 border border-neon-purple/30 flex items-center justify-center backdrop-blur-sm hover:border-neon-purple/60 transition-colors">
            <svg class="w-5 h-5 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<!-- Услуги - переработанный дизайн -->
<section id="services" class="py-24 md:py-32 relative">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <!-- Заголовок секции -->
        <div class="text-center mb-16 md:mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 mb-6">
                <span class="text-xs uppercase tracking-wider text-gray-300">
                    <?php echo $currentLang === 'en' ? 'What We Do' : 'Наши услуги'; ?>
                </span>
            </div>
            <h2 class="section-title mb-6"><?php echo htmlspecialchars(t('home.services.title')); ?></h2>
            <p class="section-subtitle max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('home.services.subtitle')); ?>
            </p>
        </div>
        
        <!-- Карточки услуг - улучшенный дизайн -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 px-4 md:px-0">
            <!-- SEO-оптимизация -->
            <div class="service-card group relative overflow-hidden animate-on-scroll">
                <div class="absolute top-0 right-0 w-32 h-32 bg-neon-purple/10 rounded-full blur-3xl -z-0"></div>
                <div class="relative z-10">
                    <div class="icon-wrapper w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-neon-purple/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.services.seo.title')); ?></h3>
                    <p class="text-gray-300 mb-6 leading-relaxed text-base md:text-lg">
                        <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-neon-purple hover:text-neon-blue transition-colors font-semibold group/link">
                            <?php echo htmlspecialchars(t('common.readMore')); ?>
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <span class="text-gray-500 text-sm">•</span>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/calculator'); ?>" class="text-sm text-gray-400 hover:text-neon-purple transition-colors">
                            <?php echo htmlspecialchars(t('common.calculateCost')); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Разработка сайтов -->
            <div class="service-card group relative overflow-hidden animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="absolute top-0 right-0 w-32 h-32 bg-neon-blue/10 rounded-full blur-3xl -z-0"></div>
                <div class="relative z-10">
                    <div class="icon-wrapper w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-neon-blue to-neon-purple rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-neon-blue/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.services.development.title')); ?></h3>
                    <p class="text-gray-300 mb-6 leading-relaxed text-base md:text-lg">
                        <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-2 text-neon-purple hover:text-neon-blue transition-colors font-semibold group/link">
                        <?php echo htmlspecialchars(t('common.readMore')); ?>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Google Ads -->
            <div class="service-card group relative overflow-hidden animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="absolute top-0 right-0 w-32 h-32 bg-neon-purple/10 rounded-full blur-3xl -z-0"></div>
                <div class="relative z-10">
                    <div class="icon-wrapper w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-neon-purple/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.services.ads.title')); ?></h3>
                    <p class="text-gray-300 mb-6 leading-relaxed text-base md:text-lg">
                        <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-2 text-neon-purple hover:text-neon-blue transition-colors font-semibold group/link">
                        <?php echo htmlspecialchars(t('common.readMore')); ?>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Маркетинг -->
            <div class="service-card group relative overflow-hidden animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="absolute top-0 right-0 w-32 h-32 bg-neon-blue/10 rounded-full blur-3xl -z-0"></div>
                <div class="relative z-10">
                    <div class="icon-wrapper w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-neon-blue to-neon-purple rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-neon-blue/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.services.marketing.title')); ?></h3>
                    <p class="text-gray-300 mb-6 leading-relaxed text-base md:text-lg">
                        <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="inline-flex items-center gap-2 text-neon-purple hover:text-neon-blue transition-colors font-semibold group/link">
                        <?php echo htmlspecialchars(t('common.readMore')); ?>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Аналитика -->
            <div class="service-card group relative overflow-hidden animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="absolute top-0 right-0 w-32 h-32 bg-neon-purple/10 rounded-full blur-3xl -z-0"></div>
                <div class="relative z-10">
                    <div class="icon-wrapper w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-neon-purple/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.services.analytics.title')); ?></h3>
                    <p class="text-gray-300 mb-6 leading-relaxed text-base md:text-lg">
                        <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="inline-flex items-center gap-2 text-neon-purple hover:text-neon-blue transition-colors font-semibold group/link">
                        <?php echo htmlspecialchars(t('common.readMore')); ?>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Конверсии -->
            <div class="service-card group relative overflow-hidden animate-on-scroll" style="animation-delay: 0.5s;">
                <div class="absolute top-0 right-0 w-32 h-32 bg-neon-blue/10 rounded-full blur-3xl -z-0"></div>
                <div class="relative z-10">
                    <div class="icon-wrapper w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-neon-blue to-neon-purple rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-neon-blue/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.services.conversion.title')); ?></h3>
                    <p class="text-gray-300 mb-6 leading-relaxed text-base md:text-lg">
                        <?php echo htmlspecialchars(t('home.services.conversion.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#conversion'); ?>" class="inline-flex items-center gap-2 text-neon-purple hover:text-neon-blue transition-colors font-semibold group/link">
                        <?php echo htmlspecialchars(t('common.readMore')); ?>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Статистика - улучшенный дизайн -->
<section class="py-20 md:py-28 lg:py-32 bg-gradient-to-b from-dark-surface via-dark-bg to-dark-surface relative overflow-hidden">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 opacity-30 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-neon-purple/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 lg:gap-12">
            <div class="text-center animate-on-scroll">
                <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gradient mb-2">
                    <?php echo htmlspecialchars(t('home.stats.newCompany')); ?>
                </div>
                <p class="text-gray-300 text-sm md:text-base lg:text-lg font-medium">
                    <?php echo htmlspecialchars(t('home.stats.company')); ?>
                </p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="10" data-suffix="+">0</span>
                </div>
                <p class="text-gray-300 text-sm md:text-base lg:text-lg font-medium">
                    <?php echo htmlspecialchars(t('home.stats.yearsExperience')); ?>
                </p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="2">0</span>
                </div>
                <p class="text-gray-300 text-sm md:text-base lg:text-lg font-medium">
                    <?php echo htmlspecialchars(t('home.stats.professionals')); ?>
                </p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="100" data-suffix="%">0</span>
                </div>
                <p class="text-gray-300 text-sm md:text-base lg:text-lg font-medium">
                    <?php echo htmlspecialchars(t('home.stats.onlineWork')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - улучшенный дизайн -->
<section class="py-20 md:py-28 lg:py-32 relative">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 md:mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 mb-6">
                <span class="text-xs uppercase tracking-wider text-gray-300">
                    <?php echo $currentLang === 'en' ? 'How We Work' : 'Как мы работаем'; ?>
                </span>
            </div>
            <h2 class="section-title mb-6"><?php echo htmlspecialchars(t('home.process.title')); ?></h2>
            <p class="section-subtitle max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('home.process.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 px-4 md:px-0">
            <div class="text-center animate-on-scroll group">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold shadow-lg shadow-neon-purple/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        1
                    </div>
                    <!-- Соединительная линия (скрыта на мобильных) -->
                    <div class="hidden lg:block absolute top-1/2 left-full w-full h-0.5 bg-gradient-to-r from-neon-purple/50 to-transparent -z-10"></div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.process.step1.title')); ?></h3>
                <p class="text-gray-300 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.1s;">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-neon-blue to-neon-purple rounded-2xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold shadow-lg shadow-neon-blue/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        2
                    </div>
                    <div class="hidden lg:block absolute top-1/2 left-full w-full h-0.5 bg-gradient-to-r from-neon-blue/50 to-transparent -z-10"></div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.process.step2.title')); ?></h3>
                <p class="text-gray-300 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.2s;">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold shadow-lg shadow-neon-purple/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        3
                    </div>
                    <div class="hidden lg:block absolute top-1/2 left-full w-full h-0.5 bg-gradient-to-r from-neon-purple/50 to-transparent -z-10"></div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.process.step3.title')); ?></h3>
                <p class="text-gray-300 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.3s;">
                <div class="relative mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-neon-blue to-neon-purple rounded-2xl flex items-center justify-center mx-auto text-4xl md:text-5xl font-bold shadow-lg shadow-neon-blue/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        4
                    </div>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gradient group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.process.step4.title')); ?></h3>
                <p class="text-gray-300 leading-relaxed">
                    <?php echo htmlspecialchars(t('home.process.step4.description')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии и преимущества - улучшенный дизайн -->
<section class="py-20 md:py-28 lg:py-32 bg-gradient-to-b from-dark-bg via-dark-surface to-dark-bg relative overflow-hidden">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-neon-purple/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-neon-blue/30 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 md:mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 mb-6">
                <span class="text-xs uppercase tracking-wider text-gray-300">
                    <?php echo $currentLang === 'en' ? 'Our Guarantees' : 'Наши гарантии'; ?>
                </span>
            </div>
            <h2 class="section-title mb-6"><?php echo htmlspecialchars(t('home.guarantees.title')); ?></h2>
            <p class="section-subtitle max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('home.guarantees.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 max-w-6xl mx-auto">
            <!-- Пожизненная гарантия -->
            <div class="bg-gradient-to-br from-neon-purple/20 via-neon-purple/10 to-neon-blue/20 border border-neon-purple/40 rounded-3xl p-8 md:p-10 animate-on-scroll group hover:border-neon-purple/60 transition-all duration-300 shadow-xl shadow-neon-purple/10">
                <div class="flex items-start mb-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 shadow-lg shadow-neon-purple/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gradient mb-3 group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?></h3>
                    </div>
                </div>
                <p class="text-gray-200 leading-relaxed text-base md:text-lg">
                    <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
                </p>
            </div>
            
            <!-- Поддержка для первых клиентов -->
            <div class="bg-gradient-to-br from-neon-blue/20 via-neon-blue/10 to-neon-purple/20 border border-neon-blue/40 rounded-3xl p-8 md:p-10 animate-on-scroll group hover:border-neon-blue/60 transition-all duration-300 shadow-xl shadow-neon-blue/10" style="animation-delay: 0.1s;">
                <div class="flex items-start mb-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-neon-blue to-neon-purple rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 shadow-lg shadow-neon-blue/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gradient mb-3 group-hover:scale-105 transition-transform duration-300"><?php echo htmlspecialchars(t('home.guarantees.support.title')); ?></h3>
                    </div>
                </div>
                <p class="text-gray-200 leading-relaxed text-base md:text-lg mb-6">
                    <?php echo htmlspecialchars(t('home.guarantees.support.description')); ?>
                </p>
                <div class="pt-6 border-t border-neon-blue/30">
                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-neon-blue/30 to-neon-purple/30 text-neon-blue px-4 py-2 rounded-full text-sm font-semibold border border-neon-blue/40">
                        <span class="w-2 h-2 rounded-full bg-neon-blue animate-pulse"></span>
                        <?php echo htmlspecialchars(t('common.limitedOffer')); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - улучшенный дизайн -->
<section class="py-20 md:py-28 lg:py-32 relative overflow-hidden">
    <!-- Фоновые градиенты -->
    <div class="absolute inset-0 bg-gradient-to-br from-neon-purple/30 via-neon-purple/20 to-neon-blue/30"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(139,92,246,0.3),transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(6,182,212,0.3),transparent_50%)]"></div>
    
    <!-- Декоративные элементы -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-neon-purple/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-8">
                <span class="text-xs uppercase tracking-wider text-gray-200">
                    <?php echo $currentLang === 'en' ? 'Ready to Start?' : 'Готовы начать?'; ?>
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 md:mb-8 text-white">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-10 md:mb-12 px-4 md:px-0 leading-relaxed">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon text-center w-full sm:w-auto min-h-[56px] px-8 md:px-10 text-lg md:text-xl flex items-center justify-center group relative overflow-hidden shadow-2xl shadow-neon-purple/50">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getConsultation')); ?></span>
                    <span class="absolute inset-0 bg-gradient-to-r from-neon-blue to-neon-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="btn-outline text-center w-full sm:w-auto min-h-[56px] px-8 md:px-10 text-lg md:text-xl flex items-center justify-center group border-2 border-white/30 text-white hover:bg-white/10 backdrop-blur-sm">
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

