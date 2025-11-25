<?php
/**
 * Пример конфигурации для отправки сообщений в Telegram
 * 
 * ИНСТРУКЦИЯ:
 * 1. Скопируйте этот файл в telegram_config.php
 * 2. Заполните токен и Chat ID
 * 3. Файл telegram_config.php будет игнорироваться git (безопасность)
 */

// Токен Telegram бота
define('TELEGRAM_BOT_TOKEN', 'ВАШ_ТОКЕН_ЗДЕСЬ');

// Chat ID канала или группы
define('TELEGRAM_CHAT_ID', 'ВАШ_CHAT_ID_ЗДЕСЬ');

// URL API Telegram
define('TELEGRAM_API_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/');

// Минимальное время между отправками (в секундах) - защита от спама
define('TELEGRAM_MIN_SEND_INTERVAL', 30);

// Включить логирование (true/false)
define('TELEGRAM_ENABLE_LOGGING', true);

// Путь к файлу логов
define('TELEGRAM_LOG_FILE', __DIR__ . '/telegram_logs.txt');

