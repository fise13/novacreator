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

<?php
// Общие данные локализации для главной
static $headlinesData = null;
if ($headlinesData === null) {
    $langFile = __DIR__ . '/lang/' . $currentLang . '.json';
    if (file_exists($langFile)) {
        $headlinesData = json_decode(file_get_contents($langFile), true);
    } else {
        $headlinesData = [];
    }
}
$homeData = $headlinesData['home'] ?? [];
?>

<!-- Hero секция - Apple минималистичный дизайн -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Главный заголовок - увеличенный размер -->
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php 
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => 'NovaCreator Studio', 'subtitle' => ''];
                echo htmlspecialchars($randomHeadline['title']); 
                ?>
            </h1>
            
            <!-- Подзаголовок - увеличенный размер -->
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php 
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : 'Цифровое агентство';
                echo htmlspecialchars($randomDescription); 
                ?>
            </p>
            
            <!-- CTA кнопки - увеличенный размер текста -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 md:gap-6 animate-on-scroll px-4 sm:px-0" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-opacity duration-200 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation btn-apple" style="background-color: var(--color-text); color: var(--color-bg);">
                    <?php echo htmlspecialchars(t('common.getStarted')); ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-opacity duration-200 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation btn-apple" style="border: 0.5px solid var(--color-border); color: var(--color-text); background-color: transparent;">
                    <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
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

