<?php
/**
 * Конфигурация OAuth провайдеров (Google и Apple)
 * 
 * Конфигурация хранится в базе данных для гарантированного наличия на сервере
 */

require_once __DIR__ . '/db.php';

// Базовый URL для OAuth редиректов
function getOAuthBaseUrl(): string
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $protocol . '://' . $host;
}

/**
 * Получает OAuth конфигурацию из базы данных
 */
function getOAuthConfigFromDb(string $provider): ?array
{
    try {
        $pdo = getDb();
        $stmt = $pdo->prepare('SELECT * FROM oauth_config WHERE provider = :provider LIMIT 1');
        $stmt->execute(['provider' => $provider]);
        $config = $stmt->fetch();
        
        if ($config) {
            // Обновляем redirect_uri на основе текущего домена
            $baseUrl = getOAuthBaseUrl();
            $config['redirect_uri'] = $baseUrl . '/oauth/' . $provider . '/callback.php';
            return $config;
        }
    } catch (Exception $e) {
        error_log('Error loading OAuth config from DB: ' . $e->getMessage());
    }
    
    return null;
}

/**
 * Сохраняет OAuth конфигурацию в базу данных
 */
function saveOAuthConfigToDb(string $provider, array $config): bool
{
    try {
        $pdo = getDb();
        $now = date('c');
        
        // Проверяем, существует ли запись
        $stmt = $pdo->prepare('SELECT id FROM oauth_config WHERE provider = :provider LIMIT 1');
        $stmt->execute(['provider' => $provider]);
        $exists = $stmt->fetch();
        
        if ($exists) {
            // Обновляем существующую запись
            $stmt = $pdo->prepare(
                'UPDATE oauth_config SET 
                    client_id = :client_id,
                    client_secret = :client_secret,
                    team_id = :team_id,
                    key_id = :key_id,
                    private_key_path = :private_key_path,
                    redirect_uri = :redirect_uri,
                    auth_url = :auth_url,
                    token_url = :token_url,
                    userinfo_url = :userinfo_url,
                    updated_at = :updated_at
                 WHERE provider = :provider'
            );
            $stmt->execute([
                'provider' => $provider,
                'client_id' => $config['client_id'] ?? null,
                'client_secret' => $config['client_secret'] ?? null,
                'team_id' => $config['team_id'] ?? null,
                'key_id' => $config['key_id'] ?? null,
                'private_key_path' => $config['private_key_path'] ?? null,
                'redirect_uri' => $config['redirect_uri'] ?? '',
                'auth_url' => $config['auth_url'] ?? '',
                'token_url' => $config['token_url'] ?? '',
                'userinfo_url' => $config['userinfo_url'] ?? null,
                'updated_at' => $now,
            ]);
        } else {
            // Создаём новую запись
            $stmt = $pdo->prepare(
                'INSERT INTO oauth_config (provider, client_id, client_secret, team_id, key_id, private_key_path, redirect_uri, auth_url, token_url, userinfo_url, created_at, updated_at)
                 VALUES (:provider, :client_id, :client_secret, :team_id, :key_id, :private_key_path, :redirect_uri, :auth_url, :token_url, :userinfo_url, :created_at, :updated_at)'
            );
            $stmt->execute([
                'provider' => $provider,
                'client_id' => $config['client_id'] ?? null,
                'client_secret' => $config['client_secret'] ?? null,
                'team_id' => $config['team_id'] ?? null,
                'key_id' => $config['key_id'] ?? null,
                'private_key_path' => $config['private_key_path'] ?? null,
                'redirect_uri' => $config['redirect_uri'] ?? '',
                'auth_url' => $config['auth_url'] ?? '',
                'token_url' => $config['token_url'] ?? '',
                'userinfo_url' => $config['userinfo_url'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        
        return true;
    } catch (Exception $e) {
        error_log('Error saving OAuth config to DB: ' . $e->getMessage());
        return false;
    }
}

// Google OAuth настройки
function getGoogleOAuthConfig(): array
{
    // Сначала проверяем переменные окружения (приоритет)
    $clientId = getenv('GOOGLE_CLIENT_ID');
    $clientSecret = getenv('GOOGLE_CLIENT_SECRET');
    
    // Если переменные окружения не установлены, загружаем из БД
    if (empty($clientId) || empty($clientSecret)) {
        $dbConfig = getOAuthConfigFromDb('google');
        if ($dbConfig) {
            $clientId = $clientId ?: ($dbConfig['client_id'] ?? '');
            $clientSecret = $clientSecret ?: ($dbConfig['client_secret'] ?? '');
        }
    }
    
    // Возвращаем конфигурацию
    return [
        'client_id' => $clientId ?: '',
        'client_secret' => $clientSecret ?: '',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/google/callback.php',
        'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'token_url' => 'https://oauth2.googleapis.com/token',
        'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
    ];
}

// Apple OAuth настройки
function getAppleOAuthConfig(): array
{
    // Сначала проверяем переменные окружения (приоритет)
    $clientId = getenv('APPLE_CLIENT_ID');
    $teamId = getenv('APPLE_TEAM_ID');
    $keyId = getenv('APPLE_KEY_ID');
    $privateKeyPath = getenv('APPLE_PRIVATE_KEY_PATH');
    
    // Если переменные окружения не установлены, загружаем из БД
    if (empty($clientId) || empty($teamId) || empty($keyId)) {
        $dbConfig = getOAuthConfigFromDb('apple');
        if ($dbConfig) {
            $clientId = $clientId ?: ($dbConfig['client_id'] ?? '');
            $teamId = $teamId ?: ($dbConfig['team_id'] ?? '');
            $keyId = $keyId ?: ($dbConfig['key_id'] ?? '');
            $privateKeyPath = $privateKeyPath ?: ($dbConfig['private_key_path'] ?? '');
        }
    }
    
    // Возвращаем конфигурацию
    return [
        'client_id' => $clientId ?: '',
        'team_id' => $teamId ?: '',
        'key_id' => $keyId ?: '',
        'private_key_path' => $privateKeyPath ?: '',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/apple/callback.php',
        'auth_url' => 'https://appleid.apple.com/auth/authorize',
        'token_url' => 'https://appleid.apple.com/auth/token',
    ];
}

// Проверка, включен ли OAuth
function isOAuthEnabled(string $provider): bool
{
    try {
        if ($provider === 'google') {
            $config = getGoogleOAuthConfig();
            $enabled = !empty($config['client_id']) && !empty($config['client_secret']);
            return $enabled;
        }
        
        if ($provider === 'apple') {
            $config = getAppleOAuthConfig();
            return !empty($config['client_id']) && !empty($config['team_id']) && !empty($config['key_id']);
        }
    } catch (Exception $e) {
        error_log('OAuth enabled check error: ' . $e->getMessage());
        return false;
    }
    
    return false;
}

