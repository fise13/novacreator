<?php
/**
 * Инициирует OAuth авторизацию через Google
 */

// Обработка ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1); // Временно показываем ошибки для отладки
ini_set('log_errors', 1);

try {
    require_once __DIR__ . '/../../includes/auth.php';
    require_once __DIR__ . '/../../includes/oauth_config.php';

    startSecureSession();

    // Генерируем state для защиты от CSRF
    $state = bin2hex(random_bytes(32));
    $_SESSION['oauth_state'] = $state;
    $_SESSION['oauth_provider'] = 'google';

    $config = getGoogleOAuthConfig();

    // Детальное логирование для отладки
    error_log('OAuth Google Initiate: Config loaded');
    error_log('OAuth Google Initiate: Client ID = ' . (!empty($config['client_id']) ? 'SET (' . strlen($config['client_id']) . ' chars)' : 'EMPTY'));
    error_log('OAuth Google Initiate: Client Secret = ' . (!empty($config['client_secret']) ? 'SET (' . strlen($config['client_secret']) . ' chars)' : 'EMPTY'));
    error_log('OAuth Google Initiate: Redirect URI = ' . ($config['redirect_uri'] ?? 'NOT SET'));

    if (empty($config['client_id']) || empty($config['client_secret'])) {
        error_log('OAuth Google: Missing client_id or client_secret');
        error_log('OAuth Google: Config dump = ' . json_encode($config, JSON_UNESCAPED_UNICODE));
        setFlash('error', 'OAuth не настроен. Обратитесь к администратору.');
        header('Location: /login.php');
        exit;
    }

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

    // Логируем для отладки
    error_log('OAuth Google: Redirecting to ' . $authUrl);
    error_log('OAuth Google: Params = ' . json_encode($params, JSON_UNESCAPED_UNICODE));

    // Проверяем, что заголовки еще не отправлены
    if (headers_sent($file, $line)) {
        error_log('OAuth Google: Headers already sent in ' . $file . ':' . $line);
        echo '<script>window.location.href = ' . json_encode($authUrl) . ';</script>';
        exit;
    }

    header('Location: ' . $authUrl);
    exit;

} catch (Throwable $e) {
    error_log('OAuth Google Initiate Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    error_log('Stack trace: ' . $e->getTraceAsString());
    
    // Показываем детальную ошибку для отладки
    http_response_code(500);
    echo '<h1>Ошибка OAuth</h1>';
    echo '<p><strong>Сообщение:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>Файл:</strong> ' . htmlspecialchars($e->getFile()) . '</p>';
    echo '<p><strong>Строка:</strong> ' . $e->getLine() . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    exit;
}

