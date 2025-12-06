<?php
/**
 * Проверка защиты данных перед обновлением через Git
 * 
 * Использование: php scripts/verify_data_protection.php
 */

$errors = [];
$warnings = [];
$success = [];

// Проверка 1: База данных существует
$dbPath = __DIR__ . '/../data/app.db';
if (!file_exists($dbPath)) {
    $warnings[] = "База данных не найдена: $dbPath";
} else {
    $success[] = "База данных существует: " . filesize($dbPath) . " байт";
    
    // Проверка размера (не должна быть пустой)
    if (filesize($dbPath) < 1000) {
        $warnings[] = "База данных очень маленькая, возможно пустая";
    }
}

// Проверка 2: База данных в .gitignore
$gitignorePath = __DIR__ . '/../../.gitignore';
if (file_exists($gitignorePath)) {
    $gitignore = file_get_contents($gitignorePath);
    if (strpos($gitignore, 'app.db') !== false) {
        $success[] = "База данных добавлена в .gitignore";
    } else {
        $errors[] = "База данных НЕ добавлена в .gitignore!";
    }
} else {
    $errors[] = "Файл .gitignore не найден!";
}

// Проверка 3: База данных не отслеживается Git
$gitCheck = shell_exec('cd ' . escapeshellarg(__DIR__ . '/../..') . ' && git ls-files 2>/dev/null | grep -E "app\.db|data/.*\.db"');
$gitCheck = $gitCheck ? trim($gitCheck) : '';
if (!empty($gitCheck)) {
    $errors[] = "База данных отслеживается Git! Файлы:\n" . $gitCheck;
} else {
    $success[] = "База данных не отслеживается Git";
}

// Проверка 4: OAuth конфигурация
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/oauth_config.php';

try {
    $config = getGoogleOAuthConfig();
    if (!empty($config['client_id']) && !empty($config['client_secret'])) {
        $success[] = "Google OAuth конфигурация настроена";
    } else {
        $warnings[] = "Google OAuth конфигурация не настроена";
    }
} catch (Exception $e) {
    $warnings[] = "Ошибка проверки OAuth: " . $e->getMessage();
}

// Проверка 5: Данные пользователей
try {
    $pdo = getDb();
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM users');
    $userCount = $stmt->fetch()['count'];
    
    if ($userCount > 0) {
        $success[] = "Найдено пользователей: $userCount";
        
        // Проверка проектов
        $stmt = $pdo->query('SELECT COUNT(*) as count FROM projects');
        $projectCount = $stmt->fetch()['count'];
        if ($projectCount > 0) {
            $success[] = "Найдено проектов: $projectCount";
        }
    } else {
        $warnings[] = "В базе данных нет пользователей";
    }
} catch (Exception $e) {
    $warnings[] = "Ошибка проверки данных: " . $e->getMessage();
}

// Вывод результатов
echo "🔍 Проверка защиты данных\n";
echo str_repeat("=", 50) . "\n\n";

if (!empty($success)) {
    echo "✅ Успешно:\n";
    foreach ($success as $msg) {
        echo "   ✓ $msg\n";
    }
    echo "\n";
}

if (!empty($warnings)) {
    echo "⚠️  Предупреждения:\n";
    foreach ($warnings as $msg) {
        echo "   ⚠ $msg\n";
    }
    echo "\n";
}

if (!empty($errors)) {
    echo "❌ Ошибки (критично!):\n";
    foreach ($errors as $msg) {
        echo "   ✗ $msg\n";
    }
    echo "\n";
    exit(1);
}

if (empty($errors) && empty($warnings)) {
    echo "✅ Все проверки пройдены! Данные защищены.\n";
    exit(0);
} elseif (empty($errors)) {
    echo "⚠️  Есть предупреждения, но критических ошибок нет.\n";
    exit(0);
}

