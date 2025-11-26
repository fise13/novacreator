<?php
/**
 * Обработчик формы обратной связи
 * Отправляет заявки в Telegram через Bot API
 */

// Подключаем конфигурацию Telegram
$configPath = __DIR__ . '/telegram_config.php';

// Пытаемся загрузить конфиг, если он существует
if (file_exists($configPath)) {
    require_once $configPath;
}

// Определяем значения по умолчанию, если константы не определены
// Это позволяет коду работать даже без файла конфигурации
if (!defined('TELEGRAM_BOT_TOKEN')) {
    define('TELEGRAM_BOT_TOKEN', '8581188166:AAH2MQ-RYJO2dCOooehOhj_jbLKm7wnkKQo');
}
if (!defined('TELEGRAM_CHAT_ID')) {
    define('TELEGRAM_CHAT_ID', '-1003319377711');
}
if (!defined('TELEGRAM_API_URL')) {
    define('TELEGRAM_API_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/');
}
if (!defined('TELEGRAM_MIN_SEND_INTERVAL')) {
    define('TELEGRAM_MIN_SEND_INTERVAL', 30);
}
if (!defined('TELEGRAM_ENABLE_LOGGING')) {
    define('TELEGRAM_ENABLE_LOGGING', true);
}
if (!defined('TELEGRAM_LOG_FILE')) {
    define('TELEGRAM_LOG_FILE', __DIR__ . '/telegram_logs.txt');
}

// Запускаем сессию ДО отправки заголовков
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Устанавливаем заголовок для JSON ответа
header('Content-Type: application/json; charset=utf-8');

// Разрешаем CORS запросы
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header('Access-Control-Max-Age: 86400');

// Обрабатываем OPTIONS запросы для CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Обрабатываем только POST запросы
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Метод не разрешен'
    ]);
    exit;
}

// Функция логирования
function logMessage($message) {
    if (TELEGRAM_ENABLE_LOGGING) {
        $logEntry = date('Y-m-d H:i:s') . ' - ' . $message . "\n";
        @file_put_contents(TELEGRAM_LOG_FILE, $logEntry, FILE_APPEND | LOCK_EX);
    }
}

// Функция получения IP адреса
function getClientIP() {
    $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    foreach ($ipKeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

// Функция экранирования специальных символов для HTML (более мягкое экранирование)
function escapeHtml($text) {
    // Экранируем только HTML теги и амперсанды
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Функция для безопасного форматирования текста (убираем только опасные символы)
function safeText($text) {
    // Убираем только потенциально опасные символы, но оставляем обычные символы
    return trim($text);
}

// Защита от спама: проверка honeypot поля
$honeypot = isset($_POST['website']) ? trim($_POST['website']) : '';
if (!empty($honeypot)) {
    // Если honeypot заполнен - это бот, блокируем
    logMessage('SPAM DETECTED: Honeypot field filled. IP: ' . getClientIP());
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'message' => 'Доступ запрещен'
    ]);
    exit;
}

// Защита от спама: проверка времени между отправками
$lastSubmitTime = $_SESSION['last_form_submit_time'] ?? 0;
$currentTime = time();
$timeSinceLastSubmit = $currentTime - $lastSubmitTime;

if ($timeSinceLastSubmit < TELEGRAM_MIN_SEND_INTERVAL) {
    $remainingTime = TELEGRAM_MIN_SEND_INTERVAL - $timeSinceLastSubmit;
    logMessage('SPAM PROTECTION: Too frequent submission. IP: ' . getClientIP() . ', Remaining: ' . $remainingTime . 's');
    http_response_code(429);
    echo json_encode([
        'success' => false,
        'message' => 'Пожалуйста, подождите ' . $remainingTime . ' секунд перед повторной отправкой'
    ]);
    exit;
}

// Получаем данные из формы
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$service = isset($_POST['service']) ? trim($_POST['service']) : '';
$type = isset($_POST['type']) ? trim($_POST['type']) : 'contact'; // 'contact' или 'vacancy'
$vacancy = isset($_POST['vacancy']) ? trim($_POST['vacancy']) : '';
$formName = isset($_POST['form_name']) ? trim($_POST['form_name']) : '';

// Валидация данных
$errors = [];

if (empty($name)) {
    $errors[] = 'Имя обязательно для заполнения';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Введите корректный email адрес';
}

if (empty($phone)) {
    $errors[] = 'Телефон обязателен для заполнения';
} else {
    // Валидация формата телефона (российский формат)
    $cleanPhone = preg_replace('/[\s\-\(\)]/', '', $phone);
    // Проверяем формат: +7 или 7 или 8, затем 10 цифр
    if (!preg_match('/^(\+?7|8)?[0-9]{10}$/', $cleanPhone) || strlen($cleanPhone) < 10) {
        $errors[] = 'Введите корректный номер телефона (например: +7 700 123 45 67)';
    }
}

if (empty($message)) {
    $errors[] = 'Сообщение обязательно для заполнения';
}

// Если есть ошибки валидации, возвращаем их
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => implode(', ', $errors)
    ]);
    exit;
}

