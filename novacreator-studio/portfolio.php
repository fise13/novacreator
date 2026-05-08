<?php
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.portfolio.breadcrumb');
$pageMetaTitle = t('seo.pages.portfolio.title');
$pageMetaDescription = t('seo.pages.portfolio.description');
$pageMetaKeywords = t('seo.pages.portfolio.keywords');
include 'includes/header.php';

$ui = [
    'portfolioLabel' => t('pages.portfolio.selectionLabel'),
    'sectionTitle' => t('pages.portfolio.selectedCasesTitle'),
    'sectionSubtitle' => t('pages.portfolio.selectedCasesSubtitle'),
    'viewCase' => t('pages.portfolio.viewCase'),
    'timeline' => t('pages.portfolio.timeline'),
    'stack' => t('pages.portfolio.stack'),
    'contactCta' => t('pages.portfolio.cta.button')
];

$projects = [
    [
        'title' => 'Motor-Land.kz',
        'service' => $currentLang === 'en' ? 'Web Product' : 'Web-продукт',
        'description' => $currentLang === 'en'
            ? 'Commercial website for contract engines and auto parts with conversion-oriented UX and clear catalog structure.'
            : 'Коммерческий сайт по контрактным двигателям и автозапчастям с конверсионным UX и понятной структурой каталога.',
        'timeline' => $currentLang === 'en' ? 'Iterative development' : 'Итерационная разработка',
        'stack' => 'PHP, Tailwind, JavaScript',
        'detail_url' => getLocalizedUrl($currentLang, '/portfolio-motor-land'),
        'accent' => 'from-neon-blue/30 to-neon-purple/20'
    ],
    [
        'title' => 'AutoCore (iOS + macOS)',
        'service' => $currentLang === 'en' ? 'Native App Platform' : 'Нативная App-платформа',
        'description' => $currentLang === 'en'
            ? 'Cross-platform native app for operational workflows with synchronized data and scalable architecture.'
            : 'Кроссплатформенное нативное приложение для рабочих процессов с синхронизацией данных и масштабируемой архитектурой.',
        'timeline' => $currentLang === 'en' ? 'Product development' : 'Продуктовая разработка',
        'stack' => 'SwiftUI, Firebase, Google Sign-In',
        'detail_url' => getLocalizedUrl($currentLang, '/portfolio-autocore'),
        'accent' => 'from-neon-purple/35 to-neon-blue/15'
    ]
];
?>

<section class="portfolio-redesign-hero reveal-group border-b pt-24 pb-12 md:pt-28 md:pb-16" style="background-color: var(--color-bg); border-color: var(--color-border);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto text-center">
            <p class="portfolio-redesign-kicker reveal"><?php echo htmlspecialchars($ui['portfolioLabel']); ?></p>
            <h1 class="portfolio-redesign-title reveal"><?php echo htmlspecialchars(t('pages.portfolio.title')); ?></h1>
            <p class="portfolio-redesign-subtitle reveal"><?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?></p>
        </div>
    </div>
</section>

<section class="portfolio-redesign-list reveal-group pb-16 md:pb-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="portfolio-redesign-list-head reveal">
                <h2><?php echo htmlspecialchars($ui['sectionTitle']); ?></h2>
                <p><?php echo htmlspecialchars($ui['sectionSubtitle']); ?></p>
            </div>

            <div class="portfolio-redesign-grid">
                <?php foreach ($projects as $project): ?>
                    <article class="portfolio-redesign-card reveal" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                        <div class="portfolio-redesign-card-media bg-gradient-to-br <?php echo htmlspecialchars($project['accent']); ?>">
                            <span class="portfolio-redesign-card-service"><?php echo htmlspecialchars($project['service']); ?></span>
                        </div>
                        <div class="portfolio-redesign-card-body">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <div class="portfolio-redesign-meta">
                                <div>
                                    <span><?php echo htmlspecialchars($ui['timeline']); ?></span>
                                    <strong><?php echo htmlspecialchars($project['timeline']); ?></strong>
                                </div>
                                <div>
                                    <span><?php echo htmlspecialchars($ui['stack']); ?></span>
                                    <strong><?php echo htmlspecialchars($project['stack']); ?></strong>
                                </div>
                            </div>
                            <a class="portfolio-redesign-link" href="<?php echo htmlspecialchars($project['detail_url']); ?>">
                                <?php echo htmlspecialchars($ui['viewCase']); ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="reveal mb-4 text-2xl font-semibold tracking-tight md:text-3xl" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="reveal mb-8 text-base md:text-lg" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="reveal inline-block rounded-xl px-8 py-3.5 text-base font-semibold transition-opacity duration-200 hover:opacity-90 md:px-10 md:py-4 md:text-lg" style="background-color: var(--color-text); color: var(--color-bg);">
                <?php echo htmlspecialchars($ui['contactCta']); ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

