<?php
/**
 * Инициирует OAuth авторизацию через Apple
 */

require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/oauth_config.php';

startSecureSession();

// Генерируем state для защиты от CSRF
$state = bin2hex(random_bytes(32));
$_SESSION['oauth_state'] = $state;
$_SESSION['oauth_provider'] = 'apple';

$config = getAppleOAuthConfig();

if (empty($config['client_id']) || empty($config['team_id']) || empty($config['key_id'])) {
    setFlash('error', 'OAuth не настроен. Обратитесь к администратору.');
    header('Location: /login.php');
    exit;
}

// Генерируем nonce
$nonce = bin2hex(random_bytes(16));
$_SESSION['oauth_nonce'] = $nonce;

$params = [
    'client_id' => $config['client_id'],
    'redirect_uri' => $config['redirect_uri'],
    'response_type' => 'code',
    'scope' => 'name email',
    'state' => $state,
    'response_mode' => 'form_post',
    'nonce' => $nonce,
];

$authUrl = $config['auth_url'] . '?' . http_build_query($params);

header('Location: ' . $authUrl);
exit;

