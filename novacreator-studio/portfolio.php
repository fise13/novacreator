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

<!-- Hero секция - улучшенный дизайн с визуальными элементами -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Фоновые градиенты и декоративные элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse" style="background: radial-gradient(circle, rgba(139, 92, 246, 0.4), transparent); animation-duration: 4s;"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse" style="background: radial-gradient(circle, rgba(6, 182, 212, 0.4), transparent); animation-duration: 5s; animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] rounded-full blur-3xl opacity-10" style="background: radial-gradient(circle, rgba(139, 92, 246, 0.3), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Бейдж -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full backdrop-blur-sm border mb-6 md:mb-8 reveal" style="background-color: rgba(139, 92, 246, 0.1); border-color: rgba(139, 92, 246, 0.3);">
                <span class="text-xs uppercase tracking-wider font-medium" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Our Work' : 'Наши работы'; ?>
                </span>
            </div>
            
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.portfolio.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?>
            </p>
            
            <!-- Статистика в hero -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 max-w-4xl mx-auto mt-12 md:mt-16 reveal">
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-text);">
                        <span class="counter-number" data-target="5" data-suffix="+">0</span>
                    </div>
                    <p class="text-sm md:text-base" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Projects' : 'Проектов'; ?>
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-text);">
                        <span class="counter-number" data-target="100" data-suffix="%">0</span>
                    </div>
                    <p class="text-sm md:text-base" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Satisfaction' : 'Удовлетворённость'; ?>
                    </p>
                </div>
                <div class="text-center col-span-2 md:col-span-1">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-text);">
                        <span class="counter-number" data-target="10" data-suffix="+">0</span>
                    </div>
                    <p class="text-sm md:text-base" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'Years Experience' : 'Лет опыта'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Индикатор прокрутки -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center backdrop-blur-sm hover:scale-110 transition-transform cursor-pointer" style="border-color: var(--color-border); background-color: rgba(255, 255, 255, 0.05);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text-secondary);">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
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
<section class="reveal-group py-12 md:py-16" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-8 md:mb-12 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Our recent projects' : 'Наши реализованные проекты'; ?>
                </h2>
                <p class="text-base md:text-lg leading-relaxed mb-2" style="color: var(--color-text-secondary);">
                    <?php if ($currentLang === 'en'): ?>
                        Clients don't care whether a brand is world‑famous — they care about how clearly the website explains the offer and what changes "before / after" it brings to their business.
                    <?php else: ?>
                        Клиентам важнее не громкое имя, а то, насколько аккуратно сайт объясняет оффер и какие изменения "до / после" он приносит в бизнес.
                    <?php endif; ?>
                </p>
                <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary); opacity: 0.7;">
                    <?php if ($currentLang === 'en'): ?>
                        All projects on this page are demonstration concepts created to showcase our approach to structure, UX and design. They are not based on real client data.
                    <?php else: ?>
                        Все проекты на этой странице — демонстрационные концепты, созданные, чтобы показать наш подход к структуре, UX и дизайну. Они не основаны на данных реальных клиентов.
                    <?php endif; ?>
                </p>
            </div>

        <!-- Фильтры по категориям - улучшенный дизайн -->
        <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-8 md:mb-12 reveal">
            <button class="portfolio-filter active group relative px-6 py-3 text-base md:text-lg font-medium transition-all duration-300 min-h-[44px] touch-manipulation rounded-full overflow-hidden" data-filter="all" style="color: var(--color-text); background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(6, 182, 212, 0.15)); border: 1px solid rgba(139, 92, 246, 0.3);">
                <span class="relative z-10"><?php echo $currentLang === 'en' ? 'All projects' : 'Все проекты'; ?></span>
                <span class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-cyan-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </button>
            <button class="portfolio-filter group relative px-6 py-3 text-base md:text-lg font-medium transition-all duration-300 hover:scale-105 min-h-[44px] touch-manipulation rounded-full" data-filter="website" style="color: var(--color-text-secondary); background-color: var(--color-bg); border: 1px solid var(--color-border);">
                <span class="relative z-10">Website</span>
                <span class="absolute inset-0 bg-gradient-to-r from-purple-600/10 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
            </button>
            <button class="portfolio-filter group relative px-6 py-3 text-base md:text-lg font-medium transition-all duration-300 hover:scale-105 min-h-[44px] touch-manipulation rounded-full" data-filter="landing" style="color: var(--color-text-secondary); background-color: var(--color-bg); border: 1px solid var(--color-border);">
                <span class="relative z-10">Landing</span>
                <span class="absolute inset-0 bg-gradient-to-r from-purple-600/10 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
            </button>
            <button class="portfolio-filter group relative px-6 py-3 text-base md:text-lg font-medium transition-all duration-300 hover:scale-105 min-h-[44px] touch-manipulation rounded-full" data-filter="ecommerce" style="color: var(--color-text-secondary); background-color: var(--color-bg); border: 1px solid var(--color-border);">
                <span class="relative z-10">E‑commerce</span>
                <span class="absolute inset-0 bg-gradient-to-r from-purple-600/10 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
            </button>
            <button class="portfolio-filter group relative px-6 py-3 text-base md:text-lg font-medium transition-all duration-300 hover:scale-105 min-h-[44px] touch-manipulation rounded-full" data-filter="booking" style="color: var(--color-text-secondary); background-color: var(--color-bg); border: 1px solid var(--color-border);">
                <span class="relative z-10">Booking</span>
                <span class="absolute inset-0 bg-gradient-to-r from-purple-600/10 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
            </button>
            <button class="portfolio-filter group relative px-6 py-3 text-base md:text-lg font-medium transition-all duration-300 hover:scale-105 min-h-[44px] touch-manipulation rounded-full" data-filter="personal" style="color: var(--color-text-secondary); background-color: var(--color-bg); border: 1px solid var(--color-border);">
                <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Personal brand' : 'Личный бренд'; ?></span>
                <span class="absolute inset-0 bg-gradient-to-r from-purple-600/10 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
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
                <div class="portfolio-item reveal group <?php echo $filterClass; ?>" data-category="<?php echo $category ?: 'all'; ?>" style="transition: all 0.3s ease;">
                    <!-- Превью проекта - улучшенный дизайн -->
                    <div class="portfolio-preview-wrapper mb-6 md:mb-8 relative overflow-hidden rounded-2xl group-hover:shadow-2xl transition-all duration-500" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
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
                            
                            <!-- Интерактивное превью при hover (только на десктопе) - улучшенный -->
                            <div class="portfolio-preview-hover absolute inset-0 opacity-0 pointer-events-none transition-all duration-500 ease-out group-hover:opacity-100 group-hover:pointer-events-auto hidden lg:block z-10 rounded-xl overflow-hidden" style="background-color: var(--color-bg-lighter); box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(139, 92, 246, 0.2); transform: scale(1.02);">
                                <iframe 
                                    data-src="<?php echo htmlspecialchars($demoLink); ?>" 
                                    class="portfolio-preview-iframe-hover w-full h-full"
                                    loading="lazy"
                                    aria-label="<?php echo htmlspecialchars($project['title']); ?> interactive preview"
                                    style="transform: scale(0.8); transform-origin: top center; width: 125%; height: 125%;"
                                ></iframe>
                                <div class="absolute top-4 right-4 px-4 py-2 rounded-full text-xs font-semibold backdrop-blur-md flex items-center gap-2 transition-all duration-300 group-hover:scale-105" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.9), rgba(6, 182, 212, 0.9)); color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <?php echo $currentLang === 'en' ? 'Interactive preview' : 'Интерактивное превью'; ?>
                                </div>
                            </div>
                            
                            <!-- Кнопка для мобильных - улучшенный дизайн -->
                            <a href="<?php echo htmlspecialchars($demoLink); ?>" class="lg:hidden absolute inset-0 flex items-center justify-center transition-all duration-300 rounded-xl group/btn" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(6, 182, 212, 0.1)); backdrop-blur-sm;" rel="noopener">
                                <div class="text-center p-6 transform transition-transform duration-300 group-hover/btn:scale-110">
                                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.2)); border: 2px solid rgba(139, 92, 246, 0.3);">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text);">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Tap to view' : 'Нажмите для просмотра'; ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                        
                    <!-- Заголовок и категория - улучшенный дизайн -->
                    <div class="mb-4 md:mb-6">
                        <div class="mb-3">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 text-xs uppercase tracking-wider font-medium rounded-full backdrop-blur-sm transition-all duration-300 group-hover:scale-105" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(6, 182, 212, 0.15)); border: 1px solid rgba(139, 92, 246, 0.3); color: var(--color-text-secondary);">
                                <span class="w-2 h-2 rounded-full" style="background: linear-gradient(135deg, #8b5cf6, #06b6d4);"></span>
                                <?php echo htmlspecialchars($project['tagBadge']); ?>
                            </span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 leading-tight group-hover:opacity-80 transition-opacity duration-300" style="color: var(--color-text);">
                            <a href="<?php echo htmlspecialchars($demoLink); ?>" class="group/link inline-flex items-center gap-2" style="color: var(--color-text); text-decoration: none;" rel="noopener">
                                <span><?php echo htmlspecialchars($project['title']); ?></span>
                                <svg class="w-5 h-5 opacity-0 group-hover/link:opacity-100 transition-all duration-300 transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </h3>
                        <p class="text-base md:text-lg mb-4 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($project['summary']); ?>
                        </p>
                    </div>
                    
                    <!-- Секция "До/После" - улучшенный дизайн -->
                    <div class="mb-6 md:mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                            <!-- До -->
                            <div class="relative p-6 rounded-xl transition-all duration-300 group-hover:scale-[1.02]" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                                <div class="absolute top-0 left-0 w-full h-1 rounded-t-xl" style="background: linear-gradient(90deg, #ef4444, #f87171);"></div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider mb-4 flex items-center gap-2" style="color: var(--color-text);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <?php echo $currentLang === 'en' ? 'Before' : 'До'; ?>
                                </h4>
                                <ul class="space-y-3">
                                    <?php foreach ($project['before'] as $beforeItem): ?>
                                        <li class="flex items-start gap-3 text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                                            <span class="w-1.5 h-1.5 rounded-full mt-2 flex-shrink-0" style="background: #ef4444; opacity: 0.6;"></span>
                                            <span><?php echo htmlspecialchars($beforeItem); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            
                            <!-- После -->
                            <div class="relative p-6 rounded-xl transition-all duration-300 group-hover:scale-[1.02]" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                                <div class="absolute top-0 left-0 w-full h-1 rounded-t-xl" style="background: linear-gradient(90deg, #10b981, #34d399);"></div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider mb-4 flex items-center gap-2" style="color: var(--color-text);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <?php echo $currentLang === 'en' ? 'After' : 'После'; ?>
                                </h4>
                                <ul class="space-y-3">
                                    <?php foreach ($project['after'] as $afterItem): ?>
                                        <li class="flex items-start gap-3 text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                                            <span class="w-1.5 h-1.5 rounded-full mt-2 flex-shrink-0" style="background: #10b981; opacity: 0.6;"></span>
                                            <span><?php echo htmlspecialchars($afterItem); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Результат - улучшенный дизайн -->
                    <div class="mb-6 p-4 rounded-xl backdrop-blur-sm transition-all duration-300 group-hover:scale-[1.01]" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(6, 182, 212, 0.1)); border: 1px solid rgba(139, 92, 246, 0.2);">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #10b981;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <p class="text-sm md:text-base font-medium leading-relaxed" style="color: var(--color-text);">
                                <?php echo htmlspecialchars($project['result']); ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Технологии и мета - улучшенный дизайн -->
                    <div class="mb-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <?php 
                            $metaItems = explode(' · ', $project['meta']);
                            foreach ($metaItems as $metaItem): 
                            ?>
                                <span class="inline-flex items-center px-3 py-1.5 text-xs md:text-sm font-medium rounded-full backdrop-blur-sm transition-all duration-300 hover:scale-105" style="background-color: var(--color-bg); border: 1px solid var(--color-border); color: var(--color-text-secondary);">
                                    <?php echo htmlspecialchars(trim($metaItem)); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Ссылка на проект - улучшенный дизайн -->
                    <a href="<?php echo htmlspecialchars($demoLink); ?>" class="group/link inline-flex items-center gap-3 px-6 py-3 text-sm md:text-base font-semibold rounded-full transition-all duration-300 hover:scale-105 hover:shadow-xl min-h-[44px] touch-manipulation" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; text-decoration: none; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);" rel="noopener">
                        <span><?php echo $currentLang === 'en' ? 'View project' : 'Посмотреть проект'; ?></span>
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

        <!-- Дополнительная секция: Технологии и подход - улучшенный дизайн -->
        <div class="mt-16 md:mt-24 py-12 md:py-16 rounded-3xl reveal" style="background: linear-gradient(135deg, var(--color-bg) 0%, var(--color-bg-lighter) 100%); border: 1px solid var(--color-border);">
            <div class="max-w-5xl mx-auto px-4 md:px-6 lg:px-8">
                <div class="mb-8 md:mb-12 reveal text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full backdrop-blur-sm border mb-4" style="background-color: rgba(139, 92, 246, 0.1); border-color: rgba(139, 92, 246, 0.3);">
                        <span class="text-xs uppercase tracking-wider font-medium" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Our Methodology' : 'Наша методология'; ?>
                        </span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Our approach' : 'Наш подход'; ?>
                    </h2>
                    <p class="text-base md:text-lg leading-relaxed max-w-3xl mx-auto" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? 'We combine modern design, proven UX patterns and technical excellence to create websites that convert visitors into customers.'
                            : 'Мы сочетаем современный дизайн, проверенные UX-паттерны и техническое совершенство, чтобы создавать сайты, которые превращают посетителей в клиентов.'; ?>
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    <div class="reveal group relative p-6 md:p-8 rounded-2xl transition-all duration-500 hover:scale-105 hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.2));">
                            <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Design first' : 'Дизайн прежде всего'; ?>
                        </h3>
                        <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Every pixel matters. We create interfaces that are not only beautiful but also intuitive and conversion-focused.'
                                : 'Каждый пиксель важен. Мы создаём интерфейсы, которые не только красивы, но и интуитивны и ориентированы на конверсию.'; ?>
                        </p>
                    </div>
                    <div class="reveal group relative p-6 md:p-8 rounded-2xl transition-all duration-500 hover:scale-105 hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.2));">
                            <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Performance' : 'Производительность'; ?>
                        </h3>
                        <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Fast loading, optimized images, clean code. Your site will rank better and convert more visitors.'
                                : 'Быстрая загрузка, оптимизированные изображения, чистый код. Ваш сайт будет лучше ранжироваться и конвертировать больше посетителей.'; ?>
                        </p>
                    </div>
                    <div class="reveal group relative p-6 md:p-8 rounded-2xl transition-all duration-500 hover:scale-105 hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110 group-hover:rotate-3" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.2));">
                            <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold mb-3 leading-tight" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Data-driven' : 'На основе данных'; ?>
                        </h3>
                        <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
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
                
                // Обновляем активную кнопку с улучшенными стилями
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.style.color = 'var(--color-text-secondary)';
                    btn.style.background = 'var(--color-bg)';
                    btn.style.borderColor = 'var(--color-border)';
                });
                
                this.classList.add('active');
                this.style.color = 'var(--color-text)';
                this.style.background = 'linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(6, 182, 212, 0.15))';
                this.style.borderColor = 'rgba(139, 92, 246, 0.3)';
                
                // Фильтруем проекты с улучшенной анимацией
                portfolioItems.forEach((item, index) => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (filter === 'all' || itemCategory === filter) {
                        item.style.display = '';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0) scale(1)';
                        }, index * 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px) scale(0.95)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Инициализация стилей для плавной анимации
        portfolioItems.forEach(item => {
            item.style.transition = 'opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    })();
    
    // Счетчики для статистики в hero
    (function() {
        'use strict';
        
        const counterElements = document.querySelectorAll('.counter-number');
        if (counterElements.length === 0) return;
        
        const animateCounter = (element) => {
            const target = parseInt(element.getAttribute('data-target')) || 0;
            const suffix = element.getAttribute('data-suffix') || '';
            const duration = 2000; // 2 seconds
            const steps = 60;
            const increment = target / steps;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + suffix;
            }, duration / steps);
        };
        
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };
        
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counter-animated')) {
                    entry.target.classList.add('counter-animated');
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        counterElements.forEach(element => {
            counterObserver.observe(element);
        });
    })();
