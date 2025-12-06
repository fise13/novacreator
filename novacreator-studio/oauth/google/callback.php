<?php
/**
 * Обработчик callback от Google OAuth
 */

require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/oauth_config.php';
require_once __DIR__ . '/../../includes/db.php';

startSecureSession();

$code = $_GET['code'] ?? '';
$state = $_GET['state'] ?? '';
$error = $_GET['error'] ?? '';

// Проверяем state для защиты от CSRF
if (empty($state) || !isset($_SESSION['oauth_state']) || $state !== $_SESSION['oauth_state']) {
    setFlash('error', 'Неверный запрос. Попробуйте снова.');
    header('Location: /login.php');
    exit;
}

if (!empty($error)) {
    setFlash('error', 'Ошибка авторизации: ' . htmlspecialchars($error));
    header('Location: /login.php');
    exit;
}

if (empty($code)) {
    setFlash('error', 'Код авторизации не получен.');
    header('Location: /login.php');
    exit;
}

$config = getGoogleOAuthConfig();

// Обмениваем код на токен
$tokenData = [
    'code' => $code,
    'client_id' => $config['client_id'],
    'client_secret' => $config['client_secret'],
    'redirect_uri' => $config['redirect_uri'],
    'grant_type' => 'authorization_code',
];

$ch = curl_init($config['token_url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    setFlash('error', 'Ошибка получения токена.');
    header('Location: /login.php');
    exit;
}

$tokenResponse = json_decode($response, true);

if (!isset($tokenResponse['access_token'])) {
    setFlash('error', 'Токен не получен.');
    header('Location: /login.php');
    exit;
}

// Получаем информацию о пользователе
$ch = curl_init($config['userinfo_url'] . '?access_token=' . urlencode($tokenResponse['access_token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

$userResponse = curl_exec($ch);
$userHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($userHttpCode !== 200) {
    setFlash('error', 'Ошибка получения данных пользователя.');
    header('Location: /login.php');
    exit;
}

$userData = json_decode($userResponse, true);

if (!isset($userData['email']) || !isset($userData['id'])) {
    setFlash('error', 'Недостаточно данных от Google.');
    header('Location: /login.php');
    exit;
}

// Очищаем OAuth state
unset($_SESSION['oauth_state']);
unset($_SESSION['oauth_provider']);

// Регистрируем или авторизуем пользователя
$pdo = getDb();
$email = trim(mb_strtolower($userData['email']));
$oauthId = $userData['id'];
$name = $userData['name'] ?? $userData['given_name'] ?? 'Пользователь';
$avatarUrl = $userData['picture'] ?? null;

// Проверяем, существует ли пользователь с таким email или OAuth ID
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email OR (oauth_provider = "google" AND oauth_id = :oauth_id) LIMIT 1');
$stmt->execute(['email' => $email, 'oauth_id' => $oauthId]);
$user = $stmt->fetch();

if ($user) {
    // Обновляем OAuth данные, если их не было
    if (empty($user['oauth_provider'])) {
        $stmt = $pdo->prepare('UPDATE users SET oauth_provider = "google", oauth_id = :oauth_id, avatar_url = :avatar_url, updated_at = :updated WHERE id = :id');
        $stmt->execute([
            'oauth_id' => $oauthId,
            'avatar_url' => $avatarUrl,
            'updated' => date('c'),
            'id' => $user['id']
        ]);
    } else {
        // Обновляем аватар, если изменился
        if ($avatarUrl && $user['avatar_url'] !== $avatarUrl) {
            $stmt = $pdo->prepare('UPDATE users SET avatar_url = :avatar_url, updated_at = :updated WHERE id = :id');
            $stmt->execute([
                'avatar_url' => $avatarUrl,
                'updated' => date('c'),
                'id' => $user['id']
            ]);
        }
    }
} else {
    // Создаём нового пользователя
    $now = date('c');
    $stmt = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash, oauth_provider, oauth_id, avatar_url, role, created_at, updated_at)
         VALUES (:name, :email, NULL, "google", :oauth_id, :avatar_url, "user", :created_at, :updated_at)'
    );
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'oauth_id' => $oauthId,
        'avatar_url' => $avatarUrl,
        'created_at' => $now,
        'updated_at' => $now,
    ]);
    $user = getUserByEmail($email);
}

// Авторизуем пользователя
session_regenerate_id(true);
$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['user_role'] = $user['role'];

setFlash('success', 'Добро пожаловать!');
header('Location: /dashboard.php');
exit;

