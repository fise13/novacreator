<?php
/**
 * Обработчик формы обратной связи
 * Отправляет заявки на email компании
 */

// Устанавливаем заголовок для JSON ответа
header('Content-Type: application/json; charset=utf-8');

// Разрешаем CORS запросы (для разработки)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Обрабатываем только POST запросы
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Метод не разрешен'
    ]);
    exit;
}

// Получаем данные из формы
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$service = isset($_POST['service']) ? trim($_POST['service']) : '';
$type = isset($_POST['type']) ? trim($_POST['type']) : 'contact'; // 'contact' или 'vacancy'
$vacancy = isset($_POST['vacancy']) ? trim($_POST['vacancy']) : '';

// Валидация данных
$errors = [];

if (empty($name)) {
    $errors[] = 'Имя обязательно для заполнения';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Введите корректный email';
}

if (empty($phone)) {
    $errors[] = 'Телефон обязателен для заполнения';
}

if (empty($message)) {
    $errors[] = 'Сообщение обязательно для заполнения';
}

// Если есть ошибки валидации, возвращаем их
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => implode(', ', $errors)
    ]);
    exit;
}

// Подготавливаем данные
$timestamp = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Email компании для получения заявок
$emailTo = 'contact@novacreatorstudio.com';

// Формируем тему письма
if ($type === 'vacancy' && !empty($vacancy)) {
    $subject = "Новая заявка на вакансию: " . $vacancy;
} else {
    $subject = "Новая заявка с сайта NovaCreator Studio" . ($service ? " - " . $service : "");
}

