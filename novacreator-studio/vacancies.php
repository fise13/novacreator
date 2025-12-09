<?php
/**
 * Страница вакансий
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.vacancies.breadcrumb');
$pageMetaTitle = t('seo.pages.vacancies.title');
$pageMetaDescription = t('seo.pages.vacancies.description');
$pageMetaKeywords = t('seo.pages.vacancies.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-24 md:pt-32 pb-16 md:pb-20" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.vacancies.title')); ?>
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary); max-width: 65ch;">
                <?php echo htmlspecialchars(t('pages.vacancies.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- О работе в компании -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.vacancies.whyUs.title')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.vacancies.whyUs.description')); ?>
                </p>
            </div>
            
            <div class="space-y-6 mb-12 animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.remote')); ?>
                    </p>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.flexible')); ?>
                    </p>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.interesting')); ?>
                    </p>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.development')); ?>
                    </p>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl font-bold" style="color: var(--color-text);">•</span>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.team')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Открытые вакансии -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 animate-on-scroll">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.vacancies.openVacancies.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <!-- Вакансия 1 -->
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.seo.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.seo.description')); ?>
                    </p>
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.full')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.experience2')); ?>
                        </span>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.seo.title')); ?>" class="inline-block px-8 py-4 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
                
                <!-- Вакансия 2 -->
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.developer.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.developer.description')); ?>
                    </p>
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.part')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.experience1')); ?>
                        </span>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.developer.title')); ?>" class="inline-block px-8 py-4 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
                
                <!-- Вакансия 3 -->
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.ads.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.ads.description')); ?>
                    </p>
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.full')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.experience1')); ?>
                        </span>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.ads.title')); ?>" class="inline-block px-8 py-4 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
                
                <!-- Вакансия 4 -->
                <div class="animate-on-scroll" style="animation-delay: 0.4s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.content.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('pages.vacancies.vacancies.content.description')); ?>
                    </p>
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.part')); ?>
                        </span>
                        <span class="px-4 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.vacancies.tags.experience0')); ?>
                        </span>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.content.title')); ?>" class="inline-block px-8 py-4 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
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
