<?php
/**
 * Система подтверждения email при регистрации
 */

require_once __DIR__ . '/db.php';

/**
 * Генерирует 6-значный код подтверждения
 */
function generateVerificationCode(): string
{
    return str_pad((string)rand(100000, 999999), 6, '0', STR_PAD_LEFT);
}

/**
 * Отправляет код подтверждения на email
 */
function sendVerificationCode(string $email, string $code): bool
{
    $subject = 'Код подтверждения email - NovaCreator Studio';
    $message = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .code-box { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px; margin: 20px 0; }
        .code { font-size: 36px; font-weight: bold; letter-spacing: 8px; font-family: 'Courier New', monospace; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Подтверждение email адреса</h2>
        <p>Спасибо за регистрацию в NovaCreator Studio!</p>
        <p>Для завершения регистрации введите следующий код подтверждения:</p>
        <div class='code-box'>
            <div class='code'>{$code}</div>
        </div>
        <p>Код действителен в течение 15 минут.</p>
        <p>Если вы не регистрировались на нашем сайте, просто проигнорируйте это письмо.</p>
        <div class='footer'>
            <p>С уважением,<br>Команда NovaCreator Studio</p>
        </div>
    </div>
</body>
</html>
    ";

    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: NovaCreator Studio <noreply@novacreatorstudio.com>',
        'Reply-To: noreply@novacreatorstudio.com',
        'X-Mailer: PHP/' . phpversion()
    ];

    return mail($email, $subject, $message, implode("\r\n", $headers));
}

/**
 * Сохраняет код подтверждения в сессию
 */
function setVerificationCode(string $email, string $code): void
{
    // Нормализуем код (убираем пробелы, приводим к строке)
    $normalizedCode = (string)trim($code);
    $_SESSION['email_verification'] = [
        'email' => trim(mb_strtolower($email)),
        'code' => $normalizedCode,
        'expires_at' => time() + 900, // 15 минут
        'attempts' => 0
    ];
    // Отладочная информация
    error_log('Verification code set: email=' . $email . ', code=' . $normalizedCode);
}

/**
 * Проверяет код подтверждения
 */
function verifyEmailCode(string $email, string $code): array
{
    if (!isset($_SESSION['email_verification'])) {
        return ['success' => false, 'error' => 'Код подтверждения не найден. Запросите новый код.'];
    }

    $verification = $_SESSION['email_verification'];

    // Проверяем срок действия
    if (time() > $verification['expires_at']) {
        unset($_SESSION['email_verification']);
        return ['success' => false, 'error' => 'Код подтверждения истек. Запросите новый код.'];
    }

    // Проверяем email (нормализуем для сравнения)
    $storedEmail = trim(mb_strtolower($verification['email']));
    $inputEmail = trim(mb_strtolower($email));
    if ($storedEmail !== $inputEmail) {
        error_log('Email mismatch: stored=' . $storedEmail . ', input=' . $inputEmail);
        return ['success' => false, 'error' => 'Email не совпадает.'];
    }

    // Проверяем количество попыток
    if ($verification['attempts'] >= 5) {
        unset($_SESSION['email_verification']);
        return ['success' => false, 'error' => 'Превышено количество попыток. Запросите новый код.'];
    }

    // Нормализуем код для сравнения (убираем пробелы, приводим к строке, только цифры)
    $storedCode = (string)trim($verification['code']);
    $inputCode = (string)trim(preg_replace('/\D/', '', $code));
    
    // Отладочная информация
    error_log('Email verification check: stored_code=' . $storedCode . ' (len=' . strlen($storedCode) . '), input_code=' . $inputCode . ' (len=' . strlen($inputCode) . '), email=' . $email);
    
    // Проверяем код (строгое сравнение после нормализации)
    if ($storedCode !== $inputCode) {
        // Увеличиваем счетчик попыток только если код неверный
        $_SESSION['email_verification']['attempts']++;
        $remaining = 5 - $_SESSION['email_verification']['attempts'];
        error_log('Email verification failed: stored=' . $storedCode . ', input=' . $inputCode);
        return [
            'success' => false,
            'error' => 'Неверный код. Осталось попыток: ' . max(0, $remaining)
        ];
    }

    // Код верный - удаляем из сессии
    unset($_SESSION['email_verification']);

    return ['success' => true];
}

/**
 * Получает email из сессии подтверждения
 */
function getVerificationEmail(): ?string
{
    return $_SESSION['email_verification']['email'] ?? null;
}

/**
 * Проверяет, есть ли активный код подтверждения
 */
function hasActiveVerification(): bool
{
    if (!isset($_SESSION['email_verification'])) {
        return false;
    }

    $verification = $_SESSION['email_verification'];
    return time() <= $verification['expires_at'];
}

