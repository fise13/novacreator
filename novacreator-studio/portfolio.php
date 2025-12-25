<?php
/**
 * Страница портфолио
 * Показывает реальные проекты компании в существующем дизайне
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'Portfolio' : 'Портфолио';
$pageMetaTitle = $currentLang === 'en' 
    ? 'Portfolio — Nova Creator Studio'
    : 'Портфолио — Nova Creator Studio';
$pageMetaDescription = $currentLang === 'en'
    ? 'Examples of real projects Nova Creator Studio: websites, SEO and advertising'
    : 'Примеры реальных проектов Nova Creator Studio: сайты, SEO и реклама';
$pageMetaKeywords = $currentLang === 'en'
    ? 'portfolio, projects, website development, seo, advertising, cases'
    : 'портфолио, проекты, разработка сайтов, seo, реклама, кейсы';
$pageMetaCanonical = '/portfolio';

include __DIR__ . '/includes/header.php';

// Данные проектов
$projects = [
    [
        'id' => 'northern-beans',
        'name' => [
            'ru' => 'Northern Beans',
            'en' => 'Northern Beans',
        ],
        'type' => [
            'ru' => 'Лендинг',
            'en' => 'Landing Page',
        ],
        'description' => [
            'ru' => 'Лендинг для кофейни с сезонным меню и онлайн-заказами. Тёплый дизайн, адаптивная вёрстка.',
            'en' => 'Landing page for a coffee shop with seasonal menu and online orders. Warm design, responsive layout.',
        ],
        'demo_url' => '/demo.php?project=northern-beans',
        'icon' => '☕',
        'color' => '#f59e0b',
    ],
    [
        'id' => 'bodycraft',
        'name' => [
            'ru' => 'BodyCraft',
            'en' => 'BodyCraft',
        ],
        'type' => [
            'ru' => 'Лендинг',
            'en' => 'Landing Page',
        ],
        'description' => [
            'ru' => 'Лендинг для персонального фитнес-тренера с прогресс-трекерами и формами записи.',
            'en' => 'Landing page for a personal fitness trainer with progress trackers and booking forms.',
        ],
        'demo_url' => '/demo.php?project=bodycraft',
        'icon' => '🏋️',
        'color' => '#22c55e',
    ],
    [
        'id' => 'urbanframe',
        'name' => [
            'ru' => 'UrbanFrame',
            'en' => 'UrbanFrame',
        ],
        'type' => [
            'ru' => 'Лендинг',
            'en' => 'Landing Page',
        ],
        'description' => [
            'ru' => 'Лендинг строительной компании с пошаговым процессом и калькулятором стоимости.',
            'en' => 'Landing page for a construction company with step-by-step process and cost calculator.',
        ],
        'demo_url' => '/demo.php?project=urbanframe',
        'icon' => '🏗️',
        'color' => '#f97316',
    ],
    [
        'id' => 'technest',
        'name' => [
            'ru' => 'TechNest',
            'en' => 'TechNest',
        ],
        'type' => [
            'ru' => 'Интернет-магазин',
            'en' => 'E-commerce',
        ],
        'description' => [
            'ru' => 'Интернет-магазин техники с каталогом товаров, корзиной и системой фильтров.',
            'en' => 'E-commerce store for electronics with product catalog, shopping cart and filter system.',
        ],
        'demo_url' => '/demo.php?project=technest',
        'icon' => '🛒',
        'color' => '#0ea5e9',
    ],
    [
        'id' => 'lakeview-hotel',
        'name' => [
            'ru' => 'Lakeview Hotel',
            'en' => 'Lakeview Hotel',
        ],
        'type' => [
            'ru' => 'Лендинг',
            'en' => 'Landing Page',
        ],
        'description' => [
            'ru' => 'Лендинг бутик-отеля с подбором номеров, фильтрами и формой бронирования.',
            'en' => 'Landing page for a boutique hotel with room selection, filters and booking form.',
        ],
        'demo_url' => '/demo.php?project=lakeview-hotel',
        'icon' => '🏨',
        'color' => '#14b8a6',
    ],
];
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Portfolio' : 'Портфолио'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en'
                    ? 'Real projects from different niches: from coffee shops and fitness to online stores and hotels'
                    : 'Реальные проекты из разных ниш: от кофеен и фитнеса до интернет-магазинов и отелей'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Описание -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'These are real projects we\'ve completed for clients. We show what services were performed: website development, landing pages, online stores, SEO optimization, and advertising setup.'
                        : 'Это реальные проекты, которые мы выполнили для клиентов. Показываем, какие услуги выполнялись: разработка сайтов, лендинги, интернет-магазины, SEO-оптимизация и настройка рекламы.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Сетка проектов -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
                <?php foreach ($projects as $index => $project): ?>
                    <div class="group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                        <!-- Иконка проекта -->
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mb-6 flex items-center justify-center rounded-xl transition-all duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($project['color']); ?>20, <?php echo htmlspecialchars($project['color']); ?>10);">
                            <span class="text-3xl sm:text-4xl"><?php echo htmlspecialchars($project['icon']); ?></span>
                        </div>
                        
                        <!-- Тип услуги -->
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium" style="background-color: <?php echo htmlspecialchars($project['color']); ?>20; color: <?php echo htmlspecialchars($project['color']); ?>;">
                                <?php echo htmlspecialchars($project['type'][$currentLang]); ?>
                            </span>
                        </div>
                        
                        <!-- Название проекта -->
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($project['name'][$currentLang]); ?>
                        </h3>
                        
                        <!-- Описание -->
                        <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($project['description'][$currentLang]); ?>
                        </p>
                        
                        <!-- Кнопка "Смотреть проект" -->
                        <a href="<?php echo htmlspecialchars($project['demo_url']); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 hover:opacity-70 hover:translate-x-1 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'View Project' : 'Смотреть проект'; ?></span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-12 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Ready to Start Working?' : 'Готовы начать работу?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en'
                    ? 'Contact us and let\'s discuss your project'
                    : 'Свяжитесь с нами и обсудим ваш проект'; ?>
            </p>
            <div class="reveal flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Discuss Project' : 'Обсудить проект'; ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

