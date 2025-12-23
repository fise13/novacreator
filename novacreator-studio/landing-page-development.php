<?php
/**
 * Страница услуги: Разработка лендингов
 * Отдельная SEO-страница для продвижения услуги разработки лендинг-страниц
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'Landing Page Development' : 'Разработка лендингов';
$pageMetaTitle = $currentLang === 'en' 
    ? 'Landing Page Development | Professional Landing Pages | NovaCreator Studio'
    : 'Разработка лендингов — создание продающих лендинг-страниц под ключ';
$pageMetaDescription = $currentLang === 'en'
    ? 'Professional landing page development services. Create high-converting landing pages for your business. Fast, SEO-optimized, mobile-friendly landing pages with guaranteed results.'
    : 'Разработка лендингов под ключ. Создаем продающие одностраничные сайты с высокой конверсией. Быстрая загрузка, SEO-оптимизация, адаптивный дизайн. Ориентир по цене от 150 000 тенге.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'landing page development, landing page design, landing page creation, landing page builder, conversion landing page'
    : 'разработка лендингов, создание лендинга, лендинг под ключ, одностраничный сайт, лендинг пейдж, разработка лендинга цена';
$pageMetaCanonical = '/landing-page-development';

include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Landing Page Development' : 'Разработка лендингов'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Create high-converting landing pages that turn visitors into customers'
                    : 'Создаем продающие одностраничные сайты, которые превращают посетителей в клиентов'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Что такое лендинг -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What is a Landing Page' : 'Что такое лендинг'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'A landing page is a single-page website designed to convert visitors into leads or customers. Unlike regular websites, landing pages focus on one specific goal: getting a user to take a specific action — fill out a form, make a purchase, sign up for a service.'
                        : 'Лендинг — это одностраничный сайт, который создан для одной цели: превратить посетителя в клиента. В отличие от обычных сайтов, лендинг не отвлекает навигацией, меню и лишними страницами. Весь контент направлен на одно действие: заполнить форму, купить товар, записаться на консультацию.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'Landing pages work best when you run advertising campaigns in Google Ads or Yandex.Direct. Visitors click on your ad, land on a page that clearly explains your offer, and take action.'
                        : 'Лендинги эффективнее всего работают вместе с контекстной рекламой: пользователь кликает на объявление в Google или Яндекс, попадает на страницу, которая четко объясняет предложение, и выполняет нужное действие.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Кому подходит -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Who Needs a Landing Page' : 'Кому нужен лендинг'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Businesses launching advertising campaigns' : 'Бизнесы, запускающие рекламу'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you plan to run ads in Google Ads or Yandex.Direct, you need a landing page. Regular websites have too many distractions — navigation, multiple pages, footer links. A landing page keeps visitors focused on your offer.'
                            : 'Если вы планируете запустить рекламу в Google Ads или Яндекс.Директ, вам нужен лендинг. Обычный сайт отвлекает навигацией, множеством страниц, ссылками в футере. Лендинг удерживает внимание на вашем предложении.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Companies promoting specific products or services' : 'Компании, продвигающие конкретный товар или услугу'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'A landing page is perfect when you want to promote one product, service, or special offer. For example: a course, a consultation, a specific product, a seasonal promotion.'
                            : 'Лендинг идеален, когда вы хотите продвинуть один товар, услугу или специальное предложение. Например: курс, консультацию, конкретный товар, сезонную акцию.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Startups and small businesses' : 'Стартапы и малый бизнес'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Landing pages are faster and cheaper to develop than full websites. If you need to quickly test an idea or launch a campaign, a landing page is the right solution.'
                            : 'Лендинги делаются быстрее и дешевле, чем полноценные сайты. Если нужно быстро протестировать идею или запустить рекламную кампанию, лендинг — правильное решение.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Когда лендинг НЕ подойдет -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'When a Landing Page Won\'t Work' : 'Когда лендинг не подойдет'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You need a full website with multiple pages' : 'Вам нужен полноценный сайт с несколькими страницами'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you need multiple pages (about, services, blog, portfolio), a landing page is not enough. You need a <a href="' . getLocalizedUrl($currentLang, '/corporate-website-development') . '" class="underline">corporate website</a> or <a href="' . getLocalizedUrl($currentLang, '/ecommerce-development') . '" class="underline">e-commerce site</a>. Landing pages are single-page — they can\'t replace a full website structure.'
                            : 'Если вам нужны несколько страниц (о компании, услуги, блог, портфолио), лендинга недостаточно. Вам нужен <a href="' . getLocalizedUrl($currentLang, '/corporate-website-development') . '" class="underline">корпоративный сайт</a> или <a href="' . getLocalizedUrl($currentLang, '/ecommerce-development') . '" class="underline">интернет-магазин</a>. Лендинги одностраничные — они не могут заменить полноценную структуру сайта.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You don\'t plan to run advertising' : 'Вы не планируете запускать рекламу'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Landing pages work best with advertising campaigns. If you\'re not planning to run ads in Google Ads or Yandex.Direct, a regular website is better — it can be promoted organically through <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a>, has navigation, and serves as a full business presence online.'
                            : 'Лендинги лучше всего работают с рекламными кампаниями. Если вы не планируете запускать рекламу в Google Ads или Яндекс.Директ, обычный сайт лучше — его можно продвигать органически через <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a>, у него есть навигация, и он служит полноценным представительством бизнеса в интернете.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You sell many different products or services' : 'Вы продаете много разных товаров или услуг'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you offer multiple products or services, a landing page can\'t present them all effectively. A landing page focuses on one offer. For multiple offers, you need a catalog structure, categories, separate pages — that\'s a full website.'
                            : 'Если вы предлагаете множество товаров или услуг, лендинг не может эффективно представить их все. Лендинг фокусируется на одном предложении. Для множества предложений нужна структура каталога, категории, отдельные страницы — это полноценный сайт.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You need regular content updates (blog, news)' : 'Вам нужны регулярные обновления контента (блог, новости)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you plan to publish articles, news, or updates regularly, a landing page is too limited. You need a website with a blog section, news page, or content management system. Landing pages are static — they\'re designed for one-time campaigns, not ongoing content publishing.'
                            : 'Если вы планируете регулярно публиковать статьи, новости или обновления, лендинг слишком ограничен. Вам нужен сайт с блогом, страницей новостей или системой управления контентом. Лендинги статичны — они созданы для разовых кампаний, а не для постоянной публикации контента.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Что включает разработка -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What\'s Included' : 'Что включает разработка лендинга'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '1. Analysis and planning' : '1. Анализ и планирование'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We study your target audience, competitors, and the product or service you\'re promoting. Based on this, we create a structure and content plan for the landing page.'
                            : 'Изучаем вашу целевую аудиторию, конкурентов и товар/услугу, которую продвигаете. На основе этого создаем структуру и план контента для лендинга.'; ?>
                    </p>
                    <ul class="space-y-2 ml-6" style="color: var(--color-text-secondary);">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><?php echo $currentLang === 'en' ? 'Target audience analysis' : 'Анализ целевой аудитории'; ?></span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><?php echo $currentLang === 'en' ? 'Competitor research' : 'Исследование конкурентов'; ?></span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><?php echo $currentLang === 'en' ? 'Content structure planning' : 'Планирование структуры контента'; ?></span>
                        </li>
                    </ul>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '2. Design and layout' : '2. Дизайн и верстка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We create a design that matches your brand and focuses on conversion. The page is fully responsive — it looks good on phones, tablets, and desktops.'
                            : 'Создаем дизайн, который соответствует вашему бренду и сфокусирован на конверсии. Страница полностью адаптивная — хорошо выглядит на телефонах, планшетах и компьютерах.'; ?>
                    </p>
                    <ul class="space-y-2 ml-6" style="color: var(--color-text-secondary);">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><?php echo $currentLang === 'en' ? 'Custom design or template adaptation' : 'Уникальный дизайн или адаптация шаблона'; ?></span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><?php echo $currentLang === 'en' ? 'Responsive layout for all devices' : 'Адаптивная верстка для всех устройств'; ?></span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><?php echo $currentLang === 'en' ? 'Optimization for fast loading' : 'Оптимизация для быстрой загрузки'; ?></span>
                        </li>
                    </ul>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '3. Content creation' : '3. Написание контента'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We write clear, persuasive texts that explain your offer and motivate action. Headlines, benefits, social proof, call-to-action buttons — everything works toward conversion.'
                            : 'Пишем понятные, убедительные тексты, которые объясняют ваше предложение и мотивируют к действию. Заголовки, выгоды, социальные доказательства, кнопки призыва — всё работает на конверсию.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '4. Forms and integrations' : '4. Формы и интеграции'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We set up contact forms that send notifications to your email or Telegram. We can integrate with CRM systems, payment systems, analytics.'
                            : 'Настраиваем формы обратной связи, которые отправляют уведомления на вашу почту или Telegram. Можем интегрировать с CRM-системами, платежными системами, аналитикой.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '5. SEO preparation' : '5. SEO-подготовка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We optimize the page for search engines: meta tags, semantic markup, fast loading, mobile-friendly design. If needed, the page can be promoted in organic search.'
                            : 'Готовим страницу к продвижению в поисковиках: мета-теги, семантическая разметка, быстрая загрузка, мобильная версия. При необходимости лендинг можно продвигать в органическом поиске.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Какой результат получает клиент -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What Results You Get' : 'Какой результат получает клиент'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'A page focused on conversion' : 'Страница, сфокусированная на конверсии'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Unlike regular websites with navigation and multiple pages, a landing page directs all attention to one goal: getting visitors to take action (fill out a form, make a purchase, call). Every element works toward conversion — headlines, benefits, social proof, call-to-action buttons.'
                            : 'В отличие от обычных сайтов с навигацией и множеством страниц, лендинг направляет все внимание на одну цель: заставить посетителей действовать (заполнить форму, купить, позвонить). Каждый элемент работает на конверсию — заголовки, выгоды, социальные доказательства, кнопки призыва.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Higher conversion rates from advertising traffic' : 'Более высокие конверсии из рекламного трафика'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'When people click on your ad, they land on a page that immediately explains your offer — no distractions, no navigation to other pages. This increases conversion rates compared to sending traffic to a regular website where visitors might get lost or distracted.'
                            : 'Когда люди кликают на вашу рекламу, они попадают на страницу, которая сразу объясняет ваше предложение — без отвлечений, без навигации на другие страницы. Это увеличивает конверсии по сравнению с отправкой трафика на обычный сайт, где посетители могут потеряться или отвлечься.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Fast launch — ready in 10-14 days' : 'Быстрый запуск — готов за 10-14 дней'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'A landing page is faster to develop than a full website. You get a working page in 10-14 business days, test it with advertising, see results quickly. If you need to launch a campaign urgently, a landing page is the fastest option.'
                            : 'Лендинг быстрее разработать, чем полноценный сайт. Вы получаете работающую страницу за 10-14 рабочих дней, тестируете её рекламой, быстро видите результаты. Если нужно срочно запустить кампанию, лендинг — самый быстрый вариант.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Lower cost than a full website' : 'Меньшая стоимость, чем полноценный сайт'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Since a landing page is simpler (one page vs multiple pages), development costs less. This makes it accessible for small businesses and startups with limited budgets. You can test an idea with a landing page, and if it works, invest in a full website later.'
                            : 'Поскольку лендинг проще (одна страница против множества), разработка стоит дешевле. Это делает его доступным для малого бизнеса и стартапов с ограниченным бюджетом. Вы можете протестировать идею лендингом, а если работает — инвестировать в полноценный сайт позже.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Этапы работы -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'How We Work' : 'Этапы работы'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Day 1-3: Brief and analysis' : 'Дни 1-3: Бриф и анализ'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We discuss your goals, target audience, and requirements. We study competitors and create a content plan.'
                            : 'Обсуждаем ваши цели, целевую аудиторию и требования. Изучаем конкурентов и создаем план контента.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Day 4-7: Design and content' : 'Дни 4-7: Дизайн и контент'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We create the design, write texts, prepare images. We show you a preview and make corrections based on your feedback.'
                            : 'Создаем дизайн, пишем тексты, подготавливаем изображения. Показываем предпросмотр и вносим правки по вашим замечаниям.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Day 8-12: Development and setup' : 'Дни 8-12: Разработка и настройка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We code the page, set up forms, integrate with necessary services, test on different devices. We optimize loading speed.'
                            : 'Верстаем страницу, настраиваем формы, интегрируем с необходимыми сервисами, тестируем на разных устройствах. Оптимизируем скорость загрузки.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Day 13-14: Testing and launch' : 'Дни 13-14: Тестирование и запуск'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We test all functions, check forms, test on different browsers and devices. We deploy the page to your hosting and provide access.'
                            : 'Тестируем все функции, проверяем формы, тестируем в разных браузерах и устройствах. Размещаем страницу на вашем хостинге и предоставляем доступ.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Сроки и цены -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Timeline and Pricing' : 'Сроки и ориентиры по цене'; ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Timeline' : 'Сроки разработки'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Standard landing page: 10-14 business days from brief to launch. Complex pages with integrations: 15-20 business days.'
                            : 'Стандартный лендинг: 10-14 рабочих дней от брифования до запуска. Сложные страницы с интеграциями: 15-20 рабочих дней.'; ?>
                    </p>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Rush orders are possible, but may affect quality. We always prioritize quality over speed.'
                            : 'Срочные заказы возможны, но могут повлиять на качество. Мы всегда ставим качество выше скорости.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Pricing' : 'Ориентиры по цене'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Simple landing page: from 150,000 KZT (≈$300). Standard landing page: from 250,000 KZT (≈$500). Complex landing page with integrations: from 400,000 KZT (≈$800).'
                            : 'Простой лендинг: от 150 000 тенге. Стандартный лендинг: от 250 000 тенге. Сложный лендинг с интеграциями: от 400 000 тенге.'; ?>
                    </p>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Final price depends on complexity, number of sections, integrations, and design requirements. We provide a detailed estimate after discussing your needs.'
                            : 'Итоговая стоимость зависит от сложности, количества секций, интеграций и требований к дизайну. Точную смету предоставляем после обсуждения ваших потребностей.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Frequently Asked Questions' : 'Частые вопросы'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'How long does it take to create a landing page?' : 'Сколько времени занимает создание лендинга?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Standard landing page: 10-14 business days. This includes analysis, design, content creation, development, and testing. Complex pages with many integrations may take 15-20 days.'
                            : 'Стандартный лендинг: 10-14 рабочих дней. Это включает анализ, дизайн, написание контента, разработку и тестирование. Сложные страницы с множеством интеграций могут занять 15-20 дней.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What\'s the difference between a landing page and a regular website?' : 'В чем разница между лендингом и обычным сайтом?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'A landing page is a single-page site focused on one goal (form submission, purchase, sign-up). A regular website has multiple pages with navigation, blog, various sections. Landing pages are better for advertising campaigns, regular websites are better for comprehensive business presentation.'
                            : 'Лендинг — одностраничный сайт, сфокусированный на одной цели (заполнение формы, покупка, запись). Обычный сайт имеет множество страниц с навигацией, блогом, разными разделами. Лендинги лучше для рекламных кампаний, обычные сайты — для комплексной презентации бизнеса.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Can I edit the landing page content myself?' : 'Смогу ли я редактировать контент лендинга самостоятельно?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We can develop a landing page with a simple admin panel where you can edit texts, images, and prices. This increases the cost, but gives you independence. Most clients prefer to request changes from us — it\'s faster and safer.'
                            : 'Можем разработать лендинг с простой админ-панелью, где вы сможете редактировать тексты, изображения и цены. Это увеличивает стоимость, но дает вам независимость. Большинство клиентов предпочитают заказывать правки у нас — это быстрее и безопаснее.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Do you guarantee conversion rates?' : 'Вы гарантируете конверсию?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We cannot guarantee specific conversion rates — conversion depends on many factors: your product, pricing, advertising quality, market situation. But we create landing pages using proven conversion optimization techniques and test different elements to improve results.'
                            : 'Мы не можем гарантировать конкретную конверсию — она зависит от множества факторов: ваш товар, цены, качество рекламы, ситуация на рынке. Но мы создаем лендинги с использованием проверенных техник оптимизации конверсии и тестируем разные элементы для улучшения результатов.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-12 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Ready to Create Your Landing Page?' : 'Готовы создать лендинг?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Contact us to discuss your project and get a detailed estimate'
                    : 'Свяжитесь с нами, чтобы обсудить проект и получить подробную смету'; ?>
            </p>
            <div class="reveal">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Discuss Project' : 'Обсудить проект'; ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

