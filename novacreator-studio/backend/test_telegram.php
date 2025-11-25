<?php
/**
 * Тестовый скрипт для проверки отправки в Telegram
 * Используйте этот файл для диагностики проблем
 */

// Подключаем конфигурацию
require_once __DIR__ . '/telegram_config.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест отправки в Telegram</title>
    <style>
        body {
            font-family: monospace;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #1a1a1a;
            color: #e0e0e0;
        }
        .success { color: #4ade80; }
        .error { color: #ef4444; }
        .warning { color: #fbbf24; }
        .info { color: #60a5fa; }
        pre {
            background: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <h1>🔍 Тест отправки в Telegram</h1>
    
    <?php
    echo "<h2>1. Проверка конфигурации</h2>";
    
    // Проверка токена
    if (defined('TELEGRAM_BOT_TOKEN')) {
        $token = TELEGRAM_BOT_TOKEN;
        echo "<p class='success'>✓ TELEGRAM_BOT_TOKEN определен</p>";
        echo "<p class='info'>Токен: " . substr($token, 0, 20) . "...</p>";
    } else {
        echo "<p class='error'>✗ TELEGRAM_BOT_TOKEN не определен</p>";
    }
    
    // Проверка Chat ID
    if (defined('TELEGRAM_CHAT_ID')) {
        $chatId = TELEGRAM_CHAT_ID;
        echo "<p class='success'>✓ TELEGRAM_CHAT_ID определен</p>";
        echo "<p class='info'>Chat ID: " . var_export($chatId, true) . "</p>";
        echo "<p class='info'>Тип: " . gettype($chatId) . "</p>";
        echo "<p class='info'>Пустое: " . (empty($chatId) ? 'ДА' : 'НЕТ') . "</p>";
    } else {
        echo "<p class='error'>✗ TELEGRAM_CHAT_ID не определен</p>";
    }
    
    // Проверка API URL
    if (defined('TELEGRAM_API_URL')) {
        echo "<p class='success'>✓ TELEGRAM_API_URL определен</p>";
        echo "<p class='info'>URL: " . TELEGRAM_API_URL . "</p>";
    } else {
        echo "<p class='error'>✗ TELEGRAM_API_URL не определен</p>";
    }
    
    echo "<h2>2. Проверка подключения к Telegram API</h2>";
    
    // Тест getMe
    $apiUrl = TELEGRAM_API_URL . 'getMe';
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if ($response === false || !empty($curlError)) {
        echo "<p class='error'>✗ Ошибка подключения: " . htmlspecialchars($curlError) . "</p>";
    } else {
        echo "<p class='success'>✓ Подключение успешно (HTTP: $httpCode)</p>";
        $data = json_decode($response, true);
        if ($data && isset($data['ok']) && $data['ok']) {
            echo "<p class='success'>✓ Бот найден: " . htmlspecialchars($data['result']['first_name']) . " (@" . htmlspecialchars($data['result']['username']) . ")</p>";
        } else {
            echo "<p class='error'>✗ Ошибка API: " . htmlspecialchars($response) . "</p>";
        }
    }
    
    echo "<h2>3. Проверка Chat ID</h2>";
    
    if (!empty($chatId)) {
        // Проверяем доступность чата
        $apiUrl = TELEGRAM_API_URL . 'getChat';
        $postData = ['chat_id' => $chatId];
        
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $data = json_decode($response, true);
        if ($data && isset($data['ok']) && $data['ok']) {
            echo "<p class='success'>✓ Чат доступен</p>";
            echo "<p class='info'>Название: " . htmlspecialchars($data['result']['title'] ?? 'N/A') . "</p>";
            echo "<p class='info'>Тип: " . htmlspecialchars($data['result']['type'] ?? 'N/A') . "</p>";
        } else {
            echo "<p class='error'>✗ Чат недоступен</p>";
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
        }
    } else {
        echo "<p class='warning'>⚠ Chat ID не указан, пропускаем проверку</p>";
    }
    
    echo "<h2>4. Тестовая отправка сообщения</h2>";
    
    if (!empty($chatId)) {
        $testMessage = "🧪 Тестовое сообщение\n\nВремя: " . date('Y-m-d H:i:s');
        $apiUrl = TELEGRAM_API_URL . 'sendMessage';
        $postData = [
            'chat_id' => $chatId,
            'text' => $testMessage,
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
        
        if ($response === false || !empty($curlError)) {
            echo "<p class='error'>✗ Ошибка отправки: " . htmlspecialchars($curlError) . "</p>";
        } else {
            $data = json_decode($response, true);
            if ($data && isset($data['ok']) && $data['ok']) {
                echo "<p class='success'>✓ Сообщение успешно отправлено!</p>";
                echo "<p class='info'>Message ID: " . $data['result']['message_id'] . "</p>";
            } else {
                echo "<p class='error'>✗ Ошибка отправки</p>";
                echo "<pre>" . htmlspecialchars(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
            }
        }
    } else {
        echo "<p class='warning'>⚠ Chat ID не указан, пропускаем тест отправки</p>";
    }
    
    echo "<h2>5. Информация о сервере</h2>";
    echo "<p class='info'>PHP версия: " . phpversion() . "</p>";
    echo "<p class='info'>cURL доступен: " . (function_exists('curl_init') ? 'ДА' : 'НЕТ') . "</p>";
    echo "<p class='info'>Путь к конфигу: " . __DIR__ . '/telegram_config.php' . "</p>";
    echo "<p class='info'>Конфиг существует: " . (file_exists(__DIR__ . '/telegram_config.php') ? 'ДА' : 'НЕТ') . "</p>";
    ?>
    
    <hr>
    <p><a href="/backend/send.php" style="color: #60a5fa;">Вернуться к обработчику форм</a></p>
</body>
</html>

