<?php
/**
 * Страница SEO-услуг
 * Переписана по новому шаблону: ясный контент, экспертность, ответы на реальные вопросы
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'SEO Optimization' : 'SEO оптимизация';
$pageMetaTitle = $currentLang === 'en' 
    ? 'SEO Optimization Services | Website Promotion | NovaCreator Studio'
    : 'SEO оптимизация сайта — продвижение в Google и Яндекс от 50 000 тенге';
$pageMetaDescription = $currentLang === 'en'
    ? 'SEO optimization services for website promotion in Google and Yandex. Technical SEO, content optimization, link building. Results in 3-6 months. Pricing from $100/month.'
    : 'SEO оптимизация сайта для продвижения в Google и Яндекс. Технический SEO, оптимизация контента, построение ссылок. Результаты через 3-6 месяцев. Цены от 50 000 тенге/месяц.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'seo optimization, seo services, website promotion, seo agency, technical seo'
    : 'seo оптимизация, seo продвижение, продвижение сайта, seo услуги, технический seo';
$pageMetaCanonical = '/seo';

include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'SEO Optimization' : 'SEO оптимизация'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Promote your website in Google and Yandex search results'
                    : 'Продвигаем ваш сайт в результатах поиска Google и Яндекс'; ?>
            </p>
        </div>
    </div>
</section>

<!-- Вступление: что это, для кого, какую проблему решает -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'What is SEO Optimization' : 'Что такое SEO-оптимизация'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'SEO (Search Engine Optimization) is work on your website so that it appears in the top search results when people search for your products or services in Google or Yandex. The goal is to get free organic traffic — visitors who find you through search, not through advertising.'
                        : 'SEO-оптимизация — это работа над вашим сайтом, чтобы он появлялся в топе результатов поиска, когда люди ищут ваши товары или услуги в Google или Яндекс. Цель — получить бесплатный органический трафик: посетителей, которые находят вас через поиск, а не через рекламу.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'SEO includes three main areas: technical optimization (site speed, mobile version, correct indexing), content optimization (texts, meta tags, structure), and link building (getting quality links from other sites).'
                        : 'SEO включает три основных направления: техническую оптимизацию (скорость сайта, мобильная версия, правильная индексация), оптимизацию контента (тексты, мета-теги, структура) и построение ссылок (получение качественных ссылок с других сайтов).'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'The main problem that SEO solves: your website exists, but customers don\'t find it in search. You have to pay for advertising every month, while your competitors get free traffic. SEO helps you get visitors without constant advertising costs — but it takes time: first results appear in 3-6 months.'
                        : 'Основная проблема, которую решает SEO: ваш сайт существует, но клиенты не находят его в поиске. Вам приходится постоянно платить за рекламу, пока конкуренты получают бесплатный трафик. SEO помогает получать посетителей без постоянных затрат на рекламу — но это требует времени: первые результаты появляются через 3-6 месяцев.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Когда эта услуга действительно нужна -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'When SEO is Really Needed' : 'Когда SEO действительно нужна'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Your website doesn\'t appear in search results' : 'Ваш сайт не появляется в результатах поиска'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You search for your services in Google or Yandex, but your site is on page 5-10 or not found at all. Meanwhile, competitors are in the top. This means your site is not optimized for search engines.'
                            : 'Вы ищете свои услуги в Google или Яндекс, но ваш сайт на 5-10 странице или вообще не находится. При этом конкуренты в топе. Это значит, ваш сайт не оптимизирован для поисковиков.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You pay a lot for advertising and want to reduce costs' : 'Вы много платите за рекламу и хотите снизить затраты'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Advertising works, but you want to get visitors without monthly payments. SEO gives organic traffic — people find you through search without clicking on ads. This reduces dependence on advertising budgets.'
                            : 'Реклама работает, но вы хотите получать посетителей без ежемесячных платежей. SEO дает органический трафик — люди находят вас через поиск, не кликая на рекламу. Это снижает зависимость от рекламных бюджетов.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Your business operates in a competitive niche' : 'Ваш бизнес работает в конкурентной нише'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'There are many competitors in your field, and they all invest in SEO. If you don\'t optimize your site, you\'ll lose positions. SEO helps you compete for top positions in search results.'
                            : 'В вашей нише много конкурентов, и все они вкладываются в SEO. Если вы не оптимизируете сайт, вы теряете позиции. SEO помогает конкурировать за топовые места в поисковой выдаче.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You have a content site or blog' : 'У вас контентный сайт или блог'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you publish articles, guides, or educational content, SEO is essential. People search for information, and optimized content ranks higher. SEO helps your articles get found by the right audience.'
                            : 'Если вы публикуете статьи, гайды или образовательный контент, SEO обязательна. Люди ищут информацию, и оптимизированный контент ранжируется выше. SEO помогает вашим статьям находить нужную аудиторию.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Когда SEO НЕ подойдет (важный раздел!) -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'When SEO Won\'t Help' : 'Когда SEO не подойдет'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You need results immediately (in 1-2 weeks)' : 'Вам нужны результаты немедленно (за 1-2 недели)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'SEO is a long-term strategy. First results appear in 3-4 months, significant results — in 6-12 months. If you need traffic right now, use <a href="' . getLocalizedUrl($currentLang, '/ads') . '" class="underline">contextual advertising</a> — it starts working within days.'
                            : 'SEO — это долгосрочная стратегия. Первые результаты появляются через 3-4 месяца, значительные — через 6-12 месяцев. Если вам нужен трафик прямо сейчас, используйте <a href="' . getLocalizedUrl($currentLang, '/ads') . '" class="underline">контекстную рекламу</a> — она начинает работать в течение дней.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Your product/service is very niche with few searches' : 'Ваш товар/услуга очень нишевая, по ней мало поисков'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If people don\'t search for what you offer (for example, a very specific B2B service with 10 searches per month), SEO won\'t bring traffic. In this case, direct sales, advertising, or industry-specific platforms work better.'
                            : 'Если люди не ищут то, что вы предлагаете (например, очень специфичная B2B-услуга с 10 запросами в месяц), SEO не принесет трафик. В этом случае работают прямые продажи, реклама или отраслевые площадки.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You have a one-time campaign or promotion' : 'У вас разовая кампания или акция'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'SEO is for long-term promotion. If you\'re running a seasonal sale or one-time event, advertising is more effective. SEO takes months to work, and by the time you see results, your promotion may already be over.'
                            : 'SEO — для долгосрочного продвижения. Если вы проводите сезонную акцию или разовое мероприятие, реклама эффективнее. SEO работает месяцами, и к моменту появления результатов ваша акция может уже закончиться.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You sell only offline or through specific channels' : 'Вы продаете только офлайн или через специфические каналы'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If your business doesn\'t depend on online searches (for example, you sell through personal contacts, industry exhibitions, or specialized platforms), SEO may not be a priority. Focus on channels that actually bring you customers.'
                            : 'Если ваш бизнес не зависит от онлайн-поиска (например, вы продаете через личные контакты, отраслевые выставки или специализированные площадки), SEO может быть не приоритетом. Сфокусируйтесь на каналах, которые реально приносят вам клиентов.'; ?>
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
                        <?php echo $currentLang === 'en' ? 'Growth in organic traffic' : 'Рост органического трафика'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'After 3-6 months of work, your site starts getting more visitors from search engines. Traffic grows gradually: first you see positions improving, then clicks increase, then conversions. Typical growth: 30-100% in the first year, depending on the niche and competition.'
                            : 'Через 3-6 месяцев работы ваш сайт начинает получать больше посетителей из поисковиков. Трафик растет постепенно: сначала улучшаются позиции, потом растут клики, затем конверсии. Типичный рост: 30-100% в первый год, в зависимости от ниши и конкуренции.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Top-10 positions for target queries' : 'Позиции в топ-10 по целевым запросам'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Your site appears on the first page of search results for queries that your potential customers use. For example, "website development Almaty" or "SEO services Kazakhstan". The first page gets 90% of clicks, so being in the top-10 is crucial.'
                            : 'Ваш сайт появляется на первой странице результатов поиска по запросам, которые используют ваши потенциальные клиенты. Например, "разработка сайтов алматы" или "seo услуги казахстан". На первую страницу приходится 90% кликов, поэтому попадание в топ-10 критично.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Reduced dependence on advertising' : 'Снижение зависимости от рекламы'; ?>
                    </p>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'As organic traffic grows, you can reduce your advertising budget or reallocate it to other channels. You still get customers, but some come for free through search. This improves profitability.'
                            : 'По мере роста органического трафика вы можете снизить рекламный бюджет или перенаправить его на другие каналы. Клиенты все равно приходят, но часть — бесплатно через поиск. Это улучшает прибыльность.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Better site quality and user experience' : 'Улучшение качества сайта и пользовательского опыта'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'SEO includes fixing technical issues: speeding up the site, improving mobile version, fixing errors. This makes the site better not only for search engines, but also for users. They stay longer, convert better, and return more often.'
                            : 'SEO включает исправление технических проблем: ускорение сайта, улучшение мобильной версии, исправление ошибок. Это делает сайт лучше не только для поисковиков, но и для пользователей. Они остаются дольше, лучше конвертируются и чаще возвращаются.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Как мы работаем -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'How We Work' : 'Как мы работаем'; ?>
                </h2>
            </div>
            
            <div class="space-y-12">
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">1</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Technical audit and site analysis' : 'Технический аудит и анализ сайта'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We check how your site is indexed, how fast it loads, whether it works on mobile, whether there are errors. We analyze competitors and identify key queries. We create a report with problems and a plan to fix them. Duration: 3-5 business days.'
                                    : 'Проверяем, как индексируется ваш сайт, как быстро загружается, работает ли на мобильных, есть ли ошибки. Анализируем конкурентов и определяем ключевые запросы. Составляем отчет с проблемами и планом их устранения. Срок: 3-5 рабочих дней.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: provide access to the site, answer questions about the business' : 'Ваше участие: предоставить доступ к сайту, ответить на вопросы о бизнесе'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">2</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Fixing technical issues' : 'Исправление технических проблем'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We fix indexing errors, speed up the site, improve mobile version, set up correct redirects, fix broken links. This is the foundation — if the site is technically broken, content optimization won\'t help. Duration: 1-2 weeks, depends on the number of issues.'
                                    : 'Исправляем ошибки индексации, ускоряем сайт, улучшаем мобильную версию, настраиваем правильные редиректы, исправляем битые ссылки. Это основа — если сайт технически сломан, оптимизация контента не поможет. Срок: 1-2 недели, зависит от количества проблем.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: approve changes, test the site' : 'Ваше участие: утвердить изменения, протестировать сайт'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">3</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Content optimization' : 'Оптимизация контента'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We optimize existing pages: write meta tags, improve headings, add keywords naturally, optimize images. If needed, we create new pages targeting specific queries. We ensure content is useful for users, not just stuffed with keywords. Duration: ongoing, 5-10 pages per month.'
                                    : 'Оптимизируем существующие страницы: пишем мета-теги, улучшаем заголовки, добавляем ключевые слова естественно, оптимизируем изображения. При необходимости создаем новые страницы под конкретные запросы. Обеспечиваем, чтобы контент был полезен пользователям, а не просто напичкан ключевыми словами. Срок: постоянно, 5-10 страниц в месяц.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: provide information about products/services, approve texts' : 'Ваше участие: предоставить информацию о товарах/услугах, утвердить тексты'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">4</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Link building' : 'Построение ссылочной массы'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We get quality links from relevant sites: through guest posts, partnerships, directories. We don\'t buy cheap links or use link farms — Google penalizes this. We focus on natural, relevant links that improve domain authority. Duration: ongoing, 5-15 links per month depending on budget.'
                                    : 'Получаем качественные ссылки с релевантных сайтов: через гостевые посты, партнерства, каталоги. Не покупаем дешевые ссылки и не используем биржи — Google за это штрафует. Фокусируемся на естественных, релевантных ссылках, которые улучшают авторитет домена. Срок: постоянно, 5-15 ссылок в месяц в зависимости от бюджета.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: minimal, we work independently' : 'Ваше участие: минимальное, мы работаем самостоятельно'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">5</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Monthly monitoring and reporting' : 'Ежемесячный мониторинг и отчетность'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'Every month we track positions, traffic, conversions. We send you a report with metrics: what improved, what needs attention. We adjust the strategy based on results. This is ongoing work — SEO requires constant attention.'
                                    : 'Каждый месяц отслеживаем позиции, трафик, конверсии. Отправляем вам отчет с метриками: что улучшилось, на что обратить внимание. Корректируем стратегию на основе результатов. Это постоянная работа — SEO требует постоянного внимания.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: review reports, discuss strategy' : 'Ваше участие: просматривать отчеты, обсуждать стратегию'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Сроки -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Timeline: When to Expect Results' : 'Сроки: когда ждать результатов'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'First improvements: 3-4 months' : 'Первые улучшения: 3-4 месяца'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'After 3-4 months of work, you start seeing improvements: positions move from page 5-10 to page 2-3, some pages appear in top-10 for long-tail queries. Traffic increases by 10-30%. Google needs time to re-index your site and see improvements.'
                            : 'Через 3-4 месяца работы вы начинаете видеть улучшения: позиции перемещаются со страниц 5-10 на страницы 2-3, некоторые страницы появляются в топ-10 по низкочастотным запросам. Трафик увеличивается на 10-30%. Google нужно время, чтобы переиндексировать ваш сайт и увидеть улучшения.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Significant results: 6-12 months' : 'Значительные результаты: 6-12 месяцев'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'After 6-12 months, you see noticeable growth: top-10 positions for main queries, traffic growth of 50-150%, increase in conversions. This is the period when SEO investment starts paying off. The exact timeline depends on competition and niche.'
                            : 'Через 6-12 месяцев вы видите заметный рост: позиции в топ-10 по основным запросам, рост трафика на 50-150%, рост конверсий. Это период, когда вложения в SEO начинают окупаться. Точные сроки зависят от конкуренции и ниши.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What affects the timeline' : 'От чего зависят сроки'; ?>
                    </h3>
                    <ul class="space-y-3 text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <li>• <?php echo $currentLang === 'en' ? 'Competition level: in competitive niches (e.g., "website development") results take longer than in less competitive ones' : 'Уровень конкуренции: в конкурентных нишах (например, "разработка сайтов") результаты приходят дольше, чем в менее конкурентных'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Site age and history: new sites take longer, sites with a history rank faster' : 'Возраст и история сайта: новые сайты ранжируются дольше, сайты с историей — быстрее'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Technical issues: the more problems need to be fixed, the longer it takes' : 'Технические проблемы: чем больше проблем нужно исправить, тем дольше'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Content quality: well-optimized, useful content ranks faster' : 'Качество контента: хорошо оптимизированный, полезный контент ранжируется быстрее'; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ориентиры по цене -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
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
                        <?php echo $currentLang === 'en' ? 'Monthly SEO service: from 50,000 KZT ($100)' : 'SEO-услуга ежемесячно: от 50 000 тенге'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Basic package includes: technical audit and fixes, optimization of 5-10 pages per month, basic link building, monthly reports. Suitable for small sites (up to 50 pages) in less competitive niches.'
                            : 'Базовый пакет включает: технический аудит и исправления, оптимизацию 5-10 страниц в месяц, базовое построение ссылок, ежемесячные отчеты. Подходит для небольших сайтов (до 50 страниц) в менее конкурентных нишах.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Standard package: from 100,000 KZT ($200)' : 'Стандартный пакет: от 100 000 тенге'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Includes: comprehensive technical optimization, optimization of 10-20 pages per month, active link building (10-15 links/month), content creation for new pages, competitor analysis, monthly detailed reports. Suitable for medium sites (50-200 pages) in competitive niches.'
                            : 'Включает: комплексная техническая оптимизация, оптимизация 10-20 страниц в месяц, активное построение ссылок (10-15 ссылок/месяц), создание контента для новых страниц, анализ конкурентов, ежемесячные детальные отчеты. Подходит для средних сайтов (50-200 страниц) в конкурентных нишах.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Enterprise package: from 200,000 KZT ($400)' : 'Премиум пакет: от 200 000 тенге'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'For large sites (200+ pages) in highly competitive niches. Includes: full technical overhaul, optimization of 20+ pages per month, premium link building (15+ quality links/month), content strategy and creation, regular strategy meetings, priority support.'
                            : 'Для крупных сайтов (200+ страниц) в высококонкурентных нишах. Включает: полная техническая переработка, оптимизация 20+ страниц в месяц, премиум построение ссылок (15+ качественных ссылок/месяц), контент-стратегия и создание, регулярные стратегические встречи, приоритетная поддержка.'; ?>
                    </p>
                </div>
                
                <div class="reveal p-6 rounded-lg" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What affects the price' : 'Что влияет на цену'; ?>
                    </h3>
                    <ul class="space-y-2 text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <li>• <?php echo $currentLang === 'en' ? 'Site size: more pages = more work' : 'Размер сайта: больше страниц = больше работы'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Competition level: competitive niches require more resources' : 'Уровень конкуренции: конкурентные ниши требуют больше ресурсов'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Technical issues: the more problems, the higher the initial cost' : 'Технические проблемы: чем больше проблем, тем выше начальная стоимость'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Content needs: creating new content costs extra' : 'Потребность в контенте: создание нового контента стоит дополнительно'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Link building budget: premium links cost more' : 'Бюджет на ссылки: премиум ссылки стоят дороже'; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FAQ -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Frequently Asked Questions' : 'Частые вопросы'; ?>
                </h2>
            </div>
            
            <div itemscope itemtype="https://schema.org/FAQPage" class="space-y-6">
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'How long does it take to see results from SEO?' : 'Сколько времени нужно, чтобы увидеть результаты SEO?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'First improvements appear in 3-4 months: positions start moving up, traffic increases by 10-30%. Significant results (top-10 positions, 50-150% traffic growth) come in 6-12 months. SEO is a long-term strategy — you won\'t see results in 2 weeks like with advertising.'
                                : 'Первые улучшения появляются через 3-4 месяца: позиции начинают подниматься, трафик увеличивается на 10-30%. Значительные результаты (позиции в топ-10, рост трафика на 50-150%) приходят через 6-12 месяцев. SEO — долгосрочная стратегия, вы не увидите результатов за 2 недели, как с рекламой.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Can you guarantee top-10 positions?' : 'Можете ли вы гарантировать позиции в топ-10?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'No one can guarantee specific positions — Google\'s algorithm is too complex and changes constantly. We can guarantee that we\'ll do quality work: fix technical issues, optimize content, build links. Based on our experience, with proper work, sites usually reach top-10 for target queries within 6-12 months. But we can\'t promise "you\'ll be #1 in 3 months" — that\'s unrealistic.'
                                : 'Никто не может гарантировать конкретные позиции — алгоритм Google слишком сложен и постоянно меняется. Мы можем гарантировать, что будем делать качественную работу: исправлять технические проблемы, оптимизировать контент, строить ссылки. По нашему опыту, при правильной работе сайты обычно попадают в топ-10 по целевым запросам в течение 6-12 месяцев. Но мы не можем обещать "вы будете #1 через 3 месяца" — это нереалистично.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What\'s better: SEO or contextual advertising?' : 'Что лучше: SEO или контекстная реклама?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'They solve different problems. Advertising gives immediate results (traffic starts in days) but requires constant payment — stop paying, traffic stops. SEO takes time (3-6 months) but gives free organic traffic long-term. Best strategy: use both. Start with advertising for immediate results, invest in SEO for long-term growth. Read more about <a href="' . getLocalizedUrl($currentLang, '/ads') . '" class="underline">contextual advertising here</a>.'
                                : 'Они решают разные задачи. Реклама дает быстрые результаты (трафик начинается через дни), но требует постоянной оплаты — перестали платить, трафик остановился. SEO требует времени (3-6 месяцев), но дает бесплатный органический трафик долгосрочно. Лучшая стратегия: использовать оба. Начните с рекламы для быстрых результатов, инвестируйте в SEO для долгосрочного роста. Подробнее о <a href="' . getLocalizedUrl($currentLang, '/ads') . '" class="underline">контекстной рекламе здесь</a>.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Do I need to pay for SEO every month?' : 'Нужно ли платить за SEO каждый месяц?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Yes. SEO is ongoing work. You can\'t optimize once and forget — search engines change algorithms, competitors work on their sites, new queries appear. Monthly work includes: monitoring positions, updating content, building links, fixing new issues. Stopping SEO means losing positions over time. Think of it as maintenance for your site\'s visibility in search.'
                                : 'Да. SEO — это постоянная работа. Нельзя один раз оптимизировать и забыть — поисковики меняют алгоритмы, конкуренты работают над своими сайтами, появляются новые запросы. Ежемесячная работа включает: мониторинг позиций, обновление контента, построение ссылок, исправление новых проблем. Остановка SEO означает потерю позиций со временем. Думайте об этом как об обслуживании видимости вашего сайта в поиске.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Can I do SEO myself?' : 'Могу ли я делать SEO самостоятельно?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Theoretically yes, but it requires time and expertise. You need to understand technical SEO, content optimization, link building, analytics. You\'ll spend 20-40 hours per month learning and working. If your time is worth more than the cost of SEO service, it\'s better to delegate. If you have time and want to learn, you can start with basics and gradually improve, but results will come slower than with professional work.'
                                : 'Теоретически да, но это требует времени и экспертизы. Нужно разбираться в техническом SEO, оптимизации контента, построении ссылок, аналитике. Вы потратите 20-40 часов в месяц на обучение и работу. Если ваше время стоит больше, чем стоимость SEO-услуги, лучше делегировать. Если есть время и желание учиться, можно начать с основ и постепенно улучшать, но результаты придут медленнее, чем при профессиональной работе.'; ?>
                        </p>
                    </div>
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
                <?php echo $currentLang === 'en' ? 'Ready to Start SEO?' : 'Готовы начать SEO?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Contact us for a free consultation. We\'ll analyze your site and create a plan.'
                    : 'Свяжитесь с нами для бесплатной консультации. Мы проанализируем ваш сайт и составим план.'; ?>
            </p>
            <div class="reveal flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Get Consultation' : 'Получить консультацию'; ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="px-10 py-5 md:px-12 md:py-6 text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] border-2" style="border-color: var(--color-border); color: var(--color-text); background-color: transparent;">
                    <?php echo $currentLang === 'en' ? 'View Portfolio' : 'Посмотреть кейсы'; ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

