<?php
/**
 * Скрипт для проверки OAuth конфигурации
 */

require_once __DIR__ . '/includes/oauth_config.php';
require_once __DIR__ . '/includes/db.php';

echo "=== Проверка OAuth конфигурации ===\n\n";

// Проверяем переменные окружения
echo "Переменные окружения:\n";
echo "GOOGLE_CLIENT_ID: " . (getenv('GOOGLE_CLIENT_ID') ?: 'не установлена') . "\n";
echo "GOOGLE_CLIENT_SECRET: " . (getenv('GOOGLE_CLIENT_SECRET') ? 'установлена (скрыта)' : 'не установлена') . "\n\n";

// Проверяем БД
echo "База данных:\n";
$dbConfig = getOAuthConfigFromDb('google');
if ($dbConfig) {
    echo "✓ Запись Google OAuth найдена в БД\n";
    echo "  client_id: " . ($dbConfig['client_id'] ?: 'пусто') . "\n";
    echo "  client_secret: " . ($dbConfig['client_secret'] ? 'установлен (скрыт)' : 'пусто') . "\n";
} else {
    echo "✗ Запись Google OAuth не найдена в БД\n";
}

echo "\n";

// Проверяем функцию isOAuthEnabled
echo "Проверка isOAuthEnabled:\n";
$googleEnabled = isOAuthEnabled('google');
echo "Google OAuth: " . ($googleEnabled ? "✓ ВКЛЮЧЕН" : "✗ ВЫКЛЮЧЕН") . "\n";

if (!$googleEnabled) {
    echo "\n=== Проблема найдена ===\n";
    echo "OAuth не настроен. Запустите setup_oauth.php для настройки.\n";
    echo "Или установите переменные окружения GOOGLE_CLIENT_ID и GOOGLE_CLIENT_SECRET.\n";
}

echo "\n=== Текущая конфигурация ===\n";
$config = getGoogleOAuthConfig();
echo "client_id: " . ($config['client_id'] ?: 'пусто') . "\n";
echo "client_secret: " . ($config['client_secret'] ? 'установлен' : 'пусто') . "\n";

