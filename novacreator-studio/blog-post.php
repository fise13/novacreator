<?php
/**
 * Страница отдельной статьи блога
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$blogFile = __DIR__ . '/data/blog.json';
$articles = [];
if (file_exists($blogFile)) {
    $articles = json_decode(file_get_contents($blogFile), true) ?: [];
}

// Находим статью по slug (поддержка обоих языков)
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$article = null;
foreach ($articles as $item) {
    // Проверяем русский и английский slug
    if ($item['slug'] === $slug || (isset($item['slug_en']) && $item['slug_en'] === $slug)) {
        $article = $item;
        // Увеличиваем счетчик просмотров
        $article['views'] = ($article['views'] ?? 0) + 1;
        // Обновляем в массиве
        foreach ($articles as &$art) {
            if ($art['id'] === $article['id']) {
                $art['views'] = $article['views'];
                break;
            }
        }
        // Сохраняем обновленные данные
        file_put_contents($blogFile, json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        break;
    }
}

// Функция для получения локализованного контента статьи
function getArticleField($article, $field, $lang) {
    if ($lang === 'en' && isset($article[$field . '_en']) && !empty($article[$field . '_en'])) {
        return $article[$field . '_en'];
    }
    return $article[$field] ?? '';
}

// Функция для получения локализованного slug
function getArticleSlug($article, $lang) {
    if ($lang === 'en' && isset($article['slug_en']) && !empty($article['slug_en'])) {
        return $article['slug_en'];
    }
    return $article['slug'] ?? '';
}

if (!$article) {
    header('HTTP/1.0 404 Not Found');
    include '404.php';
    exit;
}

$host = $_SERVER['HTTP_HOST'] ?? 'novacreator-studio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$siteBase = $scheme . '://' . $host;
$absoluteUrl = static function (?string $path) use ($siteBase): string {
    if (!$path) {
        return $siteBase;
    }
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return rtrim($siteBase, '/') . '/' . ltrim($path, '/');
};
// Получаем локализованные данные статьи
$articleTitle = getArticleField($article, 'title', $currentLang);
$articleExcerpt = getArticleField($article, 'excerpt', $currentLang);
$articleContent = getArticleField($article, 'content', $currentLang);
$articleSlug = getArticleSlug($article, $currentLang);
$articleCategory = $currentLang === 'en' ? ($article['category_en'] ?? $article['category']) : $article['category'];

$articleUrl = $siteBase . getLocalizedUrl($currentLang, '/blog-post') . '?slug=' . urlencode($articleSlug);
$articleImage = $absoluteUrl($article['image'] ?? '/assets/img/og-default.webp');

$pageTitle = $articleTitle;
$pageMetaTitle = $articleTitle . ' - NovaCreator Studio';
$pageMetaDescription = $articleExcerpt;
// SEO keywords для статей
$seoKeywords = [
    'ru' => [
        'SEO' => 'seo оптимизация, seo продвижение, продвижение сайтов, seo услуги, seo специалист, seo компания, seo агентство, продвижение сайта в топ, вывести сайт в топ, seo продвижение сайта, seo оптимизация сайта, продвижение сайта в google, продвижение сайта в яндекс, seo продвижение алматы, seo продвижение астана, seo продвижение казахстан',
        'Google Ads' => 'google ads, контекстная реклама, ppc, яндекс директ, настройка google ads, настройка яндекс директ, ведение рекламных кампаний, управление рекламными кампаниями, оптимизация рекламных кампаний, контекстная реклама google, контекстная реклама яндекс, поисковая реклама, медийная реклама, видеореклама, shopping кампании, ретаргетинг, ремаркетинг, настройка ретаргетинга, настройка ремаркетинга, похожие аудитории, таргетинг, сегментация аудитории, работа с аудиториями, создание объявлений, написание объявлений, тестирование объявлений, ab тестирование объявлений, оптимизация объявлений, улучшение объявлений, повышение эффективности объявлений, увеличение кликов по объявлениям, снижение стоимости клика, снижение стоимости заявки, снижение стоимости лида, снижение стоимости конверсии, увеличение количества заявок, увеличение количества звонков, увеличение количества продаж, рост продаж через интернет, увеличение продаж онлайн, привлечение клиентов через рекламу, привлечение клиентов через google ads, привлечение клиентов через яндекс директ, привлечение клиентов через контекстную рекламу, привлечение клиентов через интернет рекламу, привлечение клиентов через онлайн рекламу, привлечение клиентов через рекламу в интернете, привлечение клиентов через рекламу в сети, привлечение клиентов через рекламу онлайн, привлечение клиентов через рекламу в google, привлечение клиентов через рекламу в яндекс, привлечение клиентов через рекламу в поисковиках, привлечение клиентов через рекламу в поисковых системах',
        'Разработка' => 'разработка сайтов, создание сайтов, веб разработка, веб студия, разработка интернет магазинов, создание лендингов, разработка корпоративных сайтов, создание корпоративных сайтов, разработка сайта визитки, создание сайта визитки, разработка сайта каталога, создание сайта каталога, разработка веб приложения, создание веб приложения, разработка мобильного приложения, создание мобильного приложения, разработка приложения, создание приложения, разработка приложений, создание приложений, разработка сайта под ключ, создание сайта под ключ, разработка сайта цена, разработка сайта стоимость, заказать разработку сайта, купить сайт, стоимость разработки сайта, цена разработки сайта, разработка сайтов алматы, разработка сайтов астана, разработка сайтов шымкент, разработка сайтов караганда, разработка сайтов актобе, разработка сайтов казахстан, создание сайтов алматы, создание сайтов астана, создание сайтов шымкент, создание сайтов караганда, создание сайтов актобе, создание сайтов казахстан, веб студия алматы, веб студия астана, веб студия шымкент, веб студия караганда, веб студия актобе, веб студия казахстан',
        'Маркетинг' => 'интернет маркетинг, digital маркетинг, маркетинговые услуги, рекламные услуги, интернет реклама, онлайн реклама, реклама в интернете, реклама в сети, реклама онлайн, реклама в google, реклама в яндекс, реклама в поисковиках, реклама в поисковых системах, продвижение в интернете, реклама сайта, продвижение сайта в поисковиках, раскрутка сайта, продвижение сайта самостоятельно, как продвинуть сайт, как вывести сайт в топ, как увеличить трафик на сайт, как увеличить продажи через интернет, интернет реклама, онлайн реклама, реклама в google, реклама в яндекс, рекламное агентство, рекламное агентство алматы, рекламное агентство астана, маркетинговое агентство, маркетинговое агентство алматы, маркетинговое агентство астана, seo агентство, seo агентство алматы, seo агентство астана, digital агентство, digital агентство алматы, digital агентство астана, веб студия, веб студия казахстан, разработка сайтов, разработка сайтов казахстан, создание сайтов, создание сайтов казахстан',
        'Аналитика' => 'аналитика, настройка аналитики, настройка google analytics, настройка яндекс метрики, отслеживание конверсий, оптимизация конверсий, увеличение конверсий, рост конверсий, улучшение конверсий, повышение конверсий, увеличение продаж, рост продаж, улучшение продаж, повышение продаж, привлечение клиентов через интернет, привлечение клиентов через сайт, привлечение клиентов через рекламу, привлечение клиентов через seo, привлечение клиентов через контекстную рекламу, привлечение клиентов через google ads, привлечение клиентов через яндекс директ, привлечение клиентов через интернет маркетинг, привлечение клиентов через digital маркетинг, привлечение клиентов через интернет рекламу, привлечение клиентов через онлайн рекламу, привлечение клиентов через рекламу в интернете, привлечение клиентов через рекламу в сети, привлечение клиентов через рекламу онлайн, привлечение клиентов через рекламу в google, привлечение клиентов через рекламу в яндекс, привлечение клиентов через рекламу в поисковиках, привлечение клиентов через рекламу в поисковых системах'
    ],
    'en' => [
        'SEO' => 'seo optimization, seo promotion, website promotion, seo services, seo specialist, seo company, seo agency, website promotion to top, bring website to top, seo website promotion, seo website optimization, website promotion in google, website promotion in yandex, seo promotion almaty, seo promotion astana, seo promotion kazakhstan',
        'Google Ads' => 'google ads, contextual advertising, ppc, yandex direct, google ads setup, yandex direct setup, advertising campaign management, advertising campaign optimization, contextual advertising google, contextual advertising yandex, search advertising, display advertising, video advertising, shopping campaigns, retargeting, remarketing, retargeting setup, remarketing setup, similar audiences, targeting, audience segmentation, audience work, ad creation, ad writing, ad testing, ab testing, ad optimization, ad improvement, ad effectiveness increase, ad clicks increase, cost per click reduction, cost per lead reduction, cost per conversion reduction, leads increase, calls increase, sales increase, online sales growth, online sales increase, online customer acquisition, advertising customer acquisition, google ads customer acquisition, yandex direct customer acquisition, contextual advertising customer acquisition, online advertising customer acquisition, internet advertising customer acquisition',
        'Development' => 'website development, website creation, web development, web studio, ecommerce development, landing page creation, corporate website development, business card website development, catalog website development, web application development, mobile application development, application development, turnkey website development, website development price, website development cost, order website development, buy website, website development cost, website development price, website development almaty, website development astana, website development shymkent, website development karaganda, website development aktobe, website development kazakhstan, website creation almaty, website creation astana, website creation shymkent, website creation karaganda, website creation aktobe, website creation kazakhstan, web studio almaty, web studio astana, web studio shymkent, web studio karaganda, web studio aktobe, web studio kazakhstan',
        'Marketing' => 'internet marketing, digital marketing, marketing services, advertising services, online advertising, internet advertising, advertising online, google advertising, yandex advertising, advertising in search engines, promotion online, website advertising, website promotion in search engines, how to promote website, how to bring website to top, how to increase website traffic, how to increase sales online, online advertising, google advertising, yandex advertising, advertising agency, advertising agency almaty, advertising agency astana, marketing agency, marketing agency almaty, marketing agency astana, seo agency, seo agency almaty, seo agency astana, digital agency, digital agency almaty, digital agency astana, web studio, web studio kazakhstan, website development, website development kazakhstan, website creation, website creation kazakhstan',
        'Analytics' => 'analytics, analytics setup, google analytics setup, yandex metrica setup, conversion tracking, conversion optimization, conversion increase, conversion growth, conversion improvement, conversion boost, sales increase, sales growth, sales improvement, sales boost, online customer acquisition, website customer acquisition, advertising customer acquisition, seo customer acquisition, contextual advertising customer acquisition, google ads customer acquisition, yandex direct customer acquisition, internet marketing customer acquisition, digital marketing customer acquisition, online advertising customer acquisition, internet advertising customer acquisition'
    ]
];

$pageMetaKeywords = isset($seoKeywords[$currentLang][$articleCategory]) 
    ? $seoKeywords[$currentLang][$articleCategory]
    : ($currentLang === 'en' 
        ? $articleCategory . ', ' . strtolower($articleCategory) . ' articles, digital marketing, seo, web development'
        : $articleCategory . ', ' . strtolower($articleCategory) . ' статьи, digital маркетинг');
$pageMetaImage = $articleImage;
$pageMetaCanonical = $articleUrl;
$pageMetaOgType = 'article';

// Генерируем альтернативные языковые версии для статьи
$pageAlternateLanguages = [];
foreach (['ru', 'en'] as $lang) {
    $altSlug = $lang === 'en' ? ($article['slug_en'] ?? $article['slug']) : $article['slug'];
    $altUrl = $siteBase . getLocalizedUrl($lang, '/blog-post') . '?slug=' . urlencode($altSlug);
    $pageAlternateLanguages[$lang] = $altUrl;
}

$pageBreadcrumbs = [
    ['name' => t('nav.home'), 'url' => $siteBase . getLocalizedUrl($currentLang, '/')],
    ['name' => t('pages.blog.breadcrumb'), 'url' => $siteBase . getLocalizedUrl($currentLang, '/blog')],
    ['name' => $articleTitle, 'url' => $articleUrl]
];
$pageStructuredData = [
    '@type' => 'BlogPosting',
    'headline' => $articleTitle,
    'description' => $articleExcerpt,
    'image' => $articleImage,
    'datePublished' => $article['date'],
    'dateModified' => $article['date'],
    'author' => [
        '@type' => 'Organization',
        'name' => 'NovaCreator Studio',
        'url' => $siteBase
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'NovaCreator Studio',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $siteBase . '/assets/img/logo.svg'
        ]
    ],
    'mainEntityOfPage' => $articleUrl
];

include 'includes/header.php';

// Функция для форматирования даты
function formatDate($date, $lang = 'ru') {
    global $currentLang;
    $lang = $currentLang;
    if ($lang === 'en') {
        $months = [
            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];
        $parts = explode('-', $date);
        return $months[$parts[1]] . ' ' . (int)$parts[2] . ', ' . $parts[0];
    } else {
        $months = [
            '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
            '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
            '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
        ];
        $parts = explode('-', $date);
        return (int)$parts[2] . ' ' . $months[$parts[1]] . ' ' . $parts[0];
    }
}

// Получаем похожие статьи
$relatedArticles = array_filter($articles, function($item) use ($article, $currentLang) {
    $itemCategory = $currentLang === 'en' ? ($item['category_en'] ?? $item['category']) : $item['category'];
    $articleCategory = $currentLang === 'en' ? ($article['category_en'] ?? $article['category']) : $article['category'];
    return $itemCategory === $articleCategory && $item['id'] !== $article['id'];
});
$relatedArticles = array_slice($relatedArticles, 0, 3);
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div class="mb-6">
                <a href="<?php echo getLocalizedUrl($currentLang, '/blog'); ?>" class="text-neon-purple hover:text-neon-blue transition-colors inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <?php echo $currentLang === 'en' ? 'Back to Blog' : 'Вернуться к блогу'; ?>
                </a>
            </div>
            
            <div class="mb-6">
                <span class="text-sm text-neon-purple font-semibold"><?php echo htmlspecialchars($articleCategory); ?></span>
                <span class="text-gray-500 mx-2">•</span>
                <span class="text-sm text-gray-500"><?php echo formatDate($article['date'], $currentLang); ?></span>
                <?php if (isset($article['views']) && $article['views'] > 0): ?>
                    <span class="text-gray-500 mx-2">•</span>
                    <span class="text-sm text-gray-500"><?php echo $article['views']; ?> <?php echo $currentLang === 'en' ? 'views' : 'просмотров'; ?></span>
                <?php endif; ?>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars($articleTitle); ?></span>
            </h1>
            
            <p class="text-xl text-gray-400 mb-8">
                <?php echo htmlspecialchars($articleExcerpt); ?>
            </p>
            
            <div class="flex items-center space-x-4 text-gray-400">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span><?php echo htmlspecialchars($article['author']); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Содержание статьи -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <article class="prose prose-invert prose-lg max-w-none">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-8 lg:p-12 shadow-2xl" style="box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(139, 92, 246, 0.1);">
                    <div class="article-content">
                        <?php echo $articleContent; ?>
                    </div>
                </div>
            </article>
            
            <!-- Поделиться -->
            <div class="mt-12 pt-8 border-t border-dark-border">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gradient"><?php echo $currentLang === 'en' ? 'Share Article' : 'Поделиться статьей'; ?></h3>
                        <div class="flex space-x-4">
                            <a href="https://vk.com/share.php?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&title=<?php echo urlencode($article['title']); ?>" target="_blank" class="w-10 h-10 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.785 16.241s-.224.015-.339.015c-.66 0-1.22-.061-1.672-.172-.9-.224-1.554-.785-1.554-1.554 0-.615.405-1.003 1.003-1.003.405 0 .75.195.975.405.405.36.81.615 1.554.615 1.003 0 1.554-.615 1.554-1.554 0-1.003-.615-1.554-1.554-1.554-.36 0-.66.09-.9.195l-.195-.405c.36-.195.81-.3 1.35-.3 1.554 0 2.559.975 2.559 2.559 0 1.554-.975 2.559-2.559 2.559zm-1.554-6.015c-1.554 0-2.559.975-2.559 2.559 0 1.554.975 2.559 2.559 2.559.36 0 .66-.09.9-.195l.195.405c-.36.195-.81.3-1.35.3-1.554 0-2.559-.975-2.559-2.559 0-1.003.615-1.554 1.554-1.554.405 0 .75.195.975.405.405.36.81.615 1.554.615 1.003 0 1.554-.615 1.554-1.554 0-1.003-.615-1.554-1.554-1.554-.36 0-.66.09-.9.195l-.195-.405c.36-.195.81-.3 1.35-.3 1.554 0 2.559.975 2.559 2.559 0 1.554-.975 2.559-2.559 2.559z"/>
                                </svg>
                            </a>
                            <a href="https://t.me/share/url?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" class="w-10 h-10 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.223s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Похожие статьи -->
<?php if (!empty($relatedArticles)): ?>
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-gradient text-center"><?php echo $currentLang === 'en' ? 'Related Articles' : 'Похожие статьи'; ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($relatedArticles as $related): ?>
                    <?php 
                    $relatedTitle = getArticleField($related, 'title', $currentLang);
                    $relatedExcerpt = getArticleField($related, 'excerpt', $currentLang);
                    $relatedSlug = getArticleSlug($related, $currentLang);
                    $relatedCategory = $currentLang === 'en' ? ($related['category_en'] ?? $related['category']) : $related['category'];
                    ?>
                    <article class="bg-dark-bg border border-dark-border rounded-xl p-6 hover:border-neon-purple transition-all duration-300">
                        <div class="mb-4">
                            <span class="text-sm text-neon-purple font-semibold"><?php echo htmlspecialchars($relatedCategory); ?></span>
                            <span class="text-gray-500 mx-2">•</span>
                            <span class="text-sm text-gray-500"><?php echo formatDate($related['date'], $currentLang); ?></span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gradient">
                            <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post'); ?>?slug=<?php echo htmlspecialchars($relatedSlug); ?>" class="hover:text-neon-blue transition-colors">
                                <?php echo htmlspecialchars($relatedTitle); ?>
                            </a>
                        </h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            <?php echo htmlspecialchars(mb_substr($relatedExcerpt, 0, 100)) . '...'; ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post'); ?>?slug=<?php echo htmlspecialchars($relatedSlug); ?>" class="text-neon-purple hover:text-neon-blue transition-colors text-sm font-semibold">
                            <?php echo $currentLang === 'en' ? 'Read →' : 'Читать →'; ?>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <?php echo $currentLang === 'en' ? 'Need Help with Your Project?' : 'Нужна помощь с вашим проектом?'; ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo $currentLang === 'en' ? 'Contact us and get a free consultation' : 'Свяжитесь с нами и получите бесплатную консультацию'; ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo $currentLang === 'en' ? 'Get Consultation' : 'Получить консультацию'; ?>
            </a>
        </div>
    </div>
</section>

<style>
/* ============================================
   КРАСИВАЯ ТИПОГРАФИКА ДЛЯ БЛОГА
   ============================================ */

