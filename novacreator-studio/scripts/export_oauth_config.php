<?php
/**
 * Экспорт OAuth конфигурации из базы данных
 * 
 * Использование:
 * php scripts/export_oauth_config.php > oauth_config_backup.json
 */

require_once __DIR__ . '/../includes/db.php';

$pdo = getDb();

// Получаем все OAuth конфигурации
$stmt = $pdo->query('SELECT * FROM oauth_config ORDER BY provider');
$configs = $stmt->fetchAll();

if (empty($configs)) {
    echo json_encode(['error' => 'No OAuth configurations found'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit(1);
}

$export = [
    'exported_at' => date('c'),
    'version' => '1.0',
    'configs' => []
];

foreach ($configs as $config) {
    $export['configs'][] = [
        'provider' => $config['provider'],
        'client_id' => $config['client_id'],
        'client_secret' => $config['client_secret'],
        'team_id' => $config['team_id'] ?? null,
        'key_id' => $config['key_id'] ?? null,
        'private_key_path' => $config['private_key_path'] ?? null,
        'auth_url' => $config['auth_url'],
        'token_url' => $config['token_url'],
        'userinfo_url' => $config['userinfo_url'] ?? null,
    ];
}

echo json_encode($export, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit(0);

