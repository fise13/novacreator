<?php
/**
 * Централизованная SEO-конфигурация: title, description, OpenGraph, Twitter и JSON-LD
 */

// Подключаем локализацию если еще не подключена
if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

$host = $_SERVER['HTTP_HOST'] ?? 'novacreator-studio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$siteUrl = $scheme . '://' . $host;
$siteName = t('site.name');
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$currentLang = getCurrentLanguage();

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestUri = strtok($requestUri, '#');
$requestUri = $requestUri ?: '/';
$cleanPath = $requestUri === '/' ? '/' : rtrim($requestUri, '/');

// Формируем канонический URL с учетом языка
$canonicalPath = getCurrentPath();
$canonicalUrl = $siteUrl . getLocalizedUrl($currentLang, $canonicalPath);

$defaultMeta = [
    'title' => t('seo.meta.defaultTitle'),
    'description' => t('seo.meta.defaultDescription'),
    'keywords' => t('seo.meta.defaultKeywords'),
    'og_type' => 'website',
    'breadcrumb' => t('nav.home'),
    'image' => '/assets/img/og-default.webp',
    'robots' => 'index, follow',
];

// Получаем мета-данные из переводов
$pagesMeta = [
    'index' => [
        'title' => t('seo.pages.index.title'),
        'description' => t('seo.pages.index.description'),
        'keywords' => t('seo.pages.index.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.index.breadcrumb'),
        'canonical' => '/',
    ],
    'services' => [
        'title' => t('seo.pages.services.title'),
        'description' => t('seo.pages.services.description'),
        'keywords' => t('seo.pages.services.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.services.breadcrumb'),
        'canonical' => '/services',
    ],
    'seo' => [
        'title' => t('seo.pages.seo.title'),
        'description' => t('seo.pages.seo.description'),
        'keywords' => t('seo.pages.seo.keywords'),
        'og_type' => 'article',
        'breadcrumb' => t('seo.pages.seo.breadcrumb'),
        'canonical' => '/seo',
    ],
    'ads' => [
        'title' => t('seo.pages.ads.title'),
        'description' => t('seo.pages.ads.description'),
        'keywords' => t('seo.pages.ads.keywords'),
        'og_type' => 'article',
        'breadcrumb' => t('seo.pages.ads.breadcrumb'),
        'canonical' => '/ads',
    ],
    'portfolio' => [
        'title' => t('seo.pages.portfolio.title'),
        'description' => t('seo.pages.portfolio.description'),
        'keywords' => t('seo.pages.portfolio.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.portfolio.breadcrumb'),
        'canonical' => '/portfolio',
    ],
    'about' => [
        'title' => t('seo.pages.about.title'),
        'description' => t('seo.pages.about.description'),
        'keywords' => t('seo.pages.about.keywords'),
        'og_type' => 'profile',
        'breadcrumb' => t('seo.pages.about.breadcrumb'),
        'canonical' => '/about',
    ],
    'contact' => [
        'title' => t('seo.pages.contact.title'),
        'description' => t('seo.pages.contact.description'),
        'keywords' => t('seo.pages.contact.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.contact.breadcrumb'),
        'canonical' => '/contact',
    ],
    'vacancies' => [
        'title' => t('seo.pages.vacancies.title'),
        'description' => t('seo.pages.vacancies.description'),
        'keywords' => t('seo.pages.vacancies.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.vacancies.breadcrumb'),
        'canonical' => '/vacancies',
    ],
    'calculator' => [
        'title' => t('seo.pages.calculator.title'),
        'description' => t('seo.pages.calculator.description'),
        'keywords' => t('seo.pages.calculator.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.calculator.breadcrumb'),
        'canonical' => '/calculator',
    ],
    'blog' => [
        'title' => t('seo.pages.blog.title'),
        'description' => t('seo.pages.blog.description'),
        'keywords' => t('seo.pages.blog.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.blog.breadcrumb'),
        'canonical' => '/blog',
    ],
    'faq' => [
        'title' => t('seo.pages.faq.title'),
        'description' => t('seo.pages.faq.description'),
        'keywords' => t('seo.pages.faq.keywords'),
        'og_type' => 'website',
        'breadcrumb' => t('seo.pages.faq.breadcrumb'),
        'canonical' => '/faq',
    ],
];

$meta = array_merge($defaultMeta, $pagesMeta[$currentPage] ?? []);

