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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Title -->
    <title><?php 
        if (isset($pageMetaTitle)) {
            echo htmlspecialchars($pageMetaTitle);
        } else {
            echo isset($pageTitle) ? $pageTitle . ' - NovaCreator Studio' : 'NovaCreator Studio - Digital агентство';
        }
    ?></title>
    
    <!-- Подключаем функции для путей -->
    <?php include __DIR__ . '/paths.php'; ?>
    
    <!-- Подключаем SEO мета-теги -->
    <?php include __DIR__ . '/seo_meta.php'; ?>
    
    <!-- Preconnect для ускорения загрузки -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    
    <!-- Tailwind CSS -->
    <link href="<?php echo asset('assets/css/output.css'); ?>" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo asset('assets/img/favicon.ico'); ?>">
    <link rel="apple-touch-icon" href="<?php echo asset('assets/img/apple-touch-icon.png'); ?>">
    
    <!-- Дополнительные мета-теги -->
    <meta name="theme-color" content="#0A0A0F">
    <meta name="msapplication-TileColor" content="#8B5CF6">
    <meta name="format-detection" content="telephone=yes">
</head>
<body class="bg-dark-bg text-white overflow-x-hidden">
    
    <!-- Навигация -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50 bg-dark-bg/80 backdrop-blur-md border-b border-dark-border transition-all duration-300">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Логотип -->
                <a href="index.php" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center font-bold text-xl group-hover:scale-110 transition-transform duration-300">
                        S
                    </div>
                    <span class="text-2xl font-bold text-gradient">NovaCreator Studio</span>
                </a>
                
                <!-- Меню для десктопа -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-neon-purple' : ''; ?>">Главная</a>
                    <a href="services.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-neon-purple' : ''; ?>">Услуги</a>
                    <a href="seo.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'seo.php' ? 'text-neon-purple' : ''; ?>">SEO</a>
                    <a href="ads.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'ads.php' ? 'text-neon-purple' : ''; ?>">Google Ads</a>
                    <a href="portfolio.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'text-neon-purple' : ''; ?>">Портфолио</a>
                    <a href="about.php" class="nav-link text-gray-300 hover:text-neon-purple transition-colors duration-300 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'text-neon-purple' : ''; ?>">О нас</a>
                    <a href="contact.php" class="btn-neon text-sm py-2 px-6">Связаться</a>
                </div>
                
                <!-- Кнопка мобильного меню -->
                <button class="md:hidden text-gray-300 hover:text-neon-purple transition-colors" id="mobileMenuBtn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Мобильное меню -->
        <div class="hidden md:hidden border-t border-dark-border bg-dark-bg/95 backdrop-blur-md" id="mobileMenu">
            <div class="container mx-auto px-4 py-4 space-y-4">
                <a href="index.php" class="block text-gray-300 hover:text-neon-purple transition-colors">Главная</a>
                <a href="services.php" class="block text-gray-300 hover:text-neon-purple transition-colors">Услуги</a>
                <a href="seo.php" class="block text-gray-300 hover:text-neon-purple transition-colors">SEO</a>
                <a href="ads.php" class="block text-gray-300 hover:text-neon-purple transition-colors">Google Ads</a>
                <a href="portfolio.php" class="block text-gray-300 hover:text-neon-purple transition-colors">Портфолио</a>
                <a href="about.php" class="block text-gray-300 hover:text-neon-purple transition-colors">О нас</a>
                <a href="contact.php" class="block btn-neon text-center">Связаться</a>
            </div>
        </div>
    </nav>
    
    <!-- Скрипт для мобильного меню -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
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

