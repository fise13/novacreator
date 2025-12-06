<?php
/**
 * Аутентификация и сессии.
 * Все пароли храним в виде Argon2id-хеша (лучший алгоритм) или bcrypt (fallback).
 */

// Жёстко заданный root-админ
const ROOT_ADMIN_EMAIL = 'victhewise@icloud.com';
const ROOT_ADMIN_PASSWORD = 'Vic0214!';

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/csrf.php';

// Настраиваем безопасные cookie для сессии
function startSecureSession(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isSecure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_name('ncs_session');
    session_start();
}

// Устанавливаем и читаем флеш-сообщения
function setFlash(string $type, string $message): void
{
    $_SESSION['flash'][$type] = $message;
}

function getFlash(string $type): ?string
{
    if (isset($_SESSION['flash'][$type])) {
        $msg = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $msg;
    }
    return null;
}

function getUserByEmail(string $email): ?array
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function getUserById(int $id): ?array
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function usersCount(): int
{
    $pdo = getDb();
    return (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
}

function registerUser(string $name, string $email, string $password, string $passwordConfirm): array
{
    $errors = [];
    $name = trim($name);
    $email = trim(mb_strtolower($email));

    if ($name === '' || mb_strlen($name) < 2) {
        $errors[] = 'Имя должно быть не короче 2 символов.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Неверный email.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Пароль должен быть не короче 8 символов.';
    }

    if ($password !== $passwordConfirm) {
        $errors[] = 'Пароли не совпадают.';
    }

    if ($errors) {
        return ['success' => false, 'errors' => $errors];
    }

    if ($email === mb_strtolower(ROOT_ADMIN_EMAIL)) {
        return ['success' => false, 'errors' => ['Этот email зарезервирован для администратора.']];
    }

    if (getUserByEmail($email)) {
        return ['success' => false, 'errors' => ['Пользователь с таким email уже существует.']];
    }

    // Обычные пользователи всегда user
    $role = 'user';
    $now = date('c');
    // Используем Argon2id (лучший алгоритм) или bcrypt как fallback
    $hash = hashPassword($password);

    $pdo = getDb();
    $stmt = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash, role, created_at, updated_at)
         VALUES (:name, :email, :hash, :role, :created_at, :updated_at)'
    );
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'hash' => $hash,
        'role' => $role,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    return ['success' => true, 'role' => $role];
}

function loginUser(string $email, string $password): array
{
    $user = getUserByEmail(trim(mb_strtolower($email)));
    $isRootAdmin = $email === mb_strtolower(ROOT_ADMIN_EMAIL);

    if ($isRootAdmin) {
        // Проверяем пароль root-админа по заданной константе
        if ($password !== ROOT_ADMIN_PASSWORD) {
            return ['success' => false, 'error' => 'Неверный email или пароль.'];
        }

        // Убеждаемся, что учетная запись админа существует и актуальна
        $pdo = getDb();
        $now = date('c');
        $hash = hashPassword(ROOT_ADMIN_PASSWORD);

        if ($user) {
            $stmt = $pdo->prepare('UPDATE users SET role = "admin", password_hash = :hash, updated_at = :updated WHERE id = :id');
            $stmt->execute(['hash' => $hash, 'updated' => $now, 'id' => $user['id']]);
            $user['role'] = 'admin';
            $user['password_hash'] = $hash;
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO users (name, email, password_hash, role, created_at, updated_at)
                 VALUES (:name, :email, :hash, "admin", :created, :updated)'
            );
            $stmt->execute([
                'name' => 'Administrator',
                'email' => ROOT_ADMIN_EMAIL,
                'hash' => $hash,
                'created' => $now,
                'updated' => $now,
            ]);
            $user = getUserByEmail(ROOT_ADMIN_EMAIL);
        }
    } else {
        if (!$user) {
            return ['success' => false, 'error' => 'Неверный email или пароль.'];
        }

        if (!verifyPassword($password, $user['password_hash'])) {
            return ['success' => false, 'error' => 'Неверный email или пароль.'];
        }
        
        // Обновляем хеш, если используется старый алгоритм
        if (passwordNeedsRehash($user['password_hash'])) {
            $pdo = getDb();
            $newHash = hashPassword($password);
            $stmt = $pdo->prepare('UPDATE users SET password_hash = :hash, updated_at = :updated WHERE id = :id');
            $stmt->execute([
                'hash' => $newHash,
                'updated' => date('c'),
                'id' => $user['id']
            ]);
        }
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['user_role'] = $user['role'];

    return ['success' => true, 'role' => $user['role']];
}

function logoutUser(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
    }
}

function getAuthenticatedUser(): ?array
{
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    return getUserById((int)$_SESSION['user_id']);
}

function requireLogin(string $redirectTo = '/login.php'): void
{
    if (!isset($_SESSION['user_id'])) {
        $target = $_SERVER['REQUEST_URI'] ?? '/dashboard.php';
        header('Location: ' . $redirectTo . '?redirect=' . urlencode($target));
        exit;
    }
}

function requireAdmin(): void
{
    requireLogin('/login.php');
    $user = getAuthenticatedUser();
    if (($user['role'] ?? 'user') !== 'admin' || mb_strtolower($user['email'] ?? '') !== mb_strtolower(ROOT_ADMIN_EMAIL)) {
        http_response_code(403);
        echo 'Доступ запрещён';
        exit;
    }
}

/**
 * Хеширует пароль используя лучший доступный алгоритм (Argon2id > bcrypt)
 */
function hashPassword(string $password): string
{
    // Пытаемся использовать Argon2id (лучший алгоритм, доступен в PHP 7.2+)
    if (defined('PASSWORD_ARGON2ID')) {
        // Используем только поддерживаемые параметры (threads не поддерживается в некоторых реализациях)
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536, // 64 MB
            'time_cost' => 4,       // 4 итерации
        ]);
    }
    
    // Fallback на bcrypt
    return password_hash($password, PASSWORD_BCRYPT, [
        'cost' => 12, // Увеличиваем cost для лучшей безопасности
    ]);
}

/**
 * Проверяет пароль, поддерживая все форматы хешей
 */
function verifyPassword(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * Проверяет, нуждается ли хеш в обновлении (переход на более безопасный алгоритм)
 */
function passwordNeedsRehash(string $hash): bool
{
    if (defined('PASSWORD_ARGON2ID')) {
        // Если хеш не Argon2id, нужно обновить
        return password_needs_rehash($hash, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 3,
        ]);
    }
    
    // Проверяем bcrypt с cost >= 12
    return password_needs_rehash($hash, PASSWORD_BCRYPT, ['cost' => 12]);
}

