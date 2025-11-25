<?php
/**
 * Обработчик формы обратной связи
 * Отправляет заявки в Telegram через Bot API
 */

// Подключаем конфигурацию Telegram
require_once __DIR__ . '/telegram_config.php';

// Устанавливаем заголовок для JSON ответа
header('Content-Type: application/json; charset=utf-8');

// Разрешаем CORS запросы
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

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
session_start();
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
    $errors[] = 'Введите корректный email';
}

if (empty($phone)) {
    $errors[] = 'Телефон обязателен для заполнения';
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

// Формируем сообщение для Telegram
$telegramMessage = "🔔 *Новая заявка с сайта*\n\n";
$telegramMessage .= "📋 *Форма:* " . $formName . "\n\n";
$telegramMessage .= "👤 *Имя:* " . $name . "\n";
$telegramMessage .= "📧 *Email:* " . $email . "\n";
$telegramMessage .= "📱 *Телефон:* " . $phone . "\n";

if ($type === 'vacancy' && !empty($vacancy)) {
    $telegramMessage .= "💼 *Вакансия:* " . $vacancy . "\n";
} elseif (!empty($service)) {
    $telegramMessage .= "🎯 *Услуга:* " . $service . "\n";
}

$telegramMessage .= "\n💬 *Сообщение:*\n" . $message . "\n\n";
$telegramMessage .= "━━━━━━━━━━━━━━━━━━━━\n";
$telegramMessage .= "🌐 *IP адрес:* `" . $ip . "`\n";
$telegramMessage .= "🕐 *Время:* " . $timestamp . "\n";

// Получаем Chat ID (если не указан в конфиге, пытаемся получить автоматически)
$chatId = TELEGRAM_CHAT_ID;

if (empty($chatId)) {
    // Пытаемся получить Chat ID автоматически из последних обновлений
    $apiUrl = TELEGRAM_API_URL . 'getUpdates';
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
    if ($data && isset($data['ok']) && $data['ok'] && !empty($data['result'])) {
        $lastUpdate = end($data['result']);
        if (isset($lastUpdate['message']['chat']['id'])) {
            $chatId = $lastUpdate['message']['chat']['id'];
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

// Отправляем сообщение в Telegram
$apiUrl = TELEGRAM_API_URL . 'sendMessage';
$postData = [
    'chat_id' => $chatId,
    'text' => $telegramMessage,
    'parse_mode' => 'Markdown',
    'disable_web_page_preview' => true
];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

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

if ($httpCode !== 200 || !$responseData || !isset($responseData['ok']) || !$responseData['ok']) {
    $errorMessage = $responseData['description'] ?? 'Неизвестная ошибка';
    $errorCode = $responseData['error_code'] ?? 0;
    
    // Обработка миграции группы в супергруппу
    if ($errorCode === 400 && isset($responseData['parameters']['migrate_to_chat_id'])) {
        $newChatId = $responseData['parameters']['migrate_to_chat_id'];
        logMessage('WARNING: Group migrated to supergroup. New Chat ID: ' . $newChatId);
        
        // Пытаемся отправить с новым Chat ID
        $postData['chat_id'] = $newChatId;
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
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
        logMessage('ERROR sending to Telegram: ' . $errorMessage . ' | HTTP: ' . $httpCode . ' | Error Code: ' . $errorCode);
        
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка при отправке заявки. Пожалуйста, попробуйте позже или свяжитесь с нами напрямую.'
        ]);
        exit;
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
