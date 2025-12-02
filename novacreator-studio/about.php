<?php
/**
 * Страница о компании
 * Информация о команде и ценностях агентства
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.about.breadcrumb');
$pageMetaTitle = t('seo.pages.about.title');
$pageMetaDescription = t('seo.pages.about.description');
$pageMetaKeywords = t('seo.pages.about.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.about.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.about.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- О компании -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.about.whoWeAre.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.description1')); ?>
                </p>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.description2')); ?>
                </p>
                <p class="text-lg text-gray-400 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.description3')); ?>
                </p>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gradient mb-2">10+</div>
                            <p class="text-gray-400 text-sm"><?php echo htmlspecialchars(t('pages.about.stats.experience')); ?></p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gradient mb-2">100%</div>
                            <p class="text-gray-400 text-sm"><?php echo htmlspecialchars(t('pages.about.stats.online')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ценности -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.about.values.title')); ?></h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.about.values.subtitle')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.about.values.quality.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('pages.about.values.quality.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.about.values.speed.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('pages.about.values.speed.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.about.values.transparency.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('pages.about.values.transparency.description')); ?>
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.about.values.result.title')); ?></h3>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars(t('pages.about.values.result.description')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Почему мы -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.about.why.title')); ?></h2>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.about.why.individual.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.about.why.individual.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.about.why.transparency.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.about.why.transparency.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.about.why.fast.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.about.why.fast.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.about.why.honest.title')); ?></h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo htmlspecialchars(t('pages.about.why.honest.description')); ?>
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
                <?php echo htmlspecialchars(t('pages.about.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.about.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.about.cta.button')); ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

