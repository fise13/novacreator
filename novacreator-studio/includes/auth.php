<?php
/**
 * Аутентификация и сессии.
 * Все пароли храним только в виде bcrypt-хеша.
 */

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

    if (getUserByEmail($email)) {
        return ['success' => false, 'errors' => ['Пользователь с таким email уже существует.']];
    }

    $role = usersCount() === 0 ? 'admin' : 'user'; // Первый зарегистрированный — админ
    $now = date('c');
    $hash = password_hash($password, PASSWORD_BCRYPT);

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
    if (!$user) {
        return ['success' => false, 'error' => 'Неверный email или пароль.'];
    }

    if (!password_verify($password, $user['password_hash'])) {
        return ['success' => false, 'error' => 'Неверный email или пароль.'];
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
    if (($_SESSION['user_role'] ?? 'user') !== 'admin') {
        http_response_code(403);
        echo 'Доступ запрещён';
        exit;
    }
}

