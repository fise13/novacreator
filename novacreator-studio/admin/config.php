<?php
/**
 * Конфигурация админ-панели
 * ВАЖНО: Измените пароль перед использованием!
 */

// Простая авторизация (для продакшена лучше использовать более надежную систему)
session_start();

// Подключаем утилиты
require_once __DIR__ . '/../includes/utils.php';

// Пароль для входа (измените на свой!)
// ВАЖНО: Используйте password_hash() для создания хеша пароля
// Пример: password_hash('ваш_пароль', PASSWORD_DEFAULT)
// Сохраните хеш в переменную ниже
define('ADMIN_PASSWORD_HASH', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); // ИЗМЕНИТЕ НА СВОЙ ХЕШ!

// Для обратной совместимости (устаревший способ)
define('ADMIN_PASSWORD', 'admin123'); // ИЗМЕНИТЕ ЭТОТ ПАРОЛЬ!

// Путь к файлу с статьями
define('BLOG_FILE', __DIR__ . '/../data/blog.json');

// Проверка авторизации
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        // Определяем правильный путь к login.php
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        
        // Проверяем, через какой путь зашли
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($requestUri, '/adm') === 0) {
            $loginUrl = $protocol . '://' . $host . '/adm/login';
        } else {
            $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
            $loginUrl = $protocol . '://' . $host . $scriptPath . '/login.php';
        }
        
        header('Location: ' . $loginUrl);
        exit;
    }
}

// Функция для генерации slug из заголовка
function generateSlug($title) {
    $slug = mb_strtolower($title, 'UTF-8');
    $slug = preg_replace('/[^a-zа-я0-9\s-]/u', '', $slug);
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

// Функция для загрузки статей
function loadArticles() {
    if (!file_exists(BLOG_FILE)) {
        return [];
    }
    $content = file_get_contents(BLOG_FILE);
    return json_decode($content, true) ?: [];
}

// Функция для сохранения статей
function saveArticles($articles) {
    // Сортируем по ID
    usort($articles, function($a, $b) {
        return $b['id'] - $a['id'];
    });
    file_put_contents(BLOG_FILE, json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
?>

