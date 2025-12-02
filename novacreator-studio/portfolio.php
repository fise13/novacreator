<?php
/**
 * Страница портфолио
 * Пока пустая, так как мы только открылись
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
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.portfolio.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
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
                    class="service-card animate-on-scroll text-left w-full portfolio-card"
                    data-project-id="<?php echo htmlspecialchars($project['id']); ?>"
                    data-title="<?php echo htmlspecialchars($project['title']); ?>"
                    data-tag="<?php echo htmlspecialchars($project['tag']); ?>"
                    data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
                    data-before="<?php echo htmlspecialchars(implode('||', $project['before'])); ?>"
                    data-after="<?php echo htmlspecialchars(implode('||', $project['after'])); ?>"
                    data-result="<?php echo htmlspecialchars($project['result']); ?>"
                    data-meta="<?php echo htmlspecialchars($project['meta']); ?>"
                >
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
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-10">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <h3 id="caseTitle" class="text-2xl md:text-3xl font-bold text-gradient mb-2"></h3>
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

