<?php
/**
 * Тестовый скрипт для проверки отправки формы в Telegram
 * 
 * Использование: откройте в браузере backend/test_form.php
 * Или запустите через командную строку: php backend/test_form.php
 */

// Симулируем POST данные формы
$_POST = [
    'name' => 'Тестовый пользователь',
    'email' => 'test@example.com',
    'phone' => '+7 777 123 45 67',
    'message' => 'Это тестовое сообщение для проверки отправки формы в Telegram',
    'service' => 'SEO-оптимизация',
    'type' => 'contact'
];

$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

echo "=== Тест отправки формы в Telegram ===\n\n";

echo "1. Симулируем данные формы:\n";
echo "   Имя: " . $_POST['name'] . "\n";
echo "   Email: " . $_POST['email'] . "\n";
echo "   Телефон: " . $_POST['phone'] . "\n";
echo "   Услуга: " . $_POST['service'] . "\n";
echo "   Сообщение: " . $_POST['message'] . "\n\n";

echo "2. Проверяем конфигурацию Telegram:\n";
require_once __DIR__ . '/../telegram_bot/config.php';
echo "   TELEGRAM_ENABLED: " . (TELEGRAM_ENABLED ? 'ДА' : 'НЕТ') . "\n";
echo "   TELEGRAM_BOT_TOKEN: " . (TELEGRAM_BOT_TOKEN !== 'YOUR_BOT_TOKEN_HERE' ? 'Настроен' : 'НЕ НАСТРОЕН') . "\n";
echo "   TELEGRAM_CHAT_ID: " . TELEGRAM_CHAT_ID . "\n\n";

echo "3. Подключаем функции отправки...\n";
require_once __DIR__ . '/../telegram_bot/send_telegram.php';

if (!function_exists('formatContactMessage') || !function_exists('sendTelegramMessage')) {
    echo "❌ ОШИБКА: Функции Telegram не найдены\n";
    exit;
}
echo "   ✅ Функции найдены\n\n";

echo "4. Форматируем сообщение...\n";
$data = [
    'timestamp' => date('Y-m-d H:i:s'),
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'message' => $_POST['message'],
    'service' => $_POST['service'],
    'ip' => $_SERVER['REMOTE_ADDR']
];

$telegramMessage = formatContactMessage($data);
echo "   Сообщение сформировано (длина: " . strlen($telegramMessage) . " символов)\n\n";

echo "5. Отправляем в Telegram...\n";
$result = sendTelegramMessage($telegramMessage, 'contact');

echo "\n6. Результат:\n";
if ($result['success']) {
    echo "✅ УСПЕХ: " . $result['message'] . "\n";
    echo "\nПроверьте группу в Telegram - сообщение должно прийти.\n";
} else {
    echo "❌ ОШИБКА: " . $result['message'] . "\n";
    echo "\nВозможные причины:\n";
    echo "- Неправильный Chat ID\n";
    echo "- Бот не добавлен в группу\n";
    echo "- Бот не имеет прав на отправку сообщений\n";
}

echo "\n7. Проверяем логи:\n";
$logFile = __DIR__ . '/telegram_errors.log';
if (file_exists($logFile)) {
    echo "   Файл логов существует: " . $logFile . "\n";
    $logContent = file_get_contents($logFile);
    $lines = explode("\n", $logContent);
    $recentLines = array_slice($lines, -5); // Последние 5 строк
    echo "   Последние записи:\n";
    foreach ($recentLines as $line) {
        if (trim($line)) {
            echo "   " . $line . "\n";
        }
    }
} else {
    echo "   Файл логов не найден (будет создан при первой отправке)\n";
}

echo "\n=== Конец теста ===\n";

