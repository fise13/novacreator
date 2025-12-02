<?php
/**
 * Страница услуг
 * Подробное описание всех услуг агентства
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.services.breadcrumb');
$pageMetaTitle = t('seo.pages.services.title');
$pageMetaDescription = t('seo.pages.services.description');
$pageMetaKeywords = t('seo.pages.services.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - улучшенный дизайн -->
<section class="relative overflow-hidden pt-32 pb-20">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-16 w-96 h-96 bg-neon-purple/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -right-10 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto text-center animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 mb-8">
                <span class="text-xs uppercase tracking-wider text-gray-300">
                    <?php echo $currentLang === 'en' ? 'Our Services' : 'Наши услуги'; ?>
                </span>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold mb-6 md:mb-8">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.services.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl text-gray-300 mb-12 leading-relaxed max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.services.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- SEO-оптимизация -->
<section id="seo" class="py-20 md:py-28 relative">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="animate-on-scroll">
                <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-neon-purple/30">
                    <svg class="w-12 h-12 md:w-14 md:h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 md:mb-8 text-gradient"><?php echo htmlspecialchars(t('pages.services.seo.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.services.seo.description')); ?>
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.seo.features.technical')); ?></span>
                    </li>
                    <li class="flex items-start space-x-4">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-neon-purple/30 to-neon-blue/30 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-200 text-base md:text-lg"><?php echo htmlspecialchars(t('pages.services.seo.features.content')); ?></span>
                    </li>
                    <li class="flex items-start space-x-4">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-neon-purple/30 to-neon-blue/30 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-200 text-base md:text-lg"><?php echo htmlspecialchars(t('pages.services.seo.features.links')); ?></span>
                    </li>
                    <li class="flex items-start space-x-4">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-neon-purple/30 to-neon-blue/30 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-200 text-base md:text-lg"><?php echo htmlspecialchars(t('pages.services.seo.features.reporting')); ?></span>
                    </li>
                </ul>
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="btn-neon inline-flex items-center gap-2 group">
                    <?php echo htmlspecialchars(t('pages.services.seo.learnMore')); ?>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-gradient-to-br from-dark-surface via-dark-bg to-dark-surface border border-neon-purple/30 rounded-3xl p-8 md:p-10 h-full shadow-xl shadow-neon-purple/10 relative overflow-hidden">
                    <!-- Декоративные элементы -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-neon-purple/10 rounded-full blur-3xl -z-0"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-neon-blue/10 rounded-full blur-3xl -z-0"></div>
                    <div class="relative z-10">
                        <div class="space-y-6">
                            <div class="flex items-center justify-between p-5 md:p-6 bg-dark-bg/80 rounded-xl border border-dark-border/50 hover:border-neon-purple/50 transition-colors group">
                                <span class="text-gray-300 text-base md:text-lg"><?php echo htmlspecialchars(t('pages.services.seo.stats.traffic')); ?></span>
                                <span class="text-3xl md:text-4xl font-bold text-gradient group-hover:scale-110 transition-transform">
                                    <span class="counter-number" data-target="250" data-prefix="+" data-suffix="%">0</span>
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-5 md:p-6 bg-dark-bg/80 rounded-xl border border-dark-border/50 hover:border-neon-blue/50 transition-colors group">
                                <span class="text-gray-300 text-base md:text-lg"><?php echo htmlspecialchars(t('pages.services.seo.stats.positions')); ?></span>
                                <span class="text-3xl md:text-4xl font-bold text-gradient group-hover:scale-110 transition-transform">
                                    <span class="counter-number" data-target="180" data-prefix="+" data-suffix="%">0</span>
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-5 md:p-6 bg-dark-bg/80 rounded-xl border border-dark-border/50 hover:border-neon-purple/50 transition-colors group">
                                <span class="text-gray-300 text-base md:text-lg"><?php echo htmlspecialchars(t('pages.services.seo.stats.conversions')); ?></span>
                                <span class="text-3xl md:text-4xl font-bold text-gradient group-hover:scale-110 transition-transform">
                                    <span class="counter-number" data-target="95" data-prefix="+" data-suffix="%">0</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Разработка сайтов -->
<section id="development" class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-bg border border-dark-border rounded-2xl p-8">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.features.responsive')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.features.speed')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.features.seo')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.features.integrations')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.development.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.services.development.description')); ?>
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.types.landing')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.types.shop')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.types.app')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.development.types.support')); ?></span>
                    </li>
                </ul>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                    <?php echo htmlspecialchars(t('pages.services.development.discuss')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Google Ads -->
<section id="ads" class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.ads.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.services.ads.description')); ?>
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.ads.features.setup')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.ads.features.ads')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.ads.features.keywords')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.ads.features.monitoring')); ?></span>
                    </li>
                </ul>
                <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="btn-neon inline-block">
                    <?php echo htmlspecialchars(t('pages.services.ads.learnMore')); ?>
                </a>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.ads.results.title')); ?></h3>
                    <div class="space-y-6">
                        <div class="progress-item">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400"><?php echo htmlspecialchars(t('pages.services.ads.results.ctr')); ?></span>
                                <div class="relative inline-block">
                                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple/30 to-neon-blue/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <span class="relative text-neon-purple font-bold counter-wrapper">
                                        <span class="counter-number" data-target="45" data-prefix="+" data-suffix="%">+45%</span>
                                    </span>
                                </div>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-2 overflow-hidden">
                                <div class="progress-bar bg-gradient-to-r from-neon-purple to-neon-blue h-2 rounded-full" data-width="85" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="progress-item" style="animation-delay: 0.1s;">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400"><?php echo htmlspecialchars(t('pages.services.ads.results.conversions')); ?></span>
                                <div class="relative inline-block">
                                    <div class="absolute inset-0 bg-gradient-to-r from-neon-blue/30 to-neon-purple/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <span class="relative text-neon-blue font-bold counter-wrapper">
                                        <span class="counter-number" data-target="120" data-prefix="+" data-suffix="%">+120%</span>
                                    </span>
                                </div>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-2 overflow-hidden">
                                <div class="progress-bar bg-gradient-to-r from-neon-blue to-neon-purple h-2 rounded-full" data-width="90" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="progress-item" style="animation-delay: 0.2s;">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400"><?php echo htmlspecialchars(t('pages.services.ads.results.cost')); ?></span>
                                <div class="relative inline-block">
                                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple/30 to-neon-blue/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <span class="relative text-neon-purple font-bold counter-wrapper">
                                        <span class="counter-number" data-target="35" data-prefix="-" data-suffix="%">-35%</span>
                                    </span>
                                </div>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-2 overflow-hidden">
                                <div class="progress-bar bg-gradient-to-r from-neon-purple to-neon-blue h-2 rounded-full" data-width="75" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Маркетинг -->
<section id="marketing" class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1 animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="grid grid-cols-2 gap-4">
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-purple mb-2"><?php echo htmlspecialchars(t('pages.services.marketing.types.smm')); ?></div>
                        <p class="text-sm text-gray-400"><?php echo htmlspecialchars(t('pages.services.marketing.types.smmDesc')); ?></p>
                    </div>
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-blue mb-2"><?php echo htmlspecialchars(t('pages.services.marketing.types.email')); ?></div>
                        <p class="text-sm text-gray-400"><?php echo htmlspecialchars(t('pages.services.marketing.types.emailDesc')); ?></p>
                    </div>
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-purple mb-2"><?php echo htmlspecialchars(t('pages.services.marketing.types.content')); ?></div>
                        <p class="text-sm text-gray-400"><?php echo htmlspecialchars(t('pages.services.marketing.types.contentDesc')); ?></p>
                    </div>
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-blue mb-2"><?php echo htmlspecialchars(t('pages.services.marketing.types.brand')); ?></div>
                        <p class="text-sm text-gray-400"><?php echo htmlspecialchars(t('pages.services.marketing.types.brandDesc')); ?></p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.marketing.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.services.marketing.description')); ?>
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.marketing.features.smm')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.marketing.features.content')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.marketing.features.email')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.marketing.features.branding')); ?></span>
                    </li>
                </ul>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                    <?php echo htmlspecialchars(t('pages.services.marketing.discuss')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Аналитика и конверсии -->
<section id="analytics" class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.analytics.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.services.analytics.description')); ?>
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.features.setup')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.features.tracking')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.features.testing')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.features.reports')); ?></span>
                    </li>
                </ul>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                    <?php echo htmlspecialchars(t('pages.services.analytics.setup')); ?>
                </a>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.analytics.tracking.title')); ?></h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.tracking.visitors')); ?></span>
                            <span class="text-neon-purple">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.tracking.conversions')); ?></span>
                            <span class="text-neon-blue">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.tracking.behavior')); ?></span>
                            <span class="text-neon-purple">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.tracking.sources')); ?></span>
                            <span class="text-neon-blue">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.services.analytics.tracking.roi')); ?></span>
                            <span class="text-neon-purple">✓</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.services.guarantees.title')); ?></h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.services.guarantees.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <!-- Пожизненная гарантия -->
            <div class="bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-2xl p-8 animate-on-scroll">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gradient"><?php echo htmlspecialchars(t('pages.services.guarantees.lifetime.title')); ?></h3>
                </div>
                <p class="text-gray-300 leading-relaxed text-lg">
                    <?php echo htmlspecialchars(t('pages.services.guarantees.lifetime.description')); ?>
                </p>
            </div>
            
            <!-- Поддержка для первых клиентов -->
            <div class="bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 border border-neon-blue/30 rounded-2xl p-8 animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gradient"><?php echo htmlspecialchars(t('pages.services.guarantees.support.title')); ?></h3>
                </div>
                <p class="text-gray-300 leading-relaxed text-lg">
                    <?php echo htmlspecialchars(t('pages.services.guarantees.support.description')); ?>
                </p>
                <div class="mt-6 pt-6 border-t border-neon-blue/30">
                    <span class="inline-block bg-neon-blue/20 text-neon-blue px-4 py-2 rounded-full text-sm font-semibold">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.support.badge')); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <?php echo htmlspecialchars(t('pages.services.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.services.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.services.cta.button')); ?>
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
</script>

<?php include 'includes/footer.php'; ?>

