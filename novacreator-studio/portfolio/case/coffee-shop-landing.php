<?php
/**
 * Кейс: Лендинг для кофейни
 * Полная история: проблема → решение → результат
 */
require_once __DIR__ . '/../../includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' 
    ? 'Coffee Shop Landing Page Case Study'
    : 'Кейс: Лендинг для кофейни';
$pageMetaTitle = $currentLang === 'en' 
    ? 'Coffee Shop Landing Page: From Instagram to Online Orders | Case Study | NovaCreator Studio'
    : 'Лендинг для кофейни: от Instagram к онлайн-заказам | Кейс | NovaCreator Studio';
$pageMetaDescription = $currentLang === 'en'
    ? 'Case study: how we built a landing page for a local coffee shop that increased online orders by 340% and appeared in Google Maps top-3. Problem, solution, results.'
    : 'Кейс: как мы построили лендинг для локальной кофейни, который увеличил онлайн-заказы на 340% и попал в топ-3 Google Maps. Проблема, решение, результаты.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'coffee shop website, landing page case study, local SEO case study, local business website'
    : 'сайт кофейни, кейс лендинга, кейс локального SEO, сайт для локального бизнеса';
$pageMetaCanonical = '/portfolio/case/coffee-shop-landing';

include '../../includes/header.php';
?>

