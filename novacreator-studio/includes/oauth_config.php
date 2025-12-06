<?php
/**
 * Конфигурация OAuth провайдеров (Google и Apple)
 * 
 * ВАЖНО: Создайте файл oauth_config.local.php для реальных credentials
 * Этот файл содержит примеры настроек
 */

// Базовый URL для OAuth редиректов
function getOAuthBaseUrl(): string
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $protocol . '://' . $host;
}

// Google OAuth настройки
function getGoogleOAuthConfig(): array
{
    // Пытаемся загрузить локальную конфигурацию
    $localConfig = __DIR__ . '/oauth_config.local.php';
    if (file_exists($localConfig)) {
        require_once $localConfig;
        if (function_exists('getGoogleOAuthConfigLocal')) {
            return getGoogleOAuthConfigLocal();
        }
    }
    
    // Возвращаем пример конфигурации
    return [
        'client_id' => getenv('GOOGLE_CLIENT_ID') ?: '',
        'client_secret' => getenv('GOOGLE_CLIENT_SECRET') ?: '',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/google/callback.php',
        'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'token_url' => 'https://oauth2.googleapis.com/token',
        'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
    ];
}

// Apple OAuth настройки
function getAppleOAuthConfig(): array
{
    // Пытаемся загрузить локальную конфигурацию
    $localConfig = __DIR__ . '/oauth_config.local.php';
    if (file_exists($localConfig)) {
        require_once $localConfig;
        if (function_exists('getAppleOAuthConfigLocal')) {
            return getAppleOAuthConfigLocal();
        }
    }
    
    // Возвращаем пример конфигурации
    return [
        'client_id' => getenv('APPLE_CLIENT_ID') ?: '',
        'team_id' => getenv('APPLE_TEAM_ID') ?: '',
        'key_id' => getenv('APPLE_KEY_ID') ?: '',
        'private_key_path' => getenv('APPLE_PRIVATE_KEY_PATH') ?: '',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/apple/callback.php',
        'auth_url' => 'https://appleid.apple.com/auth/authorize',
        'token_url' => 'https://appleid.apple.com/auth/token',
    ];
}

// Проверка, включен ли OAuth
function isOAuthEnabled(string $provider): bool
{
    if ($provider === 'google') {
        $config = getGoogleOAuthConfig();
        return !empty($config['client_id']) && !empty($config['client_secret']);
    }
    
    if ($provider === 'apple') {
        $config = getAppleOAuthConfig();
        return !empty($config['client_id']) && !empty($config['team_id']) && !empty($config['key_id']);
    }
    
    return false;
}