// Подготавливаем данные
$timestamp = date('Y-m-d H:i:s');
$ip = getClientIP();

// Определяем название формы
if (empty($formName)) {
    if ($type === 'vacancy' && !empty($vacancy)) {
        $formName = 'Отклик на вакансию: ' . $vacancy;
    } else {
        $formName = 'Форма обратной связи';
        if (!empty($service)) {
            $formName .= ' - ' . $service;
        }
    }
}

// Формируем сообщение для Telegram с HTML форматированием (более читаемо, без лишних слэшей)
// Экранируем только HTML теги для безопасности, но оставляем обычные символы как есть
$telegramMessage = "🔔 <b>Новая заявка с сайта</b>\n\n";
$telegramMessage .= "📋 <b>Форма:</b> " . escapeHtml($formName) . "\n\n";
$telegramMessage .= "👤 <b>Имя:</b> " . escapeHtml($name) . "\n";
$telegramMessage .= "📧 <b>Email:</b> " . escapeHtml($email) . "\n";
$telegramMessage .= "📱 <b>Телефон:</b> " . escapeHtml($phone) . "\n";

if ($type === 'vacancy' && !empty($vacancy)) {
    $telegramMessage .= "💼 <b>Вакансия:</b> " . escapeHtml($vacancy) . "\n";
} elseif (!empty($service)) {
    $telegramMessage .= "🎯 <b>Услуга:</b> " . escapeHtml($service) . "\n";
}

$telegramMessage .= "\n💬 <b>Сообщение:</b>\n" . escapeHtml($message) . "\n\n";
$telegramMessage .= "━━━━━━━━━━━━━━━━━━━━\n";
$telegramMessage .= "🌐 <b>IP адрес:</b> <code>" . escapeHtml($ip) . "</code>\n";
$telegramMessage .= "🕐 <b>Время:</b> " . escapeHtml($timestamp) . "\n";

// Получаем Chat ID (если не указан в конфиге, пытаемся получить автоматически)
// Проверяем, определена ли константа
if (!defined('TELEGRAM_CHAT_ID')) {
    logMessage('ERROR: TELEGRAM_CHAT_ID constant not defined');
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка конфигурации: TELEGRAM_CHAT_ID не определен'
    ]);
    exit;
}

$chatId = TELEGRAM_CHAT_ID;

// Логируем полученный Chat ID для отладки
logMessage('DEBUG: Chat ID from config: ' . var_export($chatId, true) . ' (type: ' . gettype($chatId) . ')');

if (empty($chatId)) {
    logMessage('WARNING: Chat ID not set in config, trying to get automatically');
    // Пытаемся получить Chat ID автоматически из последних обновлений
    $apiUrl = TELEGRAM_API_URL . 'getUpdates';
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    
    $response = curl_exec($ch);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if ($response === false || !empty($curlError)) {
        logMessage('ERROR: Failed to get updates: ' . $curlError);
    } else {
        $data = json_decode($response, true);
        if ($data && isset($data['ok']) && $data['ok'] && !empty($data['result'])) {
            $lastUpdate = end($data['result']);
            if (isset($lastUpdate['message']['chat']['id'])) {
                $chatId = $lastUpdate['message']['chat']['id'];
                logMessage('SUCCESS: Auto-detected Chat ID: ' . $chatId);
            } else {
                logMessage('ERROR: No chat ID found in updates');
            }
        } else {
            logMessage('ERROR: Invalid response from getUpdates: ' . ($response ?: 'empty'));
        }
    }
}

if (empty($chatId)) {
    logMessage('ERROR: Chat ID not configured. Please set TELEGRAM_CHAT_ID in telegram_config.php');
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка конфигурации. Пожалуйста, свяжитесь с администратором.'
    ]);
    exit;
}

logMessage('DEBUG: Using Chat ID: ' . $chatId);

// Отправляем сообщение в Telegram
$apiUrl = TELEGRAM_API_URL . 'sendMessage';
$postData = [
    'chat_id' => $chatId,
    'text' => $telegramMessage,
    'parse_mode' => 'HTML',
    'disable_web_page_preview' => true
];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($postData))
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// Проверяем ошибки curl
if ($response === false || !empty($curlError)) {
    logMessage('ERROR: cURL error - ' . $curlError);
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка соединения с сервером. Пожалуйста, попробуйте позже.'
    ]);
    exit;
}