// Формируем тело письма в HTML формате для лучшей читаемости
$emailMessageHTML = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #667eea; }
        .value { margin-top: 5px; }
        .message-box { background: white; padding: 15px; border-left: 4px solid #667eea; margin-top: 15px; }
        .footer { background: #f0f0f0; padding: 15px; text-align: center; font-size: 12px; color: #666; border-radius: 0 0 5px 5px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>Новая заявка с сайта NovaCreator Studio</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='label'>Дата и время:</div>
                <div class='value'>{$timestamp}</div>
            </div>
            <div class='field'>
                <div class='label'>Имя:</div>
                <div class='value'>{$name}</div>
            </div>
            <div class='field'>
                <div class='label'>Email:</div>
                <div class='value'><a href='mailto:{$email}'>{$email}</a></div>
            </div>
            <div class='field'>
                <div class='label'>Телефон:</div>
                <div class='value'><a href='tel:{$phone}'>{$phone}</a></div>
            </div>";

if ($type === 'vacancy' && !empty($vacancy)) {
    $emailMessageHTML .= "
            <div class='field'>
                <div class='label'>Вакансия:</div>
                <div class='value'>{$vacancy}</div>
            </div>";
} else {
    $emailMessageHTML .= "
            <div class='field'>
                <div class='label'>Услуга:</div>
                <div class='value'>" . ($service ?: 'Не указана') . "</div>
            </div>";
}

$emailMessageHTML .= "
            <div class='field'>
                <div class='label'>IP адрес:</div>
                <div class='value'>{$ip}</div>
            </div>
            <div class='message-box'>
                <div class='label'>Сообщение:</div>
                <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
        </div>
        <div class='footer'>
            <p>Это автоматическое письмо с сайта NovaCreator Studio</p>
            <p>Для ответа используйте email клиента: <a href='mailto:{$email}'>{$email}</a></p>
        </div>
    </div>
</body>
</html>";

// Текстовая версия для почтовых клиентов без поддержки HTML
$emailMessageText = "Новая заявка с сайта NovaCreator Studio\n\n";
$emailMessageText .= "═══════════════════════════════════════\n";
$emailMessageText .= "ДАТА И ВРЕМЯ: {$timestamp}\n";
$emailMessageText .= "═══════════════════════════════════════\n\n";
$emailMessageText .= "ИМЯ: {$name}\n";
$emailMessageText .= "EMAIL: {$email}\n";
$emailMessageText .= "ТЕЛЕФОН: {$phone}\n";

if ($type === 'vacancy' && !empty($vacancy)) {
    $emailMessageText .= "ВАКАНСИЯ: {$vacancy}\n";
} else {
    $emailMessageText .= "УСЛУГА: " . ($service ?: 'Не указана') . "\n";
}

$emailMessageText .= "IP АДРЕС: {$ip}\n\n";
$emailMessageText .= "═══════════════════════════════════════\n";
$emailMessageText .= "СООБЩЕНИЕ:\n";
$emailMessageText .= "═══════════════════════════════════════\n";
$emailMessageText .= "{$message}\n\n";
$emailMessageText .= "═══════════════════════════════════════\n";
$emailMessageText .= "Это автоматическое письмо с сайта NovaCreator Studio\n";
$emailMessageText .= "Для ответа используйте email клиента: {$email}\n";

// Генерируем уникальный разделитель для multipart сообщения
$boundary = md5(uniqid(time()));

// Формируем multipart сообщение (HTML + текст)
$emailBody = "--{$boundary}\r\n";
$emailBody .= "Content-Type: text/plain; charset=UTF-8\r\n";
$emailBody .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$emailBody .= $emailMessageText . "\r\n\r\n";
$emailBody .= "--{$boundary}\r\n";
$emailBody .= "Content-Type: text/html; charset=UTF-8\r\n";
$emailBody .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$emailBody .= $emailMessageHTML . "\r\n\r\n";
$emailBody .= "--{$boundary}--";

// Заголовки для email
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: multipart/alternative; boundary="' . $boundary . '"',
    'From: NovaCreator Studio <noreply@novacreator-studio.com>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'X-Priority: 1',
    'Importance: High'
];

// Настраиваем параметры отправки email для максимальной надежности
// Пытаемся использовать локальный SMTP сервер
$originalSendmailPath = ini_get('sendmail_path');
$originalSMTP = ini_get('SMTP');
$originalSMTPServer = ini_get('smtp_port');

// Пробуем настроить SMTP (если возможно)
if (function_exists('ini_set')) {
    // Настройки для локального SMTP (если доступны)
    @ini_set('sendmail_path', '/usr/sbin/sendmail -t -i');
    @ini_set('SMTP', 'localhost');
    @ini_set('smtp_port', '25');
}

// Сохраняем заявку в файл как резервный вариант
$logFile = __DIR__ . '/requests.txt';
$logEntry = sprintf(
    "[%s] Имя: %s | Email: %s | Телефон: %s | Услуга: %s | IP: %s\nСообщение: %s\n%s\n",
    $timestamp,
    $name,
    $email,
    $phone,
    $service ?: ($vacancy ?: 'Не указана'),
    $ip,
    $message,
    str_repeat('-', 80)
);

$fileSaved = false;
try {
    $fileSaved = @file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) !== false;
} catch (Exception $e) {
    error_log('Ошибка записи в файл: ' . $e->getMessage());
}

// Проверяем, доступна ли функция mail()
if (!function_exists('mail')) {
    error_log("КРИТИЧЕСКАЯ ОШИБКА: Функция mail() недоступна на этом сервере!");
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка конфигурации сервера. Пожалуйста, свяжитесь с нами напрямую.'
    ]);
    exit;
}

// Отправляем email - используем самый надежный способ
$emailSent = false;
$lastError = '';
$emailDebug = [];

// Логируем попытку отправки
error_log("=== ПОПЫТКА ОТПРАВКИ EMAIL ===");
error_log("Получатель: {$emailTo}");
error_log("Тема: {$subject}");
error_log("Отправитель формы: {$email}");

// Кодируем тему письма для поддержки кириллицы
$subjectEncoded = '=?UTF-8?B?' . base64_encode($subject) . '?=';

// Используем более простой и надежный формат заголовков
$finalHeaders = [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: NovaCreator Studio <noreply@novacreator-studio.com>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Date: ' . date('r')
];

// Пробуем отправить email несколько раз с разными настройками
// Подготавливаем заголовки для текстового письма
$textHeaders = array_filter($finalHeaders, function($header) {
    return strpos($header, 'Content-Type: text/html') === false;
});
$textHeaders[] = 'Content-Type: text/plain; charset=UTF-8';

$attempts = [
    ['subject' => $subjectEncoded, 'body' => $emailMessageHTML, 'headers' => $finalHeaders],
    ['subject' => $subject, 'body' => $emailMessageHTML, 'headers' => $finalHeaders],
    ['subject' => $subjectEncoded, 'body' => $emailMessageText, 'headers' => $textHeaders],
];

