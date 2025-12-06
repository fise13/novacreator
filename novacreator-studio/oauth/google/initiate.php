<?php
/**
 * Инициирует OAuth авторизацию через Google
 */

require_once __DIR__ . '/../../includes/oauth_config.php';
require_once __DIR__ . '/../../includes/csrf.php';

startSecureSession();

// Генерируем state для защиты от CSRF
$state = bin2hex(random_bytes(32));
$_SESSION['oauth_state'] = $state;
$_SESSION['oauth_provider'] = 'google';

$config = getGoogleOAuthConfig();

if (empty($config['client_id']) || empty($config['client_secret'])) {
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

header('Location: ' . $authUrl);
exit;

