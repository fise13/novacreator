<?php
/**
 * Импорт OAuth конфигурации в базу данных
 * 
 * Использование:
 * php scripts/import_oauth_config.php oauth_config_backup.json
 */

if ($argc < 2) {
    echo "Использование: php scripts/import_oauth_config.php <backup_file.json>\n";
    exit(1);
}

$backupFile = $argv[1];

if (!file_exists($backupFile)) {
    echo "Ошибка: Файл $backupFile не найден\n";
    exit(1);
}

$json = file_get_contents($backupFile);
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Ошибка: Неверный формат JSON: " . json_last_error_msg() . "\n";
    exit(1);
}

if (!isset($data['configs']) || !is_array($data['configs'])) {
    echo "Ошибка: Неверный формат файла резервной копии\n";
    exit(1);
}

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/oauth_config.php';

$pdo = getDb();
$imported = 0;
$errors = [];

foreach ($data['configs'] as $config) {
    if (empty($config['provider'])) {
        $errors[] = "Пропущена конфигурация без provider";
        continue;
    }
    
    $result = saveOAuthConfigToDb($config['provider'], [
        'client_id' => $config['client_id'] ?? '',
        'client_secret' => $config['client_secret'] ?? '',
        'team_id' => $config['team_id'] ?? null,
        'key_id' => $config['key_id'] ?? null,
        'private_key_path' => $config['private_key_path'] ?? null,
        'auth_url' => $config['auth_url'] ?? '',
        'token_url' => $config['token_url'] ?? '',
        'userinfo_url' => $config['userinfo_url'] ?? null,
    ]);
    
    if ($result) {
        echo "✓ Импортирована конфигурация для: " . $config['provider'] . "\n";
        $imported++;
    } else {
        $errors[] = "Ошибка импорта конфигурации для: " . $config['provider'];
    }
}

echo "\nИмпортировано: $imported конфигураций\n";

if (!empty($errors)) {
    echo "\nОшибки:\n";
    foreach ($errors as $error) {
        echo "  - $error\n";
    }
    exit(1);
}

echo "Импорт завершен успешно!\n";
exit(0);

