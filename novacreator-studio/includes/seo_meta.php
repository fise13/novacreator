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
        'keywords' => 'digital агентство, SEO продвижение, разработка сайтов, Google Ads, контекстная реклама, маркетинг, веб-разработка, интернет-маркетинг, продвижение сайтов, SEO оптимизация, создание сайтов, настройка рекламы, интернет-реклама, веб-студия, маркетинговое агентство, продвижение бизнеса в интернете, digital маркетинг, SMM продвижение, контент-маркетинг, email маркетинг, аналитика сайта, настройка Яндекс Директ, реклама в соцсетях, таргетированная реклама, веб-дизайн, разработка интернет-магазинов, лендинги, корпоративные сайты, мобильная разработка, UX/UI дизайн, техническая поддержка сайтов, аудит сайта, конверсия сайта, увеличение продаж, привлечение клиентов, брендинг, рекламные кампании, медиапланирование, маркетинговые исследования, digital агентство Казахстан, SEO продвижение Алматы, разработка сайтов Астана, веб-студия Казахстан, маркетинговое агентство Алматы, контекстная реклама Казахстан, продвижение сайтов в Казахстане, интернет-маркетинг Алматы, веб-разработка Астана, создание сайтов Казахстан',
        'og_type' => 'website',
        'schema_type' => 'Organization'
    ],
    'services' => [
        'title' => 'Услуги Digital-агентства | SEO, разработка, маркетинг - NovaCreator Studio',
        'description' => 'Комплексные digital-услуги: SEO-оптимизация, разработка сайтов, Google Ads, маркетинг и аналитика. Полный цикл услуг для роста вашего бизнеса в интернете.',
        'keywords' => 'услуги digital агентства, SEO услуги, разработка сайтов, контекстная реклама, маркетинговые услуги, веб-разработка, услуги по продвижению сайтов, услуги интернет-маркетинга, создание сайтов под ключ, разработка лендингов, создание интернет-магазинов, настройка рекламных кампаний, услуги SMM, продвижение в соцсетях, контент-маркетинг услуги, email маркетинг, веб-дизайн услуги, UX/UI дизайн, мобильная разработка, техническая поддержка сайтов, аудит сайта, оптимизация конверсии, увеличение продаж онлайн, привлечение клиентов через интернет, брендинг услуги, медиапланирование, маркетинговые исследования, аналитика и отчетность, автоматизация маркетинга',
        'og_type' => 'website',
        'schema_type' => 'Service'
    ],
    'seo' => [
        'title' => 'SEO-оптимизация сайтов | Продвижение в Яндекс и Google - NovaCreator Studio',
        'description' => 'Профессиональная SEO-оптимизация сайтов. Выводим в топ Яндекс и Google. Технический SEO, контент-оптимизация, ссылочное продвижение. Результаты: +250% трафика.',
        'keywords' => 'SEO оптимизация, продвижение сайтов, SEO продвижение, поисковая оптимизация, SEO услуги, продвижение в Яндекс, продвижение в Google, вывести сайт в топ, поднять сайт в поиске, SEO продвижение сайта, оптимизация под поисковые системы, технический SEO, контент-маркетинг, ссылочное продвижение, внутренняя оптимизация, внешняя оптимизация, продвижение по запросам, работа с ключевыми словами, SEO аудит, анализ конкурентов, улучшение позиций сайта, увеличение органического трафика, продвижение интернет-магазина, SEO для бизнеса, локальное SEO, продвижение в регионах, мобильная оптимизация, скорость загрузки сайта, индексация сайта, работа с мета-тегами, структурированные данные, микроразметка, карта сайта, robots.txt, canonical теги, редиректы, оптимизация изображений, LSI ключевые слова, семантическое ядро',
        'og_type' => 'article',
        'schema_type' => 'Service'
    ],
    'ads' => [
        'title' => 'Google Ads - Настройка и ведение контекстной рекламы | NovaCreator Studio',
        'description' => 'Настройка и ведение рекламных кампаний в Google Ads под ключ. Создание объявлений, работа с ключевыми словами, оптимизация для максимального ROI.',
        'keywords' => 'Google Ads, контекстная реклама, настройка Google Ads, реклама в Google, контекстная реклама под ключ, PPC реклама, Яндекс Директ, настройка Яндекс Директ, контекстная реклама Яндекс, реклама в поиске, медийная реклама, рекламные кампании, настройка рекламы, ведение рекламы, управление рекламными кампаниями, оптимизация рекламы, снижение стоимости клика, увеличение конверсии рекламы, ретаргетинг, ремаркетинг, динамические объявления, умная реклама, автоматизация рекламы, работа с ключевыми словами, минус-слова, расширения объявлений, объявления в поиске, баннерная реклама, видеореклама, реклама в мобильных приложениях, Shopping кампании, Performance Max, поисковая реклама, реклама в сетях, таргетинг, аудитории, конверсии, ROI рекламы, CPA оптимизация, CPC оптимизация, CTR объявлений, качество объявлений, рекламный бюджет, ставки в рекламе',
        'og_type' => 'article',
        'schema_type' => 'Service'
    ],
    'portfolio' => [
        'title' => 'Портфолио проектов | Примеры работ Digital-агентства - NovaCreator Studio',
        'description' => 'Портфолио успешных проектов NovaCreator Studio. Молодая компания с большим стажем работы команды. Реальные кейсы и результаты: рост трафика, увеличение конверсий.',
        'keywords' => 'портфолио digital агентства, примеры работ, кейсы продвижения, успешные проекты SEO, кейсы продвижения сайтов, примеры SEO работ, кейсы интернет-маркетинга, примеры разработки сайтов, успешные кейсы рекламы, результаты продвижения, кейсы увеличения трафика, примеры роста конверсий, кейсы Google Ads, примеры настройки рекламы, кейсы создания сайтов, примеры веб-разработки, успешные проекты, реализованные проекты, отзывы клиентов, результаты работы, достижения агентства, топ проекты, лучшие кейсы, примеры работ агентства',
        'og_type' => 'website',
        'schema_type' => 'CreativeWork'
    ],
    'about' => [
        'title' => 'О компании NovaCreator Studio | Команда Digital-агентства',
        'description' => 'NovaCreator Studio - новое digital-агентство с большим опытом команды. Мишкин Виктор и Амири Искандер. Работаем онлайн, помогаем бизнесу расти в интернете.',
        'keywords' => 'о компании, digital агентство, команда разработчиков, команда маркетологов, о нас, история компании, опыт работы, специалисты агентства, команда профессионалов, эксперты по SEO, опытные разработчики, маркетологи, веб-дизайнеры, специалисты по рекламе, команда NovaCreator Studio, кто мы, наши ценности, наш подход, методология работы, принципы работы, клиенты агентства, партнеры, достижения, награды, сертификаты, опыт команды, квалификация специалистов, профессиональная команда',
        'og_type' => 'profile',
        'schema_type' => 'Organization'
    ],
    'contact' => [
        'title' => 'Контакты NovaCreator Studio | Связаться с нами',
        'description' => 'Свяжитесь с NovaCreator Studio. Телефон: +7 706 606 39 21, Email: contact@novacreatorstudio.com. Работаем каждый день, онлайн по всему миру.',
        'keywords' => 'контакты, связаться, заявка, обратная связь, телефон, email, как связаться, контактная информация, адрес агентства, телефон агентства, email агентства, оставить заявку, бесплатная консультация, заказать услуги, получить консультацию, связаться с агентством, контакты digital агентства, написать нам, позвонить, заказать звонок, форма обратной связи, контактная форма, записаться на консультацию, получить предложение, рассчитать стоимость, обсудить проект',
        'og_type' => 'website',
        'schema_type' => 'ContactPage'
    ],
    'vacancies' => [
        'title' => 'Вакансии в NovaCreator Studio | Работа в Digital-агентстве',
        'description' => 'Открытые вакансии в NovaCreator Studio. Ищем SEO-специалистов, веб-разработчиков, специалистов по контекстной рекламе. Удаленная работа, гибкий график.',
        'keywords' => 'вакансии, работа в digital агентстве, удаленная работа, вакансии SEO, вакансии разработчика, работа маркетологом, вакансии веб-дизайнера, работа SMM специалистом, вакансии контекстной рекламы, работа удаленно, работа в интернете, работа в маркетинге, вакансии в агентстве, работа в веб-студии, карьера в digital, работа SEO специалистом, вакансии копирайтера, работа контент-менеджером, вакансии аналитика, работа проектировщиком, вакансии UX/UI дизайнера, работа frontend разработчиком, вакансии backend разработчика, работа в команде, гибкий график, работа на дому, фриланс, постоянная работа, стажировка, начать карьеру в digital',
        'og_type' => 'website',
        'schema_type' => 'JobPosting'
    ],
    'calculator' => [
        'title' => 'Калькулятор стоимости услуг | Рассчитать цену - NovaCreator Studio',
        'description' => 'Рассчитайте стоимость услуг digital-агентства: SEO-продвижение, разработка сайтов, Google Ads. Быстрый расчет цены онлайн. Бесплатный калькулятор.',
        'keywords' => 'калькулятор стоимости, рассчитать цену, стоимость SEO, цена разработки сайта, стоимость рекламы, калькулятор услуг, рассчитать стоимость сайта, цена SEO продвижения, стоимость Google Ads, калькулятор цены',
        'og_type' => 'website',
        'schema_type' => 'WebPage'
    ],
    'blog' => [
        'title' => 'Блог о Digital-маркетинге | Полезные статьи - NovaCreator Studio',
        'description' => 'Полезные статьи о SEO, разработке сайтов, Google Ads и digital-маркетинге. Советы экспертов, кейсы, новости индустрии.',
        'keywords' => 'блог digital маркетинг, статьи о SEO, статьи о разработке сайтов, статьи о рекламе, полезные материалы, кейсы, советы экспертов, новости digital, статьи о маркетинге',
        'og_type' => 'website',
        'schema_type' => 'Blog'
    ]
];

// Получаем мета-данные для текущей страницы или используем значения по умолчанию
$meta = isset($pagesMeta[$currentPage]) ? $pagesMeta[$currentPage] : $pagesMeta['index'];

// Если на странице заданы кастомные мета-теги, используем их
if (isset($pageMetaTitle)) $meta['title'] = $pageMetaTitle;
if (isset($pageMetaDescription)) $meta['description'] = $pageMetaDescription;
if (isset($pageMetaKeywords)) $meta['keywords'] = $pageMetaKeywords;

// Формируем полный URL страницы
$pageUrl = $siteUrl . ($currentPage === 'index' ? '' : '/' . $currentPage);
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
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:alt" content="<?php echo htmlspecialchars($meta['title']); ?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:locale:alternate" content="kk_KZ">

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
    "email": "contact@novacreatorstudio.com",
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
    "email": "contact@novacreatorstudio.com"
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
    "serviceUrl": "<?php echo $siteUrl; ?>/contact"
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