.article-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #E5E7EB;
}

/* Заголовки с градиентами */
.article-content h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid rgba(139, 92, 246, 0.3);
    background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.article-content h2::before {
    content: '';
    position: absolute;
    left: -1.5rem;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 60%;
    background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
    border-radius: 2px;
}

.article-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #D1D5DB;
    position: relative;
    padding-left: 1rem;
}

.article-content h3::before {
    content: '▸';
    position: absolute;
    left: 0;
    color: #8B5CF6;
    font-size: 1.25rem;
}

.article-content h4 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #9CA3AF;
}

/* Параграфы с улучшенной читаемостью */
.article-content p {
    margin-bottom: 1.5rem;
    color: #E5E7EB;
    line-height: 1.8;
    font-size: 1.125rem;
    text-align: justify;
}

.article-content p:first-of-type {
    font-size: 1.25rem;
    color: #D1D5DB;
    font-weight: 500;
    line-height: 1.9;
    margin-bottom: 2rem;
}

/* Списки с красивым оформлением */
.article-content ul,
.article-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
    color: #E5E7EB;
}

.article-content ul {
    list-style: none;
    padding-left: 0;
}

.article-content ul li {
    position: relative;
    padding-left: 2rem;
    margin-bottom: 1rem;
    line-height: 1.8;
    color: #E5E7EB;
}

