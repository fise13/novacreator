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
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 border-2 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 border-2 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/novacreatorstudio.iv?igsh=cGsxcjRxbnIweGN6&utm_source=qr" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border-2 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.246 1.805-.413 2.227-.217.562-.477.96-.896 1.382-.42.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.246-2.236-.413-.569-.224-.96-.479-1.379-.896-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.817.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Услуги -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('footer.services')); ?></h3>
                        <ul class="space-y-4">
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.seoOptimization')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.websiteDevelopment')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.ads')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.marketing')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.analytics')); ?></a></li>
                        </ul>
                    </div>
                    
                    <!-- Компания -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('footer.company')); ?></h3>
                        <ul class="space-y-4">
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.about')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('footer.contacts')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/faq'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.faq')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/calculator'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.calculator')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/blog'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.blog')); ?></a></li>
                            <li><a href="<?php echo getLocalizedUrl($currentLang, '/vacancies'); ?>" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('nav.vacancies')); ?></a></li>
                        </ul>
                    </div>
                    
                    <!-- Контакты -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('footer.contacts')); ?></h3>
                        <ul class="space-y-4">
                            <li>
                                <a href="mailto:contact@novacreatorstudio.com" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);">contact@novacreatorstudio.com</a>
                            </li>
                            <li>
                                <a href="tel:+77066063921" class="text-lg hover:underline transition-all" style="color: var(--color-text-secondary);">+7 706 606 39 21</a>
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
    
    <!-- Внутренняя перелинковка -->
    <?php include __DIR__ . '/internal_linking.php'; ?>
    
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
    
    <!-- Кастомные курсоры для интерактивных элементов -->
    <script src="/assets/js/custom-cursor.js"></script>
    
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

