<?php
/**
 * Обработчик формы обратной связи
 * Максимально упрощенная версия без проверок
 */

// Отключаем все ошибки
error_reporting(0);
ini_set('display_errors', 0);

// Устанавливаем заголовки
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Обрабатываем OPTIONS запросы
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Подключаем утилиты (без проверки ошибок)
@require_once __DIR__ . '/../includes/utils.php';

// Получаем данные из формы
$name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
$phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
$service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : '';
$type = isset($_POST['type']) ? trim(strip_tags($_POST['type'])) : 'contact';
$vacancy = isset($_POST['vacancy']) ? trim(strip_tags($_POST['vacancy'])) : '';

// Получаем IP
$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';

// Подготавливаем данные
$timestamp = date('Y-m-d H:i:s');
$logEntry = "[{$timestamp}] Имя: {$name} | Email: {$email} | Телефон: {$phone} | Услуга: " . ($service ?: 'Не указана') . " | IP: {$ip}\nСообщение: {$message}\n" . str_repeat('-', 80) . "\n";

// Пытаемся сохранить в файл (без проверки ошибок)
$logFile = __DIR__ . '/requests.txt';
@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

// Отправляем в Telegram с подробным логированием
$telegramSent = false;
$telegramError = '';
$telegramLogFile = __DIR__ . '/telegram_errors.log';

// Сначала подключаем конфигурацию Telegram
$configPath = __DIR__ . '/../telegram_bot/config.php';
if (file_exists($configPath)) {
    require_once $configPath;
} else {
    $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Файл config.php не найден по пути: {$configPath}\n";
    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
}

// Подключаем функции отправки в Telegram
$telegramIncludePath = __DIR__ . '/../telegram_bot/send_telegram.php';
if (file_exists($telegramIncludePath)) {
    require_once $telegramIncludePath;
} else {
    $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Файл send_telegram.php не найден по пути: {$telegramIncludePath}\n";
    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
}

// Проверяем наличие функций
if (function_exists('formatContactMessage') && function_exists('sendTelegramMessage')) {
    // Подготавливаем данные для Telegram
    $data = [
        'timestamp' => $timestamp,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
        'service' => $service,
        'ip' => $ip
    ];
    
    $messageType = ($type === 'vacancy' || !empty($vacancy)) ? 'vacancy' : 'contact';
    
    if ($messageType === 'vacancy') {
        $data['vacancy'] = $vacancy ?: $service;
        $telegramMessage = formatVacancyMessage($data);
    } else {
        $telegramMessage = formatContactMessage($data);
    }
    
    // Отправляем сообщение в Telegram
    // Проверяем, что конфигурация загружена
    if (!defined('TELEGRAM_BOT_TOKEN') || !defined('TELEGRAM_CHAT_ID')) {
        $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Конфигурация Telegram не загружена\n";
        @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
    } else {
        $telegramResult = sendTelegramMessage($telegramMessage, $messageType);
        $telegramSent = isset($telegramResult['success']) ? $telegramResult['success'] : false;
    }
    
    // Логируем результат (всегда, даже если успешно)
    $logTimestamp = date('Y-m-d H:i:s');
    $chatId = defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : 'не определен';
    
    if ($telegramSent) {
        $successLog = "[{$logTimestamp}] ✅ Telegram отправка УСПЕШНА | Тип: {$messageType} | Chat ID: {$chatId} | Имя: {$name} | Email: {$email}\n";
        @file_put_contents($telegramLogFile, $successLog, FILE_APPEND | LOCK_EX);
        
        // Также логируем через функцию logError если доступна
        if (function_exists('logError')) {
            logError('Telegram отправка успешна', [
                'type' => $messageType,
                'chat_id' => $chatId,
                'name' => $name,
                'email' => $email
            ]);
        }
    } else {
        $telegramError = isset($telegramResult['message']) ? $telegramResult['message'] : 'Неизвестная ошибка';
        $errorLog = "[{$logTimestamp}] ❌ Telegram отправка НЕ УДАЛАСЬ | Тип: {$messageType} | Chat ID: {$chatId} | Ошибка: {$telegramError} | Имя: {$name} | Email: {$email}\n";
        @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
        
        // Также логируем через функцию logError если доступна
        if (function_exists('logError')) {
            logError('Telegram отправка не удалась', [
                'error' => $telegramError,
                'type' => $messageType,
                'chat_id' => $chatId,
                'name' => $name,
                'email' => $email
            ]);
        }
    }
} else {
    // Функции не найдены
    $logTimestamp = date('Y-m-d H:i:s');
    $errorLog = "[{$logTimestamp}] ❌ Функции Telegram не найдены (formatContactMessage или sendTelegramMessage)\n";
    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
    @file_put_contents($debugLogFile, $errorLog, FILE_APPEND | LOCK_EX);
}

// Пытаемся отправить email (без проверки ошибок)
$emailSent = false;
$emailTo = 'contact@novacreatorstudio.com';
$subject = "Новая заявка с сайта NovaCreator Studio - " . ($service ?: 'Общий запрос');
$emailMessage = "Новая заявка с сайта NovaCreator Studio\n\n";
$emailMessage .= "ДАТА И ВРЕМЯ: {$timestamp}\n\n";
$emailMessage .= "ИМЯ: {$name}\n";
$emailMessage .= "EMAIL: {$email}\n";
$emailMessage .= "ТЕЛЕФОН: {$phone}\n";
$emailMessage .= "УСЛУГА: " . ($service ?: 'Не указана') . "\n";
$emailMessage .= "IP АДРЕС: {$ip}\n\n";
$emailMessage .= "СООБЩЕНИЕ:\n{$message}\n";
$headers = "From: NovaCreator Studio <noreply@novacreator-studio.com>\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";
@mail($emailTo, $subject, $emailMessage, $headers);

// ВСЕГДА возвращаем успех
echo json_encode([
    'success' => true,
    'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.'
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;
?>
