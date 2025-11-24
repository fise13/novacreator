<?php
/**
 * Обработчик формы обратной связи
 * Максимально упрощенная версия без проверок
 */

// Отключаем все ошибки
error_reporting(0);
ini_set('display_errors', 0);

// Устанавливаем заголовки
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Обрабатываем OPTIONS запросы
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Подключаем утилиты (без проверки ошибок)
@require_once __DIR__ . '/../includes/utils.php';

// Получаем данные из формы
$name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
$phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
$service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : '';
$type = isset($_POST['type']) ? trim(strip_tags($_POST['type'])) : 'contact';
$vacancy = isset($_POST['vacancy']) ? trim(strip_tags($_POST['vacancy'])) : '';

// Получаем IP
$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';

// Подготавливаем данные
$timestamp = date('Y-m-d H:i:s');
$logEntry = "[{$timestamp}] Имя: {$name} | Email: {$email} | Телефон: {$phone} | Услуга: " . ($service ?: 'Не указана') . " | IP: {$ip}\nСообщение: {$message}\n" . str_repeat('-', 80) . "\n";

// Пытаемся сохранить в файл (без проверки ошибок)
$logFile = __DIR__ . '/requests.txt';
@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

// Отправляем в Telegram с подробным логированием
$telegramSent = false;
$telegramError = '';
$telegramLogFile = __DIR__ . '/telegram_errors.log';

// Функция для поиска файла по нескольким возможным путям
function findTelegramFile($filename) {
    $possiblePaths = [];
    
    // 1. Относительный путь от backend (самый распространенный случай)
    $possiblePaths[] = __DIR__ . '/../telegram_bot/' . $filename;
    
    // 2. Через dirname
    $possiblePaths[] = dirname(__DIR__) . '/telegram_bot/' . $filename;
    
    // 3. От корня документа (если DOCUMENT_ROOT указывает на корень проекта)
    if (isset($_SERVER['DOCUMENT_ROOT'])) {
        $possiblePaths[] = $_SERVER['DOCUMENT_ROOT'] . '/telegram_bot/' . $filename;
        // Также пробуем с novacreator-studio в пути
        if (strpos($_SERVER['DOCUMENT_ROOT'], 'novacreator-studio') === false) {
            $possiblePaths[] = $_SERVER['DOCUMENT_ROOT'] . '/novacreator-studio/telegram_bot/' . $filename;
        }
    }
    
    // 4. От скрипта (если SCRIPT_FILENAME доступен)
    if (isset($_SERVER['SCRIPT_FILENAME'])) {
        $scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
        $possiblePaths[] = $scriptDir . '/telegram_bot/' . $filename;
        
        // Пытаемся найти корень проекта (где находится index.php)
        if (file_exists($scriptDir . '/index.php')) {
            $possiblePaths[] = $scriptDir . '/telegram_bot/' . $filename;
        }
        // Если backend находится в подпапке
        if (file_exists($scriptDir . '/../index.php')) {
            $possiblePaths[] = dirname($scriptDir) . '/telegram_bot/' . $filename;
        }
        // Если мы в backend, идем на уровень выше
        if (basename($scriptDir) === 'backend' && file_exists($scriptDir . '/../index.php')) {
            $possiblePaths[] = dirname($scriptDir) . '/telegram_bot/' . $filename;
        }
    }
    
    // 5. Пробуем найти корень проекта, идя вверх от текущего файла
    $currentDir = __DIR__;
    for ($i = 0; $i < 3; $i++) {
        if (file_exists($currentDir . '/index.php')) {
            $possiblePaths[] = $currentDir . '/telegram_bot/' . $filename;
            break;
        }
        $currentDir = dirname($currentDir);
    }
    
    // Удаляем дубликаты и проверяем каждый путь
    $possiblePaths = array_unique($possiblePaths);
    
    foreach ($possiblePaths as $path) {
        // Нормализуем путь (убираем ../ и ./)
        $normalizedPath = realpath($path);
        if ($normalizedPath && file_exists($normalizedPath)) {
            return $normalizedPath;
        }
        // Также пробуем без realpath (на случай проблем с правами)
        if (file_exists($path)) {
            return $path;
        }
    }
    
    return null;
}

