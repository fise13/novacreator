<?php
/**
 * Утилиты для проекта NovaCreator Studio
 * Общие функции для работы с путями, безопасностью и другими задачами
 */

/**
 * Определяет базовый путь к ресурсам с учетом preview режима Plesk
 * @return string Базовый путь
 */
function getBasePath() {
    $scriptPath = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
    
    // Если в preview режиме Plesk, извлекаем реальный путь
    if (preg_match('#/plesk-site-preview/[^/]+/[^/]+/[^/]+/(.+)$#', $scriptPath, $matches)) {
        $realPath = '/' . $matches[1];
        $baseDir = dirname($realPath);
    } elseif (preg_match('#/plesk-site-preview/[^/]+/(.+)$#', $scriptPath, $matches)) {
        $realPath = '/' . $matches[1];
        $baseDir = dirname($realPath);
    } else {
        $baseDir = dirname($scriptPath);
    }
    
    // Нормализуем путь
    $baseDir = ($baseDir === '/' || $baseDir === '\\' || $baseDir === '.') ? '' : $baseDir;
    $baseDir = rtrim($baseDir, '/\\');
    
    return $baseDir;
}

/**
 * Формирует путь к ресурсу (CSS, JS, изображения)
 * @param string $resource Путь к ресурсу относительно корня
 * @return string Полный путь к ресурсу
 */
function getAssetPath($resource) {
    $baseDir = getBasePath();
    $path = ($baseDir ? $baseDir . '/' : '/') . ltrim($resource, '/');
    return preg_replace('#/+#', '/', $path);
}

/**
 * Генерирует CSRF токен
 * @return string CSRF токен
 */
function generateCSRFToken() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    return $_SESSION['csrf_token'];
}

/**
 * Проверяет CSRF токен
 * @param string $token Токен для проверки
 * @return bool Результат проверки
 */
function verifyCSRFToken($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Очищает входные данные от XSS атак
 * @param string $data Данные для очистки
 * @return string Очищенные данные
 */
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Валидирует email
 * @param string $email Email для проверки
 * @return bool Результат валидации
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Валидирует телефон (базовая проверка)
 * @param string $phone Телефон для проверки
 * @return bool Результат валидации
 */
function validatePhone($phone) {
    // Удаляем все нецифровые символы кроме +
    $cleaned = preg_replace('/[^\d+]/', '', $phone);
    // Проверяем, что осталось минимум 10 цифр
    return preg_match('/^\+?\d{10,15}$/', $cleaned);
}

/**
 * Проверяет rate limiting для форм
 * @param string $key Ключ для идентификации (например, IP адрес)
 * @param int $maxAttempts Максимальное количество попыток
 * @param int $timeWindow Временное окно в секундах
 * @return bool true если можно продолжить, false если превышен лимит
 */
function checkRateLimit($key, $maxAttempts = 5, $timeWindow = 300) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $sessionKey = 'rate_limit_' . md5($key);
    $attempts = $_SESSION[$sessionKey] ?? [];
    
    // Удаляем старые попытки
    $now = time();
    $attempts = array_filter($attempts, function($timestamp) use ($now, $timeWindow) {
        return ($now - $timestamp) < $timeWindow;
    });
    
    // Проверяем лимит
    if (count($attempts) >= $maxAttempts) {
        return false;
    }
    
    // Добавляем текущую попытку
    $attempts[] = $now;
    $_SESSION[$sessionKey] = $attempts;
    
    return true;
}

/**
 * Получает IP адрес клиента с учетом прокси
 * @return string IP адрес
 */
function getClientIP() {
    $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_REAL_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($ipKeys as $key) {
        if (isset($_SERVER[$key]) && !empty($_SERVER[$key])) {
            $ip = $_SERVER[$key];
            // Если это список IP (через прокси), берем первый
            if (strpos($ip, ',') !== false) {
                $ip = trim(explode(',', $ip)[0]);
            }
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    
    return 'unknown';
}

/**
 * Форматирует телефон для отображения
 * @param string $phone Телефон
 * @return string Отформатированный телефон
 */
function formatPhone($phone) {
    // Удаляем все нецифровые символы
    $cleaned = preg_replace('/\D/', '', $phone);
    
    // Форматируем казахстанский номер
    if (strlen($cleaned) === 11 && substr($cleaned, 0, 1) === '7') {
        return '+7 ' . substr($cleaned, 1, 3) . ' ' . substr($cleaned, 4, 3) . ' ' . substr($cleaned, 7, 2) . ' ' . substr($cleaned, 9, 2);
    }
    
    return $phone;
}

/**
 * Безопасно выводит JSON ответ
 * @param array $data Данные для вывода
 * @param int $statusCode HTTP статус код
 */
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

/**
 * Логирует ошибку безопасно
 * @param string $message Сообщение
 * @param array $context Контекст
 */
function logError($message, $context = []) {
    $logFile = __DIR__ . '/../backend/errors.log';
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? ' | Context: ' . json_encode($context) : '';
    $logMessage = "[{$timestamp}] {$message}{$contextStr}\n";
    @file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

