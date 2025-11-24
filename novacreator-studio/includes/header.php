<?php
/**
 * Общий header для всех страниц
 * Содержит навигацию и мета-теги
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru" itemscope itemtype="https://schema.org/WebSite">
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
            echo isset($pageTitle) ? $pageTitle . ' - NovaCreator Studio' : 'NovaCreator Studio - Digital агентство';
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
                <a href="/" class="flex items-center space-x-2 md:space-x-3 group touch-manipulation" aria-label="На главную NovaCreator Studio">
                    <img src="./assets/img/logo.svg" alt="Логотип NovaCreator Studio - Digital агентство в Казахстане" class="w-12 h-12 md:w-16 md:h-16 rounded-lg group-hover:scale-110 transition-transform duration-300" loading="lazy" decoding="async" fetchpriority="high" />
                    <span class="text-lg md:text-2xl font-bold text-gradient">NovaCreator Studio</span>
                </a>
                
                <!-- Меню для десктопа -->
                <div class="hidden md:flex items-center space-x-8">
                    <?php 
                    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                    ?>
                    <a href="/" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'index' ? 'text-neon-purple' : ''; ?>">Главная</a>
                    <a href="/services" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'services' ? 'text-neon-purple' : ''; ?>">Услуги</a>
                    <a href="/seo" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'seo' ? 'text-neon-purple' : ''; ?>">SEO</a>
                    <a href="/ads" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'ads' ? 'text-neon-purple' : ''; ?>">Google Ads</a>
                    <a href="/about" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo $currentPage == 'about' ? 'text-neon-purple' : ''; ?>">О нас</a>
                    <a href="/contact" class="btn-neon text-sm py-2 px-6">Связаться</a>
                </div>
                
                <!-- Кнопка мобильного меню - оптимизирована для touch -->
                <button class="md:hidden text-gray-300 hover:text-neon-purple transition-colors p-2 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation" id="mobileMenuBtn" aria-label="Открыть меню">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Затемнение фона для мобильного меню -->
        <div class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-40 transition-opacity duration-300" id="mobileMenuOverlay"></div>
        
        <!-- Мобильное меню - оптимизировано для touch -->
        <div class="hidden fixed top-16 left-0 right-0 bottom-0 border-t border-dark-border bg-dark-bg/98 backdrop-blur-md z-50 transform transition-transform duration-300 ease-in-out overflow-y-auto" id="mobileMenu" style="transform: translateY(-100%);">
            <div class="container mx-auto px-4 py-6 space-y-2 pb-safe">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                ?>
                <a href="/" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo $currentPage == 'index' ? 'text-neon-purple bg-dark-surface' : ''; ?>">Главная</a>
                <a href="/services" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo $currentPage == 'services' ? 'text-neon-purple bg-dark-surface' : ''; ?>">Услуги</a>
                <a href="/seo" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo $currentPage == 'seo' ? 'text-neon-purple bg-dark-surface' : ''; ?>">SEO</a>
                <a href="/ads" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo $currentPage == 'ads' ? 'text-neon-purple bg-dark-surface' : ''; ?>">Google Ads</a>
                <a href="/about" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo $currentPage == 'about' ? 'text-neon-purple bg-dark-surface' : ''; ?>">О нас</a>
                <a href="/contact" class="block btn-neon text-center mt-4">Связаться</a>
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
                    mobileMenu.classList.remove('hidden');
                    mobileMenuOverlay.classList.remove('hidden');
                    // Предотвращаем скролл body при открытом меню
                    document.body.style.overflow = 'hidden';
                    
                    // Анимация появления
                    requestAnimationFrame(() => {
                        mobileMenuOverlay.style.opacity = '1';
                        mobileMenu.style.transform = 'translateY(0)';
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
                    mobileMenu.style.transform = 'translateY(-100%)';
                    
                    // Восстанавливаем скролл
                    document.body.style.overflow = '';
                    
                    // Закрываем после завершения анимации
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenuOverlay.classList.add('hidden');
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

