<?php
/**
 * Общий header для всех страниц
 * Содержит навигацию и мета-теги
 */
?>
<!DOCTYPE html>
<html lang="ru" itemscope itemtype="https://schema.org/WebSite">
<head>
    <meta charset="UTF-8">
    <!-- Viewport оптимизирован для мобильных устройств -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
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
    <nav class="navbar fixed top-0 left-0 right-0 z-50 bg-dark-bg/80 backdrop-blur-md border-b border-dark-border transition-all duration-300">
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
                <button class="md:hidden text-gray-300 hover:text-neon-purple transition-colors p-2 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation relative z-[60]" id="mobileMenuBtn" aria-label="Открыть меню">
                    <svg class="w-7 h-7 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="menuIcon">
                        <path class="hamburger-top" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16"></path>
                        <path class="hamburger-middle" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 12h16"></path>
                        <path class="hamburger-bottom" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Backdrop для мобильного меню -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-opacity duration-300" id="mobileMenuBackdrop"></div>
        
        <!-- Мобильное меню - улучшенная анимация -->
        <div class="fixed top-[64px] left-0 right-0 bg-dark-bg/98 backdrop-blur-xl shadow-2xl z-50 transform -translate-y-full transition-all duration-500 ease-out overflow-hidden border-b border-dark-border" id="mobileMenu" style="max-height: calc(100vh - 64px);">
            <div class="container mx-auto px-4 py-6 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 88px);">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                $menuItems = [
                    ['url' => '/', 'label' => 'Главная', 'page' => 'index', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['url' => '/services', 'label' => 'Услуги', 'page' => 'services', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['url' => '/seo', 'label' => 'SEO', 'page' => 'seo', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['url' => '/ads', 'label' => 'Google Ads', 'page' => 'ads', 'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z'],
                    ['url' => '/about', 'label' => 'О нас', 'page' => 'about', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
                
                foreach ($menuItems as $index => $item):
                    $isActive = $currentPage == $item['page'];
                ?>
                <a href="<?php echo $item['url']; ?>" 
                   class="mobile-menu-item flex items-center space-x-4 py-4 px-5 text-gray-300 hover:text-neon-purple hover:bg-dark-surface/80 rounded-xl transition-all duration-300 min-h-[56px] touch-manipulation group <?php echo $isActive ? 'text-neon-purple bg-dark-surface/80 shadow-lg shadow-neon-purple/10' : ''; ?>"
                   style="animation-delay: <?php echo ($index * 50); ?>ms;">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gradient-to-br <?php echo $isActive ? 'from-neon-purple to-neon-blue' : 'from-dark-surface to-dark-border'; ?> group-hover:from-neon-purple group-hover:to-neon-blue transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $item['icon']; ?>"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-lg"><?php echo $item['label']; ?></span>
                    <svg class="w-5 h-5 ml-auto transform transition-transform duration-300 group-hover:translate-x-1 <?php echo $isActive ? 'opacity-100' : 'opacity-0'; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <?php endforeach; ?>
                
                <div class="pt-4 pb-2 mobile-menu-item" style="animation-delay: 250ms;">
                    <a href="/contact" class="block btn-neon text-center text-lg py-4 shadow-lg shadow-neon-purple/20 hover:shadow-neon-purple/40 transition-all duration-300">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Связаться с нами</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Скрипт для мобильного меню - улучшенная анимация -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const backdrop = document.getElementById('mobileMenuBackdrop');
            const menuIcon = document.getElementById('menuIcon');
            const body = document.body;
            let isMenuOpen = false;
            
            if (mobileMenuBtn && mobileMenu && backdrop) {
                // Функция открытия меню
                function openMenu() {
                    isMenuOpen = true;
                    
                    // Показываем backdrop
                    backdrop.classList.remove('pointer-events-none');
                    setTimeout(() => {
                        backdrop.classList.remove('opacity-0');
                        backdrop.classList.add('opacity-100');
                    }, 10);
                    
                    // Анимация меню
                    mobileMenu.classList.remove('-translate-y-full');
                    mobileMenu.classList.add('translate-y-0');
                    
                    // Блокируем скролл
                    body.style.overflow = 'hidden';
                    
                    // Анимация иконки в крестик
                    menuIcon.classList.add('menu-open');
                    const paths = menuIcon.querySelectorAll('path');
                    if (paths.length === 3) {
                        paths[0].setAttribute('d', 'M6 18L18 6');
                        paths[1].setAttribute('d', 'M12 12h0');
                        paths[1].style.opacity = '0';
                        paths[2].setAttribute('d', 'M6 6l12 12');
                    }
                    
                    // Анимация элементов меню
                    const menuItems = mobileMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach((item, index) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateX(-20px)';
                        setTimeout(() => {
                            item.style.transition = 'opacity 0.4s ease-out, transform 0.4s ease-out';
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                        }, 100 + (index * 50));
                    });
                    
                    // Haptic feedback
                    if ('vibrate' in navigator) {
                        navigator.vibrate(10);
                    }
                }
                
                // Функция закрытия меню
                function closeMenu() {
                    isMenuOpen = false;
                    
                    // Скрываем backdrop
                    backdrop.classList.remove('opacity-100');
                    backdrop.classList.add('opacity-0');
                    setTimeout(() => {
                        backdrop.classList.add('pointer-events-none');
                    }, 300);
                    
                    // Анимация меню
                    mobileMenu.classList.remove('translate-y-0');
                    mobileMenu.classList.add('-translate-y-full');
                    
                    // Разблокируем скролл
                    setTimeout(() => {
                        body.style.overflow = '';
                    }, 300);
                    
                    // Анимация иконки в гамбургер
                    menuIcon.classList.remove('menu-open');
                    const paths = menuIcon.querySelectorAll('path');
                    if (paths.length === 3) {
                        paths[0].setAttribute('d', 'M4 6h16');
                        paths[1].setAttribute('d', 'M4 12h16');
                        paths[1].style.opacity = '1';
                        paths[2].setAttribute('d', 'M4 18h16');
                    }
                    
                    // Haptic feedback
                    if ('vibrate' in navigator) {
                        navigator.vibrate(5);
                    }
                }
                
                // Обработка клика на кнопку меню
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (isMenuOpen) {
                        closeMenu();
                    } else {
                        openMenu();
                    }
                });
                
                // Закрытие меню при клике на backdrop
                backdrop.addEventListener('click', function() {
                    closeMenu();
                });
                
                // Закрытие меню при клике на ссылку
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        closeMenu();
                    });
                });
                
                // Закрытие меню при нажатии Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && isMenuOpen) {
                        closeMenu();
                    }
                });
                
                // Обработка изменения размера окна
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768 && isMenuOpen) {
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

