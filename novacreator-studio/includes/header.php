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
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K3638CM2');</script>
    <!-- End Google Tag Manager -->
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
    <!-- Google Fonts: Radio Canada Big (Figma Navigation) + остальные -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:wght@400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:wght@400;500;600;700&family=Source+Serif+4:wght@400;500;600;700&family=Geist+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
    
    <!-- Минималистичные hover эффекты - убираем все боксы и tooltip -->
    <link rel="stylesheet" href="/assets/css/minimal-hover.css">
    
    <link rel="preload" as="image" type="image/webp" href="/assets/img/og-default.webp">
    <link rel="preload" as="script" href="<?php echo $jsPreloadPath; ?>">
    <meta name="color-scheme" content="dark light">
    
    <!-- Favicon - оптимизировано для Google Search и Яндекс (RealFaviconGenerator) -->
    <!-- Основной favicon.ico для Яндекса и Google (в корне, доступен по /favicon.ico) -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
    <!-- Дополнительные форматы для лучшей совместимости -->
    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96">
    <!-- SVG favicon для современных браузеров -->
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg">
    <!-- Fallback для старых браузеров -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <!-- Apple Touch Icon для iOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <!-- Web App Manifest -->
    <link rel="manifest" href="/favicon/site.webmanifest">
    
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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K3638CM2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Skip to content link for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[100] focus:px-4 focus:py-2 focus:bg-neon-purple focus:text-white focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-neon-purple focus:ring-offset-2"><?php echo htmlspecialchars(t('nav.skipToContent') ?? 'Skip to content'); ?></a>
    
    <!-- Индикатор прогресса прокрутки -->
    <div class="scroll-progress-bar fixed top-0 left-0 h-1 bg-gradient-to-r from-neon-purple to-neon-blue z-50" style="width: 0%; transition: width 0.1s ease-out;"></div>
    
    <!-- Навигация - минималистичный Figma-style header -->
    <nav
        id="mainNavbar"
        role="navigation"
        aria-label="<?php echo htmlspecialchars(t('nav.main')); ?>"
        class="navbar fixed top-0 left-0 right-0 z-50 border-b border-black/10 dark:border-white/10 bg-white/30 dark:bg-neutral-900/60 backdrop-blur-[32px] supports-[backdrop-filter]:backdrop-blur-[32px] supports-[backdrop-filter]:bg-white/40 transition-all duration-300 pt-[env(safe-area-inset-top)] h-[60px] md:h-20 flex items-center"
    >
        <div class="max-w-[1400px] mx-auto px-[20px] md:px-6 lg:px-8 relative z-10 w-full">
            <div class="flex items-center justify-between gap-6 md:gap-[24px] w-full">
                <!-- Логотип / название сайта (Figma Navigation: только Radio Canada Big, без text-lg/font-semibold/font-sans) -->
                <a
                    id="site-logo"
                    href="<?php echo getLocalizedUrl($currentLang, '/'); ?>"
                    class="font-radio font-medium text-[18px] leading-[1.2] tracking-[-0.3px] touch-manipulation flex-shrink-0 transition-opacity duration-200 hover:opacity-70"
                    style="color: var(--color-text);"
                    aria-label="<?php echo htmlspecialchars(t('nav.home') . ' - ' . t('site.name')); ?>"
                    aria-current="<?php echo basename($_SERVER['PHP_SELF'], '.php') == 'index' ? 'page' : 'false'; ?>"
                >
                    <?php echo htmlspecialchars(t('site.name')); ?>
                </a>

                <div class="flex items-center gap-4 sm:gap-6">
                    <!-- Навигация для десктопа -->
                    <div class="hidden md:flex items-center gap-6 lg:gap-[24px] text-[15px] md:text-[16px] font-medium tracking-tight leading-none" role="menubar">
                        <?php 
                        $currentPage = basename($_SERVER['PHP_SELF'], '.php');
                        $currentPath = getCurrentPath();
                        ?>
                        <a
                            href="<?php echo getLocalizedUrl($currentLang, '/'); ?>"
                            class="nav-link inline-flex items-center gap-1 leading-none transition-opacity duration-200 hover:opacity-70 <?php echo $currentPage == 'index' ? 'opacity-100' : 'opacity-80'; ?>"
                            role="menuitem"
                            aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>"
                        >
                            <?php echo htmlspecialchars(t('nav.home')); ?>
                        </a>
                        <a
                            href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>"
                            class="nav-link inline-flex items-center gap-1 leading-none transition-opacity duration-200 hover:opacity-70 <?php echo $currentPage == 'services' ? 'opacity-100' : 'opacity-80'; ?>"
                            role="menuitem"
                            aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>"
                        >
                            <?php echo htmlspecialchars(t('nav.services')); ?>
                        </a>
                        <a
                            href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>"
                            class="nav-link inline-flex items-center gap-1 leading-none transition-opacity duration-200 hover:opacity-70 <?php echo $currentPage == 'seo' ? 'opacity-100' : 'opacity-80'; ?>"
                            role="menuitem"
                            aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>"
                        >
                            <?php echo htmlspecialchars(t('nav.seo')); ?>
                        </a>
                        <a
                            href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>"
                            class="nav-link inline-flex items-center gap-1 leading-none transition-opacity duration-200 hover:opacity-70 <?php echo $currentPage == 'ads' ? 'opacity-100' : 'opacity-80'; ?>"
                            role="menuitem"
                            aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>"
                        >
                            <?php echo htmlspecialchars(t('nav.ads')); ?>
                        </a>
                        <a
                            href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>"
                            class="nav-link inline-flex items-center gap-1 leading-none transition-opacity duration-200 hover:opacity-70 <?php echo $currentPage == 'about' ? 'opacity-100' : 'opacity-80'; ?>"
                            role="menuitem"
                            aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>"
                        >
                            <?php echo htmlspecialchars(t('nav.about')); ?>
                        </a>
                        <?php 
                        $currentPageName = basename($_SERVER['PHP_SELF'], '.php');
                        $hasContactForm = ($currentPageName === 'index' || $currentPageName === 'demo');
                        ?>
                        <a
                            href="<?php echo $hasContactForm ? '#contact-form' : getLocalizedUrl($currentLang, '/contact'); ?>"
                            <?php echo $hasContactForm ? 'onclick="const el = document.getElementById(\'contact-form\'); if(el) { el.scrollIntoView({behavior: \'smooth\'}); return false; }"' : ''; ?>
                            class="font-radio inline-flex items-center justify-center bg-black text-white rounded-xl px-6 py-3 text-[16px] font-semibold tracking-tight transition-all duration-200 hover:opacity-90 active:opacity-80 active:scale-[0.98]"
                        >
                            <?php echo htmlspecialchars(t('common.getStarted')); ?>
                        </a>
                    </div>

                    <!-- Блок действий: тема, язык, аккаунт -->
                    <div class="hidden md:flex items-center gap-3">
                        <!-- Переключатель темы -->
                        <button
                            id="themeToggle"
                            class="relative w-9 h-9 rounded-full flex items-center justify-center transition-opacity duration-200 hover:opacity-70 focus:outline-none"
                            aria-label="Переключить тему"
                        >
                            <svg id="themeIconLight" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <svg id="themeIconDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>

                        <!-- Переключатель языка -->
                        <div class="flex items-center space-x-1 rounded-full p-1" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>">
                            <a
                                href="<?php echo getLocalizedUrl('ru', $currentPath); ?>"
                                class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-opacity duration-200 hover:opacity-70 min-w-[40px] text-center focus:outline-none <?php echo $currentLang === 'ru' ? 'opacity-100' : 'opacity-70'; ?>"
                                aria-label="Русский язык"
                                aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>"
                            >
                                <span class="relative z-10">RU</span>
                            </a>
                            <a
                                href="<?php echo getLocalizedUrl('en', $currentPath); ?>"
                                class="relative px-3 py-1.5 text-sm font-medium rounded-md transition-opacity duration-200 hover:opacity-70 min-w-[40px] text-center focus:outline-none <?php echo $currentLang === 'en' ? 'opacity-100' : 'opacity-70'; ?>"
                                aria-label="English language"
                                aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>"
                            >
                                <span class="relative z-10">EN</span>
                            </a>
                        </div>

                        <!-- Аккаунт -->
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
                            <button
                                id="accountMenuBtn"
                                class="relative w-9 h-9 rounded-full flex items-center justify-center text-sm font-medium transition-opacity duration-200 hover:opacity-70 focus:outline-none overflow-hidden group"
                                aria-expanded="false"
                                aria-haspopup="true"
                                aria-label="<?php echo $userName ? htmlspecialchars($userName) : 'Аккаунт'; ?>"
                            >
                                <?php if ($userAvatar): ?>
                                    <img
                                        src="<?php echo htmlspecialchars($userAvatar); ?>"
                                        alt="<?php echo htmlspecialchars($userName); ?>"
                                        class="w-full h-full object-cover rounded-full"
                                        id="userAvatarImg"
                                        loading="lazy"
                                        onerror="this.style.display='none'; const fallback = document.getElementById('userAvatarFallback'); if(fallback) fallback.style.display='flex';"
                                    >
                                    <span
                                        id="userAvatarFallback"
                                        class="absolute inset-0 flex items-center justify-center text-xs font-bold leading-none hidden z-10"
                                    >
                                        <?php echo $userInitials ? htmlspecialchars($userInitials) : ''; ?>
                                    </span>
                                <?php elseif ($userInitials): ?>
                                    <span class="relative z-10 text-xs font-bold leading-none">
                                        <?php echo htmlspecialchars($userInitials); ?>
                                    </span>
                                <?php else: ?>
                                    <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                <?php endif; ?>
                            </button>
                            <div
                                id="accountMenu"
                                class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl opacity-0 pointer-events-none transition-all duration-200 z-50 hidden transform translate-y-2"
                                style="background-color: var(--color-bg); border: 1px solid var(--color-border);"
                            >
                                <div class="py-2">
                                    <?php if ($currentUser): ?>
                                        <div class="px-4 py-3 border-b" style="border-color: var(--color-border);">
                                            <p class="text-sm font-semibold truncate" style="color: var(--color-text);">
                                                <?php echo htmlspecialchars($currentUser['name']); ?>
                                            </p>
                                            <p class="text-xs truncate mt-0.5" style="color: var(--color-text-secondary);">
                                                <?php echo htmlspecialchars($currentUser['email']); ?>
                                            </p>
                                        </div>
                                        <?php if (!$isRootAdmin): ?>
                                            <a href="/dashboard.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors" style="color: var(--color-text); text-decoration: none;">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span>Личный кабинет</span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($isRootAdmin): ?>
                                            <a href="/adm/" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors" style="color: var(--color-text); text-decoration: none;">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span>Админ-панель</span>
                                            </a>
                                        <?php endif; ?>
                                        <div class="border-t my-1" style="border-color: var(--color-border);"></div>
                                        <a href="/logout.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors" style="color: var(--color-text); text-decoration: none;">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Выйти</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="/login.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors" style="color: var(--color-text); text-decoration: none;">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Вход</span>
                                        </a>
                                        <a href="/register.php" class="flex items-center gap-3 px-4 py-3 text-sm transition-colors" style="color: var(--color-text); text-decoration: none;">
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

                    <!-- Кнопка бургер-меню (мобильная навигация) -->
                    <div class="flex items-center flex-shrink-0 md:hidden">
                        <button
                            id="burgerBtn"
                            type="button"
                            aria-label="Меню"
                            aria-expanded="false"
                            aria-controls="burgerMenu"
                            class="inline-flex items-center justify-center w-10 h-10 min-w-[44px] min-h-[44px] rounded-full border border-black/10 dark:border-white/15 bg-white/60 dark:bg-neutral-900/70 text-neutral-900 dark:text-neutral-100 backdrop-blur-md transition-all duration-200 active:scale-95 focus:outline-none"
                        >
                            <svg
                                id="burgerIcon"
                                class="w-6 h-6 absolute transition-all duration-300"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                stroke-width="2"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg
                                id="burgerCloseIcon"
                                class="w-6 h-6 absolute transition-all duration-300 opacity-0 rotate-90 scale-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                stroke-width="2"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Overlay: только затемнение, без blur -->
    <div
        id="burgerOverlay"
        class="fixed inset-0 z-[9998] bg-black/5 transition-opacity duration-300 pointer-events-none opacity-0 hidden"
        aria-hidden="true"
    ></div>

    <!-- DropdownContent: выпадает вниз под navbar с отступом (воздух) -->
    <div
        id="burgerMenu"
        class="fixed left-0 w-full z-[9999] opacity-0 -translate-y-3 pointer-events-none transition-all duration-300 ease-out hidden"
        style="top: calc(52px + env(safe-area-inset-top));"
        role="dialog"
        aria-modal="true"
        aria-labelledby="burgerMenuTitle"
        aria-hidden="true"
    >
        <?php $currentPage = basename($_SERVER['PHP_SELF'], '.php'); ?>
        <div
            id="burgerPanel"
            class="bg-white/95 dark:bg-neutral-900/95 backdrop-blur-[32px] border-b border-black/10 dark:border-white/10 px-[20px] pb-[20px] flex flex-col gap-[24px] shadow-[0_16px_40px_rgba(0,0,0,0.12)] rounded-b-2xl"
        >
            <span id="burgerMenuTitle" class="sr-only"><?php echo htmlspecialchars(t('nav.main')); ?></span>

            <!-- Пункты меню: Figma-типографика font-radio -->
            <nav role="navigation" aria-label="<?php echo htmlspecialchars(t('nav.main')); ?>">
                <a
                    href="<?php echo getLocalizedUrl($currentLang, '/'); ?>"
                    class="burger-menu-link font-radio block w-full text-[40px] font-medium leading-none tracking-[-1.2px] py-[24px] transition-all duration-200 hover:opacity-70 active:opacity-50 border-t-0"
                    aria-current="<?php echo $currentPage == 'index' ? 'page' : 'false'; ?>"
                    style="color: var(--color-text); text-decoration: none;"
                >
                    <?php echo htmlspecialchars(t('nav.home')); ?>
                </a>
                <a
                    href="<?php echo getLocalizedUrl($currentLang, '/services'); ?>"
                    class="burger-menu-link font-radio block w-full text-[40px] font-medium leading-none tracking-[-1.2px] py-[24px] transition-all duration-200 hover:opacity-70 active:opacity-50 border-t border-[#dbe0ec]"
                    aria-current="<?php echo $currentPage == 'services' ? 'page' : 'false'; ?>"
                    style="color: var(--color-text); text-decoration: none;"
                >
                    <?php echo htmlspecialchars(t('nav.services')); ?>
                </a>
                <a
                    href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>"
                    class="burger-menu-link font-radio block w-full text-[40px] font-medium leading-none tracking-[-1.2px] py-[24px] transition-all duration-200 hover:opacity-70 active:opacity-50 border-t border-[#dbe0ec]"
                    aria-current="<?php echo $currentPage == 'seo' ? 'page' : 'false'; ?>"
                    style="color: var(--color-text); text-decoration: none;"
                >
                    <?php echo htmlspecialchars(t('nav.seo')); ?>
                </a>
                <a
                    href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>"
                    class="burger-menu-link font-radio block w-full text-[40px] font-medium leading-none tracking-[-1.2px] py-[24px] transition-all duration-200 hover:opacity-70 active:opacity-50 border-t border-[#dbe0ec]"
                    aria-current="<?php echo $currentPage == 'ads' ? 'page' : 'false'; ?>"
                    style="color: var(--color-text); text-decoration: none;"
                >
                    <?php echo htmlspecialchars(t('nav.ads')); ?>
                </a>
                <a
                    href="<?php echo getLocalizedUrl($currentLang, '/about'); ?>"
                    class="burger-menu-link font-radio block w-full text-[40px] font-medium leading-none tracking-[-1.2px] py-[24px] transition-all duration-200 hover:opacity-70 active:opacity-50 border-t border-b border-[#dbe0ec]"
                    aria-current="<?php echo $currentPage == 'about' ? 'page' : 'false'; ?>"
                    style="color: var(--color-text); text-decoration: none;"
                >
                    <?php echo htmlspecialchars(t('nav.about')); ?>
                </a>
            </nav>

            <!-- CTA кнопка "Начать проект" — всегда ведёт на contact.php (удобно на телефоне) -->
            <a
                id="burgerCtaBtn"
                href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>"
                class="font-radio w-full py-[18px] px-5 text-[18px] font-semibold tracking-tight text-center bg-black text-white rounded-xl transition-all duration-200 hover:opacity-90 active:opacity-80 active:scale-[0.98] flex items-center justify-center"
                style="text-decoration: none; -webkit-tap-highlight-color: transparent; min-height: 56px; opacity: 1;"
            >
                <?php echo htmlspecialchars(t('common.getStarted')); ?>
            </a>

            <?php if ($currentUser): ?>
                <div class="pt-4 border-t border-[#dbe0ec] space-y-1" style="color: var(--color-text-secondary);">
                    <?php if (!$isRootAdmin): ?>
                        <a href="/dashboard.php" class="font-radio block py-3 px-0 text-[15px] font-medium transition-all duration-200 hover:opacity-80 active:opacity-60 min-h-[44px] flex items-center" style="color: inherit; text-decoration: none;">Личный кабинет</a>
                    <?php endif; ?>
                    <?php if ($isRootAdmin): ?>
                        <a href="/adm/" class="font-radio block py-3 px-0 text-[15px] font-medium transition-all duration-200 hover:opacity-80 active:opacity-60 min-h-[44px] flex items-center" style="color: inherit; text-decoration: none;">Админ-панель</a>
                    <?php endif; ?>
                    <a href="/logout.php" class="font-radio block py-3 px-0 text-[15px] font-medium transition-all duration-200 hover:opacity-80 active:opacity-60 min-h-[44px] flex items-center" style="color: inherit; text-decoration: none;">Выйти</a>
                </div>
            <?php else: ?>
                <div class="pt-4 border-t border-[#dbe0ec] space-y-1" style="color: var(--color-text-secondary);">
                    <a href="/login.php" class="font-radio block py-3 px-0 text-[15px] font-medium transition-all duration-200 hover:opacity-80 active:opacity-60 min-h-[44px] flex items-center" style="color: inherit; text-decoration: none;">Войти</a>
                    <a href="/register.php" class="font-radio block py-3 px-0 text-[15px] font-medium transition-all duration-200 hover:opacity-80 active:opacity-60 min-h-[44px] flex items-center" style="color: inherit; text-decoration: none;">Регистрация</a>
                </div>
            <?php endif; ?>

            <!-- Переключатель темы и языка: Figma-style кнопки -->
            <div class="pt-3 border-t border-black/10 dark:border-white/10 flex items-center justify-between" role="group" aria-label="Настройки">
                <button
                    id="burgerThemeToggle"
                    type="button"
                    class="font-radio relative w-11 h-11 flex items-center justify-center rounded-xl bg-black/5 dark:bg-white/10 text-current border border-black/10 dark:border-white/15 transition-all duration-200 hover:bg-black/10 dark:hover:bg-white/15 active:scale-95 touch-manipulation min-w-[44px] min-h-[44px]"
                    aria-label="Переключить тему оформления"
                >
                    <svg id="burgerThemeIconLight" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="burgerThemeIconDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
                <div id="burgerLangGroup" role="group" aria-label="<?php echo htmlspecialchars(t('nav.language')); ?>" class="flex items-center gap-2">
                    <a href="<?php echo getLocalizedUrl('ru', $currentPath); ?>" class="font-radio px-4 py-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center rounded-xl text-[15px] font-medium transition-all duration-200 hover:bg-black/5 dark:hover:bg-white/10 active:scale-95 <?php echo $currentLang === 'ru' ? 'font-semibold bg-black/5 dark:bg-white/10' : 'font-normal'; ?>" aria-label="Русский язык" aria-current="<?php echo $currentLang === 'ru' ? 'true' : 'false'; ?>" style="color: var(--color-text); text-decoration: none;">RU</a>
                    <span class="font-radio opacity-40 text-sm" style="color: var(--color-text-secondary);">|</span>
                    <a href="<?php echo getLocalizedUrl('en', $currentPath); ?>" class="font-radio px-4 py-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center rounded-xl text-[15px] font-medium transition-all duration-200 hover:bg-black/5 dark:hover:bg-white/10 active:scale-95 <?php echo $currentLang === 'en' ? 'font-semibold bg-black/5 dark:bg-white/10' : 'font-normal'; ?>" aria-label="English language" aria-current="<?php echo $currentLang === 'en' ? 'true' : 'false'; ?>" style="color: var(--color-text); text-decoration: none;">EN</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Стили dropdown бургер-меню + логотип Figma (Radio Canada Big) -->
    <style id="burger-dropdown-overrides">
        /* Логотип: только Radio Canada Big, без наследования font-sans */
        #site-logo {
            font-family: "Radio Canada Big", sans-serif !important;
            font-weight: 500 !important;
            font-size: 18px !important;
            line-height: 1.2 !important;
            letter-spacing: -0.3px !important;
        }
        /* Overlay: только затемнение, без blur */
        #burgerOverlay {
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            background: rgba(0, 0, 0, 0.05) !important;
        }
        /* Dropdown: под navbar с отступом, на всю ширину, не side panel */
        #burgerMenu {
            top: calc(52px + env(safe-area-inset-top)) !important;
            left: 0 !important;
            right: 0 !important;
            bottom: auto !important;
            width: 100% !important;
            max-width: none !important;
            height: auto !important;
            max-height: none !important;
            inset: auto !important;
            transform: translateY(-0.75rem);
            background: transparent !important;
        }
        #burgerMenu::before { display: none !important; }
        /* Принудительно на мобильных (тот же breakpoint, что в output.css) */
        @media (max-width: 768px) {
            #burgerMenu {
                top: calc(52px + env(safe-area-inset-top)) !important;
                left: 0 !important;
                right: 0 !important;
                bottom: auto !important;
                width: 100% !important;
                max-width: none !important;
                height: auto !important;
            }
        }
    </style>

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
            
            // Обновление стиля кнопки "Связаться" в зависимости от темы
            function updateContactButton() {
                const contactBtn = document.querySelector('.header-contact-btn');
                if (!contactBtn) return;
                
                const isLight = document.documentElement.classList.contains('light');
                if (isLight) {
                    // Светлая тема
                    contactBtn.style.background = 'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)';
                    contactBtn.style.boxShadow = '0 2px 8px rgba(99, 102, 241, 0.25)';
                } else {
                    // Темная тема - более светлый градиент
                    contactBtn.style.background = 'linear-gradient(135deg, #818cf8 0%, #a78bfa 100%)';
                    contactBtn.style.boxShadow = '0 2px 10px rgba(129, 140, 248, 0.4)';
                }
                contactBtn.style.color = '#ffffff';
            }
            
            // Обновление стиля кнопки "Начать проект" в hero секции
            function updateHeroCtaButton() {
                const heroCtaBtn = document.querySelector('.hero-cta-btn, .hero-cta-main');
                if (!heroCtaBtn) return;
                
                const isLight = document.documentElement.classList.contains('light');
                if (isLight) {
                    // Светлая тема
                    heroCtaBtn.style.background = 'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)';
                    heroCtaBtn.style.boxShadow = '0 2px 8px rgba(99, 102, 241, 0.25)';
                } else {
                    // Темная тема - более светлый градиент
                    heroCtaBtn.style.background = 'linear-gradient(135deg, #818cf8 0%, #a78bfa 100%)';
                    heroCtaBtn.style.boxShadow = '0 2px 10px rgba(129, 140, 248, 0.4)';
                }
                heroCtaBtn.style.color = '#ffffff';
            }
            
            if (themeToggle && window.setTheme) {
                themeToggle.addEventListener('click', function() {
                    const currentTheme = window.getTheme();
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    window.setTheme(newTheme);
                    updateThemeIcon();
                    updateContactButton();
                    updateHeroCtaButton();
                });
                
                // Обновляем иконку и кнопки при загрузке
                updateThemeIcon();
                updateContactButton();
                updateHeroCtaButton();
                
                // Слушаем изменения темы
                const observer = new MutationObserver(function() {
                    updateThemeIcon();
                    updateContactButton();
                    updateHeroCtaButton();
                });
                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            } else {
                // Если setTheme не доступен, все равно обновляем при загрузке
                updateContactButton();
                updateHeroCtaButton();
            }
        })();
    </script>
    
    <!-- Скрипт бургер-меню: dropdown под navbar (Figma-style) -->
    <script>
        (function() {
            'use strict';

            const burgerBtn = document.getElementById('burgerBtn');
            const burgerMenu = document.getElementById('burgerMenu');
            const burgerOverlay = document.getElementById('burgerOverlay');
            const burgerThemeToggle = document.getElementById('burgerThemeToggle');
            const burgerThemeIconLight = document.getElementById('burgerThemeIconLight');
            const burgerThemeIconDark = document.getElementById('burgerThemeIconDark');
            const burgerIcon = document.getElementById('burgerIcon');
            const burgerCloseIcon = document.getElementById('burgerCloseIcon');

            let isBurgerOpen = false;
            let savedScrollY = 0;

            const STAGGER_DELAY = 40;

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

            function openBurgerMenu() {
                if (!burgerMenu || !burgerOverlay) return;

                isBurgerOpen = true;
                savedScrollY = window.scrollY;

                // показываем элементы (снимаем hidden, который нужен для старых стилей)
                burgerOverlay.classList.remove('hidden');
                burgerMenu.classList.remove('hidden');

                toggleBurgerIcon(true);

                document.body.style.position = 'fixed';
                document.body.style.top = `-${savedScrollY}px`;
                document.body.style.width = '100%';
                document.body.style.overflow = 'hidden';
                document.documentElement.style.overflow = 'hidden';

                burgerOverlay.setAttribute('aria-hidden', 'false');
                burgerOverlay.style.pointerEvents = 'auto';
                burgerOverlay.style.opacity = '0';

                burgerMenu.setAttribute('aria-hidden', 'false');
                burgerMenu.style.pointerEvents = 'auto';
                burgerMenu.style.opacity = '0';
                burgerMenu.style.transform = 'translateY(-0.75rem)';

                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        burgerOverlay.style.opacity = '1';
                        burgerMenu.style.opacity = '1';
                        burgerMenu.style.transform = 'translateY(0)';
                    });
                });

                var menuLinks = burgerMenu.querySelectorAll('.burger-menu-link');
                menuLinks.forEach(function(item, index) {
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(12px)';
                    item.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                    var delay = index * STAGGER_DELAY;
                    setTimeout(function() {
                        item.style.opacity = '1';
                        item.style.transform = 'translateX(0)';
                    }, delay);
                });

                var ctaBtn = document.getElementById('burgerCtaBtn');
                if (ctaBtn) {
                    ctaBtn.style.opacity = '1';
                    ctaBtn.style.transform = 'translateX(0)';
                }

                burgerBtn?.setAttribute('aria-expanded', 'true');
            }

            function closeBurgerMenu() {
                if (!burgerMenu || !burgerOverlay) return;

                isBurgerOpen = false;
                toggleBurgerIcon(false);

                if ('vibrate' in navigator) navigator.vibrate(5);

                burgerOverlay.style.opacity = '0';
                burgerMenu.style.opacity = '0';
                burgerMenu.style.transform = 'translateY(-0.75rem)';

                setTimeout(function() {
                    document.body.style.position = '';
                    document.body.style.top = '';
                    document.body.style.width = '';
                    document.body.style.overflow = '';
                    document.documentElement.style.overflow = '';
                    window.scrollTo(0, savedScrollY);

                    burgerOverlay.style.pointerEvents = 'none';
                    burgerOverlay.setAttribute('aria-hidden', 'true');
                    burgerMenu.style.pointerEvents = 'none';
                    burgerMenu.setAttribute('aria-hidden', 'true');
                    burgerOverlay.classList.add('hidden');
                    burgerMenu.classList.add('hidden');

                    var menuLinks = burgerMenu.querySelectorAll('.burger-menu-link');
                    menuLinks.forEach(function(item) {
                        item.style.opacity = '';
                        item.style.transform = '';
                        item.style.transition = '';
                    });
                    var ctaBtn = document.getElementById('burgerCtaBtn');
                    if (ctaBtn) {
                        ctaBtn.style.opacity = '';
                        ctaBtn.style.transform = '';
                        ctaBtn.style.transition = '';
                    }
                }, 300);

                burgerBtn?.setAttribute('aria-expanded', 'false');
            }

            if (burgerBtn) {
                burgerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (isBurgerOpen) closeBurgerMenu();
                    else openBurgerMenu();
                });
            }

            if (burgerOverlay) {
                burgerOverlay.addEventListener('click', closeBurgerMenu);
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isBurgerOpen) closeBurgerMenu();
            });

            if (burgerMenu) {
                burgerMenu.querySelectorAll('a').forEach(function(link) {
                    link.addEventListener('click', function() {
                        setTimeout(closeBurgerMenu, 100);
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

