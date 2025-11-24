<?php
/**
 * Обработчик формы обратной связи
 * Принимает POST запросы, сохраняет данные в файл и отправляет на email
 */

// Включаем обработку ошибок для отладки (в продакшене можно отключить)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Не показываем ошибки пользователю, только логируем

// Подключаем утилиты
try {
    require_once __DIR__ . '/../includes/utils.php';
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка инициализации сервера. Попробуйте позже или свяжитесь с нами напрямую.'
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// Устанавливаем заголовок для JSON ответа
header('Content-Type: application/json; charset=utf-8');

// Разрешаем CORS запросы только с нашего домена (для безопасности)
$allowedOrigins = [
    'https://novacreator-studio.com',
    'https://www.novacreator-studio.com',
    'http://localhost:8000',
    'http://localhost',
    'http://127.0.0.1',
    'http://127.0.0.1:8000'
];

// Получаем origin из заголовков
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (empty($origin)) {
    // Если нет Origin заголовка, проверяем Referer (для запросов с того же домена)
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    if (!empty($referer)) {
        $parsedUrl = parse_url($referer);
        $origin = ($parsedUrl['scheme'] ?? 'http') . '://' . ($parsedUrl['host'] ?? '');
        if (!empty($parsedUrl['port'])) {
            $origin .= ':' . $parsedUrl['port'];
        }
    }
}

// Если origin в списке разрешенных или запрос с того же домена
if (in_array($origin, $allowedOrigins) || empty($origin)) {
    if (!empty($origin)) {
        header('Access-Control-Allow-Origin: ' . $origin);
    }
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
    header('Access-Control-Allow-Credentials: true');
}

// Обрабатываем только POST запросы
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse([
        'success' => false,
        'message' => 'Метод не разрешен. Используйте POST запрос.'
    ], 405);
    exit;
}

// Проверяем CSRF токен (если передан)
$csrfToken = $_POST['csrf_token'] ?? '';
if (!empty($csrfToken) && !verifyCSRFToken($csrfToken)) {
    jsonResponse([
        'success' => false,
        'message' => 'Ошибка безопасности. Обновите страницу и попробуйте снова.'
    ], 403);
}

// Проверяем rate limiting
$ip = getClientIP();
if (!checkRateLimit($ip, 10, 300)) {
    jsonResponse([
        'success' => false,
        'message' => 'Слишком много запросов. Попробуйте через несколько минут.'
    ], 429);
}

// Получаем и очищаем данные из формы
$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');
$service = sanitizeInput($_POST['service'] ?? '');
$type = sanitizeInput($_POST['type'] ?? 'contact');
$vacancy = sanitizeInput($_POST['vacancy'] ?? '');

// Валидация данных
$errors = [];

if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Имя должно содержать минимум 2 символа';
}

if (empty($email) || !validateEmail($email)) {
    $errors[] = 'Введите корректный email';
}

if (empty($phone) || !validatePhone($phone)) {
    $errors[] = 'Введите корректный телефон';
}

if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Сообщение должно содержать минимум 10 символов';
}

// Проверка на спам (базовая)
if (strlen($message) > 5000) {
    $errors[] = 'Сообщение слишком длинное';
}

// Если есть ошибки валидации, возвращаем их
if (!empty($errors)) {
    jsonResponse([
        'success' => false,
        'message' => implode(', ', $errors)
    ], 400);
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
    'ip' => getClientIP()
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
    // Проверяем, существует ли директория
    $logDir = dirname($logFile);
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    
    // Создаем файл, если его нет, и добавляем данные в конец
    $fileSaved = @file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) !== false;
    
    if (!$fileSaved) {
        error_log('Не удалось сохранить заявку в файл: ' . $logFile);
        // Проверяем права доступа
        if (!is_writable($logDir)) {
            error_log('Директория не доступна для записи: ' . $logDir);
        }
    }
} catch (Exception $e) {
    error_log('Ошибка записи в файл: ' . $e->getMessage());
    logError('Ошибка сохранения заявки в файл', ['error' => $e->getMessage(), 'file' => $logFile]);
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
    jsonResponse([
        'success' => true,
        'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.',
        'email_sent' => $emailSent,
        'telegram_sent' => $telegramSent,
        'saved_to_file' => true
    ], 200);
} else {
    logError('Ошибка сохранения заявки', ['ip' => getClientIP(), 'email' => $email]);
    jsonResponse([
        'success' => false,
        'message' => 'Ошибка при сохранении заявки. Попробуйте позже или свяжитесь с нами напрямую.'
    ], 500);
}
?>