.article-content ul li::before {
    content: '▹';
    position: absolute;
    left: 0;
    color: #8B5CF6;
    font-size: 1.25rem;
    font-weight: bold;
}

.article-content ol {
    counter-reset: list-counter;
    list-style: none;
    padding-left: 0;
}

.article-content ol li {
    position: relative;
    padding-left: 2.5rem;
    margin-bottom: 1rem;
    line-height: 1.8;
    color: #E5E7EB;
    counter-increment: list-counter;
}

.article-content ol li::before {
    content: counter(list-counter);
    position: absolute;
    left: 0;
    top: 0;
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
    border: 1px solid rgba(139, 92, 246, 0.5);
    border-radius: 0.375rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #8B5CF6;
    font-size: 0.875rem;
}

/* Выделение текста */
.article-content strong {
    color: #FFFFFF;
    font-weight: 700;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
}

.article-content em {
    color: #D1D5DB;
    font-style: italic;
    font-weight: 500;
}

/* Ссылки */
.article-content a {
    color: #8B5CF6;
    text-decoration: underline;
    text-decoration-color: rgba(139, 92, 246, 0.3);
    text-underline-offset: 0.25rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.article-content a:hover {
    color: #06B6D4;
    text-decoration-color: rgba(6, 182, 212, 0.5);
    text-decoration-thickness: 2px;
}

/* Цитаты */
.article-content blockquote {
    margin: 2rem 0;
    padding: 1.5rem 2rem;
    border-left: 4px solid #8B5CF6;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
    border-radius: 0.5rem;
    font-style: italic;
    color: #D1D5DB;
    position: relative;
}

.article-content blockquote::before {
    content: '"';
    position: absolute;
    top: -0.5rem;
    left: 1rem;
    font-size: 4rem;
    color: rgba(139, 92, 246, 0.2);
    font-family: Georgia, serif;
}

.article-content blockquote p {
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

/* Код */
.article-content code {
    background-color: rgba(139, 92, 246, 0.15);
    color: #A78BFA;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.article-content pre {
    background-color: #1a1a24;
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 0.5rem;
    padding: 1.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.article-content pre code {
    background: none;
    border: none;
    padding: 0;
    color: #E5E7EB;
}

/* Горизонтальная линия */
.article-content hr {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, rgba(139, 92, 246, 0.5) 50%, transparent 100%);
    margin: 3rem 0;
}

/* Таблицы */
.article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    background-color: rgba(26, 26, 36, 0.5);
    border-radius: 0.5rem;
    overflow: hidden;
}

.article-content table th {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
    color: #FFFFFF;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid rgba(139, 92, 246, 0.3);
}

.article-content table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(42, 42, 58, 0.5);
    color: #E5E7EB;
}

