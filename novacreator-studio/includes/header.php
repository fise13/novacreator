<?php
/**
 * Общий header для всех страниц
 * Содержит навигацию и мета-теги
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Подключаем систему защиты от ботов (должно быть первым)
require_once __DIR__ . '/bot_detection.php';
checkAndBlockBots();

// Подключаем систему локализации
require_once __DIR__ . '/i18n.php';

// Определяем язык и загружаем переводы
$currentLang = getCurrentLanguage();
$langMap = ['ru' => 'ru', 'en' => 'en'];
$htmlLang = $langMap[$currentLang] ?? 'ru';
?>
<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>" itemscope itemtype="https://schema.org/WebSite">
<head>
    <meta charset="UTF-8">
    <!-- Viewport оптимизирован для мобильных устройств с поддержкой safe area insets -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Предотвращение автоматического определения телефонных номеров на iOS -->
    <meta name="format-detection" content="telephone=yes">
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XD6LHCBQZS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XD6LHCBQZS');
    </script>
    
    <!-- Title -->
    <title><?php 
        if (isset($pageMetaTitle)) {
            echo htmlspecialchars($pageMetaTitle);
        } else {
            $siteName = t('site.name');
            $defaultTitle = t('seo.meta.defaultTitle');
            echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' . $siteName : $defaultTitle;
        }
    ?></title>
    
    <!-- Подключаем SEO мета-теги -->
    <?php include __DIR__ . '/seo_meta.php'; ?>
    
    <!-- Preconnect для ускорения загрузки -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    
    <!-- Tailwind CSS -->
    <?php
    // Определяем правильный путь к CSS, учитывая preview режим Plesk
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
    
    // Формируем путь к CSS и JS
    $cssPath = ($baseDir ? $baseDir . '/' : '/') . 'assets/css/output.css';
    $cssPath = preg_replace('#/+#', '/', $cssPath);
    $jsPreloadPath = ($baseDir ? $baseDir . '/' : '/') . 'assets/js/main.min.js';
    $jsPreloadPath = preg_replace('#/+#', '/', $jsPreloadPath);
    ?>
    <link rel="preload" as="style" href="<?php echo $cssPath; ?>">
    <link href="<?php echo $cssPath; ?>" rel="stylesheet">
    <link rel="preload" as="image" type="image/svg+xml" href="/assets/img/logo.svg">
    <link rel="preload" as="image" type="image/webp" href="/assets/img/og-default.webp">
    <link rel="preload" as="script" href="<?php echo $jsPreloadPath; ?>">
    <meta name="color-scheme" content="dark light">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/favicon.ico">
    
    <!-- Дополнительные мета-теги -->
    <meta name="theme-color" content="#0A0A0F">
</head>
<body class="bg-dark-bg text-white overflow-x-hidden">
    <!-- Индикатор прогресса прокрутки -->
    <div class="scroll-progress-bar fixed top-0 left-0 h-1 bg-gradient-to-r from-neon-purple to-neon-blue z-50" style="width: 0%; transition: width 0.1s ease-out;"></div>
    
    <!-- Навигация -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50 bg-dark-bg/95 backdrop-blur-xl border-b border-dark-border/80 transition-all duration-300 shadow-lg shadow-black/20" id="mainNavbar" role="navigation" aria-label="<?php echo htmlspecialchars(t('nav.main')); ?>" style="padding-top: env(safe-area-inset-top);">
        <div class="container mx-auto px-4 sm:px-5 md:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 sm:h-16 md:h-20 gap-2 sm:gap-3">
                <!-- Логотип -->
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="flex items-center space-x-2 sm:space-x-2.5 md:space-x-3 group touch-manipulation flex-shrink-0 min-w-0 active:scale-95 transition-transform duration-200" aria-label="<?php echo htmlspecialchars(t('nav.home') . ' - ' . t('site.name')); ?>" aria-current="<?php echo basename($_SERVER['PHP_SELF'], '.php') == 'index' ? 'page' : 'false'; ?>">
                    <img src="/assets/img/logo.svg" alt="<?php echo htmlspecialchars(t('alt.logo')); ?>" class="w-9 h-9 sm:w-11 sm:h-11 md:w-16 md:h-16 rounded-lg group-hover:scale-110 transition-transform duration-300 flex-shrink-0 shadow-md shadow-neon-purple/20" loading="lazy" decoding="async" fetchpriority="high" width="36" height="36" />
                    <span class="text-sm sm:text-base md:text-2xl font-semibold text-gradient truncate leading-tight"><?php echo htmlspecialchars(t('site.name')); ?></span>
                </a>
                
                <!-- Меню для десктопа -->
                <div class="hidden md:flex items-center space-x-6 lg:space-x-8" role="menubar">
                    <?php 
                    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                    $currentPath = getCurrentPath();
                    ?>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="nav-link text-gray-300 hover:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-md px-2 py-1 transition-colors duration-300 <?php echo $currentPage == 'index' ? 'text-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>"><?php echo htmlspecialchars(t('nav.home')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="nav-link text-gray-300 hover:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-md px-2 py-1 transition-colors duration-300 <?php echo $currentPage == 'services' ? 'text-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>"><?php echo htmlspecialchars(t('nav.services')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="nav-link text-gray-300 hover:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-md px-2 py-1 transition-colors duration-300 <?php echo $currentPage == 'seo' ? 'text-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>"><?php echo htmlspecialchars(t('nav.seo')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="nav-link text-gray-300 hover:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-md px-2 py-1 transition-colors duration-300 <?php echo $currentPage == 'ads' ? 'text-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>"><?php echo htmlspecialchars(t('nav.ads')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="nav-link text-gray-300 hover:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-md px-2 py-1 transition-colors duration-300 <?php echo $currentPage == 'about' ? 'text-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>"><?php echo htmlspecialchars(t('nav.about')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="relative inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white rounded-lg bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg transition-all duration-300 shadow-lg shadow-neon-purple/30 hover:shadow-xl hover:shadow-neon-purple/50 hover:scale-105 active:scale-95" role="menuitem">
                        <span class="relative z-10"><?php echo htmlspecialchars(t('nav.contact')); ?></span>
                    </a>
                    
                    <!-- Переключатель языка -->
                    <div class="flex items-center space-x-1 ml-3 pl-3 border-l border-dark-border bg-dark-surface/50 rounded-lg p-1" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                            <span class="relative z-10">RU</span>
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                            <span class="relative z-10">EN</span>
                        </a>
                    </div>
                </div>
                
                <!-- Кнопка мобильного меню - улучшенный бургер -->
                <div class="flex items-center flex-shrink-0">
                    <button class="md:hidden relative w-10 h-10 flex flex-col items-center justify-center gap-1.5 focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-xl transition-all duration-300 touch-manipulation group" id="mobileMenuBtn" aria-label="<?php echo htmlspecialchars(t('nav.menu')); ?>" aria-expanded="false" aria-controls="mobileMenu" type="button">
                        <!-- Верхняя линия -->
                        <span class="burger-line absolute w-6 h-0.5 bg-gray-300 rounded-full transition-all duration-300 group-hover:bg-neon-purple" style="top: 20%; transform-origin: center;"></span>
                        <!-- Средняя линия -->
                        <span class="burger-line absolute w-6 h-0.5 bg-gray-300 rounded-full transition-all duration-300 group-hover:bg-neon-purple" style="top: 50%; transform: translateY(-50%); transform-origin: center;"></span>
                        <!-- Нижняя линия -->
                        <span class="burger-line absolute w-6 h-0.5 bg-gray-300 rounded-full transition-all duration-300 group-hover:bg-neon-purple" style="bottom: 20%; transform-origin: center;"></span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Затемнение фона для мобильного меню -->
        <div class="fixed inset-0 bg-black/60 z-40 transition-opacity duration-300 hidden opacity-0" id="mobileMenuOverlay" role="button" tabindex="-1" aria-label="<?php echo htmlspecialchars(t('nav.closeMenu')); ?>" style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); will-change: opacity; top: env(safe-area-inset-top, 0);"></div>
        
        <!-- Мобильное меню - компактное выдвигающееся справа -->
        <div class="fixed top-0 right-0 w-80 max-w-[85vw] h-full bg-dark-surface border-l border-dark-border z-50 overflow-y-auto hidden shadow-2xl transform translate-x-full transition-transform duration-300 ease-out" id="mobileMenu" role="menu" aria-label="<?php echo htmlspecialchars(t('nav.main')); ?>" aria-orientation="vertical" style="top: env(safe-area-inset-top, 0); padding-top: calc(3.5rem + env(safe-area-inset-top, 0)); backdrop-filter: blur(20px) saturate(180%); -webkit-backdrop-filter: blur(20px) saturate(180%); will-change: transform;">
            <!-- Заголовок меню с кнопкой закрытия -->
            <div class="flex items-center justify-between px-5 py-4 border-b border-dark-border/60 mb-2">
                <h2 class="text-lg font-bold text-gradient"><?php echo htmlspecialchars(t('nav.menu')); ?></h2>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-dark-bg/50 transition-colors touch-manipulation" id="mobileMenuCloseBtn" aria-label="<?php echo htmlspecialchars(t('nav.closeMenu')); ?>" type="button">
                    <svg class="w-5 h-5 text-gray-400 hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="px-4 py-4 space-y-2">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                ?>
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="mobile-menu-item block py-3 px-4 text-base text-gray-300 hover:text-white hover:bg-dark-bg/60 focus:text-white focus:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-lg transition-all duration-200 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-x-4 active:scale-[0.98] <?php echo $currentPage == 'index' ? 'text-neon-purple bg-dark-bg/40 font-semibold border-l-2 border-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.home')); ?></span>
                    <?php if ($currentPage == 'index'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="mobile-menu-item block py-3 px-4 text-base text-gray-300 hover:text-white hover:bg-dark-bg/60 focus:text-white focus:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-lg transition-all duration-200 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-x-4 active:scale-[0.98] <?php echo $currentPage == 'services' ? 'text-neon-purple bg-dark-bg/40 font-semibold border-l-2 border-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.services')); ?></span>
                    <?php if ($currentPage == 'services'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="mobile-menu-item block py-3 px-4 text-base text-gray-300 hover:text-white hover:bg-dark-bg/60 focus:text-white focus:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-lg transition-all duration-200 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-x-4 active:scale-[0.98] <?php echo $currentPage == 'seo' ? 'text-neon-purple bg-dark-bg/40 font-semibold border-l-2 border-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.seo')); ?></span>
                    <?php if ($currentPage == 'seo'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="mobile-menu-item block py-3 px-4 text-base text-gray-300 hover:text-white hover:bg-dark-bg/60 focus:text-white focus:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-lg transition-all duration-200 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-x-4 active:scale-[0.98] <?php echo $currentPage == 'ads' ? 'text-neon-purple bg-dark-bg/40 font-semibold border-l-2 border-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.ads')); ?></span>
                    <?php if ($currentPage == 'ads'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="mobile-menu-item block py-3 px-4 text-base text-gray-300 hover:text-white hover:bg-dark-bg/60 focus:text-white focus:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-lg transition-all duration-200 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-x-4 active:scale-[0.98] <?php echo $currentPage == 'about' ? 'text-neon-purple bg-dark-bg/40 font-semibold border-l-2 border-neon-purple' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.about')); ?></span>
                    <?php if ($currentPage == 'about'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="mobile-menu-item block relative w-full px-5 py-3.5 text-base font-semibold text-white rounded-lg bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg transition-all duration-200 shadow-lg shadow-neon-purple/40 hover:shadow-xl hover:shadow-neon-purple/60 active:scale-[0.97] mt-4 opacity-0 transform translate-x-4 min-h-[44px]" role="menuitem">
                    <span class="relative z-10 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php echo htmlspecialchars(t('nav.contact')); ?>
                    </span>
                </a>
                
                <!-- Переключатель языка в мобильном меню -->
                <div class="mobile-menu-item mt-4 pt-4 border-t border-dark-border/60 opacity-0 transform translate-x-4 pb-safe" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                    <div class="flex flex-col gap-3">
                        <span class="text-sm text-gray-400 font-medium"><?php echo htmlspecialchars(t('nav.language')); ?>:</span>
                        <div class="flex items-center gap-2 bg-dark-bg/40 backdrop-blur-sm rounded-lg p-1 border border-dark-border/60">
                            <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="flex-1 px-4 py-2 text-sm font-semibold rounded-md transition-all duration-200 text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                                RU
                            </a>
                            <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="flex-1 px-4 py-2 text-sm font-semibold rounded-md transition-all duration-200 text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                                EN
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Скрипт для мобильного меню - улучшенная анимация бургера и компактное меню -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileMenuCloseBtn = document.getElementById('mobileMenuCloseBtn');
            const burgerLines = mobileMenuBtn ? mobileMenuBtn.querySelectorAll('.burger-line') : [];
            let isMenuOpen = false;
            
            if (mobileMenuBtn && mobileMenu && mobileMenuOverlay) {
                // Функция анимации бургера в крестик
                function animateBurgerToX() {
                    if (burgerLines.length === 3) {
                        // Верхняя линия - поворачиваем и перемещаем в центр
                        burgerLines[0].style.top = '50%';
                        burgerLines[0].style.transform = 'translateY(-50%) rotate(45deg)';
                        
                        // Средняя линия - скрываем
                        burgerLines[1].style.opacity = '0';
                        burgerLines[1].style.transform = 'translateY(-50%) scaleX(0)';
                        
                        // Нижняя линия - поворачиваем и перемещаем в центр
                        burgerLines[2].style.bottom = '50%';
                        burgerLines[2].style.transform = 'translateY(50%) rotate(-45deg)';
                    }
                }
                
                // Функция анимации крестика обратно в бургер
                function animateXToBurger() {
                    if (burgerLines.length === 3) {
                        // Восстанавливаем верхнюю линию
                        burgerLines[0].style.top = '20%';
                        burgerLines[0].style.transform = 'none';
                        
                        // Восстанавливаем среднюю линию
                        burgerLines[1].style.opacity = '1';
                        burgerLines[1].style.transform = 'translateY(-50%) scaleX(1)';
                        
                        // Восстанавливаем нижнюю линию
                        burgerLines[2].style.bottom = '20%';
                        burgerLines[2].style.transform = 'none';
                    }
                }
                
                // Функция открытия меню
                function openMenu() {
                    isMenuOpen = true;
                    
                    // Обновляем ARIA атрибуты
                    mobileMenuBtn.setAttribute('aria-expanded', 'true');
                    mobileMenuBtn.setAttribute('aria-label', '<?php echo htmlspecialchars(t('nav.closeMenu')); ?>');
                    
                    // Анимируем бургер в крестик
                    animateBurgerToX();
                    
                    // Показываем overlay
                    mobileMenuOverlay.classList.remove('hidden');
                    mobileMenuOverlay.setAttribute('tabindex', '0');
                    setTimeout(() => {
                        mobileMenuOverlay.style.opacity = '1';
                    }, 10);
                    
                    // Показываем меню и выдвигаем справа
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.style.display = 'block';
                    // Небольшая задержка для правильной анимации
                    setTimeout(() => {
                        mobileMenu.style.transform = 'translateX(0)';
                    }, 10);
                    
                    // Предотвращаем скролл body при открытом меню
                    document.body.style.overflow = 'hidden';
                    
                    // Анимация появления элементов меню с задержкой
                    const menuItems = mobileMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                            item.style.transition = 'opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                        }, 50 + (index * 30)); // Задержка между элементами
                    });
                }
                
                // Функция закрытия меню
                function closeMenu() {
                    isMenuOpen = false;
                    
                    // Обновляем ARIA атрибуты
                    mobileMenuBtn.setAttribute('aria-expanded', 'false');
                    mobileMenuBtn.setAttribute('aria-label', '<?php echo htmlspecialchars(t('nav.menu')); ?>');
                    mobileMenuOverlay.setAttribute('tabindex', '-1');
                    
                    // Анимируем крестик обратно в бургер
                    animateXToBurger();
                    
                    // Скрываем overlay
                    mobileMenuOverlay.style.opacity = '0';
                    
                    // Анимация исчезновения элементов меню
                    const menuItems = mobileMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateX(1rem)';
                            item.style.transition = 'opacity 0.2s ease-in, transform 0.2s ease-in';
                        }, index * 15);
                    });
                    
                    // Выдвигаем меню обратно вправо
                    mobileMenu.style.transform = 'translateX(100%)';
                    
                    // Восстанавливаем скролл
                    document.body.style.overflow = '';
                    
                    // Закрываем после завершения анимации
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.display = 'none';
                        mobileMenuOverlay.classList.add('hidden');
                        
                        // Сбрасываем стили элементов для следующего открытия
                        menuItems.forEach(item => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateX(1rem)';
                        });
                    }, 300);
                }
                
                // Обработка клика/тапа на кнопку меню
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (isMenuOpen) {
                        closeMenu();
                    } else {
                        openMenu();
                    }
                });
                
                // Обработка клика на кнопку закрытия
                if (mobileMenuCloseBtn) {
                    mobileMenuCloseBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        closeMenu();
                    });
                }
                
                // Закрытие меню при клике на затемнение
                mobileMenuOverlay.addEventListener('click', function() {
                    closeMenu();
                });
                
                // Закрытие меню при нажатии Enter/Space на overlay
                mobileMenuOverlay.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        closeMenu();
                        mobileMenuBtn.focus();
                    }
                });
                
                // Закрытие меню при клике на ссылку внутри меню
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        closeMenu();
                    });
                });
                
                // Swipe жесты для закрытия меню (свайп влево)
                let touchStartX = 0;
                let touchEndX = 0;
                
                mobileMenu.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });
                
                mobileMenu.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                }, { passive: true });
                
                function handleSwipe() {
                    const swipeDistance = touchStartX - touchEndX;
                    const minSwipeDistance = 50;
                    
                    // Swipe влево для закрытия меню
                    if (swipeDistance < -minSwipeDistance && isMenuOpen) {
                        closeMenu();
                    }
                }
                
                // Закрытие меню при изменении размера окна (переход на десктоп)
                let resizeTimer;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        if (window.innerWidth >= 768 && isMenuOpen) {
                            closeMenu();
                        }
                    }, 150);
                });
                
                // Закрытие меню при нажатии Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && isMenuOpen) {
                        closeMenu();
                    }
                });
            }
        });
    </script>
    
    <!-- Breadcrumbs -->
    <?php 
    // Показываем breadcrumbs на всех страницах кроме главной
    if (basename($_SERVER['PHP_SELF'], '.php') !== 'index') {
        include __DIR__ . '/breadcrumbs.php';
    }
    ?>

