<?php
/**
 * Временная страница для тестирования OAuth
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/oauth_config.php';

echo '<h1>Тест OAuth Google</h1>';

try {
    $config = getGoogleOAuthConfig();
    
    echo '<h2>Конфигурация:</h2>';
    echo '<pre>';
    echo 'Client ID: ' . (!empty($config['client_id']) ? substr($config['client_id'], 0, 30) . '... (есть)' : 'ПУСТО') . "\n";
    echo 'Client Secret: ' . (!empty($config['client_secret']) ? substr($config['client_secret'], 0, 10) . '... (есть)' : 'ПУСТО') . "\n";
    echo 'Redirect URI: ' . htmlspecialchars($config['redirect_uri']) . "\n";
    echo 'Auth URL: ' . htmlspecialchars($config['auth_url']) . "\n";
    echo 'Base URL: ' . htmlspecialchars(getOAuthBaseUrl()) . "\n";
    echo '</pre>';
    
    echo '<h2>Проверка включения:</h2>';
    $enabled = isOAuthEnabled('google');
    echo '<p>OAuth включен: ' . ($enabled ? '<strong style="color: green;">ДА</strong>' : '<strong style="color: red;">НЕТ</strong>') . '</p>';
    
    if ($enabled) {
        echo '<h2>Генерация URL:</h2>';
        $state = bin2hex(random_bytes(32));
        $params = [
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect_uri'],
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'state' => $state,
            'access_type' => 'offline',
            'prompt' => 'consent',
        ];
        
        $authUrl = $config['auth_url'] . '?' . http_build_query($params);
        
        echo '<p><strong>URL авторизации:</strong></p>';
        echo '<pre>' . htmlspecialchars($authUrl) . '</pre>';
        echo '<p><a href="' . htmlspecialchars($authUrl) . '" target="_blank">Перейти к авторизации Google</a></p>';
        echo '<p><a href="/oauth/google/initiate.php">Использовать initiate.php</a></p>';
    } else {
        echo '<p style="color: red;">OAuth не настроен! Проверьте конфигурацию.</p>';
    }
    
} catch (Throwable $e) {
    echo '<h2 style="color: red;">Ошибка!</h2>';
    echo '<p><strong>Сообщение:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>Файл:</strong> ' . htmlspecialchars($e->getFile()) . '</p>';
    echo '<p><strong>Строка:</strong> ' . $e->getLine() . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
}

