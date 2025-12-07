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
<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>" itemscope itemtype="https://schema.org/WebSite">
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
                        <div id="accountMenu" class="absolute right-0 mt-3 w-56 bg-dark-surface/95 backdrop-blur-2xl border border-dark-border/80 rounded-2xl shadow-2xl opacity-0 pointer-events-none transition-all duration-200 z-50 hidden transform translate-y-2" style="backdrop-filter: blur(24px) saturate(180%); -webkit-backdrop-filter: blur(24px) saturate(180%);">
                            <div class="py-2">
                                <?php if ($currentUser): ?>
                                    <div class="px-4 py-3 border-b border-dark-border/50">
                                        <p class="text-sm font-semibold text-white truncate"><?php echo htmlspecialchars($currentUser['name']); ?></p>
                                        <p class="text-xs text-gray-300 truncate mt-0.5"><?php echo htmlspecialchars($currentUser['email']); ?></p>
                                    </div>
                                    <?php if (!$isRootAdmin): ?>
                                        <a href="/dashboard.php" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-200 hover:text-neon-purple hover:bg-dark-bg/50 transition-colors group">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>Личный кабинет</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($isRootAdmin): ?>
                                        <a href="/adm/" class="flex items-center gap-3 px-4 py-3 text-sm text-neon-purple hover:text-neon-blue hover:bg-dark-bg/50 transition-colors group">
                                            <svg class="w-5 h-5 text-neon-purple group-hover:text-neon-blue transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>Админ-панель</span>
                                        </a>
                                    <?php endif; ?>
                                    <div class="border-t border-dark-border/50 my-1"></div>
                                    <a href="/logout.php" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-200 hover:text-red-400 hover:bg-dark-bg/50 transition-colors group">
                                        <svg class="w-5 h-5 text-gray-300 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Выйти</span>
                                    </a>
                                <?php else: ?>
                                    <a href="/login.php" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-200 hover:text-neon-purple hover:bg-dark-bg/50 transition-colors group">
                                        <svg class="w-5 h-5 text-gray-300 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Вход</span>
                                    </a>
                                    <a href="/register.php" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-200 hover:text-neon-purple hover:bg-dark-bg/50 transition-colors group">
                                        <svg class="w-5 h-5 text-gray-300 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                        <span>Регистрация</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Кнопка мобильного меню -->
                <div class="flex items-center flex-shrink-0">
                    <button class="md:hidden text-gray-300 hover:text-neon-purple active:text-neon-purple focus:text-neon-purple focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2 focus:ring-offset-dark-bg rounded-lg transition-all duration-200 p-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center touch-manipulation flex-shrink-0 hover:bg-dark-surface/50 active:bg-dark-surface/70 active:scale-95" id="mobileMenuBtn" aria-label="<?php echo htmlspecialchars(t('nav.menu')); ?>" aria-expanded="false" aria-controls="mobileMenu" type="button">
                        <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
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

                <!-- Аккаунт в мобильном меню -->
                <?php if ($currentUser): ?>
                    <?php if (!$isRootAdmin): ?>
                        <a href="/dashboard.php" class="mobile-menu-item block w-full px-6 sm:px-7 py-3 text-base sm:text-lg font-semibold text-white rounded-xl bg-dark-surface/80 border border-dark-border hover:border-neon-purple transition-all duration-200 active:scale-[0.98] opacity-0 transform translate-y-3">
                            Личный кабинет
                        </a>
                    <?php endif; ?>
                    <?php if ($isRootAdmin): ?>
                        <a href="/adm/" class="mobile-menu-item block w-full px-6 sm:px-7 py-3 text-base sm:text-lg font-semibold text-white rounded-xl bg-dark-surface/80 border border-neon-purple/60 hover:border-neon-blue transition-all duration-200 active:scale-[0.98] opacity-0 transform translate-y-3">
                            Админка
                        </a>
                    <?php endif; ?>
                    <a href="/logout.php" class="mobile-menu-item block w-full px-6 sm:px-7 py-3 text-base sm:text-lg font-semibold text-white rounded-xl bg-dark-surface/80 border border-dark-border hover:border-neon-purple transition-all duration-200 active:scale-[0.98] opacity-0 transform translate-y-3">
                        Выйти
                    </a>
                <?php else: ?>
                    <a href="/login.php" class="mobile-menu-item block w-full px-6 sm:px-7 py-3 text-base sm:text-lg font-semibold text-white rounded-xl bg-dark-surface/80 border border-dark-border hover:border-neon-purple transition-all duration-200 active:scale-[0.98] opacity-0 transform translate-y-3">
                        Войти
                    </a>
                    <a href="/register.php" class="mobile-menu-item block w-full px-6 sm:px-7 py-3 text-base sm:text-lg font-semibold text-white rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue hover:from-neon-purple/90 hover:to-neon-blue/90 transition-all duration-200 shadow-lg shadow-neon-purple/30 hover:shadow-xl active:scale-[0.98] opacity-0 transform translate-y-3">
                        Регистрация
                    </a>
                <?php endif; ?>
                
                <!-- Переключатель языка в мобильном меню -->
                <div class="mobile-menu-item mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-dark-border/60 opacity-0 transform translate-y-3 pb-safe" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4">
                        <span class="text-sm sm:text-base text-gray-400 font-medium"><?php echo htmlspecialchars(t('nav.language')); ?>:</span>
                        <div class="flex items-center gap-1.5 bg-dark-surface/60 backdrop-blur-sm rounded-xl p-1.5 border border-dark-border/60 shadow-sm">
                            <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="px-6 sm:px-7 py-2.5 sm:py-3 text-sm sm:text-base font-semibold rounded-lg transition-all duration-200 whitespace-nowrap min-w-[60px] sm:min-w-[70px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'ru' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>">
                                RU
                            </a>
                            <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="px-6 sm:px-7 py-2.5 sm:py-3 text-sm sm:text-base font-semibold rounded-lg transition-all duration-200 whitespace-nowrap min-w-[60px] sm:min-w-[70px] text-center focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-1 focus:ring-offset-dark-bg touch-manipulation active:scale-95 <?php echo $currentLang === 'en' ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white shadow-md shadow-neon-purple/40' : 'text-gray-400 hover:text-gray-200 hover:bg-dark-bg/60 active:bg-dark-bg/80'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>">
                                EN
                            </a>
                        </div>
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
            const accountBtn = document.getElementById('accountMenuBtn');
            const accountMenu = document.getElementById('accountMenu');
            let isAccountOpen = false;
            
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

            // Дропдаун аккаунта (по клику, не закрывается сразу) - улучшенная анимация
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
                    e.stopPropagation(); // позволяем кликать внутри, не закрывая
                });

                document.addEventListener('click', () => {
                    if (isAccountOpen) {
                        closeAccountMenu();
                    }
                });
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

