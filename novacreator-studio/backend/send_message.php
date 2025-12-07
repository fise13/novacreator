<?php
/**
 * Обработчик отправки сообщений из личного кабинета в Telegram
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';

startSecureSession();

// Устанавливаем заголовок для JSON ответа
header('Content-Type: application/json; charset=utf-8');

// Обрабатываем только POST запросы
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Метод не разрешен'
    ]);
    exit;
}

// Проверяем авторизацию
$user = getAuthenticatedUser();
if (!$user) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Необходима авторизация'
    ]);
    exit;
}

// Проверяем CSRF токен
if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'message' => 'Не удалось подтвердить запрос. Обновите страницу и попробуйте снова.'
    ]);
    exit;
}

// Получаем данные сообщения
$message = trim($_POST['message'] ?? '');
$subject = trim($_POST['subject'] ?? 'Сообщение из личного кабинета');

if (empty($message)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Сообщение не может быть пустым'
    ]);
    exit;
}

// Подключаем конфигурацию Telegram
$configPath = __DIR__ . '/telegram_config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

// Определяем значения по умолчанию, если константы не определены
if (!defined('TELEGRAM_BOT_TOKEN')) {
    define('TELEGRAM_BOT_TOKEN', '8581188166:AAH2MQ-RYJO2dCOooehOhj_jbLKm7wnkKQo');
}
if (!defined('TELEGRAM_CHAT_ID')) {
    define('TELEGRAM_CHAT_ID', '-1003319377711');
}
if (!defined('TELEGRAM_API_URL')) {
    define('TELEGRAM_API_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/');
}

// Функция экранирования для HTML
function escapeHtml($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Формируем сообщение для Telegram
$telegramMessage = "💬 <b>Сообщение из личного кабинета</b>\n\n";
$telegramMessage .= "👤 <b>Пользователь:</b> " . escapeHtml($user['name']) . "\n";
$telegramMessage .= "📧 <b>Email:</b> " . escapeHtml($user['email']) . "\n";
$telegramMessage .= "📋 <b>Тема:</b> " . escapeHtml($subject) . "\n\n";
$telegramMessage .= "💬 <b>Сообщение:</b>\n" . escapeHtml($message) . "\n\n";
$telegramMessage .= "━━━━━━━━━━━━━━━━━━━━\n";
$telegramMessage .= "🕐 <b>Время:</b> " . escapeHtml(date('d.m.Y H:i')) . "\n";
$telegramMessage .= "🔗 <b>ID пользователя:</b> <code>" . escapeHtml((string)$user['id']) . "</code>\n";

$chatId = TELEGRAM_CHAT_ID;

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
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка соединения с сервером. Пожалуйста, попробуйте позже.'
    ]);
    exit;
}

$responseData = json_decode($response, true);

if ($httpCode !== 200 || !$responseData || !isset($responseData['ok']) || !$responseData['ok']) {
    // Пытаемся отправить без HTML форматирования
    $plainMessage = "💬 Сообщение из личного кабинета\n\n";
    $plainMessage .= "👤 Пользователь: " . $user['name'] . "\n";
    $plainMessage .= "📧 Email: " . $user['email'] . "\n";
    $plainMessage .= "📋 Тема: " . $subject . "\n\n";
    $plainMessage .= "💬 Сообщение:\n" . $message . "\n\n";
    $plainMessage .= "━━━━━━━━━━━━━━━━━━━━\n";
    $plainMessage .= "🕐 Время: " . date('d.m.Y H:i') . "\n";
    $plainMessage .= "🔗 ID пользователя: " . $user['id'] . "\n";
    
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
        echo json_encode([
            'success' => true,
            'message' => 'Сообщение успешно отправлено!'
        ]);
        exit;
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка при отправке сообщения. Пожалуйста, попробуйте позже.'
        ]);
        exit;
    }
}

// Успешная отправка
echo json_encode([
    'success' => true,
    'message' => 'Сообщение успешно отправлено!'
]);

