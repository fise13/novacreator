<?php
/**
 * Страница вакансий
 * Информация о вакансиях и возможностях работы в NovaCreator Studio
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
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.vacancies.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- О работе в компании -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.whyUs.title')); ?></h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    <?php echo htmlspecialchars(t('pages.vacancies.whyUs.description')); ?>
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.remote')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.flexible')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.interesting')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.development')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.whyUs.benefits.team')); ?></span>
                    </li>
                </ul>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.weOffer.title')); ?></h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.weOffer.salary')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.weOffer.official')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.weOffer.learning')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.weOffer.projects')); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.vacancies.weOffer.career')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Открытые вакансии -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.openVacancies.title')); ?></h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                <?php echo htmlspecialchars(t('pages.vacancies.openVacancies.subtitle')); ?>
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Вакансия 1 -->
            <div class="service-card animate-on-scroll">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.vacancies.seo.title')); ?></h3>
                        <p class="text-gray-400 mb-4">
                            <?php echo htmlspecialchars(t('pages.vacancies.vacancies.seo.description')); ?>
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.full')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.experience2')); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.seo.title')); ?>" class="btn-neon whitespace-nowrap">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
            </div>
            
            <!-- Вакансия 2 -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.vacancies.developer.title')); ?></h3>
                        <p class="text-gray-400 mb-4">
                            <?php echo htmlspecialchars(t('pages.vacancies.vacancies.developer.description')); ?>
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.part')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.experience1')); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.developer.title')); ?>" class="btn-neon whitespace-nowrap">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
            </div>
            
            <!-- Вакансия 3 -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.vacancies.ads.title')); ?></h3>
                        <p class="text-gray-400 mb-4">
                            <?php echo htmlspecialchars(t('pages.vacancies.vacancies.ads.description')); ?>
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.full')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.experience1')); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.ads.title')); ?>" class="btn-neon whitespace-nowrap">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
            </div>
            
            <!-- Вакансия 4 -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.vacancies.content.title')); ?></h3>
                        <p class="text-gray-400 mb-4">
                            <?php echo htmlspecialchars(t('pages.vacancies.vacancies.content.description')); ?>
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.remote')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.part')); ?></span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400"><?php echo htmlspecialchars(t('pages.vacancies.tags.experience0')); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy&vacancy=<?php echo urlencode(t('pages.vacancies.vacancies.content.title')); ?>" class="btn-neon whitespace-nowrap">
                        <?php echo htmlspecialchars(t('pages.vacancies.apply')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Как откликнуться -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.howToApply.title')); ?></h2>
            <p class="text-xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.vacancies.howToApply.subtitle')); ?>
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6 text-2xl font-bold">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.howToApply.step1.title')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.vacancies.howToApply.step1.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6 text-2xl font-bold">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.howToApply.step2.title')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.vacancies.howToApply.step2.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6 text-2xl font-bold">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.vacancies.howToApply.step3.title')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.vacancies.howToApply.step3.description')); ?>
                    </p>
                </div>
            </div>
            
            <div class="mt-12">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy" class="btn-neon inline-block">
                    <?php echo htmlspecialchars(t('pages.vacancies.sendResume')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <?php echo htmlspecialchars(t('pages.vacancies.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.vacancies.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>?type=vacancy" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.vacancies.cta.button')); ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

