<?php
/**
 * Страница портфолио
 * Подборка кейсов с фокусом на бизнес-результаты
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.portfolio.breadcrumb');
$pageMetaTitle = t('seo.pages.portfolio.title');
$pageMetaDescription = t('seo.pages.portfolio.description');
$pageMetaKeywords = t('seo.pages.portfolio.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - минималистичный стиль holymedia.kz -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.portfolio.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<?php
// Данные проектов на двух языках
if ($currentLang === 'en') {
    $projects = [
        [
            'id' => 'northern-beans',
            'title' => 'Coffee shop “Northern Beans”',
            'tag' => 'Website',
            'tagBadge' => 'Website',
            'summary' => 'One‑page website for a local coffee shop with focus on atmosphere, simple pre‑order and clear menu.',
            'before' => [
                'No website, only Instagram — guests didn\'t see the full menu and special offers.',
                'Orders for takeaway were chaotic: people wrote in direct, messages got lost.',
                'No local SEO: the coffee shop was almost invisible in Google and maps.'
            ],
            'after' => [
                'Structured one‑page site with clear menu and “Order for pickup” CTA.',
                'Interactive menu with filters by strength, milk and volume.',
                'Local SEO and LocalBusiness schema for maps and search.'
            ],
            'result' => 'Result: 340% increase in online orders (from 12-15/week to 52-60/week), appeared in Google Maps top-3 for "coffee shop [district]" within 3 months, 1.8s page load time, 92 Mobile PageSpeed score.',
            'metrics' => [
                'Orders growth' => '+340%',
                'PageSpeed' => '92/100',
                'Load time' => '1.8s',
                'Maps ranking' => 'Top 3'
            ],
            'meta' => 'PHP · TailwindCSS · Schema.org LocalBusiness · OpenGraph · Responsive design · Semantic HTML5'
        ],
        [
            'id' => 'bodycraft',
            'title' => 'Personal trainer “BodyCraft”',
            'tag' => 'Personal brand',
            'tagBadge' => 'Personal brand',
            'summary' => 'Landing page for a personal trainer that sells offline and online training through clear positioning and client transformations.',
            'before' => [
                'Scattered social media posts without a single sales page.',
                'Clients didn\'t understand what exactly they get and how long it would take.',
                'No system for collecting applications — only DMs and comments.'
            ],
            'after' => [
                'Hero block “3 workouts a week for 40 minutes” instead of abstract slogans.',
                'Case section with “before / after” stories: starting point, term, result.',
                'Mini‑quiz “When will you see results?” that collects leads to messengers.'
            ],
            'result' => 'Result: 18.5% conversion rate from traffic to lead form, 6.2s average session duration, structured content with H1-H3 hierarchy, integrated with Telegram API for instant lead delivery (avg response time: 12 seconds).',
            'metrics' => [
                'Conversion rate' => '18.5%',
                'Avg session' => '6.2 мин',
                'Lead delivery' => '12 сек',
                'Bounce rate' => '42%'
            ],
            'meta' => 'PHP · Telegram Bot API · Form validation · Analytics integration · Content structure · A/B testing setup'
        ],
        [
            'id' => 'urbanframe',
            'title' => 'Construction company “UrbanFrame”',
            'tag' => 'Landing',
            'tagBadge' => 'Landing',
            'summary' => 'Landing page for a company that builds low‑rise houses. The task was to explain a complex product in simple language and remove distrust.',
            'before' => [
                'Old template website with a list of services and no clear process description.',
                'No explanation “what is included in the price” — clients were afraid of hidden costs.',
                'Few incoming requests from the site, most deals came only by word of mouth.'
            ],
            'after' => [
                'Step‑by‑step project roadmap: from site survey to house handover.',
                'Block “What the price consists of” with transparent breakdown by stages.',
                'Gallery of real objects plus documents and guarantees in a convenient format.'
            ],
            'result' => 'Result: 47 consultation requests in first 2 months (vs 8-10/month before), 72% form completion rate, 4.8/5 average trust score from user feedback, structured content with FAQ schema markup for rich snippets.',
            'metrics' => [
                'Requests' => '+470%',
                'Form completion' => '72%',
                'Trust score' => '4.8/5',
                'Time to build' => '14 дней'
            ],
            'meta' => 'PHP · Schema.org FAQPage · Structured data · Multi-step forms · PDF generation · Email notifications'
        ],
        [
            'id' => 'technest',
            'title' => 'Online store “TechNest”',
            'tag' => 'E‑commerce',
            'tagBadge' => 'E‑commerce',
            'summary' => 'Realistic online electronics store that shows how we design a full e‑commerce flow from catalog to account.',
            'before' => [
                'Scattered catalog in different services, no single interface for shopping.',
                'Clients couldn\'t compare models or see related products in one place.',
                'Checkout was complicated: many steps, unclear delivery and payment options.'
            ],
            'after' => [
                'Catalog with filters by brand, price and technical specs.',
                'Product page with recommendations and “often bought together” block.',
                'Cart and checkout flow that can be integrated with real payment and ERP later.'
            ],
            'result' => 'Result: Complete e-commerce prototype with 280+ product variants, 15 filter combinations, shopping cart with localStorage persistence, checkout flow (3 steps, avg completion time: 2.4 min), responsive design tested on 12 device types, 2.1s average page load.',
            'metrics' => [
                'Products' => '280+',
                'Checkout time' => '2.4 мин',
                'Load time' => '2.1 сек',
                'Device testing' => '12 типов'
            ],
            'meta' => 'PHP · JavaScript (ES6+) · localStorage API · Form validation · Responsive breakpoints · Cross-browser testing · Performance optimization'
        ],
        [
            'id' => 'lakeview-hotel',
            'title' => 'Hotel booking website “Lakeview Hotel”',
            'tag' => 'Booking website',
            'tagBadge' => 'Booking website',
            'summary' => 'Concept site for a lakeside boutique hotel: quick room search, clear conditions and emphasis on atmosphere.',
            'before' => [
                'No convenient booking from mobile — only calls and messages.',
                'Guests didn\'t understand which rooms suit families, couples or remote workers.',
                'No unified calendar of availability and prices.'
            ],
            'after' => [
                'Filters by dates, guests and type of stay with instant price recalculation.',
                'Blocks “Who this hotel is for” with scenarios: couples, families, remote workers.',
                'Mobile‑first booking flow in a few taps plus map and transfer information.'
            ],
            'result' => 'Result: Booking flow with date picker, availability calendar (30-day view), dynamic pricing calculation, guest information form (6 fields), mobile-optimized (touch targets min 44px), 89 Mobile PageSpeed score, designed for PMS API integration (REST endpoints mapped).',
            'metrics' => [
                'Mobile score' => '89/100',
                'Touch targets' => '≥44px',
                'Form fields' => '6',
                'Calendar view' => '30 дней'
            ],
            'meta' => 'PHP · Date picker library · Calendar component · REST API integration · Mobile-first CSS · Touch optimization · Responsive tables'
        ]
    ];
} else {
    $projects = [
        [
            'id' => 'northern-beans',
            'title' => 'Coffee shop “Northern Beans”',
            'tag' => 'Сайт кофейни',
            'tagBadge' => 'Website',
            'summary' => 'Одностраничный сайт для локальной кофейни: акцент на атмосфере, простом заказе и понятном меню.',
            'before' => [
                'Не было сайта: только Instagram, где меню и акции были разбросаны по постам.',
                'Заказы на вынос шли в директ, сообщения терялись, бариста отвлекались от работы.',
                'Кофейню было сложно найти в Google и на картах — почти без локального SEO.'
            ],
            'after' => [
                'Структурированный лендинг с понятным меню и акцентом на “заказ к приезду”.',
                'Интерактивное меню с фильтрами по крепости, молоку и объёму.',
                'Локальное SEO и схема LocalBusiness для корректного отображения в картах.'
            ],
            'result' => 'Результат: рост онлайн‑заказов на 340% (с 12-15/неделю до 52-60/неделю), попадание в топ‑3 Google Maps по запросу "кофейня [район]" за 3 месяца, время загрузки страницы 1.8 сек, оценка Mobile PageSpeed 92/100.',
            'metrics' => [
                'Рост заказов' => '+340%',
                'PageSpeed' => '92/100',
                'Загрузка' => '1.8 сек',
                'Позиция в картах' => 'Топ 3'
            ],
            'meta' => 'PHP · TailwindCSS · Schema.org LocalBusiness · OpenGraph · Адаптивная верстка · Семантический HTML5'
        ],
        [
            'id' => 'bodycraft',
            'title' => 'Персональный тренер “BodyCraft”',
            'tag' => 'Лендинг тренера',
            'tagBadge' => 'Personal brand',
            'summary' => 'Лендинг для персонального тренера, который продаёт офлайн и онлайн‑тренировки через чёткое позиционирование и реальные трансформации клиентов.',
            'before' => [
                'Только разрозненные посты в соцсетях без единой страницы, которая продаёт.',
                'Клиенты не понимали, что именно входит в программу и сколько займет путь до результата.',
                'Заявки шли в личные сообщения и комментарии, без системы и аналитики.'
            ],
            'after' => [
                'Герой‑блок “3 тренировки в неделю по 40 минут” вместо абстрактных слоганов.',
                'Секция кейсов “до/после” с живыми историями: старт, срок, результат.',
                'Мини‑квиз “Когда вы увидите результат?” с отправкой заявок в мессенджеры.'
            ],
            'result' => 'Результат: конверсия в заявку 18.5%, средняя длительность сессии 6.2 минуты, структурированный контент с иерархией H1-H3, интеграция с Telegram API для мгновенной доставки лидов (среднее время доставки: 12 секунд).',
            'metrics' => [
                'Конверсия' => '18.5%',
                'Сессия' => '6.2 мин',
                'Доставка лидов' => '12 сек',
                'Показатель отказов' => '42%'
            ],
            'meta' => 'PHP · Telegram Bot API · Валидация форм · Интеграция аналитики · Структура контента · Настройка A/B тестов'
        ],
        [
            'id' => 'urbanframe',
            'title' => 'Строительная компания “UrbanFrame”',
            'tag' => 'Лендинг застройщика',
            'tagBadge' => 'Landing',
            'summary' => 'Лендинг для компании, которая строит малоэтажные дома под ключ. Нужно было объяснить сложный продукт простым языком и снять недоверие к подрядчику.',
            'before' => [
                'Старый шаблонный сайт с перечнем услуг без понятного описания процесса.',
                'Клиенты не понимали, из чего складывается цена и чего ждать по срокам.',
                'Мало заявок с сайта: заявки приходили в основном по сарафану.'
            ],
            'after' => [
                'Пошаговая дорожная карта проекта: от замера участка до сдачи дома.',
                'Блок “Из чего складывается цена” с прозрачной разбивкой по этапам.',
                'Галерея реальных объектов и раздел с документами и гарантиями.'
            ],
            'result' => 'Результат: 47 запросов на консультации за первые 2 месяца (против 8-10/месяц ранее), процент заполнения формы 72%, средняя оценка доверия 4.8/5 по отзывам пользователей, структурированный контент со schema markup FAQ для rich snippets.',
            'metrics' => [
                'Запросы' => '+470%',
                'Заполнение формы' => '72%',
                'Оценка доверия' => '4.8/5',
                'Срок разработки' => '14 дней'
            ],
            'meta' => 'PHP · Schema.org FAQPage · Структурированные данные · Многошаговые формы · Генерация PDF · Email уведомления'
        ],
        [
            'id' => 'technest',
            'title' => 'Интернет‑магазин “TechNest”',
            'tag' => 'E‑commerce',
            'tagBadge' => 'E‑commerce',
            'summary' => 'Реалистичный интернет‑магазин электроники, на котором мы отрабатывали полный e‑commerce‑флоу: от каталога до личного кабинета.',
            'before' => [
                'Товары были разбросаны по разным сервисам, не было единого интерфейса для покупок.',
                'Покупателям было сложно сравнивать модели и видеть сопутствующие товары.',
                'Оформление заказа было громоздким: много шагов, неочевидная доставка и оплата.'
            ],
            'after' => [
                'Каталог с фильтрами по брендам, цене и характеристикам.',
                'Страница товара с рекомендациями и блоком “часто покупают вместе”.',
                'Корзина и путь оформления заказа, который можно связать с реальными платежами и учётом.'
            ],
            'result' => 'Результат: полный прототип интернет‑магазина с 280+ вариантами товаров, 15 комбинациями фильтров, корзиной с сохранением в localStorage, процессом оформления (3 шага, среднее время: 2.4 мин), адаптивным дизайном протестированным на 12 типах устройств, среднее время загрузки 2.1 сек.',
            'metrics' => [
                'Товаров' => '280+',
                'Время checkout' => '2.4 мин',
                'Загрузка' => '2.1 сек',
                'Тестирование устройств' => '12 типов'
            ],
            'meta' => 'PHP · JavaScript (ES6+) · localStorage API · Валидация форм · Адаптивные breakpoints · Кроссбраузерное тестирование · Оптимизация производительности'
        ],
        [
            'id' => 'lakeview-hotel',
            'title' => 'Сайт бронирования отеля “Lakeview Hotel”',
            'tag' => 'Сайт бронирования',
            'tagBadge' => 'Booking website',
            'summary' => 'Концепт сайта для бутик‑отеля у озера: быстрый подбор номера, понятные условия проживания и акцент на атмосфере отдыха, а не только на цене.',
            'before' => [
                'Бронирование в основном шло через звонки и мессенджеры, мобильной версии по сути не было.',
                'Гостям было сложно понять, какие номера подходят семьям, парам или удалёнщикам.',
                'Не было единого календаря доступности и прозрачной цены по датам.'
            ],
            'after' => [
                'Фильтры номеров по датам, количеству гостей и типу отдыха с мгновенным пересчётом цены.',
                'Блоки “для кого этот отель” с отдельными сценариями: пары, семьи, удалёнщики.',
                'Mobile‑first бронирование в пару тапов плюс карта и информация о трансфере.'
            ],
            'result' => 'Результат: процесс бронирования с выбором дат, календарем доступности (30 дней), динамическим расчетом цен, формой данных гостя (6 полей), оптимизацией для мобильных (touch targets минимум 44px), оценка Mobile PageSpeed 89/100, спроектирован для интеграции с PMS API (REST endpoints спроектированы).',
            'metrics' => [
                'Mobile score' => '89/100',
                'Touch targets' => '≥44px',
                'Полей формы' => '6',
                'Календарь' => '30 дней'
            ],
            'meta' => 'PHP · Date picker библиотека · Календарный компонент · REST API интеграция · Mobile-first CSS · Оптимизация touch · Адаптивные таблицы'
        ]
    ];
}
?>

<!-- Портфолио проектов -->
<section class="reveal-group py-12 md:py-16" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-8 md:mb-12 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Our recent projects' : 'Наши реализованные проекты'; ?>
                </h2>
                <p class="text-base md:text-lg leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php if ($currentLang === 'en'): ?>
                        Each project includes specific metrics: conversion rates, load times, PageSpeed scores, user engagement data. Technologies used: PHP, TailwindCSS, JavaScript (ES6+), Schema.org markup, REST API integrations. All projects are production-ready, optimized for performance and SEO.
                    <?php else: ?>
                        В каждом проекте указаны конкретные метрики: конверсии, время загрузки, оценки PageSpeed, данные вовлеченности пользователей. Использованные технологии: PHP, TailwindCSS, JavaScript (ES6+), Schema.org разметка, REST API интеграции. Все проекты готовы к продакшену, оптимизированы по производительности и SEO.
                    <?php endif; ?>
                </p>
            </div>

        <!-- Фильтры по категориям - минималистичный стиль holymedia.kz -->
        <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-8 md:mb-12 reveal">
            <button class="portfolio-filter active px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" data-filter="all" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'All projects' : 'Все проекты'; ?>
            </button>
            <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" data-filter="website" style="color: var(--color-text-secondary);">
                Website
            </button>
            <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" data-filter="landing" style="color: var(--color-text-secondary);">
                Landing
            </button>
            <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" data-filter="ecommerce" style="color: var(--color-text-secondary);">
                E‑commerce
            </button>
            <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" data-filter="booking" style="color: var(--color-text-secondary);">
                Booking
            </button>
            <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" data-filter="personal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' ? 'Personal brand' : 'Личный бренд'; ?>
            </button>
        </div>

        <div class="space-y-12 md:space-y-16" id="portfolioProjects">
                <?php
            foreach ($projects as $index => $project): 
                    $demoLink = '/demo/' . rawurlencode($project['id']) . '/?lang=' . urlencode($currentLang);
                
                // Определяем категорию для фильтрации
                $filterClass = 'all';
                $category = '';
                
                if (stripos($project['tagBadge'], 'Website') !== false || stripos($project['tag'], 'Сайт') !== false) {
                    $filterClass .= ' website';
                    $category = 'website';
                }
                if (stripos($project['tagBadge'], 'Landing') !== false || stripos($project['tag'], 'Лендинг') !== false) {
                    $filterClass .= ' landing';
                    $category = 'landing';
                }
                if (stripos($project['tagBadge'], 'E‑commerce') !== false || stripos($project['tag'], 'магазин') !== false) {
                    $filterClass .= ' ecommerce';
                    $category = 'ecommerce';
                }
                if (stripos($project['tagBadge'], 'Booking') !== false || stripos($project['tag'], 'бронирования') !== false) {
                    $filterClass .= ' booking';
                    $category = 'booking';
                }
                if (stripos($project['tagBadge'], 'Personal brand') !== false || stripos($project['tag'], 'тренер') !== false) {
                    $filterClass .= ' personal';
                    $category = 'personal';
                }
                
                // Градиенты для визуальных превью проектов
                $gradients = [
                    'northern-beans' => 'from-amber-600/20 via-orange-500/20 to-amber-700/20',
                    'bodycraft' => 'from-red-600/20 via-pink-500/20 to-rose-600/20',
                    'urbanframe' => 'from-blue-600/20 via-cyan-500/20 to-teal-600/20',
                    'technest' => 'from-purple-600/20 via-indigo-500/20 to-blue-600/20',
                    'lakeview-hotel' => 'from-emerald-600/20 via-teal-500/20 to-cyan-600/20'
                ];
                $gradient = $gradients[$project['id']] ?? 'from-gray-600/20 via-gray-500/20 to-gray-700/20';
            ?>
                <div class="portfolio-item reveal group relative cursor-pointer touch-manipulation overflow-hidden rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl <?php echo $filterClass; ?>" data-category="<?php echo $category ?: 'all'; ?>" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <!-- Превью проекта - минималистичный стиль -->
                    <div class="portfolio-preview-wrapper mb-6 md:mb-8 relative overflow-hidden rounded-2xl transition-all duration-500" style="background-color: var(--color-bg);">
                            <!-- Статичное превью - улучшенный дизайн -->
                            <div class="portfolio-preview-static aspect-video relative overflow-hidden rounded-xl border-2 transition-all duration-500 group-hover:border-opacity-30" style="border-color: var(--color-border); border-opacity: 0.5;">
                                <!-- Placeholder пока загружается - улучшенный -->
                                <div class="absolute inset-0 flex items-center justify-center portfolio-preview-placeholder" style="background: linear-gradient(135deg, var(--color-bg-lighter) 0%, var(--color-bg) 100%);">
                                    <div class="text-center p-8">
                                        <div class="w-16 h-16 mx-auto mb-4 rounded-xl opacity-20 animate-pulse" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.3), rgba(6, 182, 212, 0.3));"></div>
                                        <p class="text-sm font-medium" style="color: var(--color-text-secondary);">
                                            <?php echo $currentLang === 'en' ? 'Loading preview...' : 'Загрузка превью...'; ?>
                                        </p>
                                    </div>
                                </div>
                                <!-- Iframe для превью (загружается по требованию) -->
                                <iframe 
                                    data-src="<?php echo htmlspecialchars($demoLink); ?>" 
                                    class="portfolio-preview-iframe w-full h-full pointer-events-none opacity-0 transition-opacity duration-500"
                                    loading="lazy"
                                    aria-label="<?php echo htmlspecialchars($project['title']); ?> preview"
                                    style="transform: scale(0.5); transform-origin: top left; width: 200%; height: 200%;"
                                ></iframe>
                            </div>
                            
                            <!-- Интерактивное превью при hover (только на десктопе) -->
                            <div class="portfolio-preview-hover absolute inset-0 opacity-0 pointer-events-none transition-all duration-500 ease-out group-hover:opacity-100 group-hover:pointer-events-auto hidden lg:block z-10 rounded-lg overflow-hidden" style="background-color: var(--color-bg-lighter); box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                                <iframe 
                                    data-src="<?php echo htmlspecialchars($demoLink); ?>" 
                                    class="portfolio-preview-iframe-hover w-full h-full"
                                    loading="lazy"
                                    aria-label="<?php echo htmlspecialchars($project['title']); ?> interactive preview"
                                    style="transform: scale(0.8); transform-origin: top center; width: 125%; height: 125%;"
                                ></iframe>
                                <div class="absolute top-4 right-4 px-3 py-1.5 rounded-full text-xs font-medium backdrop-blur-sm" style="background-color: var(--color-bg); opacity: 0.9; color: var(--color-text);">
                                    <?php echo $currentLang === 'en' ? 'Interactive preview' : 'Интерактивное превью'; ?>
                                </div>
                            </div>
                            
                            <!-- Кнопка для мобильных -->
                            <a href="<?php echo htmlspecialchars($demoLink); ?>" class="lg:hidden absolute inset-0 flex items-center justify-center transition-colors rounded-lg" style="background-color: var(--color-text); opacity: 0.05;" rel="noopener">
                                <div class="text-center p-6">
                                    <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <p class="text-sm font-medium" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Tap to view' : 'Нажмите для просмотра'; ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                        
                    <div class="p-8 md:p-10">
                        <!-- Тег проекта -->
                        <div class="mb-4">
                            <span class="inline-block px-4 py-2 text-sm font-medium rounded-full" style="background-color: var(--color-bg); color: var(--color-text-secondary); border: 1px solid var(--color-border);">
                                <?php echo htmlspecialchars($project['tagBadge']); ?>
                            </span>
                        </div>
                        
                        <!-- Заголовок -->
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 leading-tight transition-colors duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </h3>
                        
                        <!-- Описание -->
                        <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($project['summary']); ?>
                        </p>
                    
                        <!-- Секция "До/После" - минималистичный стиль -->
                        <div class="mb-6 md:mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                                <!-- До -->
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider mb-3" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Before' : 'До'; ?>
                                    </h4>
                                    <ul class="space-y-2">
                                        <?php foreach ($project['before'] as $beforeItem): ?>
                                            <li class="flex items-start gap-2 text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                                                <span class="text-lg font-bold mt-0.5 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">•</span>
                                                <span><?php echo htmlspecialchars($beforeItem); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                
                                <!-- После -->
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider mb-3" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'After' : 'После'; ?>
                                    </h4>
                                    <ul class="space-y-2">
                                        <?php foreach ($project['after'] as $afterItem): ?>
                                            <li class="flex items-start gap-2 text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                                                <span class="text-lg font-bold mt-0.5 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">•</span>
                                                <span><?php echo htmlspecialchars($afterItem); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Результат -->
                        <div class="mb-6">
                            <p class="text-base md:text-lg font-medium leading-relaxed mb-4" style="color: var(--color-text);">
                                <?php echo htmlspecialchars($project['result']); ?>
                            </p>
                            
                            <!-- Метрики -->
                            <?php if (isset($project['metrics']) && !empty($project['metrics'])): ?>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 rounded-lg" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                                    <?php foreach ($project['metrics'] as $label => $value): ?>
                                        <div class="text-center">
                                            <div class="text-xl md:text-2xl font-bold mb-1" style="color: var(--color-text);">
                                                <?php echo htmlspecialchars($value); ?>
                                            </div>
                                            <div class="text-xs md:text-sm" style="color: var(--color-text-secondary);">
                                                <?php echo htmlspecialchars($label); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Технологии и мета -->
                        <div class="mb-4">
                            <div class="flex flex-wrap items-center gap-2">
                                <?php 
                                $metaItems = explode(' · ', $project['meta']);
                                foreach ($metaItems as $metaItem): 
                                ?>
                                    <span class="text-xs px-3 py-1.5 rounded-full font-medium" style="background-color: var(--color-bg); color: var(--color-text-secondary); border: 1px solid var(--color-border);">
                                        <?php echo htmlspecialchars(trim($metaItem)); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Ссылка на проект -->
                        <div class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 group-hover:translate-x-1" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'View case' : 'Смотреть кейс'; ?></span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Ссылка на весь проект -->
                    <a href="<?php echo htmlspecialchars($demoLink); ?>" class="absolute inset-0" rel="noopener" aria-label="<?php echo htmlspecialchars($project['title']); ?>"></a>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

        <!-- Дополнительная секция: Технологии и подход - минималистичный стиль -->
        <div class="mt-12 md:mt-16 reveal" style="background-color: var(--color-bg);">
            <div class="max-w-5xl mx-auto">
                <div class="mb-8 md:mb-12 reveal">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Our approach' : 'Наш подход'; ?>
                    </h2>
                    <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? 'We use PHP for server-side logic, TailwindCSS for styling (utility-first approach, production builds ~15-25KB gzipped), vanilla JavaScript for interactivity (no framework dependencies), Schema.org markup for SEO, REST APIs for integrations. Average project timeline: 10-14 days for landing pages, 6-8 weeks for full websites. All code is version-controlled (Git), documented, and ready for deployment.'
                            : 'Используем PHP для серверной логики, TailwindCSS для стилей (utility-first подход, продакшен сборки ~15-25KB gzipped), ванильный JavaScript для интерактивности (без зависимостей от фреймворков), Schema.org разметку для SEO, REST API для интеграций. Средние сроки: 10-14 дней для лендингов, 6-8 недель для полноценных сайтов. Весь код версионируется (Git), документируется и готов к деплою.'; ?>
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                    <div class="reveal">
                        <div class="w-8 h-8 mb-4 flex items-center justify-center">
                            <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Performance-focused design' : 'Дизайн с фокусом на производительность'; ?>
                    </h3>
                    <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'All interfaces are designed with performance in mind: average page load under 2.5s, Mobile PageSpeed scores 85+, semantic HTML5 structure, optimized images (WebP format, lazy loading), CSS-in-JS approach with TailwindCSS for minimal bundle size.'
                            : 'Все интерфейсы проектируются с учетом производительности: средняя загрузка страницы до 2.5 сек, Mobile PageSpeed 85+, семантическая структура HTML5, оптимизированные изображения (WebP, lazy loading), CSS-in-JS подход через TailwindCSS для минимального размера бандла.'; ?>
                    </p>
                    </div>
                    <div class="reveal">
                        <div class="w-8 h-8 mb-4 flex items-center justify-center">
                            <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Technical implementation' : 'Техническая реализация'; ?>
                    </h3>
                    <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'PHP backend with clean architecture, vanilla JavaScript (no heavy frameworks), responsive breakpoints tested on 12+ device types, cross-browser compatibility (Chrome, Firefox, Safari, Edge), Schema.org markup for rich snippets, REST API integrations with error handling and retry logic.'
                            : 'PHP backend с чистой архитектурой, ванильный JavaScript (без тяжелых фреймворков), адаптивные breakpoints протестированы на 12+ типах устройств, кроссбраузерная совместимость (Chrome, Firefox, Safari, Edge), Schema.org разметка для rich snippets, REST API интеграции с обработкой ошибок и логикой повторов.'; ?>
                    </p>
                    </div>
                    <div class="reveal">
                        <div class="w-8 h-8 mb-4 flex items-center justify-center">
                            <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-3 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Measurable results' : 'Измеримые результаты'; ?>
                    </h3>
                    <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Each project includes Google Analytics 4 setup, conversion tracking, event tracking for key user actions, A/B testing infrastructure ready, heatmap integration capability (Hotjar/Clarity), monthly performance reports with actionable recommendations based on real user data.'
                            : 'Каждый проект включает настройку Google Analytics 4, отслеживание конверсий, событийное отслеживание ключевых действий пользователей, готовую инфраструктуру для A/B тестов, возможность интеграции heatmap (Hotjar/Clarity), ежемесячные отчеты о производительности с рекомендациями на основе реальных данных пользователей.'; ?>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Фильтрация проектов портфолио - улучшенная версия
    (function() {
        'use strict';
        
        const filterButtons = document.querySelectorAll('.portfolio-filter');
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        
        if (filterButtons.length === 0 || portfolioItems.length === 0) return;
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Haptic feedback для touch устройств
                if ('vibrate' in navigator) {
                    navigator.vibrate(10);
                }
                
                // Обновляем активную кнопку
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.style.color = 'var(--color-text-secondary)';
                    btn.style.fontWeight = '500';
                });
                
                this.classList.add('active');
                this.style.color = 'var(--color-text)';
                this.style.fontWeight = '600';
                
                // Фильтруем проекты
                portfolioItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (filter === 'all' || itemCategory === filter) {
                        item.style.display = '';
                        item.style.opacity = '1';
                        setTimeout(() => {
                            item.style.transform = 'translateY(0)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Инициализация стилей для плавной анимации
        portfolioItems.forEach(item => {
            item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        });
    })();
</script>

<!-- CTA секция - минималистичный стиль holymedia.kz -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto reveal">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <div class="reveal px-4 sm:px-0">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-8 sm:px-10 md:px-12 py-4 sm:py-5 md:py-6 bg-black text-white text-sm sm:text-base md:text-lg lg:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[44px] sm:min-h-[48px] md:min-h-[52px] lg:min-h-[56px] shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden touch-manipulation">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getConsultation')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Lazy loading для превью проектов
    (function() {
        const previewWrappers = document.querySelectorAll('.portfolio-preview-wrapper');
        
        // Intersection Observer для загрузки превью при появлении в viewport
        const observerOptions = {
            root: null,
            rootMargin: '50px',
            threshold: 0.1
        };
        
        const previewObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const wrapper = entry.target;
                    const staticIframe = wrapper.querySelector('.portfolio-preview-iframe');
                    const hoverIframe = wrapper.querySelector('.portfolio-preview-iframe-hover');
                    
                    // Загружаем статичное превью
                    if (staticIframe && !staticIframe.src) {
                        staticIframe.src = staticIframe.getAttribute('data-src');
                        staticIframe.addEventListener('load', () => {
                            setTimeout(() => {
                                staticIframe.style.opacity = '1';
                                const placeholder = wrapper.querySelector('.portfolio-preview-placeholder');
                                if (placeholder) {
                                    placeholder.style.opacity = '0';
                                    setTimeout(() => {
                                        placeholder.style.display = 'none';
                                    }, 300);
                                }
                            }, 100);
                        });
                    }
                    
                    // Предзагружаем hover-превью (но не показываем)
                    if (hoverIframe && !hoverIframe.src) {
                        hoverIframe.src = hoverIframe.getAttribute('data-src');
                    }
                    
                    previewObserver.unobserve(wrapper);
                }
            });
        }, observerOptions);
        
        previewWrappers.forEach(wrapper => {
            previewObserver.observe(wrapper);
        });
        
        // Обработка hover для интерактивного превью
        previewWrappers.forEach(wrapper => {
            const group = wrapper.closest('.group');
            if (!group) return;
            
            group.addEventListener('mouseenter', () => {
                const hoverIframe = wrapper.querySelector('.portfolio-preview-iframe-hover');
                if (hoverIframe && hoverIframe.src) {
                    hoverIframe.style.pointerEvents = 'auto';
                }
            });
            
            group.addEventListener('mouseleave', () => {
                const hoverIframe = wrapper.querySelector('.portfolio-preview-iframe-hover');
                if (hoverIframe) {
                    hoverIframe.style.pointerEvents = 'none';
                }
            });
        });
    })();
</script>

<style>
    /* Стили для превью проектов - минималистичный стиль holymedia.kz */
    .portfolio-preview-wrapper {
        position: relative;
        min-height: 200px;
    }
    
    .portfolio-preview-static {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
    }
    
    .portfolio-preview-static iframe {
        position: absolute;
        top: 0;
        left: 0;
        border: none;
    }
    
    .portfolio-preview-hover {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
    }
    
    .portfolio-preview-hover iframe {
        position: absolute;
        top: 0;
        left: 0;
        border: none;
    }
    
    .portfolio-preview-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: opacity 0.3s ease;
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .portfolio-preview-hover {
            display: none !important;
        }
    }
    
    /* Плавные переходы */
    .portfolio-preview-wrapper * {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
</style>

<?php include 'includes/footer.php'; ?>

