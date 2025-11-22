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
    
    // Формируем путь к CSS
    $cssPath = ($baseDir ? $baseDir . '/' : '/') . 'assets/css/output.css';
    $cssPath = preg_replace('#/+#', '/', $cssPath);
    ?>
    <link href="<?php echo $cssPath; ?>" rel="stylesheet">
    
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
                <a href="index.php" class="flex items-center space-x-2 md:space-x-3 group touch-manipulation">
                    <img src="./assets/img/NCS.svg" alt="Логотип NovaCreator Studio - Digital агентство в Казахстане" class="w-12 h-12 md:w-16 md:h-16 rounded-lg group-hover:scale-110 transition-transform duration-300" loading="lazy" />
                    <span class="text-lg md:text-2xl font-bold text-gradient">NovaCreator Studio</span>
                </a>
                
                <!-- Меню для десктопа -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-neon-purple' : ''; ?>">Главная</a>
                    <a href="services.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-neon-purple' : ''; ?>">Услуги</a>
                    <a href="seo.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'seo.php' ? 'text-neon-purple' : ''; ?>">SEO</a>
                    <a href="ads.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'ads.php' ? 'text-neon-purple' : ''; ?>">Google Ads</a>
                    <a href="about.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'text-neon-purple' : ''; ?>">О нас</a>
                    <a href="contact.php" class="btn-neon text-sm py-2 px-6">Связаться</a>
                </div>
                
                <!-- Кнопка мобильного меню - оптимизирована для touch -->
                <button class="md:hidden text-gray-300 hover:text-neon-purple transition-colors p-2 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation" id="mobileMenuBtn" aria-label="Открыть меню">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Мобильное меню - оптимизировано для touch -->
        <div class="hidden border-t border-dark-border bg-dark-bg/95 backdrop-blur-md" id="mobileMenu">
            <div class="container mx-auto px-4 py-4 space-y-2">
                <a href="index.php" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-neon-purple bg-dark-surface' : ''; ?>">Главная</a>
                <a href="services.php" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-neon-purple bg-dark-surface' : ''; ?>">Услуги</a>
                <a href="seo.php" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo basename($_SERVER['PHP_SELF']) == 'seo.php' ? 'text-neon-purple bg-dark-surface' : ''; ?>">SEO</a>
                <a href="ads.php" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo basename($_SERVER['PHP_SELF']) == 'ads.php' ? 'text-neon-purple bg-dark-surface' : ''; ?>">Google Ads</a>
                <a href="about.php" class="block py-3 px-4 text-gray-300 hover:text-neon-purple hover:bg-dark-surface rounded-lg transition-all duration-300 min-h-[44px] flex items-center touch-manipulation <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'text-neon-purple bg-dark-surface' : ''; ?>">О нас</a>
                <a href="contact.php" class="block btn-neon text-center mt-4">Связаться</a>
            </div>
        </div>
    </nav>
    
    <!-- Скрипт для мобильного меню - оптимизирован для touch -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuBtn && mobileMenu) {
                // Обработка клика/тапа
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                    
                    // Меняем иконку (гамбургер/крестик)
                    const icon = mobileMenuBtn.querySelector('svg');
                    if (icon) {
                        if (mobileMenu.classList.contains('hidden')) {
                            // Показываем гамбургер
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                        } else {
                            // Показываем крестик
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                        }
                    }
                });
                
                // Закрытие меню при клике вне его
                document.addEventListener('click', function(e) {
                    if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                        mobileMenu.classList.add('hidden');
                        const icon = mobileMenuBtn.querySelector('svg');
                        if (icon) {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                        }
                    }
                });
                
                // Закрытие меню при клике на ссылку внутри меню
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                        const icon = mobileMenuBtn.querySelector('svg');
                        if (icon) {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                        }
                    });
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

