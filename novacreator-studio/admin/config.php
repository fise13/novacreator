<?php
/**
 * Конфигурация админ-панели
 * ВАЖНО: Измените пароль перед использованием!
 */

// Простая авторизация (для продакшена лучше использовать более надежную систему)
session_start();

// Пароль для входа (измените на свой!)
define('ADMIN_PASSWORD', 'Vic0214!'); // ИЗМЕНИТЕ ЭТОТ ПАРОЛЬ!

// Путь к файлу с статьями
define('BLOG_FILE', __DIR__ . '/../data/blog.json');

// Проверка авторизации
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
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

