<?php
/**
 * Страница портфолио
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('portfolio.breadcrumb');
$pageMetaTitle = t('seo.pages.portfolio.title');
$pageMetaDescription = t('seo.pages.portfolio.description');
$pageMetaKeywords = t('seo.pages.portfolio.keywords');
include 'includes/header.php';

// Список кейсов
$cases = ['ecommerce', 'fintech', 'saas', 'local', 'service', 'hotel', 'fitness', 'corporate'];
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-[70vh] flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('portfolio.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('portfolio.subtitle')); ?>
            </p>
            <p class="text-sm md:text-base lg:text-lg reveal opacity-75" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('portfolio.disclaimer')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Секция с кейсами -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Карточки кейсов -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
                <?php foreach ($cases as $caseKey): ?>
                    <?php
                    $case = t('portfolio.cases.' . $caseKey);
                    if (!$case || !isset($case['title'])) continue;
                    ?>
                    <div class="portfolio-card group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" 
                         style="background-color: var(--color-bg); border: 1px solid var(--color-border);"
                         data-case="<?php echo htmlspecialchars($caseKey); ?>"
                         onclick="openCaseModal('<?php echo htmlspecialchars($caseKey); ?>')">
                        <!-- Тип проекта -->
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 text-xs md:text-sm font-medium rounded-full" style="background-color: var(--color-bg-lighter); color: var(--color-text-secondary);">
                                <?php echo htmlspecialchars($case['type'] ?? ''); ?>
                            </span>
                        </div>
                        
                        <!-- Заголовок -->
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($case['title'] ?? ''); ?>
                        </h3>
                        
                        <!-- Краткое описание -->
                        <p class="text-base sm:text-lg mb-6 leading-relaxed line-clamp-3" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($case['challenge'] ?? ''); ?>
                        </p>
                        
                        <!-- Ключевые метрики (первые 2) -->
                        <?php if (isset($case['metrics']) && is_array($case['metrics'])): 
                            $metricLabels = [
                                'conversion' => $currentLang === 'en' ? 'Conversion' : 'Конверсия',
                                'bounce' => $currentLang === 'en' ? 'Bounce' : 'Отказы',
                                'speed' => $currentLang === 'en' ? 'Speed' : 'Скорость',
                                'revenue' => $currentLang === 'en' ? 'Revenue' : 'Выручка',
                                'registration' => $currentLang === 'en' ? 'Registration' : 'Регистрация',
                                'retention' => $currentLang === 'en' ? 'Retention' : 'Удержание',
                                'loadTime' => $currentLang === 'en' ? 'Speed' : 'Скорость',
                                'users' => $currentLang === 'en' ? 'Users' : 'Пользователи',
                            ];
                            $metricsArray = array_slice($case['metrics'], 0, 2, true);
                        ?>
                            <div class="mb-6 space-y-2">
                                <?php foreach ($metricsArray as $metricKey => $metricValue): 
                                    $metricLabel = $metricLabels[$metricKey] ?? ucfirst($metricKey);
                                ?>
                                    <div class="flex items-center justify-between text-sm md:text-base">
                                        <span style="color: var(--color-text-secondary);"><?php echo htmlspecialchars($metricLabel); ?></span>
                                        <span class="font-bold" style="color: var(--color-text);"><?php echo htmlspecialchars($metricValue); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Ссылка "Подробнее" -->
                        <div class="flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 group-hover:translate-x-1" style="color: var(--color-text);">
                            <span><?php echo htmlspecialchars(t('portfolio.labels.viewDetails')); ?></span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Модальные окна для деталей кейсов -->
<?php foreach ($cases as $caseKey): ?>
    <?php
    $case = t('portfolio.cases.' . $caseKey);
    if (!$case || !isset($case['title'])) continue;
    ?>
    <div id="modal-<?php echo htmlspecialchars($caseKey); ?>" 
         class="fixed inset-0 z-50 hidden items-center justify-center p-4" 
         style="background-color: rgba(0, 0, 0, 0.75); backdrop-filter: blur(4px);"
         onclick="closeCaseModal('<?php echo htmlspecialchars($caseKey); ?>')">
        <div class="relative max-w-4xl w-full max-h-[90vh] overflow-y-auto rounded-2xl p-6 md:p-8 lg:p-10 transform transition-all duration-300"
             style="background-color: var(--color-bg); border: 1px solid var(--color-border);"
             onclick="event.stopPropagation()">
            <!-- Кнопка закрытия -->
            <button onclick="closeCaseModal('<?php echo htmlspecialchars($caseKey); ?>')" 
                    class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200 hover:bg-opacity-20 hover:scale-110 touch-manipulation"
                    style="background-color: var(--color-bg-lighter); color: var(--color-text);"
                    aria-label="<?php echo htmlspecialchars(t('portfolio.labels.close')); ?>">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Тип проекта -->
            <div class="mb-4">
                <span class="inline-block px-3 py-1 text-sm font-medium rounded-full" style="background-color: var(--color-bg-lighter); color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars($case['type'] ?? ''); ?>
                </span>
            </div>
            
            <!-- Заголовок -->
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                <?php echo htmlspecialchars($case['title'] ?? ''); ?>
            </h2>
            
            <!-- Клиент -->
            <?php if (isset($case['client'])): ?>
                <p class="text-base md:text-lg mb-6" style="color: var(--color-text-secondary);">
                    <strong style="color: var(--color-text);"><?php echo htmlspecialchars($currentLang === 'en' ? 'Client:' : 'Клиент:'); ?></strong> 
                    <?php echo htmlspecialchars($case['client']); ?>
                </p>
            <?php endif; ?>
            
            <!-- Задача -->
            <div class="mb-8">
                <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('portfolio.labels.challenge')); ?>
                </h3>
                <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars($case['challenge'] ?? ''); ?>
                </p>
            </div>
            
            <!-- Решение -->
            <div class="mb-8">
                <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('portfolio.labels.solution')); ?>
                </h3>
                <p class="text-base md:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars($case['solution'] ?? ''); ?>
                </p>
            </div>
            
            <!-- Результаты -->
            <?php if (isset($case['metrics']) && is_array($case['metrics'])): ?>
                <div class="mb-8">
                    <h3 class="text-xl md:text-2xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('portfolio.labels.results')); ?>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php foreach ($case['metrics'] as $metricKey => $metricValue): 
                            $metricLabels = [
                                'conversion' => $currentLang === 'en' ? 'Conversion Rate' : 'Конверсия',
                                'bounce' => $currentLang === 'en' ? 'Bounce Rate' : 'Показатель отказов',
                                'speed' => $currentLang === 'en' ? 'Load Speed' : 'Скорость загрузки',
                                'revenue' => $currentLang === 'en' ? 'Revenue' : 'Выручка',
                                'registration' => $currentLang === 'en' ? 'Registration Rate' : 'Регистрация',
                                'retention' => $currentLang === 'en' ? 'Retention' : 'Удержание',
                                'loadTime' => $currentLang === 'en' ? 'Load Time' : 'Время загрузки',
                                'users' => $currentLang === 'en' ? 'Users' : 'Пользователи',
                                'trial' => $currentLang === 'en' ? 'Trial Signups' : 'Триалы',
                                'churn' => $currentLang === 'en' ? 'Churn Rate' : 'Отток',
                                'mrr' => $currentLang === 'en' ? 'MRR' : 'MRR',
                                'traffic' => $currentLang === 'en' ? 'Traffic' : 'Трафик',
                                'orders' => $currentLang === 'en' ? 'Daily Orders' : 'Заказов в день',
                                'calls' => $currentLang === 'en' ? 'Calls' : 'Звонки',
                                'appointments' => $currentLang === 'en' ? 'Appointments' : 'Записи',
                                'patients' => $currentLang === 'en' ? 'New Patients' : 'Новые пациенты',
                                'directBookings' => $currentLang === 'en' ? 'Direct Bookings' : 'Прямые бронирования',
                                'otaDependency' => $currentLang === 'en' ? 'OTA Dependency' : 'Зависимость от OTA',
                                'repeatGuests' => $currentLang === 'en' ? 'Repeat Guests' : 'Повторные гости',
                                'bookings' => $currentLang === 'en' ? 'Class Bookings' : 'Записи на занятия',
                                'members' => $currentLang === 'en' ? 'New Members' : 'Новые участники',
                                'leads' => $currentLang === 'en' ? 'Leads' : 'Лиды',
                                'seoRank' => $currentLang === 'en' ? 'SEO Rankings' : 'SEO-позиции',
                                'engagement' => $currentLang === 'en' ? 'Engagement' : 'Вовлеченность',
                            ];
                            $metricLabel = $metricLabels[$metricKey] ?? ucfirst($metricKey);
                        ?>
                            <div class="p-4 rounded-xl" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                                <div class="text-sm md:text-base mb-1" style="color: var(--color-text-secondary);">
                                    <?php echo htmlspecialchars($metricLabel); ?>
                                </div>
                                <div class="text-2xl md:text-3xl font-bold" style="color: var(--color-text);">
                                    <?php echo htmlspecialchars($metricValue); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Технологии -->
            <?php if (isset($case['tech'])): ?>
                <div class="mb-8">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('portfolio.labels.technologies')); ?>
                    </h3>
                    <p class="text-base md:text-lg" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars($case['tech']); ?>
                    </p>
                </div>
            <?php endif; ?>
            
            <!-- Сроки -->
            <?php if (isset($case['duration'])): ?>
                <div class="mb-8">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('portfolio.labels.duration')); ?>
                    </h3>
                    <p class="text-base md:text-lg" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars($case['duration']); ?>
                    </p>
                </div>
            <?php endif; ?>
            
            <!-- CTA -->
            <div class="mt-8 pt-6 border-t" style="border-color: var(--color-border);">
                <a href="#contact-form" 
                   onclick="closeCaseModal('<?php echo htmlspecialchars($caseKey); ?>'); const el = document.getElementById('contact-form'); if(el) { setTimeout(() => el.scrollIntoView({behavior: 'smooth'}), 300); } return false;"
                   class="inline-flex items-center gap-2 px-8 py-4 text-base md:text-lg font-semibold rounded-lg transition-all duration-200 hover:scale-105 hover:shadow-xl touch-manipulation"
                   style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; text-decoration: none;">
                    <span><?php echo htmlspecialchars($case['ctaText'] ?? t('portfolio.cta.button')); ?></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- CTA секция -->
<?php
$ctaTitle = t('portfolio.cta.title');
$ctaSubtitle = t('portfolio.cta.subtitle');
$ctaButtonText = t('portfolio.cta.button');
$ctaButtonUrl = '#contact-form';
$ctaBgColor = 'bg';
include __DIR__ . '/includes/partials/cta-section.php';
?>

<!-- Форма контактов -->
<section id="contact-form" class="reveal-group py-12 sm:py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 sm:px-5 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8 sm:mb-12 md:mb-16 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl 2xl:text-9xl font-black leading-[0.9] sm:leading-[0.85] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Let\'s discuss your project' : 'Обсудим ваш проект'; ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-10 md:gap-12 lg:gap-16 xl:gap-20">
                <!-- Контактная информация -->
                <div class="reveal order-2 lg:order-1">
                    <div class="mb-6 sm:mb-8 md:mb-10">
                        <h3 class="text-base sm:text-lg md:text-xl lg:text-2xl font-semibold mb-2 sm:mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Our phone' : 'Наш телефон'; ?>
                        </h3>
                        <a href="tel:+77066063921" class="inline-block text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold transition-colors hover:opacity-80 touch-manipulation min-h-[44px] flex items-center" style="color: var(--color-text);">
                            +7 706 606 39 21
                        </a>
                    </div>

                    <div class="mb-6 sm:mb-8 md:mb-10">
                        <h3 class="text-base sm:text-lg md:text-xl lg:text-2xl font-semibold mb-2 sm:mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Email' : 'Email'; ?>
                        </h3>
                        <a href="mailto:contact@novacreatorstudio.com" class="inline-block text-base sm:text-lg md:text-xl lg:text-2xl font-bold transition-colors hover:opacity-80 break-all touch-manipulation min-h-[44px] flex items-center" style="color: var(--color-text);">
                            contact@novacreatorstudio.com
                        </a>
                    </div>
                </div>

                <!-- Форма -->
                <div class="reveal order-1 lg:order-2">
                    <div class="p-5 sm:p-6 md:p-8 lg:p-10 rounded-xl sm:rounded-2xl transition-all duration-300 hover:shadow-xl" style="background-color: var(--color-bg); border: 2px solid var(--color-border);">
                        <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-5 sm:mb-6 md:mb-8" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Leave a request' : 'Оставить заявку'; ?>
                        </h3>

                        <form class="contact-form space-y-3 sm:space-y-4 md:space-y-6" method="POST" action="/backend/send.php" id="contactFormPortfolio">
                            <input type="hidden" name="type" value="contact">
                            <input type="hidden" name="form_name" value="<?php echo $currentLang === 'en' ? 'Portfolio Contact Form' : 'Форма обратной связи с портфолио'; ?>">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">

                            <!-- Имя -->
                            <div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="portfolio-name"
                                    placeholder="<?php echo $currentLang === 'en' ? 'John' : 'Иван'; ?>"
                                    class="w-full px-4 py-3.5 sm:py-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black text-base sm:text-lg touch-manipulation" 
                                    style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; min-height: 48px; font-size: 16px; -webkit-appearance: none;"
                                    required
                                    autocomplete="name"
                                >
                            </div>

                            <!-- Телефон -->
                            <div>
                                <div class="flex gap-2">
                                    <select 
                                        id="portfolio-phone-country-code"
                                        name="country_code"
                                        class="px-3 sm:px-4 py-3.5 sm:py-4 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black text-base sm:text-lg cursor-pointer appearance-none touch-manipulation" 
                                        style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; min-width: 100px; min-height: 48px; font-size: 16px; -webkit-appearance: none; background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22%3E%3Cpath fill=%22%23000%22 d=%22M6 9L1 4h10z%22/%3E%3C/svg%3E'); background-position: right 0.75rem center; background-repeat: no-repeat; background-size: 12px 12px;"
                                    >
                                        <option value="+7" data-flag="🇰🇿">🇰🇿 +7</option>
                                        <option value="+7" data-flag="🇷🇺">🇷🇺 +7</option>
                                        <option value="+1" data-flag="🇺🇸">🇺🇸 +1</option>
                                        <option value="+380" data-flag="🇺🇦">🇺🇦 +380</option>
                                        <option value="+44" data-flag="🇬🇧">🇬🇧 +44</option>
                                    </select>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        id="portfolio-phone"
                                        placeholder="(000) 000-00-00"
                                        class="flex-1 px-4 py-3.5 sm:py-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black text-base sm:text-lg touch-manipulation" 
                                        style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; min-height: 48px; font-size: 16px; -webkit-appearance: none;"
                                        required
                                        autocomplete="tel"
                                        inputmode="tel"
                                    >
                                </div>
                                <input type="hidden" name="phone_full" id="portfolio-phone-full-value">
                            </div>

                            <!-- Кнопка отправки -->
                            <button 
                                type="submit" 
                                class="w-full px-6 py-4 sm:py-5 text-base sm:text-lg md:text-lg font-semibold rounded-lg transition-all duration-200 hover:opacity-90 active:scale-[0.98] touch-manipulation shadow-lg hover:shadow-xl"
                                style="background-color: #FF6B6B; color: white; border: none; min-height: 52px; font-size: 16px;"
                            >
                                <?php echo $currentLang === 'en' ? 'Send' : 'Отправить'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Функции для работы с модальными окнами
function openCaseModal(caseKey) {
    const modal = document.getElementById('modal-' + caseKey);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

function closeCaseModal(caseKey) {
    const modal = document.getElementById('modal-' + caseKey);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
}

// Закрытие по Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        <?php foreach ($cases as $caseKey): ?>
        closeCaseModal('<?php echo htmlspecialchars($caseKey); ?>');
        <?php endforeach; ?>
    }
});

// Упрощенная обработка формы портфолио (можно расширить, скопировав логику из index.php)
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactFormPortfolio');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';

            const formData = new FormData(form);
            const countryCode = document.getElementById('portfolio-phone-country-code')?.value || '+7';
            const phone = document.getElementById('portfolio-phone')?.value || '';
            const phoneFull = countryCode + phone.replace(/[\s\-\(\)]/g, '');
            formData.set('phone', phoneFull);

            try {
                const response = await fetch('/backend/send.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.success) {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Request sent successfully!' : 'Заявка отправлена успешно!'; ?>');
                    form.reset();
                } else {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Error sending request.' : 'Ошибка отправки заявки.'; ?>');
                }
            } catch (error) {
                alert('<?php echo $currentLang === 'en' ? 'Error sending request. Please try again later.' : 'Ошибка отправки заявки. Попробуйте позже.'; ?>');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>

