<?php
/**
 * Скрипт для получения Chat ID из Telegram
 * 
 * ИСПОЛЬЗОВАНИЕ:
 * 1. Убедитесь, что токен указан в telegram_config.php
 * 2. Добавьте бота в группу/канал или начните диалог
 * 3. Отправьте любое сообщение боту
 * 4. Откройте этот файл в браузере
 * 5. Скопируйте найденный Chat ID в telegram_config.php
 */

require_once __DIR__ . '/telegram_config.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Получение Chat ID для Telegram бота</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #1a1a1a;
            color: #e0e0e0;
        }
        .container {
            background: #2a2a2a;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #444;
        }
        h1 {
            color: #667eea;
            margin-top: 0;
        }
        .info {
            background: #333;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .chat-id {
            background: #1a1a1a;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            font-family: monospace;
            font-size: 18px;
            color: #4ade80;
            word-break: break-all;
        }
        .error {
            background: #442222;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #ef4444;
            color: #fca5a5;
        }
        .success {
            background: #224422;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #4ade80;
            color: #86efac;
        }
        button {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background: #5568d3;
        }
        code {
            background: #1a1a1a;
            padding: 2px 6px;
            border-radius: 3px;
            color: #fbbf24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Получение Chat ID для Telegram бота</h1>
        
        <?php
        if (empty(TELEGRAM_BOT_TOKEN)) {
            echo '<div class="error">❌ Ошибка: Токен бота не указан в telegram_config.php</div>';
            exit;
        }
        
        $apiUrl = TELEGRAM_API_URL . 'getUpdates';
        
        // Получаем обновления от Telegram
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode !== 200) {
            echo '<div class="error">❌ Ошибка при подключении к Telegram API. HTTP код: ' . $httpCode . '</div>';
            echo '<div class="info">Проверьте правильность токена бота в telegram_config.php</div>';
            exit;
        }
        
        $data = json_decode($response, true);
        
        if (!$data || !isset($data['ok']) || !$data['ok']) {
            echo '<div class="error">❌ Ошибка: ' . ($data['description'] ?? 'Неизвестная ошибка') . '</div>';
            exit;
        }
        
        if (empty($data['result'])) {
            echo '<div class="info">📝 Инструкция:</div>';
            echo '<div class="info">';
            echo '<ol>';
            echo '<li>Добавьте бота в группу/канал или начните диалог с ботом</li>';
            echo '<li>Отправьте любое сообщение боту (например, "Привет")</li>';
            echo '<li>Обновите эту страницу</li>';
            echo '</ol>';
            echo '</div>';
            exit;
        }
        
        $chatIds = [];
        
        // Извлекаем все уникальные Chat ID из обновлений
        foreach ($data['result'] as $update) {
            if (isset($update['message']['chat']['id'])) {
                $chatId = $update['message']['chat']['id'];
                $chatTitle = $update['message']['chat']['title'] ?? $update['message']['chat']['first_name'] ?? 'Неизвестно';
                $chatType = $update['message']['chat']['type'] ?? 'unknown';
                
                if (!isset($chatIds[$chatId])) {
                    $chatIds[$chatId] = [
                        'title' => $chatTitle,
                        'type' => $chatType
                    ];
                }
            }
        }
        
        if (empty($chatIds)) {
            echo '<div class="info">📝 Не найдено сообщений. Отправьте сообщение боту и обновите страницу.</div>';
            exit;
        }
        
        echo '<div class="success">✅ Найдено ' . count($chatIds) . ' чат(ов):</div>';
        
        foreach ($chatIds as $chatId => $info) {
            $typeLabel = [
                'private' => 'Личный чат',
                'group' => 'Группа',
                'supergroup' => 'Супергруппа',
                'channel' => 'Канал'
            ];
            
            $typeName = $typeLabel[$info['type']] ?? $info['type'];
            
            echo '<div class="info">';
            echo '<strong>' . htmlspecialchars($info['title']) . '</strong><br>';
            echo 'Тип: ' . $typeName . '<br>';
            echo '<div class="chat-id">Chat ID: ' . $chatId . '</div>';
            echo '</div>';
        }
        
        // Показываем самый последний Chat ID как рекомендуемый
        $lastUpdate = end($data['result']);
        if (isset($lastUpdate['message']['chat']['id'])) {
            $recommendedChatId = $lastUpdate['message']['chat']['id'];
            echo '<div class="success">';
            echo '<strong>💡 Рекомендуемый Chat ID (последнее сообщение):</strong><br>';
            echo '<div class="chat-id">' . $recommendedChatId . '</div>';
            echo '<p>Скопируйте это значение и вставьте в <code>telegram_config.php</code> в константу <code>TELEGRAM_CHAT_ID</code></p>';
            echo '</div>';
        }
        ?>
        
        <button onclick="location.reload()">🔄 Обновить</button>
    </div>
</body>
</html>

