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

<!-- Hero секция - стиль holymedia.kz -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Фоновые декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.3" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); animation-duration: 4s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.5" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation-delay: 1.5s; animation-duration: 5s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-80 md:h-80 rounded-full blur-2xl opacity-10 animate-pulse parallax" data-speed="0.4" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); animation-delay: 0.8s; animation-duration: 6s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Главный заголовок - ОГРОМНЫЙ как на holymedia.kz -->
            <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-[10rem] 2xl:text-[12rem] font-extrabold mb-8 md:mb-12 leading-[0.85] tracking-tighter animate-on-scroll" style="color: var(--color-text);">
                <?php 
                $headlinesData = json_decode(file_get_contents(__DIR__ . '/lang/' . $currentLang . '.json'), true);
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => 'NovaCreator Studio', 'subtitle' => ''];
                echo htmlspecialchars($randomHeadline['title']); 
                ?>
            </h1>
            
            <!-- Подзаголовок - простой и читаемый -->
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-12 md:mb-16 max-w-5xl mx-auto leading-relaxed font-light animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php 
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : 'Цифровое агентство';
                echo htmlspecialchars($randomDescription); 
                ?>
            </p>
            
            <!-- CTA кнопки - большие и простые -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6 animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="px-10 py-5 md:px-14 md:py-6 bg-black text-white text-lg md:text-xl lg:text-2xl font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 min-h-[56px] md:min-h-[64px] flex items-center justify-center shadow-lg hover:shadow-xl transform hover:scale-105">
                    <?php echo htmlspecialchars(t('common.getStarted')); ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="px-10 py-5 md:px-14 md:py-6 border-2 text-lg md:text-xl lg:text-2xl font-semibold rounded-lg hover:bg-gray-50 transition-all duration-300 min-h-[56px] md:min-h-[64px] flex items-center justify-center shadow-lg hover:shadow-xl transform hover:scale-105" style="border-color: var(--color-text); color: var(--color-text);">
                    <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Индикатор прокрутки -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center backdrop-blur-sm hover:scale-110 transition-transform" style="border-color: var(--color-border);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text-secondary);">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<!-- Статистика - простой блок как на holymedia.kz -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center animate-on-scroll">
                <div class="text-7xl sm:text-8xl md:text-9xl lg:text-[10rem] xl:text-[12rem] font-extrabold mb-6 leading-none tracking-tighter" style="color: var(--color-text);">
                    <span class="counter-number" data-target="120" data-suffix="+">0</span>
                </div>
                <p class="text-2xl md:text-3xl lg:text-4xl font-light" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'projects' : 'проектов'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Услуги - карточки в стиле holymedia.kz -->
<section id="services" class="py-20 md:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-20 md:mb-24 animate-on-scroll">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.services.title')); ?>
                </h2>
            </div>
            
            <!-- Карточки услуг - крупные и визуальные -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10 lg:gap-12">
                <!-- SEO -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="p-8 md:p-10">
                        <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.seo.title')); ?>
                        </h3>
                        <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="animation-delay: 0.1s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="p-8 md:p-10">
                        <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.development.title')); ?>
                        </h3>
                        <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));"></div>
                </div>
                
                <!-- Google Ads -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="animation-delay: 0.2s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="p-8 md:p-10">
                        <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.ads.title')); ?>
                        </h3>
                        <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
                </div>
                
                <!-- Маркетинг -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" style="animation-delay: 0.3s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="p-8 md:p-10">
                        <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.marketing.title')); ?>
                        </h3>
                        <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-blue), var(--color-neon-purple));"></div>
                </div>
                
                <!-- Аналитика -->
                <div class="group relative animate-on-scroll overflow-hidden rounded-2xl border-2 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 md:col-span-2 lg:col-span-1" style="animation-delay: 0.4s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <div class="p-8 md:p-10">
                        <div class="w-16 h-16 md:w-20 md:h-20 mb-6 rounded-xl flex items-center justify-center transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.services.analytics.title')); ?>
                        </h3>
                        <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold group-hover:gap-4 transition-all" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - простые шаги -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-20 md:mb-24 animate-on-scroll">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.process.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <div class="animate-on-scroll">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">01</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step1.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">02</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step2.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">03</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step3.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">04</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step4.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step4.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии - простой блок -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-20 md:mb-24 animate-on-scroll">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.guarantees.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll p-8 md:p-10 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="animation-delay: 0.1s; background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.support.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.guarantees.support.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - простая и большая -->
<section class="py-24 md:py-40 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full opacity-5" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold mb-8 md:mb-12 leading-[0.9] tracking-tighter animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-xl md:text-2xl lg:text-3xl mb-12 md:mb-16 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-12 py-6 md:px-16 md:py-7 bg-black text-white text-lg md:text-xl lg:text-2xl font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 min-h-[64px] md:min-h-[72px] shadow-2xl hover:shadow-3xl transform hover:scale-105">
                    <?php echo htmlspecialchars(t('common.getConsultation')); ?>
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
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const currentText = entry.target.textContent.trim();
                if (currentText === '0' || currentText === '' || /^[+\-]?0[%]?$/.test(currentText)) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
    
    // Анимация появления элементов
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        scrollObserver.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
