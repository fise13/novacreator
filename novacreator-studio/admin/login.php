<?php
/**
 * Страница входа в админ-панель
 */
session_start();

// Если уже авторизован, перенаправляем
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Определяем правильный путь к index.php
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    
    // Если доступ через /adm, используем /adm
    if (strpos($_SERVER['REQUEST_URI'], '/adm') === 0) {
        $indexUrl = $protocol . '://' . $host . '/adm';
    } else {
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        $indexUrl = $protocol . '://' . $host . $scriptPath . '/index.php';
    }
    
    header('Location: ' . $indexUrl);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    
    // Проверяем пароль (в продакшене используйте хеширование!)
    if ($password === 'Vic0214!') { // ИЗМЕНИТЕ ЭТОТ ПАРОЛЬ!
        $_SESSION['admin_logged_in'] = true;
        
        // Определяем правильный путь к index.php
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        
        // Если доступ через /adm, используем /adm
        if (strpos($_SERVER['REQUEST_URI'], '/adm') === 0) {
            $indexUrl = $protocol . '://' . $host . '/adm';
        } else {
            $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
            $indexUrl = $protocol . '://' . $host . $scriptPath . '/index.php';
        }
        
        header('Location: ' . $indexUrl);
        exit;
    } else {
        $error = 'Неверный пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админ-панель - NovaCreator Studio</title>
    <link href="../assets/css/output.css" rel="stylesheet">
</head>
<body class="bg-dark-bg text-white flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full mx-4">
        <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
            <h1 class="text-3xl font-bold mb-6 text-center text-gradient">Вход в админ-панель</h1>
            
            <?php if ($error): ?>
                <div class="bg-red-600/20 border border-red-600 rounded-lg p-4 mb-6 text-red-400">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-300">Пароль</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20 transition-all duration-300">
                </div>
                
                <button type="submit" class="w-full btn-neon">
                    Войти
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-500">
                <a href="../blog" class="text-neon-purple hover:text-neon-blue transition-colors">Вернуться к блогу</a>
            </div>
        </div>
    </div>
</body>
</html>

