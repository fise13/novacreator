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
                    <?php echo htmlspecialchars(t('pages.calculator.formSubtitle')); ?>
                </p>
            </div>
            
            <form id="calculatorForm" class="reveal space-y-8">
                <!-- Выбор услуги -->
                <div>
                    <label class="block text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.calculator.selectService')); ?>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="seo" class="hidden service-radio" checked>
                            <div class="border-2 rounded-lg p-6 text-center hover:border-black transition-colors service-card-option" style="border-color: var(--color-border);">
                                <div class="text-3xl mb-3">🔍</div>
                                <div class="font-semibold text-lg mb-2" style="color: var(--color-text);">
                                    <?php echo htmlspecialchars(t('pages.calculator.services.seo')); ?>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="development" class="hidden service-radio">
                            <div class="border-2 rounded-lg p-6 text-center hover:border-black transition-colors service-card-option" style="border-color: var(--color-border);">
                                <div class="text-3xl mb-3">💻</div>
                                <div class="font-semibold text-lg mb-2" style="color: var(--color-text);">
                                    <?php echo htmlspecialchars(t('pages.calculator.services.development')); ?>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="service" value="ads" class="hidden service-radio">
                            <div class="border-2 rounded-lg p-6 text-center hover:border-black transition-colors service-card-option" style="border-color: var(--color-border);">
                                <div class="text-3xl mb-3">📢</div>
                                <div class="font-semibold text-lg mb-2" style="color: var(--color-text);">
                                    <?php echo htmlspecialchars(t('pages.calculator.services.ads')); ?>
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
                        <select name="site_type" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
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
                        <select name="region" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
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
                        <select name="competition" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
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
                            <?php echo htmlspecialchars(t('pages.calculator.development.siteType')); ?>
                        </label>
                        <select name="dev_type" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
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
                        <input type="number" name="pages" value="10" min="1" max="100" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
                    </div>
                </div>

                <!-- Параметры для рекламы -->
                <div id="ads-options" class="service-options hidden space-y-6">
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.ads.budget')); ?>
                        </label>
                        <input type="number" name="budget" value="100000" min="50000" step="10000" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
                    </div>
                    <div>
                        <label class="block text-lg md:text-xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.ads.platform')); ?>
                        </label>
                        <select name="platform" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);">
                            <option value="google" selected><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.google')); ?></option>
                            <option value="yandex"><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.yandex')); ?></option>
                            <option value="both"><?php echo htmlspecialchars(t('pages.calculator.ads.platforms.both')); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Результат -->
                <div class="space-y-6">
                    <button type="button" id="calculateBtn" class="w-full px-10 py-5 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px]">
                        <?php echo htmlspecialchars(t('pages.calculator.calculate')); ?>
                    </button>

                    <div id="result" class="border-2 rounded-lg p-8 hidden" style="border-color: var(--color-border);">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.calculator.result.title')); ?>
                        </h3>
                        <div class="text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);" id="price">0 ₸</div>
                        <p class="text-lg mb-6" style="color: var(--color-text-secondary);" id="price-note">
                            <?php echo htmlspecialchars(t('pages.calculator.result.note')); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-8 py-4 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200">
                            <?php echo htmlspecialchars(t('pages.calculator.result.button')); ?>
                        </a>
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

    serviceRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.service-options').forEach(opt => opt.classList.add('hidden'));
            document.getElementById(this.value + '-options').classList.remove('hidden');
            document.querySelectorAll('.service-card-option').forEach(card => {
                card.classList.remove('border-black', 'bg-gray-50');
            });
            this.closest('label').querySelector('.service-card-option').classList.add('border-black', 'bg-gray-50');
        });
    });

    document.querySelector('.service-radio:checked').dispatchEvent(new Event('change'));

    calculateBtn.addEventListener('click', function() {
        const service = document.querySelector('.service-radio:checked').value;
        let price = 0;

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
            
            let basePrice = 0;
            if (devType === 'landing') basePrice = 180000;
            else if (devType === 'corporate') basePrice = 300000;
            else if (devType === 'shop') basePrice = 500000;
            else if (devType === 'webapp') basePrice = 750000;

            price = Math.round(basePrice + (pages - 5) * 30000);
        } else if (service === 'ads') {
            const budget = parseInt(document.querySelector('[name="budget"]').value) || 100000;
            const platform = document.querySelector('[name="platform"]').value;
            
            let percentage = 0.12;
            if (platform === 'both') percentage = 0.15;
            
            price = Math.round(budget * percentage);
        }

        priceDiv.textContent = price.toLocaleString('ru-RU') + ' ₸';
        resultDiv.classList.remove('hidden');
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
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