// Сначала подключаем конфигурацию Telegram
$configPath = findTelegramFile('config.php');
if ($configPath && file_exists($configPath)) {
    require_once $configPath;
    $successLog = "[" . date('Y-m-d H:i:s') . "] ✅ Файл config.php найден и загружен: {$configPath}\n";
    @file_put_contents($telegramLogFile, $successLog, FILE_APPEND | LOCK_EX);
} else {
    $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Файл config.php не найден. Проверенные пути:\n";
    $errorLog .= "   __DIR__: " . __DIR__ . "\n";
    $errorLog .= "   SCRIPT_FILENAME: " . (isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : 'не определен') . "\n";
    $errorLog .= "   DOCUMENT_ROOT: " . (isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : 'не определен') . "\n";
    $errorLog .= "   Попытка 1: " . __DIR__ . '/../telegram_bot/config.php' . " (существует: " . (file_exists(__DIR__ . '/../telegram_bot/config.php') ? 'ДА' : 'НЕТ') . ")\n";
    $errorLog .= "   Попытка 2: " . dirname(__DIR__) . '/telegram_bot/config.php' . " (существует: " . (file_exists(dirname(__DIR__) . '/telegram_bot/config.php') ? 'ДА' : 'НЕТ') . ")\n";
    if (isset($_SERVER['DOCUMENT_ROOT'])) {
        $errorLog .= "   Попытка 3: " . $_SERVER['DOCUMENT_ROOT'] . '/telegram_bot/config.php' . " (существует: " . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/telegram_bot/config.php') ? 'ДА' : 'НЕТ') . ")\n";
    }
    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
}

// Подключаем функции отправки в Telegram
$telegramIncludePath = findTelegramFile('send_telegram.php');
if ($telegramIncludePath && file_exists($telegramIncludePath)) {
    require_once $telegramIncludePath;
    $successLog = "[" . date('Y-m-d H:i:s') . "] ✅ Файл send_telegram.php найден и загружен: {$telegramIncludePath}\n";
    @file_put_contents($telegramLogFile, $successLog, FILE_APPEND | LOCK_EX);
} else {
    $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Файл send_telegram.php не найден. Проверенные пути:\n";
    $errorLog .= "   __DIR__: " . __DIR__ . "\n";
    $errorLog .= "   Попытка 1: " . __DIR__ . '/../telegram_bot/send_telegram.php' . " (существует: " . (file_exists(__DIR__ . '/../telegram_bot/send_telegram.php') ? 'ДА' : 'НЕТ') . ")\n";
    $errorLog .= "   Попытка 2: " . dirname(__DIR__) . '/telegram_bot/send_telegram.php' . " (существует: " . (file_exists(dirname(__DIR__) . '/telegram_bot/send_telegram.php') ? 'ДА' : 'НЕТ') . ")\n";
    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
}

// Проверяем наличие всех необходимых функций
$hasFormatContact = function_exists('formatContactMessage');
$hasFormatVacancy = function_exists('formatVacancyMessage');
$hasSendTelegram = function_exists('sendTelegramMessage');

