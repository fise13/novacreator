<?php
if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

$siteUrl = 'https://novacreatorstudio.com';
$siteName = t('site.name');
$currentLang = getCurrentLanguage();
$currentPath = getCurrentPath();

$defaultMeta = [
    'title' => t('seo.meta.defaultTitle'),
    'description' => t('seo.meta.defaultDescription'),
    'keywords' => t('seo.meta.defaultKeywords'),
    'og_type' => 'website',
    'robots' => 'index, follow',
    'image' => '/assets/img/og-default.webp',
];

$pagesMeta = [
    'index' => ['canonical' => '/'],
    'services' => ['canonical' => '/services'],
    'seo' => ['canonical' => '/seo'],
    'ads' => ['canonical' => '/ads'],
    'about' => ['canonical' => '/about'],
    'contact' => ['canonical' => '/contact'],
    'vacancies' => ['canonical' => '/vacancies'],
    'calculator' => ['canonical' => '/calculator'],
    'blog' => ['canonical' => '/blog'],
    'faq' => ['canonical' => '/faq'],
    'landing-page-development' => ['canonical' => '/landing-page-development', 'og_type' => 'service'],
    'ecommerce-development' => ['canonical' => '/ecommerce-development', 'og_type' => 'service'],
    'corporate-website-development' => ['canonical' => '/corporate-website-development', 'og_type' => 'service'],
];

$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php', '.php');
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

$canonicalPath = $meta['canonical'] ?? $currentPath;
$canonicalUrl = isset($pageMetaCanonical)
    ? $siteUrl . (strpos($pageMetaCanonical, '/') === 0 ? $pageMetaCanonical : '/' . $pageMetaCanonical)
    : $siteUrl . getLocalizedUrl($currentLang, $canonicalPath);

$metaImage = $siteUrl . ($meta['image'][0] === '/' ? $meta['image'] : '/' . $meta['image']);
$altRu = $siteUrl . getLocalizedUrl('ru', $currentPath);
$altEn = $siteUrl . getLocalizedUrl('en', $currentPath);

$structuredData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => $siteUrl . '#organization',
            'name' => $siteName,
            'url' => $siteUrl,
            'logo' => $siteUrl . '/assets/img/logo.svg',
            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'telephone' => '+7-706-606-39-21',
                'email' => 'contact@novacreatorstudio.com',
                'contactType' => 'customer support',
                'availableLanguage' => ['ru', 'en'],
            ]],
        ],
        [
            '@type' => 'WebSite',
            '@id' => $siteUrl . '#website',
            'url' => $siteUrl,
            'name' => $siteName,
            'inLanguage' => ['ru', 'en'],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $canonicalUrl . '#webpage',
            'url' => $canonicalUrl,
            'name' => $meta['title'],
            'description' => $meta['description'],
            'inLanguage' => $currentLang === 'ru' ? 'ru-RU' : 'en-US',
        ],
    ],
];
?>
<meta name="description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<?php if (!empty($meta['keywords'])): ?>
<meta name="keywords" content="<?php echo htmlspecialchars($meta['keywords']); ?>">
<?php endif; ?>
<meta name="robots" content="<?php echo htmlspecialchars($meta['robots']); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

<link rel="alternate" hreflang="ru-RU" href="<?php echo htmlspecialchars($altRu); ?>">
<link rel="alternate" hreflang="en-US" href="<?php echo htmlspecialchars($altEn); ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($altEn); ?>">

<meta property="og:type" content="<?php echo htmlspecialchars($meta['og_type']); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta property="og:site_name" content="<?php echo htmlspecialchars($siteName); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($metaImage); ?>">
<meta property="og:locale" content="<?php echo $currentLang === 'ru' ? 'ru_RU' : 'en_US'; ?>">
<meta property="og:locale:alternate" content="<?php echo $currentLang === 'ru' ? 'en_US' : 'ru_RU'; ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta name="twitter:image" content="<?php echo htmlspecialchars($metaImage); ?>">

<meta name="yandex-verification" content="edd889cc7878b9f3">

<script type="application/ld+json">
<?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>
