<?php
/**
 * Скрипт для получения Chat ID группы Telegram
 * 
 * Использование: откройте в браузере telegram_bot/get_chat_id.php
 * Или запустите через командную строку: php telegram_bot/get_chat_id.php
 * 
 * ИНСТРУКЦИЯ:
 * 1. Добавьте бота в группу (если еще не добавлен)
 * 2. Отправьте любое сообщение в группу
 * 3. Запустите этот скрипт
 * 4. Скрипт покажет все чаты, где бот получал сообщения, включая Chat ID группы
 */

// Подключаем конфигурацию
require_once __DIR__ . '/config.php';

echo "=== Получение Chat ID группы Telegram ===\n\n";

// Проверяем конфигурацию
if (TELEGRAM_BOT_TOKEN === 'YOUR_BOT_TOKEN_HERE') {
    echo "❌ ОШИБКА: Токен бота не настроен в config.php\n";
    echo "Получите токен у @BotFather и добавьте его в config.php\n";
    exit;
}

echo "Токен бота: " . substr(TELEGRAM_BOT_TOKEN, 0, 10) . "...\n";
echo "Текущий Chat ID в конфиге: " . (defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : 'не установлен') . "\n\n";

// URL для получения обновлений
$url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/getUpdates";

echo "Запрос обновлений у Telegram API...\n\n";

// Используем cURL
if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if ($curlError) {
        echo "❌ Ошибка cURL: " . $curlError . "\n";
        exit;
    }
    
    if ($httpCode !== 200) {
        echo "❌ HTTP ошибка: " . $httpCode . "\n";
        if ($result) {
            echo "Ответ: " . $result . "\n";
        }
        exit;
    }
} else {
    echo "❌ cURL не доступен. Используйте другой метод.\n";
    exit;
}

// Парсим ответ
$response = json_decode($result, true);

if (!$response || !isset($response['ok']) || !$response['ok']) {
    echo "❌ Ошибка получения данных от Telegram API\n";
    if (isset($response['description'])) {
        echo "Описание ошибки: " . $response['description'] . "\n";
    }
    echo "\nПолный ответ:\n";
    print_r($response);
    exit;
}

if (empty($response['result'])) {
    echo "⚠️  Бот еще не получал сообщений.\n\n";
    echo "Чтобы получить Chat ID группы:\n";
    echo "1. Добавьте бота в группу\n";
    echo "2. Отправьте любое сообщение в группу (можно просто '/start')\n";
    echo "3. Запустите этот скрипт снова\n";
    exit;
}

echo "✅ Найдено обновлений: " . count($response['result']) . "\n\n";

// Собираем уникальные чаты
$chats = [];

foreach ($response['result'] as $update) {
    if (isset($update['message']['chat'])) {
        $chat = $update['message']['chat'];
        $chatId = $chat['id'];
        
        // Сохраняем информацию о чате
        if (!isset($chats[$chatId])) {
            $chats[$chatId] = [
                'id' => $chatId,
                'type' => $chat['type'] ?? 'unknown',
                'title' => $chat['title'] ?? ($chat['first_name'] ?? 'Без названия'),
                'username' => $chat['username'] ?? null,
                'first_name' => $chat['first_name'] ?? null,
                'last_name' => $chat['last_name'] ?? null,
            ];
        }
    }
}

if (empty($chats)) {
    echo "⚠️  Не найдено чатов в обновлениях.\n";
    exit;
}

echo "=== Найденные чаты ===\n\n";

// Разделяем на группы и личные чаты
$groups = [];
$private = [];

foreach ($chats as $chatId => $chat) {
    if ($chat['type'] === 'group' || $chat['type'] === 'supergroup') {
        $groups[$chatId] = $chat;
    } else {
        $private[$chatId] = $chat;
    }
}

// Показываем группы (это то, что нужно)
if (!empty($groups)) {
    echo "📢 ГРУППЫ (используйте Chat ID с минусом):\n";
    echo str_repeat("=", 70) . "\n";
    
    foreach ($groups as $chatId => $chat) {
        echo "\n";
        echo "Chat ID: " . $chatId . "\n";
        echo "Название: " . $chat['title'] . "\n";
        echo "Тип: " . $chat['type'] . "\n";
        if ($chat['username']) {
            echo "Username: @" . $chat['username'] . "\n";
        }
        echo "\n";
        echo "👉 Используйте этот Chat ID в config.php:\n";
        echo "   define('TELEGRAM_CHAT_ID', '" . $chatId . "');\n";
        echo "\n" . str_repeat("-", 70) . "\n";
    }
} else {
    echo "⚠️  Группы не найдены.\n\n";
    echo "Убедитесь, что:\n";
    echo "1. Бот добавлен в группу\n";
    echo "2. В группу отправлено хотя бы одно сообщение\n";
    echo "3. Бот видит сообщения в группе\n\n";
}

// Показываем личные чаты (для справки)
if (!empty($private)) {
    echo "\n\n💬 ЛИЧНЫЕ ЧАТЫ (для справки):\n";
    echo str_repeat("=", 70) . "\n";
    
    foreach ($private as $chatId => $chat) {
        $name = ($chat['first_name'] ?? '') . ' ' . ($chat['last_name'] ?? '');
        $name = trim($name) ?: 'Без имени';
        echo "\nChat ID: " . $chatId . "\n";
        echo "Имя: " . $name . "\n";
        if ($chat['username']) {
            echo "Username: @" . $chat['username'] . "\n";
        }
        echo "\n" . str_repeat("-", 70) . "\n";
    }
}

echo "\n\n=== ИНСТРУКЦИЯ ===\n";
echo "1. Найдите нужную группу выше\n";
echo "2. Скопируйте Chat ID (число с минусом для групп)\n";
echo "3. Вставьте его в config.php:\n";
echo "   define('TELEGRAM_CHAT_ID', 'ВАШ_CHAT_ID');\n";
echo "\n";

// Если в конфиге уже есть Chat ID, проверяем совпадение
if (defined('TELEGRAM_CHAT_ID') && TELEGRAM_CHAT_ID !== 'YOUR_CHAT_ID_HERE') {
    $currentChatId = TELEGRAM_CHAT_ID;
    echo "=== ПРОВЕРКА ТЕКУЩЕГО CHAT ID ===\n";
    
    if (isset($chats[$currentChatId])) {
        $currentChat = $chats[$currentChatId];
        echo "✅ Текущий Chat ID найден в обновлениях!\n";
        echo "   Chat ID: " . $currentChatId . "\n";
        echo "   Название: " . ($currentChat['title'] ?? $currentChat['first_name'] ?? 'Неизвестно') . "\n";
        echo "   Тип: " . $currentChat['type'] . "\n";
    } else {
        echo "⚠️  Текущий Chat ID (" . $currentChatId . ") не найден в обновлениях.\n";
        echo "   Возможно:\n";
        echo "   - Бот не получал сообщений из этого чата\n";
        echo "   - Chat ID неправильный\n";
        echo "   - Нужно отправить сообщение в группу и запустить скрипт снова\n";
    }
    echo "\n";
}

echo "=== Конец ===\n";

