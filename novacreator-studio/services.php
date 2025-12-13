<?php
/**
 * Страница услуг
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.services.breadcrumb');
$pageMetaTitle = t('seo.pages.services.title');
$pageMetaDescription = t('seo.pages.services.description');
$pageMetaKeywords = t('seo.pages.services.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - Apple минималистичный дизайн на весь экран -->
<section class="parallax-hero reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Parallax background elements -->
    <div class="parallax-bg absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-br from-neon-purple/30 to-neon-blue/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-br from-neon-blue/30 to-neon-purple/30 rounded-full blur-3xl"></div>
    </div>
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="parallax-content max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.services.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- SEO-оптимизация -->
<section id="seo" class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.services.seo.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.services.seo.description')); ?>
                </p>
            </div>
            
            <div class="space-y-6 mb-8">
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.seo.features.technical')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.seo.features.content')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.seo.features.links')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.seo.features.reporting')); ?>
                    </p>
                </div>
            </div>
            
            <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="reveal inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.seo.learnMore')); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Разработка сайтов -->
<section id="development" class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.services.development.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.services.development.description')); ?>
                </p>
            </div>
            
            <div class="space-y-6 mb-8">
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.development.types.landing')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.development.types.shop')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.development.types.app')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.development.types.support')); ?>
                    </p>
                </div>
            </div>
            
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="reveal inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.development.discuss')); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Google Ads -->
<section id="ads" class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.services.ads.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.services.ads.description')); ?>
                </p>
            </div>
            
            <div class="space-y-6 mb-8">
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.ads.features.setup')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.ads.features.ads')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.ads.features.keywords')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.ads.features.monitoring')); ?>
                    </p>
                </div>
            </div>
            
            <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="reveal inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.ads.learnMore')); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Маркетинг -->
<section id="marketing" class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.services.marketing.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.services.marketing.description')); ?>
                </p>
            </div>
            
            <div class="space-y-6 mb-8">
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.marketing.features.smm')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.marketing.features.content')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.marketing.features.email')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.marketing.features.branding')); ?>
                    </p>
                </div>
            </div>
            
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="reveal inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.marketing.discuss')); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Аналитика -->
<section id="analytics" class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.services.analytics.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.services.analytics.description')); ?>
                </p>
            </div>
            
            <div class="space-y-6 mb-8">
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.analytics.features.setup')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.analytics.features.tracking')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.analytics.features.testing')); ?>
                    </p>
                </div>
                <div class="reveal flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.analytics.features.reports')); ?>
                    </p>
                </div>
            </div>
            
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="reveal inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.analytics.setup')); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Гарантии -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.services.guarantees.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="reveal">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.lifetime.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.lifetime.description')); ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.support.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.services.guarantees.support.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - мобильная адаптация -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-96 md:h-96 rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-12 leading-tight reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.services.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.services.cta.subtitle')); ?>
            </p>
            <div class="reveal">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('pages.services.cta.button')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
