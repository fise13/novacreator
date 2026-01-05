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
 * 
 * ВАЖНО: Миграции НЕ удаляют данные! Они только:
 * - Создают таблицы, если их нет
 * - Добавляют новые колонки, если их нет
 * - Создают индексы, если их нет
 * 
 * Все существующие данные сохраняются при обновлении.
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
    
    // Отчеты по SEO/рекламе
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS reports (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            type TEXT NOT NULL,
            title TEXT NOT NULL,
            content TEXT,
            metrics TEXT,
            file_url TEXT,
            created_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_reports_user ON reports(user_id, created_at);');

    // История работ
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS work_history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            action TEXT NOT NULL,
            description TEXT,
            created_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_work_history_user ON work_history(user_id, created_at);');

    // Уведомления
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS notifications (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            type TEXT NOT NULL,
            title TEXT NOT NULL,
            message TEXT,
            link TEXT,
            read_at TEXT,
            created_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_notifications_user ON notifications(user_id, created_at);');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_notifications_read ON notifications(user_id, read_at);');

    // Файловый архив
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS files (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            name TEXT NOT NULL,
            file_path TEXT NOT NULL,
            file_size INTEGER,
            file_type TEXT,
            category TEXT,
            description TEXT,
            uploaded_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_files_user ON files(user_id, uploaded_at);');

    // Чат/тикеты
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS tickets (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            subject TEXT NOT NULL,
            status TEXT NOT NULL DEFAULT "open",
            priority TEXT DEFAULT "normal",
            created_at TEXT NOT NULL,
            updated_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS ticket_messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ticket_id INTEGER NOT NULL,
            user_id INTEGER,
            admin_id INTEGER,
            message TEXT NOT NULL,
            created_at TEXT NOT NULL,
            FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        );'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_tickets_user ON tickets(user_id, created_at);');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_ticket_messages_ticket ON ticket_messages(ticket_id, created_at);');

    // Вставляем дефолтные значения, если их нет (гарантируем наличие на сервере)
    $now = date('c');
    
    // Google OAuth конфигурация
    // Дефолтные значения (гарантированная установка на сервере)
    $defaultClientId = '394392440430-atshc1pnu69bbgal894ob1rs15phovjo.apps.googleusercontent.com';
    $defaultClientSecret = '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';
    
    $stmt = $pdo->prepare('SELECT id, client_id, client_secret FROM oauth_config WHERE provider = :provider LIMIT 1');
    $stmt->execute(['provider' => 'google']);
    $existing = $stmt->fetch();
    
    // Получаем секреты из переменных окружения (приоритет), иначе используем дефолтные значения
    $envClientId = getenv('GOOGLE_CLIENT_ID');
    $envClientSecret = getenv('GOOGLE_CLIENT_SECRET');
    
    // Используем переменные окружения, если они есть, иначе дефолтные значения
    $clientId = $envClientId ?: $defaultClientId;
    $clientSecret = $envClientSecret ?: $defaultClientSecret;
    
    if (!$existing) {
        // Создаем новую запись с дефолтными значениями
        $stmt = $pdo->prepare(
            'INSERT INTO oauth_config (provider, client_id, client_secret, redirect_uri, auth_url, token_url, userinfo_url, created_at, updated_at)
             VALUES (:provider, :client_id, :client_secret, :redirect_uri, :auth_url, :token_url, :userinfo_url, :created_at, :updated_at)'
        );
        
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
    } else {
        // Обновляем, если в БД пусто или значения отличаются
        $needsUpdate = false;
        if (empty($existing['client_id']) || $existing['client_id'] !== $clientId) {
            $needsUpdate = true;
        }
        if (empty($existing['client_secret']) || $existing['client_secret'] !== $clientSecret) {
            $needsUpdate = true;
        }
        
        if ($needsUpdate) {
            $stmt = $pdo->prepare(
                'UPDATE oauth_config SET client_id = :client_id, client_secret = :client_secret, updated_at = :updated_at WHERE provider = :provider'
            );
            $stmt->execute([
                'provider' => 'google',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
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