<!-- H1 -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold mb-6 md:mb-8 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' 
                    ? 'Landing page for local coffee shop: from Instagram to online orders'
                    : 'Лендинг для локальной кофейни: от Instagram к онлайн-заказам'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl mb-8 md:mb-10 leading-relaxed font-light reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en'
                    ? 'How a structured landing page increased online orders by 340% and made the coffee shop visible in Google Maps'
                    : 'Как структурированный лендинг увеличил онлайн-заказы на 340% и сделал кофейню видимой в Google Maps'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Контекст -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Context' : 'Контекст'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'Local coffee shop in a residential district. Sells coffee, pastries, light meals. Has been operating for 2 years, has a loyal customer base. Business is growing, but the owner wants to scale online orders and reduce dependency on walk-in customers.'
                        : 'Локальная кофейня в жилом районе. Продает кофе, выпечку, легкие завтраки. Работает 2 года, есть постоянные клиенты. Бизнес растет, но владелец хочет масштабировать онлайн-заказы и снизить зависимость от проходящих мимо клиентов.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'The coffee shop is in a good location, but the area is competitive — there are 3-4 other cafes within walking distance. Standing out requires more than just location.'
                        : 'Кофейня в хорошем месте, но район конкурентный — есть еще 3-4 кафе в шаговой доступности. Выделиться нужно не только местоположением.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Проблема -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Problem' : 'Проблема'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'The coffee shop had no website — only an Instagram account. This created several problems:'
                        : 'У кофейни не было сайта — только аккаунт в Instagram. Это создавало несколько проблем:'; ?>
                </p>
                <ul class="space-y-4 mb-6">
                    <li class="flex items-start gap-4">
                        <span class="text-2xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">1</span>
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Chaotic order management' : 'Хаотичное управление заказами'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'Customers wrote orders in Instagram direct messages. Messages got lost in the feed, baristas had to check DMs constantly while working, orders were often duplicated or missed. Staff couldn\'t focus on making coffee.'
                                    : 'Клиенты писали заказы в директ Instagram. Сообщения терялись в ленте, бариста постоянно проверяли DM во время работы, заказы часто дублировались или пропускались. Персонал не мог сосредоточиться на приготовлении кофе.'; ?>
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-2xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">2</span>
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Incomplete information' : 'Неполная информация'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'Menu and special offers were scattered across Instagram posts. Customers had to scroll through weeks of posts to find what they wanted. No way to see full menu at once, prices were inconsistent across posts.'
                                    : 'Меню и специальные предложения были разбросаны по постам Instagram. Клиентам приходилось прокручивать недели постов, чтобы найти нужное. Не было способа увидеть полное меню сразу, цены были непоследовательными в разных постах.'; ?>
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-2xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text); opacity: 0.3;">3</span>
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'No local SEO presence' : 'Отсутствие локального SEO'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'The coffee shop was almost invisible in Google search and Google Maps. People searching for "coffee shop [district]" didn\'t find it. No structured information (hours, address, menu) in search results. Lost potential customers who search before visiting.'
                                    : 'Кофейня была почти невидима в Google поиске и Google Maps. Люди, ищущие "кофейня [район]", не находили её. Не было структурированной информации (часы работы, адрес, меню) в результатах поиска. Терялись потенциальные клиенты, которые ищут перед посещением.'; ?>
                            </p>
                        </div>
                    </li>
                </ul>
                <div class="p-6 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <p class="text-lg md:text-xl font-medium leading-relaxed" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en'
                            ? 'Before: 12-15 online orders per week, all through Instagram DMs. No visibility in Google Maps or local search.'
                            : 'До: 12-15 онлайн-заказов в неделю, все через Instagram DM. Нет видимости в Google Maps или локальном поиске.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Цель -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Goal' : 'Цель'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'Build a landing page that:'
                        : 'Построить лендинг, который:'; ?>
                </p>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start gap-3">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">•</span>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Structures online orders: customers can place orders through a form, orders come to email/Telegram automatically'
                                : 'Структурирует онлайн-заказы: клиенты могут оформлять заказы через форму, заказы автоматически приходят на email/Telegram'; ?>
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">•</span>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Shows complete menu: all items with prices in one place, easy to browse'
                                : 'Показывает полное меню: все позиции с ценами в одном месте, легко просматривать'; ?>
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">•</span>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Makes coffee shop visible in Google Maps and local search results'
                                : 'Делает кофейню видимой в Google Maps и результатах локального поиска'; ?>
                        </p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">•</span>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Works well on mobile devices (most orders come from phones)'
                                : 'Хорошо работает на мобильных устройствах (большинство заказов приходит с телефонов)'; ?>
                        </p>
                    </li>
                </ul>
                <div class="p-6 rounded-lg" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <p class="text-lg md:text-xl font-medium leading-relaxed" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en'
                            ? 'Success metrics: increase online orders to 40-50 per week, appear in Google Maps top-3 for relevant searches, page load time under 2 seconds, mobile PageSpeed score 90+.'
                            : 'Метрики успеха: увеличить онлайн-заказы до 40-50 в неделю, появиться в топ-3 Google Maps по релевантным поискам, время загрузки страницы до 2 секунд, оценка Mobile PageSpeed 90+.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Решение -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Solution' : 'Решение'; ?>
                </h2>
                
                <div class="space-y-12">
                    <div class="reveal">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? '1. Site structure: single-page landing focused on orders' : '1. Структура сайта: одностраничный лендинг с фокусом на заказы'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'We chose a single-page structure (not multi-page website) because the goal is specific: get orders. No navigation, no distractions — just menu, order form, and essential information (address, hours, contact).'
                                : 'Выбрали одностраничную структуру (не многостраничный сайт), потому что цель специфична: получать заказы. Без навигации, без отвлечений — только меню, форма заказа и основная информация (адрес, часы работы, контакты).'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'This structure fits landing pages perfectly — when someone clicks from Google Ads or social media, they land on a page that immediately shows what they can order and how to order it.'
                                : 'Эта структура идеально подходит для лендингов — когда кто-то переходит по ссылке из Google Ads или соцсетей, они попадают на страницу, которая сразу показывает, что можно заказать и как это сделать.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? '2. Menu section: structured and filterable' : '2. Раздел меню: структурированный и фильтруемый'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Menu is organized by categories (Coffee, Pastries, Light Meals, Beverages). Each item has: name, description, price. Added filters by coffee strength, milk options, volume — so customers can quickly find what they want without scrolling through everything.'
                                : 'Меню организовано по категориям (Кофе, Выпечка, Легкие завтраки, Напитки). У каждого блюда есть: название, описание, цена. Добавлены фильтры по крепости кофе, вариантам молока, объему — чтобы клиенты могли быстро найти нужное, не прокручивая всё.'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Why this matters: when information is structured, customers make decisions faster. Filters reduce cognitive load — instead of reading 50 items, they filter to 5-7 relevant options.'
                                : 'Почему это важно: когда информация структурирована, клиенты принимают решения быстрее. Фильтры снижают когнитивную нагрузку — вместо чтения 50 позиций они фильтруют до 5-7 релевантных вариантов.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? '3. Order form: clear and optimized' : '3. Форма заказа: понятная и оптимизированная'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Order form includes: customer name, phone, items (with quantities), pickup time, optional notes. Form sends notifications to email and Telegram immediately when submitted. No need for baristas to check DMs — orders come directly to their notification system.'
                                : 'Форма заказа включает: имя клиента, телефон, позиции (с количеством), время самовывоза, опциональные примечания. Форма отправляет уведомления на email и Telegram сразу после отправки. Баристам не нужно проверять DM — заказы приходят прямо в их систему уведомлений.'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Form validation prevents errors: phone number format checked, required fields marked, error messages explain what\'s wrong. This reduces failed submissions and customer frustration.'
                                : 'Валидация формы предотвращает ошибки: формат телефона проверяется, обязательные поля помечены, сообщения об ошибках объясняют, что не так. Это снижает неудачные отправки и фрустрацию клиентов.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? '4. Local SEO: Schema.org markup and Google Maps optimization' : '4. Локальное SEO: Schema.org разметка и оптимизация Google Maps'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Added LocalBusiness schema markup (Schema.org) to the page. This tells Google: business name, address, phone, hours, menu URL. Google uses this to display rich snippets in search results and list the business in Google Maps.'
                                : 'Добавили разметку LocalBusiness schema (Schema.org) на страницу. Это сообщает Google: название бизнеса, адрес, телефон, часы работы, URL меню. Google использует это для отображения rich snippets в результатах поиска и включения бизнеса в Google Maps.'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Also optimized page content with location-based keywords ("coffee shop [district]", "best coffee [district]"), added Google Maps embed with business location, included address and phone in visible text (not just in schema).'
                                : 'Также оптимизировали контент страницы ключевыми словами с локацией ("кофейня [район]", "лучший кофе [район]"), добавили встраивание Google Maps с местоположением бизнеса, включили адрес и телефон в видимый текст (не только в schema).'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Why this works: LocalBusiness schema is a direct signal to Google that this is a physical business with location. Combined with relevant content, it helps Google understand the business context and rank it for local searches.'
                                : 'Почему это работает: LocalBusiness schema — это прямой сигнал Google, что это физический бизнес с местоположением. В сочетании с релевантным контентом это помогает Google понять контекст бизнеса и ранжировать его по локальным поискам.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? '5. Performance optimization: fast loading for mobile' : '5. Оптимизация производительности: быстрая загрузка для мобильных'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Since most orders come from mobile phones, page performance on mobile is critical. We optimized images (WebP format, lazy loading), minimized CSS and JavaScript (TailwindCSS with purge, vanilla JS only), ensured fast server response time.'
                                : 'Поскольку большинство заказов приходит с мобильных телефонов, производительность страницы на мобильных критична. Оптимизировали изображения (WebP формат, lazy loading), минимизировали CSS и JavaScript (TailwindCSS с purge, только ванильный JS), обеспечили быструю скорость ответа сервера.'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Result: page loads in 1.8 seconds on mobile, Mobile PageSpeed score 92/100. Fast loading = better user experience = more completed orders. Slow pages lose customers — they close the tab before the page loads.'
                                : 'Результат: страница загружается за 1.8 секунд на мобильных, оценка Mobile PageSpeed 92/100. Быстрая загрузка = лучший пользовательский опыт = больше завершенных заказов. Медленные страницы теряют клиентов — они закрывают вкладку до загрузки страницы.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Процесс -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Process' : 'Процесс'; ?>
                </h2>
                
                <div class="space-y-8">
                    <div class="reveal">
                        <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Week 1: Analysis and structure' : 'Неделя 1: Анализ и структура'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Discussed business goals with owner, analyzed current order flow, identified pain points. Created site structure map: what sections, what information where, how order form works. Client approved structure before design started.'
                                : 'Обсудили бизнес-цели с владельцем, проанализировали текущий поток заказов, определили болевые точки. Создали карту структуры сайта: какие разделы, какая информация где, как работает форма заказа. Клиент утвердил структуру до начала дизайна.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal">
                        <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Week 2: Design and content' : 'Неделя 2: Дизайн и контент'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Created design mockups for mobile and desktop. Focused on readability (menu items, prices) and clear call-to-action (order button). Client provided menu data, we structured it into categories. Client reviewed design, gave feedback, we refined.'
                                : 'Создали дизайн-макеты для мобильных и десктопа. Сфокусировались на читаемости (позиции меню, цены) и четком призыве к действию (кнопка заказа). Клиент предоставил данные меню, мы структурировали их по категориям. Клиент просмотрел дизайн, дал обратную связь, мы доработали.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal">
                        <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Week 3: Development and setup' : 'Неделя 3: Разработка и настройка'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Built the page (PHP, TailwindCSS, JavaScript), set up order form with email/Telegram notifications, added Schema.org markup, optimized for performance. Tested on real devices (iPhone, Android phones). Client tested order form, confirmed notifications work correctly.'
                                : 'Построили страницу (PHP, TailwindCSS, JavaScript), настроили форму заказа с уведомлениями на email/Telegram, добавили Schema.org разметку, оптимизировали производительность. Протестировали на реальных устройствах (iPhone, Android телефоны). Клиент протестировал форму заказа, подтвердил, что уведомления работают правильно.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Результат -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Results' : 'Результаты'; ?>
                </h2>
                
                <div class="space-y-8 mb-8">
                    <div class="reveal p-6 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Online orders increased by 340%' : 'Онлайн-заказы выросли на 340%'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Before: 12-15 orders per week through Instagram DMs. After 3 months: 52-60 orders per week through the website form.'
                                : 'До: 12-15 заказов в неделю через Instagram DM. Через 3 месяца: 52-60 заказов в неделю через форму на сайте.'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Why this happened: structured order form is easier to use than Instagram DMs. Customers don\'t have to write long messages — they select items, fill form fields, submit. Process is faster, less friction, more completed orders.'
                                : 'Почему это произошло: структурированная форма заказа проще в использовании, чем Instagram DM. Клиентам не нужно писать длинные сообщения — они выбирают позиции, заполняют поля формы, отправляют. Процесс быстрее, меньше трения, больше завершенных заказов.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal p-6 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Appeared in Google Maps top-3' : 'Появилась в топ-3 Google Maps'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Within 3 months, the coffee shop appeared in Google Maps top-3 results for searches like "coffee shop [district]" and "best coffee [district]".'
                                : 'В течение 3 месяцев кофейня появилась в топ-3 результатов Google Maps по запросам типа "кофейня [район]" и "лучший кофе [район]".'; ?>
                        </p>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'This is because LocalBusiness schema markup tells Google the business exists, has a location, and serves coffee. Combined with location-based keywords in content, Google understands the business context and ranks it for relevant local searches.'
                                : 'Это произошло потому, что разметка LocalBusiness schema сообщает Google, что бизнес существует, имеет местоположение и продает кофе. В сочетании с ключевыми словами с локацией в контенте Google понимает контекст бизнеса и ранжирует его по релевантным локальным поискам.'; ?>
                        </p>
                    </div>
                    
                    <div class="reveal p-6 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Better order management' : 'Лучшее управление заказами'; ?>
                        </h3>
                        <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Baristas no longer check Instagram DMs constantly. Orders come to email and Telegram automatically, structured format makes it easy to see what was ordered. No lost messages, no duplicate orders. Staff can focus on making coffee instead of managing messages.'
                                : 'Бариста больше не проверяют Instagram DM постоянно. Заказы автоматически приходят на email и Telegram, структурированный формат позволяет легко увидеть, что заказано. Нет потерянных сообщений, нет дублирующихся заказов. Персонал может сосредоточиться на приготовлении кофе, а не на управлении сообщениями.'; ?>
                        </p>
                    </div>
                </div>
                
                <div class="reveal grid grid-cols-2 md:grid-cols-4 gap-4 p-6 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--color-text);">340%</div>
                        <div class="text-sm md:text-base" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Order growth' : 'Рост заказов'; ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--color-text);">92/100</div>
                        <div class="text-sm md:text-base" style="color: var(--color-text-secondary);">PageSpeed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--color-text);">1.8s</div>
                        <div class="text-sm md:text-base" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Load time' : 'Загрузка'; ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--color-text);">Top 3</div>
                        <div class="text-sm md:text-base" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Maps ranking' : 'Позиция в Maps'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Почему сработало -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Why This Solution Worked' : 'Почему это решение сработало'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en'
                        ? 'This case worked because we matched the solution to the specific problem and business context:'
                        : 'Этот кейс сработал, потому что мы подобрали решение под конкретную проблему и бизнес-контекст:'; ?>
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-4">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">1.</span>
                        <div>
                            <p class="text-lg md:text-xl leading-relaxed font-medium mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Single-page structure fit the goal' : 'Одностраничная структура соответствовала цели'; ?>
                            </p>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'Goal was specific: get orders. We didn\'t need a multi-page site with blog, portfolio, etc. Single-page landing focuses attention on the one action we want: place an order. No navigation distractions, clear path to conversion.'
                                    : 'Цель была специфична: получать заказы. Нам не нужен был многостраничный сайт с блогом, портфолио и т.д. Одностраничный лендинг фокусирует внимание на одном действии, которое мы хотим: оформить заказ. Без отвлекающей навигации, четкий путь к конверсии.'; ?>
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">2.</span>
                        <div>
                            <p class="text-lg md:text-xl leading-relaxed font-medium mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Structured information reduces friction' : 'Структурированная информация снижает трение'; ?>
                            </p>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'Menu organized by categories with filters makes it easy to find items. Order form with clear fields is faster than writing free-text messages. Every element reduces cognitive load and makes the ordering process smoother.'
                                    : 'Меню, организованное по категориям с фильтрами, упрощает поиск позиций. Форма заказа с четкими полями быстрее, чем написание текстовых сообщений. Каждый элемент снижает когнитивную нагрузку и делает процесс заказа более плавным.'; ?>
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">3.</span>
                        <div>
                            <p class="text-lg md:text-xl leading-relaxed font-medium mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Local SEO made business discoverable' : 'Локальное SEO сделало бизнес находимым'; ?>
                            </p>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'LocalBusiness schema markup is a direct signal to Google about the business. Combined with location-based content, it helps Google understand context and rank the business for local searches. This brings organic traffic from people searching for coffee in the area.'
                                    : 'Разметка LocalBusiness schema — это прямой сигнал Google о бизнесе. В сочетании с контентом с локацией это помогает Google понять контекст и ранжировать бизнес по локальным поискам. Это приносит органический трафик от людей, ищущих кофе в районе.'; ?>
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="text-xl font-bold mt-1 flex-shrink-0" style="color: var(--color-text);">4.</span>
                        <div>
                            <p class="text-lg md:text-xl leading-relaxed font-medium mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Performance optimization kept users engaged' : 'Оптимизация производительности удерживала пользователей'; ?>
                            </p>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en'
                                    ? 'Fast loading (1.8s) means customers don\'t wait. Mobile-optimized design means the page works well on phones (where most orders come from). Good performance = better user experience = more completed orders.'
                                    : 'Быстрая загрузка (1.8 сек) означает, что клиенты не ждут. Мобильно-оптимизированный дизайн означает, что страница хорошо работает на телефонах (откуда приходит большинство заказов). Хорошая производительность = лучший пользовательский опыт = больше завершенных заказов.'; ?>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Связанные услуги -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="reveal text-center mb-12">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Related Services' : 'Связанные услуги'; ?>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="<?php echo getLocalizedUrl($currentLang, '/landing-page-development'); ?>" class="reveal block p-6 rounded-lg hover:shadow-xl transition-all duration-300" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Landing Page Development' : 'Разработка лендингов'; ?>
                    </h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Need a landing page for your business?'
                            : 'Нужен лендинг для вашего бизнеса?'; ?>
                    </p>
                </a>
                
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="reveal block p-6 rounded-lg hover:shadow-xl transition-all duration-300" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'SEO Optimization' : 'SEO-оптимизация'; ?>
                    </h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Want to appear in Google Maps and local search?'
                            : 'Хотите появиться в Google Maps и локальном поиске?'; ?>
                    </p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="reveal-group py-16 md:py-24 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 md:mb-8 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Need a similar solution?' : 'Нужно похожее решение?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 leading-relaxed reveal" style="color: var(--color-text-secondary);">
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

<?php include '../../includes/footer.php'; ?>

