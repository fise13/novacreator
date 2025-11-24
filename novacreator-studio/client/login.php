<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $action = $_POST['action'] ?? 'login';
    
    if ($action === 'register') {
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        
        if (empty($name) || empty($email) || empty($password) || empty($phone)) {
            $error = 'Заполните все поля';
        } else {
            $users = loadUsers();
            
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $error = 'Пользователь с таким email уже существует';
                    break;
                }
            }
            
            if (empty($error)) {
                $newUser = [
                    'id' => time(),
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $users[] = $newUser;
                saveUsers($users);
                
                $_SESSION['client_id'] = $newUser['id'];
                $_SESSION['client_name'] = $newUser['name'];
                $_SESSION['client_email'] = $newUser['email'];
                
                header('Location: /client/dashboard.php');
                exit;
            }
        }
    } else {
        if (empty($email) || empty($password)) {
            $error = 'Заполните все поля';
        } else {
            $users = loadUsers();
            
            foreach ($users as $user) {
                if ($user['email'] === $email && password_verify($password, $user['password'])) {
                    $_SESSION['client_id'] = $user['id'];
                    $_SESSION['client_name'] = $user['name'];
                    $_SESSION['client_email'] = $user['email'];
                    
                    header('Location: /client/dashboard.php');
                    exit;
                }
            }
            
            $error = 'Неверный email или пароль';
        }
    }
}

$pageTitle = 'Вход в личный кабинет';
$pageMetaTitle = 'Вход в личный кабинет - NovaCreator Studio';
$pageMetaDescription = 'Войдите в личный кабинет для отслеживания статуса вашего проекта';
include '../includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                <h1 class="text-3xl font-bold mb-2 text-gradient text-center">Личный кабинет</h1>
                <p class="text-gray-400 text-center mb-8">Отслеживайте процесс разработки вашего проекта</p>
                
                <?php if ($error): ?>
                    <div class="bg-red-600/20 border border-red-600 rounded-lg p-4 mb-6 text-red-400">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="bg-green-600/20 border border-green-600 rounded-lg p-4 mb-6 text-green-400">
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>
                
                <div class="mb-6 flex border-b border-dark-border">
                    <button id="loginTab" class="flex-1 py-3 text-center font-semibold text-neon-purple border-b-2 border-neon-purple">
                        Вход
                    </button>
                    <button id="registerTab" class="flex-1 py-3 text-center font-semibold text-gray-400 hover:text-neon-purple transition-colors">
                        Регистрация
                    </button>
                </div>
                
                <form id="loginForm" method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="login">
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Email</label>
                        <input type="email" name="email" required class="form-input" placeholder="your@email.com">
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Пароль</label>
                        <input type="password" name="password" required class="form-input" placeholder="••••••••">
                    </div>
                    
                    <button type="submit" class="btn-neon w-full">Войти</button>
                </form>
                
                <form id="registerForm" method="POST" class="space-y-6 hidden">
                    <input type="hidden" name="action" value="register">
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Имя</label>
                        <input type="text" name="name" required class="form-input" placeholder="Ваше имя">
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Email</label>
                        <input type="email" name="email" required class="form-input" placeholder="your@email.com">
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Телефон</label>
                        <input type="tel" name="phone" required class="form-input" placeholder="+7 (XXX) XXX-XX-XX">
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Пароль</label>
                        <input type="password" name="password" required class="form-input" placeholder="Минимум 6 символов" minlength="6">
                    </div>
                    
                    <button type="submit" class="btn-neon w-full">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    loginTab.addEventListener('click', function() {
        loginTab.classList.add('text-neon-purple', 'border-b-2', 'border-neon-purple');
        loginTab.classList.remove('text-gray-400');
        registerTab.classList.add('text-gray-400');
        registerTab.classList.remove('text-neon-purple', 'border-b-2', 'border-neon-purple');
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
    });
    
    registerTab.addEventListener('click', function() {
        registerTab.classList.add('text-neon-purple', 'border-b-2', 'border-neon-purple');
        registerTab.classList.remove('text-gray-400');
        loginTab.classList.add('text-gray-400');
        loginTab.classList.remove('text-neon-purple', 'border-b-2', 'border-neon-purple');
        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
    });
});
</script>

<?php include '../includes/footer.php'; ?>

