<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';

startSecureSession();

$pageTitle = 'Вход';
$errors = [];

// Разрешаем редирект только на внутренние пути, чтобы избежать open-redirect
function safeRedirectPath(string $url): string
{
    $url = trim($url);
    if ($url === '') {
        return '';
    }
    if (preg_match('#^https?://#i', $url) || substr($url, 0, 2) === '//') {
        return '';
    }
    return $url[0] === '/' ? $url : '/' . ltrim($url, '/');
}

// Обрабатываем отправку формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Не удалось подтвердить запрос. Обновите страницу и попробуйте снова.';
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $result = loginUser($email, $password);

        if ($result['success']) {
            setFlash('success', 'Добро пожаловать!');

            $redirect = safeRedirectPath($_GET['redirect'] ?? $_POST['redirect'] ?? '');
            // Если админ — ведём в /adm, если обычный — в личный кабинет
            if ($result['role'] === 'admin' && !$redirect) {
                $redirect = '/adm/';
            }
            if (!$redirect) {
                $redirect = '/dashboard.php';
            }

            header('Location: ' . $redirect);
            exit;
        } else {
            $errors[] = $result['error'] ?? 'Ошибка входа';
        }
    }
}

$successMessage = getFlash('success');

include __DIR__ . '/includes/header.php';
?>

<main class="min-h-screen flex items-center justify-center bg-gradient-to-br from-dark-bg via-dark-bg/80 to-dark-bg pt-28 pb-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-dark-surface/80 border border-dark-border rounded-2xl shadow-2xl p-8 backdrop-blur">
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center shadow-lg">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.79 3-4s-1.343-4-3-4-3 1.79-3 4 1.343 4 3 4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 21a5.5 5.5 0 0 1 11 0" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gradient mb-2">Вход в аккаунт</h1>
                <p class="text-gray-400 text-sm">Доступ к личному кабинету и статусам проекта</p>
            </div>

            <?php if ($successMessage): ?>
                <div class="mb-4 rounded-lg border border-green-500/40 bg-green-500/10 px-4 py-3 text-green-300 text-sm">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="mb-4 rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-red-300 text-sm space-y-1">
                    <?php foreach ($errors as $err): ?>
                        <p><?php echo htmlspecialchars($err); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <?php echo csrfInput(); ?>
                <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_GET['redirect'] ?? ''); ?>">

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Email</label>
                    <div class="relative">
                        <input type="email" name="email" required autocomplete="email"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                               placeholder="you@example.com"
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0c0 4-2 6-4 6s-4-2-4-6m8 0c0-4-2-6-4-6S8 8 8 12" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Пароль</label>
                    <div class="relative">
                        <input type="password" name="password" required autocomplete="current-password"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                               placeholder="••••••••">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <button type="submit" class="w-full btn-neon py-3 rounded-lg font-semibold flex items-center justify-center space-x-2">
                    <span>Войти</span>
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-400">
                Нет аккаунта?
                <a href="/register.php" class="text-neon-purple hover:text-neon-blue font-semibold">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

