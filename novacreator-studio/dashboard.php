<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/user_service.php';

startSecureSession();
requireLogin('/login.php');

$user = getAuthenticatedUser();
$userData = getUserWithProject($user['id']);
$pageTitle = 'Личный кабинет';
$progress = (int)($userData['progress_percent'] ?? 0);
$statusText = $userData['status'] ?? 'Ожидает обновления';
$stageText = $userData['stage'] ?? 'Скоро будет обновлено';
$timeSpent = (int)($userData['time_spent_minutes'] ?? 0);
$updatedAt = $userData['updated_at'] ?? null;
$startedAt = $userData['started_at'] ?? null;

function minutesToHuman(int $minutes): string
{
    $hours = intdiv($minutes, 60);
    $mins = $minutes % 60;
    if ($hours > 0) {
        return $hours . ' ч ' . $mins . ' мин';
    }
    return $mins . ' мин';
}

include __DIR__ . '/includes/header.php';
?>

<main class="min-h-screen bg-gradient-to-b from-dark-bg via-dark-bg/90 to-dark-bg pt-28 pb-16 px-4">
    <div class="container mx-auto max-w-5xl space-y-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-400">Здравствуйте, <?php echo htmlspecialchars($user['name']); ?></p>
                <h1 class="text-3xl md:text-4xl font-bold text-gradient">Личный кабинет</h1>
                <p class="text-gray-400 text-sm mt-1">Здесь отображается статус работы над вашим проектом.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/logout.php" class="px-4 py-2 rounded-lg border border-dark-border text-gray-300 hover:text-neon-purple hover:border-neon-purple transition-colors">
                    Выйти
                </a>
            </div>
        </div>

        <!-- Краткие метрики -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gradient-to-br from-neon-purple/10 to-neon-blue/10 border border-neon-purple/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Статус</p>
                <p class="text-lg font-semibold text-white"><?php echo htmlspecialchars($statusText); ?></p>
                <p class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars($stageText); ?></p>
            </div>
            <div class="bg-gradient-to-br from-neon-blue/10 to-neon-purple/10 border border-neon-blue/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Прогресс</p>
                <div class="flex items-center justify-between">
                    <p class="text-2xl font-bold text-white"><?php echo $progress; ?>%</p>
                    <div class="w-24 bg-dark-bg border border-dark-border rounded-full h-2 overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-neon-purple to-neon-blue" style="width: <?php echo max(0, min(100, $progress)); ?>%;"></div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Время работы</p>
                <p class="text-2xl font-bold text-white"><?php echo minutesToHuman($timeSpent); ?></p>
                <?php if ($updatedAt): ?>
                    <p class="text-xs text-gray-500 mt-1">Обновлено: <?php echo htmlspecialchars(date('d.m.Y', strtotime($updatedAt))); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-400">Ваша учётная запись</p>
                        <h2 class="text-xl font-semibold text-white"><?php echo htmlspecialchars($user['name']); ?></h2>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5Z" />
                        </svg>
                    </div>
                </div>
                <dl class="space-y-2 text-sm text-gray-300">
                    <div class="flex items-center justify-between">
                        <dt class="text-gray-400">Email</dt>
                        <dd class="font-medium"><?php echo htmlspecialchars($user['email']); ?></dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-gray-400">Роль</dt>
                        <dd class="font-medium"><?php echo htmlspecialchars($user['role']); ?></dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-gray-400">Создан</dt>
                        <dd class="font-medium"><?php echo htmlspecialchars(date('d.m.Y', strtotime($user['created_at']))); ?></dd>
                    </div>
                </dl>
            </div>

            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-400">Статус проекта</p>
                        <h2 class="text-xl font-semibold text-white">
                            <?php echo htmlspecialchars($statusText); ?>
                        </h2>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-neon-blue to-neon-purple flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h10M9 20h6" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5h14l1 5H4l1-5Z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-3 text-sm text-gray-300">
                    <div>
                        <p class="text-gray-400">Текущий этап</p>
                        <p class="font-medium"><?php echo htmlspecialchars($stageText); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400">Прогресс</p>
                        <div class="w-full bg-dark-bg rounded-full h-2 mt-2 overflow-hidden border border-dark-border">
                            <div class="h-2 bg-gradient-to-r from-neon-purple to-neon-blue" style="width: <?php echo $progress; ?>%;"></div>
                        </div>
                        <p class="text-gray-400 text-xs mt-1"><?php echo $progress; ?>% выполнено</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400">Время работы</span>
                        <span class="font-semibold">
                            <?php echo minutesToHuman($timeSpent); ?>
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-400">Комментарий</p>
                        <p class="font-medium leading-relaxed">
                            <?php echo htmlspecialchars($userData['notes'] ?: 'Пока нет дополнительных комментариев.'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">Хронология</h3>
                <span class="text-sm text-gray-400">
                    Обновлено: <?php echo htmlspecialchars($userData['updated_at'] ?? ''); ?>
                </span>
            </div>

            <?php if (!empty($startedAt)): ?>
                <div class="relative pl-4 border-l border-dark-border space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-neon-purple mt-2"></div>
                        <div>
                            <p class="text-sm text-gray-400">Старт работ</p>
                            <p class="text-white font-semibold"><?php echo htmlspecialchars(date('d.m.Y', strtotime($startedAt))); ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-neon-blue mt-2"></div>
                        <div>
                            <p class="text-sm text-gray-400">Текущий этап</p>
                            <p class="text-white font-semibold"><?php echo htmlspecialchars($stageText); ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-400 mt-2"></div>
                        <div>
                            <p class="text-sm text-gray-400">Прогресс</p>
                            <p class="text-white font-semibold"><?php echo $progress; ?>%</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-400">Мы ещё не добавили детали по вашему проекту. Как только начнём — здесь появится таймлайн.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

