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

// Отправляем email - пробуем несколько вариантов
$emailSent = false;
$lastError = '';

// Вариант 1: Простое текстовое письмо (самый надежный)
try {
    $simpleHeaders = [
        'From: NovaCreator Studio <noreply@novacreator-studio.com>',
        'Reply-To: ' . $email,
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . phpversion()
    ];
    
    $emailSent = @mail($emailTo, $subject, $emailMessageText, implode("\r\n", $simpleHeaders));
    
    if ($emailSent) {
        error_log("Email успешно отправлен простым способом на {$emailTo}");
    } else {
        $errorInfo = error_get_last();
        $lastError = ($errorInfo && isset($errorInfo['message'])) ? $errorInfo['message'] : 'Неизвестная ошибка';
        error_log("Первый способ не сработал: {$lastError}");
    }
} catch (Exception $e) {
    $lastError = $e->getMessage();
    error_log('Ошибка отправки email (вариант 1): ' . $lastError);
}

// Вариант 2: Если простой не сработал, пробуем HTML
if (!$emailSent) {
    try {
        $htmlHeaders = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: NovaCreator Studio <noreply@novacreator-studio.com>',
            'Reply-To: ' . $email,
            'X-Mailer: PHP/' . phpversion()
        ];
        
        $emailSent = @mail($emailTo, $subject, $emailMessageHTML, implode("\r\n", $htmlHeaders));
        
        if ($emailSent) {
            error_log("Email успешно отправлен HTML способом на {$emailTo}");
        } else {
            $errorInfo = error_get_last();
            $lastError = ($errorInfo && isset($errorInfo['message'])) ? $errorInfo['message'] : 'Неизвестная ошибка';
            error_log("Второй способ не сработал: {$lastError}");
        }
    } catch (Exception $e) {
        $lastError = $e->getMessage();
        error_log('Ошибка отправки email (вариант 2): ' . $lastError);
    }
}

// Вариант 3: Если и HTML не сработал, пробуем multipart
if (!$emailSent) {
    try {
        $emailSent = @mail($emailTo, $subject, $emailBody, implode("\r\n", $headers));
        
        if ($emailSent) {
            error_log("Email успешно отправлен multipart способом на {$emailTo}");
        } else {
            $errorInfo = error_get_last();
            $lastError = ($errorInfo && isset($errorInfo['message'])) ? $errorInfo['message'] : 'Неизвестная ошибка';
            error_log("Третий способ не сработал: {$lastError}");
        }
    } catch (Exception $e) {
        $lastError = $e->getMessage();
        error_log('Ошибка отправки email (вариант 3): ' . $lastError);
    }
}

// Если email не отправился, но файл сохранился - считаем успехом
// Заявка будет в файле и можно будет обработать вручную
if (!$emailSent && $fileSaved) {
    error_log("ВНИМАНИЕ: Email не отправлен, но заявка сохранена в файл: {$logFile}");
    error_log("Последняя ошибка: {$lastError}");
}

// Возвращаем результат
// Считаем успехом, если либо email отправлен, либо файл сохранен
if ($emailSent || $fileSaved) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.',
        'email_sent' => $emailSent,
        'saved_to_file' => $fileSaved
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка при отправке заявки. Попробуйте позже или свяжитесь с нами напрямую по телефону или email.'
    ]);
}
?>
