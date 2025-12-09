<?php
/**
 * Страница SEO-услуг
 * Дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.seo.breadcrumb');
$pageMetaTitle = t('seo.pages.seo.title');
$pageMetaDescription = t('seo.pages.seo.description');
$pageMetaKeywords = t('seo.pages.seo.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - стиль holymedia.kz -->
<section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-50 rounded-full blur-3xl opacity-50"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto text-center animate-on-scroll">
            <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold mb-8 md:mb-12 leading-tight">
                <span style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.title')); ?></span>
            </h1>
            <p class="text-2xl md:text-3xl lg:text-4xl mb-12 md:mb-16 max-w-4xl mx-auto leading-relaxed" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.seo.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Что включает SEO - стиль holymedia.kz -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.includes.title')); ?></h2>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('pages.seo.includes.subtitle')); ?>
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                <!-- Технический SEO -->
                <div class="rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="background-color: var(--color-surface);">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-blue-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.services.technical.title')); ?></h3>
                    <ul class="space-y-3" style="color: var(--color-text-secondary);">
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.technical.items.audit')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.technical.items.speed')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.technical.items.robots')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.technical.items.links')); ?></span>
                        </li>
                    </ul>
                </div>
                
                <!-- Контент-оптимизация -->
                <div class="rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.1s; background-color: var(--color-surface);">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-purple-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.services.content.title')); ?></h3>
                    <ul class="space-y-3" style="color: var(--color-text-secondary);">
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.content.items.meta')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.content.items.texts')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.content.items.keywords')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.content.items.images')); ?></span>
                        </li>
                    </ul>
                </div>
                
                <!-- Ссылочное продвижение -->
                <div class="rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.2s; background-color: var(--color-surface);">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-blue-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.services.links.title')); ?></h3>
                    <ul class="space-y-3" style="color: var(--color-text-secondary);">
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.links.items.building')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.links.items.relevant')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.links.items.authority')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.links.items.monitoring')); ?></span>
                        </li>
                    </ul>
                </div>
                
                <!-- Локальное SEO -->
                <div class="rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.3s; background-color: var(--color-surface);">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-purple-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.services.local.title')); ?></h3>
                    <ul class="space-y-3" style="color: var(--color-text-secondary);">
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.local.items.yandex')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.local.items.google')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.local.items.reviews')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.local.items.local')); ?></span>
                        </li>
                    </ul>
                </div>
                
                <!-- Аналитика и отчетность -->
                <div class="rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.4s; background-color: var(--color-surface);">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-blue-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.services.analytics.title')); ?></h3>
                    <ul class="space-y-3" style="color: var(--color-text-secondary);">
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.analytics.items.reports')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.analytics.items.positions')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.analytics.items.competitors')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-blue-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.analytics.items.recommendations')); ?></span>
                        </li>
                    </ul>
                </div>
                
                <!-- Продвижение в соцсетях -->
                <div class="rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll group" style="animation-delay: 0.5s; background-color: var(--color-surface);">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-purple-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.services.smm.title')); ?></h3>
                    <ul class="space-y-3" style="color: var(--color-text-secondary);">
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.smm.items.sync')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.smm.items.promotion')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.smm.items.signals')); ?></span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-purple-600 font-bold mt-1">•</span>
                            <span><?php echo htmlspecialchars(t('pages.seo.services.smm.items.branding')); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Результаты - стиль holymedia.kz -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.results.title')); ?></h2>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('pages.seo.results.subtitle')); ?>
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
                <div class="text-center animate-on-scroll group">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                        <span class="counter-number" data-target="250" data-prefix="+" data-suffix="%">0</span>
                    </div>
                    <p class="text-lg md:text-xl font-medium transition-colors" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('pages.seo.results.traffic')); ?></p>
                </div>
                <div class="text-center animate-on-scroll group" style="animation-delay: 0.1s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                        <span class="counter-number" data-target="180" data-prefix="+" data-suffix="%">0</span>
                    </div>
                    <p class="text-gray-600 text-lg md:text-xl font-medium group-hover:text-gray-900 transition-colors"><?php echo htmlspecialchars(t('pages.seo.results.positions')); ?></p>
                </div>
                <div class="text-center animate-on-scroll group" style="animation-delay: 0.2s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                        <span class="counter-number" data-target="95" data-prefix="+" data-suffix="%">0</span>
                    </div>
                    <p class="text-gray-600 text-lg md:text-xl font-medium group-hover:text-gray-900 transition-colors"><?php echo htmlspecialchars(t('pages.seo.results.conversions')); ?></p>
                </div>
                <div class="text-center animate-on-scroll group" style="animation-delay: 0.3s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                        <span class="counter-number" data-target="40" data-prefix="-" data-suffix="%">0</span>
                    </div>
                    <p class="text-gray-600 text-lg md:text-xl font-medium group-hover:text-gray-900 transition-colors"><?php echo htmlspecialchars(t('pages.seo.results.cost')); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - стиль holymedia.kz -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.process.title')); ?></h2>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('pages.seo.process.subtitle')); ?>
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-12">
                <div class="flex flex-col md:flex-row gap-8 items-start animate-on-scroll group">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-3xl md:text-4xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        1
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-blue-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.process.step1.title')); ?></h3>
                        <p class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.seo.process.step1.description')); ?>
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-8 items-start animate-on-scroll group" style="animation-delay: 0.1s;">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-3xl md:text-4xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        2
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-purple-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.process.step2.title')); ?></h3>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            <?php echo htmlspecialchars(t('pages.seo.process.step2.description')); ?>
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-8 items-start animate-on-scroll group" style="animation-delay: 0.2s;">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-3xl md:text-4xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        3
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-blue-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.process.step3.title')); ?></h3>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            <?php echo htmlspecialchars(t('pages.seo.process.step3.description')); ?>
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-8 items-start animate-on-scroll group" style="animation-delay: 0.3s;">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-3xl md:text-4xl font-bold text-white shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        4
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-purple-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.process.step4.title')); ?></h3>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            <?php echo htmlspecialchars(t('pages.seo.process.step4.description')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ секция - стиль holymedia.kz -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.faq.title')); ?></h2>
                <p class="text-xl md:text-2xl" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('pages.seo.faq.subtitle')); ?>
                </p>
            </div>
            
            <div itemscope itemtype="https://schema.org/FAQPage" class="space-y-6">
                <!-- Вопрос 1 -->
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="border rounded-2xl p-8 hover:shadow-lg transition-all duration-300 animate-on-scroll" style="background-color: var(--color-surface); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.seo.faq.q1.question')); ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.seo.faq.q1.answer')); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Вопрос 2 -->
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-gray-50 border border-gray-200 rounded-2xl p-8 hover:border-blue-300 hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.seo.faq.q2.question')); ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.seo.faq.q2.answer')); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Вопрос 3 -->
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-gray-50 border border-gray-200 rounded-2xl p-8 hover:border-blue-300 hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.seo.faq.q3.question')); ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.seo.faq.q3.answer')); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Вопрос 4 -->
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-gray-50 border border-gray-200 rounded-2xl p-8 hover:border-blue-300 hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.seo.faq.q4.question')); ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.seo.faq.q4.answer')); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Вопрос 5 -->
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-gray-50 border border-gray-200 rounded-2xl p-8 hover:border-blue-300 hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.4s;">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.seo.faq.q5.question')); ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.seo.faq.q5.answer')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии - стиль holymedia.kz -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.seo.guarantees.title')); ?></h2>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('pages.seo.guarantees.subtitle')); ?>
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 max-w-5xl mx-auto">
                <!-- Пожизненная гарантия -->
                <div class="border-2 rounded-3xl p-8 md:p-10 animate-on-scroll group hover:border-blue-400 transition-all duration-300 shadow-xl hover:shadow-2xl" style="background: linear-gradient(to bottom right, rgba(37, 99, 235, 0.1), rgba(147, 51, 234, 0.1)); border-color: rgba(37, 99, 235, 0.3);">
                    <div class="flex items-center mb-6">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-10 h-10 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold group-hover:text-blue-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.services.guarantees.lifetime.title')); ?></h3>
                    </div>
                    <p class="leading-relaxed text-lg" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.lifetime.description')); ?>
                    </p>
                </div>
                
                <!-- Поддержка для первых клиентов -->
                <div class="border-2 rounded-3xl p-8 md:p-10 animate-on-scroll group hover:border-purple-400 transition-all duration-300 shadow-xl hover:shadow-2xl" style="animation-delay: 0.1s; background: linear-gradient(to bottom right, rgba(147, 51, 234, 0.1), rgba(37, 99, 235, 0.1)); border-color: rgba(147, 51, 234, 0.3);">
                    <div class="flex items-center mb-6">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-10 h-10 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold group-hover:text-purple-600 transition-colors" style="color: var(--color-text);"><?php echo htmlspecialchars(t('pages.services.guarantees.support.title')); ?></h3>
                    </div>
                    <p class="leading-relaxed text-lg mb-6" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.support.description')); ?>
                    </p>
                    <div class="pt-6 border-t border-purple-200">
                        <span class="inline-block bg-gradient-to-r from-purple-100 to-blue-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold border border-purple-300">
                            <?php echo htmlspecialchars(t('pages.services.guarantees.support.badge')); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - стиль holymedia.kz -->
<section class="py-20 md:py-32 relative overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-blue-600">
    <!-- Декоративные элементы -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 md:mb-8 text-white">
                <?php echo htmlspecialchars(t('pages.seo.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-10 md:mb-12 px-4 md:px-0 leading-relaxed">
                <?php echo htmlspecialchars(t('pages.seo.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-10 py-5 md:px-12 md:py-6 bg-white text-blue-600 text-lg md:text-xl font-bold rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 min-h-[56px] flex items-center justify-center group relative overflow-hidden mx-auto">
                <span class="relative z-10"><?php echo htmlspecialchars(t('pages.seo.cta.button')); ?></span>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
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

<?php include 'includes/footer.php'; ?>
