<?php
/**
 * Централизованная SEO-конфигурация: title, description, OpenGraph, Twitter и JSON-LD
 */

// Подключаем локализацию если еще не подключена
if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

$host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
// Убираем www из хоста для единообразия (www будет редиректить на non-www через .htaccess)
$host = preg_replace('/^www\./i', '', $host);
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
// Всегда используем HTTPS (HTTP будет редиректить на HTTPS через .htaccess)
$scheme = 'https';
$siteUrl = $scheme . '://' . $host;
$siteName = t('site.name');
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$currentLang = getCurrentLanguage();

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestUri = strtok($requestUri, '#');
$requestUri = $requestUri ?: '/';
$cleanPath = $requestUri === '/' ? '/' : rtrim($requestUri, '/');

// Проверяем, есть ли параметры запроса, которые делают страницу уникальной (например, вакансии)
$queryString = $_SERVER['QUERY_STRING'] ?? '';
$hasIndexableParams = false;
if (!empty($queryString)) {
    parse_str($queryString, $params);
    // Если есть параметр type=vacancy, это уникальная страница вакансии, которая должна индексироваться
    if (isset($params['type']) && $params['type'] === 'vacancy' && !empty($params['vacancy'])) {
        $hasIndexableParams = true;
    }
}

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
    'landing-page-development' => [
        'title' => 'Разработка лендингов — создание продающих лендинг-страниц под ключ | NovaCreator Studio',
        'description' => 'Разработка лендингов под ключ. Создаем продающие одностраничные сайты с высокой конверсией. Быстрая загрузка, SEO-оптимизация, адаптивный дизайн. Ориентир по цене от 150 000 тенге. Сроки 10-14 дней.',
        'keywords' => 'разработка лендингов, создание лендинга, лендинг под ключ, одностраничный сайт, лендинг пейдж, разработка лендинга цена, создание лендинга алматы',
        'og_type' => 'service',
        'breadcrumb' => 'Разработка лендингов',
        'canonical' => '/landing-page-development',
    ],
    'ecommerce-development' => [
        'title' => 'Разработка интернет-магазинов — создание онлайн магазинов под ключ | NovaCreator Studio',
        'description' => 'Разработка интернет-магазинов под ключ. Создаем онлайн магазины с корзиной, оплатой, управлением товарами. Адаптивный дизайн, быстрая загрузка, SEO-оптимизация. Ориентир по цене от 500 000 тенге. Сроки 6-12 недель.',
        'keywords' => 'разработка интернет магазина, создание интернет магазина, интернет магазин под ключ, онлайн магазин, разработка интернет магазина цена, создание интернет магазина алматы',
        'og_type' => 'service',
        'breadcrumb' => 'Разработка интернет-магазинов',
        'canonical' => '/ecommerce-development',
    ],
    'corporate-website-development' => [
        'title' => 'Разработка корпоративных сайтов — создание сайтов для бизнеса под ключ | NovaCreator Studio',
        'description' => 'Разработка корпоративных сайтов под ключ. Создаем современные многостраничные сайты для бизнеса с разделами услуг, портфолио, блога. Адаптивный дизайн, быстрая загрузка, SEO-оптимизация. Ориентир по цене от 300 000 тенге. Сроки 7-8 недель.',
        'keywords' => 'разработка корпоративных сайтов, создание корпоративного сайта, сайт для компании, корпоративный сайт под ключ, разработка сайта компании, создание корпоративного сайта алматы',
        'og_type' => 'service',
        'breadcrumb' => 'Разработка корпоративных сайтов',
        'canonical' => '/corporate-website-development',
    ],
    'coffee-shop-landing' => [
        'title' => 'Лендинг для кофейни: от Instagram к онлайн-заказам | Кейс | NovaCreator Studio',
        'description' => 'Кейс: как мы построили лендинг для локальной кофейни, который увеличил онлайн-заказы на 340% и попал в топ-3 Google Maps. Проблема, решение, результаты с метриками.',
        'keywords' => 'кейс лендинга кофейни, сайт для кофейни, локальное SEO кейс, landing page для локального бизнеса, кейс увеличения заказов',
        'og_type' => 'article',
        'breadcrumb' => 'Кейс: Лендинг для кофейни',
        'canonical' => '/portfolio/case/coffee-shop-landing',
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
} elseif ($hasIndexableParams) {
    // Для страниц с индексируемыми параметрами (например, вакансии) явно устанавливаем index, follow
    $meta['robots'] = 'index, follow';
}
if (isset($pageMetaOgType)) {
    $meta['og_type'] = $pageMetaOgType;
}
$absoluteUrl = static function (?string $path) use ($siteUrl): string {
    if (!$path) {
        return $siteUrl;
    }
    if (preg_match('#^https?://#i', $path)) {
        // Если передан полный URL, нормализуем его (убираем www, используем HTTPS)
        $parsed = parse_url($path);
        $normalizedHost = preg_replace('/^www\./i', '', $parsed['host'] ?? '');
        $normalizedScheme = 'https';
        $normalizedPath = $parsed['path'] ?? '/';
        $normalizedQuery = !empty($parsed['query']) ? '?' . $parsed['query'] : '';
        return $normalizedScheme . '://' . $normalizedHost . $normalizedPath . $normalizedQuery;
    }
    return rtrim($siteUrl, '/') . '/' . ltrim($path, '/');
};

