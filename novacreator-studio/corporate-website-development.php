<?php
/**
 * Страница услуги: Разработка корпоративных сайтов
 * Отдельная SEO-страница для продвижения услуги разработки корпоративных сайтов
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'Corporate Website Development' : 'Разработка корпоративных сайтов';
$pageMetaTitle = $currentLang === 'en' 
    ? 'Corporate Website Development | Business Website Design | NovaCreator Studio'
    : 'Разработка корпоративных сайтов — создание сайтов для бизнеса под ключ';
$pageMetaDescription = $currentLang === 'en'
    ? 'Professional corporate website development services. Create modern, SEO-optimized business websites. Multi-page websites with services, portfolio, blog sections. Responsive design, fast loading, mobile-friendly.'
    : 'Разработка корпоративных сайтов под ключ. Создаем современные многостраничные сайты для бизнеса с разделами услуг, портфолио, блога. Адаптивный дизайн, быстрая загрузка, SEO-оптимизация. Ориентир по цене от 300 000 тенге.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'corporate website development, business website design, company website creation, corporate website builder, business website development'
    : 'разработка корпоративных сайтов, создание корпоративного сайта, сайт для компании, корпоративный сайт под ключ, разработка сайта компании';
$pageMetaCanonical = '/corporate-website-development';

include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Corporate Website Development' : 'Разработка корпоративных сайтов'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Create a professional multi-page website that represents your business online'
                    : 'Создаем многостраничные сайты, которые представляют ваш бизнес в интернете'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Что такое корпоративный сайт -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What is a Corporate Website' : 'Что такое корпоративный сайт'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'A corporate website is a multi-page website that represents your business online. Unlike landing pages (single-page), corporate websites have multiple sections: homepage, about us, services, portfolio, blog, contact. It serves as your company\'s digital presence — a place where potential customers learn about your business, services, and expertise.'
                        : 'Корпоративный сайт — это многостраничный сайт, который представляет ваш бизнес в интернете. В отличие от лендингов (одностраничных), корпоративные сайты имеют несколько разделов: главная, о компании, услуги, портфолио, блог, контакты. Это ваше цифровое представительство — место, где потенциальные клиенты узнают о вашем бизнесе, услугах и экспертизе.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'Corporate websites are typically used for businesses that provide services (consulting, design, development, legal, medical) or have multiple products/services to showcase. They work well for both organic promotion (SEO) and advertising campaigns.'
                        : 'Корпоративные сайты обычно используются для бизнесов, которые предоставляют услуги (консалтинг, дизайн, разработка, юридические, медицинские) или имеют множество товаров/услуг для демонстрации. Они хорошо работают как для органического продвижения (SEO), так и для рекламных кампаний.'; ?>
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
                    <?php echo $currentLang === 'en' ? 'Who Needs a Corporate Website' : 'Кому нужен корпоративный сайт'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Service businesses' : 'Сервисные компании'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Consulting firms, design studios, development agencies, legal services, medical clinics — any business that provides services needs a website to showcase expertise, case studies, and contact information. A corporate website builds trust and credibility.'
                            : 'Консалтинговые компании, дизайн-студии, агентства разработки, юридические услуги, медицинские клиники — любой бизнес, предоставляющий услуги, нуждается в сайте для демонстрации экспертизы, кейсов и контактной информации. Корпоративный сайт формирует доверие и авторитет.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Companies with multiple services or products' : 'Компании с несколькими услугами или товарами'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you offer several services or products, you need separate pages for each. A corporate website structure allows you to organize content: separate pages for different services, categories, portfolio items. A landing page can\'t handle multiple offers effectively.'
                            : 'Если вы предлагаете несколько услуг или товаров, нужны отдельные страницы для каждой. Структура корпоративного сайта позволяет организовать контент: отдельные страницы для разных услуг, категорий, работ. Лендинг не может эффективно представить множество предложений.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Businesses that plan long-term online presence' : 'Бизнесы, планирующие долгосрочное присутствие в интернете'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you want to build a brand, publish content regularly (blog, news), and grow organically through SEO, a corporate website is the right choice. It allows you to add new pages, publish articles, build authority over time. A landing page is too limited for long-term content strategy.'
                            : 'Если вы хотите строить бренд, регулярно публиковать контент (блог, новости) и расти органически через SEO, корпоративный сайт — правильный выбор. Он позволяет добавлять новые страницы, публиковать статьи, строить авторитет со временем. Лендинг слишком ограничен для долгосрочной контент-стратегии.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Когда корпоративный сайт НЕ подойдет -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'When a Corporate Website Won\'t Work' : 'Когда корпоративный сайт не подойдет'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You need to sell products online' : 'Вам нужно продавать товары онлайн'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you sell physical or digital products and need shopping cart, checkout, payment integration, you need an <a href="' . getLocalizedUrl($currentLang, '/ecommerce-development') . '" class="underline">e-commerce store</a>, not a corporate website. Corporate sites are for services and information, not online sales.'
                            : 'Если вы продаете физические или цифровые товары и нужны корзина, оформление заказа, интеграция платежей, вам нужен <a href="' . getLocalizedUrl($currentLang, '/ecommerce-development') . '" class="underline">интернет-магазин</a>, а не корпоративный сайт. Корпоративные сайты для услуг и информации, а не для онлайн-продаж.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You\'re promoting one specific product or offer' : 'Вы продвигаете один конкретный товар или предложение'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you\'re running an advertising campaign for a single product, service, or promotion, a <a href="' . getLocalizedUrl($currentLang, '/landing-page-development') . '" class="underline">landing page</a> is more effective. Landing pages focus attention on one goal, while corporate websites have multiple pages that can distract visitors.'
                            : 'Если вы запускаете рекламную кампанию для одного товара, услуги или акции, <a href="' . getLocalizedUrl($currentLang, '/landing-page-development') . '" class="underline">лендинг</a> более эффективен. Лендинги концентрируют внимание на одной цели, а корпоративные сайты имеют множество страниц, которые могут отвлекать посетителей.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You have a very limited budget' : 'У вас очень ограниченный бюджет'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Corporate websites cost more than landing pages because they have more pages and features. If your budget is very limited (less than 200,000 KZT), start with a landing page to test your idea. If it works, invest in a full corporate website later.'
                            : 'Корпоративные сайты стоят дороже лендингов, потому что у них больше страниц и функций. Если ваш бюджет очень ограничен (меньше 200 000 тенге), начните с лендинга, чтобы протестировать идею. Если работает, инвестируйте в полноценный корпоративный сайт позже.'; ?>
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
                        <?php echo $currentLang === 'en' ? 'Professional online presence' : 'Профессиональное присутствие в интернете'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Your website serves as your company\'s digital business card. Potential customers can learn about your services, see your portfolio, read about your team, and contact you. A well-designed corporate website builds trust and credibility — it shows that you\'re a serious, established business.'
                            : 'Ваш сайт служит цифровой визитной карточкой компании. Потенциальные клиенты могут узнать о ваших услугах, посмотреть портфолио, прочитать о команде и связаться с вами. Хорошо спроектированный корпоративный сайт формирует доверие и авторитет — показывает, что вы серьезный, состоявшийся бизнес.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Ability to promote organically (SEO)' : 'Возможность продвижения органически (SEO)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Corporate websites have multiple pages, which allows you to target different keywords and queries. You can optimize each page for specific searches, publish blog content, build internal linking. This enables long-term organic growth through <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a> — free traffic that doesn\'t require ongoing advertising payments.'
                            : 'Корпоративные сайты имеют множество страниц, что позволяет таргетировать разные ключевые слова и запросы. Вы можете оптимизировать каждую страницу под конкретные поисковые запросы, публиковать контент в блоге, строить внутреннюю перелинковку. Это обеспечивает долгосрочный органический рост через <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a> — бесплатный трафик, который не требует постоянных платежей за рекламу.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Room for growth and updates' : 'Место для роста и обновлений'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You can add new pages, publish blog posts, add new services, update portfolio — corporate websites are designed to grow with your business. Unlike landing pages, which are static, corporate sites can be regularly updated with fresh content, which helps with SEO and keeps visitors engaged.'
                            : 'Вы можете добавлять новые страницы, публиковать статьи в блоге, добавлять новые услуги, обновлять портфолио — корпоративные сайты созданы для роста вместе с вашим бизнесом. В отличие от лендингов, которые статичны, корпоративные сайты можно регулярно обновлять свежим контентом, что помогает с SEO и удерживает посетителей.'; ?>
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
                    <?php echo $currentLang === 'en' ? 'What\'s Included in Development' : 'Что включает разработка корпоративного сайта'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '1. Site structure and pages' : '1. Структура сайта и страницы'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We create a logical site structure with all necessary pages: homepage, about us, services (separate page for each service), portfolio/case studies, blog/news, contact. Navigation menu, footer, breadcrumbs — everything for easy navigation.'
                            : 'Создаем логичную структуру сайта со всеми необходимыми страницами: главная, о компании, услуги (отдельная страница для каждой услуги), портфолио/кейсы, блог/новости, контакты. Меню навигации, футер, хлебные крошки — всё для удобной навигации.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '2. Design and layout' : '2. Дизайн и верстка'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We create a design that matches your brand identity — colors, fonts, style. All pages are responsive (mobile, tablet, desktop), optimized for fast loading, accessible for users with disabilities.'
                            : 'Создаем дизайн, который соответствует идентичности вашего бренда — цвета, шрифты, стиль. Все страницы адаптивные (мобильные, планшет, десктоп), оптимизированы для быстрой загрузки, доступны для пользователей с ограниченными возможностями.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '3. Content creation' : '3. Написание контента'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We write clear, informative texts for all pages: service descriptions, about us page, portfolio items. Content is optimized for both users (easy to understand) and search engines (SEO-friendly).'
                            : 'Пишем понятные, информативные тексты для всех страниц: описания услуг, страница о компании, работы в портфолио. Контент оптимизирован как для пользователей (легко понять), так и для поисковиков (SEO-friendly).'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '4. Contact forms and integrations' : '4. Формы обратной связи и интеграции'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Contact forms that send notifications to email or Telegram. Integration with CRM systems, analytics (Google Analytics), maps (Google Maps, Yandex Maps), social media widgets.'
                            : 'Формы обратной связи, которые отправляют уведомления на email или Telegram. Интеграция с CRM-системами, аналитикой (Google Analytics), картами (Google Maps, Яндекс.Карты), виджетами социальных сетей.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? '5. SEO optimization' : '5. SEO-оптимизация'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Technical SEO: meta tags, semantic markup (Schema.org), sitemap.xml, robots.txt, fast loading, mobile-friendly. Content SEO: keyword optimization, internal linking structure. The site is ready for organic promotion.'
                            : 'Техническое SEO: мета-теги, семантическая разметка (Schema.org), sitemap.xml, robots.txt, быстрая загрузка, мобильная версия. Контентное SEO: оптимизация ключевых слов, структура внутренней перелинковки. Сайт готов к органическому продвижению.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Этапы работы -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'How We Work' : 'Этапы работы'; ?>
                </h2>
            </div>
            
            <div class="space-y-12">
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">1</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Week 1: Brief and planning' : 'Неделя 1: Бриф и планирование'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We discuss your goals, target audience, required pages, brand identity. We create a site structure map and content plan. We define design direction and technical requirements.'
                                    : 'Обсуждаем ваши цели, целевую аудиторию, необходимые страницы, идентичность бренда. Создаем карту структуры сайта и план контента. Определяем направление дизайна и технические требования.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: provide information, approve structure' : 'Ваше участие: предоставить информацию, утвердить структуру'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">2</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Week 2-3: Design' : 'Недели 2-3: Дизайн'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We create design mockups for key pages (homepage, service page, about page). You review and provide feedback. We refine design based on your comments. Once approved, we proceed to development.'
                                    : 'Создаем дизайн-макеты для ключевых страниц (главная, страница услуги, о компании). Вы просматриваете и даете обратную связь. Уточняем дизайн по вашим замечаниям. После утверждения переходим к разработке.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: review designs, provide feedback' : 'Ваше участие: просмотреть дизайны, дать обратную связь'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">3</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Week 4-6: Development' : 'Недели 4-6: Разработка'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We code all pages, implement responsive design, set up forms and integrations, optimize for speed and SEO. We test on different devices and browsers. You can review progress in a staging environment.'
                                    : 'Верстаем все страницы, реализуем адаптивный дизайн, настраиваем формы и интеграции, оптимизируем скорость и SEO. Тестируем на разных устройствах и браузерах. Вы можете просматривать прогресс в тестовой среде.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: test pages, report issues' : 'Ваше участие: тестировать страницы, сообщать о проблемах'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">4</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Week 7: Testing and launch' : 'Неделя 7: Тестирование и запуск'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'Final testing, fixing any issues, content adjustments. We set up hosting, domain, SSL certificate. We launch the site and ensure everything works correctly. We provide documentation and training on content management.'
                                    : 'Финальное тестирование, исправление проблем, корректировки контента. Настраиваем хостинг, домен, SSL-сертификат. Запускаем сайт и убеждаемся, что всё работает правильно. Предоставляем документацию и обучение по управлению контентом.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: final approval, test all features' : 'Ваше участие: финальное утверждение, тестирование всех функций'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Сроки -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Timeline' : 'Сроки'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Standard timeline: 7-8 weeks' : 'Стандартные сроки: 7-8 недель'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'A typical corporate website (5-10 pages) takes 7-8 weeks from start to launch. This includes planning, design, development, content creation, testing. Complex sites with more pages or features may take 10-12 weeks.'
                            : 'Типичный корпоративный сайт (5-10 страниц) занимает 7-8 недель от начала до запуска. Это включает планирование, дизайн, разработку, создание контента, тестирование. Сложные сайты с большим количеством страниц или функций могут занять 10-12 недель.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What affects the timeline' : 'От чего зависят сроки'; ?>
                    </h3>
                    <ul class="space-y-3 text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <li>• <?php echo $currentLang === 'en' ? 'Number of pages: more pages = longer timeline' : 'Количество страниц: больше страниц = дольше сроки'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Design complexity: custom design takes longer than template-based' : 'Сложность дизайна: уникальный дизайн занимает дольше, чем шаблонный'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Content availability: if you provide content quickly, we move faster' : 'Доступность контента: если вы быстро предоставляете контент, мы двигаемся быстрее'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Feedback speed: quick approvals speed up the process' : 'Скорость обратной связи: быстрые утверждения ускоряют процесс'; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ориентиры по цене -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Pricing Guide' : 'Ориентиры по цене'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Basic corporate website: from 300,000 KZT ($600)' : 'Базовый корпоративный сайт: от 300 000 тенге'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? '5-7 pages (homepage, about, 2-3 service pages, contact), basic design, responsive layout, contact forms, SEO optimization. Suitable for small service businesses.'
                            : '5-7 страниц (главная, о компании, 2-3 страницы услуг, контакты), базовый дизайн, адаптивная верстка, формы обратной связи, SEO-оптимизация. Подходит для небольших сервисных компаний.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Standard corporate website: from 500,000 KZT ($1000)' : 'Стандартный корпоративный сайт: от 500 000 тенге'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? '8-12 pages (homepage, about, 5-7 service pages, portfolio, blog, contact), custom design, advanced features (blog system, portfolio gallery, FAQ section), integrations (CRM, analytics), comprehensive SEO optimization.'
                            : '8-12 страниц (главная, о компании, 5-7 страниц услуг, портфолио, блог, контакты), уникальный дизайн, расширенные функции (система блога, галерея портфолио, раздел FAQ), интеграции (CRM, аналитика), комплексная SEO-оптимизация.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Enterprise corporate website: from 800,000 KZT ($1600)' : 'Премиум корпоративный сайт: от 800 000 тенге'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? '15+ pages, premium custom design, advanced functionality (multilingual support, client portal, advanced forms), complex integrations, dedicated support, comprehensive content strategy.'
                            : '15+ страниц, премиум уникальный дизайн, расширенная функциональность (многоязычность, клиентский портал, продвинутые формы), сложные интеграции, приоритетная поддержка, комплексная контент-стратегия.'; ?>
                    </p>
                </div>
                
                <div class="reveal p-6 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What affects the price' : 'Что влияет на цену'; ?>
                    </h3>
                    <ul class="space-y-2 text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <li>• <?php echo $currentLang === 'en' ? 'Number of pages: more pages = higher cost' : 'Количество страниц: больше страниц = выше стоимость'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Design complexity: custom design costs more than template-based' : 'Сложность дизайна: уникальный дизайн стоит дороже шаблонного'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Features and integrations: advanced features add to the cost' : 'Функции и интеграции: расширенные функции увеличивают стоимость'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Content creation: if we write all content, it costs extra' : 'Создание контента: если мы пишем весь контент, это стоит дополнительно'; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Frequently Asked Questions' : 'Частые вопросы'; ?>
                </h2>
            </div>
            
            <div itemscope itemtype="https://schema.org/FAQPage" class="space-y-6">
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'How is a corporate website different from a landing page?' : 'Чем корпоративный сайт отличается от лендинга?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'A landing page is a single page focused on one offer — it works best with advertising campaigns. A corporate website has multiple pages (services, portfolio, blog) and serves as a long-term online presence. Corporate sites can be promoted organically through SEO, while landing pages are usually for paid traffic.'
                                : 'Лендинг — это одна страница, сфокусированная на одном предложении — лучше всего работает с рекламными кампаниями. Корпоративный сайт имеет множество страниц (услуги, портфолио, блог) и служит долгосрочным присутствием в интернете. Корпоративные сайты можно продвигать органически через SEO, а лендинги обычно для платного трафика.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Can I update content myself after launch?' : 'Смогу ли я обновлять контент самостоятельно после запуска?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'It depends on the platform. If we build on a CMS (content management system) like WordPress, you can update text, images, add blog posts yourself through an admin panel. If we build a static site (HTML/CSS), you\'ll need us to make updates. We can provide training on content management after launch.'
                                : 'Зависит от платформы. Если мы строим на CMS (системе управления контентом) как WordPress, вы можете обновлять тексты, изображения, добавлять статьи в блог самостоятельно через админ-панель. Если мы строим статический сайт (HTML/CSS), вам понадобится наша помощь для обновлений. Мы можем предоставить обучение по управлению контентом после запуска.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Do I need hosting and domain separately?' : 'Нужны ли хостинг и домен отдельно?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Yes. Hosting and domain are separate costs (typically 5,000-15,000 KZT/month for hosting, 3,000-10,000 KZT/year for domain). We can help you choose and set up hosting and domain, or you can handle it yourself. The development cost doesn\'t include hosting/domain — those are ongoing operational costs.'
                                : 'Да. Хостинг и домен — это отдельные расходы (обычно 5 000-15 000 тенге/месяц за хостинг, 3 000-10 000 тенге/год за домен). Мы можем помочь выбрать и настроить хостинг и домен, или вы можете сделать это сами. Стоимость разработки не включает хостинг/домен — это постоянные операционные расходы.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-12 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Ready to Create Your Corporate Website?' : 'Готовы создать корпоративный сайт?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Contact us for a free consultation. We\'ll discuss your needs and create a proposal.'
                    : 'Свяжитесь с нами для бесплатной консультации. Обсудим ваши потребности и составим предложение.'; ?>
            </p>
            <div class="reveal">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Get Consultation' : 'Получить консультацию'; ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

