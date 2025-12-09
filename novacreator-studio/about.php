<?php
/**
 * Страница о компании
 * Минималистичный дизайн в стиле holymedia.kz
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
<section class="pt-24 md:pt-32 pb-16 md:pb-20" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.about.title')); ?>
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary); max-width: 65ch;">
                <?php echo htmlspecialchars(t('pages.about.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- О компании -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-6 animate-on-scroll" style="animation-delay: 0.1s;">
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.description1')); ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.description2')); ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.about.whoWeAre.description3')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Ценности -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.about.values.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.values.quality.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.values.quality.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.values.speed.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.values.speed.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.values.transparency.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.values.transparency.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.4s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.values.result.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.values.result.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Почему мы -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.about.why.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.why.individual.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.why.individual.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.why.transparency.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.why.transparency.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.why.fast.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.why.fast.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.4s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.about.why.honest.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.about.why.honest.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.about.cta.title')); ?>
            </h2>
            <p class="text-xl md:text-2xl mb-10 md:mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.about.cta.subtitle')); ?>
            </p>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px]">
                    <?php echo htmlspecialchars(t('pages.about.cta.button')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Скрипт для анимации -->
<script>
document.addEventListener('DOMContentLoaded', function() {
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