// Формируем канонический URL с учетом языка
if (!empty($pageMetaCanonical)) {
    $canonicalUrl = $absoluteUrl($pageMetaCanonical);
} elseif ($hasIndexableParams) {
    // Для страниц с индексируемыми параметрами canonical должен указывать на саму страницу с параметрами
    $currentPath = getCurrentPath();
    $canonicalUrl = $siteUrl . getLocalizedUrl($currentLang, $currentPath);
    // Добавляем параметры запроса к canonical URL
    if (!empty($queryString)) {
        $canonicalUrl .= '?' . $queryString;
    }
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
    '@id' => $siteUrl . '#organization',
    'name' => $siteName,
    'url' => $siteUrl,
    'logo' => [
        '@type' => 'ImageObject',
        'url' => $absoluteUrl('/assets/img/logo.svg'),
        'width' => 512,
        'height' => 512,
    ],
    'image' => $absoluteUrl('/assets/img/og-default.webp'),
    'description' => t('seo.meta.defaultDescription'),
    'foundingDate' => '2024',
    'contactPoint' => [
        [
            '@type' => 'ContactPoint',
            'telephone' => '+7-706-606-39-21',
            'email' => 'contact@novacreatorstudio.com',
            'contactType' => 'customer service',
            'availableLanguage' => ['ru', 'en', 'zh', 'ja', 'ko', 'de', 'fr', 'es', 'it', 'pt', 'ar', 'hi'],
            'areaServed' => 'Worldwide',
            // Альтернативный формат для лучшей совместимости
            '@id' => $siteUrl . '#customer-service',
        ],
        [
            '@type' => 'ContactPoint',
            'telephone' => '+7-706-606-39-21',
            'email' => 'contact@novacreatorstudio.com',
            'contactType' => 'technical support',
            'availableLanguage' => ['ru', 'en'],
            'areaServed' => 'Worldwide',
        ],
    ],
    'sameAs' => [
        // Добавьте ссылки на ваши социальные сети
    ],
    'address' => [
        '@type' => 'PostalAddress',
        'addressCountry' => 'KZ',
        'addressLocality' => 'Almaty',
        'addressRegion' => 'Almaty',
    ],
    'aggregateRating' => [
        '@type' => 'AggregateRating',
        'ratingValue' => 5.0,
        'reviewCount' => 25,
        'bestRating' => 5,
        'worstRating' => 1,
    ],
    'offers' => [
        [
            '@type' => 'Offer',
            'name' => $currentLang === 'ru' ? 'SEO-продвижение сайтов в топ-10' : 'SEO website promotion to top-10',
            'description' => $currentLang === 'ru' 
                ? 'Профессиональное SEO-продвижение сайтов в топ-10 поисковых систем Google и Яндекс' 
                : 'Professional SEO website promotion to top-10 in Google and Yandex search engines',
            'category' => 'SEO Services',
            'areaServed' => 'Worldwide',
            'availability' => 'https://schema.org/InStock',
            'eligibleRegion' => [
                '@type' => 'GeoCircle',
                'geoMidpoint' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => '43.238949',
                    'longitude' => '76.889709',
                ],
            ],
        ],
    ],
    'knowsAbout' => [
        'SEO Optimization',
        'Website Development',
        'Digital Marketing',
        'Google Ads',
        'Search Engine Optimization',
        'Web Design',
    ],
];

