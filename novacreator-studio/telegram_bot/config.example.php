<?php
/**
 * Пример конфигурации Telegram бота
 * 
 * ИНСТРУКЦИЯ ПО НАСТРОЙКЕ:
 * 1. Скопируйте этот файл: cp config.example.php config.php
 * 2. Создайте бота через @BotFather в Telegram
 * 3. Получите токен бота (например: 123456789:ABCdefGHIjklMNOpqrsTUVwxyz)
 * 4. Узнайте ваш Chat ID (можно через @userinfobot или @getidsbot)
 * 5. Вставьте токен и Chat ID в config.php
 */

// Токен вашего Telegram бота (получите у @BotFather)
define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');

// Chat ID, куда будут приходить сообщения (ваш ID или ID группы)
define('TELEGRAM_CHAT_ID', 'YOUR_CHAT_ID_HERE');

// Включить/выключить отправку в Telegram (true/false)
define('TELEGRAM_ENABLED', true);

?>

