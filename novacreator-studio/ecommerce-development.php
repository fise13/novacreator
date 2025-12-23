<?php
/**
 * Страница услуги: Разработка интернет-магазинов
 * Отдельная SEO-страница для продвижения услуги разработки интернет-магазинов
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'E-commerce Development' : 'Разработка интернет-магазинов';
$pageMetaTitle = $currentLang === 'en' 
    ? 'E-commerce Development | Online Store Development | NovaCreator Studio'
    : 'Разработка интернет-магазинов — создание онлайн магазинов под ключ';
$pageMetaDescription = $currentLang === 'en'
    ? 'Professional e-commerce development services. Create online stores with shopping cart, payment integration, inventory management. Mobile-friendly, fast, SEO-optimized.'
    : 'Разработка интернет-магазинов под ключ. Создаем онлайн магазины с корзиной, оплатой, управлением товарами. Адаптивный дизайн, быстрая загрузка, SEO-оптимизация. Ориентир по цене от 500 000 тенге.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'e-commerce development, online store development, online shop creation, ecommerce website, shopping cart development'
    : 'разработка интернет магазина, создание интернет магазина, интернет магазин под ключ, онлайн магазин, разработка интернет магазина цена';
$pageMetaCanonical = '/ecommerce-development';

include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'E-commerce Development' : 'Разработка интернет-магазинов'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Create online stores that sell products and grow your business'
                    : 'Создаем интернет-магазины, которые продают товары и развивают ваш бизнес'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Что такое интернет-магазин -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What is an Online Store' : 'Что такое интернет-магазин'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'An online store (e-commerce website) is a website where customers can browse products, add them to a shopping cart, and purchase them. Unlike regular websites, online stores have features like product catalogs, shopping carts, payment systems, order management, and customer accounts.'
                        : 'Интернет-магазин — это сайт, где клиенты могут просматривать товары, добавлять их в корзину и покупать. В отличие от обычных сайтов, интернет-магазины имеют каталог товаров, корзину, систему оплаты, управление заказами и личные кабинеты покупателей.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'Online stores can be B2C (selling to consumers), B2B (selling to businesses), or marketplaces (multiple sellers). We create stores for all types of businesses.'
                        : 'Интернет-магазины могут быть B2C (продажа конечным потребителям), B2B (продажа бизнесу) или маркетплейсами (несколько продавцов). Мы создаем магазины для всех типов бизнеса.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Кому нужен интернет-магазин -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Who Needs an Online Store' : 'Кому нужен интернет-магазин'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Retail businesses selling products' : 'Розничные магазины, продающие товары'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you sell physical or digital products, an online store lets you reach customers beyond your physical location. You can sell 24/7, reduce overhead costs, and scale your business.'
                            : 'Если вы продаете физические или цифровые товары, интернет-магазин позволяет выйти за пределы физического местоположения. Вы можете продавать круглосуточно, снизить затраты и масштабировать бизнес.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'B2B companies with product catalogs' : 'B2B компании с каталогами товаров'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'B2B online stores simplify ordering for business customers. They can browse catalogs, check prices, place orders, and track shipments all in one place.'
                            : 'B2B интернет-магазины упрощают заказы для бизнес-клиентов. Они могут просматривать каталоги, проверять цены, размещать заказы и отслеживать доставку в одном месте.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Service businesses selling packages' : 'Сервисные компании, продающие пакеты услуг'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Even service businesses can use online stores to sell service packages, subscriptions, or digital products (courses, consultations, software).'
                            : 'Даже сервисные компании могут использовать интернет-магазины для продажи пакетов услуг, подписок или цифровых товаров (курсы, консультации, ПО).'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Когда интернет-магазин НЕ подойдет -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'When an Online Store Won\'t Work' : 'Когда интернет-магазин не подойдет'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You sell only a few products (1-5 items)' : 'Вы продаете только несколько товаров (1-5 штук)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you have just a few products, an online store is overkill. A <a href="' . getLocalizedUrl($currentLang, '/landing-page-development') . '" class="underline">landing page</a> or simple <a href="' . getLocalizedUrl($currentLang, '/corporate-website-development') . '" class="underline">corporate website</a> with a product showcase is more cost-effective and faster to develop.'
                            : 'Если у вас всего несколько товаров, интернет-магазин — избыточен. <a href="' . getLocalizedUrl($currentLang, '/landing-page-development') . '" class="underline">Лендинг</a> или простой <a href="' . getLocalizedUrl($currentLang, '/corporate-website-development') . '" class="underline">корпоративный сайт</a> с витриной товаров будет более рентабельным и быстрее разработать.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You don\'t have logistics or delivery set up' : 'У вас не налажена логистика или доставка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'An online store requires fulfillment: packaging, shipping, handling returns. If you haven\'t figured out how to deliver products to customers, start with that first. A store without delivery is useless — customers can\'t get their orders.'
                            : 'Интернет-магазин требует выполнения заказов: упаковка, доставка, обработка возвратов. Если вы еще не разобрались, как доставлять товары клиентам, сначала решите это. Магазин без доставки бесполезен — клиенты не смогут получить заказы.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You sell services, not products' : 'Вы продаете услуги, а не товары'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you provide services (consultations, repairs, design), an online store structure doesn\'t fit. You need a <a href="' . getLocalizedUrl($currentLang, '/corporate-website-development') . '" class="underline">service website</a> with contact forms, booking systems, or service descriptions. Services can\'t be "added to cart" like products.'
                            : 'Если вы предоставляете услуги (консультации, ремонт, дизайн), структура интернет-магазина не подходит. Вам нужен <a href="' . getLocalizedUrl($currentLang, '/corporate-website-development') . '" class="underline">сайт услуг</a> с формами обратной связи, системами бронирования или описаниями услуг. Услуги нельзя "добавить в корзину", как товары.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You sell only locally with no shipping' : 'Вы продаете только локально, без доставки'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If customers must come to your physical location to buy (e.g., furniture that requires viewing, custom-made items), a full e-commerce store with checkout is unnecessary. A website with a catalog and contact information is sufficient — customers browse online, then visit in person.'
                            : 'Если клиенты должны приехать в ваше физическое местоположение для покупки (например, мебель, которую нужно посмотреть, изделия на заказ), полноценный интернет-магазин с оформлением заказа не нужен. Сайт с каталогом и контактами достаточен — клиенты просматривают онлайн, затем приезжают лично.'; ?>
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
                    <?php echo $currentLang === 'en' ? 'What\'s Included in Development' : 'Что включает разработка интернет-магазина'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '1. Product catalog' : '1. Каталог товаров'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Product pages with photos, descriptions, prices, variants (size, color, etc.), filters, and search. Categories and subcategories for easy navigation.'
                            : 'Страницы товаров с фотографиями, описаниями, ценами, вариантами (размер, цвет и т.д.), фильтры и поиск. Категории и подкатегории для удобной навигации.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '2. Shopping cart and checkout' : '2. Корзина и оформление заказа'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Shopping cart where customers can add/remove products, change quantities. Checkout process with delivery options, payment methods, and order confirmation.'
                            : 'Корзина, где покупатели могут добавлять/удалять товары, менять количество. Процесс оформления заказа с выбором доставки, способов оплаты и подтверждением заказа.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '3. Payment integration' : '3. Интеграция оплаты'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Integration with payment systems: bank cards, online banking, electronic wallets. Secure payment processing with SSL certificates and PCI compliance.'
                            : 'Интеграция с платежными системами: банковские карты, онлайн-банкинг, электронные кошельки. Безопасная обработка платежей с SSL-сертификатами.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '4. Admin panel' : '4. Админ-панель'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Admin panel for managing products, orders, customers, inventory, delivery settings, discounts, and promotions. Simple interface for non-technical users.'
                            : 'Админ-панель для управления товарами, заказами, клиентами, складом, настройками доставки, скидками и акциями. Простой интерфейс для нетехнических пользователей.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '5. Customer accounts' : '5. Личные кабинеты покупателей'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Customer registration and login, order history, saved addresses, wishlists, personal discounts. This improves customer retention and repeat purchases.'
                            : 'Регистрация и вход покупателей, история заказов, сохраненные адреса, избранное, персональные скидки. Это улучшает удержание клиентов и повторные покупки.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '6. SEO optimization' : '6. SEO-оптимизация'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'SEO-ready structure: clean URLs, meta tags, schema.org markup for products, fast loading, mobile-friendly design. This helps your store rank in search engines.'
                            : 'SEO-готовость: чистые URL, мета-теги, schema.org разметка для товаров, быстрая загрузка, мобильная версия. Это помогает магазину ранжироваться в поисковиках.'; ?>
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
                        <?php echo $currentLang === 'en' ? '24/7 online sales' : 'Продажи онлайн 24/7'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Your store works around the clock — customers can browse products, place orders, and pay at any time, even when your physical store is closed. This expands your sales opportunities and allows you to reach customers beyond your local area.'
                            : 'Ваш магазин работает круглосуточно — клиенты могут просматривать товары, размещать заказы и платить в любое время, даже когда ваш физический магазин закрыт. Это расширяет возможности продаж и позволяет охватывать клиентов за пределами вашего региона.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Automated order processing' : 'Автоматизированная обработка заказов'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Orders come to your admin panel automatically. You see new orders immediately, can track their status, update inventory, process payments. This reduces manual work and errors compared to taking orders by phone or email.'
                            : 'Заказы поступают в вашу админ-панель автоматически. Вы видите новые заказы сразу, можете отслеживать их статус, обновлять склад, обрабатывать платежи. Это снижает ручную работу и ошибки по сравнению с приемом заказов по телефону или email.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Scalable business growth' : 'Масштабируемый рост бизнеса'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'An online store can handle thousands of products and orders without proportional increase in costs. You can add new products, expand to new regions, increase traffic — the store infrastructure scales with your business. Physical stores have space and staffing limits; online stores can grow much larger.'
                            : 'Интернет-магазин может обрабатывать тысячи товаров и заказов без пропорционального увеличения затрат. Вы можете добавлять новые товары, расширяться в новые регионы, увеличивать трафик — инфраструктура магазина масштабируется с вашим бизнесом. Физические магазины имеют ограничения по площади и персоналу; интернет-магазины могут расти намного больше.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Customer data and analytics' : 'Данные клиентов и аналитика'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You see detailed analytics: which products sell best, which pages visitors view, where they come from, what the conversion rates are. You can segment customers, send targeted emails, create personalized offers. This data helps you make informed decisions and improve sales.'
                            : 'Вы видите детальную аналитику: какие товары продаются лучше, какие страницы просматривают посетители, откуда они приходят, какая конверсия. Вы можете сегментировать клиентов, отправлять целевые email, создавать персонализированные предложения. Эти данные помогают принимать обоснованные решения и улучшать продажи.'; ?>
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
                    <?php echo $currentLang === 'en' ? 'Development Timeline' : 'Этапы разработки'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Week 1-2: Planning and design' : 'Недели 1-2: Планирование и дизайн'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We discuss requirements, product structure, payment and delivery options. We create a design that matches your brand and focuses on conversion. You approve the design before development starts.'
                            : 'Обсуждаем требования, структуру товаров, способы оплаты и доставки. Создаем дизайн, который соответствует вашему бренду и сфокусирован на конверсии. Вы утверждаете дизайн до начала разработки.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Week 3-6: Development' : 'Недели 3-6: Разработка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We code the store, set up the database, integrate payment systems, create the admin panel. We test all functions and fix bugs. You can track progress and test features as they are completed.'
                            : 'Верстаем магазин, настраиваем базу данных, интегрируем платежные системы, создаем админ-панель. Тестируем все функции и исправляем ошибки. Вы можете отслеживать прогресс и тестировать функции по мере их готовности.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Week 7-8: Testing and launch' : 'Недели 7-8: Тестирование и запуск'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We thoroughly test all functions: adding products, shopping cart, checkout, payments, admin panel. We fix any issues, deploy to your hosting, and train you on how to use the admin panel.'
                            : 'Тщательно тестируем все функции: добавление товаров, корзина, оформление заказа, оплата, админ-панель. Исправляем найденные проблемы, размещаем на вашем хостинге и обучаем работе с админ-панелью.'; ?>
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
                            ? 'Simple online store (up to 100 products): 6-8 weeks. Standard store (100-500 products): 8-10 weeks. Complex store (500+ products, multiple integrations): 10-12 weeks.'
                            : 'Простой интернет-магазин (до 100 товаров): 6-8 недель. Стандартный магазин (100-500 товаров): 8-10 недель. Сложный магазин (500+ товаров, множественные интеграции): 10-12 недель.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Pricing' : 'Ориентиры по цене'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Simple store: from 500,000 KZT (≈$1,000). Standard store: from 800,000 KZT (≈$1,600). Complex store: from 1,200,000 KZT (≈$2,400). Price depends on number of products, integrations, and custom features.'
                            : 'Простой магазин: от 500 000 тенге. Стандартный магазин: от 800 000 тенге. Сложный магазин: от 1 200 000 тенге. Цена зависит от количества товаров, интеграций и кастомных функций.'; ?>
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
                        <?php echo $currentLang === 'en' ? 'Can I add products myself after launch?' : 'Смогу ли я добавлять товары самостоятельно после запуска?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Yes. The admin panel we create allows you to add products, edit prices, manage inventory, and process orders. We provide training on how to use it. No technical knowledge required.'
                            : 'Да. Админ-панель, которую мы создаем, позволяет вам добавлять товары, редактировать цены, управлять складом и обрабатывать заказы. Мы проводим обучение работе с ней. Технические знания не требуются.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What payment methods can you integrate?' : 'Какие способы оплаты вы можете интегрировать?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We integrate bank cards (Visa, Mastercard), online banking, electronic wallets, and cash on delivery if needed. We work with payment aggregators that support Kazakhstan and international payments.'
                            : 'Интегрируем банковские карты (Visa, Mastercard), онлайн-банкинг, электронные кошельки, наличные при получении при необходимости. Работаем с платежными агрегаторами, которые поддерживают Казахстан и международные платежи.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Do you provide hosting and domain?' : 'Вы предоставляете хостинг и домен?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We can help you choose and set up hosting, but hosting and domain are paid separately by you. We recommend reliable hosting providers and help with setup. Hosting costs typically 5,000-15,000 KZT per month.'
                            : 'Мы можем помочь выбрать и настроить хостинг, но хостинг и домен оплачиваете вы отдельно. Рекомендуем надежных хостинг-провайдеров и помогаем с настройкой. Хостинг обычно стоит 5 000-15 000 тенге в месяц.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Will the store work on mobile phones?' : 'Будет ли магазин работать на телефонах?'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Yes. All stores we create are fully responsive — they work perfectly on phones, tablets, and desktops. Mobile shopping is important, so we ensure the mobile experience is smooth and user-friendly.'
                            : 'Да. Все магазины, которые мы создаем, полностью адаптивные — они отлично работают на телефонах, планшетах и компьютерах. Мобильные покупки важны, поэтому мы обеспечиваем плавный и удобный опыт на мобильных устройствах.'; ?>
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
                <?php echo $currentLang === 'en' ? 'Ready to Create Your Online Store?' : 'Готовы создать интернет-магазин?'; ?>
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