// Получаем альтернативные языковые версии для hreflang
// Если заданы кастомные альтернативные языки (например, для статей блога), используем их
if (!empty($pageAlternateLanguages) && is_array($pageAlternateLanguages)) {
    $alternateLanguages = $pageAlternateLanguages;
} else {
    $alternateLanguages = getAlternateLanguages();
}

// Добавляем глобальные альтернативные языки для лучшей индексации по всему миру
// Основные языки мира (даже если переводов нет, Google понимает намерение)
$globalAlternateLanguages = [
    'x-default' => getLocalizedUrl(DEFAULT_LANGUAGE, getCurrentPath()),
    // Основные региональные варианты
    'en' => getLocalizedUrl('en', getCurrentPath()),
    'ru' => getLocalizedUrl('ru', getCurrentPath()),
    // Дополнительные языки для глобального охвата
    'zh-CN' => getLocalizedUrl('en', getCurrentPath()), // Китай - используем английский
    'zh-TW' => getLocalizedUrl('en', getCurrentPath()),
    'ja' => getLocalizedUrl('en', getCurrentPath()), // Япония
    'ko' => getLocalizedUrl('en', getCurrentPath()), // Корея
    'de' => getLocalizedUrl('en', getCurrentPath()), // Германия
    'fr' => getLocalizedUrl('en', getCurrentPath()), // Франция
    'es' => getLocalizedUrl('en', getCurrentPath()), // Испания
    'it' => getLocalizedUrl('en', getCurrentPath()), // Италия
    'pt' => getLocalizedUrl('en', getCurrentPath()), // Португалия
    'pt-BR' => getLocalizedUrl('en', getCurrentPath()), // Бразилия
    'ar' => getLocalizedUrl('en', getCurrentPath()), // Арабский
    'hi' => getLocalizedUrl('en', getCurrentPath()), // Хинди
    'nl' => getLocalizedUrl('en', getCurrentPath()), // Нидерланды
    'pl' => getLocalizedUrl('en', getCurrentPath()), // Польша
    'tr' => getLocalizedUrl('en', getCurrentPath()), // Турция
];

$websiteSchema = [
    '@type' => 'WebSite',
    '@id' => $siteUrl . '#website',
    'name' => $siteName,
    'url' => $siteUrl,
    'description' => t('seo.meta.defaultDescription'),
    'inLanguage' => ['ru', 'en', 'zh', 'ja', 'ko', 'de', 'fr', 'es', 'it', 'pt', 'ar', 'hi'],
    'audience' => [
        '@type' => 'Audience',
        'audienceType' => 'Global',
        'geographicArea' => [
            '@type' => 'Place',
            'name' => 'Worldwide',
        ],
    ],
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => [
            '@type' => 'EntryPoint',
            'urlTemplate' => $siteUrl . '/?s={search_term_string}',
        ],
        'query-input' => 'required name=search_term_string',
    ],
    'about' => [
        '@type' => 'Thing',
        'name' => 'Global SEO Services',
        'description' => 'Professional SEO optimization and website promotion services worldwide',
    ],
];

// Добавляем SiteNavigationElement для быстрых ссылок (оптимизация для Яндекс)
$navigationSchema = [
    '@type' => 'SiteNavigationElement',
    'name' => $currentLang === 'ru' ? 'Основная навигация' : 'Main Navigation',
    'url' => $siteUrl,
    'hasPart' => [
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Услуги' : 'Services',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/services')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'SEO' : 'SEO',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/seo')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Google Ads' : 'Google Ads',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/ads')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Портфолио' : 'Portfolio',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/portfolio')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'О нас' : 'About',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/about')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Блог' : 'Blog',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/blog')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Контакты' : 'Contact',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/contact')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'FAQ' : 'FAQ',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/faq')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Вакансии' : 'Vacancies',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/vacancies')
        ],
        [
            '@type' => 'SiteNavigationElement',
            'name' => $currentLang === 'ru' ? 'Калькулятор' : 'Calculator',
            'url' => $siteUrl . getLocalizedUrl($currentLang, '/calculator')
        ]
    ]
];

// Добавляем Service schema для лучшего понимания услуг
$graph = [$organizationSchema, $websiteSchema, $navigationSchema];

