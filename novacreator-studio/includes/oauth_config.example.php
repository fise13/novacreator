<?php
/**
 * Пример конфигурации OAuth
 * Скопируйте этот файл в oauth_config.local.php и заполните своими данными
 */

require_once __DIR__ . '/oauth_config.php';

function getGoogleOAuthConfigLocal(): array
{
    return [
        'client_id' => 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com',
        'client_secret' => 'YOUR_GOOGLE_CLIENT_SECRET',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/google/callback.php',
        'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'token_url' => 'https://oauth2.googleapis.com/token',
        'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
    ];
}

function getAppleOAuthConfigLocal(): array
{
    return [
        'client_id' => 'YOUR_APPLE_SERVICE_ID',
        'team_id' => 'YOUR_APPLE_TEAM_ID',
        'key_id' => 'YOUR_APPLE_KEY_ID',
        'private_key_path' => __DIR__ . '/../data/apple_private_key.p8',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/apple/callback.php',
        'auth_url' => 'https://appleid.apple.com/auth/authorize',
        'token_url' => 'https://appleid.apple.com/auth/token',
    ];
}

