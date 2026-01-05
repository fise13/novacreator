<?php
/**
 * Система интернационализации (i18n)
 * Управление переводами и языковыми настройками
 */

// Поддерживаемые языки
define('SUPPORTED_LANGUAGES', ['ru', 'en']);
define('DEFAULT_LANGUAGE', 'ru');

/**
 * Определяет текущий язык из URL, браузера и IP
 * @return string Код языка (ru или en)
 */
function detectLanguage(): string {
    // Сначала проверяем параметр lang из query string (приоритет 1)
    if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGUAGES)) {
        return $_GET['lang'];
    }
    
    // Проверяем сохраненный язык в сессии (приоритет 2)
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user_lang']) && in_array($_SESSION['user_lang'], SUPPORTED_LANGUAGES)) {
        return $_SESSION['user_lang'];
    }
    
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));
    
    // Проверяем первый сегмент URL (приоритет 3)
    if (!empty($segments[0]) && in_array($segments[0], SUPPORTED_LANGUAGES)) {
        return $segments[0];
    }
    
    // Проверяем Accept-Language заголовок браузера (приоритет 4)
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        // Парсим Accept-Language заголовок
        $languages = [];
        preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/i', $acceptLang, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $index => $lang) {
                $lang = strtolower($lang);
                $q = isset($matches[2][$index]) ? (float)$matches[2][$index] : 1.0;
                $languages[$lang] = $q;
            }
            arsort($languages);
            
            // Проверяем предпочтения браузера
            foreach ($languages as $lang => $q) {
                $langCode = substr($lang, 0, 2);
                if ($langCode === 'en') {
                    return 'en';
                } elseif ($langCode === 'ru') {
                    return 'ru';
                }
            }
        }
    }
    
    // Определение по IP (приоритет 5) - только если нет других данных
    $ipLang = detectLanguageByIP();
    if ($ipLang !== null) {
        return $ipLang;
    }
    
    return DEFAULT_LANGUAGE;
}

/**
 * Определяет язык по IP адресу пользователя
 * @return string|null Код языка или null если не удалось определить
 */
function detectLanguageByIP(): ?string {
    $ip = $_SERVER['REMOTE_ADDR'] ?? null;
    if (!$ip) {
        return null;
    }
    
    // Список стран с английским языком (упрощенный)
    $englishCountries = ['US', 'GB', 'CA', 'AU', 'NZ', 'IE', 'ZA', 'IN', 'PK', 'BD', 'NG', 'KE', 'GH', 'TZ', 'UG', 'ZW', 'ZM', 'MW', 'SL', 'LR', 'GM', 'BS', 'BB', 'BZ', 'GY', 'JM', 'TT', 'AG', 'BS', 'DM', 'GD', 'KN', 'LC', 'VC', 'SG', 'MY', 'PH', 'FJ', 'PG', 'SB', 'VU', 'NR', 'PW', 'FM', 'MH'];
    
    // Список стран с русским языком (упрощенный)
    $russianCountries = ['RU', 'KZ', 'BY', 'UA', 'KG', 'TJ', 'TM', 'UZ', 'MD', 'AM', 'AZ', 'GE'];
    
    try {
        // Используем бесплатный API для определения страны по IP
        // Можно использовать ip-api.com, ipinfo.io или другие сервисы
        $context = stream_context_create([
            'http' => [
                'timeout' => 2,
                'method' => 'GET',
                'header' => 'Accept: application/json'
            ]
        ]);
        
        // Используем ip-api.com (бесплатный, до 45 запросов в минуту)
        $url = "http://ip-api.com/json/{$ip}?fields=countryCode";
        $response = @file_get_contents($url, false, $context);
        
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['countryCode'])) {
                $countryCode = $data['countryCode'];
                
                if (in_array($countryCode, $englishCountries)) {
                    return 'en';
                } elseif (in_array($countryCode, $russianCountries)) {
                    return 'ru';
                }
            }
        }
    } catch (Exception $e) {
        // В случае ошибки просто возвращаем null
        return null;
    }
    
    return null;
}

/**
 * Получает текущий язык
 * @return string Код языка
 */
function getCurrentLanguage(): string {
    static $lang = null;
    if ($lang === null) {
        $lang = detectLanguage();
    }
    return $lang;
}

/**
 * Загружает переводы для указанного языка
 * @param string $lang Код языка
 * @return array Массив переводов
 */
