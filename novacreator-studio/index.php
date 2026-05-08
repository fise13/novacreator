<?php
/**
 * Главная страница NovaCreator Studio
 * Создана по образцу holymedia.kz с улучшенной структурой и анимациями
 */

// Подключаем локализацию
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('seo.pages.index.breadcrumb');
$pageMetaTitle = t('seo.pages.index.title');
$pageMetaDescription = t('seo.pages.index.description');
$pageMetaKeywords = t('seo.pages.index.keywords');
include 'includes/header.php';
?>

                <?php 
// Hero секция - подготовка данных
                static $headlinesData = null;
                if ($headlinesData === null) {
                    $langFile = __DIR__ . '/lang/' . $currentLang . '.json';
                    if (file_exists($langFile)) {
                        $headlinesData = json_decode(file_get_contents($langFile), true);
                    } else {
                        $headlinesData = [];
                    }
                }
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => 'Your growth is our goal', 'subtitle' => ''];
$heroTitle = $currentLang === 'en' ? 'Your growth is our goal' : $randomHeadline['title'];
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : ($currentLang === 'en' ? 'Digital agency specializing in SEO, web development, and marketing strategies' : 'Цифровое агентство');
$heroSubtitle = $randomDescription;
$heroCtaButtons = [
    [
        'text' => t('common.getStarted'),
        'url' => '#contact-form',
        'onclick' => "const el = document.getElementById('contact-form'); if(el) { el.scrollIntoView({behavior: 'smooth'}); return false; }",
        'class' => 'btn-premium-primary hero-cta-main inline-flex min-h-[48px] w-full items-center justify-center rounded-xl px-8 py-3.5 text-base font-semibold sm:w-auto md:px-10 md:py-4 md:text-lg'
    ],
    [
        'text' => t('nav.services'),
        'url' => getLocalizedUrl($currentLang, '/services'),
        'class' => 'btn-premium-ghost hero-cta-secondary inline-flex min-h-[48px] w-full items-center justify-center rounded-xl border px-8 py-3.5 text-base font-medium sm:w-auto md:px-10 md:py-4 md:text-lg'
    ]
];
$heroTrustLine = t('home.hero.trustLine');
$heroWithParallax = false;
$heroScrollIndicator = false;
include __DIR__ . '/includes/partials/hero-section.php';
?>

<!-- Selected work — template-style spotlight -->
<section id="work" class="reveal-group border-b py-16 md:py-24" style="background-color: var(--color-bg); border-color: var(--color-border);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-2xl text-center md:mb-14">
            <p class="reveal text-xs font-semibold uppercase tracking-widest" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('home.selectedWork.kicker')); ?></p>
            <h2 class="reveal mt-3 text-3xl font-semibold tracking-tight md:text-4xl" style="color: var(--color-text);"><?php echo htmlspecialchars(t('home.selectedWork.title')); ?></h2>
            <p class="reveal mx-auto mt-4 max-w-xl text-base leading-relaxed md:text-lg" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('home.selectedWork.subtitle')); ?></p>
        </div>
        <div class="mx-auto grid max-w-5xl gap-6 md:grid-cols-2 md:gap-8">
            <article class="reveal flex flex-col overflow-hidden rounded-2xl border transition-shadow duration-300 hover:shadow-md" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                <div class="h-36 border-b px-5 py-4 md:h-40" style="border-color: var(--color-border); background: color-mix(in srgb, var(--color-surface) 90%, var(--color-border));">
                    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide" style="background: var(--color-bg); color: var(--color-text-secondary); border: 1px solid var(--color-border);"><?php echo htmlspecialchars(t('home.selectedWork.motorLandTag')); ?></span>
                </div>
                <div class="flex flex-1 flex-col p-6 md:p-8">
                    <h3 class="text-xl font-semibold md:text-2xl" style="color: var(--color-text);"><?php echo htmlspecialchars(t('home.selectedWork.motorLandTitle')); ?></h3>
                    <p class="mt-3 flex-1 text-base leading-relaxed" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('home.selectedWork.motorLandDesc')); ?></p>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio-motor-land')); ?>" class="btn-minimal-link mt-6 inline-flex items-center gap-1 text-sm font-semibold md:text-base" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.portfolio.viewCase')); ?>
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </article>
            <article class="reveal flex flex-col overflow-hidden rounded-2xl border transition-shadow duration-300 hover:shadow-md" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
                <div class="h-36 border-b px-5 py-4 md:h-40" style="border-color: var(--color-border); background: color-mix(in srgb, var(--color-surface) 90%, var(--color-border));">
                    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide" style="background: var(--color-bg); color: var(--color-text-secondary); border: 1px solid var(--color-border);"><?php echo htmlspecialchars(t('home.selectedWork.autocoreTag')); ?></span>
                </div>
                <div class="flex flex-1 flex-col p-6 md:p-8">
                    <h3 class="text-xl font-semibold md:text-2xl" style="color: var(--color-text);"><?php echo htmlspecialchars(t('home.selectedWork.autocoreTitle')); ?></h3>
                    <p class="mt-3 flex-1 text-base leading-relaxed" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('home.selectedWork.autocoreDesc')); ?></p>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio-autocore')); ?>" class="btn-minimal-link mt-6 inline-flex items-center gap-1 text-sm font-semibold md:text-base" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.portfolio.viewCase')); ?>
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </article>
        </div>
        <div class="reveal mt-10 text-center md:mt-12">
            <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" class="inline-flex items-center justify-center rounded-xl border px-6 py-3 text-sm font-semibold transition-colors md:text-base" style="border-color: var(--color-border); color: var(--color-text);">
                <?php echo htmlspecialchars(t('home.selectedWork.viewAll')); ?>
            </a>
        </div>
    </div>
