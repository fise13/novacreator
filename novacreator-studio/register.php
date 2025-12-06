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

            <div class="mt-6 text-center text-sm text-gray-400">
                Уже есть аккаунт?
                <a href="/login.php" class="text-neon-purple hover:text-neon-blue font-semibold">Войти</a>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

