<?php
/**
 * Функция для отправки сообщений в Telegram
 * 
 * @param string $message - Текст сообщения для отправки
 * @param string $type - Тип сообщения: 'contact' (заявка) или 'vacancy' (вакансия)
 * @return array - Результат отправки ['success' => bool, 'message' => string]
 */
function sendTelegramMessage($message, $type = 'contact') {
    // Подключаем конфигурацию
    if (!defined('TELEGRAM_BOT_TOKEN')) {
        require_once __DIR__ . '/config.php';
    }
    
    // Проверяем, включена ли отправка в Telegram
    if (!TELEGRAM_ENABLED) {
        return [
            'success' => false,
            'message' => 'Telegram отправка отключена в конфигурации'
        ];
    }
    
    // Проверяем, что токен и Chat ID настроены
    if (TELEGRAM_BOT_TOKEN === 'YOUR_BOT_TOKEN_HERE' || TELEGRAM_CHAT_ID === 'YOUR_CHAT_ID_HERE') {
        return [
            'success' => false,
            'message' => 'Telegram бот не настроен. Проверьте config.php'
        ];
    }
    
    // Формируем URL для API Telegram
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    
    // Эмодзи в зависимости от типа сообщения (только если сообщение не начинается с эмодзи)
    $emoji = '';
    if ($type === 'vacancy') {
        $emoji = '💼 ';
    } elseif ($type === 'contact' && strpos($message, '💬') === false && strpos($message, '📧') === false) {
        $emoji = '📧 ';
    }
    
    // Формируем данные для отправки
    $data = [
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $emoji . $message,
        'parse_mode' => 'HTML' // Позволяет использовать HTML разметку
    ];
    
    // Используем cURL для более надежной отправки
    if (function_exists('curl_init')) {
        // Вариант с cURL (предпочтительный)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError) {
            return [
                'success' => false,
                'message' => 'Ошибка cURL: ' . $curlError
            ];
        }
        
        if ($httpCode !== 200) {
            // Пытаемся получить детали ошибки из ответа
            $errorDetails = '';
            if ($result) {
                $errorResponse = json_decode($result, true);
                if (isset($errorResponse['description'])) {
                    $errorDetails = ': ' . $errorResponse['description'];
                }
            }
            return [
                'success' => false,
                'message' => 'HTTP ошибка ' . $httpCode . $errorDetails
            ];
        }
    } else {
        // Fallback на file_get_contents если cURL недоступен
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
                'timeout' => 10
            ]
        ];
        
        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        
        if ($result === false) {
            return [
                'success' => false,
                'message' => 'Ошибка соединения с Telegram API (file_get_contents)'
            ];
        }
    }
    
    // Парсим ответ
    try {
        $response = json_decode($result, true);
        
        if ($response && isset($response['ok']) && $response['ok'] === true) {
            return [
                'success' => true,
                'message' => 'Сообщение успешно отправлено в Telegram'
            ];
        } else {
            $errorMessage = isset($response['description']) ? $response['description'] : 'Неизвестная ошибка';
            $errorCode = isset($response['error_code']) ? $response['error_code'] : 'неизвестен';
            
            // Специальные сообщения для частых ошибок
            if (strpos($errorMessage, 'chat not found') !== false || strpos($errorMessage, 'Chat not found') !== false) {
                $errorMessage = 'Чат не найден. Убедитесь, что бот добавлен в группу и имеет права на отправку сообщений.';
            } elseif (strpos($errorMessage, 'bot was blocked') !== false || strpos($errorMessage, 'bot was kicked') !== false) {
                $errorMessage = 'Бот был заблокирован или удален из группы. Добавьте бота обратно в группу.';
            } elseif (strpos($errorMessage, 'Forbidden') !== false) {
                $errorMessage = 'Бот не имеет прав на отправку сообщений в эту группу. Проверьте права бота.';
            }
            
            return [
                'success' => false,
                'message' => 'Ошибка Telegram API (код ' . $errorCode . '): ' . $errorMessage
            ];
        }
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => 'Ошибка парсинга ответа: ' . $e->getMessage()
        ];
    }
}

/**
 * Форматирует данные заявки для отправки в Telegram
 * 
 * @param array $data - Массив с данными заявки
 * @return string - Отформатированное сообщение
 */
function formatContactMessage($data) {
    $message = "<b>📧 Новая заявка с сайта</b>\n\n";
    $message .= "👤 <b>Имя:</b> " . htmlspecialchars($data['name']) . "\n";
    $message .= "📧 <b>Email:</b> " . htmlspecialchars($data['email']) . "\n";
    $message .= "📱 <b>Телефон:</b> " . htmlspecialchars($data['phone']) . "\n";
    
    if (!empty($data['service'])) {
        $message .= "🎯 <b>Услуга:</b> " . htmlspecialchars($data['service']) . "\n";
    }
    
    $message .= "🕐 <b>Дата:</b> " . htmlspecialchars($data['timestamp']) . "\n";
    $message .= "🌐 <b>IP:</b> " . htmlspecialchars($data['ip']) . "\n\n";
    
    if (!empty($data['message'])) {
        $message .= "<b>💬 Сообщение:</b>\n";
        $message .= htmlspecialchars($data['message']) . "\n";
    }
    
    return $message;
}

/**
 * Форматирует данные вакансии для отправки в Telegram
 * 
 * @param array $data - Массив с данными отклика на вакансию
 * @return string - Отформатированное сообщение
 */
function formatVacancyMessage($data) {
    $message = "<b>💼 Отклик на вакансию</b>\n\n";
    $message .= "👤 <b>Имя:</b> " . htmlspecialchars($data['name']) . "\n";
    $message .= "📧 <b>Email:</b> " . htmlspecialchars($data['email']) . "\n";
    $message .= "📱 <b>Телефон:</b> " . htmlspecialchars($data['phone']) . "\n";
    
    if (!empty($data['vacancy'])) {
        $message .= "💼 <b>Вакансия:</b> " . htmlspecialchars($data['vacancy']) . "\n";
    }
    
    $message .= "🕐 <b>Дата:</b> " . htmlspecialchars($data['timestamp']) . "\n\n";
    
    if (!empty($data['message'])) {
        $message .= "<b>💬 Сообщение/Резюме:</b>\n";
        $message .= htmlspecialchars($data['message']) . "\n";
    }
    
    return $message;
}

?>

