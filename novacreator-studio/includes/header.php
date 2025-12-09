<?php
/**
 * Общий header для всех страниц
 * Содержит навигацию и мета-теги
 */
require_once __DIR__ . '/auth.php';
startSecureSession();

// Подключаем систему защиты от ботов (должно быть первым)
require_once __DIR__ . '/bot_detection.php';
checkAndBlockBots();

// Подключаем систему локализации
require_once __DIR__ . '/i18n.php';

// Определяем язык и загружаем переводы
$currentLang = getCurrentLanguage();
$langMap = ['ru' => 'ru', 'en' => 'en'];
$htmlLang = $langMap[$currentLang] ?? 'ru';

// Текущий пользователь (если авторизован)
$currentUser = getAuthenticatedUser();
// Убеждаемся, что avatar_url загружен из БД (на случай, если getUserById не вернул его)
if ($currentUser && isset($_SESSION['user_id'])) {
    // Если avatar_url не установлен, загружаем из БД
    if (!isset($currentUser['avatar_url']) || empty($currentUser['avatar_url'])) {
        require_once __DIR__ . '/db.php';
        $pdo = getDb();
        $stmt = $pdo->prepare('SELECT avatar_url FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => (int)$_SESSION['user_id']]);
        $avatarData = $stmt->fetch();
        if ($avatarData && !empty($avatarData['avatar_url'])) {
            $currentUser['avatar_url'] = $avatarData['avatar_url'];
        }
    }
}
$isRootAdmin = $currentUser && mb_strtolower($currentUser['email']) === mb_strtolower(ROOT_ADMIN_EMAIL);

// Определяем базовый URL для RSS и других ссылок
$host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$siteUrl = $scheme . '://' . $host;
?>
<?php
// Подключаем переключатель темы
require_once __DIR__ . '/theme_switcher.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>" itemscope itemtype="https://schema.org/WebSite" class="<?php echo $currentTheme; ?>">
<head>
    <meta charset="UTF-8">
    <!-- Viewport оптимизирован для мобильных устройств с поддержкой safe area insets -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Предотвращение автоматического определения телефонных номеров на iOS -->
    <meta name="format-detection" content="telephone=yes">
    
    <!-- Google tag (gtag.js) - Улучшенная аналитика -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XD6LHCBQZS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        // Базовая конфигурация
        gtag('config', 'G-XD6LHCBQZS', {
            'page_path': window.location.pathname + window.location.search,
            'page_title': document.title,
            'page_location': window.location.href,
            'send_page_view': true,
            'anonymize_ip': false,
            'cookie_flags': 'SameSite=None;Secure'
        });
        
        // Отслеживание событий скролла
        let scrollTracked = false;
        window.addEventListener('scroll', function() {
            if (!scrollTracked && window.scrollY > window.innerHeight * 0.5) {
                scrollTracked = true;
                gtag('event', 'scroll', {
                    'event_category': 'engagement',
                    'event_label': '50% scroll',
                    'value': 1
                });
            }
        }, { passive: true });
        
        // Отслеживание времени на странице
        let timeOnPage = 0;
        setInterval(function() {
            timeOnPage += 30;
            if (timeOnPage === 30) {
                gtag('event', 'timing_complete', {
                    'name': 'time_on_page',
                    'value': 30
                });
            }
        }, 30000);
        
        // Отслеживание кликов по внешним ссылкам
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="http"]').forEach(function(link) {
                if (link.hostname !== window.location.hostname) {
                    link.addEventListener('click', function() {
                        gtag('event', 'click', {
                            'event_category': 'outbound',
                            'event_label': link.href,
                            'transport_type': 'beacon'
                        });
                    });
                }
            });
        });
        
        // Отслеживание загрузки файлов
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href$=".pdf"], a[href$=".doc"], a[href$=".zip"]').forEach(function(link) {
                link.addEventListener('click', function() {
                    gtag('event', 'file_download', {
                        'event_category': 'downloads',
                        'event_label': link.href.split('/').pop(),
                        'transport_type': 'beacon'
                    });
                });
            });
        });
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
    
    // Для админок /adm/* и старого /admin/* принудительно берём корень
    if (strpos($scriptPath, '/adm/') === 0 || $scriptPath === '/adm' || $scriptPath === '/adm/index.php' || strpos($scriptPath, '/admin/') === 0) {
        $baseDir = '';
    }

    // Нормализуем путь
    $baseDir = ($baseDir === '/' || $baseDir === '\\' || $baseDir === '.') ? '' : $baseDir;
    $baseDir = rtrim($baseDir, '/\\');
    
    // Переопределение базы ассетов (например, для вложенных демо-страниц)
    if (!empty($GLOBALS['ASSET_BASE_OVERRIDE']) || $GLOBALS['ASSET_BASE_OVERRIDE'] === '') {
        $baseDir = $GLOBALS['ASSET_BASE_OVERRIDE'];
    }

    // Формируем путь к CSS и JS
    $cssPath = ($baseDir ? $baseDir . '/' : '/') . 'assets/css/output.css';
    $cssPath = preg_replace('#/+#', '/', $cssPath);
    $jsPreloadPath = ($baseDir ? $baseDir . '/' : '/') . 'assets/js/main.min.js';
    $jsPreloadPath = preg_replace('#/+#', '/', $jsPreloadPath);
    ?>
    <link rel="preload" as="style" href="<?php echo $cssPath; ?>">
    <link href="<?php echo $cssPath; ?>" rel="stylesheet">
    <link rel="preload" as="image" type="image/webp" href="/assets/img/og-default.webp">
    <link rel="preload" as="script" href="<?php echo $jsPreloadPath; ?>">
    <meta name="color-scheme" content="dark light">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/favicon.ico">
    
    <!-- RSS Feed -->
    <link rel="alternate" type="application/rss+xml" title="<?php echo htmlspecialchars(t('site.name')); ?> - RSS Feed (RU)" href="<?php echo htmlspecialchars($siteUrl); ?>/rss.php?lang=ru">
    <link rel="alternate" type="application/rss+xml" title="<?php echo htmlspecialchars(t('site.name')); ?> - RSS Feed (EN)" href="<?php echo htmlspecialchars($siteUrl); ?>/rss.php?lang=en">
    <link rel="alternate" type="application/atom+xml" title="<?php echo htmlspecialchars(t('site.name')); ?> - Atom Feed" href="<?php echo htmlspecialchars($siteUrl); ?>/rss.php?lang=<?php echo $currentLang; ?>">
    
    <!-- Дополнительные мета-теги -->
    <meta name="theme-color" content="#0A0A0F">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="<?php echo htmlspecialchars(t('site.name')); ?>">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="msapplication-TileColor" content="#8B5CF6">
    <meta name="msapplication-config" content="/browserconfig.xml">
    
    <!-- Prefetch для улучшения производительности -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.google-analytics.com">
    
    <!-- Preconnect для критических ресурсов -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="overflow-x-hidden" style="background-color: var(--color-bg); color: var(--color-text);">
    <!-- Skip to content link for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[100] focus:px-4 focus:py-2 focus:bg-neon-purple focus:text-white focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2"><?php echo htmlspecialchars(t('nav.skipToContent') ?? 'Skip to content'); ?></a>
    
    <!-- Индикатор прогресса прокрутки -->
    <div class="scroll-progress-bar fixed top-0 left-0 h-1 bg-gradient-to-r from-neon-purple to-neon-blue z-50" style="width: 0%; transition: width 0.1s ease-out;"></div>
    
    <!-- Навигация - стиль holymedia.kz с постоянной анимацией -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="mainNavbar" role="navigation" aria-label="<?php echo htmlspecialchars(t('nav.main')); ?>" style="padding-top: env(safe-area-inset-top); background-color: var(--color-bg); border-bottom: 1px solid var(--color-border);">
        <!-- Постоянная анимация фона -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full opacity-30 animate-gradient-bg" style="background: linear-gradient(90deg, var(--color-neon-purple), var(--color-neon-blue), var(--color-neon-purple)); background-size: 200% 100%; animation: gradient-shift 8s ease infinite;"></div>
            <div class="absolute top-0 left-1/4 w-64 h-64 rounded-full blur-3xl opacity-20 animate-float" style="background: radial-gradient(circle, var(--color-neon-purple), transparent); animation: float 6s ease-in-out infinite;"></div>
            <div class="absolute top-0 right-1/4 w-64 h-64 rounded-full blur-3xl opacity-20 animate-float" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation: float 8s ease-in-out infinite reverse;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-5 md:px-6 lg:px-8 relative z-10">
            <div class="flex items-center justify-between h-16 sm:h-18 md:h-20 gap-2 sm:gap-3">
                <!-- Название сайта без логотипа -->
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="text-lg sm:text-xl md:text-2xl font-bold group touch-manipulation flex-shrink-0 active:scale-95 transition-transform duration-200" aria-label="<?php echo htmlspecialchars(t('nav.home') . ' - ' . t('site.name')); ?>" aria-current="<?php echo basename($_SERVER['PHP_SELF'], '.php') == 'index' ? 'page' : 'false'; ?>" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('site.name')); ?>
                </a>
                
                <!-- Меню для десктопа -->
                <div class="hidden md:flex items-center space-x-4 lg:space-x-6" role="menubar">
                    <?php 
                    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                    $currentPath = getCurrentPath();
                    ?>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="nav-link px-3 py-2 text-base font-medium transition-colors duration-300 hover:underline <?php echo $currentPage == 'index' ? 'font-semibold' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>" style="color: var(--color-text);"><?php echo htmlspecialchars(t('nav.home')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="nav-link px-3 py-2 text-base font-medium transition-colors duration-300 hover:underline <?php echo $currentPage == 'services' ? 'font-semibold' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>" style="color: var(--color-text);"><?php echo htmlspecialchars(t('nav.services')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="nav-link px-3 py-2 text-base font-medium transition-colors duration-300 hover:underline <?php echo $currentPage == 'seo' ? 'font-semibold' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>" style="color: var(--color-text);"><?php echo htmlspecialchars(t('nav.seo')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="nav-link px-3 py-2 text-base font-medium transition-colors duration-300 hover:underline <?php echo $currentPage == 'ads' ? 'font-semibold' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>" style="color: var(--color-text);"><?php echo htmlspecialchars(t('nav.ads')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="nav-link px-3 py-2 text-base font-medium transition-colors duration-300 hover:underline <?php echo $currentPage == 'about' ? 'font-semibold' : ''; ?>" role="menuitem" aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>" style="color: var(--color-text);"><?php echo htmlspecialchars(t('nav.about')); ?></a>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="relative inline-flex items-center justify-center px-6 py-2.5 text-base font-semibold rounded-lg transition-all duration-300 hover:scale-105 active:scale-95" role="menuitem" style="background-color: var(--color-text); color: var(--color-bg);">
                        <span class="relative z-10"><?php echo htmlspecialchars(t('nav.contact')); ?></span>
                    </a>
                    
                    <!-- Переключатель темы -->
                    <button id="themeToggle" class="relative w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none" aria-label="Переключить тему" title="Переключить тему" style="background-color: var(--color-surface); border: 1px solid var(--color-border); color: var(--color-text);">
                        <svg id="themeIconLight" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="themeIconDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    <!-- Переключатель языка -->
                    <div class="flex items-center space-x-1 rounded-lg p-1" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>" style="background-color: var(--color-surface); border: 1px solid var(--color-border);">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center focus:outline-none <?php echo $currentLang === 'ru' ? 'font-semibold' : ''; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>" style="color: var(--color-text);">
                            <span class="relative z-10">RU</span>
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center focus:outline-none <?php echo $currentLang === 'en' ? 'font-semibold' : ''; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>" style="color: var(--color-text);">
                            <span class="relative z-10">EN</span>
                        </a>
                    </div>

                    <!-- Аккаунт - минималистичный стиль -->
                    <div class="relative">
                        <?php
                        if (!function_exists('getInitials')) {
                            function getInitials(string $name): string {
                                $name = trim($name);
                                if (empty($name)) {
                                    return '';
                                }
                                $words = explode(' ', $name);
                                if (count($words) >= 2) {
                                    return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                                }
                                return strtoupper(substr($name, 0, 2));
                            }
                        }
                        $userName = $currentUser && isset($currentUser['name']) ? trim($currentUser['name']) : '';
                        // Получаем аватар: проверяем наличие и валидность URL
                        $userAvatar = null;
                        if ($currentUser) {
                            // Проверяем avatar_url напрямую из массива
                            $avatarUrl = $currentUser['avatar_url'] ?? null;
                            if ($avatarUrl) {
                                $avatarUrl = trim($avatarUrl);
                                // Очень мягкая проверка - если не пустая строка и длиннее 5 символов, считаем валидным
                                if (!empty($avatarUrl) && strlen($avatarUrl) > 5) {
                                    // Если начинается с http или https - используем как есть
                                    if (strpos($avatarUrl, 'http://') === 0 || strpos($avatarUrl, 'https://') === 0) {
                                        $userAvatar = $avatarUrl;
                                    } elseif (strpos($avatarUrl, '//') === 0) {
                                        // Если начинается с //, добавляем https:
                                        $userAvatar = 'https:' . $avatarUrl;
                                    } elseif (strpos($avatarUrl, '.') !== false) {
                                        // Если содержит точку (вероятно домен), добавляем https://
                                        $userAvatar = 'https://' . ltrim($avatarUrl, '/');
                                    } else {
                                        // В остальных случаях просто используем как есть
                                        $userAvatar = $avatarUrl;
                                    }
                                }
                            }
                        }
                        $userInitials = $userName ? getInitials($userName) : '';
                        ?>
                        <button id="accountMenuBtn" class="relative w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none overflow-hidden group" aria-expanded="false" aria-haspopup="true" aria-label="<?php echo $userName ? htmlspecialchars($userName) : 'Аккаунт'; ?>" style="background-color: var(--color-surface); border: 1px solid var(--color-border); color: var(--color-text);">
                            <?php if ($userAvatar): ?>
                                <img src="<?php echo htmlspecialchars($userAvatar); ?>" alt="<?php echo htmlspecialchars($userName); ?>" class="w-full h-full object-cover rounded-full" id="userAvatarImg" loading="lazy" onerror="this.style.display='none'; const fallback = document.getElementById('userAvatarFallback'); if(fallback) fallback.style.display='flex';">
                                <span id="userAvatarFallback" class="absolute inset-0 flex items-center justify-center text-xs font-bold leading-none hidden z-10"><?php echo $userInitials ? htmlspecialchars($userInitials) : ''; ?></span>
                            <?php elseif ($userInitials): ?>
                                <span class="relative z-10 text-xs font-bold leading-none"><?php echo htmlspecialchars($userInitials); ?></span>
                            <?php else: ?>
                                <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            <?php endif; ?>
                        </button>
                        <div id="accountMenu" class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl opacity-0 pointer-events-none transition-all duration-200 z-50 hidden transform translate-y-2" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                            <div class="py-2">
                                <?php if ($currentUser): ?>
                                    <div class="px-4 py-3 border-b" style="border-color: var(--color-border);">
                                        <p class="text-sm font-semibold truncate" style="color: var(--color-text);"><?php echo htmlspecialchars($currentUser['name']); ?></p>
                                        <p class="text-xs truncate mt-0.5" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars($currentUser['email']); ?></p>
                                    </div>
                                    <?php if (!$isRootAdmin): ?>
                                        <a href="/dashboard.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors hover:underline" style="color: var(--color-text);">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>Личный кабинет</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($isRootAdmin): ?>
                                        <a href="/adm/" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors hover:underline" style="color: var(--color-text);">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>Админ-панель</span>
                                        </a>
                                    <?php endif; ?>
                                    <div class="border-t my-1" style="border-color: var(--color-border);"></div>
                                    <a href="/logout.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors hover:underline" style="color: var(--color-text);">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Выйти</span>
                                    </a>
                                <?php else: ?>
                                    <a href="/login.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors hover:underline" style="color: var(--color-text);">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Вход</span>
                                    </a>
                                    <a href="/register.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors hover:underline" style="color: var(--color-text);">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                        <span>Регистрация</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Кнопка бургер-меню -->
                <div class="flex items-center flex-shrink-0 md:hidden">
                    <button class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 min-w-[44px] min-h-[44px] touch-manipulation flex-shrink-0 active:scale-95 focus:outline-none relative" id="burgerBtn" aria-label="Меню" aria-expanded="false" aria-controls="burgerMenu" type="button" style="background-color: var(--color-surface); border: 1px solid var(--color-border); color: var(--color-text);">
                        <svg id="burgerIcon" class="w-5 h-5 absolute transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="burgerCloseIcon" class="w-5 h-5 absolute transition-all duration-300 opacity-0 rotate-90 scale-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Overlay для бургер-меню -->
    <div id="burgerOverlay" class="fixed inset-0 opacity-0 transition-opacity duration-300 z-[9998]" style="display: none; background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(2px); -webkit-backdrop-filter: blur(2px);"></div>
    
    <!-- Боковое меню справа в стиле holymedia.kz -->
    <div id="burgerMenu" class="fixed top-0 right-0 bottom-0 overflow-y-auto z-[9999]" role="dialog" aria-modal="true" aria-labelledby="burgerMenuTitle" style="display: none; width: 85vw; max-width: 400px; background-color: var(--color-bg); border-left: 1px solid var(--color-border); transform: translateX(100%); opacity: 0; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease-out; padding-top: env(safe-area-inset-top);">
        <div class="flex flex-col h-full px-6 py-8" style="padding-top: max(2rem, calc(env(safe-area-inset-top, 0px) + 2rem)); padding-bottom: max(2rem, calc(env(safe-area-inset-bottom, 0px) + 2rem));">
            <!-- Верхняя панель -->
            <div class="flex items-center justify-between mb-8 flex-shrink-0">
                <span class="text-xl font-bold" style="color: var(--color-text);"><?php echo htmlspecialchars(t('site.name')); ?></span>
                <button id="burgerCloseBtn" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95 touch-manipulation" style="background-color: var(--color-surface); border: 1px solid var(--color-border); color: var(--color-text);" aria-label="Закрыть меню">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Контент меню -->
            <div class="flex-1 flex flex-col">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                ?>
                
                <!-- Навигационные ссылки - минималистичные как на holymedia.kz -->
                <nav role="navigation" aria-label="Основная навигация" class="space-y-1 mb-8">
                    <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="mobile-menu-item block px-4 py-3 text-lg font-medium transition-all duration-200 hover:opacity-70 active:opacity-50 <?php echo $currentPage == 'index' ? 'font-semibold' : ''; ?>" aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('nav.home')); ?>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="mobile-menu-item block px-4 py-3 text-lg font-medium transition-all duration-200 hover:opacity-70 active:opacity-50 <?php echo $currentPage == 'services' ? 'font-semibold' : ''; ?>" aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('nav.services')); ?>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="mobile-menu-item block px-4 py-3 text-lg font-medium transition-all duration-200 hover:opacity-70 active:opacity-50 <?php echo $currentPage == 'seo' ? 'font-semibold' : ''; ?>" aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('nav.seo')); ?>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="mobile-menu-item block px-4 py-3 text-lg font-medium transition-all duration-200 hover:opacity-70 active:opacity-50 <?php echo $currentPage == 'ads' ? 'font-semibold' : ''; ?>" aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('nav.ads')); ?>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="mobile-menu-item block px-4 py-3 text-lg font-medium transition-all duration-200 hover:opacity-70 active:opacity-50 <?php echo $currentPage == 'about' ? 'font-semibold' : ''; ?>" aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('nav.about')); ?>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="mobile-menu-item block px-6 py-3 mt-4 text-lg font-semibold rounded-lg transition-all duration-200 active:scale-95" aria-current="<?php echo $currentPage == 'contact' ? 'page' : 'false'; ?>" style="background-color: var(--color-text); color: var(--color-bg);">
                        <?php echo htmlspecialchars(t('nav.contact')); ?>
                    </a>
                </nav>
                
                <!-- Дополнительные ссылки -->
                <?php if ($currentUser): ?>
                    <div class="mt-6 pt-6 border-t space-y-1" style="border-color: var(--color-border);">
                        <?php if (!$isRootAdmin): ?>
                            <a href="/dashboard.php" class="mobile-menu-item block px-4 py-3 text-base font-medium transition-all duration-200 hover:opacity-70 active:opacity-50" style="color: var(--color-text-secondary);">
                                Личный кабинет
                            </a>
                        <?php endif; ?>
                        <?php if ($isRootAdmin): ?>
                            <a href="/adm/" class="mobile-menu-item block px-4 py-3 text-base font-medium transition-all duration-200 hover:opacity-70 active:opacity-50" style="color: var(--color-text-secondary);">
                                Админ-панель
                            </a>
                        <?php endif; ?>
                        <a href="/logout.php" class="mobile-menu-item block px-4 py-3 text-base font-medium transition-all duration-200 hover:opacity-70 active:opacity-50" style="color: var(--color-text-secondary);">
                            Выйти
                        </a>
                    </div>
                <?php else: ?>
                    <div class="mt-6 pt-6 border-t space-y-1" style="border-color: var(--color-border);">
                        <a href="/login.php" class="mobile-menu-item block px-4 py-3 text-base font-medium transition-all duration-200 hover:opacity-70 active:opacity-50" style="color: var(--color-text-secondary);">
                            Войти
                        </a>
                        <a href="/register.php" class="mobile-menu-item block px-6 py-3 mt-2 text-base font-semibold rounded-lg transition-all duration-200 active:scale-95" style="background-color: var(--color-text); color: var(--color-bg);">
                            Регистрация
                        </a>
                    </div>
                <?php endif; ?>
                
                <!-- Переключатель темы и языка внизу -->
                <div class="mt-auto pt-6 border-t flex items-center justify-between flex-shrink-0" role="group" aria-label="Настройки" style="border-color: var(--color-border);">
                    <!-- Переключатель темы -->
                    <button id="burgerThemeToggle" class="relative w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 active:scale-95 touch-manipulation" style="background-color: var(--color-surface); border: 1px solid var(--color-border); color: var(--color-text);" aria-label="Переключить тему оформления">
                        <svg id="burgerThemeIconLight" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="burgerThemeIconDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    
                    <!-- Переключатель языка -->
                    <div id="burgerLangGroup" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>" class="flex items-center gap-1 rounded-lg p-1" style="background-color: var(--color-surface); border: 1px solid var(--color-border);">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-200 text-center focus:outline-none <?php echo $currentLang === 'ru' ? 'font-semibold' : ''; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>" style="color: var(--color-text);">
                            RU
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-200 text-center focus:outline-none <?php echo $currentLang === 'en' ? 'font-semibold' : ''; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>" style="color: var(--color-text);">
                            EN
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Скрипт для переключения темы -->
    <script>
        (function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIconLight = document.getElementById('themeIconLight');
            const themeIconDark = document.getElementById('themeIconDark');
            
            function updateThemeIcon() {
                if (!themeIconLight || !themeIconDark) return;
                const isLight = document.documentElement.classList.contains('light');
                if (isLight) {
                    themeIconLight.classList.remove('hidden');
                    themeIconDark.classList.add('hidden');
                } else {
                    themeIconLight.classList.add('hidden');
                    themeIconDark.classList.remove('hidden');
                }
            }
            
            if (themeToggle && window.setTheme) {
                themeToggle.addEventListener('click', function() {
                    const currentTheme = window.getTheme();
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    window.setTheme(newTheme);
                    updateThemeIcon();
                });
                
                // Обновляем иконку при загрузке
                updateThemeIcon();
                
                // Слушаем изменения темы
                const observer = new MutationObserver(updateThemeIcon);
                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            }
        })();
    </script>
    
    <!-- Оптимизированный скрипт для бургер-меню в стиле holymedia.kz -->
    <script>
        (function() {
            'use strict';
            
            const burgerBtn = document.getElementById('burgerBtn');
            const burgerMenu = document.getElementById('burgerMenu');
            const burgerOverlay = document.getElementById('burgerOverlay');
            const burgerCloseBtn = document.getElementById('burgerCloseBtn');
            const burgerThemeToggle = document.getElementById('burgerThemeToggle');
            const burgerThemeIconLight = document.getElementById('burgerThemeIconLight');
            const burgerThemeIconDark = document.getElementById('burgerThemeIconDark');
            const burgerIcon = document.getElementById('burgerIcon');
            const burgerCloseIcon = document.getElementById('burgerCloseIcon');
            
            let isBurgerOpen = false;
            let savedScrollY = 0;
            
            // Функция переключения иконки бургера
            function toggleBurgerIcon(isOpen) {
                if (!burgerIcon || !burgerCloseIcon) return;
                
                if (isOpen) {
                    burgerIcon.style.opacity = '0';
                    burgerIcon.style.transform = 'rotate(-90deg) scale(0)';
                    burgerCloseIcon.style.opacity = '1';
                    burgerCloseIcon.style.transform = 'rotate(0deg) scale(1)';
                } else {
                    burgerIcon.style.opacity = '1';
                    burgerIcon.style.transform = 'rotate(0deg) scale(1)';
                    burgerCloseIcon.style.opacity = '0';
                    burgerCloseIcon.style.transform = 'rotate(90deg) scale(0)';
                }
            }
            
            // Функция открытия меню - боковая панель справа как на holymedia.kz
            function openBurgerMenu() {
                if (!burgerMenu || !burgerOverlay) return;
                
                isBurgerOpen = true;
                savedScrollY = window.scrollY;
                
                // Переключаем иконку
                toggleBurgerIcon(true);
                
                // Блокируем скролл body
                document.body.style.position = 'fixed';
                document.body.style.top = `-${savedScrollY}px`;
                document.body.style.width = '100%';
                document.body.style.overflow = 'hidden';
                document.documentElement.style.overflow = 'hidden';
                
                // Показываем overlay и меню
                burgerOverlay.style.display = 'block';
                burgerMenu.style.display = 'block';
                burgerMenu.setAttribute('aria-hidden', 'false');
                
                // Принудительно применяем начальные стили
                burgerOverlay.style.opacity = '0';
                burgerMenu.style.transform = 'translateX(100%)';
                burgerMenu.style.opacity = '0';
                
                // Небольшая задержка перед анимацией, чтобы браузер успел применить display
                setTimeout(() => {
                    // Анимация появления меню справа
                    requestAnimationFrame(() => {
                        burgerOverlay.style.opacity = '1';
                        burgerMenu.style.transform = 'translateX(0)';
                        burgerMenu.style.opacity = '1';
                    });
                    
                    // Анимация элементов меню с задержкой (оптимизировано для мобильных)
                    const menuItems = burgerMenu.querySelectorAll('.mobile-menu-item');
                    const isMobile = window.innerWidth < 768;
                    const delay = isMobile ? 20 : 30;
                    
                    menuItems.forEach((item, index) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateX(20px)';
                        
                        setTimeout(() => {
                            item.style.transition = 'opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                        }, 50 + (index * delay));
                    });
                }, 20);
                
                // Обновляем aria-expanded
                burgerBtn?.setAttribute('aria-expanded', 'true');
            }
            
            // Функция закрытия меню
            function closeBurgerMenu() {
                if (!burgerMenu || !burgerOverlay) return;
                
                isBurgerOpen = false;
                
                // Переключаем иконку
                toggleBurgerIcon(false);
                
                // Анимация закрытия
                burgerOverlay.style.opacity = '0';
                burgerMenu.style.transform = 'translateX(100%)';
                burgerMenu.style.opacity = '0';
                
                // Восстанавливаем скролл
                setTimeout(() => {
                    document.body.style.position = '';
                    document.body.style.top = '';
                    document.body.style.width = '';
                    document.body.style.overflow = '';
                    document.body.style.height = '';
                    document.documentElement.style.overflow = '';
                    
                    window.scrollTo(0, savedScrollY);
                    
                    burgerOverlay.style.display = 'none';
                    burgerOverlay.style.opacity = '0';
                    burgerMenu.style.display = 'none';
                    burgerMenu.style.transform = 'translateX(100%)';
                    burgerMenu.style.opacity = '0';
                    burgerMenu.setAttribute('aria-hidden', 'true');
                    
                    // Сбрасываем анимации элементов
                    const menuItems = burgerMenu.querySelectorAll('.mobile-menu-item');
                    menuItems.forEach(item => {
                        item.style.opacity = '';
                        item.style.transform = '';
                        item.style.transition = '';
                    });
                }, 300);
                
                burgerBtn?.setAttribute('aria-expanded', 'false');
            }
            
            // Обработчики событий
            if (burgerBtn) {
                burgerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (isBurgerOpen) {
                        closeBurgerMenu();
                    } else {
                        openBurgerMenu();
                    }
                });
            }
            
            if (burgerCloseBtn) {
                burgerCloseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeBurgerMenu();
                });
            }
            
            // Закрытие по клику на overlay
            if (burgerOverlay) {
                burgerOverlay.addEventListener('click', function() {
                    closeBurgerMenu();
                });
            }
            
            // Закрытие по Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isBurgerOpen) {
                    closeBurgerMenu();
                }
            });
            
            // Закрытие при клике на ссылку
            if (burgerMenu) {
                burgerMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        setTimeout(() => closeBurgerMenu(), 100);
                    });
                });
            }
            
            // Переключение темы в бургер-меню
            if (burgerThemeToggle && window.setTheme) {
                function updateBurgerThemeIcon() {
                    if (!burgerThemeIconLight || !burgerThemeIconDark) return;
                    const isLight = document.documentElement.classList.contains('light');
                    if (isLight) {
                        burgerThemeIconLight.classList.remove('hidden');
                        burgerThemeIconDark.classList.add('hidden');
                    } else {
                        burgerThemeIconLight.classList.add('hidden');
                        burgerThemeIconDark.classList.remove('hidden');
                    }
                }
                
                burgerThemeToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const currentTheme = window.getTheme();
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    window.setTheme(newTheme);
                    updateBurgerThemeIcon();
                    
                    if ('vibrate' in navigator) {
                        navigator.vibrate(10);
                    }
                });
                
                updateBurgerThemeIcon();
                
                const observer = new MutationObserver(updateBurgerThemeIcon);
                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            }
            
            // Дропдаун аккаунта
            const accountBtn = document.getElementById('accountMenuBtn');
            const accountMenu = document.getElementById('accountMenu');
            let isAccountOpen = false;
            
            function closeAccountMenu() {
                if (!accountMenu) return;
                isAccountOpen = false;
                accountMenu.style.opacity = '0';
                accountMenu.style.transform = 'translateY(-8px)';
                accountMenu.style.pointerEvents = 'none';
                setTimeout(() => {
                    accountMenu.classList.add('hidden');
                }, 200);
                accountBtn?.setAttribute('aria-expanded', 'false');
            }
            
            function openAccountMenu() {
                if (!accountMenu) return;
                isAccountOpen = true;
                accountMenu.classList.remove('hidden');
                accountMenu.style.transform = 'translateY(0)';
                setTimeout(() => {
                    accountMenu.style.opacity = '1';
                    accountMenu.style.pointerEvents = 'auto';
                }, 10);
                accountBtn?.setAttribute('aria-expanded', 'true');
            }
            
            if (accountBtn && accountMenu) {
                accountBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (isAccountOpen) {
                        closeAccountMenu();
                    } else {
                        openAccountMenu();
                    }
                });
                
                accountMenu.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
                
                document.addEventListener('click', () => {
                    if (isAccountOpen) {
                        closeAccountMenu();
                    }
                });
            }
        })();
    </script>
    
    <!-- Breadcrumbs -->
    <?php 
    // Показываем breadcrumbs на всех страницах кроме главной
    if (basename($_SERVER['PHP_SELF'], '.php') !== 'index') {
        include __DIR__ . '/breadcrumbs.php';
    }
    ?>