// Service Schema для главной и SEO страниц с расширенной информацией
if ($currentPage === 'index' || $currentPage === 'seo') {
    $serviceSchema = [
        '@type' => 'Service',
        '@id' => $siteUrl . '#seo-service',
        'serviceType' => 'SEO Optimization',
        'name' => $currentLang === 'ru' ? 'SEO оптимизация купить | Заказать SEO продвижение' : 'Buy SEO Optimization | Order SEO Promotion',
        'provider' => [
            '@type' => 'Organization',
            '@id' => $siteUrl . '#organization',
            'name' => $siteName,
        ],
        'areaServed' => [
            ['@type' => 'Country', 'name' => 'Worldwide'],
            // Основные рынки
            ['@type' => 'Country', 'name' => 'Kazakhstan'],
            ['@type' => 'Country', 'name' => 'Russia'],
            ['@type' => 'Country', 'name' => 'United States'],
            ['@type' => 'Country', 'name' => 'United Kingdom'],
            ['@type' => 'Country', 'name' => 'Canada'],
            ['@type' => 'Country', 'name' => 'Australia'],
            ['@type' => 'Country', 'name' => 'Germany'],
            ['@type' => 'Country', 'name' => 'France'],
            ['@type' => 'Country', 'name' => 'Spain'],
            ['@type' => 'Country', 'name' => 'Italy'],
            ['@type' => 'Country', 'name' => 'Netherlands'],
            ['@type' => 'Country', 'name' => 'Sweden'],
            ['@type' => 'Country', 'name' => 'Norway'],
            ['@type' => 'Country', 'name' => 'Denmark'],
            ['@type' => 'Country', 'name' => 'Finland'],
            ['@type' => 'Country', 'name' => 'Poland'],
            ['@type' => 'Country', 'name' => 'Ukraine'],
            ['@type' => 'Country', 'name' => 'Belarus'],
            ['@type' => 'Country', 'name' => 'Uzbekistan'],
            ['@type' => 'Country', 'name' => 'Kyrgyzstan'],
            ['@type' => 'Country', 'name' => 'Turkey'],
            ['@type' => 'Country', 'name' => 'China'],
            ['@type' => 'Country', 'name' => 'Japan'],
            ['@type' => 'Country', 'name' => 'South Korea'],
            ['@type' => 'Country', 'name' => 'India'],
            ['@type' => 'Country', 'name' => 'Singapore'],
            ['@type' => 'Country', 'name' => 'United Arab Emirates'],
            ['@type' => 'Country', 'name' => 'Saudi Arabia'],
            ['@type' => 'Country', 'name' => 'Brazil'],
            ['@type' => 'Country', 'name' => 'Mexico'],
            ['@type' => 'Country', 'name' => 'Argentina'],
        ],
        'description' => $currentLang === 'ru' 
            ? 'Купить SEO оптимизацию сайта по выгодной цене. Профессиональное SEO-продвижение сайтов в топ-10 Google и Яндекс. Заказать SEO оптимизацию можно онлайн. Комплексная оптимизация, технический аудит и постоянный мониторинг результатов.' 
            : 'Buy professional SEO optimization for your website at competitive prices. Professional SEO website promotion to top-10 in Google and Yandex search engines. Order SEO optimization online. Comprehensive optimization, technical audit and continuous results monitoring.',
        'offers' => [
            [
                '@type' => 'Offer',
                'name' => $currentLang === 'ru' ? 'SEO оптимизация купить - Базовый пакет' : 'Buy SEO Optimization - Basic Package',
                'description' => $currentLang === 'ru' 
                    ? 'Купить SEO оптимизацию: технический аудит, оптимизация контента, работа с мета-тегами, внутренняя перелинковка' 
                    : 'Buy SEO optimization: technical audit, content optimization, meta tags work, internal linking',
                'category' => 'SEO Services',
                'availability' => 'https://schema.org/InStock',
                'priceSpecification' => [
                    '@type' => 'PriceSpecification',
                    'priceCurrency' => 'KZT',
                    'valueAddedTaxIncluded' => true,
                ],
            ],
            [
                '@type' => 'Offer',
                'name' => $currentLang === 'ru' ? 'SEO оптимизация купить - Расширенный пакет' : 'Buy SEO Optimization - Extended Package',
                'description' => $currentLang === 'ru' 
                    ? 'Заказать SEO оптимизацию: комплексное SEO-продвижение сайтов с гарантией попадания в топ-10 по целевым запросам' 
                    : 'Order SEO optimization: comprehensive SEO website promotion with guarantee of top-10 ranking for target keywords',
                'category' => 'SEO Services',
                'availability' => 'https://schema.org/InStock',
                'priceSpecification' => [
                    '@type' => 'PriceSpecification',
                    'priceCurrency' => 'KZT',
                    'valueAddedTaxIncluded' => true,
                ],
            ],
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => 5.0,
            'reviewCount' => 18,
            'bestRating' => 5,
            'worstRating' => 1,
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => $currentLang === 'ru' ? 'SEO Услуги' : 'SEO Services',
            'itemListElement' => [
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $currentLang === 'ru' ? 'Технический SEO' : 'Technical SEO',
                    ],
                ],
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $currentLang === 'ru' ? 'Контент-оптимизация' : 'Content Optimization',
                    ],
                ],
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $currentLang === 'ru' ? 'Построение ссылочной массы' : 'Link Building',
                    ],
                ],
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $currentLang === 'ru' ? 'Локальное SEO' : 'Local SEO',
                    ],
                ],
            ],
        ],
    ];
    $graph[] = $serviceSchema;
}

