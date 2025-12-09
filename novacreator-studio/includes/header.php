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
    <link rel="preload" as="image" type="image/svg+xml" href="/assets/img/logo.svg">
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
                    
                    <!-- Переключатель темы -->
                    <button id="themeToggle" class="relative w-10 h-10 rounded-lg bg-dark-surface/50 border border-dark-border flex items-center justify-center text-gray-300 hover:text-neon-purple hover:border-neon-purple/50 transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg" aria-label="Переключить тему" title="Переключить тему">
                        <svg id="themeIconLight" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="themeIconDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    <!-- Переключатель языка -->
                    <div class="flex items-center space-x-1 ml-3 pl-3 border-l border-dark-border bg-dark-surface/50 rounded-lg p-1" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                        <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                            <span class="relative z-10">RU</span>
                        </a>
                        <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-300 min-w-[40px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/30' : 'text-gray-400 hover:text-gray-300 hover:bg-dark-bg/50'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                            <span class="relative z-10">EN</span>
                        </a>
                    </div>

                    <!-- Аккаунт (кнопка в стиле Xbox) -->
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
                        <button id="accountMenuBtn" class="relative w-10 h-10 rounded-full bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-white text-sm font-semibold shadow-lg shadow-neon-purple/30 hover:shadow-xl hover:shadow-neon-purple/50 transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg overflow-hidden group" aria-expanded="false" aria-haspopup="true" aria-label="<?php echo $userName ? htmlspecialchars($userName) : 'Аккаунт'; ?>">
                            <?php if ($userAvatar): ?>
                                <img src="<?php echo htmlspecialchars($userAvatar); ?>" alt="<?php echo htmlspecialchars($userName); ?>" class="w-full h-full object-cover rounded-full" id="userAvatarImg" loading="lazy" onerror="this.style.display='none'; const fallback = document.getElementById('userAvatarFallback'); if(fallback) fallback.style.display='flex';">
                                <span id="userAvatarFallback" class="absolute inset-0 flex items-center justify-center text-xs font-bold leading-none hidden z-10"><?php echo $userInitials ? htmlspecialchars($userInitials) : ''; ?></span>
                            <?php elseif ($userInitials): ?>
                                <span class="relative z-10 text-xs font-bold leading-none"><?php echo htmlspecialchars($userInitials); ?></span>
                            <?php else: ?>
                                <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-r from-neon-purple/0 to-neon-blue/0 group-hover:from-neon-purple/20 group-hover:to-neon-blue/20 transition-all duration-300 rounded-full"></div>
                        </button>
                        <div id="accountMenu" class="absolute right-0 mt-3 w-56 bg-dark-bg/98 backdrop-blur-3xl border border-dark-border/60 rounded-2xl shadow-2xl opacity-0 pointer-events-none transition-all duration-200 z-50 hidden transform translate-y-2" style="backdrop-filter: blur(40px) saturate(200%); -webkit-backdrop-filter: blur(40px) saturate(200%); background-color: rgba(10, 10, 15, 0.98);">
                            <div class="py-2">
                                <?php if ($currentUser): ?>
                                    <div class="px-4 py-3 border-b border-dark-border/40 bg-dark-surface/30">
                                        <p class="text-sm font-semibold text-white truncate drop-shadow-sm"><?php echo htmlspecialchars($currentUser['name']); ?></p>
                                        <p class="text-xs text-gray-200 truncate mt-0.5 drop-shadow-sm"><?php echo htmlspecialchars($currentUser['email']); ?></p>
                                    </div>
                                    <?php if (!$isRootAdmin): ?>
                                        <a href="/dashboard.php" class="flex items-center gap-3 px-4 py-3 text-sm text-white hover:text-neon-purple hover:bg-dark-surface/60 transition-colors group">
                                            <svg class="w-5 h-5 text-gray-200 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span class="drop-shadow-sm">Личный кабинет</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($isRootAdmin): ?>
                                        <a href="/adm/" class="flex items-center gap-3 px-4 py-3 text-sm text-neon-purple hover:text-neon-blue hover:bg-dark-surface/60 transition-colors group">
                                            <svg class="w-5 h-5 text-neon-purple group-hover:text-neon-blue transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="drop-shadow-sm">Админ-панель</span>
                                        </a>
                                    <?php endif; ?>
                                    <div class="border-t border-dark-border/40 my-1"></div>
                                    <a href="/logout.php" class="flex items-center gap-3 px-4 py-3 text-sm text-white hover:text-red-400 hover:bg-dark-surface/60 transition-colors group">
                                        <svg class="w-5 h-5 text-gray-200 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="drop-shadow-sm">Выйти</span>
                                    </a>
                                <?php else: ?>
                                    <a href="/login.php" class="flex items-center gap-3 px-4 py-3 text-sm text-white hover:text-neon-purple hover:bg-dark-surface/60 transition-colors group">
                                        <svg class="w-5 h-5 text-gray-200 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="drop-shadow-sm">Вход</span>
                                    </a>
                                    <a href="/register.php" class="flex items-center gap-3 px-4 py-3 text-sm text-white hover:text-neon-purple hover:bg-dark-surface/60 transition-colors group">
                                        <svg class="w-5 h-5 text-gray-200 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                        <span class="drop-shadow-sm">Регистрация</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Кнопка бургер-меню -->
                <div class="flex items-center flex-shrink-0">
                    <button class="md:hidden text-gray-300 hover:text-neon-purple active:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-lg transition-all duration-200 p-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation flex-shrink-0 hover:bg-dark-surface/50 active:bg-dark-surface/70 active:scale-95" id="burgerBtn" aria-label="Меню" aria-expanded="false" aria-controls="burgerMenu" type="button">
                        <svg id="burgerIcon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="burgerCloseIcon" class="w-6 h-6 transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Новое полноэкранное бургер-меню -->
    <div id="burgerOverlay" class="fixed inset-0 hidden opacity-0 transition-opacity duration-300" style="background: rgba(0, 0, 0, 0.55); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); z-index: 9998; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important;"></div>
    
    <div id="burgerMenu" class="fixed inset-y-0 right-0 hidden overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="burgerMenuTitle" aria-describedby="burgerMenuDescription" aria-hidden="true" style="background-color: var(--color-surface); width: 80vw !important; max-width: 420px !important; height: 100vh !important; position: fixed !important; top: 0 !important; right: 0 !important; bottom: 0 !important; z-index: 9999 !important;">
        <style>
            #burgerMenu::-webkit-scrollbar {
                width: 6px;
            }
            #burgerMenu::-webkit-scrollbar-track {
                background: var(--color-bg);
            }
            #burgerMenu::-webkit-scrollbar-thumb {
                background: var(--color-neon-purple);
                border-radius: 3px;
            }
            #burgerMenu::-webkit-scrollbar-thumb:hover {
                background: var(--color-neon-blue);
            }
        </style>
        <div class="min-h-screen flex flex-col px-4 sm:px-6 py-6 sm:py-8" style="padding-top: max(1rem, env(safe-area-inset-top, 1rem)); padding-bottom: max(1rem, env(safe-area-inset-bottom, 1rem));">
            <!-- Верхняя панель только с кнопкой закрытия -->
            <div class="flex items-center justify-end mb-4 flex-shrink-0">
                <button id="burgerCloseBtn" class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95 touch-manipulation group relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(6, 182, 212, 0.15)); border: 2px solid rgba(139, 92, 246, 0.4);" aria-label="Закрыть">
                    <svg class="w-7 h-7 relative z-10 transition-all duration-300 group-hover:rotate-90 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--color-neon-purple); filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.6));">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple/30 to-neon-blue/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple to-neon-blue opacity-0 group-active:opacity-20 transition-opacity duration-200 rounded-2xl"></div>
                </button>
            </div>
                
                <!-- Контент меню -->
                <div class="flex-1 flex flex-col space-y-6 w-full max-w-lg mx-auto">
                <?php 
                $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                ?>
                
                <!-- Навигационные ссылки -->
                <nav role="navigation" aria-label="Основная навигация" class="space-y-3">
                    <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="mobile-menu-item group flex items-center justify-between p-4 rounded-2xl transition-all duration-200 <?php echo $currentPage == 'index' ? 'bg-white/5 border-neon-purple/50' : 'bg-white/5 border-transparent hover:bg-white/10'; ?>" style="border-width: 1px;" aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>">
                        <span class="text-xl font-semibold <?php echo $currentPage == 'index' ? 'text-neon-purple' : 'text-gray-200'; ?>"><?php echo htmlspecialchars(t('nav.home')); ?></span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo $currentPage == 'index' ? 'bg-neon-purple/20 text-neon-purple' : 'bg-white/10 text-gray-400 group-hover:text-white'; ?>">
                            <svg class="w-5 h-5 arrow-icon transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>" class="mobile-menu-item group flex items-center justify-between p-4 rounded-2xl transition-all duration-200 <?php echo $currentPage == 'services' ? 'bg-white/5 border-neon-purple/50' : 'bg-white/5 border-transparent hover:bg-white/10'; ?>" style="border-width: 1px;" aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>">
                        <span class="text-xl font-semibold <?php echo $currentPage == 'services' ? 'text-neon-purple' : 'text-gray-200'; ?>"><?php echo htmlspecialchars(t('nav.services')); ?></span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo $currentPage == 'services' ? 'bg-neon-purple/20 text-neon-purple' : 'bg-white/10 text-gray-400 group-hover:text-white'; ?>">
                            <svg class="w-5 h-5 arrow-icon transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="mobile-menu-item group flex items-center justify-between p-4 rounded-2xl transition-all duration-200 <?php echo $currentPage == 'seo' ? 'bg-white/5 border-neon-purple/50' : 'bg-white/5 border-transparent hover:bg-white/10'; ?>" style="border-width: 1px;" aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>">
                        <span class="text-xl font-semibold <?php echo $currentPage == 'seo' ? 'text-neon-purple' : 'text-gray-200'; ?>"><?php echo htmlspecialchars(t('nav.seo')); ?></span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo $currentPage == 'seo' ? 'bg-neon-purple/20 text-neon-purple' : 'bg-white/10 text-gray-400 group-hover:text-white'; ?>">
                            <svg class="w-5 h-5 arrow-icon transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="mobile-menu-item group flex items-center justify-between p-4 rounded-2xl transition-all duration-200 <?php echo $currentPage == 'ads' ? 'bg-white/5 border-neon-purple/50' : 'bg-white/5 border-transparent hover:bg-white/10'; ?>" style="border-width: 1px;" aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>">
                        <span class="text-xl font-semibold <?php echo $currentPage == 'ads' ? 'text-neon-purple' : 'text-gray-200'; ?>"><?php echo htmlspecialchars(t('nav.ads')); ?></span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo $currentPage == 'ads' ? 'bg-neon-purple/20 text-neon-purple' : 'bg-white/10 text-gray-400 group-hover:text-white'; ?>">
                            <svg class="w-5 h-5 arrow-icon transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>" class="mobile-menu-item group flex items-center justify-between p-4 rounded-2xl transition-all duration-200 <?php echo $currentPage == 'about' ? 'bg-white/5 border-neon-purple/50' : 'bg-white/5 border-transparent hover:bg-white/10'; ?>" style="border-width: 1px;" aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>">
                        <span class="text-xl font-semibold <?php echo $currentPage == 'about' ? 'text-neon-purple' : 'text-gray-200'; ?>"><?php echo htmlspecialchars(t('nav.about')); ?></span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo $currentPage == 'about' ? 'bg-neon-purple/20 text-neon-purple' : 'bg-white/10 text-gray-400 group-hover:text-white'; ?>">
                            <svg class="w-5 h-5 arrow-icon transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                    
                    <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="mobile-menu-item group flex items-center justify-between p-4 rounded-2xl transition-all duration-200 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 hover:border-neon-purple/60" aria-current="<?php echo $currentPage == 'contact' ? 'page' : 'false'; ?>">
                        <span class="text-xl font-semibold text-white"><?php echo htmlspecialchars(t('nav.contact')); ?></span>
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-white shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    </a>
                </nav>
                
                <!-- Аккаунт в мобильном меню -->
                <?php if ($currentUser): ?>
                    <div class="space-y-2 mb-6">
                        <?php if (!$isRootAdmin): ?>
                        <a href="/dashboard.php" class="mobile-menu-item block w-full px-6 py-3 text-base font-semibold rounded-xl transition-all duration-200 active:scale-[0.98] min-h-[52px] flex items-center" style="color: var(--color-text); background-color: var(--color-surface); border: 1px solid var(--color-border);" onmouseover="this.style.backgroundColor='var(--color-surface-lighter)';" onmouseout="this.style.backgroundColor='var(--color-surface)';">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Личный кабинет
                        </a>
                        <?php endif; ?>
                        <?php if ($isRootAdmin): ?>
                            <a href="/adm/" class="mobile-menu-item block w-full px-6 py-3 text-base font-semibold rounded-xl transition-all duration-200 active:scale-[0.98] min-h-[52px] flex items-center" style="color: var(--color-neon-purple); background-color: var(--color-surface); border: 1px solid var(--color-neon-purple);" onmouseover="this.style.backgroundColor='var(--color-surface-lighter)';" onmouseout="this.style.backgroundColor='var(--color-surface)';">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Админка
                            </a>
                        <?php endif; ?>
                        <a href="/logout.php" class="mobile-menu-item block w-full px-6 py-3 text-base font-semibold rounded-xl transition-all duration-200 active:scale-[0.98] min-h-[52px] flex items-center" style="color: var(--color-text); background-color: var(--color-surface); border: 1px solid var(--color-border);" onmouseover="this.style.color='#EF4444'; this.style.borderColor='#EF4444';" onmouseout="this.style.color='var(--color-text)'; this.style.borderColor='var(--color-border)';">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Выйти
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-2 mb-6">
                        <a href="/login.php" class="mobile-menu-item block w-full px-6 py-3 text-base font-semibold rounded-xl transition-all duration-200 active:scale-[0.98] min-h-[52px] flex items-center" style="color: var(--color-text); background-color: var(--color-surface); border: 1px solid var(--color-border);" onmouseover="this.style.backgroundColor='var(--color-surface-lighter)';" onmouseout="this.style.backgroundColor='var(--color-surface)';">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Войти
                        </a>
                        <a href="/register.php" class="mobile-menu-item block w-full px-6 py-3 text-base font-semibold rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 transition-all duration-200 shadow-lg hover:shadow-xl active:scale-[0.98] min-h-[52px] flex items-center justify-center text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Регистрация
                        </a>
                    </div>
                <?php endif; ?>
                
                <!-- Переключатель темы и языка в мобильном меню -->
                <div class="mt-4 pt-4 border-t flex-shrink-0 pb-safe" role="group" aria-label="Настройки" style="border-color: var(--color-border); padding-bottom: max(1rem, env(safe-area-inset-bottom, 1rem));">
                    <!-- Переключатель темы без текста -->
                    <div class="mb-4">
                        <button id="burgerThemeToggle" class="relative w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-200 active:scale-[0.98] touch-manipulation group mx-auto" style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);" aria-label="Переключить тему оформления">
                            <svg id="burgerThemeIconLight" class="w-5 h-5 hidden text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <svg id="burgerThemeIconDark" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Переключатель языка без текста -->
                    <div id="burgerLangGroup" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>" class="lang-group">
                        <div class="flex items-center gap-3 p-1.5 justify-center">
                            <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="lang-item flex-1 relative overflow-hidden group px-4 py-3 text-base font-bold rounded-xl transition-all duration-300 text-center focus:outline-none touch-manipulation <?php echo $currentLang === 'ru' ? 'text-white shadow-lg shadow-neon-purple/30' : 'text-gray-400 hover:text-white bg-white/5 border border-white/5 hover:bg-white/10'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                                <?php if ($currentLang === 'ru'): ?>
                                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple to-neon-blue opacity-100 transition-opacity duration-300"></div>
                                <?php endif; ?>
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <span class="uppercase">RU</span>
                                    <?php if ($currentLang === 'ru'): ?>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <?php endif; ?>
                                </span>
                            </a>
                            <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="lang-item flex-1 relative overflow-hidden group px-4 py-3 text-base font-bold rounded-xl transition-all duration-300 text-center focus:outline-none touch-manipulation <?php echo $currentLang === 'en' ? 'text-white shadow-lg shadow-neon-purple/30' : 'text-gray-400 hover:text-white bg-white/5 border border-white/5 hover:bg-white/10'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                                <?php if ($currentLang === 'en'): ?>
                                    <div class="absolute inset-0 bg-gradient-to-r from-neon-purple to-neon-blue opacity-100 transition-opacity duration-300"></div>
                                <?php endif; ?>
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <span class="uppercase">EN</span>
                                    <?php if ($currentLang === 'en'): ?>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </div>
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
    
    <!-- Новый скрипт для бургер-меню -->
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
            
            let isBurgerOpen = false;
            
            // Функция открытия меню
            function openBurgerMenu() {
                if (!burgerMenu || !burgerOverlay) return;
                
                isBurgerOpen = true;
                
                // Блокируем скролл body
                const scrollY = window.scrollY;
                document.body.style.position = 'fixed';
                document.body.style.top = `-${scrollY}px`;
                document.body.style.width = '100%';
                document.body.style.overflow = 'hidden';
                document.body.style.height = '100vh';
                document.documentElement.style.overflow = 'hidden';
                
                // Скрываем navbar
                const navbar = document.getElementById('mainNavbar');
                if (navbar) {
                    navbar.style.display = 'none';
                }
                
                // Скрываем весь контент кроме меню
                const mainContent = document.querySelector('main, .container, section, .content');
                if (mainContent) {
                    mainContent.style.visibility = 'hidden';
                    mainContent.style.pointerEvents = 'none';
                }
                
                // Показываем overlay и меню
                burgerOverlay.classList.remove('hidden');
                burgerMenu.classList.remove('hidden');
                
                // Анимация элементов меню
                const menuItems = burgerMenu.querySelectorAll('.mobile-menu-item, button, .flex-1 > div');
                menuItems.forEach((item, index) => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    item.style.transition = 'all 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                    
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 50 + (index * 30));
                });
                
                // Принудительно устанавливаем стили
                burgerOverlay.style.display = 'block';
                burgerMenu.style.display = 'block';
                burgerOverlay.style.zIndex = '9998';
                burgerMenu.style.zIndex = '9999';
                burgerOverlay.style.position = 'fixed';
                burgerMenu.style.position = 'fixed';
                
                const langGroup = document.getElementById('burgerLangGroup');
                if (langGroup) {
                    setTimeout(() => langGroup.classList.add('lang-show'), 80);
                }

                setTimeout(() => {
                    burgerOverlay.style.opacity = '1';
                }, 10);
            }
            
            // Функция закрытия меню
            function closeBurgerMenu() {
                if (!burgerMenu || !burgerOverlay) return;
                
                isBurgerOpen = false;
                
                // Восстанавливаем скролл
                const scrollY = document.body.style.top;
                document.body.style.position = '';
                document.body.style.top = '';
                document.body.style.width = '';
                document.body.style.overflow = '';
                document.body.style.height = '';
                document.documentElement.style.overflow = '';
                
                if (scrollY) {
                    window.scrollTo(0, parseInt(scrollY || '0') * -1);
                }
                
                // Показываем navbar
                const navbar = document.getElementById('mainNavbar');
                if (navbar) {
                    navbar.style.display = '';
                }
                
                // Показываем контент обратно
                const mainContent = document.querySelector('main, .container, section, .content');
                if (mainContent) {
                    mainContent.style.visibility = '';
                    mainContent.style.pointerEvents = '';
                }
                const langGroup = document.getElementById('burgerLangGroup');
                if (langGroup) {
                    langGroup.classList.remove('lang-show');
                }
                
                // Скрываем overlay и меню
                burgerOverlay.style.opacity = '0';
                
                setTimeout(() => {
                    burgerMenu.classList.add('hidden');
                    burgerOverlay.classList.add('hidden');
                    burgerOverlay.style.display = '';
                    burgerMenu.style.display = '';
                }, 300);
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
                        closeBurgerMenu();
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
                    
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
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

