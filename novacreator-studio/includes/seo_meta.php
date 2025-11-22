<?php
/**
 * SEO мета-теги для каждой страницы
 * Определяет уникальные мета-теги, Open Graph, Twitter Cards и Schema.org
 */

// Базовый URL сайта (измените на ваш домен)
// ВАЖНО: Замените на ваш реальный домен перед запуском!
$siteUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
// Или укажите явно: $siteUrl = 'https://novacreator-studio.com';
$siteName = 'NovaCreator Studio';
$defaultImage = $siteUrl . '/assets/img/og-image.jpg'; // Создайте это изображение позже

// Определяем текущую страницу
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Массив с мета-данными для каждой страницы
$pagesMeta = [
    'index' => [
        'title' => 'NovaCreator Studio - Digital агентство | SEO, разработка сайтов, маркетинг',
        'description' => 'Профессиональное digital-агентство NovaCreator Studio. SEO-продвижение, разработка сайтов, Google Ads и маркетинговые стратегии. Работаем онлайн по всему миру.',
        'keywords' => 'digital агентство, SEO продвижение, разработка сайтов, Google Ads, контекстная реклама, маркетинг, веб-разработка, интернет-маркетинг',
        'og_type' => 'website',
        'schema_type' => 'Organization'
    ],
    'services' => [
        'title' => 'Услуги Digital-агентства | SEO, разработка, маркетинг - NovaCreator Studio',
        'description' => 'Комплексные digital-услуги: SEO-оптимизация, разработка сайтов, Google Ads, маркетинг и аналитика. Полный цикл услуг для роста вашего бизнеса в интернете.',
        'keywords' => 'услуги digital агентства, SEO услуги, разработка сайтов, контекстная реклама, маркетинговые услуги, веб-разработка',
        'og_type' => 'website',
        'schema_type' => 'Service'
    ],
    'seo' => [
        'title' => 'SEO-оптимизация сайтов | Продвижение в Яндекс и Google - NovaCreator Studio',
        'description' => 'Профессиональная SEO-оптимизация сайтов. Выводим в топ Яндекс и Google. Технический SEO, контент-оптимизация, ссылочное продвижение. Результаты: +250% трафика.',
        'keywords' => 'SEO оптимизация, продвижение сайтов, SEO продвижение, поисковая оптимизация, SEO услуги, продвижение в Яндекс, продвижение в Google',
        'og_type' => 'article',
        'schema_type' => 'Service'
    ],
    'ads' => [
        'title' => 'Google Ads - Настройка и ведение контекстной рекламы | NovaCreator Studio',
        'description' => 'Настройка и ведение рекламных кампаний в Google Ads под ключ. Создание объявлений, работа с ключевыми словами, оптимизация для максимального ROI.',
        'keywords' => 'Google Ads, контекстная реклама, настройка Google Ads, реклама в Google, контекстная реклама под ключ, PPC реклама',
        'og_type' => 'article',
        'schema_type' => 'Service'
    ],
    'portfolio' => [
        'title' => 'Портфолио проектов | Примеры работ Digital-агентства - NovaCreator Studio',
        'description' => 'Портфолио успешных проектов NovaCreator Studio. Реальные кейсы: motorland.kz и другие. Результаты: рост трафика до 400%, увеличение конверсий.',
        'keywords' => 'портфолио digital агентства, примеры работ, кейсы продвижения, успешные проекты SEO',
        'og_type' => 'website',
        'schema_type' => 'CreativeWork'
    ],
    'about' => [
        'title' => 'О компании NovaCreator Studio | Команда Digital-агентства',
        'description' => 'NovaCreator Studio - новое digital-агентство с большим опытом команды. Мишкин Виктор и Амири Искандер. Работаем онлайн, помогаем бизнесу расти в интернете.',
        'keywords' => 'о компании, digital агентство, команда разработчиков, команда маркетологов, о нас',
        'og_type' => 'profile',
        'schema_type' => 'Organization'
    ],
    'contact' => [
        'title' => 'Контакты NovaCreator Studio | Связаться с нами',
        'description' => 'Свяжитесь с NovaCreator Studio. Телефон: +7 706 606 39 21, Email: victhewise@icloud.com. Работаем каждый день, онлайн по всему миру.',
        'keywords' => 'контакты, связаться, заявка, обратная связь, телефон, email',
        'og_type' => 'website',
        'schema_type' => 'ContactPage'
    ],
    'vacancies' => [
        'title' => 'Вакансии в NovaCreator Studio | Работа в Digital-агентстве',
        'description' => 'Открытые вакансии в NovaCreator Studio. Ищем SEO-специалистов, веб-разработчиков, специалистов по контекстной рекламе. Удаленная работа, гибкий график.',
        'keywords' => 'вакансии, работа в digital агентстве, удаленная работа, вакансии SEO, вакансии разработчика',
        'og_type' => 'website',
        'schema_type' => 'JobPosting'
    ]
];

