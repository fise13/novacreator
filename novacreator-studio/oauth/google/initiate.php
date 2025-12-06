<?php
/**
 * Инициирует OAuth авторизацию через Google
 */

// Обработка ошибок
error_reporting(E_ALL);
ini_set('display_errors', 0); // Не показываем ошибки пользователю
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

    if (empty($config['client_id']) || empty($config['client_secret'])) {
        error_log('OAuth Google: Missing client_id or client_secret');
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

    header('Location: ' . $authUrl);
    exit;

} catch (Throwable $e) {
    error_log('OAuth Google Initiate Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    error_log('Stack trace: ' . $e->getTraceAsString());
    
    // Показываем пользователю простую ошибку
    http_response_code(500);
    echo 'Произошла ошибка при инициализации OAuth. Попробуйте позже.';
    exit;
}

