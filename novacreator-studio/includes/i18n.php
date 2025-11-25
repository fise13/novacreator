<?php
/**
 * Система интернационализации (i18n)
 * Управление переводами и языковыми настройками
 */

// Поддерживаемые языки
define('SUPPORTED_LANGUAGES', ['ru', 'en']);
define('DEFAULT_LANGUAGE', 'ru');

/**
 * Определяет текущий язык из URL
 * @return string Код языка (ru или en)
 */
function detectLanguage(): string {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));
    
    // Проверяем первый сегмент URL
    if (!empty($segments[0]) && in_array($segments[0], SUPPORTED_LANGUAGES)) {
        return $segments[0];
    }
    
    // Проверяем Accept-Language заголовок
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (preg_match('/^en/i', $acceptLang)) {
            return 'en';
        }
    }
    
    return DEFAULT_LANGUAGE;
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
    
    // Для языка по умолчанию добавляем префикс только для не-корневых путей
    if ($lang === DEFAULT_LANGUAGE) {
        return '/ru' . $cleanPath;
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
        
        // Добавляем query string если есть
        $queryString = parse_url($requestUri, PHP_URL_QUERY);
        if ($queryString) {
            $targetUrl .= '?' . $queryString;
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

