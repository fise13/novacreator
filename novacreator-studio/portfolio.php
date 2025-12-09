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

<!-- Hero секция - минималистичный стиль holymedia.kz с мобильной адаптацией -->
<section class="relative overflow-hidden pt-20 md:pt-24 lg:pt-32 pb-12 md:pb-16 lg:pb-20" style="background-color: var(--color-bg);">
    <!-- Фоновые акценты -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 md:w-96 md:h-96 lg:w-[32rem] lg:h-[32rem] rounded-full blur-3xl opacity-10 md:opacity-20 animate-pulse parallax" data-speed="0.3" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); animation-duration: 4s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 md:w-96 md:h-96 lg:w-[32rem] lg:h-[32rem] rounded-full blur-3xl opacity-10 md:opacity-20 animate-pulse parallax" data-speed="0.5" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation-delay: 1.5s; animation-duration: 5s;"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center md:text-left">
            <div class="animate-on-scroll">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extrabold mb-6 md:mb-8 lg:mb-12 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.portfolio.title')); ?>
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl mb-8 md:mb-12 leading-relaxed mx-auto md:mx-0" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?>
                </p>
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
            <p class="text-lg md:text-xl text-gray-400 leading-relaxed mb-3">
                <?php if ($currentLang === 'en'): ?>
                    Clients don’t care whether a brand is world‑famous — they care about how clearly the website explains
                    the offer and what changes “before / after” it brings to their business.
                <?php else: ?>
                    Клиентам важнее не громкое имя, а то, насколько аккуратно сайт объясняет оффер и какие изменения
                    “до / после” он приносит в бизнес.
                <?php endif; ?>
            </p>
            <p class="text-sm md:text-base text-gray-500">
                <?php if ($currentLang === 'en'): ?>
                    All projects on this page are demonstration concepts created to showcase our approach to structure, UX and design. They are not based on real client data.
                <?php else: ?>
                    Все проекты на этой странице — демонстрационные концепты, созданные, чтобы показать наш подход к структуре, UX и дизайну. Они не основаны на данных реальных клиентов.
                <?php endif; ?>
            </p>
        </div>

        <!-- Статистика портфолио - мобильная адаптация -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mb-12 md:mb-16 animate-on-scroll">
            <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-6 text-center group hover:border-neon-purple/50 transition-all duration-300">
                <div class="text-4xl md:text-5xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="50" data-suffix="+">0</span>
                </div>
                <div class="text-sm md:text-base text-gray-400">
                    <?php echo $currentLang === 'en' ? 'Projects delivered' : 'Реализовано проектов'; ?>
                </div>
            </div>
            <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-6 text-center group hover:border-neon-blue/50 transition-all duration-300">
                <div class="text-4xl md:text-5xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="95" data-suffix="%">0</span>
                </div>
                <div class="text-sm md:text-base text-gray-400">
                    <?php echo $currentLang === 'en' ? 'Client satisfaction' : 'Довольных клиентов'; ?>
                </div>
            </div>
            <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-6 text-center group hover:border-neon-purple/50 transition-all duration-300">
                <div class="text-4xl md:text-5xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="3" data-suffix="x">0</span>
                </div>
                <div class="text-sm md:text-base text-gray-400">
                    <?php echo $currentLang === 'en' ? 'Average conversion growth' : 'Рост конверсии в среднем'; ?>
                </div>
            </div>
            <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-6 text-center group hover:border-neon-blue/50 transition-all duration-300">
                <div class="text-4xl md:text-5xl font-bold text-gradient mb-2">
                    <span class="counter-number" data-target="24" data-suffix="/7">0</span>
                </div>
                <div class="text-sm md:text-base text-gray-400">
                    <?php echo $currentLang === 'en' ? 'Support available' : 'Поддержка доступна'; ?>
                </div>
            </div>
        </div>

        <div class="space-y-12 md:space-y-16 lg:space-y-20">
            <?php foreach ($projects as $index => $project): ?>
                <?php
                    $demoLink = '/demo/' . rawurlencode($project['id']) . '/?lang=' . urlencode($currentLang);
                ?>
                <div class="animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <div class="mb-6">
                        <span class="text-xs sm:text-sm uppercase tracking-wider mb-3 md:mb-4 block" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($project['tagBadge']); ?>
                        </span>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 md:mb-6 leading-tight" style="color: var(--color-text);">
                            <a href="<?php echo htmlspecialchars($demoLink); ?>" class="hover:underline transition-all" rel="noopener">
                                <?php echo htmlspecialchars($project['title']); ?>
                            </a>
                        </h3>
                        <p class="text-base sm:text-lg md:text-xl mb-4 md:mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                            <?php echo htmlspecialchars($project['summary']); ?>
                        </p>
                        <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                            <?php echo htmlspecialchars($project['result']); ?>
                        </p>
                        <a href="<?php echo htmlspecialchars($demoLink); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-semibold hover:gap-4 transition-all min-h-[44px] touch-manipulation" style="color: var(--color-text);" rel="noopener">
                            <?php echo $currentLang === 'en' ? 'View project' : 'Посмотреть проект'; ?>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

        <!-- Дополнительная секция: Технологии и подход с мобильной адаптацией -->
        <div class="mt-12 md:mt-16 lg:mt-20 animate-on-scroll">
            <div class="max-w-4xl mx-auto text-center mb-8 md:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 md:mb-4 text-gradient">
                    <?php echo $currentLang === 'en' ? 'Our approach' : 'Наш подход'; ?>
                </h2>
                <p class="text-base sm:text-lg text-gray-400 leading-relaxed px-2">
                    <?php echo $currentLang === 'en' 
                        ? 'We combine modern design, proven UX patterns and technical excellence to create websites that convert visitors into customers.'
                        : 'Мы сочетаем современный дизайн, проверенные UX-паттерны и техническое совершенство, чтобы создавать сайты, которые превращают посетителей в клиентов.'; ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-8 hover:border-neon-purple/50 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">
                        <?php echo $currentLang === 'en' ? 'Design first' : 'Дизайн прежде всего'; ?>
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo $currentLang === 'en'
                            ? 'Every pixel matters. We create interfaces that are not only beautiful but also intuitive and conversion-focused.'
                            : 'Каждый пиксель важен. Мы создаём интерфейсы, которые не только красивы, но и интуитивны и ориентированы на конверсию.'; ?>
                    </p>
                </div>
                <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-8 hover:border-neon-blue/50 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">
                        <?php echo $currentLang === 'en' ? 'Performance' : 'Производительность'; ?>
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo $currentLang === 'en'
                            ? 'Fast loading, optimized images, clean code. Your site will rank better and convert more visitors.'
                            : 'Быстрая загрузка, оптимизированные изображения, чистый код. Ваш сайт будет лучше ранжироваться и конвертировать больше посетителей.'; ?>
                    </p>
                </div>
                <div class="bg-gradient-to-br from-dark-surface to-dark-bg border border-dark-border/50 rounded-2xl p-8 hover:border-neon-purple/50 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">
                        <?php echo $currentLang === 'en' ? 'Data-driven' : 'На основе данных'; ?>
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        <?php echo $currentLang === 'en'
                            ? 'We analyze user behavior, test hypotheses and continuously improve conversion rates based on real metrics.'
                            : 'Мы анализируем поведение пользователей, тестируем гипотезы и постоянно улучшаем конверсию на основе реальных метрик.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Анимация появления элементов при скролле
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Анимация счетчиков
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const suffix = element.getAttribute('data-suffix') || '';
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + suffix;
                }
            }, 16);
        }

        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target.querySelector('.counter-number');
                    if (counter && !counter.classList.contains('counted')) {
                        counter.classList.add('counted');
                        animateCounter(counter);
                    }
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.counter-number').forEach(counter => {
            counterObserver.observe(counter.closest('div'));
        });
    });