if (isset($pageMetaTitle)) {
    $meta['title'] = $pageMetaTitle;
}
if (isset($pageMetaDescription)) {
    $meta['description'] = $pageMetaDescription;
}
if (isset($pageMetaKeywords)) {
    $meta['keywords'] = $pageMetaKeywords;
}
if (isset($pageMetaRobots)) {
    $meta['robots'] = $pageMetaRobots;
}
if (isset($pageMetaOgType)) {
    $meta['og_type'] = $pageMetaOgType;
}
$absoluteUrl = static function (?string $path) use ($siteUrl): string {
    if (!$path) {
        return $siteUrl;
    }
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return rtrim($siteUrl, '/') . '/' . ltrim($path, '/');
};

// Формируем канонический URL с учетом языка
if (!empty($pageMetaCanonical)) {
    $canonicalUrl = $absoluteUrl($pageMetaCanonical);
} elseif (!empty($meta['canonical'])) {
    $canonicalUrl = $siteUrl . getLocalizedUrl($currentLang, $meta['canonical']);
} else {
    $canonicalUrl = $siteUrl . getLocalizedUrl($currentLang, getCurrentPath());
}

$metaImage = $absoluteUrl($pageMetaImage ?? $meta['image']);
$imageMime = 'image/webp';
if (stripos($metaImage, '.png') !== false) {
    $imageMime = 'image/png';
} elseif (stripos($metaImage, '.jpg') !== false || stripos($metaImage, '.jpeg') !== false) {
    $imageMime = 'image/jpeg';
}

$breadcrumbs = [
    ['name' => t('seo.pages.index.breadcrumb'), 'url' => $siteUrl . getLocalizedUrl($currentLang, '/')],
];
if ($currentPage !== 'index') {
    $breadcrumbs[] = [
        'name' => $meta['breadcrumb'] ?? $meta['title'],
        'url' => $canonicalUrl,
    ];
}
if (!empty($pageBreadcrumbs) && is_array($pageBreadcrumbs)) {
    $breadcrumbs = array_map(function ($crumb) use ($absoluteUrl) {
        return [
            'name' => $crumb['name'],
            'url' => $absoluteUrl($crumb['url']),
        ];
    }, $pageBreadcrumbs);
}

$breadcrumbsSchema = [
    '@type' => 'BreadcrumbList',
    'itemListElement' => [],
];
foreach ($breadcrumbs as $index => $crumb) {
    $breadcrumbsSchema['itemListElement'][] = [
        '@type' => 'ListItem',
        'position' => $index + 1,
        'name' => $crumb['name'],
        'item' => $crumb['url'],
    ];
}

$organizationSchema = [
    '@type' => 'Organization',
    'name' => $siteName,
    'url' => $siteUrl,
    'logo' => $absoluteUrl('/assets/img/logo.svg'),
    'description' => t('seo.meta.defaultDescription'),
    'foundingDate' => '2024',
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => '+7-706-606-39-21',
        'email' => 'contact@novacreatorstudio.com',
        'contactType' => 'customer service',
        'availableLanguage' => ['ru', 'en'],
        'areaServed' => ['KZ', 'RU'],
    ],
    'sameAs' => [],
    'address' => [
        '@type' => 'PostalAddress',
        'addressCountry' => 'KZ',
        'addressLocality' => 'Almaty',
    ],
    'aggregateRating' => [
        '@type' => 'AggregateRating',
        'ratingValue' => '5.0',
        'reviewCount' => '10',
        'bestRating' => '5',
        'worstRating' => '1',
    ],
    'offers' => [
        '@type' => 'Offer',
        'name' => 'SEO-продвижение сайтов в топ-10',
        'description' => 'Профессиональное SEO-продвижение сайтов в топ-10 поисковых систем Google и Яндекс',
        'category' => 'SEO Services',
        'areaServed' => ['KZ', 'RU'],
    ],
];

// Получаем альтернативные языковые версии для hreflang
// Если заданы кастомные альтернативные языки (например, для статей блога), используем их
if (!empty($pageAlternateLanguages) && is_array($pageAlternateLanguages)) {
    $alternateLanguages = $pageAlternateLanguages;
} else {
    $alternateLanguages = getAlternateLanguages();
}

$websiteSchema = [
    '@type' => 'WebSite',
    'name' => $siteName,
    'url' => $siteUrl,
    'description' => t('seo.meta.defaultDescription'),
    'inLanguage' => ['ru', 'en'],
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => $siteUrl . '/?s={search_term_string}',
        'query-input' => 'required name=search_term_string',
    ],
];

// Добавляем Service schema для лучшего понимания услуг
$serviceSchema = [
    '@type' => 'Service',
    'serviceType' => 'SEO Optimization',
    'provider' => [
        '@type' => 'Organization',
        'name' => $siteName,
    ],
    'areaServed' => [
        '@type' => 'Country',
        'name' => 'Kazakhstan',
    ],
    'description' => 'Профессиональное SEO-продвижение сайтов в топ-10 поисковых систем Google и Яндекс',
    'offers' => [
        '@type' => 'Offer',
        'name' => 'SEO-продвижение в топ-10',
        'description' => 'Комплексное SEO-продвижение сайтов с гарантией попадания в топ-10 по целевым запросам',
    ],
];

