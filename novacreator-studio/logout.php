<?php
require_once __DIR__ . '/includes/auth.php';

startSecureSession();
logoutUser();
setFlash('success', 'Вы вышли из аккаунта.');

// Возвращаем на главную
header('Location: /');
exit;

