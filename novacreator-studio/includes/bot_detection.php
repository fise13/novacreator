<?php
/**
 * Система обнаружения и блокировки ботов
 * 
 * Проверяет User-Agent, поведенческие паттерны
 * для защиты сайта от вредоносных ботов и скраперов.
 * 
 * Использование:
 * require_once __DIR__ . '/bot_detection.php';
 * if (isBotDetected()) {
 *     blockBot();
 * }
 */

// Путь к файлу логов блокировок
define('BOT_LOG_FILE', __DIR__ . '/../backend/bot_blocked.log');

// Разрешенные боты (поисковые системы и легитимные сервисы)
$allowedBots = [
    // Google
    'googlebot',
    'google',
    'mediapartners-google',
    'adsbot-google',
    'feedfetcher-google',
    'google-structured-data-testing-tool',
    
    // Bing
    'bingbot',
    'msnbot',
    'adidxbot',
    
    // Yandex
    'yandex',
    'yandexbot',
    'yandeximages',
    'yandexvideo',
    'yandexmedia',
    
    // Другие легитимные
    'facebookexternalhit',
    'facebookcatalog',
    'twitterbot',
    'linkedinbot',
    'slackbot',
    'whatsapp',
    'telegrambot',
    'applebot',
    'baiduspider',
    'sogou',
    'exabot',
    'ia_archiver',
    'archive.org_bot',
    'msnbot-media',
    'ahrefsbot', // SEO инструмент (можно разрешить или заблокировать)
    'semrushbot', // SEO инструмент
    'mj12bot', // Majestic SEO
    'dotbot', // Moz
    'megaindex', // SEO инструмент
];

// Запрещенные паттерны в User-Agent
$blockedPatterns = [
    // Очевидные боты
    '/bot[^a-z]/i',
    '/crawler/i',
    '/spider/i',
    '/scraper/i',
    '/scrape/i',
    '/curl/i',
    '/wget/i',
    '/python/i',
    '/java/i',
    '/perl/i',
    '/ruby/i',
    '/go-http/i',
    '/httpclient/i',
    '/libwww/i',
    '/lwp-trivial/i',
    '/mechanize/i',
    '/php/i', // PHP скрипты (не браузеры)
    '/requests/i',
    '/urllib/i',
    '/scrapy/i',
    '/beautifulsoup/i',
    
    // Подозрительные паттерны
    '/^$/i', // Пустой User-Agent
    '/^[a-z]{1,3}$/i', // Слишком короткий
    '/^[0-9]+$/i', // Только цифры
    
    // Известные вредоносные боты
    '/semrush/i',
    '/ahrefs/i',
    '/mj12bot/i',
    '/dotbot/i',
    '/megaindex/i',
    '/blexbot/i',
    '/dotbot/i',
    '/petalbot/i',
    '/barkrowler/i',
    '/barkrowler/i',
    '/dotbot/i',
];

// Подозрительные User-Agent строки (полное совпадение)
$blockedUserAgents = [
    '',
    'bot',
    'crawler',
    'spider',
    'scraper',
    'curl',
    'wget',
    'python-requests',
    'go-http-client',
    'java/',
    'perl',
    'ruby',
];

/**
 * Проверяет, является ли запрос от бота
 * 
 * @return bool true если обнаружен бот, false если легитимный пользователь
 */
function isBotDetected() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $userAgent = strtolower(trim($userAgent));
    
    // Если User-Agent пустой - это точно бот
    if (empty($userAgent)) {
        return true;
    }
    
    // Проверяем разрешенных ботов (поисковые системы)
    foreach ($GLOBALS['allowedBots'] as $allowedBot) {
        if (strpos($userAgent, strtolower($allowedBot)) !== false) {
            return false; // Это легитимный бот, разрешаем
        }
    }
    
    // Проверяем заблокированные паттерны
    foreach ($GLOBALS['blockedPatterns'] as $pattern) {
        if (preg_match($pattern, $userAgent)) {
            return true; // Обнаружен бот
        }
    }
    
    // Проверяем полное совпадение с заблокированными User-Agent
    if (in_array($userAgent, array_map('strtolower', $GLOBALS['blockedUserAgents']))) {
        return true;
    }
    
    // Проверяем отсутствие типичных браузерных заголовков
    if (!hasBrowserHeaders()) {
        return true;
    }
    
    // Проверяем поведенческие паттерны
    if (hasBotBehavior()) {
        return true;
    }
    
    return false;
}

/**
 * Проверяет наличие типичных браузерных заголовков
 * 
 * @return bool true если есть браузерные заголовки
 */