$responseData = json_decode($response, true);

// Логируем полный ответ для отладки
logMessage('DEBUG: Telegram API response - HTTP: ' . $httpCode . ', Response: ' . substr($response, 0, 500));

if ($httpCode !== 200 || !$responseData || !isset($responseData['ok']) || !$responseData['ok']) {
    $errorMessage = $responseData['description'] ?? 'Неизвестная ошибка';
    $errorCode = $responseData['error_code'] ?? 0;
    
    // Логируем детали ошибки
    logMessage('ERROR: Telegram API error - Code: ' . $errorCode . ', Message: ' . $errorMessage . ', Full response: ' . json_encode($responseData));
    
    // Обработка миграции группы в супергруппу
    if ($errorCode === 400 && isset($responseData['parameters']['migrate_to_chat_id'])) {
        $newChatId = $responseData['parameters']['migrate_to_chat_id'];
        logMessage('WARNING: Group migrated to supergroup. New Chat ID: ' . $newChatId);
        
        // Пытаемся отправить с новым Chat ID
        $postData['chat_id'] = $newChatId;
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($postData))
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $responseData = json_decode($response, true);
        
        if ($httpCode === 200 && $responseData && isset($responseData['ok']) && $responseData['ok']) {
            logMessage('SUCCESS: Message sent with migrated Chat ID: ' . $newChatId);
            // Продолжаем выполнение - сообщение отправлено успешно
        } else {
            logMessage('ERROR sending to Telegram after migration: ' . ($responseData['description'] ?? 'Unknown error') . ' | HTTP: ' . $httpCode);
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Ошибка при отправке заявки. Пожалуйста, попробуйте позже или свяжитесь с нами напрямую.'
            ]);
            exit;
        }
    } else {
        // Если ошибка парсинга Markdown, пробуем отправить без форматирования
        if ($errorCode === 400 && (strpos($errorMessage, 'parse') !== false || strpos($errorMessage, 'Markdown') !== false)) {
            logMessage('WARNING: Markdown parse error, retrying without parse_mode');
            
            // Формируем сообщение без Markdown форматирования
            $plainMessage = "🔔 Новая заявка с сайта\n\n";
            $plainMessage .= "📋 Форма: " . $formName . "\n\n";
            $plainMessage .= "👤 Имя: " . $name . "\n";
            $plainMessage .= "📧 Email: " . $email . "\n";
            $plainMessage .= "📱 Телефон: " . $phone . "\n";
            
            if ($type === 'vacancy' && !empty($vacancy)) {
                $plainMessage .= "💼 Вакансия: " . $vacancy . "\n";
            } elseif (!empty($service)) {
                $plainMessage .= "🎯 Услуга: " . $service . "\n";
            }
            
            $plainMessage .= "\n💬 Сообщение:\n" . $message . "\n\n";
            $plainMessage .= "━━━━━━━━━━━━━━━━━━━━\n";
            $plainMessage .= "🌐 IP адрес: " . $ip . "\n";
            $plainMessage .= "🕐 Время: " . $timestamp . "\n";
            
            $postDataPlain = [
                'chat_id' => $chatId,
                'text' => $plainMessage,
                'disable_web_page_preview' => true
            ];
            
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postDataPlain));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($postDataPlain))
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            $responseData = json_decode($response, true);
            
            if ($httpCode === 200 && $responseData && isset($responseData['ok']) && $responseData['ok']) {
                logMessage('SUCCESS: Message sent without Markdown formatting');
                // Продолжаем выполнение - сообщение отправлено успешно
            } else {
                logMessage('ERROR sending to Telegram (plain text): ' . ($responseData['description'] ?? 'Unknown error') . ' | HTTP: ' . $httpCode);
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'Ошибка при отправке заявки. Пожалуйста, попробуйте позже или свяжитесь с нами напрямую.'
                ]);
                exit;
            }
        } else {
            logMessage('ERROR sending to Telegram: ' . $errorMessage . ' | HTTP: ' . $httpCode . ' | Error Code: ' . $errorCode);
            
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Ошибка при отправке заявки. Пожалуйста, попробуйте позже или свяжитесь с нами напрямую.'
            ]);
            exit;
        }
    }
}

// Сохраняем время последней отправки
$_SESSION['last_form_submit_time'] = $currentTime;

// Логируем успешную отправку
logMessage('SUCCESS: Form submitted. Name: ' . $name . ', Email: ' . $email . ', IP: ' . $ip);

// Возвращаем успешный результат
http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.'
]);