// Review Schema для увеличения доверия
$reviewSchema = [
    '@type' => 'Review',
    'author' => [
        '@type' => 'Organization',
        'name' => $siteName,
    ],
    'reviewRating' => [
        '@type' => 'Rating',
        'ratingValue' => 5,
        'bestRating' => 5,
        'worstRating' => 1,
    ],
    'reviewBody' => $currentLang === 'ru' 
        ? 'Профессиональное SEO-агентство с опытом более 10 лет. Выводим сайты в топ-10 поисковых систем Google и Яндекс. Работаем с клиентами по всему Казахстану: Алматы, Астана, Шымкент и другие города.'
        : 'Professional SEO agency with over 10 years of experience. We rank websites in top-10 of Google and Yandex search engines. We work with clients throughout Kazakhstan: Almaty, Astana, Shymkent and other cities.',
    'itemReviewed' => [
        '@type' => 'Service',
        '@id' => $siteUrl . '#seo-service',
        'name' => $currentLang === 'ru' ? 'SEO-оптимизация' : 'SEO Optimization',
        'description' => $currentLang === 'ru' 
            ? 'Профессиональная SEO-оптимизация и продвижение сайтов в поисковых системах Google и Яндекс'
            : 'Professional SEO optimization and website promotion in Google and Yandex search engines',
        'provider' => [
            '@type' => 'Organization',
            '@id' => $siteUrl . '#organization',
            'name' => $siteName,
        ],
    ],
];
$graph[] = $reviewSchema;

// FAQ Schema для страниц FAQ и SEO (улучшение для Google Featured Snippets)
if ($currentPage === 'faq' || $currentPage === 'seo') {
    $faqSchema = [
        '@type' => 'FAQPage',
        'mainEntity' => [],
    ];
    
    // Загружаем вопросы из языковых файлов
    if ($currentPage === 'faq') {
        // FAQ страница - собираем все вопросы
        $faqSections = ['seo', 'development', 'general'];
        foreach ($faqSections as $section) {
            for ($i = 1; $i <= 3; $i++) {
                $questionKey = "pages.faq.sections.{$section}.q{$i}.question";
                $answerKey = "pages.faq.sections.{$section}.q{$i}.answer";
                
                $question = t($questionKey);
                $answer = t($answerKey);
                
                if ($question !== $questionKey && $answer !== $answerKey) {
                    $faqSchema['mainEntity'][] = [
                        '@type' => 'Question',
                        'name' => $question,
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $answer,
                        ],
                    ];
                }
            }
        }
    } else if ($currentPage === 'seo') {
        // SEO страница - только SEO вопросы
        for ($i = 1; $i <= 5; $i++) {
            $questionKey = "pages.seo.faq.q{$i}.question";
            $answerKey = "pages.seo.faq.q{$i}.answer";
            
            $question = t($questionKey);
            $answer = t($answerKey);
            
            if ($question !== $questionKey && $answer !== $answerKey) {
                $faqSchema['mainEntity'][] = [
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $answer,
                    ],
                ];
            }
        }
    }
    
    if (!empty($faqSchema['mainEntity'])) {
        $graph[] = $faqSchema;
    }
}

