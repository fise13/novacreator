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

// Определяем релевантные страницы для перелинковки
$internalLinks = [
    'index' => [
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'Our Services' : 'Наши услуги', 'description' => $currentLang === 'en' ? 'View all our services' : 'Посмотреть все наши услуги'],
        ['url' => '/seo', 'text' => $currentLang === 'en' ? 'SEO Optimization' : 'SEO-оптимизация', 'description' => $currentLang === 'en' ? 'Professional SEO services' : 'Профессиональные SEO услуги'],
        ['url' => '/ads', 'text' => $currentLang === 'en' ? 'Google Ads' : 'Google Ads', 'description' => $currentLang === 'en' ? 'Advertising management' : 'Управление рекламой'],
        ['url' => '/portfolio', 'text' => $currentLang === 'en' ? 'Portfolio' : 'Портфолио', 'description' => $currentLang === 'en' ? 'Our work examples' : 'Примеры наших работ'],
        ['url' => '/blog', 'text' => $currentLang === 'en' ? 'Blog' : 'Блог', 'description' => $currentLang === 'en' ? 'Useful articles' : 'Полезные статьи'],
    ],
    'services' => [
        ['url' => '/seo', 'text' => $currentLang === 'en' ? 'SEO Optimization' : 'SEO-оптимизация', 'description' => $currentLang === 'en' ? 'Learn more about SEO' : 'Узнать больше о SEO'],
        ['url' => '/ads', 'text' => $currentLang === 'en' ? 'Google Ads' : 'Google Ads', 'description' => $currentLang === 'en' ? 'Advertising services' : 'Рекламные услуги'],
        ['url' => '/calculator', 'text' => $currentLang === 'en' ? 'Cost Calculator' : 'Калькулятор стоимости', 'description' => $currentLang === 'en' ? 'Calculate project cost' : 'Рассчитать стоимость проекта'],
        ['url' => '/contact', 'text' => $currentLang === 'en' ? 'Contact Us' : 'Связаться с нами', 'description' => $currentLang === 'en' ? 'Get in touch' : 'Связаться'],
    ],
    'seo' => [
        ['url' => '/services', 'text' => $currentLang === 'en' ? 'All Services' : 'Все услуги', 'description' => $currentLang === 'en' ? 'View all services' : 'Посмотреть все услуги'],
        ['url' => '/ads', 'text' => $currentLang === 'en' ? 'Google Ads' : 'Google Ads', 'description' => $currentLang === 'en' ? 'Complement your SEO with ads' : 'Дополните SEO рекламой'],
        ['url' => '/blog', 'text' => $currentLang === 'en' ? 'SEO Articles' : 'Статьи о SEO', 'description' => $currentLang === 'en' ? 'Read SEO guides' : 'Читать руководства по SEO'],
        ['url' => '/calculator', 'text' => $currentLang === 'en' ? 'Calculate SEO Cost' : 'Рассчитать стоимость SEO', 'description' => $currentLang === 'en' ? 'Get a quote' : 'Получить расчет'],
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
?>

<!-- Внутренняя перелинковка -->
<?php if (!empty($pageLinks)): ?>
<section class="py-12 md:py-16 bg-dark-surface/50 border-t border-b border-dark-border">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-bold mb-8 text-gradient text-center">
                <?php echo $currentLang === 'en' ? 'Explore More' : 'Узнать больше'; ?>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <?php foreach ($pageLinks as $link): ?>
                    <a 
                        href="<?php echo getLocalizedUrl($currentLang, $link['url']); ?>" 
                        class="group bg-dark-bg border border-dark-border rounded-xl p-5 md:p-6 hover:border-neon-purple transition-all duration-300 hover:-translate-y-1"
                        onclick="trackInternalLink('<?php echo htmlspecialchars($link['url']); ?>')"
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
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

