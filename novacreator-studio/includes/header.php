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
    <nav class="navbar fixed top-0 left-0 right-0 z-50 bg-dark-bg/80 backdrop-blur-md border-b border-dark-border transition-all duration-300" id="mainNavbar">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Логотип -->
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="flex items-center space-x-2 md:space-x-3 group touch-manipulation" aria-label="<?php echo htmlspecialchars(t('nav.home') . ' - ' . t('site.name')); ?>">
                    <img src="/assets/img/logo.svg" alt="<?php echo htmlspecialchars(t('alt.logo')); ?>" class="w-12 h-12 md:w-16 md:h-16 rounded-lg group-hover:scale-110 transition-transform duration-300" loading="lazy" decoding="async" fetchpriority="high" />
                    <span class="text-lg md:text-2xl font-semibold text-gradient"><?php echo htmlspecialchars(t('site.name')); ?></span>
                </a>
                
                <!-- Меню для десктопа -->
                <div class="hidden md:flex items-center space-x-8">
                    <?php 
                    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                    $currentPath = getCurrentPath();
                    ?>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'index' ? 'text-neon-purple' : ''; ?>"><?php echo htmlspecialchars(t('nav.home')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'services' ? 'text-neon-purple' : ''; ?>"><?php echo htmlspecialchars(t('nav.services')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'seo' ? 'text-neon-purple' : ''; ?>"><?php echo htmlspecialchars(t('nav.seo')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'ads' ? 'text-neon-purple' : ''; ?>"><?php echo htmlspecialchars(t('nav.ads')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'about' ? 'text-neon-purple' : ''; ?>"><?php echo htmlspecialchars(t('nav.about')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white rounded-lg bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 transition-all duration-300 shadow-lg shadow-neon-purple/30 hover:shadow-xl hover:shadow-neon-purple/50 hover:scale-105 active:scale-95">
                        <span class="relative z-10"><?php echo htmlspecialchars(t('nav.contact')); ?></span>
                    </a>
                    
                    <!-- Переключатель языка -->
                    <div class="flex items-center space-x-1 ml-4 pl-4 border-l border-dark-border bg-dark-surface/50 rounded-lg p-1">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>">
                            <span class="relative z-10">RU</span>
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>">
                            <span class="relative z-10">EN</span>
                        </a>
                    </div>
                </div>
                
                <!-- Переключатель языка и кнопка мобильного меню -->
                <div class="flex items-center space-x-2 md:space-x-3 flex-shrink-0">
                    <!-- Переключатель языка для мобильных -->
                    <div class="flex items-center space-x-1 md:hidden border-r border-dark-border pr-2 mr-1 bg-dark-surface/50 rounded-lg p-0.5">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="px-2.5 py-1 text-xs font-medium rounded-md transition-all duration-300 whitespace-nowrap min-w-[36px] text-center <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-sm shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>">
                            RU
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="px-2.5 py-1 text-xs font-medium rounded-md transition-all duration-300 whitespace-nowrap min-w-[36px] text-center <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-sm shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>">
                            EN
                        </a>
                    </div>
                    <!-- Кнопка мобильного меню - оптимизирована для touch -->
                    <button class="md:hidden text-gray-300 hover:text-neon-purple transition-colors p-2 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation flex-shrink-0" id="mobileMenuBtn" aria-label="<?php echo htmlspecialchars(t('nav.menu')); ?>">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Затемнение фона для мобильного меню -->
        <div class="fixed inset-0 bg-black/60 z-40 transition-opacity duration-300 hidden opacity-0" id="mobileMenuOverlay" style="backdrop-filter: blur(20px) saturate(180%); -webkit-backdrop-filter: blur(20px) saturate(180%); will-change: backdrop-filter; transform: translateZ(0); -webkit-transform: translateZ(0);"></div>
        
        <!-- Мобильное меню - оптимизировано для touch -->
        <div class="fixed top-16 left-0 right-0 border-t border-dark-border bg-dark-bg/95 z-50 overflow-y-auto hidden shadow-lg" id="mobileMenu" style="max-height: calc(100vh - 4rem); backdrop-filter: blur(30px) saturate(180%); -webkit-backdrop-filter: blur(30px) saturate(180%); transform: translateZ(0); -webkit-transform: translateZ(0);">
            <div class="container mx-auto px-4 py-6 space-y-2">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                ?>
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="mobile-menu-item block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-y-2 <?php echo $currentPage == 'index' ? 'text-neon-purple bg-dark-surface' : ''; ?>"><?php echo htmlspecialchars(t('nav.home')); ?></a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="mobile-menu-item block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-y-2 <?php echo $currentPage == 'services' ? 'text-neon-purple bg-dark-surface' : ''; ?>"><?php echo htmlspecialchars(t('nav.services')); ?></a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="mobile-menu-item block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-y-2 <?php echo $currentPage == 'seo' ? 'text-neon-purple bg-dark-surface' : ''; ?>"><?php echo htmlspecialchars(t('nav.seo')); ?></a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="mobile-menu-item block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-y-2 <?php echo $currentPage == 'ads' ? 'text-neon-purple bg-dark-surface' : ''; ?>"><?php echo htmlspecialchars(t('nav.ads')); ?></a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="mobile-menu-item block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation opacity-0 transform translate-y-2 <?php echo $currentPage == 'about' ? 'text-neon-purple bg-dark-surface' : ''; ?>"><?php echo htmlspecialchars(t('nav.about')); ?></a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="mobile-menu-item block relative inline-flex items-center justify-center w-full px-6 py-3 text-base font-semibold text-white rounded-lg bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 transition-all duration-300 shadow-lg shadow-neon-purple/30 hover:shadow-xl hover:shadow-neon-purple/50 mt-4 opacity-0 transform translate-y-2">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('nav.contact')); ?></span>
                </a>
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
                    
                    // Показываем overlay
                    mobileMenuOverlay.classList.remove('hidden');
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
                            item.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                        }, 50 + (index * 50)); // Задержка 50ms между каждой кнопкой
                    });
                    
                    // Меняем иконку на крестик
                    const icon = mobileMenuBtn.querySelector('svg');
                    if (icon) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                        icon.classList.add('rotate-90');
                    }
                }
                
                // Функция закрытия меню
                function closeMenu() {
                    isMenuOpen = false;
                    mobileMenuOverlay.style.opacity = '0';
                    
                    // Анимация исчезновения кнопок меню
                    const menuItems = mobileMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(-10px)';
                        }, index * 30); // Быстрая анимация закрытия
                    });
                    
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
                            item.style.transform = 'translateY(8px)';
                        });
                    }, 300);
                    
                    // Меняем иконку на гамбургер
                    const icon = mobileMenuBtn.querySelector('svg');
                    if (icon) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                        icon.classList.remove('rotate-90');
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
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768 && isMenuOpen) {
                        closeMenu();
                    }
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

