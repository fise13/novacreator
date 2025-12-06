<?php
/**
 * Обработчик callback от Apple OAuth
 * Apple использует POST вместо GET для callback
 */

require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/oauth_config.php';
require_once __DIR__ . '/../../includes/db.php';

startSecureSession();

$code = $_POST['code'] ?? '';
$state = $_POST['state'] ?? '';
$error = $_POST['error'] ?? '';
$userData = null;

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

$config = getAppleOAuthConfig();

// Apple может отправить данные пользователя в первом запросе
if (isset($_POST['user'])) {
    $userData = json_decode($_POST['user'], true);
}

// Генерируем client_secret (JWT) для Apple
$clientSecret = generateAppleClientSecret($config);

// Обмениваем код на токен
$tokenData = [
    'client_id' => $config['client_id'],
    'client_secret' => $clientSecret,
    'code' => $code,
    'grant_type' => 'authorization_code',
    'redirect_uri' => $config['redirect_uri'],
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
    setFlash('error', 'Ошибка получения токена от Apple.');
    header('Location: /login.php');
    exit;
}

$tokenResponse = json_decode($response, true);

if (!isset($tokenResponse['id_token'])) {
    setFlash('error', 'Токен не получен от Apple.');
    header('Location: /login.php');
    exit;
}

// Декодируем id_token (JWT)
$idToken = $tokenResponse['id_token'];
$tokenParts = explode('.', $idToken);
if (count($tokenParts) !== 3) {
    setFlash('error', 'Неверный формат токена.');
    header('Location: /login.php');
    exit;
}

$payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $tokenParts[1])), true);

if (!$payload || !isset($payload['sub']) || !isset($payload['email'])) {
    setFlash('error', 'Недостаточно данных от Apple.');
    header('Location: /login.php');
    exit;
}

// Очищаем OAuth state
unset($_SESSION['oauth_state']);
unset($_SESSION['oauth_provider']);
unset($_SESSION['oauth_nonce']);

// Регистрируем или авторизуем пользователя
$pdo = getDb();
$email = trim(mb_strtolower($payload['email']));
$oauthId = $payload['sub'];
$name = 'Пользователь';

// Если Apple отправил данные пользователя в первом запросе
if ($userData && isset($userData['name'])) {
    $firstName = $userData['name']['firstName'] ?? '';
    $lastName = $userData['name']['lastName'] ?? '';
    $name = trim($firstName . ' ' . $lastName);
    if (empty($name)) {
        $name = 'Пользователь';
    }
}

// Проверяем, существует ли пользователь с таким email или OAuth ID
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email OR (oauth_provider = "apple" AND oauth_id = :oauth_id) LIMIT 1');
$stmt->execute(['email' => $email, 'oauth_id' => $oauthId]);
$user = $stmt->fetch();

if ($user) {
    // Обновляем OAuth данные, если их не было
    if (empty($user['oauth_provider'])) {
        $stmt = $pdo->prepare('UPDATE users SET oauth_provider = "apple", oauth_id = :oauth_id, updated_at = :updated WHERE id = :id');
        $stmt->execute([
            'oauth_id' => $oauthId,
            'updated' => date('c'),
            'id' => $user['id']
        ]);
    }
} else {
    // Создаём нового пользователя
    $now = date('c');
    $stmt = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash, oauth_provider, oauth_id, avatar_url, role, created_at, updated_at)
         VALUES (:name, :email, NULL, "apple", :oauth_id, NULL, "user", :created_at, :updated_at)'
    );
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'oauth_id' => $oauthId,
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

/**
 * Генерирует JWT client_secret для Apple
 */
function generateAppleClientSecret(array $config): string
{
    if (empty($config['private_key_path']) || !file_exists($config['private_key_path'])) {
        throw new Exception('Apple private key не найден');
    }

    $privateKey = file_get_contents($config['private_key_path']);
    if (!$privateKey) {
        throw new Exception('Не удалось прочитать Apple private key');
    }

    $header = [
        'alg' => 'ES256',
        'kid' => $config['key_id'],
    ];

    $payload = [
        'iss' => $config['team_id'],
        'iat' => time(),
        'exp' => time() + 3600, // 1 час
        'aud' => 'https://appleid.apple.com',
        'sub' => $config['client_id'],
    ];

    $headerEncoded = base64url_encode(json_encode($header));
    $payloadEncoded = base64url_encode(json_encode($payload));

    $signature = '';
    openssl_sign(
        $headerEncoded . '.' . $payloadEncoded,
        $signature,
        $privateKey,
        OPENSSL_ALGO_SHA256
    );

    // Конвертируем подпись в формат JWT (DER to raw)
    $signatureEncoded = base64url_encode($signature);

    return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
}

function base64url_encode($data): string
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

