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

<!-- Hero секция -->
<section class="relative overflow-hidden pt-32 pb-20">
    <!-- Фоновые акценты -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-16 w-64 h-64 md:w-96 md:h-96 bg-neon-purple/20 rounded-full blur-3xl md:blur-2xl"></div>
        <div class="absolute top-1/3 -right-10 w-72 h-72 md:w-[26rem] md:h-[26rem] bg-neon-blue/20 rounded-full blur-3xl md:blur-2xl"></div>
        <div class="floating-particles" id="portfolioParticles"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div class="animate-on-scroll">
                <p class="text-xs uppercase tracking-[0.22em] text-gray-500 mb-4">
                    <?php echo $currentLang === 'en' ? 'Case studies & concepts' : 'Кейсы и концепты'; ?>
                </p>
                <h1 class="section-title mb-4">
                    <?php echo htmlspecialchars(t('pages.portfolio.title')); ?>
                </h1>
                <p class="section-subtitle mb-8 md:mb-10 px-0">
                    <?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?>
                </p>
                <div class="flex flex-wrap items-center gap-4 md:gap-6">
                    <div class="gradient-border rounded-xl px-4 py-3 md:px-5 md:py-4 bg-dark-surface/80">
                        <div class="text-sm uppercase tracking-wide text-gray-400 mb-1">
                            <?php echo $currentLang === 'en' ? 'Experience' : 'Опыт'; ?>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl md:text-4xl font-bold text-gradient">
                                <span class="counter-number" data-target="10" data-suffix="+">10+</span>
                            </span>
                            <span class="text-sm text-gray-400">
                                <?php echo $currentLang === 'en' ? 'years in digital' : 'лет в диджитал-среде'; ?>
                            </span>
                        </div>
                    </div>
                    <div class="rounded-xl border border-dark-border bg-dark-surface/70 px-4 py-3 md:px-5 md:py-4 flex-1 min-w-[220px]">
                        <div class="text-sm uppercase tracking-wide text-gray-400 mb-1">
                            <?php echo $currentLang === 'en' ? 'Formats' : 'Форматы'; ?>
                        </div>
                        <p class="text-sm md:text-base text-gray-300 leading-relaxed">
                            <?php if ($currentLang === 'en'): ?>
                                Landing pages, e‑commerce, booking systems and local businesses — from first wireframe to measurable growth.
                            <?php else: ?>
                                Лендинги, интернет‑магазины, сайты бронирования и локальный бизнес — от первого вайрфрейма до измеримого роста.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Визуальная витрина портфолио -->
            <div class="animate-on-scroll lg:justify-self-end">
                <div class="relative w-full max-w-md lg:max-w-lg mx-auto">
                    <!-- Основной макет -->
                    <div class="relative rounded-2xl bg-gradient-to-br from-neon-purple/20 via-dark-surface to-neon-blue/20 border border-dark-border/80 shadow-2xl overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-dark-border/80 bg-dark-bg/80">
                            <div class="flex items-center space-x-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500/80"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-yellow-400/80"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-green-500/80"></span>
                            </div>
                            <span class="text-xs text-gray-400 truncate max-w-[140px] md:max-w-[200px]">
                                <?php echo $currentLang === 'en' ? 'concept-landing.novacreator-studio.com' : 'concept-landing.novacreator-studio.com'; ?>
                            </span>
                        </div>
                        <div class="aspect-[16/10] bg-gradient-to-br from-dark-bg via-[#111827] to-dark-surface relative overflow-hidden">
                            <div class="absolute inset-0 opacity-80 mix-blend-screen pointer-events-none">
                                <div class="absolute -left-10 top-8 w-40 h-40 rounded-full bg-neon-purple/40 blur-3xl"></div>
                                <div class="absolute right-0 bottom-0 w-56 h-56 rounded-full bg-neon-blue/40 blur-3xl"></div>
                            </div>
                            <div class="relative h-full w-full flex items-center justify-center">
                                <div class="text-center px-6">
                                    <p class="text-[11px] uppercase tracking-[0.25em] text-gray-500 mb-3">
                                        <?php echo $currentLang === 'en' ? 'Portfolio preview' : 'Превью портфолио'; ?>
                                    </p>
                                    <p class="text-2xl md:text-3xl font-semibold text-gradient mb-2">
                                        <?php echo $currentLang === 'en'
                                            ? 'Real businesses. Clear “before / after”.'
                                            : 'Реальный бизнес. Понятное “до / после”.'; ?>
                                    </p>
                                    <p class="text-xs md:text-sm text-gray-300 max-w-sm mx-auto leading-relaxed">
                                        <?php echo $currentLang === 'en'
                                            ? 'Scroll down to see how websites change numbers, not just layouts.'
                                            : 'Листайте ниже, чтобы увидеть, как дизайн меняет цифры, а не только макеты.'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Маленькие карточки типов проектов -->
                    <div class="absolute -bottom-6 -left-2 w-36 md:w-40 bg-dark-bg/95 border border-dark-border rounded-xl p-3 shadow-lg backdrop-blur">
                        <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                            <?php echo $currentLang === 'en' ? 'Formats' : 'Форматы'; ?>
                        </p>
                        <p class="text-xs text-gray-300">
                            <?php echo $currentLang === 'en'
                                ? 'Coffee shops, trainers, developers, hotels, e‑commerce.'
                                : 'Кофейни, тренеры, застройщики, отели, e‑commerce.'; ?>
                        </p>
                    </div>
                    <div class="absolute -top-6 -right-4 w-32 md:w-40 bg-dark-bg/95 border border-dark-border rounded-xl p-3 shadow-lg backdrop-blur text-right">
                        <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                            <?php echo $currentLang === 'en' ? 'Focus' : 'Фокус'; ?>
                        </p>
                        <p class="text-xs text-gray-300">
                            <?php echo $currentLang === 'en'
                                ? 'From structure and UX to measurable conversions.'
                                : 'От структуры и UX до измеримых конверсий.'; ?>
                        </p>
                    </div>
                </div>
            </div>
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
            'result' => 'Result: steady growth in takeaway orders and awareness in the neighborhood.',
            'meta' => 'UX / UI · Responsive · Local SEO'
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
            'result' => 'Result: predictable flow of applications from ads and organic traffic into one landing page.',
            'meta' => 'Landing · Content structure · Leads'
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
            'result' => 'Result: more consultation requests and noticeably higher trust to the contractor.',
            'meta' => 'Structure · Trust blocks · Lead forms'
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
            'result' => 'Result: ready UX‑prototype of a store that can be quickly adapted to a real client backend.',
            'meta' => 'Store UX · Catalog · Checkout'
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
            'result' => 'Result: clear booking flow that can be directly connected to a real PMS.',
            'meta' => 'Booking flow · Mobile‑first · Storytelling'
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
            'result' => 'Результат: заметный рост онлайн‑заказов на вынос и узнаваемости в районе.',
            'meta' => 'UX / UI · Адаптив · Local SEO'
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
            'result' => 'Результат: стабильный поток заявок из органики и рекламы в один понятный лендинг.',
            'meta' => 'Лендинг · Контент‑структура · Лиды'
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
            'result' => 'Результат: рост запросов на консультации и ощутимое повышение доверия к бренду.',
            'meta' => 'Структура · Trust‑блоки · Lead‑формы'
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
            'result' => 'Результат: готовый UX‑каркас магазина, который можно быстро адаптировать под реального заказчика.',
            'meta' => 'UX магазина · Каталог · Checkout'
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
            'result' => 'Результат: прозрачный сценарий бронирования, который можно напрямую связать с PMS отеля.',
            'meta' => 'Booking‑флоу · Mobile‑first · Storytelling'
        ]
    ];
}
?>

