<?php
/**
 * Общий footer для всех страниц
 */

// Подключаем локализацию если еще не подключена
if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

$currentLang = getCurrentLanguage();
?>
    <!-- Footer - минималистичный стиль holymedia.kz с мобильной адаптацией -->
    <footer class="mt-20 md:mt-32 py-12 md:py-16 lg:py-20 border-t" style="background-color: var(--color-bg-lighter); border-color: var(--color-border);">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 lg:gap-16">
                    <!-- О компании -->
                    <div>
                        <div class="flex items-center space-x-3 mb-6">
                            <img src="/assets/img/logo.svg" alt="<?php echo htmlspecialchars(t('alt.logo')); ?>" class="w-10 h-10 md:w-12 md:h-12 rounded-lg" loading="lazy" decoding="async" width="48" height="48" />
                            <span class="text-lg sm:text-xl font-bold" style="color: var(--color-text);"><?php echo htmlspecialchars(t('site.name')); ?></span>
                        </div>
                        <p class="mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('footer.description')); ?>
                        </p>
                        <div class="flex space-x-6 footer-social-buttons">
                            <a href="#" class="footer-social-btn footer-social-btn-1 w-8 h-8 flex items-center justify-center touch-manipulation" style="color: var(--color-text-secondary);" aria-label="Facebook">
                                <svg class="w-5 h-5 footer-social-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://vk.com/novacreatorstudio" target="_blank" rel="noopener noreferrer" class="footer-social-btn footer-social-btn-2 w-8 h-8 flex items-center justify-center touch-manipulation" style="color: var(--color-text-secondary);" aria-label="VK">
                                <svg class="w-5 h-5 footer-social-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17,3 C19.1421576,3 20.8910766,4.68396753 20.9951046,6.80035957 L21,7 L21,17 C21,19.1421576 19.3159949,20.8910766 17.199637,20.9951046 L17,21 L7,21 C4.85780364,21 3.10892107,19.3159949 3.0048953,17.199637 L3,17 L3,7 C3,4.85780364 4.68396753,3.10892107 6.80035957,3.0048953 L7,3 L17,3 Z M17,5 L7,5 C5.94563773,5 5.08183483,5.81587733 5.00548573,6.85073759 L5,7 L5,17 C5,18.0543909 5.81587733,18.9181678 6.85073759,18.9945144 L7,19 L17,19 C18.0543909,19 18.9181678,18.18415 18.9945144,17.1492661 L19,17 L19,7 C19,5.94563773 18.18415,5.08183483 17.1492661,5.00548573 L17,5 Z M15.453104,9.22480848 L15.6679,8.94541 C15.9743,8.48588 16.5952,8.3617 17.0547,8.66806 C17.5142,8.97441 17.6384,9.59528 17.3321,10.0548 C17.0418,10.4903 16.5418,11.1109 15.8658,11.7349 C15.7209,11.8687 15.5744,11.9961 15.4263,12.1168 C16.524,12.7013 17.4161,13.5963 17.8944,14.5529 C18.1414,15.0469 17.9412,15.6475 17.4472,15.8945 C16.9532,16.1415 16.3526,15.9413 16.1056,15.4473 C15.6492526,14.5347 14.4653861,13.6425632 13.2103237,13.4603732 L13.0006,13.4367 L13,15.0001 C13,15.5524 12.5523,16.0001 12,16.0001 C8.50956,16.0001 6,13.132 6,9.50011 C6,8.94782 6.44772,8.50011 7,8.50011 C7.55228,8.50011 8,8.94782 8,9.50011 C8,11.3742861 8.9780595,13.1985387 10.7947064,13.8101882 L11,13.8731 L11,9.50011 C11,8.93138 11.4584,8.53135 12,8.50011 C12.4733538,8.50011 12.8699361,8.82904349 12.9736091,9.27082002 L12.9933,9.38349 L13.0005,11.2835 C13.4973,11.0773 14.0063,10.7296 14.5092,10.2653 C14.85656,9.944692 15.163088,9.593332 15.453104,9.22480848 L15.453104,9.22480848 Z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/novacreatorstudio.iv?igsh=cGsxcjRxbnIweGN6&utm_source=qr" target="_blank" rel="noopener noreferrer" class="footer-social-btn footer-social-btn-3 w-8 h-8 flex items-center justify-center touch-manipulation" style="color: var(--color-text-secondary);" aria-label="Instagram">
                                <svg class="w-5 h-5 footer-social-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.246 1.805-.413 2.227-.217.562-.477.96-.896 1.382-.42.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.246-2.236-.413-.569-.224-.96-.479-1.379-.896-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.817.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Услуги -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('footer.services')); ?></h3>
                        <ul class="space-y-4">
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.seoOptimization')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.websiteDevelopment')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.ads')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.marketing')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.analytics')); ?></a></li>
                        </ul>
                    </div>
                    
                    <!-- Компания -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('footer.company')); ?></h3>
                        <ul class="space-y-4">
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.about')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.contacts')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/faq'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.faq')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/calculator'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.calculator')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/blog'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.blog')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/vacancies'); ?>" class="text-lg transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.vacancies')); ?></a></li>
                        </ul>
                    </div>
                    
                    <!-- Контакты -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('footer.contacts')); ?></h3>
                        <ul class="space-y-4">
                            <li>
                                <a href="mailto:contact@novacreatorstudio.com" class="text-lg transition-all" style="color: var(--color-text-secondary);">contact@novacreatorstudio.com</a>
                            </li>
                            <li>
                                <a href="tel:+77066063921" class="text-lg transition-all" style="color: var(--color-text-secondary);">+7 706 606 39 21</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Копирайт -->
                <div class="border-t mt-8 md:mt-12 pt-6 md:pt-8 text-center" style="border-color: var(--color-border);">
                    <p class="text-base sm:text-lg" style="color: var(--color-text-secondary);">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars(t('site.name')); ?>. <?php echo htmlspecialchars(t('common.allRightsReserved')); ?>.</p>
            </div>
        </div>
    </footer>
    
    <!-- Внутренняя перелинковка - отключена для минималистичного дизайна -->
    <?php // include __DIR__ . '/internal_linking.php'; ?>
    
    <!-- Плавающий CTA виджет -->
    <?php 
    // Floating CTA disabled
    // if (!function_exists('generateFloatingCTA')) {
    //     require_once __DIR__ . '/cta_components.php';
    // }
    // generateFloatingCTA($currentLang); 
    ?>
    
    <!-- Кнопка "Наверх" - скрыта на мобильных устройствах -->
    <button id="backToTop" class="hidden md:flex fixed bottom-8 right-8 w-14 h-14 md:w-16 md:h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full items-center justify-center shadow-lg hover:scale-110 transition-all duration-300 opacity-0 pointer-events-none z-40 group" aria-label="<?php echo htmlspecialchars(t('common.backToTop')); ?>" style="bottom: max(2rem, calc(2rem + env(safe-area-inset-bottom))); right: max(2rem, calc(2rem + env(safe-area-inset-right)));">
        <svg class="w-6 h-6 md:w-7 md:h-7 text-white transform group-hover:-translate-y-1 transition-transform relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
        <!-- Индикатор прогресса прокрутки -->
        <svg class="absolute inset-0 w-full h-full transform -rotate-90 opacity-30" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="3" stroke-dasharray="283" stroke-dashoffset="283" id="scrollProgressCircle"/>
        </svg>
    </button>
    
    <!-- Подключение основного JavaScript -->
    <?php
    // Определяем правильный путь к JS, учитывая preview режим Plesk
    $scriptPath = $_SERVER['SCRIPT_NAME'];
    
    // Если в preview режиме Plesk, извлекаем реальный путь после всех preview сегментов
    if (preg_match('#/plesk-site-preview/[^/]+/[^/]+/[^/]+/(.+)$#', $scriptPath, $matches)) {
        // Берем путь после всех preview сегментов (домен/https/IP)
        $realPath = '/' . $matches[1];
        $baseDir = dirname($realPath);
    } elseif (preg_match('#/plesk-site-preview/[^/]+/(.+)$#', $scriptPath, $matches)) {
        // Альтернативный паттерн для других форматов preview
        $realPath = '/' . $matches[1];
        $baseDir = dirname($realPath);
    } else {
        // Обычный режим
        $baseDir = dirname($scriptPath);
    }
    
    // Нормализуем путь
    $baseDir = ($baseDir === '/' || $baseDir === '\\' || $baseDir === '.') ? '' : $baseDir;
    $baseDir = rtrim($baseDir, '/\\');
    
    // Формируем путь к JS
    $jsPath = ($baseDir ? $baseDir . '/' : '/') . 'assets/js/main.min.js';
    $jsPath = preg_replace('#/+#', '/', $jsPath);
    ?>
    <script src="<?php echo $jsPath; ?>" defer></script>
    
    <!-- GPU-оптимизированные анимации -->
    <script src="/assets/js/animations.js"></script>
    
    <!-- Premium Staggered Reveal Animations -->
    <script src="/assets/js/reveal.js"></script>
    
    <!-- Parallax эффект для hero-секций -->
    <script src="/assets/js/parallax.js"></script>
    
    <!-- Анимированные SVG иконки для услуг -->
    <script src="/assets/js/animated-icons.js"></script>
    
    <!-- Skeleton Loading -->
    <script src="/assets/js/skeleton-loading.js"></script>
    
    <!-- 3D эффекты для портфолио - отключено -->
    <?php // <script src="/assets/js/portfolio-3d.js"></script> ?>
    
    <!-- Улучшенные touch-жесты и swipe-функции -->
    <script src="/assets/js/touch-gestures.js"></script>
    
    <!-- Оптимизация форм для мобильных устройств -->
    <script src="/assets/js/mobile-forms.js"></script>
    
    <!-- Service Worker для Push-уведомлений -->
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(registration) {
                    console.log('ServiceWorker registered');
                })
                .catch(function(error) {
                    console.log('ServiceWorker registration failed');
                });
        });
    }
    </script>
    
    <!-- Дополнительная структурированная разметка для сайта -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "NovaCreator Studio",
      "url": "https://novacreator-studio.com",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://novacreator-studio.com/?s={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
</body>
</html>