</script>

<!-- CTA секция - улучшенный дизайн с мобильной адаптацией -->
<section class="reveal-group py-20 md:py-28 lg:py-40 relative overflow-hidden">
    <!-- Фоновые градиенты - улучшенные -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/40 via-purple-500/30 to-cyan-600/40"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(139,92,246,0.4),transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(6,182,212,0.4),transparent_50%)]"></div>
    
    <!-- Декоративные элементы - улучшенные -->
    <div class="absolute top-0 left-1/4 w-64 h-64 md:w-96 md:h-96 bg-purple-500/30 rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
    <div class="absolute bottom-0 right-1/4 w-64 h-64 md:w-96 md:h-96 bg-cyan-500/30 rounded-full blur-3xl animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] bg-gradient-to-r from-purple-500/20 to-cyan-500/20 rounded-full blur-3xl"></div>
    
    <!-- Сетка для дополнительного визуального эффекта -->
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto reveal">
            <div class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 md:mb-8 transition-all duration-300 hover:scale-105 hover:bg-white/15">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: rgba(255, 255, 255, 0.9);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="text-xs uppercase tracking-wider font-medium" style="color: rgba(255, 255, 255, 0.9);">
                    <?php echo $currentLang === 'en' ? 'Ready to Start Your Project?' : 'Готовы начать проект?'; ?>
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.9] tracking-tighter" style="color: #ffffff; text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl mb-10 md:mb-12 lg:mb-14 leading-relaxed px-2" style="color: rgba(255, 255, 255, 0.9); text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-flex items-center justify-center gap-3 w-full sm:w-auto min-h-[56px] sm:min-h-[64px] px-10 md:px-12 py-4 md:py-5 text-base sm:text-lg md:text-xl font-bold rounded-full shadow-2xl transition-all duration-300 hover:scale-105 hover:shadow-3xl touch-manipulation overflow-hidden" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #06b6d4 100%); color: #ffffff; text-decoration: none; box-shadow: 0 10px 40px rgba(99, 102, 241, 0.4);">
                <span class="relative z-10"><?php echo htmlspecialchars(t('pages.portfolio.cta.button')); ?></span>
                <svg class="w-5 h-5 md:w-6 md:h-6 relative z-10 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
                <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
                <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></span>
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
    /* Стили для превью проектов - улучшенные */
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
        border-radius: 0.75rem;
    }
    
    .portfolio-preview-hover {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        border-radius: 0.75rem;
    }
    
    .portfolio-preview-hover iframe {
        position: absolute;
        top: 0;
        left: 0;
        border: none;
        border-radius: 0.75rem;
    }
    
    .portfolio-preview-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0.75rem;
    }
    
    /* Улучшенные hover эффекты */
    .portfolio-item:hover .portfolio-preview-wrapper {
        transform: translateY(-4px);
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .portfolio-preview-hover {
            display: none !important;
        }
    }
    
    /* Плавные переходы */
    .portfolio-preview-wrapper {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .portfolio-preview-wrapper * {
        transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Анимация для активного фильтра */
    .portfolio-filter.active {
        transform: scale(1.05);
    }
    
    /* Улучшенные карточки проектов */
    .portfolio-item {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .portfolio-item:hover {
        transform: translateY(-2px);
    }
</style>

<?php include 'includes/footer.php'; ?>

