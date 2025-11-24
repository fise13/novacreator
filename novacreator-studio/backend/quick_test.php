<?php
/**
 * Быстрый тест отправки в Telegram
 * Откройте в браузере: /backend/quick_test.php
 */

// Устанавливаем конфигурацию
if (!defined('TELEGRAM_BOT_TOKEN')) {
    define('TELEGRAM_BOT_TOKEN', '8581188166:AAH2MQ-RYJO2dCOooehOhj_jbLKm7wnkKQo');
}
if (!defined('TELEGRAM_CHAT_ID')) {
    define('TELEGRAM_CHAT_ID', '-1003319377711');
}
if (!defined('TELEGRAM_ENABLED')) {
    define('TELEGRAM_ENABLED', true);
}

// Подключаем функции отправки
$telegramIncludePath = __DIR__ . '/../telegram_bot/send_telegram.php';
if (file_exists($telegramIncludePath)) {
    require_once $telegramIncludePath;
} else {
    die("❌ Файл send_telegram.php не найден");
}

// Формируем тестовое сообщение
$testMessage = "🧪 <b>Тестовое сообщение</b>\n\n";
$testMessage .= "Это тестовое сообщение для проверки работы Telegram бота.\n\n";
$testMessage .= "✅ Если вы видите это сообщение, значит всё работает правильно!\n\n";
$testMessage .= "🕐 Время отправки: " . date('Y-m-d H:i:s');

// Отправляем с детальным логированием
$result = sendTelegramMessage($testMessage, 'contact');

// Дополнительная диагностика
$debugInfo = [];
$debugInfo['config_loaded'] = defined('TELEGRAM_BOT_TOKEN') && defined('TELEGRAM_CHAT_ID');
$debugInfo['bot_token'] = defined('TELEGRAM_BOT_TOKEN') ? substr(TELEGRAM_BOT_TOKEN, 0, 10) . '...' : 'НЕ ОПРЕДЕЛЕН';
$debugInfo['chat_id'] = defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : 'НЕ ОПРЕДЕЛЕН';
$debugInfo['enabled'] = defined('TELEGRAM_ENABLED') ? (TELEGRAM_ENABLED ? 'ДА' : 'НЕТ') : 'НЕ ОПРЕДЕЛЕН';
$debugInfo['curl_available'] = function_exists('curl_init') ? 'ДА' : 'НЕТ';
$debugInfo['message_length'] = strlen($testMessage);

// Выводим результат
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Быстрый тест Telegram</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #1a1a1a;
            color: #fff;
        }
        .success {
            background: #4CAF50;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
        }
        .error {
            background: #f44336;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
        }
        .info {
            background: #2196F3;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        code {
            background: #333;
            padding: 2px 6px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>🧪 Быстрый тест отправки в Telegram</h1>
    
    <?php if ($result['success']): ?>
        <div class="success">
            ✅ <strong>УСПЕХ!</strong><br><br>
            Сообщение успешно отправлено в Telegram группу.<br><br>
            Проверьте группу - сообщение должно прийти!
        </div>
        
        <div class="info">
            <strong>Детали отправки:</strong><br>
            Chat ID: <code><?php echo TELEGRAM_CHAT_ID; ?></code><br>
            Bot Token: <code><?php echo substr(TELEGRAM_BOT_TOKEN, 0, 10); ?>...</code><br>
            Время: <?php echo date('Y-m-d H:i:s'); ?><br>
            Длина сообщения: <?php echo $debugInfo['message_length']; ?> символов<br>
            cURL доступен: <?php echo $debugInfo['curl_available']; ?>
        </div>
    <?php else: ?>
        <div class="error">
            ❌ <strong>ОШИБКА</strong><br><br>
            <?php echo htmlspecialchars($result['message']); ?>
        </div>
        
        <div class="info">
            <strong>Диагностическая информация:</strong><br>
            Конфигурация загружена: <?php echo $debugInfo['config_loaded'] ? '✅ ДА' : '❌ НЕТ'; ?><br>
            Bot Token: <?php echo $debugInfo['bot_token']; ?><br>
            Chat ID: <?php echo $debugInfo['chat_id']; ?><br>
            Telegram Enabled: <?php echo $debugInfo['enabled']; ?><br>
            cURL доступен: <?php echo $debugInfo['curl_available']; ?><br>
            Длина сообщения: <?php echo $debugInfo['message_length']; ?> символов<br><br>
            
            <strong>Возможные причины:</strong><br>
            • Бот не добавлен в группу<br>
            • Неправильный Chat ID группы<br>
            • Бот не имеет прав на отправку сообщений<br>
            • Проблемы с интернет-соединением<br>
            • Неверный токен бота<br><br>
            
            <strong>Проверьте:</strong><br>
            1. Добавлен ли бот в группу<br>
            2. Правильный ли Chat ID (для групп начинается с <code>-100</code>)<br>
            3. Может ли бот отправлять сообщения<br>
            4. Логи в <code>backend/telegram_errors.log</code><br>
            5. Детальные логи в <code>backend/telegram_debug.log</code>
        </div>
    <?php endif; ?>
    
    <div style="margin-top: 30px; text-align: center;">
        <a href="quick_test.php" style="color: #4CAF50; text-decoration: none;">
            🔄 Попробовать снова
        </a>
    </div>
</body>
</html>