</script>

<!-- CTA секция - улучшенный дизайн с мобильной адаптацией -->
<section class="py-16 md:py-24 lg:py-32 relative overflow-hidden">
    <!-- Фоновые градиенты -->
    <div class="absolute inset-0 bg-gradient-to-br from-neon-purple/30 via-neon-purple/20 to-neon-blue/30"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(139,92,246,0.3),transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(6,182,212,0.3),transparent_50%)]"></div>
    
    <!-- Декоративные элементы -->
    <div class="absolute top-0 left-1/4 w-64 h-64 md:w-96 md:h-96 bg-neon-purple/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-64 h-64 md:w-96 md:h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6 md:mb-8">
                <span class="text-xs uppercase tracking-wider text-gray-200">
                    <?php echo $currentLang === 'en' ? 'Ready to Start Your Project?' : 'Готовы начать проект?'; ?>
                </span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 md:mb-6 lg:mb-8 text-white">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-200 mb-8 md:mb-10 lg:mb-12 leading-relaxed px-2">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block w-full sm:w-auto min-h-[48px] sm:min-h-[56px] px-8 md:px-10 text-base sm:text-lg md:text-xl shadow-2xl shadow-neon-purple/50 group relative overflow-hidden touch-manipulation">
                <span class="relative z-10"><?php echo htmlspecialchars(t('pages.portfolio.cta.button')); ?></span>
                <span class="absolute inset-0 bg-gradient-to-r from-neon-blue to-neon-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