// HowTo Schema для страницы SEO (если это страница SEO)
if ($currentPage === 'seo') {
    $howToSchema = [
        '@type' => 'HowTo',
        'name' => $currentLang === 'ru' ? 'Как вывести сайт в топ-10 Google и Яндекс' : 'How to rank website in top-10 Google and Yandex',
        'description' => $currentLang === 'ru' 
            ? 'Пошаговая инструкция по SEO-продвижению сайта в топ-10 поисковых систем' 
            : 'Step-by-step guide to SEO website promotion to top-10 search engines',
        'step' => [
            [
                '@type' => 'HowToStep',
                'position' => 1,
                'name' => $currentLang === 'ru' ? 'Технический аудит сайта' : 'Technical website audit',
                'text' => $currentLang === 'ru' 
                    ? 'Проведение комплексного технического аудита сайта: проверка скорости загрузки, корректности работы всех страниц, наличия ошибок' 
                    : 'Conducting comprehensive technical website audit: checking loading speed, page functionality, errors',
            ],
            [
                '@type' => 'HowToStep',
                'position' => 2,
                'name' => $currentLang === 'ru' ? 'Анализ конкурентов и семантики' : 'Competitor and keyword analysis',
                'text' => $currentLang === 'ru' 
                    ? 'Изучение конкурентов в поисковой выдаче, подбор релевантных ключевых слов и формирование семантического ядра' 
                    : 'Studying competitors in search results, selecting relevant keywords and forming keyword core',
            ],
            [
                '@type' => 'HowToStep',
                'position' => 3,
                'name' => $currentLang === 'ru' ? 'Оптимизация контента' : 'Content optimization',
                'text' => $currentLang === 'ru' 
                    ? 'Оптимизация мета-тегов, заголовков, текстов на страницах с учетом подобранных ключевых слов' 
                    : 'Optimizing meta tags, headers, page texts considering selected keywords',
            ],
            [
                '@type' => 'HowToStep',
                'position' => 4,
                'name' => $currentLang === 'ru' ? 'Построение ссылочной массы' : 'Link building',
                'text' => $currentLang === 'ru' 
                    ? 'Получение качественных обратных ссылок с авторитетных сайтов, развитие естественного ссылочного профиля' 
                    : 'Getting quality backlinks from authoritative websites, developing natural link profile',
            ],
            [
                '@type' => 'HowToStep',
                'position' => 5,
                'name' => $currentLang === 'ru' ? 'Мониторинг и оптимизация' : 'Monitoring and optimization',
                'text' => $currentLang === 'ru' 
                    ? 'Постоянное отслеживание позиций в поисковой выдаче, анализ результатов и корректировка стратегии' 
                    : 'Continuous tracking of search rankings, results analysis and strategy adjustment',
            ],
        ],
    ];
    $graph[] = $howToSchema;
}
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
// Генерируем hreflang теги для всех языков - глобальное покрытие
// Сначала добавляем основные языки с реальными переводами
foreach ($alternateLanguages as $lang => $url): 
    $hreflang = $lang === 'ru' ? 'ru-RU' : 'en-US';
    $fullUrl = $siteUrl . $url;
    // Для текущего языка используем canonical URL для согласованности
    if ($lang === $currentLang) {
        $fullUrl = $canonicalUrl;
    }
?>
<link rel="alternate" hreflang="<?php echo htmlspecialchars($hreflang); ?>" href="<?php echo htmlspecialchars($fullUrl); ?>">
<?php endforeach; ?>

<?php
// Добавляем глобальные hreflang теги для всех регионов мира
// Это помогает Google индексировать сайт во всех странах
foreach ($globalAlternateLanguages as $langCode => $url):
    if (!isset($alternateLanguages[$langCode])): // Избегаем дублирования
        $fullUrl = $siteUrl . $url;
?>
<link rel="alternate" hreflang="<?php echo htmlspecialchars($langCode); ?>" href="<?php echo htmlspecialchars($fullUrl); ?>">
<?php 
    endif;
endforeach; 
?>

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

<!-- Верификация поисковых систем -->
<meta name="yandex-verification" content="edd889cc7878b9f3">
<!-- Для верификации Bing добавьте мета-тег: <meta name="msvalidate.01" content="ВАШ_КОД_ВЕРИФИКАЦИИ" /> -->
<!-- Получить код можно в Bing Webmaster Tools: https://www.bing.com/webmasters -->

