<?php
/**
 * Калькулятор стоимости услуг
 * Позволяет рассчитать примерную стоимость услуг
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.calculator.breadcrumb');
$pageMetaTitle = t('seo.pages.calculator.title');
$pageMetaDescription = t('seo.pages.calculator.description');
$pageMetaKeywords = t('seo.pages.calculator.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.calculator.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.calculator.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Калькулятор -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-dark-surface border border-dark-border rounded-3xl p-6 md:p-8 lg:p-10 mb-8 shadow-xl shadow-black/30">
                <!-- Верхняя панель c шагами -->
                <div class="mb-8 md:mb-10">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-gradient">
                            <?php echo htmlspecialchars(t('pages.calculator.formTitle')); ?>
                        </h2>
                        <p class="text-sm md:text-base text-gray-400 max-w-xl">
                            <?php echo htmlspecialchars(t('pages.calculator.formSubtitle')); ?>
                        </p>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-xs md:text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-white font-semibold">1</div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.calculator.steps.service')); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full border border-neon-purple/40 text-neon-purple flex items-center justify-center font-semibold">2</div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.calculator.steps.params')); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full border border-neon-purple/40 text-neon-purple flex items-center justify-center font-semibold">3</div>
                            <span class="text-gray-300"><?php echo htmlspecialchars(t('pages.calculator.steps.result')); ?></span>
                        </div>
                    </div>
                </div>

                <form id="calculatorForm" class="space-y-10">
                    <!-- Выбор услуги -->
                    <div>
                        <label class="block text-base md:text-lg font-semibold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.selectService')); ?></label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="service-option cursor-pointer">
                                <input type="radio" name="service" value="seo" class="hidden service-radio" checked>
                                <div class="service-card-option bg-dark-bg/80 border-2 border-dark-border rounded-2xl p-4 md:p-5 text-center hover:border-neon-purple transition-all duration-300 flex flex-col items-center justify-center gap-2">
                                    <div class="w-11 h-11 md:w-12 md:h-12 rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-2xl">🔍</div>
                                    <div class="font-semibold text-sm md:text-base"><?php echo htmlspecialchars(t('pages.calculator.services.seo')); ?></div>
                                    <p class="text-[11px] md:text-xs text-gray-500 max-w-[12rem]">
                                        <?php echo htmlspecialchars(t('pages.calculator.services.seoHint')); ?>
                                    </p>
                                </div>
                            </label>
                            <label class="service-option cursor-pointer">
                                <input type="radio" name="service" value="development" class="hidden service-radio">
                                <div class="service-card-option bg-dark-bg/80 border-2 border-dark-border rounded-2xl p-4 md:p-5 text-center hover:border-neon-purple transition-all duration-300 flex flex-col items-center justify-center gap-2">
                                    <div class="w-11 h-11 md:w-12 md:h-12 rounded-xl bg-gradient-to-r from-neon-blue to-neon-purple flex items-center justify-center text-2xl">💻</div>
                                    <div class="font-semibold text-sm md:text-base"><?php echo htmlspecialchars(t('pages.calculator.services.development')); ?></div>
                                    <p class="text-[11px] md:text-xs text-gray-500 max-w-[12rem]">
                                        <?php echo htmlspecialchars(t('pages.calculator.services.developmentHint')); ?>
                                    </p>
                                </div>
                            </label>
                            <label class="service-option cursor-pointer">
                                <input type="radio" name="service" value="ads" class="hidden service-radio">
                                <div class="service-card-option bg-dark-bg/80 border-2 border-dark-border rounded-2xl p-4 md:p-5 text-center hover:border-neon-purple transition-all duration-300 flex flex-col items-center justify-center gap-2">
                                    <div class="w-11 h-11 md:w-12 md:h-12 rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-2xl">📢</div>
                                    <div class="font-semibold text-sm md:text-base"><?php echo htmlspecialchars(t('pages.calculator.services.ads')); ?></div>
                                    <p class="text-[11px] md:text-xs text-gray-500 max-w-[12rem]">
                                        <?php echo htmlspecialchars(t('pages.calculator.services.adsHint')); ?>
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Параметры для SEO -->
                    <div id="seo-options" class="service-options">
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.seo.siteType')); ?></label>
                            <p class="text-xs md:text-sm text-gray-500 mb-3"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypeHint')); ?></p>
                            <select name="site_type" class="form-input">
                                <option value="small"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.small')); ?></option>
                                <option value="medium" selected><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.medium')); ?></option>
                                <option value="large"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.large')); ?></option>
                                <option value="shop"><?php echo htmlspecialchars(t('pages.calculator.seo.siteTypes.shop')); ?></option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.seo.region')); ?></label>
                            <p class="text-xs md:text-sm text-gray-500 mb-3"><?php echo htmlspecialchars(t('pages.calculator.seo.regionHint')); ?></p>
                            <select name="region" class="form-input">
                                <option value="local"><?php echo htmlspecialchars(t('pages.calculator.seo.regions.local')); ?></option>
                                <option value="regional" selected><?php echo htmlspecialchars(t('pages.calculator.seo.regions.regional')); ?></option>
                                <option value="national"><?php echo htmlspecialchars(t('pages.calculator.seo.regions.national')); ?></option>
                                <option value="international"><?php echo htmlspecialchars(t('pages.calculator.seo.regions.international')); ?></option>
                            </select>
                        </div>
                        <div class="mb-1 md:mb-2">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.seo.competition')); ?></label>
                            <p class="text-xs md:text-sm text-gray-500 mb-3"><?php echo htmlspecialchars(t('pages.calculator.seo.competitionHint')); ?></p>
                            <select name="competition" class="form-input">
                                <option value="low"><?php echo htmlspecialchars(t('pages.calculator.seo.competitions.low')); ?></option>
                                <option value="medium" selected><?php echo htmlspecialchars(t('pages.calculator.seo.competitions.medium')); ?></option>
                                <option value="high"><?php echo htmlspecialchars(t('pages.calculator.seo.competitions.high')); ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Параметры для разработки -->
                    <div id="development-options" class="service-options hidden">
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.development.siteType')); ?></label>
                            <p class="text-xs md:text-sm text-gray-500 mb-3"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypeHint')); ?></p>
                            <select name="dev_type" class="form-input">
                                <option value="landing"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.landing')); ?></option>
                                <option value="corporate" selected><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.corporate')); ?></option>
                                <option value="shop"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.shop')); ?></option>
                                <option value="webapp"><?php echo htmlspecialchars(t('pages.calculator.development.siteTypes.webapp')); ?></option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.development.pages')); ?></label>
                            <p class="text-xs md:text-sm text-gray-500 mb-3"><?php echo htmlspecialchars(t('pages.calculator.development.pagesHint')); ?></p>
                            <input type="number" name="pages" value="10" min="1" max="100" class="form-input">
                        </div>
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.development.features')); ?></label>
                            <div class="space-y-2">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="cms" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span><?php echo htmlspecialchars(t('pages.calculator.development.featuresList.cms')); ?></span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="payment" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span><?php echo htmlspecialchars(t('pages.calculator.development.featuresList.payment')); ?></span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="api" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span><?php echo htmlspecialchars(t('pages.calculator.development.featuresList.api')); ?></span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="mobile" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span><?php echo htmlspecialchars(t('pages.calculator.development.featuresList.mobile')); ?></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Параметры для рекламы -->
                    <div id="ads-options" class="service-options hidden">
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.ads.budget')); ?></label>
                            <p class="text-xs md:text-sm text-gray-500 mb-3"><?php echo htmlspecialchars(t('pages.calculator.ads.budgetHint')); ?></p>
                            <input type="number" name="budget" value="100000" min="50000" step="10000" class="form-input">
                            <p class="text-sm text-gray-500 mt-2"><?php echo htmlspecialchars(t('pages.calculator.ads.budgetNote')); ?></p>
                        </div>
                        <div class="mb-6">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.ads.platform')); ?></label>
                            <select name="platform" class="form-input">
                                <option value="google" selected><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.google')); ?></option>
                                <option value="yandex"><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.yandex')); ?></option>
                                <option value="both"><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.both')); ?></option>
                            </select>
                        </div>
                        <div class="mb-1 md:mb-2">
                            <label class="block text-base md:text-lg font-semibold mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.ads.adType')); ?></label>
                            <select name="ad_type" class="form-input">
                                <option value="search" selected><?php echo htmlspecialchars(t('pages.calculator.ads.adTypes.search')); ?></option>
                                <option value="display"><?php echo htmlspecialchars(t('pages.calculator.ads.adTypes.display')); ?></option>
                                <option value="video"><?php echo htmlspecialchars(t('pages.calculator.ads.adTypes.video')); ?></option>
                                <option value="shopping"><?php echo htmlspecialchars(t('pages.calculator.ads.adTypes.shopping')); ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Результат -->
                    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr)_minmax(0,1.2fr)] gap-6 items-stretch">
                        <button type="button" id="calculateBtn" class="btn-neon w-full h-14 md:h-auto flex items-center justify-center text-base md:text-lg">
                            <?php echo htmlspecialchars(t('pages.calculator.calculate')); ?>
                        </button>

                        <div id="result" class="bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/50 rounded-xl p-6 md:p-8 hidden">
                            <h3 class="text-2xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.result.title')); ?></h3>
                            <div class="text-4xl md:text-5xl font-bold text-gradient mb-3" id="price">0 ₸</div>
                            <p class="text-gray-300 mb-4 text-sm md:text-base" id="price-note"><?php echo htmlspecialchars(t('pages.calculator.result.note')); ?></p>
                            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-flex items-center justify-center w-full md:w-auto">
                                <?php echo htmlspecialchars(t('pages.calculator.result.button')); ?>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Дополнительная информация -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-8">
                <h3 class="text-2xl font-bold mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.calculator.important.title')); ?></h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span><?php echo htmlspecialchars(t('pages.calculator.important.items.preliminary')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span><?php echo htmlspecialchars(t('pages.calculator.important.items.support')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span><?php echo htmlspecialchars(t('pages.calculator.important.items.flexible')); ?></span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span><?php echo htmlspecialchars(t('pages.calculator.important.items.free')); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('calculatorForm');
    const serviceRadios = document.querySelectorAll('.service-radio');
    const resultDiv = document.getElementById('result');
    const priceDiv = document.getElementById('price');
    const priceNote = document.getElementById('price-note');
    const calculateBtn = document.getElementById('calculateBtn');

    // Переключение между услугами
    serviceRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Скрываем все опции
            document.querySelectorAll('.service-options').forEach(opt => {
                opt.classList.add('hidden');
            });
            
            // Показываем нужные опции
            const service = this.value;
            document.getElementById(service + '-options').classList.remove('hidden');
            
            // Обновляем визуальное выделение
            document.querySelectorAll('.service-card-option').forEach(card => {
                card.classList.remove('border-neon-purple', 'bg-neon-purple/10');
            });
            this.closest('.service-option').querySelector('.service-card-option').classList.add('border-neon-purple', 'bg-neon-purple/10');
        });
    });

    // Выделение первой опции
    document.querySelector('.service-radio:checked').dispatchEvent(new Event('change'));

    // Расчет стоимости
    calculateBtn.addEventListener('click', function() {
        const service = document.querySelector('.service-radio:checked').value;
        let price = 0;

        if (service === 'seo') {
            const siteType = document.querySelector('[name="site_type"]').value;
            const region = document.querySelector('[name="region"]').value;
            const competition = document.querySelector('[name="competition"]').value;
            
            let basePrice = 0;
            if (siteType === 'small') basePrice = 150000;
            else if (siteType === 'medium') basePrice = 250000;
            else if (siteType === 'large') basePrice = 400000;
            else if (siteType === 'shop') basePrice = 350000;

            if (region === 'local') basePrice *= 0.8;
            else if (region === 'international') basePrice *= 1.5;

            if (competition === 'low') basePrice *= 0.9;
            else if (competition === 'high') basePrice *= 1.3;

            price = Math.round(basePrice);
            priceNote.textContent = '<?php echo htmlspecialchars(t('pages.calculator.result.seoNote'), ENT_QUOTES); ?>';

        } else if (service === 'development') {
            const devType = document.querySelector('[name="dev_type"]').value;
            const pages = parseInt(document.querySelector('[name="pages"]').value) || 10;
            const features = Array.from(document.querySelectorAll('[name="features[]"]:checked')).map(cb => cb.value);

            let basePrice = 0;
            if (devType === 'landing') basePrice = 200000;
            else if (devType === 'corporate') basePrice = 400000;
            else if (devType === 'shop') basePrice = 600000;
            else if (devType === 'webapp') basePrice = 800000;

            basePrice += (pages - 5) * 15000;
            if (pages < 5) basePrice = Math.max(basePrice, 200000);

            features.forEach(feature => {
                if (feature === 'cms') basePrice += 50000;
                if (feature === 'payment') basePrice += 100000;
                if (feature === 'api') basePrice += 80000;
                if (feature === 'mobile') basePrice += 500000;
            });

            price = Math.round(basePrice);
            priceNote.textContent = '<?php echo htmlspecialchars(t('pages.calculator.result.devNote'), ENT_QUOTES); ?>';

        } else if (service === 'ads') {
            const budget = parseInt(document.querySelector('[name="budget"]').value) || 100000;
            const platform = document.querySelector('[name="platform"]').value;
            const adType = document.querySelector('[name="ad_type"]').value;

            let percentage = 0.15; // 15% от бюджета
            if (platform === 'both') percentage = 0.2;
            if (adType === 'video') percentage = 0.25;
            if (adType === 'shopping') percentage = 0.18;

            price = Math.round(budget * percentage);
            priceNote.textContent = '<?php echo htmlspecialchars(t('pages.calculator.result.adsNote'), ENT_QUOTES); ?>';
        }

        // Форматирование числа
        priceDiv.textContent = price.toLocaleString('ru-RU') + ' ₸';
        resultDiv.classList.remove('hidden');
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});
</script>

<style>
.service-card-option {
    transition: all 0.3s ease;
}
.service-card-option:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
}
</style>

<?php include 'includes/footer.php'; ?>