<!-- Портфолио проектов -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-12 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gradient">
                <?php echo $currentLang === 'en' ? 'Our recent projects' : 'Наши реализованные проекты'; ?>
            </h2>
            <p class="text-lg md:text-xl text-gray-400 leading-relaxed">
                <?php if ($currentLang === 'en'): ?>
                    Clients don’t care whether a brand is world‑famous — they care about how clearly the website explains
                    the offer and what changes “before / after” it brings to their business.
                <?php else: ?>
                    Клиентам важнее не громкое имя, а то, насколько аккуратно сайт объясняет оффер и какие изменения
                    “до / после” он приносит в бизнес.
                <?php endif; ?>
            </p>
        </div>

        <div class="grid gap-8 md:gap-10 md:grid-cols-2">
            <?php foreach ($projects as $project): ?>
                <button
                    type="button"
                    class="service-card animate-on-scroll text-left w-full portfolio-card group"
                    data-project-id="<?php echo htmlspecialchars($project['id']); ?>"
                    data-title="<?php echo htmlspecialchars($project['title']); ?>"
                    data-tag="<?php echo htmlspecialchars($project['tag']); ?>"
                    data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
                    data-before="<?php echo htmlspecialchars(implode('||', $project['before'])); ?>"
                    data-after="<?php echo htmlspecialchars(implode('||', $project['after'])); ?>"
                    data-result="<?php echo htmlspecialchars($project['result']); ?>"
                    data-meta="<?php echo htmlspecialchars($project['meta']); ?>"
                >
                    <!-- Визуальный превью-блок проекта -->
                    <div class="mb-4 relative overflow-hidden rounded-xl border border-dark-border/80 bg-gradient-to-br from-dark-bg via-[#050816] to-dark-surface">
                        <div class="aspect-[16/10] relative">
                            <div class="absolute inset-0 opacity-70 mix-blend-screen pointer-events-none">
                                <div class="absolute -left-8 top-4 w-32 h-32 rounded-full bg-neon-purple/40 blur-3xl"></div>
                                <div class="absolute right-0 bottom-0 w-40 h-40 rounded-full bg-neon-blue/40 blur-3xl"></div>
                            </div>
                            <div class="relative h-full w-full flex flex-col justify-between p-4">
                                <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                                    <span class="inline-flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-neon-purple animate-pulse"></span>
                                        <?php echo htmlspecialchars($project['tag']); ?>
                                    </span>
                                    <span class="rounded-full border border-dark-border/80 bg-dark-bg/60 px-2 py-0.5 text-[11px] uppercase tracking-wide">
                                        <?php echo $currentLang === 'en' ? 'Concept' : 'Концепт'; ?>
                                    </span>
                                </div>
                                <div class="mt-auto">
                                    <p class="text-sm text-gray-300 line-clamp-3">
                                        <?php echo htmlspecialchars($project['summary']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-center justify-center text-center px-4">
                            <p class="text-xs md:text-sm text-gray-200">
                                <?php echo $currentLang === 'en'
                                    ? 'Click to open detailed “before / after” story of this project.'
                                    : 'Нажмите, чтобы открыть подробную историю “до / после” по этому проекту.'; ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-2xl font-semibold text-gradient">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </h3>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-neon-purple/10 border border-neon-purple/50 text-neon-purple">
                            <?php echo htmlspecialchars($project['tagBadge']); ?>
                        </span>
                    </div>
                    <p class="text-gray-300 mb-4">
                        <?php echo htmlspecialchars($project['summary']); ?>
                    </p>
                    <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                        <span class="text-gray-400 truncate">
                            <?php echo htmlspecialchars($project['result']); ?>
                        </span>
                        <span class="text-neon-blue text-xs uppercase tracking-wide">
                            <?php echo htmlspecialchars($project['meta']); ?>
                        </span>
                    </div>
                    <div class="mt-4 text-sm text-neon-blue flex items-center gap-2">
                        <span>
                            <?php echo $currentLang === 'en' ? 'View before / after' : 'Посмотреть “до / после”'; ?>
                        </span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Детальный кейс: до / после -->
        <div id="portfolioCaseDetails" class="max-w-5xl mx-auto mt-16 hidden animate-on-scroll">
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-10 gradient-border">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-gray-500 mb-2">
                            <?php echo $currentLang === 'en' ? 'Case study' : 'Кейс'; ?>
                        </p>
                        <h3 id="caseTitle" class="text-2xl md:text-3xl font-bold text-gradient mb-1"></h3>
                        <p id="caseTag" class="text-sm text-gray-400"></p>
                    </div>
                    <span id="caseMeta" class="px-3 py-1 text-xs font-medium rounded-full bg-neon-blue/20 border border-neon-blue/30 text-neon-blue whitespace-nowrap">
                    </span>
                </div>

                <p id="caseSummary" class="text-gray-300 mb-6"></p>

                <div class="grid gap-6 md:grid-cols-2 mb-6 text-sm text-gray-200">
                    <div>
                        <h4 class="text-base md:text-lg font-semibold mb-3">
                            <?php echo $currentLang === 'en' ? 'Before:' : 'До:'; ?>
                        </h4>
                        <ul id="caseBefore" class="space-y-2 list-disc list-inside text-gray-300"></ul>
                    </div>
                    <div>
                        <h4 class="text-base md:text-lg font-semibold mb-3">
                            <?php echo $currentLang === 'en' ? 'After:' : 'После:'; ?>
                        </h4>
                        <ul id="caseAfter" class="space-y-2 list-disc list-inside text-gray-300"></ul>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <p id="caseResult" class="text-sm md:text-base text-gray-300"></p>
                    <button
                        type="button"
                        id="caseCloseBtn"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg border border-dark-border text-gray-300 hover:bg-dark-bg/60 transition-colors"
                    >
                        <?php echo $currentLang === 'en' ? 'Hide case' : 'Скрыть кейс'; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.portfolio-card');
        const details = document.getElementById('portfolioCaseDetails');
        const titleEl = document.getElementById('caseTitle');
        const tagEl = document.getElementById('caseTag');
        const summaryEl = document.getElementById('caseSummary');
        const beforeEl = document.getElementById('caseBefore');
        const afterEl = document.getElementById('caseAfter');
        const resultEl = document.getElementById('caseResult');
        const metaEl = document.getElementById('caseMeta');
        const closeBtn = document.getElementById('caseCloseBtn');
        const particlesContainer = document.getElementById('portfolioParticles');

        function openCase(card) {
            const title = card.getAttribute('data-title') || '';
            const tag = card.getAttribute('data-tag') || '';
            const summary = card.getAttribute('data-summary') || '';
            const beforeRaw = card.getAttribute('data-before') || '';
            const afterRaw = card.getAttribute('data-after') || '';
            const result = card.getAttribute('data-result') || '';
            const meta = card.getAttribute('data-meta') || '';

            titleEl.textContent = title;
            tagEl.textContent = tag;
            summaryEl.textContent = summary;
            resultEl.textContent = result;
            metaEl.textContent = meta;

            beforeEl.innerHTML = '';
            afterEl.innerHTML = '';

            beforeRaw.split('||').forEach(function (item) {
                const trimmed = item.trim();
                if (!trimmed) return;
                const li = document.createElement('li');
                li.textContent = trimmed;
                beforeEl.appendChild(li);
            });

            afterRaw.split('||').forEach(function (item) {
                const trimmed = item.trim();
                if (!trimmed) return;
                const li = document.createElement('li');
                li.textContent = trimmed;
                afterEl.appendChild(li);
            });

            details.classList.remove('hidden');

            details.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        cards.forEach(function (card) {
            card.addEventListener('click', function () {
                openCase(card);
            });
        });

        if (closeBtn && details) {
            closeBtn.addEventListener('click', function () {
                details.classList.add('hidden');
            });
        }

        // Плавающие частицы в hero-блоке портфолио (облегчённая версия)
        if (particlesContainer) {
            const isMobile = window.innerWidth < 768;
            const particleCount = isMobile ? 10 : 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const sizeClass = Math.random() < 0.5 ? 'particle-small' : 'particle-medium';
                particle.classList.add(sizeClass);

                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = (Math.random() * 5) + 's';

                particlesContainer.appendChild(particle);
            }
        }
    });
</script>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.button')); ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

