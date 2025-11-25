<?php
/**
 * Общий header для всех страниц
 * Содержит навигацию и мета-теги
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
                
                <!-- Переключатель языка и кнопка мобильного меню -->
                <div class="flex items-center gap-2 sm:gap-2.5 md:gap-3 flex-shrink-0">
                    <!-- Переключатель языка для мобильных -->
                    <div class="flex items-center gap-0.5 md:hidden bg-dark-surface/60 backdrop-blur-sm rounded-lg p-0.5 border border-dark-border/60 shadow-sm" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="px-2.5 py-1.5 text-xs sm:text-sm font-semibold rounded-md transition-all duration-200 whitespace-nowrap min-w-[36px] sm:min-w-[40px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                            RU
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="px-2.5 py-1.5 text-xs sm:text-sm font-semibold rounded-md transition-all duration-200 whitespace-nowrap min-w-[36px] sm:min-w-[40px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                            EN
                        </a>
                    </div>
                    <!-- Кнопка мобильного меню - оптимизирована для touch -->
                    <button class="md:hidden text-gray-300 hover:text-neon-purple active:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-lg transition-all duration-200 p-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation flex-shrink-0 hover:bg-dark-surface/50 active:bg-dark-surface/70 active:scale-95" id="mobileMenuBtn" aria-label="<?php echo htmlspecialchars(t('nav.menu')); ?>" aria-expanded="false" aria-controls="mobileMenu" type="button">
                        <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="sr-only"><?php echo htmlspecialchars(t('nav.menu')); ?></span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Затемнение фона для мобильного меню -->
        <div class="fixed inset-0 bg-black/70 z-40 transition-opacity duration-300 hidden opacity-0" id="mobileMenuOverlay" role="button" tabindex="-1" aria-label="<?php echo htmlspecialchars(t('nav.closeMenu')); ?>" style="backdrop-filter: blur(24px) saturate(180%); -webkit-backdrop-filter: blur(24px) saturate(180%); will-change: backdrop-filter, opacity; transform: translateZ(0); -webkit-transform: translateZ(0); top: env(safe-area-inset-top, 0);"></div>
        
        <!-- Мобильное меню - оптимизировано для touch -->
        <div class="fixed left-0 right-0 border-t border-dark-border/80 bg-dark-bg/98 z-50 overflow-y-auto hidden shadow-2xl" id="mobileMenu" role="menu" aria-label="<?php echo htmlspecialchars(t('nav.main')); ?>" aria-orientation="vertical" style="top: calc(3.5rem + env(safe-area-inset-top, 0)); max-height: calc(100vh - 3.5rem - env(safe-area-inset-top, 0)); backdrop-filter: blur(32px) saturate(180%); -webkit-backdrop-filter: blur(32px) saturate(180%); transform: translateZ(0); -webkit-transform: translateZ(0); will-change: transform, opacity;">
            <div class="container mx-auto px-4 sm:px-5 py-5 sm:py-6 space-y-2">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                ?>
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="mobile-menu-item block py-3.5 sm:py-4 px-4 sm:px-5 text-base sm:text-lg text-gray-300 hover:text-white hover:bg-dark-surface/80 focus:text-white focus:bg-dark-surface focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-xl transition-all duration-200 min-h-[52px] sm:min-h-[56px] flex items-center touch-manipulation opacity-0 transform translate-y-3 active:scale-[0.98] <?php echo $currentPage == 'index' ? 'text-neon-purple bg-dark-surface/60 font-semibold shadow-sm shadow-neon-purple/20' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.home')); ?></span>
                    <?php if ($currentPage == 'index'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="mobile-menu-item block py-3.5 sm:py-4 px-4 sm:px-5 text-base sm:text-lg text-gray-300 hover:text-white hover:bg-dark-surface/80 focus:text-white focus:bg-dark-surface focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-xl transition-all duration-200 min-h-[52px] sm:min-h-[56px] flex items-center touch-manipulation opacity-0 transform translate-y-3 active:scale-[0.98] <?php echo $currentPage == 'services' ? 'text-neon-purple bg-dark-surface/60 font-semibold shadow-sm shadow-neon-purple/20' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.services')); ?></span>
                    <?php if ($currentPage == 'services'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="mobile-menu-item block py-3.5 sm:py-4 px-4 sm:px-5 text-base sm:text-lg text-gray-300 hover:text-white hover:bg-dark-surface/80 focus:text-white focus:bg-dark-surface focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-xl transition-all duration-200 min-h-[52px] sm:min-h-[56px] flex items-center touch-manipulation opacity-0 transform translate-y-3 active:scale-[0.98] <?php echo $currentPage == 'seo' ? 'text-neon-purple bg-dark-surface/60 font-semibold shadow-sm shadow-neon-purple/20' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.seo')); ?></span>
                    <?php if ($currentPage == 'seo'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="mobile-menu-item block py-3.5 sm:py-4 px-4 sm:px-5 text-base sm:text-lg text-gray-300 hover:text-white hover:bg-dark-surface/80 focus:text-white focus:bg-dark-surface focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-xl transition-all duration-200 min-h-[52px] sm:min-h-[56px] flex items-center touch-manipulation opacity-0 transform translate-y-3 active:scale-[0.98] <?php echo $currentPage == 'ads' ? 'text-neon-purple bg-dark-surface/60 font-semibold shadow-sm shadow-neon-purple/20' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.ads')); ?></span>
                    <?php if ($currentPage == 'ads'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="mobile-menu-item block py-3.5 sm:py-4 px-4 sm:px-5 text-base sm:text-lg text-gray-300 hover:text-white hover:bg-dark-surface/80 focus:text-white focus:bg-dark-surface focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-inset rounded-xl transition-all duration-200 min-h-[52px] sm:min-h-[56px] flex items-center touch-manipulation opacity-0 transform translate-y-3 active:scale-[0.98] <?php echo $currentPage == 'about' ? 'text-neon-purple bg-dark-surface/60 font-semibold shadow-sm shadow-neon-purple/20' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>">
                    <span class="flex-1 font-medium"><?php echo htmlspecialchars(t('nav.about')); ?></span>
                    <?php if ($currentPage == 'about'): ?>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neon-purple ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    <?php endif; ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="mobile-menu-item block relative w-full px-6 sm:px-7 py-4 sm:py-4.5 text-base sm:text-lg font-semibold text-white rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg transition-all duration-200 shadow-lg shadow-neon-purple/40 hover:shadow-xl hover:shadow-neon-purple/60 active:scale-[0.97] mt-4 sm:mt-5 opacity-0 transform translate-y-3 min-h-[52px] sm:min-h-[56px]" role="menuitem">
                    <span class="relative z-10 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php echo htmlspecialchars(t('nav.contact')); ?>
                    </span>
                </a>
                
                <!-- Переключатель языка в мобильном меню -->
                <div class="mobile-menu-item flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-2 mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-dark-border/60 opacity-0 transform translate-y-3 pb-safe" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                    <span class="text-sm sm:text-base text-gray-400 font-medium"><?php echo htmlspecialchars(t('nav.language')); ?>:</span>
                    <div class="flex items-center gap-1.5 bg-dark-surface/60 backdrop-blur-sm rounded-xl p-1.5 border border-dark-border/60 shadow-sm">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="px-5 sm:px-6 py-2.5 sm:py-3 text-sm sm:text-base font-semibold rounded-lg transition-all duration-200 whitespace-nowrap min-w-[50px] sm:min-w-[60px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                            RU
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="px-5 sm:px-6 py-2.5 sm:py-3 text-sm sm:text-base font-semibold rounded-lg transition-all duration-200 whitespace-nowrap min-w-[50px] sm:min-w-[60px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                            EN
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Скрипт для мобильного меню - оптимизирован для touch -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            let isMenuOpen = false;
            
            if (mobileMenuBtn && mobileMenu && mobileMenuOverlay) {
                // Функция открытия меню
                function openMenu() {
                    isMenuOpen = true;
                    
                    // Обновляем ARIA атрибуты
                    mobileMenuBtn.setAttribute('aria-expanded', 'true');
                    mobileMenuBtn.setAttribute('aria-label', '<?php echo htmlspecialchars(t('nav.closeMenu')); ?>');
                    
                    // Показываем overlay
                    mobileMenuOverlay.classList.remove('hidden');
                    mobileMenuOverlay.setAttribute('tabindex', '0');
                    setTimeout(() => {
                        mobileMenuOverlay.style.opacity = '1';
                    }, 10);
                    
                    // Показываем меню
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.style.display = 'block';
                    
                    // Предотвращаем скролл body при открытом меню
                    document.body.style.overflow = 'hidden';
                    
                    // Анимация появления кнопок меню с задержкой
                    const menuItems = mobileMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                            item.style.transition = 'opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1), transform 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
                        }, 40 + (index * 40)); // Задержка 40ms между каждой кнопкой
                    });
                    
                    // Анимация для переключателя языков (если он есть отдельно)
                    const langSwitcher = mobileMenu.querySelector('[role="group"][aria-label*="language"]');
                    if (langSwitcher && langSwitcher.classList.contains('mobile-menu-item')) {
                        setTimeout(() => {
                            langSwitcher.style.opacity = '1';
                            langSwitcher.style.transform = 'translateY(0)';
                            langSwitcher.style.transition = 'opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1), transform 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
                        }, 40 + (menuItems.length * 40));
                    }
                    
                    // Фокусируемся на первом элементе меню для клавиатурной навигации
                    setTimeout(() => {
                        const firstMenuItem = mobileMenu.querySelector('.mobile-menu-item');
                        if (firstMenuItem) {
                            firstMenuItem.focus();
                        }
                    }, 100);
                    
                    // Меняем иконку на крестик
                    const icon = mobileMenuBtn.querySelector('svg');
                    if (icon) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>';
                        icon.style.transform = 'rotate(90deg)';
                    }
                }
                
                // Функция закрытия меню
                function closeMenu() {
                    isMenuOpen = false;
                    
                    // Обновляем ARIA атрибуты
                    mobileMenuBtn.setAttribute('aria-expanded', 'false');
                    mobileMenuBtn.setAttribute('aria-label', '<?php echo htmlspecialchars(t('nav.menu')); ?>');
                    mobileMenuOverlay.setAttribute('tabindex', '-1');
                    
                    mobileMenuOverlay.style.opacity = '0';
                    
                    // Анимация исчезновения кнопок меню
                    const menuItems = mobileMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(-12px)';
                            item.style.transition = 'opacity 0.25s ease-in, transform 0.25s ease-in';
                        }, index * 25); // Быстрая анимация закрытия
                    });
                    
                    // Анимация для переключателя языков при закрытии
                    const langSwitcher = mobileMenu.querySelector('[role="group"][aria-label*="language"]');
                    if (langSwitcher && langSwitcher.classList.contains('mobile-menu-item')) {
                        setTimeout(() => {
                            langSwitcher.style.opacity = '0';
                            langSwitcher.style.transform = 'translateY(-12px)';
                            langSwitcher.style.transition = 'opacity 0.25s ease-in, transform 0.25s ease-in';
                        }, menuItems.length * 25);
                    }
                    
                    // Восстанавливаем скролл
                    document.body.style.overflow = '';
                    
                    // Закрываем после завершения анимации
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.display = 'none';
                        mobileMenuOverlay.classList.add('hidden');
                        
                        // Сбрасываем стили кнопок для следующего открытия
                        menuItems.forEach(item => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(12px)';
                        });
                        
                        // Сбрасываем стили переключателя языков
                        const langSwitcher = mobileMenu.querySelector('[role="group"][aria-label*="language"]');
                        if (langSwitcher && langSwitcher.classList.contains('mobile-menu-item')) {
                            langSwitcher.style.opacity = '0';
                            langSwitcher.style.transform = 'translateY(12px)';
                        }
                    }, 300);
                    
                    // Меняем иконку на гамбургер
                    const icon = mobileMenuBtn.querySelector('svg');
                    if (icon) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>';
                        icon.style.transform = 'rotate(0deg)';
                    }
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
                
                // Swipe жесты для закрытия меню
                let touchStartY = 0;
                let touchEndY = 0;
                
                mobileMenu.addEventListener('touchstart', function(e) {
                    touchStartY = e.changedTouches[0].screenY;
                }, { passive: true });
                
                mobileMenu.addEventListener('touchend', function(e) {
                    touchEndY = e.changedTouches[0].screenY;
                    handleSwipe();
                }, { passive: true });
                
                function handleSwipe() {
                    const swipeDistance = touchStartY - touchEndY;
                    const minSwipeDistance = 100;
                    
                    // Swipe вверх для закрытия меню
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

