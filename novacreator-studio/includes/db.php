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
            password_hash TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT "user",
            created_at TEXT NOT NULL,
            updated_at TEXT NOT NULL
        );'
    );

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
            updated_at TEXT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );'
    );

    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_projects_user_id ON projects(user_id);');
}