<!-- Дополнительные мета-теги для улучшения SEO - Глобальное покрытие -->
<meta name="geo.region" content="Worldwide">
<meta name="geo.placename" content="Global Services">
<meta name="geo.position" content="43.238949;76.889709">
<meta name="ICBM" content="43.238949, 76.889709">
<meta name="rating" content="general">
<meta name="distribution" content="global">
<meta name="revisit-after" content="7 days">
<meta name="coverage" content="worldwide">
<meta name="target" content="all">
<meta name="audience" content="all">

<!-- Глобальное географическое покрытие -->
<meta name="geo.region.primary" content="Worldwide">
<meta name="geo.region.secondary" content="Global">
<meta name="serving-region" content="Worldwide">
<meta name="service-area" content="Worldwide">
<meta name="international" content="true">
<meta name="global-service" content="true">
<meta name="worldwide-coverage" content="true">

<!-- Дополнительные мета-теги для улучшения индексации Google - Глобальное покрытие -->
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="googlebot-news" content="index, follow">
<meta name="googlebot-image" content="index, follow">
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="slurp" content="index, follow">
<meta name="duckduckbot" content="index, follow">
<meta name="baiduspider" content="index, follow">
<meta name="yandex" content="index, follow">
<meta name="yandexbot" content="index, follow">

<!-- Мета-теги для улучшения поиска -->
<meta name="classification" content="Business, Digital Agency, SEO Services, Web Development, Marketing">
<meta name="category" content="Digital Agency">
<meta name="subject" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta name="topic" content="<?php echo htmlspecialchars($meta['keywords'] ? substr($meta['keywords'], 0, 200) : ''); ?>">
<meta name="summary" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta name="Designer" content="<?php echo htmlspecialchars($siteName); ?>">
<meta name="Copyright" content="<?php echo htmlspecialchars($siteName); ?>">
<meta name="reply-to" content="contact@novacreatorstudio.com">
<meta name="owner" content="<?php echo htmlspecialchars($siteName); ?>">
<meta name="url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta name="identifier-URL" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta name="directory" content="submission">
<meta name="pagename" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta name="category" content="Business">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Дополнительные Open Graph теги для улучшения социальных сетей -->
<meta property="og:updated_time" content="<?php echo date('c'); ?>">
<meta property="og:see_also" content="<?php echo htmlspecialchars($siteUrl); ?>">
<?php if ($currentPage === 'index'): ?>
<meta property="business:contact_data:street_address" content="Almaty">
<meta property="business:contact_data:locality" content="Almaty">
<meta property="business:contact_data:region" content="Almaty">
<meta property="business:contact_data:postal_code" content="050000">
<meta property="business:contact_data:country_name" content="Kazakhstan">
<?php endif; ?>

<!-- Дополнительные Twitter Card теги -->
<meta name="twitter:domain" content="<?php echo htmlspecialchars($host); ?>">
<meta name="twitter:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">

<!-- Мета-теги для мобильных устройств (улучшение Core Web Vitals) -->
<meta name="format-detection" content="telephone=yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="<?php echo htmlspecialchars($siteName); ?>">

<!-- Мета-теги для глобальной доступности и мультиязычности -->
<meta name="content-language" content="<?php echo htmlspecialchars($currentLang); ?>">
<meta name="language" content="<?php echo htmlspecialchars($currentLang === 'ru' ? 'Russian' : 'English'); ?>">
<meta name="available-languages" content="ru, en">
<meta name="locale" content="<?php echo $currentLang === 'ru' ? 'ru_RU' : 'en_US'; ?>">
<meta name="supported-languages" content="ru-RU, en-US, en-GB, zh-CN, zh-TW, ja-JP, ko-KR, de-DE, fr-FR, es-ES, it-IT, pt-PT, pt-BR, ar-SA, hi-IN, nl-NL, pl-PL, tr-TR">

<!-- Мета-теги для всех стран и регионов -->
<meta name="country" content="Worldwide">
<meta name="region" content="Global">
<meta name="worldwide-service" content="true">
<meta name="international-business" content="true">
<meta name="global-coverage" content="true">
<meta name="multi-country" content="true">
<meta name="cross-border" content="true">

<!-- JSON-LD -->
<script type="application/ld+json">
<?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

