<?php
/**
 * Обработчик формы обратной связи
 * Принимает POST запросы, сохраняет данные в файл и отправляет на email
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

// Подготавливаем данные для сохранения
$timestamp = date('Y-m-d H:i:s');
$data = [
    'timestamp' => $timestamp,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message,
    'service' => $service,
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// Форматируем строку для записи в файл
$logEntry = sprintf(
    "[%s] Имя: %s | Email: %s | Телефон: %s | Услуга: %s | IP: %s\nСообщение: %s\n%s\n",
    $timestamp,
    $name,
    $email,
    $phone,
    $service ?: 'Не указана',
    $data['ip'],
    $message,
    str_repeat('-', 80)
);

// Путь к файлу для сохранения заявок
$logFile = __DIR__ . '/requests.txt';

// Сохраняем данные в файл
$fileSaved = false;
try {
    // Создаем файл, если его нет, и добавляем данные в конец
    $fileSaved = file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) !== false;
} catch (Exception $e) {
    error_log('Ошибка записи в файл: ' . $e->getMessage());
}

// Отправляем уведомление в Telegram
$telegramSent = false;
try {
    // Подключаем функции для работы с Telegram
    require_once __DIR__ . '/../telegram_bot/send_telegram.php';
    
    // Определяем тип сообщения (вакансия или контакт)
    $messageType = ($type === 'vacancy' || !empty($vacancy)) ? 'vacancy' : 'contact';
    
    // Форматируем сообщение для Telegram
    if ($messageType === 'vacancy') {
        // Добавляем информацию о вакансии в данные
        $data['vacancy'] = $vacancy ?: $service;
        $telegramMessage = formatVacancyMessage($data);
    } else {
        $telegramMessage = formatContactMessage($data);
    }
    
    // Отправляем в Telegram
    $telegramResult = sendTelegramMessage($telegramMessage, $messageType);
    $telegramSent = $telegramResult['success'];
    
    // Логируем результат
    if (!$telegramSent) {
        error_log('Telegram отправка не удалась: ' . $telegramResult['message']);
        // Также сохраняем в файл для отладки
        @file_put_contents(__DIR__ . '/telegram_errors.log', date('Y-m-d H:i:s') . ' - ' . $telegramResult['message'] . "\n", FILE_APPEND);
    } else {
        error_log('Telegram сообщение успешно отправлено');
    }
} catch (Exception $e) {
    error_log('Ошибка при отправке в Telegram: ' . $e->getMessage());
}

// Отправляем email на contact@novacreatorstudio.com
$emailSent = false;
$emailTo = 'contact@novacreatorstudio.com'; // Email для получения всех заявок

// Формируем тему письма
$subject = "Новая заявка с сайта NovaCreator Studio - " . ($service ?: 'Общий запрос');

// Формируем тело письма (более читаемый формат)
$emailMessage = "Новая заявка с сайта NovaCreator Studio\n\n";
$emailMessage .= "═══════════════════════════════════════\n";
$emailMessage .= "ДАТА И ВРЕМЯ: {$timestamp}\n";
$emailMessage .= "═══════════════════════════════════════\n\n";
$emailMessage .= "ИМЯ: {$name}\n";
$emailMessage .= "EMAIL: {$email}\n";
$emailMessage .= "ТЕЛЕФОН: {$phone}\n";
$emailMessage .= "УСЛУГА: " . ($service ?: 'Не указана') . "\n";
$emailMessage .= "IP АДРЕС: {$data['ip']}\n\n";
$emailMessage .= "═══════════════════════════════════════\n";
$emailMessage .= "СООБЩЕНИЕ:\n";
$emailMessage .= "═══════════════════════════════════════\n";
$emailMessage .= "{$message}\n\n";
$emailMessage .= "═══════════════════════════════════════\n";
$emailMessage .= "Это автоматическое письмо с сайта NovaCreator Studio\n";
$emailMessage .= "Для ответа используйте email клиента: {$email}\n";

// Заголовки для email
$headers = [
    'From: NovaCreator Studio <noreply@novacreator-studio.com>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=utf-8',
    'MIME-Version: 1.0'
];

// Пытаемся отправить email
try {
    // ВАЖНО: Функция mail() работает только если на сервере настроена почта
    // На локальном сервере (localhost) может не работать без настройки SMTP
    // На хостинге обычно работает автоматически
    $emailSent = @mail($emailTo, $subject, $emailMessage, implode("\r\n", $headers));
    
    // Логируем результат для отладки
    if (!$emailSent) {
        error_log("Не удалось отправить email на {$emailTo}. Проверьте настройки сервера.");
    }
} catch (Exception $e) {
    error_log('Ошибка отправки email: ' . $e->getMessage());
}

try {
    require_once __DIR__ . '/../client/config.php';
    
    $users = loadUsers();
    $clientId = null;
    
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $clientId = $user['id'];
            break;
        }
    }
    
    if (!$clientId && !empty($service)) {
        $newUser = [
            'id' => time(),
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash('temp' . time(), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $users[] = $newUser;
        saveUsers($users);
        $clientId = $newUser['id'];
        
        $projects = loadProjects();
        $newProject = [
            'id' => time() + 1,
            'name' => $service . ' - ' . $name,
            'type' => $service,
            'client_id' => $clientId,
            'current_stage' => 'planning',
            'progress' => 5,
            'stages' => [],
            'files' => [],
            'created_at' => date('Y-m-d H:i:s'),
            'deadline' => date('Y-m-d', strtotime('+30 days'))
        ];
        
        $projects[] = $newProject;
        saveProjects($projects);
    }
} catch (Exception $e) {
    error_log('Ошибка создания проекта: ' . $e->getMessage());
}

if ($fileSaved) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.',
        'email_sent' => $emailSent,
        'telegram_sent' => $telegramSent,
        'saved_to_file' => true
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка при сохранении заявки. Попробуйте позже или свяжитесь с нами напрямую.'
    ]);
}
?>

