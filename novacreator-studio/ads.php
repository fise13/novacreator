<?php
/**
 * Страница Google Ads
 * Минималистичный дизайн в стиле holymedia.kz
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
<section class="pt-24 md:pt-32 pb-16 md:pb-20" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.ads.title')); ?>
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary); max-width: 65ch;">
                <?php echo htmlspecialchars(t('pages.ads.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Что мы делаем -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.ads.includes.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.ads.includes.subtitle')); ?>
                </p>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.services.setup.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.services.setup.description')); ?>
                    </p>
                    <div class="space-y-3">
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.search')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.rsya')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.retargeting')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.setup.items.remarketing')); ?></p>
                    </div>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.services.keywords.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.services.keywords.description')); ?>
                    </p>
                    <div class="space-y-3">
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.selection')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.grouping')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.negative')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.keywords.items.queries')); ?></p>
                    </div>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.services.ads.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.services.ads.description')); ?>
                    </p>
                    <div class="space-y-3">
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.text')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.extended')); ?></p>
                        <p class="text-lg" style="color: var(--color-text-secondary);">• <?php echo htmlspecialchars(t('pages.ads.services.ads.items.testing')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Результаты -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.ads.results.title')); ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
                <div class="text-center animate-on-scroll">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold mb-4" style="color: var(--color-text);">
                        <span class="counter-number" data-target="45" data-prefix="+" data-suffix="%">0</span>
                    </div>
                    <p class="text-lg md:text-xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.ads.results.ctr')); ?>
                    </p>
                </div>
                <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold mb-4" style="color: var(--color-text);">
                        <span class="counter-number" data-target="120" data-prefix="+" data-suffix="%">0</span>
                    </div>
                    <p class="text-lg md:text-xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.ads.results.conversions')); ?>
                    </p>
                </div>
                <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold mb-4" style="color: var(--color-text);">
                        <span class="counter-number" data-target="35" data-prefix="-" data-suffix="%">0</span>
                    </div>
                    <p class="text-lg md:text-xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.ads.results.cost')); ?>
                    </p>
                </div>
                <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold mb-4" style="color: var(--color-text);">
                        <span class="counter-number" data-target="200" data-prefix="+" data-suffix="%">0</span>
                    </div>
                    <p class="text-lg md:text-xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.ads.results.roi')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.ads.process.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">1</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.process.step1.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.process.step1.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">2</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.process.step2.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.process.step2.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">3</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.process.step3.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.process.step3.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">4</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.ads.process.step4.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.ads.process.step4.description')); ?>
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
                <?php echo htmlspecialchars(t('pages.ads.cta.title')); ?>
            </h2>
            <p class="text-xl md:text-2xl mb-10 md:mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.ads.cta.subtitle')); ?>
            </p>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px]">
                    <?php echo htmlspecialchars(t('pages.ads.cta.button')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Скрипт для анимации -->
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
