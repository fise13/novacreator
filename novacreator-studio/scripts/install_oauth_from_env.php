<?php
/**
 * Установка OAuth конфигурации из переменных окружения в базу данных
 * 
 * Этот скрипт автоматически сохраняет OAuth credentials из переменных окружения
 * в базу данных при первом запуске или обновлении.
 * 
 * Использование:
 * php scripts/install_oauth_from_env.php
 */

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/oauth_config.php';

echo "Установка OAuth конфигурации из переменных окружения...\n\n";

// Проверяем Google OAuth
$googleClientId = getenv('GOOGLE_CLIENT_ID');
$googleClientSecret = getenv('GOOGLE_CLIENT_SECRET');

if (!empty($googleClientId) && !empty($googleClientSecret)) {
    echo "✓ Найдены переменные окружения для Google OAuth\n";
    
    $result = saveOAuthConfigToDb('google', [
        'client_id' => $googleClientId,
        'client_secret' => $googleClientSecret,
        'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'token_url' => 'https://oauth2.googleapis.com/token',
        'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
    ]);
    
    if ($result) {
        echo "✓ Google OAuth конфигурация успешно сохранена в базу данных\n";
    } else {
        echo "✗ Ошибка при сохранении Google OAuth конфигурации\n";
    }
} else {
    echo "⚠ Переменные окружения GOOGLE_CLIENT_ID и GOOGLE_CLIENT_SECRET не установлены\n";
    echo "  Установите их в .htaccess или через переменные окружения сервера\n";
}

// Проверяем Apple OAuth (опционально)
$appleClientId = getenv('APPLE_CLIENT_ID');
$appleTeamId = getenv('APPLE_TEAM_ID');
$appleKeyId = getenv('APPLE_KEY_ID');

if (!empty($appleClientId) && !empty($appleTeamId) && !empty($appleKeyId)) {
    echo "\n✓ Найдены переменные окружения для Apple OAuth\n";
    
    $result = saveOAuthConfigToDb('apple', [
        'client_id' => $appleClientId,
        'team_id' => $appleTeamId,
        'key_id' => $appleKeyId,
        'private_key_path' => getenv('APPLE_PRIVATE_KEY_PATH') ?: null,
        'auth_url' => 'https://appleid.apple.com/auth/authorize',
        'token_url' => 'https://appleid.apple.com/auth/token',
    ]);
    
    if ($result) {
        echo "✓ Apple OAuth конфигурация успешно сохранена в базу данных\n";
    } else {
        echo "✗ Ошибка при сохранении Apple OAuth конфигурации\n";
    }
}

echo "\nГотово!\n";