function hasBrowserHeaders() {
    // Реальные браузеры обычно отправляют Accept заголовки
    $hasAccept = isset($_SERVER['HTTP_ACCEPT']) && !empty($_SERVER['HTTP_ACCEPT']);
    
    // Проверяем Accept-Language (браузеры обычно отправляют)
    $hasAcceptLanguage = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    
    // Проверяем Accept-Encoding
    $hasAcceptEncoding = isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING']);
    
    // Если нет ни одного из этих заголовков - подозрительно
    if (!$hasAccept && !$hasAcceptLanguage && !$hasAcceptEncoding) {
        return false;
    }
    
    return true;
}

/**
 * Проверяет поведенческие паттерны ботов
 * 
 * @return bool true если обнаружено поведение бота
 */
function hasBotBehavior() {
    // Проверяем скорость запросов (если включены сессии)
    if (session_status() === PHP_SESSION_ACTIVE) {
        $lastRequestTime = $_SESSION['last_request_time'] ?? 0;
        $currentTime = time();
        $timeDiff = $currentTime - $lastRequestTime;
        
        // Если запросы идут слишком быстро (< 0.1 секунды) - это бот
        if ($timeDiff < 0.1 && $lastRequestTime > 0) {
            return true;
        }
        
        $_SESSION['last_request_time'] = $currentTime;
    }
    
    // Проверяем Referer (боты часто не отправляют или отправляют подозрительные)
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    if (!empty($referer)) {
        // Проверяем, что referer с того же домена или известных источников
        $host = $_SERVER['HTTP_HOST'] ?? '';
        if (!empty($host) && strpos($referer, $host) === false) {
            // Это может быть нормально (внешние ссылки), но проверяем подозрительные паттерны
            $suspiciousReferers = ['localhost', '127.0.0.1', '0.0.0.0'];
            foreach ($suspiciousReferers as $suspicious) {
                if (strpos($referer, $suspicious) !== false) {
                    return true;
                }
            }
        }
    }
    
    return false;
}

/**
 * Получает информацию о запросе для логирования
 * 
 * @return array Массив с информацией о запросе
 */
function getRequestInfo() {
    // Получаем IP адрес клиента
    // Проверяем заголовки прокси, если они есть
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    // Проверяем X-Forwarded-For (может быть от прокси-сервера)
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ips[0]);
    } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
        $ip = trim($_SERVER['HTTP_X_REAL_IP']);
    }
    
    return [
        'ip' => $ip,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'referer' => $_SERVER['HTTP_REFERER'] ?? 'none',
        'uri' => $_SERVER['REQUEST_URI'] ?? 'unknown',
        'method' => $_SERVER['REQUEST_METHOD'] ?? 'unknown',
        'time' => date('Y-m-d H:i:s'),
    ];
}

/**
 * Логирует блокировку бота
 * 
 * @param array $requestInfo Информация о запросе
 */
function logBotBlock($requestInfo) {
    $logEntry = sprintf(
        "[%s] BOT BLOCKED - IP: %s | UA: %s | URI: %s | Referer: %s\n",
        $requestInfo['time'],
        $requestInfo['ip'],
        $requestInfo['user_agent'],
        $requestInfo['uri'],
        $requestInfo['referer']
    );
    
    @file_put_contents(BOT_LOG_FILE, $logEntry, FILE_APPEND | LOCK_EX);
}

/**
 * Блокирует бота и отправляет ответ
 * 
 * @param bool $log Логировать ли блокировку
 */
function blockBot($log = true) {
    $requestInfo = getRequestInfo();
    
    if ($log) {
        logBotBlock($requestInfo);
    }
    
    // Отправляем 403 Forbidden
    http_response_code(403);
    
    // Отправляем заголовки для предотвращения индексации
    header('X-Robots-Tag: noindex, nofollow');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Отправляем простую HTML страницу с сообщением
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Доступ запрещен</title>
        <meta name="robots" content="noindex, nofollow">
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                background: #0A0A0F;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
                padding: 20px;
            }
            .container {
                text-align: center;
                max-width: 500px;
            }
            h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
                color: #8B5CF6;
            }
            p {
                color: #9CA3AF;
                line-height: 1.6;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Доступ запрещен</h1>
            <p>Ваш запрос был заблокирован системой защиты от ботов.</p>
            <p>Если вы используете легитимный бот (например, поисковую систему), убедитесь, что ваш User-Agent правильно настроен.</p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/**
 * Проверяет и блокирует ботов (главная функция для использования)
 * 
 * @param bool $strict Строгий режим (более агрессивная проверка)
 * @return void
 */
function checkAndBlockBots($strict = false) {
    // Исключаем проверку для админ-панели (чтобы не блокировать себя)
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    
    // Пропускаем проверку для админки и backend
    if (strpos($requestUri, '/admin') === 0 || 
        strpos($requestUri, '/backend') === 0) {
        return; // Пропускаем проверку
    }
    
    // Проверяем на бота
    if (isBotDetected()) {
        blockBot(true);
    }
}