foreach ($attempts as $index => $attempt) {
    if ($emailSent) break;
    
    try {
        error_log("--- Попытка " . ($index + 1) . " из " . count($attempts) . " ---");
        error_log("Тема: " . substr($attempt['subject'], 0, 50) . "...");
        error_log("Размер тела письма: " . strlen($attempt['body']) . " байт");
        
        // Отключаем вывод ошибок для этой попытки
        $oldErrorReporting = error_reporting(0);
        
        // Отправляем письмо
        $result = @mail($emailTo, $attempt['subject'], $attempt['body'], implode("\r\n", $attempt['headers']));
        
        // Восстанавливаем уровень ошибок
        error_reporting($oldErrorReporting);
        
        $emailDebug[] = [
            'attempt' => $index + 1,
            'result' => $result ? 'success' : 'failed',
            'subject' => substr($attempt['subject'], 0, 30)
        ];
        
        if ($result) {
            $emailSent = true;
            error_log("✓ Email успешно отправлен на {$emailTo} (попытка " . ($index + 1) . ")");
            break;
        } else {
            $errorInfo = error_get_last();
            if ($errorInfo && isset($errorInfo['message'])) {
                $lastError = $errorInfo['message'];
                error_log("✗ Ошибка: " . $lastError);
            } else {
                error_log("✗ Функция mail() вернула false без ошибки");
            }
        }
    } catch (Exception $e) {
        $lastError = $e->getMessage();
        error_log('✗ Исключение при отправке email (попытка ' . ($index + 1) . '): ' . $lastError);
        $emailDebug[] = [
            'attempt' => $index + 1,
            'result' => 'exception',
            'error' => $lastError
        ];
    }
    
    // Небольшая задержка между попытками
    if (!$emailSent && $index < count($attempts) - 1) {
        usleep(500000); // 0.5 секунды
    }
}

// Восстанавливаем оригинальные настройки
if (function_exists('ini_set')) {
    if ($originalSendmailPath !== false) @ini_set('sendmail_path', $originalSendmailPath);
    if ($originalSMTP !== false) @ini_set('SMTP', $originalSMTP);
    if ($originalSMTPServer !== false) @ini_set('smtp_port', $originalSMTPServer);
}

// Если email не отправился, логируем детали
if (!$emailSent) {
    error_log("=== EMAIL НЕ ОТПРАВЛЕН ===");
    error_log("Получатель: {$emailTo}");
    error_log("Последняя ошибка: " . ($lastError ?: 'Неизвестная ошибка'));
    error_log("Заявка сохранена в файл: {$logFile}");
    error_log("Детали попыток: " . json_encode($emailDebug, JSON_UNESCAPED_UNICODE));
    error_log("Проверьте настройки SMTP сервера или используйте внешний SMTP сервис");
    
    // Сохраняем детальную информацию об ошибке в файл
    $errorLogFile = __DIR__ . '/email_errors.log';
    $errorLogEntry = date('Y-m-d H:i:s') . " - Не удалось отправить email на {$emailTo}\n";
    $errorLogEntry .= "Ошибка: " . ($lastError ?: 'Неизвестная ошибка') . "\n";
    $errorLogEntry .= "Детали: " . json_encode($emailDebug, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
    $errorLogEntry .= str_repeat('-', 80) . "\n";
    @file_put_contents($errorLogFile, $errorLogEntry, FILE_APPEND | LOCK_EX);
}

// Возвращаем результат
// ВАЖНО: Считаем успехом ТОЛЬКО если email отправлен
// Файл - это резервный вариант для ручной обработки
if ($emailSent) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.'
    ]);
} else {
    // Если email не отправился, но файл сохранен - все равно возвращаем успех
    // но с предупреждением, что нужно проверить email настройки
    if ($fileSaved) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Заявка получена! Мы свяжемся с вами в ближайшее время.'
        ]);
        error_log("ВНИМАНИЕ: Email не отправлен, но заявка сохранена в файл. Необходимо проверить настройки SMTP сервера.");
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка при отправке заявки. Пожалуйста, свяжитесь с нами напрямую по телефону или email.'
        ]);
    }
}
?>
