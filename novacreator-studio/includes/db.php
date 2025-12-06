<?php
/**
 * Подключение к БД и миграции.
 * Используем SQLite: один файл в data/app.db без отдельного сервера.
 */

// Возвращаем единый PDO-инстанс
function getDb(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dbPath = __DIR__ . '/../data/app.db';
    $dbDir = dirname($dbPath);

    // Создаём директорию data, если её нет (для первой установки)
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }

    $dsn = 'sqlite:' . $dbPath;
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON;');

    runMigrations($pdo);

    return $pdo;
}

/**
 * Простые миграции: создаём таблицы, если их нет.
 */
function runMigrations(PDO $pdo): void
{
    // Пользователи
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password_hash TEXT,
            oauth_provider TEXT,
            oauth_id TEXT,
            avatar_url TEXT,
            role TEXT NOT NULL DEFAULT "user",
            created_at TEXT NOT NULL,
            updated_at TEXT NOT NULL
        );'
    );
    
    // Миграция: добавляем OAuth поля, если их нет
    try {
        $pdo->exec('ALTER TABLE users ADD COLUMN oauth_provider TEXT;');
    } catch (PDOException $e) {
        // Колонка уже существует
    }
    try {
        $pdo->exec('ALTER TABLE users ADD COLUMN oauth_id TEXT;');
    } catch (PDOException $e) {
        // Колонка уже существует
    }
    try {
        $pdo->exec('ALTER TABLE users ADD COLUMN avatar_url TEXT;');
    } catch (PDOException $e) {
        // Колонка уже существует
    }
    
    // Создаём индекс для OAuth поиска
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_users_oauth ON users(oauth_provider, oauth_id);');

    // Проекты/статусы клиентов
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS projects (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            status TEXT,
            progress_percent INTEGER NOT NULL DEFAULT 0,
            time_spent_minutes INTEGER NOT NULL DEFAULT 0,
            stage TEXT,
            notes TEXT,
            started_at TEXT,
            avg_progress_per_day REAL,
            avg_hours_per_day REAL,
            estimated_completion_days INTEGER,
            updated_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );
    
    // Миграция: добавляем поля для метрик, если их нет
    try {
        $pdo->exec('ALTER TABLE projects ADD COLUMN avg_progress_per_day REAL;');
    } catch (PDOException $e) {
        // Колонка уже существует
    }
    try {
        $pdo->exec('ALTER TABLE projects ADD COLUMN avg_hours_per_day REAL;');
    } catch (PDOException $e) {
        // Колонка уже существует
    }
    try {
        $pdo->exec('ALTER TABLE projects ADD COLUMN estimated_completion_days INTEGER;');
    } catch (PDOException $e) {
        // Колонка уже существует
    }

    // OAuth конфигурация
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS oauth_config (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            provider TEXT NOT NULL UNIQUE,
            client_id TEXT,
            client_secret TEXT,
            team_id TEXT,
            key_id TEXT,
            private_key_path TEXT,
            redirect_uri TEXT,
            auth_url TEXT,
            token_url TEXT,
            userinfo_url TEXT,
            created_at TEXT NOT NULL,
            updated_at TEXT NOT NULL
        );'
    );
    
    // Вставляем дефолтные значения, если их нет (гарантируем наличие на сервере)
    $now = date('c');
    
    // Google OAuth конфигурация
    $stmt = $pdo->prepare('SELECT id, client_id, client_secret FROM oauth_config WHERE provider = :provider LIMIT 1');
    $stmt->execute(['provider' => 'google']);
    $existing = $stmt->fetch();
    
    // Получаем секреты из переменных окружения (приоритет)
    $envClientId = getenv('GOOGLE_CLIENT_ID');
    $envClientSecret = getenv('GOOGLE_CLIENT_SECRET');
    
    if (!$existing) {
        // Создаем новую запись
        $stmt = $pdo->prepare(
            'INSERT INTO oauth_config (provider, client_id, client_secret, redirect_uri, auth_url, token_url, userinfo_url, created_at, updated_at)
             VALUES (:provider, :client_id, :client_secret, :redirect_uri, :auth_url, :token_url, :userinfo_url, :created_at, :updated_at)'
        );
        
        $clientId = $envClientId ?: '';
        $clientSecret = $envClientSecret ?: '';
        
        $stmt->execute([
            'provider' => 'google',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => '',
            'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'token_url' => 'https://oauth2.googleapis.com/token',
            'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    } elseif (!empty($envClientId) && !empty($envClientSecret)) {
        // Если переменные окружения установлены, обновляем БД (но только если там пусто или отличается)
        $needsUpdate = false;
        if (empty($existing['client_id']) || $existing['client_id'] !== $envClientId) {
            $needsUpdate = true;
        }
        if (empty($existing['client_secret']) || $existing['client_secret'] !== $envClientSecret) {
            $needsUpdate = true;
        }
        
        if ($needsUpdate) {
            $stmt = $pdo->prepare(
                'UPDATE oauth_config SET client_id = :client_id, client_secret = :client_secret, updated_at = :updated_at WHERE provider = :provider'
            );
            $stmt->execute([
                'provider' => 'google',
                'client_id' => $envClientId,
                'client_secret' => $envClientSecret,
                'updated_at' => $now,
            ]);
        }
    }
    
    // Apple OAuth конфигурация (пустая, для будущего использования)
    $stmt = $pdo->prepare('SELECT id FROM oauth_config WHERE provider = :provider LIMIT 1');
    $stmt->execute(['provider' => 'apple']);
    if (!$stmt->fetch()) {
        $stmt = $pdo->prepare(
            'INSERT INTO oauth_config (provider, redirect_uri, auth_url, token_url, created_at, updated_at)
             VALUES (:provider, :redirect_uri, :auth_url, :token_url, :created_at, :updated_at)'
        );
        $stmt->execute([
            'provider' => 'apple',
            'redirect_uri' => '',
            'auth_url' => 'https://appleid.apple.com/auth/authorize',
            'token_url' => 'https://appleid.apple.com/auth/token',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_projects_user_id ON projects(user_id);');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_oauth_config_provider ON oauth_config(provider);');
}

