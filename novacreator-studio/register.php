<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';

startSecureSession();

$pageTitle = 'Регистрация';
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Не удалось подтвердить запрос. Обновите страницу и попробуйте снова.';
    } else {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        $result = registerUser($name, $email, $password, $passwordConfirm);
        if ($result['success']) {
            // Автовход после регистрации
            loginUser($email, $password);
            setFlash('success', 'Регистрация успешна. Добро пожаловать!');
            header('Location: /dashboard.php');
            exit;
        } else {
            $errors = $result['errors'];
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<main class="min-h-screen flex items-center justify-center bg-gradient-to-br from-dark-bg via-dark-bg/80 to-dark-bg pt-28 pb-12 px-4">
    <div class="max-w-xl w-full">
        <div class="bg-dark-surface/80 border border-dark-border rounded-2xl shadow-2xl p-8 backdrop-blur">
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center shadow-lg">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5Z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gradient mb-2">Создать аккаунт</h1>
                <p class="text-gray-400 text-sm">Доступ к личному кабинету и статусам вашего проекта</p>
            </div>

            <?php if ($errors): ?>
                <div class="mb-4 rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-red-300 text-sm space-y-1">
                    <?php foreach ($errors as $err): ?>
                        <p><?php echo htmlspecialchars($err); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <?php echo csrfInput(); ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Имя</label>
                    <input type="text" name="name" required minlength="2" autocomplete="name"
                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                           placeholder="Ваше имя"
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" required autocomplete="email"
                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                           placeholder="you@example.com"
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Пароль</label>
                        <input type="password" name="password" required minlength="8" autocomplete="new-password"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                               placeholder="Минимум 8 символов">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Подтверждение</label>
                        <input type="password" name="password_confirm" required minlength="8" autocomplete="new-password"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                               placeholder="Повторите пароль">
                    </div>
                </div>

                <button type="submit" class="w-full btn-neon py-3 rounded-lg font-semibold flex items-center justify-center space-x-2">
                    <span>Зарегистрироваться</span>
                </button>
            </form>

            <?php
            try {
                require_once __DIR__ . '/includes/oauth_config.php';
                $googleEnabled = function_exists('isOAuthEnabled') ? isOAuthEnabled('google') : false;
                $appleEnabled = function_exists('isOAuthEnabled') ? isOAuthEnabled('apple') : false;
            } catch (Exception $e) {
                error_log('OAuth config error: ' . $e->getMessage());
                $googleEnabled = false;
                $appleEnabled = false;
            }
            if ($googleEnabled || $appleEnabled):
            ?>
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-dark-border"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-dark-surface/80 text-gray-400">или</span>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <?php if ($googleEnabled): ?>
                    <a href="/oauth/google/initiate.php" class="w-full flex items-center justify-center px-4 py-3 border border-dark-border rounded-lg bg-dark-bg hover:bg-dark-bg/80 text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span>Продолжить с Google</span>
                    </a>
                    <?php endif; ?>

                    <?php if ($appleEnabled): ?>
                    <a href="/oauth/apple/initiate.php" class="w-full flex items-center justify-center px-4 py-3 border border-dark-border rounded-lg bg-dark-bg hover:bg-dark-bg/80 text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                        </svg>
                        <span>Продолжить с Apple</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="mt-6 text-center text-sm text-gray-400">
                Уже есть аккаунт?
                <a href="/login.php" class="text-neon-purple hover:text-neon-blue font-semibold">Войти</a>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