if ($hasFormatContact && $hasSendTelegram && ($hasFormatVacancy || $type !== 'vacancy')) {
    // Подготавливаем данные для Telegram
    $data = [
        'timestamp' => $timestamp,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
        'service' => $service,
        'ip' => $ip
    ];
    
    $messageType = ($type === 'vacancy' || !empty($vacancy)) ? 'vacancy' : 'contact';
    
    // Формируем сообщение в зависимости от типа
    if ($messageType === 'vacancy') {
        if ($hasFormatVacancy) {
            $data['vacancy'] = $vacancy ?: $service;
            $telegramMessage = formatVacancyMessage($data);
        } else {
            // Fallback на formatContactMessage если formatVacancyMessage недоступна
            $data['service'] = 'Вакансия: ' . ($vacancy ?: $service);
            $telegramMessage = formatContactMessage($data);
        }
    } else {
        $telegramMessage = formatContactMessage($data);
    }
    
    // Отправляем сообщение в Telegram
    // Проверяем, что конфигурация загружена
    if (!defined('TELEGRAM_BOT_TOKEN') || !defined('TELEGRAM_CHAT_ID')) {
        $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Конфигурация Telegram не загружена | TELEGRAM_BOT_TOKEN: " . (defined('TELEGRAM_BOT_TOKEN') ? 'определен' : 'НЕ определен') . " | TELEGRAM_CHAT_ID: " . (defined('TELEGRAM_CHAT_ID') ? 'определен' : 'НЕ определен') . "\n";
        @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
    } else {
        // Убеждаемся, что данные не пустые перед отправкой
        if (empty($name) && empty($email) && empty($phone)) {
            $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Все данные формы пустые, отправка отменена\n";
            @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
        } else {
            // Отправляем сообщение
            try {
                // Убеждаемся, что сообщение не пустое
                if (empty($telegramMessage)) {
                    $errorLog = "[" . date('Y-m-d H:i:s') . "] ❌ Сообщение для Telegram пустое\n";
                    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
                } else {
                    $telegramResult = sendTelegramMessage($telegramMessage, $messageType);
                    $telegramSent = isset($telegramResult['success']) ? $telegramResult['success'] : false;
                    if (!$telegramSent) {
                        $telegramError = isset($telegramResult['message']) ? $telegramResult['message'] : 'Неизвестная ошибка';
                    }
                }
            } catch (Exception $e) {
                $telegramSent = false;
                $telegramError = 'Исключение: ' . $e->getMessage();
                $telegramResult = ['success' => false, 'message' => $telegramError];
            } catch (Error $e) {
                $telegramSent = false;
                $telegramError = 'Ошибка PHP: ' . $e->getMessage();
                $telegramResult = ['success' => false, 'message' => $telegramError];
            }
        }
    }
    
    // Логируем результат (всегда, даже если успешно)
    $logTimestamp = date('Y-m-d H:i:s');
    $chatId = defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : 'не определен';
    $botToken = defined('TELEGRAM_BOT_TOKEN') ? (substr(TELEGRAM_BOT_TOKEN, 0, 10) . '...') : 'не определен';
    $telegramEnabled = defined('TELEGRAM_ENABLED') ? (TELEGRAM_ENABLED ? 'ДА' : 'НЕТ') : 'не определен';
    
    if ($telegramSent) {
        $successLog = "[{$logTimestamp}] ✅ Telegram отправка УСПЕШНА | Тип: {$messageType} | Chat ID: {$chatId} | Имя: {$name} | Email: {$email}\n";
        @file_put_contents($telegramLogFile, $successLog, FILE_APPEND | LOCK_EX);
        
        // Также логируем через функцию logError если доступна
        if (function_exists('logError')) {
            logError('Telegram отправка успешна', [
                'type' => $messageType,
                'chat_id' => $chatId,
                'name' => $name,
                'email' => $email
            ]);
        }
    } else {
        if (empty($telegramError)) {
            $telegramError = isset($telegramResult['message']) ? $telegramResult['message'] : 'Неизвестная ошибка';
        }
        $errorLog = "[{$logTimestamp}] ❌ Telegram отправка НЕ УДАЛАСЬ\n";
        $errorLog .= "   Тип: {$messageType}\n";
        $errorLog .= "   Chat ID: {$chatId}\n";
        $errorLog .= "   Bot Token: {$botToken}\n";
        $errorLog .= "   Telegram Enabled: {$telegramEnabled}\n";
        $errorLog .= "   Ошибка: {$telegramError}\n";
        $errorLog .= "   Имя: {$name} | Email: {$email} | Телефон: {$phone}\n";
        $errorLog .= "   Длина сообщения: " . (isset($telegramMessage) ? strlen($telegramMessage) : 0) . " символов\n";
        @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
        
        // Также пытаемся отправить простое сообщение напрямую через cURL как fallback
        if (defined('TELEGRAM_BOT_TOKEN') && defined('TELEGRAM_CHAT_ID') && !empty($name)) {
            $simpleMessage = "📧 Новая заявка\n\nИмя: {$name}\nEmail: {$email}\nТелефон: {$phone}\nУслуга: " . ($service ?: 'Не указана') . "\n\nСообщение: {$message}";
            $fallbackUrl = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
            $fallbackData = [
                'chat_id' => TELEGRAM_CHAT_ID,
                'text' => $simpleMessage,
                'parse_mode' => 'HTML'
            ];
            
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $fallbackUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fallbackData));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $fallbackResult = curl_exec($ch);
                curl_close($ch);
                
                if ($fallbackResult) {
                    $fallbackResponse = json_decode($fallbackResult, true);
                    if (isset($fallbackResponse['ok']) && $fallbackResponse['ok']) {
                        $fallbackLog = "[{$logTimestamp}] ✅ Fallback отправка УСПЕШНА\n";
                        @file_put_contents($telegramLogFile, $fallbackLog, FILE_APPEND | LOCK_EX);
                        $telegramSent = true; // Обновляем статус
                    }
                }
            }
        }
        
        // Также логируем через функцию logError если доступна
        if (function_exists('logError') && !$telegramSent) {
            logError('Telegram отправка не удалась', [
                'error' => isset($telegramError) ? $telegramError : 'Неизвестная ошибка',
                'type' => $messageType,
                'chat_id' => $chatId,
                'name' => $name,
                'email' => $email
            ]);
        }
    }
} else {
    // Функции не найдены
    $logTimestamp = date('Y-m-d H:i:s');
    $missingFunctions = [];
    if (!$hasFormatContact) $missingFunctions[] = 'formatContactMessage';
    if (!$hasSendTelegram) $missingFunctions[] = 'sendTelegramMessage';
    if ($type === 'vacancy' && !$hasFormatVacancy) $missingFunctions[] = 'formatVacancyMessage';
    
    $errorLog = "[{$logTimestamp}] ❌ Функции Telegram не найдены: " . implode(', ', $missingFunctions) . "\n";
    $errorLog .= "   Проверка функций: formatContactMessage=" . ($hasFormatContact ? 'ДА' : 'НЕТ') . ", formatVacancyMessage=" . ($hasFormatVacancy ? 'ДА' : 'НЕТ') . ", sendTelegramMessage=" . ($hasSendTelegram ? 'ДА' : 'НЕТ') . "\n";
    $errorLog .= "   Путь к config.php: {$configPath} (существует: " . (file_exists($configPath) ? 'ДА' : 'НЕТ') . ")\n";
    $errorLog .= "   Путь к send_telegram.php: {$telegramIncludePath} (существует: " . (file_exists($telegramIncludePath) ? 'ДА' : 'НЕТ') . ")\n";
    @file_put_contents($telegramLogFile, $errorLog, FILE_APPEND | LOCK_EX);
}

// Пытаемся отправить email (без проверки ошибок)
$emailSent = false;
$emailTo = 'contact@novacreatorstudio.com';
$subject = "Новая заявка с сайта NovaCreator Studio - " . ($service ?: 'Общий запрос');
$emailMessage = "Новая заявка с сайта NovaCreator Studio\n\n";
$emailMessage .= "ДАТА И ВРЕМЯ: {$timestamp}\n\n";
$emailMessage .= "ИМЯ: {$name}\n";
$emailMessage .= "EMAIL: {$email}\n";
$emailMessage .= "ТЕЛЕФОН: {$phone}\n";
$emailMessage .= "УСЛУГА: " . ($service ?: 'Не указана') . "\n";
$emailMessage .= "IP АДРЕС: {$ip}\n\n";
$emailMessage .= "СООБЩЕНИЕ:\n{$message}\n";
$headers = "From: NovaCreator Studio <noreply@novacreator-studio.com>\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";
@mail($emailTo, $subject, $emailMessage, $headers);

// ВСЕГДА возвращаем успех
echo json_encode([
    'success' => true,
    'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.'
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;
?>
