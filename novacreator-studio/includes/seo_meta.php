<?php
/**
 * Централизованная SEO-конфигурация: title, description, OpenGraph, Twitter и JSON-LD
 */

$host = $_SERVER['HTTP_HOST'] ?? 'novacreator-studio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$siteUrl = $scheme . '://' . $host;
$siteName = 'NovaCreator Studio';
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestUri = strtok($requestUri, '#');
$requestUri = $requestUri ?: '/';
$cleanPath = $requestUri === '/' ? '/' : rtrim($requestUri, '/');
$canonicalUrl = $siteUrl . ($cleanPath === '/' ? '/' : $cleanPath);

$defaultMeta = [
    'title' => 'NovaCreator Studio — Digital агентство',
    'description' => 'Digital агентство полного цикла: SEO, разработка сайтов, Google Ads и маркетинг для роста бизнеса в Казахстане и по всему миру.',
    'keywords' => 'digital агентство, seo, разработка сайтов, маркетинг',
    'og_type' => 'website',
    'breadcrumb' => 'Страница',
    'image' => '/assets/img/og-default.webp',
    'robots' => 'index, follow',
];

$pagesMeta = [
    'index' => [
        'title' => 'NovaCreator Studio — Digital агентство | SEO, разработка, маркетинг',
        'description' => 'SEO-продвижение, создание сайтов, Google Ads и аналитика с пожизненной гарантией качества. Работаем онлайн и фокусируемся на измеримом росте бизнеса.',
        'keywords' => 'digital агентство, seo услуги, маркетинг, создание сайтов',
        'og_type' => 'website',
        'breadcrumb' => 'Главная',
        'canonical' => '/',
    ],
    'services' => [
        'title' => 'Услуги digital-агентства: SEO, сайты, реклама — NovaCreator Studio',
        'description' => 'Комплексные услуги: технический SEO, разработка сайтов, Google Ads, маркетинговая стратегия и аналитика. Один подрядчик — все digital-задачи.',
        'keywords' => 'seo услуги, разработка сайтов, маркетинговое агентство',
        'og_type' => 'website',
        'breadcrumb' => 'Услуги',
        'canonical' => '/services',
    ],
    'seo' => [
        'title' => 'SEO-оптимизация и продвижение сайтов под ключ — NovaCreator Studio',
        'description' => 'Технический аудит, семантика, контент и ссылочное продвижение. Повышаем органический трафик и конверсии в Google и Яндекс.',
        'keywords' => 'seo оптимизация, продвижение сайтов, технический seo',
        'og_type' => 'article',
        'breadcrumb' => 'SEO-услуги',
        'canonical' => '/seo',
    ],
    'ads' => [
        'title' => 'Google Ads и контекстная реклама с оптимизацией ROI — NovaCreator Studio',
        'description' => 'Запускаем кампании Google Ads, отслеживаем конверсии и снижаем стоимость заявки за счёт аналитики и тестов.',
        'keywords' => 'google ads, контекстная реклама, ppc',
        'og_type' => 'article',
        'breadcrumb' => 'Google Ads',
        'canonical' => '/ads',
    ],
    'portfolio' => [
        'title' => 'Портфолио проектов NovaCreator Studio — реальные кейсы роста',
        'description' => 'Показываем, как увеличивали трафик, конверсии и продажи для клиентов из разных ниш. Честные цифры и подход.',
        'keywords' => 'портфолио digital агентства, кейсы seo',
        'og_type' => 'website',
        'breadcrumb' => 'Портфолио',
        'canonical' => '/portfolio',
    ],
    'about' => [
        'title' => 'О команде NovaCreator Studio — эксперты SEO и разработки',
        'description' => 'Маленькая команда senior-специалистов с 10+ годами опыта. Работаем прозрачно, подключаемся в проекты быстро.',
        'keywords' => 'о компании, команда digital агентства',
        'og_type' => 'profile',
        'breadcrumb' => 'О нас',
        'canonical' => '/about',
    ],
    'contact' => [
        'title' => 'Контакты NovaCreator Studio — получить консультацию',
        'description' => 'Пишите в Telegram или на email, звоните по номеру +7 706 606 39 21. Ответим в день обращения и обсудим задачи.',
        'keywords' => 'контакты seo агентства, связаться с digital студией',
        'og_type' => 'website',
        'breadcrumb' => 'Контакты',
        'canonical' => '/contact',
    ],
    'vacancies' => [
        'title' => 'Вакансии NovaCreator Studio — удалённая работа в digital',
        'description' => 'Ищем SEO-специалистов, разработчиков и PPC-менеджеров на удалённую работу. Гибкий график и проекты с реальными KPI.',
        'keywords' => 'вакансии digital агентства, работа seo',
        'og_type' => 'website',
        'breadcrumb' => 'Вакансии',
        'canonical' => '/vacancies',
    ],
    'calculator' => [
        'title' => 'Калькулятор стоимости digital-услуг — NovaCreator Studio',
        'description' => 'Онлайн-калькулятор для оценки стоимости SEO, разработки сайта и рекламных кампаний. Получите расчёт за пару минут.',
        'keywords' => 'калькулятор seo, цена разработки сайта',
        'og_type' => 'website',
        'breadcrumb' => 'Калькулятор',
        'canonical' => '/calculator',
    ],
    'blog' => [
        'title' => 'Блог NovaCreator Studio: SEO, реклама и аналитика',
        'description' => 'Пишем про SEO, маркетинг и продуктовую аналитику. Кейсы, чек-листы и инструкции для бизнеса.',
        'keywords' => 'блог seo, статьи про digital маркетинг',
        'og_type' => 'website',
        'breadcrumb' => 'Блог',
        'canonical' => '/blog',
    ],
    'faq' => [
        'title' => 'Часто задаваемые вопросы | FAQ - NovaCreator Studio',
        'description' => 'Ответы на популярные вопросы о SEO, разработке сайтов, Google Ads и маркетинге. Узнайте больше о наших услугах и процессе работы.',
        'keywords' => 'FAQ, часто задаваемые вопросы, вопросы и ответы, помощь, поддержка',
        'og_type' => 'website',
        'breadcrumb' => 'FAQ',
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

$canonicalUrl = !empty($pageMetaCanonical) ? $absoluteUrl($pageMetaCanonical) : $canonicalUrl;
if (empty($pageMetaCanonical) && !empty($meta['canonical'])) {
    $canonicalUrl = $absoluteUrl($meta['canonical']);
}

$metaImage = $absoluteUrl($pageMetaImage ?? $meta['image']);
$imageMime = 'image/webp';
if (stripos($metaImage, '.png') !== false) {
    $imageMime = 'image/png';
} elseif (stripos($metaImage, '.jpg') !== false || stripos($metaImage, '.jpeg') !== false) {
    $imageMime = 'image/jpeg';
}

$breadcrumbs = [
    ['name' => 'Главная', 'url' => $siteUrl . '/'],
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
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => '+7-706-606-39-21',
        'email' => 'contact@novacreatorstudio.com',
        'contactType' => 'customer service',
        'availableLanguage' => ['ru', 'en'],
    ],
    'sameAs' => [
        'https://t.me/novacreator_studio',
    ],
    'address' => [
        '@type' => 'PostalAddress',
        'addressCountry' => 'KZ',
    ],
];

$websiteSchema = [
    '@type' => 'WebSite',
    'name' => $siteName,
    'url' => $siteUrl,
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => $siteUrl . '/?s={search_term_string}',
        'query-input' => 'required name=search_term_string',
    ],
];

$graph = [$organizationSchema, $websiteSchema];
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
<meta name="language" content="ru">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
<link rel="alternate" hreflang="ru-RU" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

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
<meta property="og:image:alt" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta property="og:locale" content="ru_RU">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta name="twitter:site" content="@NovaCreatorStudio">
<meta name="twitter:creator" content="@NovaCreatorStudio">
<meta name="twitter:image" content="<?php echo htmlspecialchars($metaImage); ?>">
<meta name="twitter:image:alt" content="<?php echo htmlspecialchars($meta['title']); ?>">

<!-- JSON-LD -->
<script type="application/ld+json">
<?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

