<?php
/**
 * Диагностика OAuth Google
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>OAuth Google Debug</h1>";

try {
    echo "<h2>1. Подключение файлов</h2>";
    require_once __DIR__ . '/../../includes/auth.php';
    echo "✓ auth.php загружен<br>";
    
    require_once __DIR__ . '/../../includes/oauth_config.php';
    echo "✓ oauth_config.php загружен<br>";
    
    echo "<h2>2. Сессия</h2>";
    startSecureSession();
    echo "✓ Сессия запущена<br>";
    
    echo "<h2>3. Конфигурация</h2>";
    $config = getGoogleOAuthConfig();
    echo "client_id: " . htmlspecialchars($config['client_id'] ?: 'пусто') . "<br>";
    echo "client_secret: " . ($config['client_secret'] ? 'установлен' : 'пусто') . "<br>";
    echo "redirect_uri: " . htmlspecialchars($config['redirect_uri']) . "<br>";
    echo "auth_url: " . htmlspecialchars($config['auth_url']) . "<br>";
    
    echo "<h2>4. Проверка включения</h2>";
    $enabled = isOAuthEnabled('google');
    echo "OAuth включен: " . ($enabled ? "ДА" : "НЕТ") . "<br>";
    
    if ($enabled) {
        echo "<h2>5. Генерация URL</h2>";
        $state = bin2hex(random_bytes(32));
        $_SESSION['oauth_state'] = $state;
        $_SESSION['oauth_provider'] = 'google';
        
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
        echo "✓ URL авторизации сгенерирован<br>";
        echo "<a href='" . htmlspecialchars($authUrl) . "' target='_blank'>Перейти к авторизации Google</a><br>";
        echo "<pre>" . htmlspecialchars($authUrl) . "</pre>";
    } else {
        echo "<p style='color: red;'>OAuth не настроен! Проверьте конфигурацию.</p>";
    }
    
} catch (Throwable $e) {
    echo "<h2 style='color: red;'>Ошибка!</h2>";
    echo "<p><strong>Сообщение:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Файл:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p><strong>Строка:</strong> " . $e->getLine() . "</p>";
    echo "<h3>Трассировка:</h3>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

