<?php
/**
 * Калькулятор стоимости услуг
 * Позволяет рассчитать примерную стоимость услуг
 */
$pageTitle = 'Калькулятор стоимости';
$pageMetaTitle = 'Калькулятор стоимости услуг | Рассчитать цену - NovaCreator Studio';
$pageMetaDescription = 'Рассчитайте стоимость услуг digital-агентства: SEO-продвижение, разработка сайтов, Google Ads. Быстрый расчет цены онлайн.';
$pageMetaKeywords = 'калькулятор стоимости, рассчитать цену, стоимость SEO, цена разработки сайта, стоимость рекламы, калькулятор услуг';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-gradient">Калькулятор стоимости</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Рассчитайте примерную стоимость услуг для вашего проекта
            </p>
        </div>
    </div>
</section>

<!-- Калькулятор -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-8 mb-8">
                <form id="calculatorForm" class="space-y-8">
                    <!-- Выбор услуги -->
                    <div>
                        <label class="block text-lg font-semibold mb-4 text-gradient">Выберите услугу</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="service-option cursor-pointer">
                                <input type="radio" name="service" value="seo" class="hidden service-radio" checked>
                                <div class="bg-dark-bg border-2 border-dark-border rounded-xl p-4 text-center hover:border-neon-purple transition-all duration-300 service-card-option">
                                    <div class="text-2xl mb-2">🔍</div>
                                    <div class="font-semibold">SEO-продвижение</div>
                                </div>
                            </label>
                            <label class="service-option cursor-pointer">
                                <input type="radio" name="service" value="development" class="hidden service-radio">
                                <div class="bg-dark-bg border-2 border-dark-border rounded-xl p-4 text-center hover:border-neon-purple transition-all duration-300 service-card-option">
                                    <div class="text-2xl mb-2">💻</div>
                                    <div class="font-semibold">Разработка сайта</div>
                                </div>
                            </label>
                            <label class="service-option cursor-pointer">
                                <input type="radio" name="service" value="ads" class="hidden service-radio">
                                <div class="bg-dark-bg border-2 border-dark-border rounded-xl p-4 text-center hover:border-neon-purple transition-all duration-300 service-card-option">
                                    <div class="text-2xl mb-2">📢</div>
                                    <div class="font-semibold">Google Ads</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Параметры для SEO -->
                    <div id="seo-options" class="service-options">
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Тип сайта</label>
                            <select name="site_type" class="form-input">
                                <option value="small">Небольшой сайт (до 50 страниц)</option>
                                <option value="medium" selected>Средний сайт (50-200 страниц)</option>
                                <option value="large">Крупный сайт (200+ страниц)</option>
                                <option value="shop">Интернет-магазин</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Регион продвижения</label>
                            <select name="region" class="form-input">
                                <option value="local">Локальный (один город)</option>
                                <option value="regional" selected>Региональный (область/регион)</option>
                                <option value="national">По всему Казахстану</option>
                                <option value="international">Международное</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Конкуренция в нише</label>
                            <select name="competition" class="form-input">
                                <option value="low">Низкая</option>
                                <option value="medium" selected>Средняя</option>
                                <option value="high">Высокая</option>
                            </select>
                        </div>
                    </div>

                    <!-- Параметры для разработки -->
                    <div id="development-options" class="service-options hidden">
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Тип сайта</label>
                            <select name="dev_type" class="form-input">
                                <option value="landing">Лендинг (одна страница)</option>
                                <option value="corporate" selected>Корпоративный сайт</option>
                                <option value="shop">Интернет-магазин</option>
                                <option value="webapp">Веб-приложение</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Количество страниц</label>
                            <input type="number" name="pages" value="10" min="1" max="100" class="form-input">
                        </div>
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Дополнительные функции</label>
                            <div class="space-y-2">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="cms" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span>Система управления контентом (CMS)</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="payment" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span>Интеграция платежных систем</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="api" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span>API интеграции</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="mobile" class="w-5 h-5 rounded border-dark-border bg-dark-surface text-neon-purple focus:ring-neon-purple">
                                    <span>Мобильное приложение</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Параметры для рекламы -->
                    <div id="ads-options" class="service-options hidden">
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Бюджет на рекламу в месяц</label>
                            <input type="number" name="budget" value="100000" min="50000" step="10000" class="form-input">
                            <p class="text-sm text-gray-500 mt-2">от 50 000 ₸</p>
                        </div>
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Платформа</label>
                            <select name="platform" class="form-input">
                                <option value="google" selected>Google Ads</option>
                                <option value="yandex">Яндекс.Директ</option>
                                <option value="both">Обе платформы</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-lg font-semibold mb-4 text-gradient">Тип рекламы</label>
                            <select name="ad_type" class="form-input">
                                <option value="search" selected>Поисковая реклама</option>
                                <option value="display">Медийная реклама</option>
                                <option value="video">Видеореклама</option>
                                <option value="shopping">Shopping кампании</option>
                            </select>
                        </div>
                    </div>

                    <!-- Результат -->
                    <div id="result" class="bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/50 rounded-xl p-6 md:p-8 hidden">
                        <h3 class="text-2xl font-bold mb-4 text-gradient">Примерная стоимость</h3>
                        <div class="text-4xl md:text-5xl font-bold text-gradient mb-4" id="price">0 ₸</div>
                        <p class="text-gray-400 mb-6" id="price-note">Это ориентировочная стоимость. Точная цена рассчитывается после консультации.</p>
                        <a href="/contact" class="btn-neon inline-block">
                            Получить точный расчет
                        </a>
                    </div>

                    <button type="button" id="calculateBtn" class="btn-neon w-full md:w-auto">
                        Рассчитать стоимость
                    </button>
                </form>
            </div>

            <!-- Дополнительная информация -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-8">
                <h3 class="text-2xl font-bold mb-4 text-gradient">Важно знать</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span>Это предварительный расчет. Точная стоимость определяется после анализа вашего проекта</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span>В стоимость может входить дополнительное обслуживание и поддержка</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span>Мы предлагаем гибкие условия оплаты и индивидуальные тарифы</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-neon-purple mt-1">✓</span>
                        <span>Первая консультация бесплатна</span>
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
            priceNote.textContent = 'Стоимость включает: технический аудит, оптимизацию контента, работу с мета-тегами, внутреннюю перелинковку, ежемесячные отчеты.';

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
            priceNote.textContent = 'Стоимость включает: дизайн, верстку, программирование, адаптивность, базовую SEO-оптимизацию, тестирование.';

        } else if (service === 'ads') {
            const budget = parseInt(document.querySelector('[name="budget"]').value) || 100000;
            const platform = document.querySelector('[name="platform"]').value;
            const adType = document.querySelector('[name="ad_type"]').value;

            let percentage = 0.15; // 15% от бюджета
            if (platform === 'both') percentage = 0.2;
            if (adType === 'video') percentage = 0.25;
            if (adType === 'shopping') percentage = 0.18;

            price = Math.round(budget * percentage);
            priceNote.textContent = 'Стоимость включает: настройку кампаний, создание объявлений, работу с ключевыми словами, оптимизацию, ежемесячное ведение и отчетность.';
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
    transform: translateY(-2px);
}
</style>

<?php include 'includes/footer.php'; ?>