<!-- Статистика - Apple минимализм -->
<section class="reveal-group py-20 md:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <!-- Плавный переход фона от hero секции -->
    <div class="absolute top-0 left-0 right-0 h-32 md:h-48 pointer-events-none" style="background: linear-gradient(to bottom, var(--color-bg), var(--color-bg-lighter));"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-20 lg:gap-24">
                <!-- 100% онлайн проектов -->
                <div class="text-center reveal">
                    <div class="text-7xl sm:text-8xl md:text-9xl lg:text-[10rem] xl:text-[12rem] font-semibold mb-6 leading-none tracking-tighter" style="color: var(--color-text);">
                        <span class="counter-number inline-block" data-target="100" data-suffix="%">0</span>
                    </div>
                    <p class="text-xl md:text-2xl lg:text-3xl font-light" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'online projects' : 'онлайн проектов'; ?>
                    </p>
                </div>
                
                <!-- 10+ лет в digital -->
                <div class="text-center reveal">
                    <div class="text-7xl sm:text-8xl md:text-9xl lg:text-[10rem] xl:text-[12rem] font-semibold mb-6 leading-none tracking-tighter" style="color: var(--color-text);">
                        <span class="counter-number inline-block" data-target="10" data-suffix="+">0</span>
                    </div>
                    <p class="text-xl md:text-2xl lg:text-3xl font-light" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'years in digital' : 'лет в digital сфере'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Коротко о подходе -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-12 md:mb-16 reveal">
                <div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.pillars.title')); ?>
                    </h2>
                    <p class="text-lg sm:text-xl md:text-2xl max-w-3xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.pillars.subtitle')); ?>
                    </p>
                </div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium border" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                    <span class="w-2.5 h-2.5 rounded-full" style="background: var(--color-neon-purple);"></span>
                    <?php echo htmlspecialchars(t('home.pillars.badge')); ?>
                </div>
            </div>
            <?php
            $pillars = [
                [
                    'title' => t('home.pillars.strategy.title'),
                    'description' => t('home.pillars.strategy.description'),
                    'accent' => t('home.pillars.strategy.accent')
                ],
                [
                    'title' => t('home.pillars.speed.title'),
                    'description' => t('home.pillars.speed.description'),
                    'accent' => t('home.pillars.speed.accent')
                ],
                [
                    'title' => t('home.pillars.analytics.title'),
                    'description' => t('home.pillars.analytics.description'),
                    'accent' => t('home.pillars.analytics.accent')
                ],
                [
                    'title' => t('home.pillars.support.title'),
                    'description' => t('home.pillars.support.description'),
                    'accent' => t('home.pillars.support.accent')
                ],
            ];
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <?php foreach ($pillars as $item): ?>
                    <div class="reveal p-6 md:p-8 rounded-2xl border transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" style="background-color: var(--color-bg); border-color: var(--color-border);">
                        <div class="text-sm font-semibold mb-4 inline-flex items-center gap-2 px-3 py-1 rounded-full" style="background-color: var(--color-bg-lighter); color: var(--color-text-secondary);">
                            <span class="w-2.5 h-2.5 rounded-full" style="background: var(--color-neon-blue);"></span>
                            <?php echo htmlspecialchars($item['accent']); ?>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </h3>
                        <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($item['description']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Отрасли -->
<section class="reveal-group py-12 md:py-20" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10 md:mb-14 reveal">
                <div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.industries.title')); ?>
                    </h2>
                    <p class="text-lg md:text-xl max-w-3xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.industries.subtitle')); ?>
                    </p>
                </div>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-full text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5" style="background-color: var(--color-text); color: var(--color-bg);">
                    <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            <?php
            $industries = $homeData['industries']['items'] ?? [];
            if (!is_array($industries)) {
                $industries = [];
            }
            ?>
            <div class="flex flex-wrap gap-3 md:gap-4 reveal">
                <?php foreach ($industries as $industry): ?>
                    <span class="px-4 py-2 rounded-full text-sm md:text-base border transition-all duration-200 hover:-translate-y-0.5" style="border-color: var(--color-border); color: var(--color-text); background-color: var(--color-bg-lighter);">
                        <?php echo htmlspecialchars($industry); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Услуги - карточки в стиле holymedia.kz с мобильной адаптацией -->
<section id="services" class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции - уменьшенный -->
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.services.title')); ?>
                </h2>
            </div>
            
            <!-- Карточки услуг - минимализм без контейнеров -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 md:gap-20 lg:gap-24">
                <!-- SEO -->
                <div class="group relative reveal cursor-pointer touch-manipulation">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.seo.title')); ?>
                    </h3>
                    <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="group relative reveal cursor-pointer touch-manipulation">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.development.title')); ?>
                    </h3>
                    <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Google Ads -->
                <div class="group relative reveal cursor-pointer touch-manipulation">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.ads.title')); ?>
                    </h3>
                    <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Маркетинг -->
                <div class="group relative reveal cursor-pointer touch-manipulation">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.marketing.title')); ?>
                    </h3>
                    <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Аналитика -->
                <div class="group relative reveal cursor-pointer touch-manipulation md:col-span-2 lg:col-span-1">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.analytics.title')); ?>
                    </h3>
                    <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Кейсы -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-12 md:mb-16 reveal">
                <div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.cases.title')); ?>
                    </h2>
                    <p class="text-lg sm:text-xl md:text-2xl max-w-3xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.cases.subtitle')); ?>
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="px-5 py-3 rounded-full text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5" style="background-color: var(--color-text); color: var(--color-bg);">
                        <?php echo htmlspecialchars(t('home.cases.ctaPortfolio')); ?>
                    </a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="px-5 py-3 rounded-full text-sm font-semibold border transition-all duration-200 hover:-translate-y-0.5" style="border-color: var(--color-border); color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.cases.ctaCall')); ?>
                    </a>
                </div>
            </div>
            <?php
            $casesRaw = $homeData['cases']['items'] ?? [];
            $cases = is_array($casesRaw) ? array_values($casesRaw) : [];
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <?php foreach ($cases as $case): ?>
                    <article class="reveal h-full p-6 md:p-8 rounded-2xl border flex flex-col gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                        <div class="text-sm font-semibold inline-flex items-center gap-2 px-3 py-1 rounded-full self-start" style="background-color: var(--color-bg); color: var(--color-text-secondary);">
                            <span class="w-2.5 h-2.5 rounded-full" style="background: var(--color-neon-purple);"></span>
                            <?php echo htmlspecialchars($case['industry']); ?>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($case['title']); ?>
                        </h3>
                        <p class="text-base md:text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($case['result']); ?>
                        </p>
                        <?php if (is_array($case['points'])): ?>
                            <ul class="space-y-3 text-sm md:text-base" style="color: var(--color-text-secondary);">
                                <?php foreach ($case['points'] as $point): ?>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1 w-1.5 h-1.5 rounded-full flex-shrink-0" style="background: var(--color-neon-blue);"></span>
                                        <span><?php echo htmlspecialchars($point); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <div class="mt-auto pt-4">
                            <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-2 text-sm font-semibold transition-all duration-200 hover:gap-3" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - простые шаги с мобильной адаптацией -->
<section class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.process.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16 xl:gap-20">
                <div class="reveal">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">01</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step1.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">02</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step2.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">03</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step3.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-extrabold mb-6 leading-none" style="color: var(--color-text); opacity: 0.2;">04</div>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
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

<!-- Стек и контроль качества -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16 items-start">
            <div class="reveal space-y-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.stack.title')); ?>
                    </h2>
                    <p class="text-lg md:text-xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.stack.subtitle')); ?>
                    </p>
                </div>
                <?php
                $stackItems = $homeData['stack']['items'] ?? [];
                if (!is_array($stackItems)) {
                    $stackItems = [];
                }
                ?>
                <div class="grid grid-cols-2 gap-4 md:gap-6">
                    <?php foreach ($stackItems as $item): ?>
                        <div class="p-4 md:p-5 rounded-xl border h-full transition-all duration-200 hover:-translate-y-0.5" style="background-color: var(--color-bg); border-color: var(--color-border);">
                            <p class="text-base md:text-lg font-semibold mb-2" style="color: var(--color-text);">
                                <?php echo htmlspecialchars($item['title']); ?>
                            </p>
                            <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo htmlspecialchars($item['description']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="reveal space-y-6 p-6 md:p-8 rounded-2xl border" style="background-color: var(--color-bg); border-color: var(--color-border);">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold" style="background-color: var(--color-bg-lighter); color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('home.stack.qaBadge')); ?>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.stack.qaTitle')); ?>
                </h3>
                <?php
                $qaChecklist = $homeData['stack']['qaChecklist'] ?? [];
                if (!is_array($qaChecklist)) {
                    $qaChecklist = [];
                }
                ?>
                <ul class="space-y-3 text-base md:text-lg" style="color: var(--color-text-secondary);">
                    <?php foreach ($qaChecklist as $item): ?>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 w-2.5 h-2.5 rounded-full flex-shrink-0" style="background: var(--color-neon-purple);"></span>
                            <span><?php echo htmlspecialchars($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="pt-4">
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-full text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5" style="background-color: var(--color-text); color: var(--color-bg);">
                        <?php echo htmlspecialchars(t('home.stack.cta')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ превью -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10 md:mb-14 reveal">
                <div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.faq.title')); ?>
                    </h2>
                    <p class="text-lg md:text-xl max-w-3xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.faq.subtitle')); ?>
                    </p>
                </div>
                <a href="<?php echo getLocalizedUrl($currentLang, '/faq'); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-full text-sm font-semibold border transition-all duration-200 hover:-translate-y-0.5" style="border-color: var(--color-border); color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.faq.cta')); ?>
                </a>
            </div>
            <?php
            $faqRaw = $homeData['faq']['items'] ?? [];
            $faqItems = [];
            if (is_array($faqRaw)) {
                foreach ($faqRaw as $faq) {
                    if (isset($faq['question'], $faq['answer'])) {
                        $faqItems[] = [
                            'q' => $faq['question'],
                            'a' => $faq['answer']
                        ];
                    }
                }
            }
            ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <?php foreach ($faqItems as $item): ?>
                    <div class="reveal p-6 md:p-7 rounded-2xl border h-full transition-all duration-200 hover:-translate-y-0.5" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                        <h3 class="text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($item['q']); ?>
                        </h3>
                        <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($item['a']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии - простой блок с мобильной адаптацией -->
<section class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.guarantees.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16 xl:gap-20">
                <div class="reveal p-8 md:p-10 lg:p-12 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl lg:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
                    </p>
                </div>
                
                <div class="reveal p-8 md:p-10 lg:p-12 rounded-2xl border-2 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
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

<!-- CTA секция - простая и большая с улучшенным визуалом и мобильной адаптацией -->
<section class="reveal-group py-16 md:py-24 lg:py-40 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Фоновые элементы с градиентами -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.2" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.3" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation-delay: 1s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.9] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="reveal px-4 sm:px-0">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-8 sm:px-10 md:px-12 py-4 sm:py-5 md:py-6 bg-black text-white text-sm sm:text-base md:text-lg lg:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[44px] sm:min-h-[48px] md:min-h-[52px] lg:min-h-[56px] shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden touch-manipulation">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getConsultation')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Анимации обрабатываются через оптимизированный animations.js в footer -->

<?php include 'includes/footer.php'; ?>
