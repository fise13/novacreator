<?php
session_start();

define('USERS_FILE', __DIR__ . '/../data/users.json');
define('PROJECTS_FILE', __DIR__ . '/../data/projects.json');
define('SUBSCRIPTIONS_FILE', __DIR__ . '/../data/push_subscriptions.json');

function checkClientAuth() {
    if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id'])) {
        header('Location: /client/login.php');
        exit;
    }
}

function loadUsers() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $content = file_get_contents(USERS_FILE);
    return json_decode($content, true) ?: [];
}

function saveUsers($users) {
    file_put_contents(USERS_FILE, json_encode($users, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function loadProjects() {
    if (!file_exists(PROJECTS_FILE)) {
        return [];
    }
    $content = file_get_contents(PROJECTS_FILE);
    return json_decode($content, true) ?: [];
}

function saveProjects($projects) {
    file_put_contents(PROJECTS_FILE, json_encode($projects, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function loadSubscriptions() {
    if (!file_exists(SUBSCRIPTIONS_FILE)) {
        return [];
    }
    $content = file_get_contents(SUBSCRIPTIONS_FILE);
    return json_decode($content, true) ?: [];
}

function saveSubscriptions($subscriptions) {
    file_put_contents(SUBSCRIPTIONS_FILE, json_encode($subscriptions, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function getClientProjects($clientId) {
    $projects = loadProjects();
    return array_filter($projects, function($project) use ($clientId) {
        return $project['client_id'] == $clientId;
    });
}

function getProjectStages() {
    return [
        'planning' => [
            'name' => 'Планирование',
            'description' => 'Анализ требований и составление технического задания',
            'icon' => '📋',
            'order' => 1
        ],
        'design' => [
            'name' => 'Дизайн',
            'description' => 'Создание макетов и прототипов',
            'icon' => '🎨',
            'order' => 2
        ],
        'development' => [
            'name' => 'Разработка',
            'description' => 'Программирование и верстка',
            'icon' => '💻',
            'order' => 3
        ],
        'testing' => [
            'name' => 'Тестирование',
            'description' => 'Проверка функциональности и исправление ошибок',
            'icon' => '🔍',
            'order' => 4
        ],
        'deployment' => [
            'name' => 'Деплой',
            'description' => 'Размещение сайта на хостинге',
            'icon' => '🚀',
            'order' => 5
        ],
        'seo' => [
            'name' => 'SEO-оптимизация',
            'description' => 'Настройка мета-тегов и оптимизация для поисковиков',
            'icon' => '🔎',
            'order' => 6
        ],
        'completed' => [
            'name' => 'Завершено',
            'description' => 'Проект полностью готов',
            'icon' => '✅',
            'order' => 7
        ]
    ];
}
?>

