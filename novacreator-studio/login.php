<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';

startSecureSession();

// Если уже авторизован, перенаправляем
$currentUser = getAuthenticatedUser();
if ($currentUser) {
    $redirect = '/dashboard.php';
    if ($currentUser['role'] === 'admin' || mb_strtolower($currentUser['email']) === mb_strtolower(ROOT_ADMIN_EMAIL)) {
        $redirect = '/adm/';
    }
    header('Location: ' . $redirect);
    exit;
}

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
            if (($result['role'] === 'admin' || $email === mb_strtolower(ROOT_ADMIN_EMAIL)) && !$redirect) {
                $redirect = '/adm/';
            }
            if (!$redirect) {
                $redirect = '/dashboard.php';
            }

            // Убеждаемся, что заголовки еще не отправлены
            if (!headers_sent()) {
                header('Location: ' . $redirect);
                exit;
            } else {
                // Если заголовки уже отправлены, используем JavaScript редирект
                echo '<script>window.location.href = "' . htmlspecialchars($redirect) . '";</script>';
                exit;
            }
        } else {
            $errors[] = $result['error'] ?? 'Ошибка входа';
        }
    }
}

$successMessage = getFlash('success');

// Загружаем OAuth конфигурацию ДО header.php
$googleEnabled = false;
$appleEnabled = false;
try {
    require_once __DIR__ . '/includes/oauth_config.php';
    if (function_exists('isOAuthEnabled')) {
        $googleEnabled = isOAuthEnabled('google');
        $appleEnabled = isOAuthEnabled('apple');
    }
} catch (Exception $e) {
    error_log('OAuth config loading error: ' . $e->getMessage());
}

include __DIR__ . '/includes/header.php';
?>

<main class="min-h-screen flex items-center justify-center pt-28 pb-12 px-4" style="background-color: var(--color-bg);">
    <div class="max-w-md w-full animate-on-scroll">
        <div class="p-8 border rounded-lg" style="background-color: var(--color-bg); border-color: var(--color-border);">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">Вход</h1>
                <p class="text-lg font-light" style="color: var(--color-text-secondary);">Доступ к личному кабинету</p>
            </div>

            <?php if ($successMessage): ?>
                <div class="mb-6 p-4 border rounded-lg text-sm" style="border-color: #10b981; background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="mb-6 p-4 border rounded-lg text-sm space-y-1" style="border-color: #ef4444; background-color: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    <?php foreach ($errors as $err): ?>
                        <p><?php echo htmlspecialchars($err); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <?php echo csrfInput(); ?>
                <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_GET['redirect'] ?? ''); ?>">

                <div>
                    <label class="block text-sm font-medium mb-2" style="color: var(--color-text);">Email</label>
                    <input type="email" name="email" required autocomplete="email"
                           class="w-full px-4 py-3 border rounded-lg transition-all duration-200 focus:outline-none focus:opacity-70"
                           style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                           placeholder="you@example.com"
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2" style="color: var(--color-text);">Пароль</label>
                    <input type="password" name="password" required autocomplete="current-password"
                           class="w-full px-4 py-3 border rounded-lg transition-all duration-200 focus:outline-none focus:opacity-70"
                           style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                           placeholder="••••••••">
                </div>

                <button type="submit" class="w-full px-6 py-4 text-lg font-semibold rounded-lg transition-all duration-300 hover:opacity-70 active:opacity-50"
                        style="background-color: var(--color-text); color: var(--color-bg);">
                    Войти
                </button>
            </form>

            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t" style="border-color: var(--color-border);"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2" style="background-color: var(--color-bg); color: var(--color-text-secondary);">или</span>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <a href="/oauth/google/initiate.php" class="w-full flex items-center justify-center px-4 py-3 border rounded-lg transition-all duration-200 hover:opacity-70 active:opacity-50"
                       style="border-color: var(--color-border); background-color: var(--color-bg); color: var(--color-text);">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="font-medium">Продолжить с Google</span>
                    </a>

                    <?php if ($appleEnabled): ?>
                    <a href="/oauth/apple/initiate.php" class="w-full flex items-center justify-center px-4 py-3 border rounded-lg transition-all duration-200 hover:opacity-70 active:opacity-50"
                       style="border-color: var(--color-border); background-color: var(--color-bg); color: var(--color-text);">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                        </svg>
                        <span>Продолжить с Apple</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-6 text-center text-sm" style="color: var(--color-text-secondary);">
                Нет аккаунта?
                <a href="/register.php" class="font-medium hover:opacity-70 transition-opacity duration-200" style="color: var(--color-text);">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