function loadTranslations(string $lang): array {
    static $translations = [];
    
    if (isset($translations[$lang])) {
        return $translations[$lang];
    }
    
    $langFile = __DIR__ . '/../lang/' . $lang . '.json';
    
    if (!file_exists($langFile)) {
        // Если файл не найден, используем язык по умолчанию
        $lang = DEFAULT_LANGUAGE;
        $langFile = __DIR__ . '/../lang/' . $lang . '.json';
    }
    
    if (file_exists($langFile)) {
        $content = file_get_contents($langFile);
        $translations[$lang] = json_decode($content, true) ?? [];
    } else {
        $translations[$lang] = [];
    }
    
    return $translations[$lang];
}

/**
 * Получает перевод по ключу
 * @param string $key Ключ перевода (поддерживает точечную нотацию, например 'nav.home')
 * @param array $params Параметры для замены в строке
 * @return string Переведенный текст
 */
function t(string $key, array $params = []): string {
    $lang = getCurrentLanguage();
    $translations = loadTranslations($lang);
    
    // Поддержка точечной нотации для вложенных массивов
    $keys = explode('.', $key);
    $value = $translations;
    
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            // Если перевод не найден, возвращаем ключ
            return $key;
        }
    }
    
    // Если значение - строка, заменяем параметры
    if (is_string($value) && !empty($params)) {
        foreach ($params as $paramKey => $paramValue) {
            $value = str_replace(':' . $paramKey, $paramValue, $value);
        }
    }
    
    return is_string($value) ? $value : $key;
}

/**
 * Получает текущий путь без языкового префикса
 * @return string Путь без префикса языка
 */
function getCurrentPath(): string {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));
    
    // Убираем языковой префикс если он есть
    if (!empty($segments[0]) && in_array($segments[0], SUPPORTED_LANGUAGES)) {
        array_shift($segments);
    }
    
    $cleanPath = '/' . implode('/', $segments);
    return $cleanPath === '//' ? '/' : $cleanPath;
}

/**
 * Генерирует URL для указанного языка
 * @param string $lang Код языка
 * @param string|null $path Путь (если null, используется текущий путь)
 * @return string URL с языковым префиксом
 */
function getLocalizedUrl(string $lang, ?string $path = null): string {
    if (!in_array($lang, SUPPORTED_LANGUAGES)) {
        $lang = DEFAULT_LANGUAGE;
    }
    
    if ($path === null) {
        $path = getCurrentPath();
    }
    
    // Убираем языковой префикс из пути если он есть
    $pathSegments = explode('/', trim($path, '/'));
    if (!empty($pathSegments[0]) && in_array($pathSegments[0], SUPPORTED_LANGUAGES)) {
        array_shift($pathSegments);
    }
    
    $cleanPath = '/' . implode('/', $pathSegments);
    $cleanPath = $cleanPath === '//' ? '/' : $cleanPath;
    
    // Для языка по умолчанию (ru) не добавляем префикс в корне
    if ($lang === DEFAULT_LANGUAGE && $cleanPath === '/') {
        return '/';
    }
    
    // Для языка по умолчанию (ru) возвращаем путь БЕЗ префикса /ru/
    // Это предотвращает циклы редиректов с правилом .htaccess
    // Правило .htaccess обработает /ru/... и добавит ?lang=ru
    if ($lang === DEFAULT_LANGUAGE) {
        return $cleanPath;
    }
    
    return '/' . $lang . $cleanPath;
}

/**
 * Получает альтернативные языковые версии текущей страницы
 * @return array Массив ['lang' => 'url']
 */
function getAlternateLanguages(): array {
    $alternates = [];
    $currentPath = getCurrentPath();
    
    foreach (SUPPORTED_LANGUAGES as $lang) {
        $alternates[$lang] = getLocalizedUrl($lang, $currentPath);
    }
    
    return $alternates;
}

/**
 * Перенаправляет на правильный URL с языковым префиксом
 */
function redirectToLocalizedUrl(): void {
    $lang = getCurrentLanguage();
    $currentPath = getCurrentPath();
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));
    
    // Если язык не указан в URL и это не корень, перенаправляем
    if (empty($segments[0]) || !in_array($segments[0], SUPPORTED_LANGUAGES)) {
        $targetUrl = getLocalizedUrl($lang, $currentPath);
        
        // Добавляем query string если есть (исключая lang, так как он уже в URL)
        $queryString = parse_url($requestUri, PHP_URL_QUERY);
        if ($queryString) {
            parse_str($queryString, $queryParams);
            unset($queryParams['lang']); // Убираем lang из query string
            if (!empty($queryParams)) {
                $targetUrl .= '?' . http_build_query($queryParams);
            }
        }
        
        if ($targetUrl !== $path) {
            header('Location: ' . $targetUrl, true, 301);
            exit;
        }
    }
}

// Инициализация: определяем язык и загружаем переводы
$currentLang = getCurrentLanguage();
$translations = loadTranslations($currentLang);

