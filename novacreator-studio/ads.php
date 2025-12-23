<?php
/**
 * Страница Google Ads
 * Переписана по новому шаблону: ясный контент, экспертность, ответы на реальные вопросы
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'Google Ads' : 'Google Ads';
$pageMetaTitle = $currentLang === 'en' 
    ? 'Google Ads Setup and Management | Contextual Advertising | NovaCreator Studio'
    : 'Настройка Google Ads — контекстная реклама от 30 000 тенге/месяц';
$pageMetaDescription = $currentLang === 'en'
    ? 'Professional Google Ads setup and management. Contextual advertising in Google and Yandex. Campaign optimization, keyword selection, ad creation. Results in days. Pricing from $60/month.'
    : 'Профессиональная настройка и ведение Google Ads. Контекстная реклама в Google и Яндекс. Оптимизация кампаний, подбор ключевых слов, создание объявлений. Результаты через дни. Цены от 30 000 тенге/месяц.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'google ads setup, contextual advertising, google ads management, yandex direct'
    : 'настройка google ads, контекстная реклама, ведение google ads, яндекс директ';
$pageMetaCanonical = '/ads';

include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Google Ads' : 'Google Ads'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Contextual advertising that brings customers quickly'
                    : 'Контекстная реклама, которая быстро приводит клиентов'; ?>
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
                    <?php echo $currentLang === 'en' ? 'What is Google Ads' : 'Что такое Google Ads'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'Google Ads (formerly Google AdWords) is a platform for contextual advertising. You create ads that appear in Google search results when people search for keywords related to your business. You pay only when someone clicks on your ad — this is called cost per click (CPC).'
                        : 'Google Ads (ранее Google AdWords) — это платформа для контекстной рекламы. Вы создаете объявления, которые появляются в результатах поиска Google, когда люди ищут ключевые слова, связанные с вашим бизнесом. Вы платите только когда кто-то кликает на ваше объявление — это называется стоимостью за клик (CPC).'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'The main problem that Google Ads solves: you need customers quickly, but SEO takes months. With advertising, your ads start showing within hours after setup. You get traffic immediately, but you pay for each visitor. The advantage: fast results. The disadvantage: traffic stops when you stop paying.'
                        : 'Основная проблема, которую решает Google Ads: вам нужны клиенты быстро, а SEO занимает месяцы. С рекламой ваши объявления начинают показываться в течение часов после настройки. Вы получаете трафик сразу, но платите за каждого посетителя. Преимущество: быстрые результаты. Недостаток: трафик останавливается, когда перестаете платить.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'We also work with Yandex.Direct — the Russian/Kazakh search engine\'s advertising platform. If your target audience uses Yandex, we set up campaigns there as well.'
                        : 'Мы также работаем с Яндекс.Директ — рекламной платформой русскоязычной поисковой системы. Если ваша целевая аудитория использует Яндекс, мы настраиваем кампании и там.'; ?>
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
                    <?php echo $currentLang === 'en' ? 'When Google Ads is Really Needed' : 'Когда Google Ads действительно нужна'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You need customers immediately (in days, not months)' : 'Вам нужны клиенты немедленно (за дни, а не месяцы)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You\'ve launched a new product, opened a new location, or need to quickly fill the sales funnel. SEO will take 3-6 months to show results. Advertising starts working in 1-3 days after setup. If speed is critical, advertising is the right choice.'
                            : 'Вы запустили новый продукт, открыли новую точку или нужно быстро заполнить воронку продаж. SEO будет работать через 3-6 месяцев. Реклама начинает работать через 1-3 дня после настройки. Если скорость критична, реклама — правильный выбор.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You\'re testing a new product or market' : 'Вы тестируете новый продукт или рынок'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You want to quickly check if there\'s demand for your product or service. Advertising gives you fast feedback: you see clicks, conversions, and can quickly adjust the offer. If it works, you can scale. If not, you stop and try something else — without investing months in SEO.'
                            : 'Вы хотите быстро проверить, есть ли спрос на ваш товар или услугу. Реклама дает быструю обратную связь: вы видите клики, конверсии и можете быстро скорректировать предложение. Если работает — масштабируете. Если нет — останавливаете и пробуете другое, не вкладывая месяцы в SEO.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You run seasonal campaigns or promotions' : 'Вы проводите сезонные кампании или акции'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Black Friday, New Year sales, seasonal promotions — these need immediate traffic. You launch advertising for the campaign period, get customers, then pause it. SEO doesn\'t work for temporary campaigns because results come too late.'
                            : 'Черная пятница, новогодние распродажи, сезонные акции — им нужен немедленный трафик. Вы запускаете рекламу на период кампании, получаете клиентов, затем останавливаете. SEO не работает для временных кампаний, потому что результаты приходят слишком поздно.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You have a budget and want to scale quickly' : 'У вас есть бюджет и вы хотите быстро масштабироваться'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you have budget and want to grow faster than organic traffic allows, advertising accelerates growth. You can increase the budget and get more traffic immediately. With SEO, you can\'t force faster results — you have to wait.'
                            : 'Если у вас есть бюджет и вы хотите расти быстрее, чем позволяет органический трафик, реклама ускоряет рост. Вы можете увеличить бюджет и получить больше трафика сразу. С SEO нельзя заставить результаты прийти быстрее — нужно ждать.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Когда Google Ads НЕ подойдет -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'When Google Ads Won\'t Help' : 'Когда Google Ads не подойдет'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You have a very limited budget (less than $100-200/month)' : 'У вас очень ограниченный бюджет (меньше 50 000-100 000 тенге/месяц)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Advertising requires a minimum budget to work effectively. With a very small budget (less than $100-200/month), you\'ll get few clicks, which won\'t provide meaningful data or results. In this case, <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a> is a better investment — it\'s slower but doesn\'t require monthly advertising payments.'
                            : 'Реклама требует минимального бюджета для эффективной работы. При очень маленьком бюджете (меньше 50 000-100 000 тенге/месяц) вы получите мало кликов, что не даст значимых данных или результатов. В этом случае <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a> — лучшее вложение, хоть и медленнее, но не требует ежемесячных платежей за рекламу.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Your product/service is very niche with few searches' : 'Ваш товар/услуга очень нишевая, по ней мало поисков'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If people don\'t search for what you offer (fewer than 100-200 searches per month), advertising won\'t bring traffic — there simply aren\'t enough searches. In this case, direct sales, industry events, or specialized platforms work better than search advertising.'
                            : 'Если люди не ищут то, что вы предлагаете (меньше 100-200 поисков в месяц), реклама не принесет трафик — просто недостаточно поисков. В этом случае прямые продажи, отраслевые мероприятия или специализированные площадки работают лучше, чем поисковая реклама.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'You\'re looking for free traffic' : 'Вы ищете бесплатный трафик'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Advertising is paid traffic — you pay for each click. If you want free visitors, invest in <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a>. Yes, SEO takes time, but once you\'re ranking, visitors come for free. Best strategy: combine both — use advertising for immediate results while building SEO for long-term free traffic.'
                            : 'Реклама — это платный трафик, вы платите за каждый клик. Если вы хотите бесплатных посетителей, инвестируйте в <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a>. Да, SEO требует времени, но когда вы ранжируетесь, посетители приходят бесплатно. Лучшая стратегия: комбинировать оба — использовать рекламу для быстрых результатов, пока строите SEO для долгосрочного бесплатного трафика.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Your website is not ready for conversions' : 'Ваш сайт не готов для конверсий'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If your site is broken, doesn\'t work on mobile, has no contact forms, or the checkout doesn\'t work, advertising will waste your budget. People will click, but won\'t convert. First fix the site, then launch advertising. Otherwise you\'ll pay for clicks that don\'t lead to sales.'
                            : 'Если ваш сайт сломан, не работает на мобильных, нет форм обратной связи или не работает оформление заказа, реклама потратит ваш бюджет впустую. Люди будут кликать, но не конвертироваться. Сначала исправьте сайт, потом запускайте рекламу. Иначе вы будете платить за клики, которые не приводят к продажам.'; ?>
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
                        <?php echo $currentLang === 'en' ? 'Immediate traffic from day 1-3' : 'Немедленный трафик с 1-3 дня'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Unlike SEO, which takes months, advertising starts working immediately. After we set up your campaigns (1-3 days), ads start showing. You see clicks and visitors on your site from day one. This is the main advantage of advertising: speed.'
                            : 'В отличие от SEO, которое занимает месяцы, реклама начинает работать немедленно. После настройки кампаний (1-3 дня) объявления начинают показываться. Вы видите клики и посетителей на сайте с первого дня. Это главное преимущество рекламы: скорость.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Targeted audience — people actively searching' : 'Целевая аудитория — люди, активно ищущие'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'Your ads appear when people search for exactly what you offer. They\'re already interested — they typed your keywords into Google. This means higher conversion rates compared to banner ads or social media ads where people weren\'t actively looking.'
                            : 'Ваши объявления появляются, когда люди ищут именно то, что вы предлагаете. Они уже заинтересованы — они ввели ваши ключевые слова в Google. Это значит более высокие конверсии по сравнению с баннерной рекламой или рекламой в соцсетях, где люди не искали активно.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Full control over budget and targeting' : 'Полный контроль над бюджетом и таргетингом'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You set a daily budget, and Google won\'t exceed it. You choose which keywords to show ads for, which regions, which time of day. You can pause campaigns anytime, increase or decrease budget. You have full control — unlike SEO where you wait for results.'
                            : 'Вы устанавливаете дневной бюджет, и Google не превысит его. Вы выбираете, по каким ключевым словам показывать объявления, в каких регионах, в какое время суток. Можете остановить кампании в любой момент, увеличить или уменьшить бюджет. У вас полный контроль — в отличие от SEO, где вы ждете результатов.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Detailed analytics and optimization' : 'Детальная аналитика и оптимизация'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You see exactly how much each click costs, which keywords convert, which ads work best. We optimize campaigns based on data: remove underperforming keywords, improve ads, adjust bids. Over time, cost per click decreases, conversion rate increases — campaigns become more profitable.'
                            : 'Вы видите точно, сколько стоит каждый клик, какие ключевые слова конвертируются, какие объявления работают лучше. Мы оптимизируем кампании на основе данных: убираем неэффективные ключевые слова, улучшаем объявления, корректируем ставки. Со временем стоимость клика снижается, конверсия растет — кампании становятся более прибыльными.'; ?>
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
                                <?php echo $currentLang === 'en' ? 'Analysis and strategy' : 'Анализ и стратегия'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We analyze your business, target audience, competitors. We identify keywords that your potential customers use when searching. We determine budget, set goals (leads, sales, calls), choose campaign types (search, display, remarketing). Duration: 2-3 business days.'
                                    : 'Анализируем ваш бизнес, целевую аудиторию, конкурентов. Определяем ключевые слова, которые используют ваши потенциальные клиенты при поиске. Определяем бюджет, ставим цели (лиды, продажи, звонки), выбираем типы кампаний (поиск, показ, ремаркетинг). Срок: 2-3 рабочих дня.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: provide information about business, goals, target audience' : 'Ваше участие: предоставить информацию о бизнесе, целях, целевой аудитории'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">2</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Campaign setup' : 'Настройка кампаний'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We create campaigns, ad groups, write ad texts (headlines, descriptions), set up targeting (keywords, regions, schedule), configure bids. We set up conversion tracking so you can see which ads lead to sales. Duration: 2-4 business days.'
                                    : 'Создаем кампании, группы объявлений, пишем тексты объявлений (заголовки, описания), настраиваем таргетинг (ключевые слова, регионы, расписание), настраиваем ставки. Настраиваем отслеживание конверсий, чтобы вы видели, какие объявления приводят к продажам. Срок: 2-4 рабочих дня.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: approve ad texts, provide access to Google Ads account' : 'Ваше участие: утвердить тексты объявлений, предоставить доступ к аккаунту Google Ads'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">3</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Campaign launch' : 'Запуск кампаний'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We launch campaigns, monitor initial performance, make quick adjustments if needed. Ads start showing, you start getting clicks and traffic. We track metrics: impressions, clicks, CTR, cost per click, conversions. Duration: campaigns run continuously, we monitor daily for the first week.'
                                    : 'Запускаем кампании, отслеживаем начальные показатели, вносим быстрые корректировки при необходимости. Объявления начинают показываться, вы начинаете получать клики и трафик. Отслеживаем метрики: показы, клики, CTR, стоимость клика, конверсии. Срок: кампании работают постоянно, первую неделю мониторим ежедневно.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: monitor results, provide feedback on conversions' : 'Ваше участие: отслеживать результаты, давать обратную связь по конверсиям'; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold text-white">4</div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Ongoing optimization' : 'Постоянная оптимизация'; ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo $currentLang === 'en'
                                    ? 'We analyze performance weekly: which keywords convert, which don\'t, which ads work best. We add negative keywords to exclude irrelevant searches, adjust bids, improve ad texts, test new variations. Goal: reduce cost per click, increase conversion rate. Duration: ongoing, weekly optimizations.'
                                    : 'Анализируем эффективность еженедельно: какие ключевые слова конвертируются, какие нет, какие объявления работают лучше. Добавляем минус-слова, чтобы исключить нерелевантные поиски, корректируем ставки, улучшаем тексты объявлений, тестируем новые варианты. Цель: снизить стоимость клика, увеличить конверсию. Срок: постоянно, еженедельные оптимизации.'; ?>
                            </p>
                            <p class="text-base text-sm opacity-75" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Your involvement: review weekly reports, discuss optimization ideas' : 'Ваше участие: просматривать еженедельные отчеты, обсуждать идеи оптимизации'; ?>
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
                    <?php echo $currentLang === 'en' ? 'Timeline: When Ads Start Working' : 'Сроки: когда реклама начинает работать'; ?>
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Campaign setup: 2-4 business days' : 'Настройка кампаний: 2-4 рабочих дня'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We need 2-4 business days to analyze your business, create campaigns, write ads, and configure everything. If you need it faster (1-2 days), it\'s possible with a rush fee, but we recommend giving us enough time for proper setup.'
                            : 'Нам нужно 2-4 рабочих дня для анализа вашего бизнеса, создания кампаний, написания объявлений и настройки всего. Если нужно быстрее (1-2 дня), возможно с доплатой за срочность, но мы рекомендуем дать достаточно времени для правильной настройки.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'First clicks: same day or next day' : 'Первые клики: в тот же день или на следующий'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'After campaigns are launched, ads start showing within hours. You\'ll see first clicks the same day or the next day, depending on when we launch. Unlike SEO, you don\'t wait months — results start immediately.'
                            : 'После запуска кампаний объявления начинают показываться в течение часов. Вы увидите первые клики в тот же день или на следующий, в зависимости от времени запуска. В отличие от SEO, вы не ждете месяцы — результаты начинаются немедленно.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Optimization results: 2-4 weeks' : 'Результаты оптимизации: 2-4 недели'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'It takes 2-4 weeks to collect enough data for optimization. We need to see which keywords convert, which ads work, what the conversion rates are. After this period, we can make informed optimizations: improve ads, adjust bids, remove underperforming keywords. Performance improves over time.'
                            : 'Нужно 2-4 недели, чтобы собрать достаточно данных для оптимизации. Нам нужно увидеть, какие ключевые слова конвертируются, какие объявления работают, какая конверсия. После этого периода мы можем делать обоснованные оптимизации: улучшать объявления, корректировать ставки, убирать неэффективные ключевые слова. Эффективность улучшается со временем.'; ?>
                    </p>
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
                        <?php echo $currentLang === 'en' ? 'Service fee: from 30,000 KZT ($60) per month' : 'Услуга ведения: от 30 000 тенге в месяц'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'This is our fee for managing your campaigns: setup, optimization, monitoring, reports. This is separate from your advertising budget (which goes to Google/Yandex). Service fee depends on campaign complexity: number of campaigns, keywords, ad groups.'
                            : 'Это наша плата за ведение ваших кампаний: настройка, оптимизация, мониторинг, отчеты. Это отдельно от вашего рекламного бюджета (который идет в Google/Яндекс). Стоимость услуги зависит от сложности кампаний: количество кампаний, ключевых слов, групп объявлений.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Advertising budget: you pay separately' : 'Рекламный бюджет: вы платите отдельно'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'You pay Google/Yandex directly for clicks. Budget depends on your goals: small campaigns (50,000-100,000 KZT/month), medium (100,000-300,000 KZT/month), large (300,000+ KZT/month). We recommend starting with 50,000-100,000 KZT/month to test and gather data, then scaling up.'
                            : 'Вы платите Google/Яндекс напрямую за клики. Бюджет зависит от ваших целей: небольшие кампании (50 000-100 000 тенге/месяц), средние (100 000-300 000 тенге/месяц), крупные (300 000+ тенге/месяц). Рекомендуем начинать с 50 000-100 000 тенге/месяц для тестирования и сбора данных, затем масштабировать.'; ?>
                    </p>
                </div>
                
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'One-time setup fee: optional' : 'Разовая настройка: опционально'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'If you need help with initial setup (creating account, linking payment method, first campaigns), we charge a one-time setup fee (50,000-100,000 KZT depending on complexity). If you already have an account and just need ongoing management, setup is included in monthly fee.'
                            : 'Если вам нужна помощь с первоначальной настройкой (создание аккаунта, привязка платежного метода, первые кампании), мы берем разовую плату за настройку (50 000-100 000 тенге в зависимости от сложности). Если у вас уже есть аккаунт и нужно только ведение, настройка входит в ежемесячную плату.'; ?>
                    </p>
                </div>
                
                <div class="reveal p-6 rounded-lg" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What affects the service fee' : 'Что влияет на стоимость услуги'; ?>
                    </h3>
                    <ul class="space-y-2 text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <li>• <?php echo $currentLang === 'en' ? 'Number of campaigns: more campaigns = more work' : 'Количество кампаний: больше кампаний = больше работы'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Campaign types: search, display, remarketing require different management' : 'Типы кампаний: поиск, показ, ремаркетинг требуют разного управления'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Number of keywords: large keyword lists need more optimization' : 'Количество ключевых слов: большие списки требуют больше оптимизации'; ?></li>
                        <li>• <?php echo $currentLang === 'en' ? 'Reporting needs: detailed reports take more time' : 'Потребность в отчетности: детальные отчеты занимают больше времени'; ?></li>
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
                        <?php echo $currentLang === 'en' ? 'How quickly will I see results?' : 'Как быстро я увижу результаты?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Ads start showing within hours after setup. You\'ll see first clicks the same day or next day. This is the main advantage of advertising over SEO — immediate results. However, optimization takes 2-4 weeks as we need data to improve campaigns.'
                                : 'Объявления начинают показываться в течение часов после настройки. Первые клики вы увидите в тот же день или на следующий. Это главное преимущество рекламы перед SEO — немедленные результаты. Однако оптимизация занимает 2-4 недели, так как нужны данные для улучшения кампаний.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'How much does a click cost?' : 'Сколько стоит клик?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Cost per click (CPC) depends on competition and keyword. In Kazakhstan, typical CPC ranges from 50-500 KZT ($0.10-$1) per click, sometimes more for highly competitive keywords. We optimize campaigns to reduce CPC over time by improving quality scores, refining keywords, and optimizing ads. You can set maximum CPC limits to control costs.'
                                : 'Стоимость клика (CPC) зависит от конкуренции и ключевого слова. В Казахстане типичная CPC составляет 50-500 тенге ($0.10-$1) за клик, иногда больше для высококонкурентных ключевых слов. Мы оптимизируем кампании, чтобы снизить CPC со временем, улучшая качественные показатели, уточняя ключевые слова и оптимизируя объявления. Вы можете устанавливать максимальные лимиты CPC для контроля затрат.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Can I manage campaigns myself?' : 'Смогу ли я управлять кампаниями самостоятельно?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Technically yes, but it requires learning Google Ads interface, understanding bidding strategies, keyword research, ad writing, optimization techniques. You\'ll spend 5-10 hours per week managing campaigns. If your time is worth more than our service fee, it\'s better to delegate. We handle everything: setup, optimization, monitoring, reporting — you focus on your business.'
                                : 'Технически да, но это требует изучения интерфейса Google Ads, понимания стратегий ставок, исследования ключевых слов, написания объявлений, техник оптимизации. Вы потратите 5-10 часов в неделю на управление кампаниями. Если ваше время стоит больше, чем наша плата за услугу, лучше делегировать. Мы делаем все: настройку, оптимизацию, мониторинг, отчетность — вы фокусируетесь на бизнесе.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'What\'s better: Google Ads or SEO?' : 'Что лучше: Google Ads или SEO?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'They solve different problems. Advertising gives immediate results but costs money every month — stop paying, traffic stops. <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a> takes 3-6 months but gives free traffic long-term. Best strategy: use both. Start with advertising for immediate customers, invest in SEO for long-term growth. They complement each other.'
                                : 'Они решают разные задачи. Реклама дает быстрые результаты, но стоит денег каждый месяц — перестали платить, трафик остановился. <a href="' . getLocalizedUrl($currentLang, '/seo') . '" class="underline">SEO</a> занимает 3-6 месяцев, но дает бесплатный трафик долгосрочно. Лучшая стратегия: использовать оба. Начните с рекламы для немедленных клиентов, инвестируйте в SEO для долгосрочного роста. Они дополняют друг друга.'; ?>
                        </p>
                    </div>
                </div>
                
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="reveal border rounded-2xl p-8" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                    <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Do you guarantee conversions or sales?' : 'Гарантируете ли вы конверсии или продажи?'; ?>
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text" class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'We can\'t guarantee specific sales numbers — conversion depends on your product, pricing, website quality, market demand. We guarantee that we\'ll do quality work: properly set up campaigns, optimize based on data, provide regular reports. We can guarantee clicks and traffic — that\'s what advertising delivers. Whether clicks turn into sales depends on your offer and website.'
                                : 'Мы не можем гарантировать конкретные цифры продаж — конверсия зависит от вашего товара, цен, качества сайта, спроса на рынке. Мы гарантируем, что будем делать качественную работу: правильно настраивать кампании, оптимизировать на основе данных, предоставлять регулярные отчеты. Мы можем гарантировать клики и трафик — это то, что дает реклама. Превратятся ли клики в продажи, зависит от вашего предложения и сайта.'; ?>
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
                <?php echo $currentLang === 'en' ? 'Ready to Start Advertising?' : 'Готовы начать рекламу?'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Contact us for a free consultation. We\'ll analyze your business and create an advertising strategy.'
                    : 'Свяжитесь с нами для бесплатной консультации. Мы проанализируем ваш бизнес и создадим рекламную стратегию.'; ?>
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
