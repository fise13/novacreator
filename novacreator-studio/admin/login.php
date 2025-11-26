<?php
/**
 * Страница входа в админ-панель
 * Современный дизайн с анимациями
 */
session_start();

// Если уже авторизован, перенаправляем
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    
    // Всегда используем /admin/index.php для надежности
    $indexUrl = $protocol . '://' . $host . '/admin/index.php';
    
    header('Location: ' . $indexUrl);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config.php';
    $password = $_POST['password'] ?? '';
    
    if ($password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        
        // Всегда перенаправляем на /admin/index.php
        $indexUrl = $protocol . '://' . $host . '/admin/index.php';
        
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .login-container {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
        }
        
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }
        
        .btn-login {
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }
    </style>
</head>
<body class="bg-dark-bg text-white flex items-center justify-center min-h-screen login-container">
    <!-- Декоративные элементы -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-neon-purple/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-neon-blue/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="max-w-md w-full mx-4 relative z-10">
        <div class="bg-dark-surface border border-dark-border rounded-2xl p-8 shadow-2xl animate-fade-in">
            <!-- Логотип -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto mb-4 animate-fade-in" style="animation-delay: 0.2s;">
                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold mb-2 text-gradient">Админ-панель</h1>
                <p class="text-gray-400 text-sm">NovaCreator Studio</p>
            </div>
            
            <?php if ($error): ?>
                <div class="bg-red-600/20 border border-red-600 rounded-lg p-4 mb-6 text-red-400 flex items-center space-x-2 animate-fade-in">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-6" id="loginForm">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-300 flex items-center space-x-2">
                        <i class="fas fa-lock"></i>
                        <span>Пароль</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password"
                               required 
                               autofocus
                               class="form-input w-full px-4 py-3 pl-12 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20"
                               placeholder="Введите пароль">
                        <i class="fas fa-key absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-neon-purple transition-colors">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn-neon btn-login w-full py-3 flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Войти</span>
                </button>
            </form>
            
            <div class="mt-6 pt-6 border-t border-dark-border text-center">
                <a href="../blog" class="text-gray-400 hover:text-neon-purple transition-colors text-sm flex items-center justify-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Вернуться к блогу</span>
                </a>
            </div>
            
            <!-- Подсказка безопасности -->
            <div class="mt-6 p-4 bg-blue-600/10 border border-blue-600/30 rounded-lg">
                <p class="text-xs text-gray-400 flex items-start space-x-2">
                    <i class="fas fa-info-circle text-blue-400 mt-0.5"></i>
                    <span>Для безопасности используйте надежный пароль и не делитесь им с третьими лицами.</span>
                </p>
            </div>
        </div>
    </div>
    
    <script>
        // Переключение видимости пароля
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        // Автофокус на поле пароля
        document.getElementById('password').focus();
        
        // Анимация при отправке формы
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '<span class="loading"></span> Вход...';
            button.disabled = true;
        });
    </script>
</body>
</html>
