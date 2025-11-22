<?php
/**
 * Функции для правильных путей к ресурсам
 * Работает как на локальном сервере, так и на хостинге
 */

// Определяем базовый путь к сайту
// Если файлы в корне домена - пустая строка
// Если в подпапке - укажите путь, например: '/novacreative'
function getBasePath() {
    // Автоматическое определение базового пути
    $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
    
    // Если index.php в корне, путь пустой
    if ($scriptPath === '/' || $scriptPath === '\\') {
        return '';
    }
    
    // Иначе возвращаем путь к корню
    return rtrim($scriptPath, '/');
}

// Функция для получения правильного пути к ресурсам
function asset($path) {
    $base = getBasePath();
    // Убираем начальный слэш если есть
    $path = ltrim($path, '/');
    return $base . '/' . $path;
}

// Функция для получения правильного пути к страницам
function url($page = '') {
    $base = getBasePath();
    if (empty($page)) {
        return $base . '/';
    }
    // Убираем начальный слэш если есть
    $page = ltrim($page, '/');
    return $base . '/' . $page;
}

?>

