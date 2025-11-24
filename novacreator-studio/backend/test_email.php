<?php
/**
 * Тестовый файл для проверки отправки email
 * Откройте этот файл в браузере для тестирования
 */

header('Content-Type: text/html; charset=utf-8');

$emailTo = 'contact@novacreatorstudio.com';
$subject = 'Тест отправки email с сайта';
$message = 'Это тестовое письмо для проверки работы отправки email.';

echo "<h1>Тест отправки email</h1>";
echo "<p>Отправка на: <strong>{$emailTo}</strong></p>";
echo "<p>Тема: <strong>{$subject}</strong></p>";
echo "<hr>";

// Проверяем доступность функции mail()
if (!function_exists('mail')) {
    echo "<p style='color: red;'>❌ Функция mail() недоступна на этом сервере!</p>";
    exit;
}

echo "<p>✓ Функция mail() доступна</p>";

// Пробуем отправить простое письмо
$headers = [
    'From: NovaCreator Studio <noreply@novacreator-studio.com>',
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion()
];

$result = @mail($emailTo, $subject, $message, implode("\r\n", $headers));

if ($result) {
    echo "<p style='color: green;'>✓ Email отправлен успешно!</p>";
    echo "<p>Проверьте почту <strong>{$emailTo}</strong> (включая папку СПАМ)</p>";
} else {
    echo "<p style='color: red;'>❌ Email не отправлен</p>";
    
    $errorInfo = error_get_last();
    if ($errorInfo && isset($errorInfo['message'])) {
        echo "<p>Ошибка: <strong>{$errorInfo['message']}</strong></p>";
    }
    
    echo "<p>Возможные причины:</p>";
    echo "<ul>";
    echo "<li>SMTP сервер не настроен на хостинге</li>";
    echo "<li>Функция mail() отключена</li>";
    echo "<li>Письмо попало в спам</li>";
    echo "</ul>";
    
    echo "<p><strong>Решение:</strong> Обратитесь к администратору хостинга для настройки SMTP</p>";
}

echo "<hr>";
echo "<h2>Информация о сервере:</h2>";
echo "<pre>";
echo "PHP версия: " . phpversion() . "\n";
echo "Функция mail() доступна: " . (function_exists('mail') ? 'Да' : 'Нет') . "\n";
echo "sendmail_path: " . ini_get('sendmail_path') . "\n";
echo "SMTP: " . ini_get('SMTP') . "\n";
echo "smtp_port: " . ini_get('smtp_port') . "\n";
echo "</pre>";

echo "<hr>";
echo "<p><a href='/contact'>Вернуться к форме контактов</a></p>";
?>

