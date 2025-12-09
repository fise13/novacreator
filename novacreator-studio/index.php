<?php
/**
 * Главная страница NovaCreator Studio
 * Полностью переделан в стиле holymedia.kz
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

<!-- Hero секция - стиль holymedia.kz с большим фоновым изображением и мобильной адаптацией -->
<section class="relative min-h-[70vh] md:min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Большой фоновый визуал - градиент с эффектом глубины -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Основной градиентный фон -->
        <div class="absolute inset-0 opacity-30" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);"></div>
        
        <!-- Декоративные элементы с параллаксом -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.3" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); animation-duration: 4s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.5" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation-delay: 1.5s; animation-duration: 5s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-80 md:h-80 rounded-full blur-2xl opacity-10 animate-pulse parallax" data-speed="0.4" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); animation-delay: 0.8s; animation-duration: 6s;"></div>
        
        <!-- Дополнительные визуальные элементы -->
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-5" style="background: radial-gradient(ellipse at top right, var(--color-neon-blue), transparent);"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-full opacity-5" style="background: radial-gradient(ellipse at bottom left, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Главный заголовок -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.9] tracking-tighter animate-on-scroll" style="color: var(--color-text);">
                <?php 
                $headlinesData = json_decode(file_get_contents(__DIR__ . '/lang/' . $currentLang . '.json'), true);
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => 'NovaCreator Studio', 'subtitle' => ''];
                echo htmlspecialchars($randomHeadline['title']); 
                ?>
            </h1>
            
            <!-- Подзаголовок -->
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl mb-8 md:mb-10 lg:mb-12 max-w-4xl mx-auto leading-relaxed font-light animate-on-scroll px-2" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php 
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : 'Цифровое агентство';
                echo htmlspecialchars($randomDescription); 
                ?>
            </p>
            
            <!-- CTA кнопки - большие и простые с улучшенными эффектами, touch-friendly -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 md:gap-6 animate-on-scroll px-4 sm:px-0" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative w-full sm:w-auto px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 bg-black text-white text-base sm:text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[44px] sm:min-h-[48px] md:min-h-[52px] flex items-center justify-center shadow-lg hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden touch-manipulation">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getStarted')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="group relative w-full sm:w-auto px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 border-2 text-base sm:text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[44px] sm:min-h-[48px] md:min-h-[52px] flex items-center justify-center shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden touch-manipulation" style="border-color: var(--color-text); color: var(--color-text);">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.viewPortfolio')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(to right, rgba(139, 92, 246, 0.1), rgba(6, 182, 212, 0.1));"></div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Индикатор прокрутки -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center backdrop-blur-sm hover:scale-110 transition-transform cursor-pointer" style="border-color: var(--color-border); background-color: rgba(255, 255, 255, 0.05);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text-secondary);">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<!-- Статистика - простой блок как на holymedia.kz с улучшенным визуалом -->
<section class="py-20 md:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <!-- Декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <!-- 10+ лет в digital -->
                <div class="text-center animate-on-scroll">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-[10rem] font-extrabold mb-6 leading-none tracking-tighter transition-all duration-300 hover:scale-105" style="color: var(--color-text);">
                        <span class="counter-number inline-block" data-target="10" data-suffix="+">0</span>
                    </div>
                    <p class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-light" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'years in digital' : 'лет в digital сфере'; ?>
                    </p>
                </div>
                
                <!-- 100% онлайн работ -->
                <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-[10rem] font-extrabold mb-6 leading-none tracking-tighter transition-all duration-300 hover:scale-105" style="color: var(--color-text);">
                        <span class="counter-number inline-block" data-target="100" data-suffix="%">0</span>
                    </div>
                    <p class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-light" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'online work' : 'онлайн работ'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Услуги - карточки в стиле holymedia.kz с мобильной адаптацией -->
<section id="services" class="py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции - увеличенный -->
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.services.title')); ?>
                </h2>
            </div>
            
            <!-- Карточки услуг - крупные и визуальные с улучшенным дизайном, одна колонка на мобильных -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 xl:gap-12">
                <!-- SEO -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 cursor-pointer touch-manipulation" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <!-- Фоновый градиент при hover -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
                    
                    <!-- Декоративный элемент в углу -->
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5 group-hover:opacity-10 transition-opacity duration-500 hidden md:block" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); transform: translate(30%, -30%);"></div>
                    
                    <div class="p-8 sm:p-10 md:p-12 lg:p-14 relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 mb-6 md:mb-8 rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                            <svg class="w-9 h-9 sm:w-11 sm:h-11 md:w-14 md:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-3 md:mb-4 leading-tight transition-colors duration-300 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-purple-600 group-hover:to-blue-600" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.seo.title')); ?>
                        </h3>
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-4 md:mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg md:text-xl font-semibold group-hover:gap-3 transition-all relative min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 cursor-pointer touch-manipulation" style="animation-delay: 0.1s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5 group-hover:opacity-10 transition-opacity duration-500 hidden md:block" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); transform: translate(30%, -30%);"></div>
                    <div class="p-8 sm:p-10 md:p-12 lg:p-14 relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 mb-6 md:mb-8 rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                            <svg class="w-9 h-9 sm:w-11 sm:h-11 md:w-14 md:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 md:mb-6 leading-tight transition-colors duration-300 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.development.title')); ?>
                        </h3>
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-4 md:mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-3 text-lg sm:text-xl md:text-2xl font-semibold group-hover:gap-5 transition-all relative min-h-[48px] touch-manipulation" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Google Ads -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 cursor-pointer touch-manipulation" style="animation-delay: 0.2s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5 group-hover:opacity-10 transition-opacity duration-500 hidden md:block" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); transform: translate(30%, -30%);"></div>
                    <div class="p-8 sm:p-10 md:p-12 lg:p-14 relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 mb-6 md:mb-8 rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                            <svg class="w-9 h-9 sm:w-11 sm:h-11 md:w-14 md:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-3 md:mb-4 leading-tight transition-colors duration-300 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-purple-600 group-hover:to-blue-600" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.ads.title')); ?>
                        </h3>
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-4 md:mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-3 text-lg sm:text-xl md:text-2xl font-semibold group-hover:gap-5 transition-all relative min-h-[48px] touch-manipulation" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Маркетинг -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 cursor-pointer touch-manipulation" style="animation-delay: 0.3s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5 group-hover:opacity-10 transition-opacity duration-500 hidden md:block" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); transform: translate(30%, -30%);"></div>
                    <div class="p-8 sm:p-10 md:p-12 lg:p-14 relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 mb-6 md:mb-8 rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                            <svg class="w-9 h-9 sm:w-11 sm:h-11 md:w-14 md:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 md:mb-6 leading-tight transition-colors duration-300 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.marketing.title')); ?>
                        </h3>
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-4 md:mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="inline-flex items-center gap-3 text-lg sm:text-xl md:text-2xl font-semibold group-hover:gap-5 transition-all relative min-h-[48px] touch-manipulation" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Аналитика -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 md:col-span-2 lg:col-span-1 cursor-pointer touch-manipulation" style="animation-delay: 0.4s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5 group-hover:opacity-10 transition-opacity duration-500 hidden md:block" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); transform: translate(30%, -30%);"></div>
                    <div class="p-8 sm:p-10 md:p-12 lg:p-14 relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 mb-6 md:mb-8 rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                            <svg class="w-9 h-9 sm:w-11 sm:h-11 md:w-14 md:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-3 md:mb-4 leading-tight transition-colors duration-300 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-purple-600 group-hover:to-blue-600" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.analytics.title')); ?>
                        </h3>
                        <p class="text-base sm:text-lg md:text-xl lg:text-2xl mb-4 md:mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="inline-flex items-center gap-3 text-lg sm:text-xl md:text-2xl font-semibold group-hover:gap-5 transition-all relative min-h-[48px] touch-manipulation" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Технологии и инструменты - новая секция -->
<section class="py-16 md:py-20 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-blue), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Technologies & Tools' : 'Технологии и инструменты'; ?>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl max-w-3xl leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'We use modern technologies and professional tools to deliver the best results' : 'Используем современные технологии и профессиональные инструменты для достижения лучших результатов'; ?>
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 lg:gap-10">
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">React</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.1s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">Next.js</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.2s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">Tailwind CSS</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.3s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">Google Analytics</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.4s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">SEO Tools</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.5s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">PHP</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.6s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">MySQL</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.7s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">Mobile First</h3>
                </div>
                
                <div class="group animate-on-scroll p-6 md:p-8 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-2 text-center" style="animation-delay: 0.8s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-xl flex items-center justify-center transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2" style="color: var(--color-text);">WordPress</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Превью портфолио - новая секция -->
<section class="py-16 md:py-20 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <!-- Декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Recent Projects' : 'Последние проекты'; ?>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl max-w-3xl leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Real cases with measurable results' : 'Реальные кейсы с измеримыми результатами'; ?>
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10 lg:gap-12">
                <!-- Проект 1 -->
                <div class="group animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="aspect-video bg-gradient-to-br from-purple-500/20 to-blue-500/20 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="p-6 md:p-8">
                        <div class="mb-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background-color: var(--color-bg-lighter); color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Website' : 'Сайт'; ?>
                            </span>
                        </div>
                        <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Coffee Shop' : 'Кофейня'; ?>
                        </h3>
                        <p class="text-base md:text-lg mb-3 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'One-page website with ordering system' : 'Одностраничный сайт с системой заказа'; ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-2 text-base md:text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'View case' : 'Смотреть кейс'; ?></span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Проект 2 -->
                <div class="group animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="animation-delay: 0.1s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="aspect-video bg-gradient-to-br from-blue-500/20 to-purple-500/20 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="p-6 md:p-8">
                        <div class="mb-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background-color: var(--color-bg-lighter); color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Landing' : 'Лендинг'; ?>
                            </span>
                        </div>
                        <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Personal Trainer' : 'Персональный тренер'; ?>
                        </h3>
                        <p class="text-base md:text-lg mb-3 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Landing page with lead generation' : 'Лендинг с генерацией лидов'; ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-2 text-base md:text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'View case' : 'Смотреть кейс'; ?></span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Проект 3 -->
                <div class="group animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="animation-delay: 0.2s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="aspect-video bg-gradient-to-br from-purple-500/20 to-blue-500/20 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="p-6 md:p-8">
                        <div class="mb-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background-color: var(--color-bg-lighter); color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Website' : 'Сайт'; ?>
                            </span>
                        </div>
                        <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Construction Company' : 'Строительная компания'; ?>
                        </h3>
                        <p class="text-base md:text-lg mb-3 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Corporate website with trust blocks' : 'Корпоративный сайт с блоками доверия'; ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-2 text-base md:text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'View case' : 'Смотреть кейс'; ?></span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12 md:mt-16 animate-on-scroll" style="animation-delay: 0.3s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-3 px-8 py-4 md:px-10 md:py-5 border-2 rounded-xl text-lg md:text-xl font-semibold transition-all duration-300 hover:shadow-xl hover:-translate-y-1" style="border-color: var(--color-text); color: var(--color-text);">
                    <span><?php echo $currentLang === 'en' ? 'View all projects' : 'Смотреть все проекты'; ?></span>
                    <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Преимущества - новая секция -->
<section class="py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Why Choose Us' : 'Почему выбирают нас'; ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Fast Results' : 'Быстрые результаты'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We deliver projects on time and within budget' : 'Сдаем проекты в срок и в рамках бюджета'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.1s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Reliable Support' : 'Надежная поддержка'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Lifetime support and regular updates' : 'Пожизненная поддержка и регулярные обновления'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.2s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Data-Driven' : 'На основе данных'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'All decisions are based on analytics and metrics' : 'Все решения основаны на аналитике и метриках'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.3s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Fair Pricing' : 'Справедливые цены'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Transparent pricing without hidden fees' : 'Прозрачное ценообразование без скрытых платежей'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.4s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '24/7 Available' : 'Доступны 24/7'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We work online and are always in touch' : 'Работаем онлайн и всегда на связи'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.5s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Quality Guarantee' : 'Гарантия качества'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We guarantee the quality of our work' : 'Гарантируем качество нашей работы'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - простые шаги с мобильной адаптацией -->
<section class="py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.process.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16 xl:gap-20">
                <div class="animate-on-scroll">
                    <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">01</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.process.step1.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">02</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step2.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">03</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step3.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">04</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step4.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step4.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Как мы работаем - дополнительная секция -->
<section class="py-16 md:py-20 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-blue), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'How We Work' : 'Как мы работаем'; ?>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl max-w-3xl leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Simple and transparent process from start to finish' : 'Простой и прозрачный процесс от начала до конца'; ?>
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 lg:gap-12">
                <div class="animate-on-scroll text-center">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-2xl flex items-center justify-center text-3xl md:text-4xl font-extrabold" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue)); color: white;">
                        1
                    </div>
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Consultation' : 'Консультация'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We discuss your goals and requirements' : 'Обсуждаем ваши цели и требования'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll text-center" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-2xl flex items-center justify-center text-3xl md:text-4xl font-extrabold" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple)); color: white;">
                        2
                    </div>
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Proposal' : 'Предложение'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We prepare a detailed proposal' : 'Подготавливаем детальное предложение'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll text-center" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-2xl flex items-center justify-center text-3xl md:text-4xl font-extrabold" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue)); color: white;">
                        3
                    </div>
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Development' : 'Разработка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We create and implement the solution' : 'Создаем и внедряем решение'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll text-center" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-2xl flex items-center justify-center text-3xl md:text-4xl font-extrabold" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple)); color: white;">
                        4
                    </div>
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Support' : 'Поддержка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We provide ongoing support and updates' : 'Обеспечиваем постоянную поддержку и обновления'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии - простой блок с мобильной адаптацией -->
<section class="py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.guarantees.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16 xl:gap-20">
                <div class="animate-on-scroll p-10 md:p-12 lg:p-14 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-10 md:p-12 lg:p-14 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.1s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.support.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.guarantees.support.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ секция - новая секция -->
<section class="py-16 md:py-20 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="mb-16 md:mb-20 lg:mb-28 animate-on-scroll text-center">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Frequently Asked Questions' : 'Часто задаваемые вопросы'; ?>
                </h2>
            </div>
            
            <div class="space-y-6 md:space-y-8">
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'How long does it take to complete a project?' : 'Сколько времени занимает выполнение проекта?'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'The timeline depends on the project scope. A simple landing page takes 1-2 weeks, while a complex website can take 1-3 months. We always discuss timelines before starting work.' : 'Сроки зависят от объема проекта. Простой лендинг занимает 1-2 недели, а сложный сайт может занять 1-3 месяца. Мы всегда обсуждаем сроки перед началом работы.'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl" style="animation-delay: 0.1s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Do you work with international clients?' : 'Работаете ли вы с международными клиентами?'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Yes, we work 100% online and serve clients worldwide. All communication is conducted online via email, messengers, and video calls.' : 'Да, мы работаем на 100% онлайн и обслуживаем клиентов по всему миру. Вся коммуникация ведется онлайн через email, мессенджеры и видеозвонки.'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl" style="animation-delay: 0.2s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What is included in the support?' : 'Что входит в поддержку?'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Lifetime support includes bug fixes, security updates, content updates, and technical consultations. We are always available to help.' : 'Пожизненная поддержка включает исправление ошибок, обновления безопасности, обновление контента и технические консультации. Мы всегда готовы помочь.'; ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl" style="animation-delay: 0.3s; background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'How do you ensure project quality?' : 'Как вы обеспечиваете качество проекта?'; ?>
                    </h3>
                    <p class="text-base md:text-lg lg:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'We use modern technologies, follow best practices, conduct thorough testing, and provide detailed reports. All work is done according to industry standards.' : 'Мы используем современные технологии, следуем лучшим практикам, проводим тщательное тестирование и предоставляем детальные отчеты. Вся работа выполняется согласно отраслевым стандартам.'; ?>
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-12 md:mt-16 animate-on-scroll" style="animation-delay: 0.4s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-flex items-center gap-3 px-8 py-4 md:px-10 md:py-5 border-2 rounded-xl text-lg md:text-xl font-semibold transition-all duration-300 hover:shadow-xl hover:-translate-y-1" style="border-color: var(--color-text); color: var(--color-text);">
                    <span><?php echo $currentLang === 'en' ? 'Have more questions?' : 'Есть еще вопросы?'; ?></span>
                    <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - простая и большая с улучшенным визуалом и мобильной адаптацией -->
<section class="py-16 md:py-24 lg:py-40 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Фоновые элементы с градиентами -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.2" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.3" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation-delay: 1s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.9] tracking-tighter animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-6 md:mb-8 lg:mb-10 leading-relaxed animate-on-scroll px-2" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="animate-on-scroll px-4 sm:px-0" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-8 sm:px-10 md:px-12 py-4 sm:py-5 md:py-6 bg-black text-white text-base sm:text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[44px] sm:min-h-[48px] md:min-h-[52px] shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden touch-manipulation">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getConsultation')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Анимации обрабатываются через оптимизированный animations.js в footer -->

<?php include 'includes/footer.php'; ?>
