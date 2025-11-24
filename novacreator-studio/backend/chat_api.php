<?php
/**
 * API для онлайн-чата
 * Обработка сообщений от пользователей и админов
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../telegram_bot/send_telegram.php';

$chatsFile = __DIR__ . '/../data/chats.json';

// Загружаем чаты
function loadChats() {
    global $chatsFile;
    if (!file_exists($chatsFile)) {
        file_put_contents($chatsFile, '[]');
        return [];
    }
    $content = file_get_contents($chatsFile);
    return json_decode($content, true) ?: [];
}

// Сохраняем чаты
function saveChats($chats) {
    global $chatsFile;
    file_put_contents($chatsFile, json_encode($chats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Получаем IP адрес
function getClientIP() {
    $ipkeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    foreach ($ipkeys as $keyword) {
        if (array_key_exists($keyword, $_SERVER) && !empty($_SERVER[$keyword])) {
            return $_SERVER[$keyword];
        }
    }
    return 'unknown';
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'send_message':
        // Отправка сообщения от пользователя
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');
        
        if (empty($name) || empty($message)) {
            echo json_encode(['success' => false, 'error' => 'Заполните все обязательные поля']);
            exit;
        }
        
        $chats = loadChats();
        
        // Проверяем, есть ли активный чат для этого пользователя (по email или IP)
        $activeChat = null;
        $clientIP = getClientIP();
        
        foreach ($chats as &$chat) {
            if ($chat['status'] === 'active' && 
                ($chat['email'] === $email || $chat['ip'] === $clientIP)) {
                $activeChat = &$chat;
                break;
            }
        }
        
        if (!$activeChat) {
            // Создаем новый чат
            $chatId = time() . '_' . uniqid();
            $activeChat = [
                'id' => $chatId,
                'name' => $name,
                'email' => $email,
                'ip' => $clientIP,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'messages' => []
            ];
            $chats[] = &$activeChat;
            
            // Отправляем уведомление в Telegram о новом чате
            $telegramMessage = "💬 <b>Новый чат начат</b>\n\n";
            $telegramMessage .= "👤 <b>Имя:</b> " . htmlspecialchars($name) . "\n";
            $telegramMessage .= "📧 <b>Email:</b> " . htmlspecialchars($email) . "\n";
            $telegramMessage .= "🌐 <b>IP:</b> " . htmlspecialchars($clientIP) . "\n";
            $telegramMessage .= "🕐 <b>Время:</b> " . date('d.m.Y H:i:s') . "\n\n";
            $telegramMessage .= "<b>Первое сообщение:</b>\n" . htmlspecialchars($message);
            
            sendTelegramMessage($telegramMessage, 'contact');
        }
        
        // Добавляем сообщение
        $activeChat['messages'][] = [
            'id' => uniqid(),
            'from' => 'user',
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        $activeChat['updated_at'] = date('Y-m-d H:i:s');
        
        saveChats($chats);
        
        echo json_encode([
            'success' => true,
            'chat_id' => $activeChat['id'],
            'message' => 'Сообщение отправлено'
        ]);
        break;
        
    case 'admin_send':
        // Отправка сообщения от админа
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            echo json_encode(['success' => false, 'error' => 'Не авторизован']);
            exit;
        }
        
        $chatId = $_POST['chat_id'] ?? '';
        $message = trim($_POST['message'] ?? '');
        
        if (empty($chatId) || empty($message)) {
            echo json_encode(['success' => false, 'error' => 'Неверные данные']);
            exit;
        }
        
        $chats = loadChats();
        
        foreach ($chats as &$chat) {
            if ($chat['id'] === $chatId) {
                $chat['messages'][] = [
                    'id' => uniqid(),
                    'from' => 'admin',
                    'message' => $message,
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                $chat['updated_at'] = date('Y-m-d H:i:s');
                saveChats($chats);
                
                echo json_encode(['success' => true]);
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Чат не найден']);
        break;
        
    case 'get_chats':
        // Получение списка чатов (для админа)
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            echo json_encode(['success' => false, 'error' => 'Не авторизован']);
            exit;
        }
        
        $chats = loadChats();
        
        // Сортируем по дате обновления (новые сверху)
        usort($chats, function($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });
        
        echo json_encode(['success' => true, 'chats' => $chats]);
        break;
        
    case 'get_chat':
        // Получение конкретного чата
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            echo json_encode(['success' => false, 'error' => 'Не авторизован']);
            exit;
        }
        
        $chatId = $_GET['chat_id'] ?? '';
        
        if (empty($chatId)) {
            echo json_encode(['success' => false, 'error' => 'Не указан ID чата']);
            exit;
        }
        
        $chats = loadChats();
        
        foreach ($chats as $chat) {
            if ($chat['id'] === $chatId) {
                echo json_encode(['success' => true, 'chat' => $chat]);
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Чат не найден']);
        break;
        
    case 'update_status':
        // Обновление статуса чата (для админа)
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            echo json_encode(['success' => false, 'error' => 'Не авторизован']);
            exit;
        }
        
        $chatId = $_POST['chat_id'] ?? '';
        $status = $_POST['status'] ?? '';
        
        if (empty($chatId) || !in_array($status, ['active', 'closed', 'archived'])) {
            echo json_encode(['success' => false, 'error' => 'Неверные данные']);
            exit;
        }
        
        $chats = loadChats();
        
        foreach ($chats as &$chat) {
            if ($chat['id'] === $chatId) {
                $chat['status'] = $status;
                $chat['updated_at'] = date('Y-m-d H:i:s');
                saveChats($chats);
                
                echo json_encode(['success' => true]);
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Чат не найден']);
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Неизвестное действие']);
        break;
}