</section>

<!-- Услуги -->
<section id="services" class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <?php
            $sectionTitle = t('home.services.title');
            $sectionSubtitle = t('home.services.subtitle');
            $sectionAlign = 'center';
            include __DIR__ . '/includes/partials/section-header.php';
            ?>
            
            <!-- Карточки услуг - стиль holymedia.kz -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
                <?php
                // SEO карточка
                $cardTitle = t('home.services.seo.title');
                $cardDescription = t('home.services.seo.description');
                $cardIcon = '<svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>';
                $cardLinkUrl = getLocalizedUrl($currentLang, '/seo');
                $cardLinkText = t('common.readMore') . ' — SEO';
                $cardSecondaryUrl = getLocalizedUrl($currentLang, '/calculator?service=seo');
                $cardSecondaryText = t('common.getConsultation');
                include __DIR__ . '/includes/partials/service-card.php';
                
                // Разработка сайтов карточка
                $cardTitle = t('home.services.development.title');
                $cardDescription = t('home.services.development.description');
                $cardIcon = '<svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>';
                $cardLinkUrl = getLocalizedUrl($currentLang, '/services#development');
                $cardLinkText = t('common.readMore') . ' — ' . t('home.services.development.title');
                $cardSecondaryUrl = getLocalizedUrl($currentLang, '/calculator?service=development');
                $cardSecondaryText = t('pages.portfolio.cta.button');
                include __DIR__ . '/includes/partials/service-card.php';
                
                // Google Ads карточка
                $cardTitle = t('home.services.ads.title');
                $cardDescription = t('home.services.ads.description');
                $cardIcon = '<svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>';
                $cardLinkUrl = getLocalizedUrl($currentLang, '/ads');
                $cardLinkText = t('common.readMore') . ' — Google Ads';
                $cardSecondaryUrl = getLocalizedUrl($currentLang, '/calculator?service=ads');
                $cardSecondaryText = t('common.calculateCost');
                include __DIR__ . '/includes/partials/service-card.php';
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA + form -->
<section id="contact-form" class="reveal-group border-t py-16 md:py-24" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
    <div class="container mx-auto px-4 sm:px-5 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 max-w-2xl reveal md:mb-14">
                <h2 class="text-3xl font-semibold tracking-tight md:text-4xl" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.contactCta.title')); ?>
                </h2>
                <p class="mt-3 text-base leading-relaxed md:text-lg" style="color: var(--color-text-secondary);">
                    <?php echo htmlspecialchars(t('home.contactCta.subcopy')); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-10 md:gap-12 lg:gap-16 xl:gap-20">
                <!-- Контактная информация слева - оптимизирована для мобильных -->
                <div class="reveal order-2 lg:order-1">
                    <!-- Телефон -->
                    <div class="mb-6 sm:mb-8 md:mb-10">
                        <h3 class="text-base sm:text-lg md:text-xl lg:text-2xl font-semibold mb-2 sm:mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.contact.phone')); ?>
                        </h3>
                        <a href="tel:+77066063921" class="inline-block text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold transition-colors hover:opacity-80 touch-manipulation min-h-[44px] flex items-center" style="color: var(--color-text);">
                            +7 706 606 39 21
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="mb-6 sm:mb-8 md:mb-10">
                        <h3 class="text-base sm:text-lg md:text-xl lg:text-2xl font-semibold mb-2 sm:mb-3" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('pages.contact.email')); ?>
                        </h3>
                        <a href="mailto:contact@novacreatorstudio.com" class="inline-block text-base sm:text-lg md:text-xl lg:text-2xl font-bold transition-colors hover:opacity-80 break-all touch-manipulation min-h-[44px] flex items-center" style="color: var(--color-text);">
                            contact@novacreatorstudio.com
                        </a>
                    </div>

                    <!-- Мессенджеры -->
                    <div>
                        <h3 class="text-base sm:text-lg md:text-xl lg:text-2xl font-semibold mb-3 sm:mb-4" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('common.contactUs')); ?>
                        </h3>
                        <div class="flex flex-wrap gap-3 sm:gap-4">
                            <a href="https://wa.me/77066063921" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-base sm:text-lg md:text-xl font-semibold transition-colors hover:opacity-80 touch-manipulation min-h-[44px]" style="color: var(--color-text);">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                <span>WhatsApp</span>
                            </a>
                            <a href="https://t.me/victhefise" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-base sm:text-lg md:text-xl font-semibold transition-colors hover:opacity-80 touch-manipulation min-h-[44px]" style="color: var(--color-text);">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.12l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                                <span>Telegram</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Форма справа - оптимизирована для мобильных -->
                <div class="reveal order-1 lg:order-2 w-full">
                    <div class="relative w-full max-w-full overflow-hidden rounded-2xl border p-5 sm:p-6 md:p-8 lg:p-10" style="background-color: var(--color-bg); border-color: var(--color-border); box-shadow: 0 1px 2px rgba(0,0,0,0.04);">
                        <h3 class="mb-5 text-xl font-semibold sm:mb-6 sm:text-2xl md:text-3xl" style="color: var(--color-text);">
                            <?php echo htmlspecialchars(t('home.contactCta.formHeading')); ?>
                        </h3>

                        <!-- Inline success block (скрыт по умолчанию) -->
                        <div id="contact-form-success" class="hidden flex flex-col items-center justify-center py-12 px-6 text-center rounded-xl" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.08), rgba(34, 197, 94, 0.04)); border: 1px solid rgba(34, 197, 94, 0.3);">
                            <div class="w-16 h-16 mb-4 flex items-center justify-center rounded-full" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-xl md:text-2xl font-semibold mb-2" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Thank you!' : 'Спасибо!'; ?>
                            </p>
                            <p class="text-base md:text-lg" style="color: var(--color-text-secondary);">
                                <?php echo $currentLang === 'en' ? 'We will contact you within 2 hours.' : 'Мы свяжемся с вами в течение 2 часов.'; ?>
                            </p>
                        </div>

                        <form id="contactFormMain" class="contact-form w-full max-w-full space-y-3 sm:space-y-4 md:space-y-6" method="POST" action="/backend/send.php">
                            <input type="hidden" name="type" value="contact">
                            <input type="hidden" name="form_name" value="<?php echo $currentLang === 'en' ? 'Contact Form' : 'Форма обратной связи'; ?>">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">

                            <!-- Имя -->
                            <div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="contact-name"
                                    placeholder="<?php echo $currentLang === 'en' ? 'John' : 'Иван'; ?>"
                                    class="w-full px-4 py-3.5 sm:py-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black text-base sm:text-lg touch-manipulation" 
                                    style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; min-height: 48px; font-size: 16px; -webkit-appearance: none;"
                                    required
                                    autocomplete="name"
                                >
                                <p class="text-xs sm:text-sm mt-1 hidden text-red-500" id="name-error"></p>
                            </div>

                            <!-- Телефон с выбором страны - оптимизирован для мобильных -->
                            <div>
                                <div class="flex w-full max-w-full items-stretch gap-2">
                                    <select 
                                        id="phone-country-code"
                                        name="country_code"
                                        class="shrink-0 px-3 sm:px-4 py-3.5 sm:py-4 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black text-base sm:text-lg cursor-pointer appearance-none touch-manipulation" 
                                        style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; width: 110px; min-height: 48px; font-size: 16px; -webkit-appearance: none; background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22%3E%3Cpath fill=%22%23000%22 d=%22M6 9L1 4h10z%22/%3E%3C/svg%3E'); background-position: right 0.75rem center; background-repeat: no-repeat; background-size: 12px 12px;"
                                    >
                                        <option value="+7" data-flag="🇰🇿">🇰🇿 +7</option>
                                        <option value="+7" data-flag="🇷🇺">🇷🇺 +7</option>
                                        <option value="+1" data-flag="🇺🇸">🇺🇸 +1</option>
                                        <option value="+380" data-flag="🇺🇦">🇺🇦 +380</option>
                                        <option value="+375" data-flag="🇧🇾">🇧🇾 +375</option>
                                        <option value="+998" data-flag="🇺🇿">🇺🇿 +998</option>
                                        <option value="+996" data-flag="🇰🇬">🇰🇬 +996</option>
                                        <option value="+44" data-flag="🇬🇧">🇬🇧 +44</option>
                                        <option value="+49" data-flag="🇩🇪">🇩🇪 +49</option>
                                        <option value="+33" data-flag="🇫🇷">🇫🇷 +33</option>
                                        <option value="+86" data-flag="🇨🇳">🇨🇳 +86</option>
                                        <option value="+90" data-flag="🇹🇷">🇹🇷 +90</option>
                                        <option value="+971" data-flag="🇦🇪">🇦🇪 +971</option>
                                        <option value="+81" data-flag="🇯🇵">🇯🇵 +81</option>
                                        <option value="+82" data-flag="🇰🇷">🇰🇷 +82</option>
                                        <option value="+91" data-flag="🇮🇳">🇮🇳 +91</option>
                                    </select>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        id="contact-phone"
                                        placeholder="(000) 000-00-00"
                                        class="flex-1 min-w-0 px-4 py-3.5 sm:py-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black text-base sm:text-lg touch-manipulation" 
                                        style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; min-height: 48px; font-size: 16px; -webkit-appearance: none;"
                                        required
                                        autocomplete="tel"
                                        inputmode="tel"
                                    >
                                </div>
                                <input type="hidden" name="phone_full" id="phone-full-value">
                                <p class="text-xs sm:text-sm mt-1 hidden text-red-500" id="phone-error-main"></p>
                            </div>

                            <!-- Радио-кнопки - оптимизированы для мобильных -->
                            <div class="flex flex-col gap-3 sm:gap-4 py-2">
                                <label class="contact-method-option flex items-center gap-3 cursor-pointer touch-manipulation min-h-[44px] px-1 -mx-1 rounded-lg transition-colors hover:bg-gray-50 active:bg-gray-100" 
                                       data-value="messenger" 
                                       id="label-messenger">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="messenger" 
                                        id="contact-messenger"
                                        checked
                                        class="w-5 h-5 sm:w-6 sm:h-6 cursor-pointer flex-shrink-0"
                                        style="accent-color: #000000;"
                                    >
                                    <span class="text-base sm:text-lg md:text-lg font-medium select-none" style="color: #000000;">
                                        <?php echo $currentLang === 'en' ? 'Write in messenger' : 'Написать в мессенджер'; ?>
                                    </span>
                                </label>
                                <label class="contact-method-option flex items-center gap-3 cursor-pointer touch-manipulation min-h-[44px] px-1 -mx-1 rounded-lg transition-colors hover:bg-gray-50 active:bg-gray-100" 
                                       data-value="call"
                                       id="label-call">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="call"
                                        id="contact-call"
                                        class="w-5 h-5 sm:w-6 sm:h-6 cursor-pointer flex-shrink-0"
                                        style="accent-color: #000000;"
                                    >
                                    <span class="text-base sm:text-lg md:text-lg font-medium select-none" style="color: #000000;">
                                        <?php echo $currentLang === 'en' ? 'Call' : 'Позвонить'; ?>
                                    </span>
                                </label>
                            </div>

                            <!-- Кнопка отправки - оптимизирована для мобильных -->
                            <button 
                                type="submit" 
                                class="form-submit-premium w-full px-6 py-4 sm:py-5 text-base sm:text-lg md:text-lg font-semibold rounded-lg transition-all duration-200 hover:opacity-95 active:scale-[0.98] touch-manipulation shadow-lg hover:shadow-xl"
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
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('contact-name');
    const phoneInput = document.getElementById('contact-phone');
    const nameError = document.getElementById('name-error');
    const phoneError = document.getElementById('phone-error-main');
    const form = document.getElementById('contactFormMain');
    const countryCodeSelect = document.getElementById('phone-country-code');
    const phoneFullValue = document.getElementById('phone-full-value');
    
    // Обработчики изменения способа связи (упрощенная версия без визуальных изменений)
    const methodInputs = form.querySelectorAll('input[name="contact_method"]');
    methodInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Просто логируем выбор, стили применяются через CSS accent-color
        });
    });
    
    function validatePhone(phone, countryCode) {
        // Удаляем все нецифровые символы кроме плюса
        const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');
        // Убираем код страны для проверки только номера
        const codeWithoutPlus = countryCode.replace('+', '');
        const numberOnly = cleanPhone.startsWith(codeWithoutPlus) 
            ? cleanPhone.substring(codeWithoutPlus.length) 
            : cleanPhone;
        
        // Минимум 7 цифр для международного номера, максимум 15
        return /^\d{7,15}$/.test(numberOnly);
    }
    
    function formatPhoneByCountry(value, countryCode) {
        // Удаляем все нецифровые символы
        let cleaned = value.replace(/[^\d]/g, '');
        
        const codeDigits = countryCode.replace('+', '');
        
        // Для +7: специальная обработка
        if (countryCode === '+7') {
            // Если начинается с 8, заменяем на 7 (российский формат)
            if (cleaned.startsWith('8')) {
                cleaned = '7' + cleaned.substring(1);
            }
            // Для +7 НЕ удаляем первую "7", так как это часть номера
            // Российские номера имеют формат: 7XXXXXXXXXX (11 цифр)
            // Мы оставляем все цифры как есть
        } else {
            // Для других стран: убираем код страны только если:
            // 1. Номер начинается с кода страны
            // 2. После кода есть еще цифры (минимум 3, чтобы не удалить начало номера)
            if (cleaned.startsWith(codeDigits) && cleaned.length > codeDigits.length + 2) {
            cleaned = cleaned.substring(codeDigits.length);
            }
        }
        
        // Форматирование зависит от кода страны
        if (countryCode === '+7' || countryCode === '+1') {
            // Для +7 и +1: форматируем как (XXX) XXX-XXXX
            if (cleaned.length > 0) {
                let formatted = '(' + cleaned.substring(0, 3);
                if (cleaned.length > 3) {
                    formatted += ') ' + cleaned.substring(3, 6);
                }
                if (cleaned.length > 6) {
                    formatted += '-' + cleaned.substring(6, 10);
                }
                return formatted;
            }
        } else if (countryCode === '+380' || countryCode === '+375') {
            // Для Украины и Беларуси: XXX XX XX
            if (cleaned.length > 0) {
                let formatted = cleaned.substring(0, 3);
                if (cleaned.length > 3) {
                    formatted += ' ' + cleaned.substring(3, 5);
                }
                if (cleaned.length > 5) {
                    formatted += ' ' + cleaned.substring(5, 7);
                }
                if (cleaned.length > 7) {
                    formatted += ' ' + cleaned.substring(7, 9);
                }
                return formatted;
            }
        }
        
        // Для остальных стран: просто цифры с пробелами каждые 3
        return cleaned.replace(/(\d{3})(?=\d)/g, '$1 ');
    }
    
    // Валидация имени
    if (nameInput) {
        nameInput.addEventListener('blur', function() {
            const name = nameInput.value.trim();
            if (!name || name.length < 2) {
                nameInput.style.borderColor = '#ef4444';
                if (nameError) {
                    nameError.textContent = '<?php echo $currentLang === 'en' ? 'Enter your name' : 'Введите имя'; ?>';
                    nameError.classList.remove('hidden');
                }
            } else {
                nameInput.style.borderColor = '';
                if (nameError) {
                    nameError.classList.add('hidden');
                }
            }
        });
    }
    
    // Функция обновления полного значения телефона
    function updatePhoneValue() {
        if (countryCodeSelect && phoneInput && phoneFullValue) {
            const countryCode = countryCodeSelect.value;
            const phoneNumber = phoneInput.value.trim().replace(/[\s\-\(\)]/g, '');
            if (phoneNumber) {
                phoneFullValue.value = countryCode + phoneNumber;
            } else {
                phoneFullValue.value = '';
            }
        }
    }
    
    if (countryCodeSelect) {
        countryCodeSelect.addEventListener('change', function() {
            const countryCode = this.value;
            const currentValue = phoneInput.value.replace(/[\s\-\(\)]/g, '');
            phoneInput.value = formatPhoneByCountry(currentValue, countryCode);
            updatePhoneValue();
            // Валидация при смене страны
            if (phoneInput.value) {
                phoneInput.dispatchEvent(new Event('input'));
            }
        });
    }
    
    // Форматирование и валидация телефона
    if (phoneInput && countryCodeSelect) {
        // Обработка фокуса для автоматической обработки начала ввода
        phoneInput.addEventListener('focus', function() {
            // При фокусе ничего не делаем, просто готовимся к вводу
        });
        
        phoneInput.addEventListener('input', function(e) {
            const countryCode = countryCodeSelect.value;
            let currentValue = e.target.value.replace(/[\s\-\(\)]/g, '');
            
            // Для +7: если пользователь начинает вводить с 8, заменяем на 7
            if (countryCode === '+7' && currentValue.startsWith('8') && currentValue.length === 1) {
                currentValue = '7';
            }
            
            e.target.value = formatPhoneByCountry(currentValue, countryCode);
            updatePhoneValue();
            
            const phone = e.target.value.trim();
            if (phone && !validatePhone(phone, countryCode)) {
                phoneInput.style.borderColor = '#ef4444';
                if (phoneError) {
                    phoneError.textContent = '<?php echo $currentLang === 'en' ? 'Enter a valid phone number' : 'Введите корректный номер телефона'; ?>';
                    phoneError.classList.remove('hidden');
                }
            } else {
                phoneInput.style.borderColor = '';
                if (phoneError) {
                    phoneError.classList.add('hidden');
                }
            }
        });
        
        phoneInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const countryCode = countryCodeSelect.value;
            const cleaned = pastedText.replace(/[^\d+]/g, '');
            // Если вставляется номер с кодом страны, пытаемся его определить
            if (cleaned.startsWith('+')) {
                // Убираем + и код страны
                const codeDigits = countryCode.replace('+', '');
                if (cleaned.startsWith('+' + codeDigits)) {
                    const numberOnly = cleaned.substring(1 + codeDigits.length);
                    phoneInput.value = formatPhoneByCountry(numberOnly, countryCode);
                } else {
                    phoneInput.value = formatPhoneByCountry(cleaned.substring(1), countryCode);
                }
            } else {
                phoneInput.value = formatPhoneByCountry(cleaned, countryCode);
            }
            updatePhoneValue();
            phoneInput.dispatchEvent(new Event('input'));
        });
    }

    // Обработка отправки формы
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const name = nameInput ? nameInput.value.trim() : '';
            const phone = phoneInput ? phoneInput.value.trim() : '';
            let isValid = true;
            
            // Валидация имени
            if (!name || name.length < 2) {
                isValid = false;
                if (nameInput) {
                    nameInput.style.borderColor = '#ef4444';
                    nameInput.focus();
                }
                if (nameError) {
                    nameError.textContent = '<?php echo $currentLang === 'en' ? 'Enter your name' : 'Введите имя'; ?>';
                    nameError.classList.remove('hidden');
                }
            }
            
            // Валидация телефона
            const countryCode = countryCodeSelect ? countryCodeSelect.value : '+7';
            updatePhoneValue();
            const phoneFull = phoneFullValue ? phoneFullValue.value : '';
            
            if (!phone || !validatePhone(phone, countryCode)) {
                isValid = false;
                if (phoneInput) {
                    phoneInput.style.borderColor = '#ef4444';
                    if (!name || name.length >= 2) {
                        phoneInput.focus();
                    }
                }
                if (phoneError) {
                    phoneError.textContent = '<?php echo $currentLang === 'en' ? 'Enter a valid phone number' : 'Введите корректный номер телефона'; ?>';
                    phoneError.classList.remove('hidden');
                }
            }
            
            if (!isValid) {
                return false;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';

            // Формируем данные формы с полным номером телефона
            const formData = new FormData();
            formData.append('type', form.querySelector('input[name="type"]').value);
            formData.append('form_name', form.querySelector('input[name="form_name"]').value);
            formData.append('name', nameInput.value.trim());
            
            // Обрабатываем телефон: если начинается с 8, заменяем на +7
            let finalPhone = phoneFull || (countryCode + phone.replace(/[\s\-\(\)]/g, ''));
            if (countryCode === '+7' && finalPhone.startsWith('+78')) {
                // Если номер начинается с +78, заменяем на +77
                finalPhone = '+7' + finalPhone.substring(3);
            } else if (countryCode === '+7' && finalPhone.startsWith('8')) {
                // Если номер начинается с 8, заменяем на +7
                finalPhone = '+7' + finalPhone.substring(1);
            }
            formData.append('phone', finalPhone);
            formData.append('website', form.querySelector('input[name="website"]').value);
            
            // Добавляем метод связи отдельным полем для Telegram
            const contactMethod = form.querySelector('input[name="contact_method"]:checked')?.value;
            if (contactMethod) {
                formData.append('contact_method', contactMethod);
            }
            
            // Добавляем метод связи в сообщение - показываем явно выбранный способ
            let methodText = '';
            if (contactMethod === 'messenger') {
                methodText = '<?php echo $currentLang === 'en' ? 'Preferred contact method: Write in messenger' : 'Предпочтительный способ связи: Написать в мессенджер'; ?>';
            } else if (contactMethod === 'call') {
                methodText = '<?php echo $currentLang === 'en' ? 'Preferred contact method: Call' : 'Предпочтительный способ связи: Позвонить'; ?>';
            }
            formData.append('message', methodText);

            try {
                const response = await fetch('/backend/send.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    form.reset();
                    const defaultRadio = form.querySelector('input[name="contact_method"][value="messenger"]');
                    if (defaultRadio) defaultRadio.checked = true;
                    if (nameError) nameError.classList.add('hidden');
                    if (phoneError) phoneError.classList.add('hidden');
                    if (nameInput) nameInput.style.borderColor = '';
                    if (phoneInput) phoneInput.style.borderColor = '';
                    // Показываем inline-блок вместо alert
                    form.classList.add('hidden');
                    const successBlock = document.getElementById('contact-form-success');
                    if (successBlock) successBlock.classList.remove('hidden');
                } else {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Error sending request. Please try again.' : 'Ошибка отправки заявки. Попробуйте еще раз.'; ?>');
                }
            } catch (error) {
                console.error('Form submission error:', error);
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
