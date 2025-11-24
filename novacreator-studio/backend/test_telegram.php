<?php
/**
 * Тестовый скрипт для проверки отправки сообщений в Telegram
 * Откройте в браузере: /backend/test_telegram.php
 */

// Подключаем необходимые файлы
require_once __DIR__ . '/send.php';

// Но нам нужно использовать функции напрямую, поэтому подключим их отдельно
$telegramIncludePath = __DIR__ . '/../telegram_bot/send_telegram.php';
if (file_exists($telegramIncludePath)) {
    require_once $telegramIncludePath;
} else {
    die("❌ Файл send_telegram.php не найден: {$telegramIncludePath}");
}

// Устанавливаем конфигурацию если не загружена
if (!defined('TELEGRAM_BOT_TOKEN')) {
    define('TELEGRAM_BOT_TOKEN', '8581188166:AAH2MQ-RYJO2dCOooehOhj_jbLKm7wnkKQo');
}
if (!defined('TELEGRAM_CHAT_ID')) {
    define('TELEGRAM_CHAT_ID', '-1003319377711');
}
if (!defined('TELEGRAM_ENABLED')) {
    define('TELEGRAM_ENABLED', true);
}

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
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #1a1a1a;
            color: #fff;
        }
        .success { background: #4CAF50; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f44336; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { background: #2196F3; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .config { background: #333; padding: 15px; border-radius: 5px; margin: 10px 0; font-family: monospace; }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
        }
        button:hover { background: #45a049; }
        button.danger { background: #f44336; }
        button.danger:hover { background: #da190b; }
    </style>
</head>
<body>
    <h1>🧪 Тест отправки сообщений в Telegram</h1>
    
    <?php
    // Показываем конфигурацию
    echo '<div class="config">';
    echo '<strong>Текущая конфигурация:</strong><br>';
    echo 'TELEGRAM_ENABLED: ' . (TELEGRAM_ENABLED ? '✅ ДА' : '❌ НЕТ') . '<br>';
    echo 'TELEGRAM_BOT_TOKEN: ' . (TELEGRAM_BOT_TOKEN !== 'YOUR_BOT_TOKEN_HERE' ? '✅ Настроен (' . substr(TELEGRAM_BOT_TOKEN, 0, 10) . '...)' : '❌ НЕ НАСТРОЕН') . '<br>';
    echo 'TELEGRAM_CHAT_ID: ' . TELEGRAM_CHAT_ID . '<br>';
    echo '</div>';
    
    // Проверяем, была ли отправка
    if (isset($_GET['send']) && $_GET['send'] === 'test') {
        echo '<div class="info">📤 Отправка тестового сообщения...</div>';
        
        // Формируем тестовое сообщение
        $testMessage = "🧪 <b>Тестовое сообщение</b>\n\n";
        $testMessage .= "Это тестовое сообщение для проверки работы Telegram бота.\n\n";
        $testMessage .= "✅ Если вы видите это сообщение, значит всё работает правильно!\n\n";
        $testMessage .= "🕐 Время отправки: " . date('Y-m-d H:i:s');
        
        // Отправляем
        $result = sendTelegramMessage($testMessage, 'contact');
        
        if ($result['success']) {
            echo '<div class="success">';
            echo '✅ <strong>УСПЕХ!</strong><br>';
            echo $result['message'] . '<br>';
            echo 'Проверьте группу в Telegram - сообщение должно прийти.';
            echo '</div>';
        } else {
            echo '<div class="error">';
            echo '❌ <strong>ОШИБКА:</strong><br>';
            echo $result['message'] . '<br><br>';
            echo '<strong>Возможные причины:</strong><br>';
            echo '- Бот не добавлен в группу<br>';
            echo '- Неправильный Chat ID группы<br>';
            echo '- Бот не имеет прав на отправку сообщений<br>';
            echo '- Проблемы с интернет-соединением';
            echo '</div>';
        }
    }
    
    // Проверяем отправку через форму (имитация реальной заявки)
    if (isset($_GET['send']) && $_GET['send'] === 'form') {
        echo '<div class="info">📤 Отправка тестовой заявки через форму...</div>';
        
        // Имитируем данные формы
        $testData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'name' => 'Тестовый пользователь',
            'email' => 'test@example.com',
            'phone' => '+7 777 123 45 67',
            'message' => 'Это тестовая заявка для проверки отправки через форму.',
            'service' => 'SEO-оптимизация',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];
        
        // Форматируем сообщение
        $telegramMessage = formatContactMessage($testData);
        
        // Отправляем
        $result = sendTelegramMessage($telegramMessage, 'contact');
        
        if ($result['success']) {
            echo '<div class="success">';
            echo '✅ <strong>УСПЕХ!</strong><br>';
            echo 'Тестовая заявка успешно отправлена в Telegram.<br>';
            echo 'Проверьте группу - должно прийти сообщение с данными заявки.';
            echo '</div>';
        } else {
            echo '<div class="error">';
            echo '❌ <strong>ОШИБКА:</strong><br>';
            echo $result['message'];
            echo '</div>';
        }
    }
    ?>
    
    <div style="margin-top: 30px;">
        <h2>Выберите тип теста:</h2>
        
        <form method="GET" style="display: inline;">
            <button type="submit" name="send" value="test">
                📧 Отправить простое тестовое сообщение
            </button>
        </form>
        
        <form method="GET" style="display: inline;">
            <button type="submit" name="send" value="form">
                📝 Отправить тестовую заявку (как из формы)
            </button>
        </form>
        
        <a href="test_telegram.php">
            <button type="button" class="danger">
                🔄 Обновить страницу
            </button>
        </a>
    </div>
    
    <div style="margin-top: 30px; padding: 15px; background: #2a2a2a; border-radius: 5px;">
        <h3>📋 Инструкция:</h3>
        <ol>
            <li>Нажмите кнопку "Отправить простое тестовое сообщение" для базовой проверки</li>
            <li>Или "Отправить тестовую заявку" для проверки полного функционала формы</li>
            <li>Проверьте группу в Telegram - сообщение должно прийти</li>
            <li>Если сообщение не пришло, проверьте логи в <code>backend/telegram_errors.log</code></li>
        </ol>
    </div>
    
    <div style="margin-top: 20px; padding: 15px; background: #2a2a2a; border-radius: 5px;">
        <h3>🔍 Проверка конфигурации:</h3>
        <ul>
            <li>✅ Бот должен быть добавлен в группу</li>
            <li>✅ Chat ID должен быть правильным (для групп начинается с минуса: -100...)</li>
            <li>✅ Бот должен иметь права на отправку сообщений</li>
        </ul>
    </div>
</body>
</html>