.article-content table tr:hover {
    background-color: rgba(139, 92, 246, 0.05);
}

/* Изображения */
.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.75rem;
    margin: 2rem 0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(139, 92, 246, 0.2);
}

/* Акценты и выделения */
.article-content mark {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.3) 0%, rgba(6, 182, 212, 0.3) 100%);
    color: #FFFFFF;
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
    font-weight: 500;
}

/* Адаптивность */
@media (max-width: 768px) {
    .article-content {
        font-size: 1rem;
    }
    
    .article-content h2 {
        font-size: 1.75rem;
        padding-left: 1.5rem;
    }
    
    .article-content h2::before {
        left: 0;
        width: 3px;
    }
    
    .article-content h3 {
        font-size: 1.25rem;
    }
    
    .article-content p:first-of-type {
        font-size: 1.125rem;
    }
    
    .article-content ul,
    .article-content ol {
        padding-left: 1.5rem;
    }
    
    .article-content ul li {
        padding-left: 1.5rem;
    }
    
    .article-content ol li {
        padding-left: 2rem;
    }
    
    .article-content blockquote {
        padding: 1rem 1.5rem;
    }
}

/* Декоративные элементы */
.article-content p:first-of-type::first-letter {
    float: left;
    font-size: 4rem;
    line-height: 1;
    font-weight: 700;
    margin: 0.1em 0.1em 0 0;
    background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Улучшение для абзацев с отступами */
.article-content p + p {
    text-indent: 0;
}

/* Красивое оформление для вложенных списков */
.article-content ul ul,
.article-content ol ol,
.article-content ul ol,
.article-content ol ul {
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
    padding-left: 1.5rem;
}

.article-content ul ul li::before {
    content: '▪';
    color: #06B6D4;
}

/* Улучшение для выделения важных моментов */
.article-content p.highlight,
.article-content p[style*="background"],
.article-content p[style*="border"] {
    font-weight: 500;
    padding-left: 1.5rem;
    border-left: 3px solid rgba(139, 92, 246, 0.5);
    background: rgba(139, 92, 246, 0.05);
    padding: 1rem 1rem 1rem 1.5rem;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}

/* Плавное появление элементов (опционально, можно отключить) */
.article-content > * {
    animation: fadeInUp 0.5s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<?php include 'includes/footer.php'; ?>

