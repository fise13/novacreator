<?php
/**
 * Портфолио — главная страница
 * Показывает подход к решению задач, а не просто красивые сайты
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'Portfolio' : 'Портфолио';
$pageMetaTitle = $currentLang === 'en' 
    ? 'Portfolio | Web Development Case Studies | NovaCreator Studio'
    : 'Портфолио — кейсы веб-разработки и SEO | NovaCreator Studio';
$pageMetaDescription = $currentLang === 'en'
    ? 'Real case studies: how we solve business problems through web development. Landing pages, online stores, corporate websites. Results with metrics.'
    : 'Реальные кейсы: как мы решаем бизнес-задачи через веб-разработку. Лендинги, интернет-магазины, корпоративные сайты. Результаты с метриками.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'portfolio, web development case studies, landing page portfolio, website development examples'
    : 'портфолио, кейсы веб-разработки, портфолио лендингов, примеры разработки сайтов';
$pageMetaCanonical = '/portfolio';

include 'includes/header.php';
?>

<!-- Hero -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Portfolio' : 'Портфолио'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'How we solve business problems through web development'
                    : 'Как мы решаем бизнес-задачи через веб-разработку'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Вступление -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What You\'ll Find Here' : 'Что здесь показано'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'This portfolio shows real projects and real problems we solved. Not beautiful mockups, but actual working websites that generate results for businesses.'
                        : 'Это портфолио показывает реальные проекты и реальные проблемы, которые мы решили. Не красивые макеты, а работающие сайты, которые приносят результаты бизнесу.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'Each case study explains: what problem the client had, what goal we needed to achieve, how we thought about the solution, what we built, and what happened after launch.'
                        : 'В каждом кейсе объясняется: какая проблема была у клиента, какую цель нужно было достичь, как мы думали о решении, что построили, и что произошло после запуска.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'If you\'re looking for someone who understands business goals and builds websites that solve problems, not just look good, these cases will show you our approach.'
                        : 'Если вы ищете того, кто понимает бизнес-цели и строит сайты, которые решают проблемы, а не просто красиво выглядят, эти кейсы покажут вам наш подход.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Типы задач -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Types of Problems We Solve' : 'Какие задачи мы решаем'; ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Need to generate leads quickly' : 'Нужно быстро получать заявки'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Business needs leads from advertising campaigns. We build landing pages that convert traffic into leads, with clear value proposition, structured content, and optimized forms.'
                            : 'Бизнесу нужны заявки из рекламных кампаний. Мы строим лендинги, которые конвертируют трафик в заявки: четкое ценностное предложение, структурированный контент, оптимизированные формы.'; ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio/lead-generation'); ?>" class="text-base font-medium hover:underline inline-flex items-center gap-2" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'View cases' : 'Смотреть кейсы'; ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Need to sell products online' : 'Нужно продавать товары онлайн'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Business sells physical or digital products and needs an online store. We build e-commerce sites with catalog, cart, checkout, product pages optimized for conversion.'
                            : 'Бизнес продает физические или цифровые товары, нужен интернет-магазин. Строим e-commerce сайты с каталогом, корзиной, оформлением заказа, страницами товаров, оптимизированными под конверсию.'; ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio/ecommerce'); ?>" class="text-base font-medium hover:underline inline-flex items-center gap-2" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'View cases' : 'Смотреть кейсы'; ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Need professional online presence' : 'Нужно профессиональное присутствие в интернете'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Service business needs a website that builds trust, showcases expertise, and can grow organically through SEO. We build corporate websites with structured content, portfolio sections, blog capabilities.'
                            : 'Сервисному бизнесу нужен сайт, который формирует доверие, демонстрирует экспертизу и может расти органически через SEO. Строим корпоративные сайты со структурированным контентом, портфолио, возможностями блога.'; ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio/corporate'); ?>" class="text-base font-medium hover:underline inline-flex items-center gap-2" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'View cases' : 'Смотреть кейсы'; ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Need to improve existing site' : 'Нужно улучшить существующий сайт'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Site exists but doesn\'t convert well, loads slowly, or doesn\'t rank in search. We analyze problems, redesign structure and UX, optimize for performance and SEO, rebuild with modern technologies.'
                            : 'Сайт есть, но плохо конвертирует, медленно загружается или не ранжируется в поиске. Анализируем проблемы, переделываем структуру и UX, оптимизируем производительность и SEO, перестраиваем на современных технологиях.'; ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio/redesign'); ?>" class="text-base font-medium hover:underline inline-flex items-center gap-2" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'View cases' : 'Смотреть кейсы'; ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Фильтры кейсов -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Case Studies' : 'Кейсы'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'Each case explains the problem, solution, and results. Click to read the full story.'
                        : 'В каждом кейсе объясняется проблема, решение и результаты. Кликните, чтобы прочитать полную историю.'; ?>
                </p>
            </div>

            <!-- Фильтры -->
            <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-12 reveal">
                <button class="portfolio-filter active px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px]" data-filter="all" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'All cases' : 'Все кейсы'; ?>
                </button>
                <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px]" data-filter="landing" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Landing pages' : 'Лендинги'; ?>
                </button>
                <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px]" data-filter="ecommerce" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'E-commerce' : 'Интернет-магазины'; ?>
                </button>
                <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px]" data-filter="corporate" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Corporate sites' : 'Корпоративные сайты'; ?>
                </button>
                <button class="portfolio-filter px-5 py-2 text-base md:text-lg font-medium transition-opacity duration-200 hover:opacity-70 min-h-[44px" data-filter="redesign" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Redesign' : 'Редизайн'; ?>
                </button>
            </div>

            <?php
            // Данные кейсов
            $cases = [
                [
                    'id' => 'coffee-shop-landing',
                    'type' => 'landing',
                    'title' => $currentLang === 'en' 
                        ? 'Landing page for local coffee shop: from Instagram to online orders'
                        : 'Лендинг для локальной кофейни: от Instagram к онлайн-заказам',
                    'problem' => $currentLang === 'en'
                        ? 'Coffee shop relied only on Instagram. Orders came through direct messages, got lost, staff couldn\'t keep up. No local SEO presence.'
                        : 'Кофейня работала только через Instagram. Заказы шли в директ, терялись, персонал не успевал. Отсутствие локального SEO.',
                    'result_summary' => $currentLang === 'en'
                        ? '340% increase in online orders, appeared in Google Maps top-3 within 3 months.'
                        : 'Рост онлайн-заказов на 340%, попадание в топ-3 Google Maps за 3 месяца.',
                    'url' => '/portfolio/case/coffee-shop-landing'
                ],
                [
                    'id' => 'personal-trainer-landing',
                    'type' => 'landing',
                    'title' => $currentLang === 'en'
                        ? 'Landing page for personal trainer: structuring complex service into clear offer'
                        : 'Лендинг для персонального тренера: структурирование сложной услуги в понятное предложение',
                    'problem' => $currentLang === 'en'
                        ? 'Trainer had scattered social media posts but no sales page. Clients didn\'t understand what they get, how long it takes, or how to apply.'
                        : 'У тренера были разрозненные посты в соцсетях, но не было продающей страницы. Клиенты не понимали, что получают, сколько это займет, как подать заявку.',
                    'result_summary' => $currentLang === 'en'
                        ? '18.5% conversion rate, 6.2 min average session duration, structured lead collection.'
                        : 'Конверсия 18.5%, средняя длительность сессии 6.2 мин, структурированный сбор заявок.',
                    'url' => '/portfolio/case/personal-trainer-landing'
                ],
                [
                    'id' => 'construction-company-landing',
                    'type' => 'landing',
                    'title' => $currentLang === 'en'
                        ? 'Landing page for construction company: explaining complex product and building trust'
                        : 'Лендинг для строительной компании: объяснение сложного продукта и формирование доверия',
                    'problem' => $currentLang === 'en'
                        ? 'Company builds custom houses. Old site was just a list of services. Clients didn\'t understand the process, were afraid of hidden costs, didn\'t trust contractors.'
                        : 'Компания строит дома под ключ. Старый сайт был просто списком услуг. Клиенты не понимали процесс, боялись скрытых расходов, не доверяли подрядчику.',
                    'result_summary' => $currentLang === 'en'
                        ? '470% increase in consultation requests, 72% form completion rate, 4.8/5 trust score.'
                        : 'Рост запросов на консультации на 470%, процент заполнения формы 72%, оценка доверия 4.8/5.',
                    'url' => '/portfolio/case/construction-company-landing'
                ],
                [
                    'id' => 'electronics-store',
                    'type' => 'ecommerce',
                    'title' => $currentLang === 'en'
                        ? 'E-commerce store: from scattered catalog to structured online store'
                        : 'Интернет-магазин: от разрозненного каталога к структурированному онлайн-магазину',
                    'problem' => $currentLang === 'en'
                        ? 'Products were listed in different places, no unified shopping interface. Customers couldn\'t compare items, checkout was complicated with many steps.'
                        : 'Товары были размещены в разных местах, не было единого интерфейса покупок. Клиенты не могли сравнивать товары, оформление заказа было сложным с множеством шагов.',
                    'result_summary' => $currentLang === 'en'
                        ? 'Complete store with 280+ products, 2.4 min average checkout time, 2.1s page load.'
                        : 'Полноценный магазин с 280+ товарами, среднее время оформления 2.4 мин, загрузка страницы 2.1 сек.',
                    'url' => '/portfolio/case/electronics-store'
                ],
                [
                    'id' => 'hotel-booking',
                    'type' => 'corporate',
                    'title' => $currentLang === 'en'
                        ? 'Hotel booking website: mobile-first booking flow for boutique hotel'
                        : 'Сайт бронирования отеля: mobile-first процесс бронирования для бутик-отеля',
                    'problem' => $currentLang === 'en'
                        ? 'Hotel bookings came through calls and messages. No mobile booking interface. Guests couldn\'t see room availability or prices for specific dates easily.'
                        : 'Бронирования шли через звонки и сообщения. Не было мобильного интерфейса бронирования. Гости не могли легко увидеть доступность номеров или цены на конкретные даты.',
                    'result_summary' => $currentLang === 'en'
                        ? 'Mobile-optimized booking flow, 89 Mobile PageSpeed score, integrated with hotel PMS.'
                        : 'Мобильно оптимизированный процесс бронирования, Mobile PageSpeed 89/100, интегрирован с PMS отеля.',
                    'url' => '/portfolio/case/hotel-booking'
                ]
            ];
            ?>

            <!-- Список кейсов -->
            <div class="space-y-8 md:space-y-12" id="portfolioCases">
                <?php foreach ($cases as $case): ?>
                    <div class="portfolio-case reveal border rounded-2xl p-8 md:p-10 hover:shadow-xl transition-all duration-300" data-type="<?php echo $case['type']; ?>" style="background-color: var(--color-bg); border-color: var(--color-border);">
                        <div class="mb-4">
                            <span class="inline-block px-4 py-2 text-sm font-medium rounded-full" style="background-color: var(--color-bg-lighter); color: var(--color-text-secondary); border: 1px solid var(--color-border);">
                                <?php 
                                $typeLabels = [
                                    'landing' => $currentLang === 'en' ? 'Landing page' : 'Лендинг',
                                    'ecommerce' => $currentLang === 'en' ? 'E-commerce' : 'Интернет-магазин',
                                    'corporate' => $currentLang === 'en' ? 'Corporate site' : 'Корпоративный сайт',
                                    'redesign' => $currentLang === 'en' ? 'Redesign' : 'Редизайн'
                                ];
                                echo $typeLabels[$case['type']] ?? $case['type'];
                                ?>
                            </span>
                        </div>
                        
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($case['title']); ?>
                        </h3>
                        
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold uppercase tracking-wider mb-2" style="color: var(--color-text); opacity: 0.7;">
                                <?php echo $currentLang === 'en' ? 'Problem' : 'Проблема'; ?>
                            </h4>
                            <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo htmlspecialchars($case['problem']); ?>
                            </p>
                        </div>
                        
                        <div class="mb-6 p-4 rounded-lg" style="background-color: var(--color-bg-lighter);">
                            <h4 class="text-sm font-semibold uppercase tracking-wider mb-2" style="color: var(--color-text); opacity: 0.7;">
                                <?php echo $currentLang === 'en' ? 'Result' : 'Результат'; ?>
                            </h4>
                            <p class="text-base md:text-lg font-medium leading-relaxed" style="color: var(--color-text);">
                                <?php echo htmlspecialchars($case['result_summary']); ?>
                            </p>
                        </div>
                        
                        <a href="<?php echo getLocalizedUrl($currentLang, $case['url']); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium hover:underline transition-all duration-200 hover:translate-x-1" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Read full case study' : 'Прочитать полный кейс'; ?>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="reveal-group py-16 md:py-24 lg:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-12 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Have a similar problem?' : 'Есть похожая задача?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en'
                    ? 'Let\'s discuss your business goals and how we can help achieve them.'
                    : 'Обсудим ваши бизнес-цели и как мы можем помочь их достичь.'; ?>
            </p>
            <div class="reveal">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Get Consultation' : 'Получить консультацию'; ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Фильтрация кейсов
    (function() {
        'use strict';
        const filterButtons = document.querySelectorAll('.portfolio-filter');
        const portfolioCases = document.querySelectorAll('.portfolio-case');
        
        if (filterButtons.length === 0 || portfolioCases.length === 0) return;
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.style.color = 'var(--color-text-secondary)';
                });
                
                this.classList.add('active');
                this.style.color = 'var(--color-text)';
                
                portfolioCases.forEach(item => {
                    const itemType = item.getAttribute('data-type');
                    if (filter === 'all' || itemType === filter) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    })();
</script>

<?php include 'includes/footer.php'; ?>
