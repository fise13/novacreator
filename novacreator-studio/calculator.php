<?php
/**
 * Калькулятор стоимости услуг
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.calculator.breadcrumb');
$pageMetaTitle = t('seo.pages.calculator.title');
$pageMetaDescription = t('seo.pages.calculator.description');
$pageMetaKeywords = t('seo.pages.calculator.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - Apple минималистичный дизайн на весь экран -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.calculator.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.calculator.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Калькулятор -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('pages.calculator.formTitle')); ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en' 
                        ? t('pages.calculator.formSubtitle') 
                        : htmlspecialchars(t('pages.calculator.formSubtitle')) . ' Наши специалисты помогут рассчитать стоимость раскрутки портала или продвижения сайта с учетом всех факторов.'; ?>
                </p>
            </div>
            
            <form id="calculatorForm" class="reveal space-y-8">
                <!-- Выбор услуги -->
                <div>
                    <label class="block text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.calculator.selectService')); ?>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="seo" class="hidden service-radio" checked>
                            <div class="calculator-service-card service-card-option p-6 selected">
                                <div class="text-3xl mb-3">🔍</div>
                                <div class="font-semibold text-lg mb-2">
                                    <?php echo htmlspecialchars(t('pages.calculator.services.seo')); ?>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="development" class="hidden service-radio">
                            <div class="calculator-service-card service-card-option p-6">
                                <div class="text-3xl mb-3">💻</div>
                                <div class="font-semibold text-lg mb-2">
                                    <?php echo htmlspecialchars(t('pages.calculator.services.development')); ?>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="ads" class="hidden service-radio">
                            <div class="calculator-service-card service-card-option p-6">
                                <div class="text-3xl mb-3">📢</div>
                                <div class="font-semibold text-lg mb-2">
                                    <?php echo htmlspecialchars(t('pages.calculator.services.ads')); ?>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="ios" class="hidden service-radio">
                            <div class="calculator-service-card service-card-option p-6">
                                <div class="text-3xl mb-3">📱</div>
                                <div class="font-semibold text-lg mb-2">
                                    <?php echo $currentLang === 'en' ? 'iOS development' : 'iOS разработка'; ?>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Параметры для SEO -->
                <div id="seo-options" class="service-options space-y-6">
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.seo.siteType')); ?>
                        </label>
                        <select name="site_type" class="form-input">
                            <option value="small"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.small')); ?></option>
                            <option value="medium" selected><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.medium')); ?></option>
                            <option value="large"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.large')); ?></option>
                            <option value="shop"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.shop')); ?></option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.seo.region')); ?>
                        </label>
                        <select name="region" class="form-input">
                            <option value="local"><?php echo htmlspecialchars(t('pages.calculator.seo.regions.local')); ?></option>
                            <option value="regional" selected><?php echo htmlspecialchars(t('pages.calculator.seo.regions.regional')); ?></option>
                            <option value="national"><?php echo htmlspecialchars(t('pages.calculator.seo.regions.national')); ?></option>
                            <option value="international"><?php echo htmlspecialchars(t('pages.calculator.seo.regions.international')); ?></option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.seo.competition')); ?>
                        </label>
                        <select name="competition" class="form-input">
                            <option value="low"><?php echo htmlspecialchars(t('pages.calculator.seo.competitions.low')); ?></option>
                            <option value="medium" selected><?php echo htmlspecialchars(t('pages.calculator.seo.competitions.medium')); ?></option>
                            <option value="high"><?php echo htmlspecialchars(t('pages.calculator.seo.competitions.high')); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Параметры для разработки -->
                <div id="development-options" class="service-options hidden space-y-6">
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Industry/Niche' : 'Отрасль/Ниша'; ?>
                        </label>
                        <select name="niche" id="niche-select" class="form-input">
                            <option value="general"><?php echo $currentLang === 'en' ? 'General' : 'Общее'; ?></option>
                            <option value="restaurant"><?php echo $currentLang === 'en' ? 'Restaurant/Cafe' : 'Ресторан/Кафе'; ?></option>
                            <option value="fitness"><?php echo $currentLang === 'en' ? 'Fitness/Gym' : 'Фитнес/Спортзал'; ?></option>
                            <option value="ecommerce"><?php echo $currentLang === 'en' ? 'Online Store' : 'Интернет-магазин'; ?></option>
                            <option value="hotel"><?php echo $currentLang === 'en' ? 'Hotel/Tourism' : 'Отель/Туризм'; ?></option>
                            <option value="medical"><?php echo $currentLang === 'en' ? 'Medical/Beauty' : 'Медицина/Красота'; ?></option>
                            <option value="education"><?php echo $currentLang === 'en' ? 'Education' : 'Образование'; ?></option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.development.siteType')); ?>
                        </label>
                        <select name="dev_type" class="form-input">
                            <option value="landing"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.landing')); ?></option>
                            <option value="corporate" selected><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.corporate')); ?></option>
                            <option value="shop"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.shop')); ?></option>
                            <option value="webapp"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.webapp')); ?></option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.development.pages')); ?>
                        </label>
                        <input type="number" name="pages" value="10" min="1" max="100" class="form-input">
                    </div>
                    <!-- Примеры для ниши -->
                    <div id="niche-examples" class="hidden p-4 rounded-lg" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                        <p class="text-sm font-semibold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Example projects:' : 'Примеры проектов:'; ?>
                        </p>
                        <div id="niche-examples-content" class="text-sm space-y-1" style="color: var(--color-text-secondary);"></div>
                    </div>
                </div>

                <!-- Параметры для рекламы -->
                <div id="ads-options" class="service-options hidden space-y-6">
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.ads.budget')); ?>
                        </label>
                        <input type="number" name="budget" value="100000" min="50000" step="10000" class="form-input">
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.ads.platform')); ?>
                        </label>
                        <select name="platform" class="form-input">
                            <option value="google" selected><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.google')); ?></option>
                            <option value="yandex"><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.yandex')); ?></option>
                            <option value="both"><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.both')); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Параметры для iOS разработки -->
                <div id="ios-options" class="service-options hidden space-y-6">
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'App type' : 'Тип iOS приложения'; ?>
                        </label>
                        <select name="ios_type" class="form-input">
                            <option value="mvp"><?php echo $currentLang === 'en' ? 'MVP / pilot' : 'MVP / пилот'; ?></option>
                            <option value="business" selected><?php echo $currentLang === 'en' ? 'Business app' : 'Бизнес‑приложение'; ?></option>
                            <option value="complex"><?php echo $currentLang === 'en' ? 'Complex product' : 'Сложный продукт'; ?></option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Number of screens' : 'Количество экранов'; ?>
                        </label>
                        <input type="number" name="ios_screens" value="12" min="3" max="80" class="form-input">
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Integrations' : 'Интеграции'; ?>
                        </label>
                        <select name="ios_integrations" class="form-input">
                            <option value="basic"><?php echo $currentLang === 'en' ? 'Basic (1–2 APIs, Firebase)' : 'Базовые (1–2 API, Firebase)'; ?></option>
                            <option value="extended"><?php echo $currentLang === 'en' ? 'Extended (3–4 APIs, payments, maps)' : 'Расширенные (3–4 API, оплаты, карты)'; ?></option>
                            <option value="enterprise"><?php echo $currentLang === 'en' ? 'Enterprise (many systems, CRM/ERP)' : 'Enterprise (много систем, CRM/ERP)'; ?></option>
                        </select>
                    </div>
                </div>

                <!-- Результат -->
                <div class="space-y-6">
                    <button type="button" id="calculateBtn" class="btn-neon w-full min-h-[56px] text-lg font-semibold">
                        <?php echo htmlspecialchars(t('pages.calculator.calculate')); ?>
                    </button>

                    <div id="result" class="calculator-result hidden p-8">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                            <h3 class="text-2xl md:text-3xl font-bold" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.calculator.result.title')); ?>
                            </h3>
                            <div class="currency-segment" role="group" aria-label="<?php echo $currentLang === 'en' ? 'Currency' : 'Валюта'; ?>">
                                <button type="button" class="currency-toggle-btn currency-segment-active" data-currency="KZT">
                                    ₸&nbsp;KZT
                                </button>
                                <button type="button" class="currency-toggle-btn" data-currency="RUB">
                                    ₽&nbsp;RUB
                                </button>
                                <button type="button" class="currency-toggle-btn" data-currency="USD">
                                    $&nbsp;USD
                                </button>
                            </div>
                        </div>
                        <div class="text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);" id="price">0 ₸</div>
                        <p class="text-lg mb-4" style="color: var(--color-text-secondary);" id="price-note">
                            <?php echo htmlspecialchars(t('pages.calculator.result.note')); ?>
                        </p>
                        <!-- Похожий кейс -->
                        <div id="similar-case" class="mb-6 p-4 rounded-lg hidden" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                            <p class="text-sm mb-2" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Similar project:' : 'Похожий проект:'; ?>
                            </p>
                            <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" id="similar-case-link" class="text-base font-semibold hover:underline" style="color: var(--color-text);"></a>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-center">
                                <?php echo htmlspecialchars(t('pages.calculator.result.button')); ?>
                            </a>
                            <button type="button" id="saveCalculation" class="btn-outline px-8 py-4 text-lg font-semibold">
                                <?php echo $currentLang === 'en' ? 'Save & Email' : 'Сохранить и отправить'; ?>
                            </button>
                        </div>
                        <div class="mt-6 p-5 rounded-xl" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                            <p class="text-sm mb-3" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'Get a fixed quote and implementation plan within 2 hours' : 'Получите фиксированную смету и план запуска в течение 2 часов'; ?>
                            </p>
                            <form id="calcLeadForm" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <input type="text" id="calcName" class="form-input" placeholder="<?php echo $currentLang === 'en' ? 'Your name' : 'Ваше имя'; ?>" required>
                                <input type="tel" id="calcPhone" class="form-input" placeholder="<?php echo $currentLang === 'en' ? 'Phone number' : 'Телефон'; ?>" required>
                                <button type="submit" class="btn-neon">
                                    <?php echo $currentLang === 'en' ? 'Get proposal' : 'Получить предложение'; ?>
                                </button>
                            </form>
                            <p id="calcLeadMessage" class="text-sm mt-3 hidden" style="color: var(--color-text-secondary);"></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceRadios = document.querySelectorAll('.service-radio');
    const resultDiv = document.getElementById('result');
    const priceDiv = document.getElementById('price');
    const priceNote = document.getElementById('price-note');
    const calculateBtn = document.getElementById('calculateBtn');
    const currencyButtons = document.querySelectorAll('.currency-toggle-btn');
    const calcLeadForm = document.getElementById('calcLeadForm');
    const calcLeadMessage = document.getElementById('calcLeadMessage');

    // Базовая цена всегда считается в тенге
    let lastPriceKzt = 0;
    let currentCurrency = 'KZT';

    const currencySettings = {
        KZT: { symbol: '₸', rate: 1, locale: 'ru-RU' },
        RUB: { symbol: '₽', rate: 1 / 5.5, locale: 'ru-RU' },   // примерно 5.5 ₸ за 1 ₽
        USD: { symbol: '$', rate: 1 / 480, locale: 'en-US' }     // примерно 480 ₸ за 1 $
    };

    function updatePriceDisplay() {
        if (!lastPriceKzt) {
            priceDiv.textContent = '0 ₸';
            return;
        }

        const settings = currencySettings[currentCurrency] || currencySettings.KZT;
        const converted = Math.round(lastPriceKzt * settings.rate);
        priceDiv.textContent = converted.toLocaleString(settings.locale) + ' ' + settings.symbol;
    }

    function setActiveCurrency(newCurrency) {
        currentCurrency = newCurrency;
        currencyButtons.forEach(btn => {
            if (btn.dataset.currency === newCurrency) {
                btn.classList.add('currency-segment-active');
            } else {
                btn.classList.remove('currency-segment-active');
            }
        });
        updatePriceDisplay();
    }

    if (currencyButtons.length) {
        currencyButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const currency = this.dataset.currency;
                if (currency) {
                    setActiveCurrency(currency);
                }
            });
        });
        setActiveCurrency('KZT');
    }

    function activateService(value) {
        const target = Array.from(serviceRadios).find(r => r.value === value);
        const fallback = document.querySelector('.service-radio:checked') || serviceRadios[0];
        const radio = target || fallback;
        if (!radio) return;
        radio.checked = true;
        document.querySelectorAll('.service-options').forEach(opt => opt.classList.add('hidden'));
        const optionsBlock = document.getElementById(radio.value + '-options');
        if (optionsBlock) {
            optionsBlock.classList.remove('hidden');
        }
        document.querySelectorAll('.service-card-option').forEach(card => {
            card.classList.remove('selected');
        });
        const card = radio.closest('label')?.querySelector('.service-card-option');
        if (card) {
            card.classList.add('selected');
        }
    }

    serviceRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            activateService(this.value);
        });
    });

    // Активируем услугу по умолчанию или из query-параметра ?service=
    const params = new URLSearchParams(window.location.search);
    const initialService = params.get('service');
    if (initialService) {
        activateService(initialService);
    } else {
        const checked = document.querySelector('.service-radio:checked') || serviceRadios[0];
        if (checked) {
            activateService(checked.value);
        }
    }

    // Примеры проектов по нишам
    const nicheExamples = {
        restaurant: {
            ru: 'Кофейня на Абая: лендинг 250 000 ₸, сайт-меню 300 000 ₸',
            en: 'Coffee Shop on Abay: landing 250,000 ₸, menu site 300,000 ₸'
        },
        fitness: {
            ru: 'FlexFit: корпоративный сайт 450 000 ₸, онлайн-запись 500 000 ₸',
            en: 'FlexFit: corporate site 450,000 ₸, online booking 500,000 ₸'
        },
        ecommerce: {
            ru: 'StyleKZ: интернет-магазин 800 000 ₸, каталог товаров 600 000 ₸',
            en: 'StyleKZ: online store 800,000 ₸, product catalog 600,000 ₸'
        },
        hotel: {
            ru: 'Lakeview Hotel: сайт с бронированием 950 000 ₸, система управления 1 200 000 ₸',
            en: 'Lakeview Hotel: booking site 950,000 ₸, management system 1,200,000 ₸'
        },
        medical: {
            ru: 'Dental Care: сайт-визитка 350 000 ₸, запись онлайн 450 000 ₸',
            en: 'Dental Care: business card site 350,000 ₸, online booking 450,000 ₸'
        },
        education: {
            ru: 'StudyKZ: сайт школы 400 000 ₸, LMS-платформа 1 200 000 ₸',
            en: 'StudyKZ: school site 400,000 ₸, LMS platform 1,200,000 ₸'
        }
    };

    // Похожие кейсы
    const similarCases = {
        restaurant: { ru: 'Кофейня на Абая', en: 'Coffee Shop on Abay' },
        fitness: { ru: 'FlexFit', en: 'FlexFit' },
        ecommerce: { ru: 'StyleKZ', en: 'StyleKZ' },
        hotel: { ru: 'Lakeview Hotel', en: 'Lakeview Hotel' },
        medical: { ru: 'Dental Care', en: 'Dental Care' },
        education: { ru: 'StudyKZ', en: 'StudyKZ' }
    };

    // Показ примеров для ниши
    const nicheSelect = document.getElementById('niche-select');
    const nicheExamplesDiv = document.getElementById('niche-examples');
    const nicheExamplesContent = document.getElementById('niche-examples-content');
    
    if (nicheSelect) {
        nicheSelect.addEventListener('change', function() {
            const niche = this.value;
            if (niche !== 'general' && nicheExamples[niche]) {
                const lang = '<?php echo $currentLang; ?>';
                nicheExamplesContent.textContent = nicheExamples[niche][lang] || nicheExamples[niche]['ru'];
                nicheExamplesDiv.classList.remove('hidden');
            } else {
                nicheExamplesDiv.classList.add('hidden');
            }
        });
    }

    calculateBtn.addEventListener('click', function() {
        const service = document.querySelector('.service-radio:checked').value;
        let price = 0;
        let similarCase = null;

        if (service === 'seo') {
            const siteType = document.querySelector('[name="site_type"]').value;
            const region = document.querySelector('[name="region"]').value;
            const competition = document.querySelector('[name="competition"]').value;
            
            let basePrice = 0;
            if (siteType === 'small') basePrice = 90000;
            else if (siteType === 'medium') basePrice = 150000;
            else if (siteType === 'large') basePrice = 250000;
            else if (siteType === 'shop') basePrice = 220000;

            if (region === 'local') basePrice *= 0.8;
            else if (region === 'international') basePrice *= 1.3;

            if (competition === 'low') basePrice *= 0.9;
            else if (competition === 'high') basePrice *= 1.2;

            price = Math.round(basePrice);
        } else if (service === 'development') {
            const devType = document.querySelector('[name="dev_type"]').value;
            const pages = parseInt(document.querySelector('[name="pages"]').value) || 10;
            const niche = document.querySelector('[name="niche"]')?.value || 'general';
            
            let basePrice = 0;
            // Базовые цены по типу сайта
            if (devType === 'landing') basePrice = 180000;
            else if (devType === 'corporate') basePrice = 300000;
            else if (devType === 'shop') basePrice = 500000;
            else if (devType === 'webapp') basePrice = 750000;

            // Корректировка по нише
            const nicheMultipliers = {
                restaurant: { landing: 1.0, corporate: 0.9, shop: 0.85, webapp: 1.0 },
                fitness: { landing: 1.0, corporate: 1.1, shop: 1.0, webapp: 1.2 },
                ecommerce: { landing: 0.9, corporate: 1.0, shop: 1.0, webapp: 1.1 },
                hotel: { landing: 1.0, corporate: 1.0, shop: 1.0, webapp: 1.3 },
                medical: { landing: 0.95, corporate: 1.0, shop: 0.9, webapp: 1.0 },
                education: { landing: 1.0, corporate: 1.0, shop: 0.9, webapp: 1.4 }
            };

            if (niche !== 'general' && nicheMultipliers[niche] && nicheMultipliers[niche][devType]) {
                basePrice = Math.round(basePrice * nicheMultipliers[niche][devType]);
                if (similarCases[niche]) {
                    similarCase = similarCases[niche];
                }
            }

            price = Math.round(basePrice + (pages - 5) * 30000);
        } else if (service === 'ads') {
            const budget = parseInt(document.querySelector('[name="budget"]').value) || 100000;
            const platform = document.querySelector('[name="platform"]').value;
            let percentage = 0.12;
            if (platform === 'both') percentage = 0.15;
            
            price = Math.round(budget * percentage);
        } else if (service === 'ios') {
            const iosType = document.querySelector('[name="ios_type"]').value;
            const screens = parseInt(document.querySelector('[name="ios_screens"]').value) || 12;
            const integrations = document.querySelector('[name="ios_integrations"]').value;

            let basePrice = 0;
            // Более доступные ориентиры по бюджету (тенге)
            if (iosType === 'mvp') basePrice = 600000;            // MVP / пилот
            else if (iosType === 'business') basePrice = 1100000; // Бизнес‑приложение
            else if (iosType === 'complex') basePrice = 1800000;  // Сложный продукт

            // коррекция по количеству экранов
            if (screens > 10) {
                basePrice += (screens - 10) * 40000;
            } else if (screens < 10) {
                basePrice -= (10 - screens) * 20000;
            }

            // коррекция по интеграциям
            if (integrations === 'extended') {
                basePrice *= 1.12;
            } else if (integrations === 'enterprise') {
                basePrice *= 1.25;
            }

            price = Math.round(basePrice);
        }
        
        // сохраняем базовую цену в тенге и обновляем отображение
        lastPriceKzt = price;
        updatePriceDisplay();
        
        // Показываем похожий кейс если есть
        const similarCaseDiv = document.getElementById('similar-case');
        const similarCaseLink = document.getElementById('similar-case-link');
        if (similarCase && similarCaseDiv && similarCaseLink) {
            const lang = '<?php echo $currentLang; ?>';
            similarCaseLink.textContent = similarCase[lang] || similarCase['ru'];
            similarCaseDiv.classList.remove('hidden');
        } else if (similarCaseDiv) {
            similarCaseDiv.classList.add('hidden');
        }
        
        resultDiv.classList.remove('hidden');
        resultDiv.classList.remove('calculator-result-enter');
        void resultDiv.offsetWidth;
        resultDiv.classList.add('calculator-result-enter');
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    async function sendCalculationLead(name, phone) {
        const data = new FormData();
        data.append('type', 'contact');
        data.append('form_name', '<?php echo $currentLang === 'en' ? 'Calculator Lead' : 'Заявка из калькулятора'; ?>');
        data.append('name', name);
        data.append('phone', phone);
        data.append('message', '<?php echo $currentLang === 'en' ? 'Lead from calculator' : 'Заявка из калькулятора'; ?>: ' + priceDiv.textContent + '; service=' + (document.querySelector('.service-radio:checked')?.value || 'n/a'));
        data.append('website', '');
        const response = await fetch('/backend/send.php', { method: 'POST', body: data });
        return response.json();
    }

    // Сохранение расчета
    const saveBtn = document.getElementById('saveCalculation');
    if (saveBtn) {
        saveBtn.addEventListener('click', async function() {
            const fallbackName = '<?php echo $currentLang === "en" ? "Website visitor" : "Посетитель сайта"; ?>';
            const fallbackPhone = '+70000000000';
            try {
                const res = await sendCalculationLead(fallbackName, fallbackPhone);
                alert(res.success
                    ? '<?php echo $currentLang === "en" ? "Saved. Our team will contact you shortly." : "Сохранено. Мы скоро с вами свяжемся."; ?>'
                    : '<?php echo $currentLang === "en" ? "Unable to save now. Please use the short form below." : "Не удалось сохранить. Используйте форму ниже."; ?>');
            } catch (err) {
                alert('<?php echo $currentLang === "en" ? "Network error. Please use the short form below." : "Ошибка сети. Используйте форму ниже."; ?>');
            }
        });
    }

    if (calcLeadForm) {
        calcLeadForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const name = document.getElementById('calcName').value.trim();
            const phone = document.getElementById('calcPhone').value.trim();
            const phoneDigits = phone.replace(/[^\d+]/g, '');
            if (!name || !phone || phoneDigits.length < 8) {
                calcLeadMessage.classList.remove('hidden');
                calcLeadMessage.textContent = '<?php echo $currentLang === "en" ? "Please enter name and a valid phone number." : "Введите имя и корректный номер телефона."; ?>';
                return;
            }
            const submitBtn = calcLeadForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === "en" ? "Sending..." : "Отправляем..."; ?>';
            try {
                const res = await sendCalculationLead(name, phone);
                calcLeadMessage.classList.remove('hidden');
                calcLeadMessage.textContent = res.success
                    ? '<?php echo $currentLang === "en" ? "Great, we will contact you within 2 hours." : "Отлично, свяжемся с вами в течение 2 часов."; ?>'
                    : '<?php echo $currentLang === "en" ? "Could not send now. Please try again." : "Не удалось отправить. Попробуйте еще раз."; ?>';
                if (res.success) calcLeadForm.reset();
            } catch (err) {
                calcLeadMessage.classList.remove('hidden');
                calcLeadMessage.textContent = '<?php echo $currentLang === "en" ? "Network error. Please try again." : "Ошибка сети. Попробуйте еще раз."; ?>';
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });
    
    document.querySelectorAll('.reveal').forEach(el => {
        scrollObserver.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
