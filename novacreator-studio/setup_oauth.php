<?php
/**
 * Скрипт для первоначальной настройки OAuth конфигурации на сервере
 * 
 * Запустите этот скрипт один раз после развертывания на сервере
 * для установки OAuth credentials в базу данных
 */

require_once __DIR__ . '/includes/oauth_config.php';
require_once __DIR__ . '/includes/db.php';

// Установите здесь ваши реальные OAuth credentials
// ВАЖНО: Замените значения ниже на ваши реальные credentials перед запуском на сервере
$googleConfig = [
    'client_id' => 'YOUR_GOOGLE_CLIENT_ID_HERE',
    'client_secret' => 'YOUR_GOOGLE_CLIENT_SECRET_HERE',
    'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
    'token_url' => 'https://oauth2.googleapis.com/token',
    'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
];

// Сохраняем конфигурацию в БД
if (saveOAuthConfigToDb('google', $googleConfig)) {
    echo "✓ Google OAuth конфигурация успешно сохранена в базу данных\n";
} else {
    echo "✗ Ошибка при сохранении Google OAuth конфигурации\n";
}

echo "\nOAuth настройка завершена!\n";

