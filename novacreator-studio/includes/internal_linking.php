<?php
/**
 * Компонент улучшенной внутренней перелинковки
 * Автоматически создает релевантные ссылки на другие страницы сайта
 */

if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

$currentLang = getCurrentLanguage();
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Определяем релевантные страницы для перелинковки (оптимизировано для SEO)
$internalLinks = [
    'index' => [
        ['url' => '/seo', 'text' => $currentLang === 'en' ? 'SEO Optimization Services' : 'SEO-оптимизация сайтов', 'description' => $currentLang === 'en' ? 'Professional SEO services - Top 10 ranking in Google and Yandex' : 'Профессиональные SEO услуги - Продвижение в топ-10 Google и Яндекс', 'anchor' => 'seo-services'],
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'Digital Marketing Services' : 'Услуги digital-маркетинга', 'description' => $currentLang === 'en' ? 'Comprehensive digital services: SEO, development, advertising' : 'Комплексные digital услуги: SEO, разработка, реклама', 'anchor' => 'all-services'],
        ['url' => '/ads', 'text' => $currentLang === 'en' ? 'Google Ads Setup and Management' : 'Настройка и ведение Google Ads', 'description' => $currentLang === 'en' ? 'Contextual advertising setup and optimization' : 'Настройка и оптимизация контекстной рекламы', 'anchor' => 'google-ads'],
        ['url' => '/portfolio', 'text' => $currentLang === 'en' ? 'SEO Case Studies and Portfolio' : 'Кейсы SEO и портфолио', 'description' => $currentLang === 'en' ? 'See real results of our SEO work' : 'Посмотрите реальные результаты наших SEO работ', 'anchor' => 'seo-cases'],
        ['url' => '/blog', 'text' => $currentLang === 'en' ? 'SEO and Marketing Blog' : 'Блог о SEO и маркетинге', 'description' => $currentLang === 'en' ? 'Articles about SEO, website promotion and marketing' : 'Статьи о SEO, продвижении сайтов и маркетинге', 'anchor' => 'seo-blog'],
        ['url' => '/faq', 'text' => $currentLang === 'en' ? 'SEO FAQ' : 'Вопросы и ответы по SEO', 'description' => $currentLang === 'en' ? 'Frequently asked questions about SEO promotion' : 'Часто задаваемые вопросы о SEO продвижении', 'anchor' => 'seo-faq'],
    ],
    'services' => [
        ['url' => '/seo', 'text' => $currentLang === 'en' ? 'SEO Optimization' : 'SEO-оптимизация', 'description' => $currentLang === 'en' ? 'Learn more about SEO' : 'Узнать больше о SEO'],
        ['url' => '/ads', 'text' => $currentLang === 'en' ? 'Google Ads' : 'Google Ads', 'description' => $currentLang === 'en' ? 'Advertising services' : 'Рекламные услуги'],
        ['url' => '/calculator', 'text' => $currentLang === 'en' ? 'Cost Calculator' : 'Калькулятор стоимости', 'description' => $currentLang === 'en' ? 'Calculate project cost' : 'Рассчитать стоимость проекта'],
        ['url' => '/contact', 'text' => $currentLang === 'en' ? 'Contact Us' : 'Связаться с нами', 'description' => $currentLang === 'en' ? 'Get in touch' : 'Связаться'],
    ],
    'seo' => [
        ['url' => '/', 'text' => $currentLang === 'en' ? 'SEO Agency Homepage' : 'Главная страница SEO агентства', 'description' => $currentLang === 'en' ? 'NovaCreator Studio - Professional SEO Services' : 'NovaCreator Studio - Профессиональные SEO услуги', 'anchor' => 'home'],
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'All Digital Marketing Services' : 'Все услуги digital-маркетинга', 'description' => $currentLang === 'en' ? 'Complete range of digital services' : 'Полный спектр digital услуг', 'anchor' => 'services'],
        ['url' => '/ads', 'text' => $currentLang === 'en' ? 'Google Ads for SEO Boost' : 'Google Ads для усиления SEO', 'description' => $currentLang === 'en' ? 'Combine SEO with contextual advertising for maximum results' : 'Комбинируйте SEO с контекстной рекламой для максимального результата', 'anchor' => 'google-ads-seo'],
        ['url' => '/blog', 'text' => $currentLang === 'en' ? 'SEO Optimization Articles and Guides' : 'Статьи и гайды по SEO оптимизации', 'description' => $currentLang === 'en' ? 'Expert articles about SEO, website promotion and search engine optimization' : 'Экспертные статьи о SEO, продвижении сайтов и оптимизации', 'anchor' => 'seo-articles'],
        ['url' => '/calculator', 'text' => $currentLang === 'en' ? 'SEO Promotion Cost Calculator' : 'Калькулятор стоимости SEO продвижения', 'description' => $currentLang === 'en' ? 'Calculate the cost of SEO services for your project' : 'Рассчитайте стоимость SEO услуг для вашего проекта', 'anchor' => 'seo-calculator'],
        ['url' => '/faq', 'text' => $currentLang === 'en' ? 'SEO Promotion FAQ' : 'Вопросы и ответы о SEO продвижении', 'description' => $currentLang === 'en' ? 'Answers to popular questions about SEO optimization' : 'Ответы на популярные вопросы о SEO оптимизации', 'anchor' => 'seo-faq'],
        ['url' => '/portfolio', 'text' => $currentLang === 'en' ? 'SEO Promotion Case Studies' : 'Кейсы SEO продвижения', 'description' => $currentLang === 'en' ? 'Real results of SEO website promotion to top-10' : 'Реальные результаты SEO продвижения сайтов в топ-10', 'anchor' => 'seo-cases'],
    ],
    'ads' => [
        ['url' => '/seo', 'text' => $currentLang === 'en' ? 'SEO Services' : 'SEO услуги', 'description' => $currentLang === 'en' ? 'Combine with SEO' : 'Комбинировать с SEO'],
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'All Services' : 'Все услуги', 'description' => $currentLang === 'en' ? 'View all services' : 'Посмотреть все услуги'],
        ['url' => '/blog', 'text' => $currentLang === 'en' ? 'Google Ads Articles' : 'Статьи о Google Ads', 'description' => $currentLang === 'en' ? 'Learn about advertising' : 'Узнать о рекламе'],
    ],
    'blog' => [
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'Our Services' : 'Наши услуги', 'description' => $currentLang === 'en' ? 'See what we offer' : 'Посмотреть что мы предлагаем'],
        ['url' => '/seo', 'text' => $currentLang === 'en' ? 'SEO Optimization' : 'SEO-оптимизация', 'description' => $currentLang === 'en' ? 'Professional SEO' : 'Профессиональный SEO'],
        ['url' => '/contact', 'text' => $currentLang === 'en' ? 'Get Consultation' : 'Получить консультацию', 'description' => $currentLang === 'en' ? 'Contact us' : 'Связаться с нами'],
    ],
    'about' => [
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'Our Services' : 'Наши услуги', 'description' => $currentLang === 'en' ? 'What we do' : 'Что мы делаем'],
        ['url' => '/portfolio', 'text' => $currentLang === 'en' ? 'Our Work' : 'Наши работы', 'description' => $currentLang === 'en' ? 'See examples' : 'Посмотреть примеры'],
        ['url' => '/contact', 'text' => $currentLang === 'en' ? 'Contact Us' : 'Связаться с нами', 'description' => $currentLang === 'en' ? 'Get in touch' : 'Связаться'],
    ],
];