$graph = [$organizationSchema, $websiteSchema, $serviceSchema];
if (!empty($breadcrumbsSchema['itemListElement'])) {
    $graph[] = $breadcrumbsSchema;
}
if (!empty($pageStructuredData)) {
    if (isset($pageStructuredData[0])) {
        foreach ($pageStructuredData as $schemaBlock) {
            $graph[] = $schemaBlock;
        }
    } else {
        $graph[] = $pageStructuredData;
    }
}

$structuredData = [
    '@context' => 'https://schema.org',
    '@graph' => $graph,
];
?>

<!-- Основные мета-теги -->
<meta name="description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<?php if (!empty($meta['keywords'])): ?>
<meta name="keywords" content="<?php echo htmlspecialchars($meta['keywords']); ?>">
<?php endif; ?>
<meta name="author" content="<?php echo htmlspecialchars($siteName); ?>">
<meta name="robots" content="<?php echo htmlspecialchars($meta['robots']); ?>">
<meta name="language" content="<?php echo htmlspecialchars($currentLang); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
<?php
// Генерируем hreflang теги для всех языков
foreach ($alternateLanguages as $lang => $url): 
    $hreflang = $lang === 'ru' ? 'ru-RU' : 'en-US';
    $fullUrl = $siteUrl . $url;
?>
<link rel="alternate" hreflang="<?php echo htmlspecialchars($hreflang); ?>" href="<?php echo htmlspecialchars($fullUrl); ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($siteUrl . getLocalizedUrl(DEFAULT_LANGUAGE, getCurrentPath())); ?>">

<!-- Open Graph -->
<meta property="og:type" content="<?php echo htmlspecialchars($meta['og_type']); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta property="og:site_name" content="<?php echo htmlspecialchars($siteName); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($metaImage); ?>">
<meta property="og:image:secure_url" content="<?php echo htmlspecialchars($metaImage); ?>">
<meta property="og:image:type" content="<?php echo $imageMime; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo htmlspecialchars($meta['title'] . ' - ' . $siteName); ?>">
<meta property="og:locale" content="<?php echo $currentLang === 'ru' ? 'ru_RU' : 'en_US'; ?>">
<?php
// Добавляем альтернативные локали для Open Graph
foreach ($alternateLanguages as $lang => $url):
    if ($lang !== $currentLang):
        $ogLocale = $lang === 'ru' ? 'ru_RU' : 'en_US';
        $fullUrl = $siteUrl . $url;
?>
<meta property="og:locale:alternate" content="<?php echo htmlspecialchars($ogLocale); ?>">
<?php
    endif;
endforeach;
?>

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta name="twitter:site" content="@NovaCreatorStudio">
<meta name="twitter:creator" content="@NovaCreatorStudio">
<meta name="twitter:image" content="<?php echo htmlspecialchars($metaImage); ?>">
<meta name="twitter:image:alt" content="<?php echo htmlspecialchars($meta['title'] . ' - ' . $siteName); ?>">

<!-- Дополнительные мета-теги для социальных сетей -->
<meta property="article:author" content="<?php echo htmlspecialchars($siteName); ?>">
<meta property="article:publisher" content="<?php echo htmlspecialchars($siteUrl); ?>">
<?php if (isset($articleDate)): ?>
<meta property="article:published_time" content="<?php echo date('c', strtotime($articleDate)); ?>">
<meta property="article:modified_time" content="<?php echo date('c', strtotime($articleDate)); ?>">
<?php endif; ?>
<?php if (isset($articleCategory)): ?>
<meta property="article:section" content="<?php echo htmlspecialchars($articleCategory); ?>">
<?php endif; ?>
<?php if (isset($articleTags) && is_array($articleTags)): ?>
<?php foreach ($articleTags as $tag): ?>
<meta property="article:tag" content="<?php echo htmlspecialchars($tag); ?>">
<?php endforeach; ?>
<?php endif; ?>

<!-- Дополнительные мета-теги для улучшения SEO -->
<meta name="geo.region" content="KZ">
<meta name="geo.placename" content="Almaty">
<meta name="geo.position" content="43.238949;76.889709">
<meta name="ICBM" content="43.238949, 76.889709">
<meta name="rating" content="general">
<meta name="distribution" content="global">
<meta name="revisit-after" content="7 days">
<meta name="coverage" content="worldwide">
<meta name="target" content="all">
<meta name="audience" content="all">

<!-- JSON-LD -->
<script type="application/ld+json">
<?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