// Получаем мета-данные для текущей страницы или используем значения по умолчанию
$meta = isset($pagesMeta[$currentPage]) ? $pagesMeta[$currentPage] : $pagesMeta['index'];

// Если на странице заданы кастомные мета-теги, используем их
if (isset($pageMetaTitle)) $meta['title'] = $pageMetaTitle;
if (isset($pageMetaDescription)) $meta['description'] = $pageMetaDescription;
if (isset($pageMetaKeywords)) $meta['keywords'] = $pageMetaKeywords;

// Формируем полный URL страницы
$pageUrl = $siteUrl . '/' . ($currentPage === 'index' ? '' : $currentPage . '.php');
?>

<!-- Основные мета-теги -->
<meta name="description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($meta['keywords']); ?>">
<meta name="author" content="NovaCreator Studio">
<meta name="robots" content="index, follow">
<meta name="language" content="Russian">
<meta name="revisit-after" content="7 days">

<!-- Open Graph (Facebook, VK) -->
<meta property="og:type" content="<?php echo $meta['og_type']; ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta property="og:url" content="<?php echo $pageUrl; ?>">
<meta property="og:site_name" content="<?php echo $siteName; ?>">
<meta property="og:image" content="<?php echo $defaultImage; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="ru_RU">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($meta['description']); ?>">
<meta name="twitter:image" content="<?php echo $defaultImage; ?>">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo $pageUrl; ?>">

<!-- Структурированные данные (Schema.org JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "<?php echo $meta['schema_type']; ?>",
  "name": "<?php echo $siteName; ?>",
  "url": "<?php echo $siteUrl; ?>",
  "logo": "<?php echo $siteUrl; ?>/assets/img/logo.png",
  "description": "<?php echo htmlspecialchars($meta['description']); ?>",
  <?php if ($meta['schema_type'] === 'Organization'): ?>
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+7-706-606-39-21",
    "contactType": "customer service",
    "email": "victhewise@icloud.com",
    "availableLanguage": "Russian"
  },
  "sameAs": [
    "https://t.me/novacreator_studio"
  ],
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "KZ"
  },
  <?php endif; ?>
  <?php if ($currentPage === 'index'): ?>
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "98"
  },
  <?php endif; ?>
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?php echo $siteUrl; ?>/?s={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<?php
// Дополнительные структурированные данные для конкретных страниц
if ($currentPage === 'contact'): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "mainEntity": {
    "@type": "Organization",
    "name": "<?php echo $siteName; ?>",
    "telephone": "+7-706-606-39-21",
    "email": "victhewise@icloud.com"
  }
}
</script>
<?php endif; ?>

<?php if ($currentPage === 'services'): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "Digital Marketing Services",
  "provider": {
    "@type": "Organization",
    "name": "<?php echo $siteName; ?>"
  },
  "areaServed": "Worldwide",
  "availableChannel": {
    "@type": "ServiceChannel",
    "serviceUrl": "<?php echo $siteUrl; ?>/contact.php"
  }
}
</script>
<?php endif; ?>

<?php if ($currentPage === 'vacancies'): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "JobPosting",
  "title": "SEO-специалист",
  "description": "Ищем опытного SEO-специалиста для работы над проектами клиентов.",
  "hiringOrganization": {
    "@type": "Organization",
    "name": "<?php echo $siteName; ?>"
  },
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "KZ"
    }
  },
  "employmentType": "FULL_TIME",
  "workHours": "Flexible"
}
</script>
<?php endif; ?>