// Получаем ссылки для текущей страницы
$pageLinks = $internalLinks[$currentPage] ?? $internalLinks['index'];

// Ограничиваем количество ссылок
$pageLinks = array_slice($pageLinks, 0, 4);

// Скрываем перелинковку на странице demo.php
$hideOnDemo = (basename($_SERVER['PHP_SELF']) === 'demo.php');
?>

<!-- Внутренняя перелинковка -->
<?php if (!empty($pageLinks) && !$hideOnDemo): ?>
<section class="py-12 md:py-16 bg-dark-surface/50 border-t border-b border-dark-border">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-bold mb-8 text-gradient text-center">
                <?php echo $currentLang === 'en' ? 'Explore More' : 'Узнать больше'; ?>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <?php foreach ($pageLinks as $link): ?>
                    <?php 
                    $linkUrl = getLocalizedUrl($currentLang, $link['url']);
                    $linkUrlWithAnchor = !empty($link['anchor']) ? $linkUrl . '#' . $link['anchor'] : $linkUrl;
                    ?>
                    <a 
                        href="<?php echo htmlspecialchars($linkUrlWithAnchor); ?>" 
                        class="group bg-dark-bg border border-dark-border rounded-xl p-5 md:p-6 hover:border-neon-purple transition-all duration-300 hover:-translate-y-1"
                        onclick="trackInternalLink('<?php echo htmlspecialchars($link['url']); ?>')"
                        title="<?php echo htmlspecialchars($link['description']); ?>"
                        aria-label="<?php echo htmlspecialchars($link['text'] . ' - ' . $link['description']); ?>"
                    >
                        <h4 class="text-lg md:text-xl font-semibold mb-2 text-gradient group-hover:text-neon-blue transition-colors">
                            <?php echo htmlspecialchars($link['text']); ?>
                        </h4>
                        <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors">
                            <?php echo htmlspecialchars($link['description']); ?>
                        </p>
                        <div class="mt-4 flex items-center text-neon-purple group-hover:text-neon-blue transition-colors">
                            <span class="text-sm font-semibold">
                                <?php echo $currentLang === 'en' ? 'Learn more' : 'Узнать больше'; ?>
                            </span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
// Отслеживание кликов по внутренним ссылкам
function trackInternalLink(url) {
    if (typeof gtag !== 'undefined') {
        gtag('event', 'click', {
            'event_category': 'internal_link',
            'event_label': url,
            'transport_type': 'beacon'
        });
    }
    
    if (typeof dataLayer !== 'undefined') {
        dataLayer.push({
            'event': 'internal_link_click',
            'url': url
        });
    }
}
</script>
<?php endif; ?>

