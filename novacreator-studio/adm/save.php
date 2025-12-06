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
    header('Location: /adm/');
    exit;
}

$userId = (int)($_POST['user_id'] ?? 0);
if ($userId <= 0) {
    setFlash('error', 'Неверный пользователь.');
    header('Location: /adm/');
    exit;
}

$payload = [
    'user_id' => $userId,
    'status' => $_POST['status'] ?? '',
    'progress_percent' => $_POST['progress_percent'] ?? 0,
    'time_spent_minutes' => $_POST['time_spent_minutes'] ?? 0,
    'stage' => $_POST['stage'] ?? '',
    'notes' => $_POST['notes'] ?? '',
    'started_at' => $_POST['started_at'] ?? null,
];

upsertProject($payload);
setFlash('success', 'Данные сохранены.');

header('Location: /adm/');
exit;

