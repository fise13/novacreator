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

<!-- Hero секция - Apple минималистичный дизайн на весь экран -->
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
<section class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции - в стиле остального сайта -->
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Our recent projects' : 'Наши реализованные проекты'; ?>
            </h2>
                <p class="text-lg sm:text-xl md:text-2xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                <?php if ($currentLang === 'en'): ?>
                        Clients don't care whether a brand is world‑famous — they care about how clearly the website explains
                        the offer and what changes "before / after" it brings to their business.
                <?php else: ?>
                    Клиентам важнее не громкое имя, а то, насколько аккуратно сайт объясняет оффер и какие изменения
                        "до / после" он приносит в бизнес.
                <?php endif; ?>
            </p>
                <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary); opacity: 0.7;">
                <?php if ($currentLang === 'en'): ?>
                    All projects on this page are demonstration concepts created to showcase our approach to structure, UX and design. They are not based on real client data.
                <?php else: ?>
                    Все проекты на этой странице — демонстрационные концепты, созданные, чтобы показать наш подход к структуре, UX и дизайну. Они не основаны на данных реальных клиентов.
                <?php endif; ?>
            </p>
        </div>

        <!-- Статистика портфолио - минималистичный стиль -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 lg:gap-16 mb-16 md:mb-20 lg:mb-24 reveal">
            <div class="text-center">
                <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-semibold mb-4 leading-none tracking-tighter" style="color: var(--color-text);">
                    <span class="counter-number inline-block" data-target="50" data-suffix="+">0</span>
                </div>
                <p class="text-base sm:text-lg md:text-xl font-light" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Projects delivered' : 'Реализовано проектов'; ?>
                </p>
            </div>
            <div class="text-center">
                <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-semibold mb-4 leading-none tracking-tighter" style="color: var(--color-text);">
                    <span class="counter-number inline-block" data-target="95" data-suffix="%">0</span>
                </div>
                <p class="text-base sm:text-lg md:text-xl font-light" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Client satisfaction' : 'Довольных клиентов'; ?>
                </p>
            </div>
            <div class="text-center">
                <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-semibold mb-4 leading-none tracking-tighter" style="color: var(--color-text);">
                    <span class="counter-number inline-block" data-target="3" data-suffix="x">0</span>
                </div>
                <p class="text-base sm:text-lg md:text-xl font-light" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Average conversion growth' : 'Рост конверсии в среднем'; ?>
                </p>
            </div>
            <div class="text-center">
                <div class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-semibold mb-4 leading-none tracking-tighter" style="color: var(--color-text);">
                    <span class="counter-number inline-block" data-target="24" data-suffix="/7">0</span>
                </div>
                <p class="text-base sm:text-lg md:text-xl font-light" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Support available' : 'Поддержка доступна'; ?>
                </p>
            </div>
        </div>

        <!-- Фильтры по категориям - минималистичный стиль -->
        <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 mb-16 md:mb-20 lg:mb-24 reveal">
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

        <div class="space-y-16 md:space-y-20 lg:space-y-24 xl:space-y-32" id="portfolioProjects">
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
                <div class="portfolio-item portfolio-item-3d reveal <?php echo $filterClass; ?>" data-category="<?php echo $category ?: 'all'; ?>">
                    <!-- Карточка проекта - минималистичный стиль -->
                    <div class="group relative cursor-pointer touch-manipulation">
                        <!-- Превью-скриншот проекта с hover-эффектом -->
                        <div class="portfolio-preview-wrapper mb-8 md:mb-10 relative overflow-hidden rounded-lg" style="background-color: var(--color-bg-lighter);">
                            <!-- Статичное превью -->
                            <div class="portfolio-preview-static aspect-video relative overflow-hidden rounded-lg border" style="border-color: var(--color-text); opacity: 0.1;">
                                <!-- Placeholder пока загружается -->
                                <div class="absolute inset-0 flex items-center justify-center portfolio-preview-placeholder" style="background: linear-gradient(135deg, var(--color-bg-lighter) 0%, var(--color-bg) 100%);">
                                    <div class="text-center p-8">
                                        <div class="w-16 h-16 mx-auto mb-4 rounded-lg opacity-20" style="background-color: var(--color-text);"></div>
                                        <p class="text-sm font-medium" style="color: var(--color-text-secondary);">
                                            <?php echo $currentLang === 'en' ? 'Project preview' : 'Превью проекта'; ?>
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
                        
                        <!-- Заголовок и категория -->
                        <div class="mb-6 md:mb-8">
                            <div class="mb-3 md:mb-4">
                                <span class="text-xs sm:text-sm uppercase tracking-wider font-medium transition-opacity duration-200 group-hover:opacity-70" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($project['tagBadge']); ?>
                        </span>
                            </div>
                            <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-semibold mb-4 md:mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                                <a href="<?php echo htmlspecialchars($demoLink); ?>" class="hover:underline" rel="noopener">
                                <?php echo htmlspecialchars($project['title']); ?>
                            </a>
                        </h3>
                            <p class="text-lg sm:text-xl md:text-2xl mb-6 md:mb-8 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                            <?php echo htmlspecialchars($project['summary']); ?>
                        </p>
                        </div>
                        
                        <!-- Секция "До/После" - упрощенная -->
                        <div class="mb-8 md:mb-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16">
                                <!-- До -->
                                <div>
                                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-4" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Before' : 'До'; ?>
                                    </h4>
                                    <ul class="space-y-3">
                                        <?php foreach ($project['before'] as $beforeItem): ?>
                                            <li class="flex items-start gap-3 text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                                                <span class="text-xl font-bold mt-0.5 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">•</span>
                                                <span><?php echo htmlspecialchars($beforeItem); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                
                                <!-- После -->
                                <div>
                                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-4" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'After' : 'После'; ?>
                                    </h4>
                                    <ul class="space-y-3">
                                        <?php foreach ($project['after'] as $afterItem): ?>
                                            <li class="flex items-start gap-3 text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                                                <span class="text-xl font-bold mt-0.5 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">•</span>
                                                <span><?php echo htmlspecialchars($afterItem); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Результат -->
                        <div class="mb-6 md:mb-8">
                            <p class="text-base sm:text-lg md:text-xl font-medium leading-relaxed" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($project['result']); ?>
                        </p>
                        </div>
                        
                        <!-- Технологии и мета - упрощенные -->
                        <div class="mb-6 md:mb-8">
                            <div class="flex flex-wrap items-center gap-4">
                                <?php 
                                $metaItems = explode(' · ', $project['meta']);
                                foreach ($metaItems as $metaItem): 
                                ?>
                                    <span class="text-sm md:text-base font-medium" style="color: var(--color-text-secondary);">
                                        <?php echo htmlspecialchars(trim($metaItem)); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Ссылка на проект -->
                        <a href="<?php echo htmlspecialchars($demoLink); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px] touch-manipulation" style="color: var(--color-text);" rel="noopener">
                            <?php echo $currentLang === 'en' ? 'View project' : 'Посмотреть проект'; ?>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

        <!-- Дополнительная секция: Технологии и подход - минималистичный стиль -->
        <div class="mt-16 md:mt-20 lg:mt-32 reveal" style="background-color: var(--color-bg);">
            <div class="max-w-7xl mx-auto">
                <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Our approach' : 'Наш подход'; ?>
                </h2>
                    <p class="text-lg sm:text-xl md:text-2xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en' 
                        ? 'We combine modern design, proven UX patterns and technical excellence to create websites that convert visitors into customers.'
                        : 'Мы сочетаем современный дизайн, проверенные UX-паттерны и техническое совершенство, чтобы создавать сайты, которые превращают посетителей в клиентов.'; ?>
                </p>
            </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:gap-20 lg:gap-24">
                    <div class="group relative reveal cursor-pointer touch-manipulation">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                            <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Design first' : 'Дизайн прежде всего'; ?>
                    </h3>
                        <p class="text-lg sm:text-xl md:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Every pixel matters. We create interfaces that are not only beautiful but also intuitive and conversion-focused.'
                            : 'Каждый пиксель важен. Мы создаём интерфейсы, которые не только красивы, но и интуитивны и ориентированы на конверсию.'; ?>
                    </p>
                </div>
                    <div class="group relative reveal cursor-pointer touch-manipulation">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                            <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Performance' : 'Производительность'; ?>
                    </h3>
                        <p class="text-lg sm:text-xl md:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Fast loading, optimized images, clean code. Your site will rank better and convert more visitors.'
                            : 'Быстрая загрузка, оптимизированные изображения, чистый код. Ваш сайт будет лучше ранжироваться и конвертировать больше посетителей.'; ?>
                    </p>
                </div>
                    <div class="group relative reveal cursor-pointer touch-manipulation">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mb-8 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                            <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold mb-6 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Data-driven' : 'На основе данных'; ?>
                    </h3>
                        <p class="text-lg sm:text-xl md:text-2xl leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'We analyze user behavior, test hypotheses and continuously improve conversion rates based on real metrics.'
                            : 'Мы анализируем поведение пользователей, тестируем гипотезы и постоянно улучшаем конверсию на основе реальных метрик.'; ?>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Фильтрация проектов портфолио
    (function() {
        'use strict';
        
        const filterButtons = document.querySelectorAll('.portfolio-filter');
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        
        if (filterButtons.length === 0 || portfolioItems.length === 0) return;
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
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

<!-- CTA секция - улучшенный дизайн с мобильной адаптацией -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden">
    <!-- Фоновые градиенты -->
    <div class="absolute inset-0 bg-gradient-to-br from-neon-purple/30 via-neon-purple/20 to-neon-blue/30"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(139,92,246,0.3),transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(6,182,212,0.3),transparent_50%)]"></div>
    
    <!-- Декоративные элементы -->
    <div class="absolute top-0 left-1/4 w-64 h-64 md:w-96 md:h-96 bg-neon-purple/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-64 h-64 md:w-96 md:h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto reveal">
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
    /* Стили для превью проектов */
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

