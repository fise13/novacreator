<?php
/**
 * CSRF защита через токен в сессии.
 */

function ensureCsrfToken(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCsrfToken(?string $token): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return is_string($token) &&
        isset($_SESSION['csrf_token']) &&
        hash_equals($_SESSION['csrf_token'], $token);
}

// Удобный helper для форм
function csrfInput(): string
{
    $token = ensureCsrfToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

