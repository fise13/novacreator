<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/user_service.php';

startSecureSession();
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Метод не поддерживается');
}

if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    setFlash('error', 'CSRF токен недействителен. Попробуйте ещё раз.');
    $redirect = $_POST['redirect'] ?? '/adm/';
    header('Location: ' . $redirect);
    exit;
}

$userId = (int)($_POST['user_id'] ?? 0);
if ($userId <= 0) {
    setFlash('error', 'Неверный пользователь.');
    $redirect = $_POST['redirect'] ?? '/adm/';
    header('Location: ' . $redirect);
    exit;
}

$payload = [
    'user_id' => $userId,
    'status' => trim($_POST['status'] ?? ''),
    'progress_percent' => max(0, min(100, (int)($_POST['progress_percent'] ?? 0))),
    'time_spent_minutes' => max(0, (int)($_POST['time_spent_minutes'] ?? 0)),
    'stage' => trim($_POST['stage'] ?? ''),
    'notes' => trim($_POST['notes'] ?? ''),
    'started_at' => !empty($_POST['started_at']) ? trim($_POST['started_at']) : null,
];

upsertProject($payload);
setFlash('success', 'Данные сохранены.');

// Редирект на страницу клиента, если указан redirect, иначе на главную
$redirect = $_POST['redirect'] ?? '/adm/client.php?id=' . $userId;
header('Location: ' . $redirect);
exit;

