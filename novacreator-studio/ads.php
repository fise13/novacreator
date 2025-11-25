<?php
/**
 * Страница Google Ads
 * Подробная информация о контекстной рекламе
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.ads.breadcrumb');
$pageMetaTitle = t('seo.pages.ads.title');
$pageMetaDescription = t('seo.pages.ads.description');
$pageMetaKeywords = t('seo.pages.ads.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <div class="w-24 h-24 bg-gradient-to-r from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.ads.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.ads.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Что мы делаем -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.ads.includes.title')); ?></h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.ads.includes.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Настройка кампаний -->
            <div class="service-card animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.ads.services.setup.title')); ?></h3>
                <p class="text-gray-400 mb-4">
                    <?php echo htmlspecialchars(t('pages.ads.services.setup.description')); ?>
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.search')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.rsya')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.retargeting')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.remarketing')); ?></li>
                </ul>
            </div>
            
            <!-- Работа с ключевыми словами -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.ads.services.keywords.title')); ?></h3>
                <p class="text-gray-400 mb-4">
                    <?php echo htmlspecialchars(t('pages.ads.services.keywords.description')); ?>
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.selection')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.grouping')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.negative')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.queries')); ?></li>
                </ul>
            </div>
            
            <!-- Создание объявлений -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.ads.services.ads.title')); ?></h3>
                <p class="text-gray-400 mb-4">
                    <?php echo htmlspecialchars(t('pages.ads.services.ads.description')); ?>
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.text')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.extended')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.testing')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.adaptive')); ?></li>
                </ul>
            </div>
            
            <!-- Аудитории -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.ads.services.audiences.title')); ?></h3>
                <p class="text-gray-400 mb-4">
                    <?php echo htmlspecialchars(t('pages.ads.services.audiences.description')); ?>
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.audiences.items.segmentation')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.audiences.items.retargeting')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.audiences.items.similar')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.audiences.items.demographic')); ?></li>
                </ul>
            </div>
            
            <!-- Оптимизация -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.ads.services.optimization.title')); ?></h3>
                <p class="text-gray-400 mb-4">
                    <?php echo htmlspecialchars(t('pages.ads.services.optimization.description')); ?>
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.optimization.items.monitoring')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.optimization.items.bids')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.optimization.items.quality')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.optimization.items.budget')); ?></li>
                </ul>
            </div>
            
            <!-- Аналитика -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.5s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.ads.services.analytics.title')); ?></h3>
                <p class="text-gray-400 mb-4">
                    <?php echo htmlspecialchars(t('pages.ads.services.analytics.description')); ?>
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.analytics.items.goals')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.analytics.items.conversions')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.analytics.items.reports')); ?></li>
                    <li>• <?php echo htmlspecialchars(t('pages.ads.services.analytics.items.recommendations')); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Результаты -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.ads.results.title')); ?></h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.ads.results.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll group">
                <div class="relative inline-block mb-4">
                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple/30 to-neon-blue/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-5xl md:text-6xl font-bold text-gradient counter-wrapper">
                        <span class="counter-number" data-target="45" data-prefix="+" data-suffix="%">+45%</span>
                    </div>
                </div>
                <p class="text-gray-400 text-lg group-hover:text-gray-300 transition-colors duration-300"><?php echo htmlspecialchars(t('pages.ads.results.ctr')); ?></p>
            </div>
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.1s;">
                <div class="relative inline-block mb-4">
                    <div class="absolute inset-0 bg-gradient-to-r from-neon-blue/30 to-neon-purple/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-5xl md:text-6xl font-bold text-gradient counter-wrapper">
                        <span class="counter-number" data-target="120" data-prefix="+" data-suffix="%">+120%</span>
                    </div>
                </div>
                <p class="text-gray-400 text-lg group-hover:text-gray-300 transition-colors duration-300"><?php echo htmlspecialchars(t('pages.ads.results.conversions')); ?></p>
            </div>
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.2s;">
                <div class="relative inline-block mb-4">
                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple/30 to-neon-blue/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-5xl md:text-6xl font-bold text-gradient counter-wrapper">
                        <span class="counter-number" data-target="35" data-prefix="-" data-suffix="%">-35%</span>
                    </div>
                </div>
                <p class="text-gray-400 text-lg group-hover:text-gray-300 transition-colors duration-300"><?php echo htmlspecialchars(t('pages.ads.results.cost')); ?></p>
            </div>
            <div class="text-center animate-on-scroll group" style="animation-delay: 0.3s;">
                <div class="relative inline-block mb-4">
                    <div class="absolute inset-0 bg-gradient-to-r from-neon-blue/30 to-neon-purple/30 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-5xl md:text-6xl font-bold text-gradient counter-wrapper">
                        <span class="counter-number" data-target="200" data-prefix="+" data-suffix="%">+200%</span>
                    </div>
                </div>
                <p class="text-gray-400 text-lg group-hover:text-gray-300 transition-colors duration-300"><?php echo htmlspecialchars(t('pages.ads.results.roi')); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.ads.process.title')); ?></h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.ads.process.subtitle')); ?>
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    1
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.ads.process.step1.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.ads.process.step1.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    2
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.ads.process.step2.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.ads.process.step2.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    3
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.ads.process.step3.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.ads.process.step3.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    4
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.ads.process.step4.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.ads.process.step4.description')); ?>
                    </p>
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
                <?php echo htmlspecialchars(t('pages.ads.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.ads.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.ads.cta.button')); ?>
            </a>
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

<?php include 'includes/footer.php'; ?>

