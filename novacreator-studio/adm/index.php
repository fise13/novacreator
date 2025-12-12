<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/user_service.php';

startSecureSession();
requireAdmin();

$pageTitle = 'Админ: клиенты';
$clients = getAllClientsWithProjects();
$query = trim($_GET['q'] ?? '');

if ($query !== '') {
    $needle = mb_strtolower($query);
    $clients = array_values(array_filter($clients, function($c) use ($needle) {
        $haystack = mb_strtolower(($c['name'] ?? '') . ' ' . ($c['email'] ?? '') . ' ' . ($c['status'] ?? '') . ' ' . ($c['stage'] ?? ''));
        return mb_strpos($haystack, $needle) !== false;
    }));
}

// Агрегаты
$totalClients = count($clients);
$avgProgress = $totalClients ? round(array_sum(array_column($clients, 'progress_percent')) / $totalClients, 1) : 0;
$totalMinutes = array_sum(array_column($clients, 'time_spent_minutes'));
$totalHours = round($totalMinutes / 60, 1);
$inProgress = count(array_filter($clients, fn($c) => (int)($c['progress_percent']) < 100));
$completed = count(array_filter($clients, fn($c) => (int)($c['progress_percent']) >= 100));

$flashSuccess = getFlash('success');
$flashError = getFlash('error');

include __DIR__ . '/../includes/header.php';
?>

<style>
    /* Светлый стеклянный UI для панели клиентов */
    :root {
        --panel-radius: 22px;
        --panel-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        --panel-border: rgba(15, 23, 42, 0.06);
        --pill-border: rgba(15, 23, 42, 0.08);
    }
    .admin-surface {
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 60%, #f8fafc 100%);
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid var(--panel-border);
        box-shadow: var(--panel-shadow);
        backdrop-filter: blur(12px);
        border-radius: var(--panel-radius);
    }
    .stat-indigo { background: linear-gradient(135deg, #f5f7ff 0%, #eef2ff 100%); }
    .stat-mint { background: linear-gradient(135deg, #f0fdf9 0%, #e8fbf3 100%); }
    .stat-peach { background: linear-gradient(135deg, #fff7ed 0%, #fffbeb 100%); }
    .stat-blue { background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); }
    .stat-green { background: linear-gradient(135deg, #ecfdf3 0%, #e3f9ed 100%); }
    .text-muted { color: #6b7280; }
    .pill {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid var(--pill-border);
        color: #4b5563;
    }
    .progress-track { background: #e5e7eb; }
</style>

<main class="min-h-screen admin-surface pt-28 pb-16 px-4">
    <div class="container mx-auto max-w-7xl space-y-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between glass-card p-6">
            <div>
                <p class="text-sm text-muted">Роль: администратор</p>
                <h1 class="text-3xl md:text-4xl font-bold" style="color:#0f172a;">Панель управления клиентами</h1>
                <p class="text-muted text-sm mt-1">Управляйте всеми клиентами и их проектами</p>
            </div>
            <div class="flex items-center gap-3">
                <form method="GET" class="flex items-center glass-card px-4 py-2.5 shadow-inner">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                    </svg>
                    <input type="text" name="q" value="<?php echo htmlspecialchars($query); ?>" placeholder="Поиск по имени, email, статусу..." class="bg-transparent text-sm text-gray-700 focus:outline-none w-64" />
                    <?php if ($query): ?>
                        <a href="/adm/" class="text-xs text-gray-500 ml-2 hover:text-neon-purple transition-colors">Сброс</a>
                    <?php endif; ?>
                </form>
                <a href="/logout.php" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-600 hover:text-neon-purple hover:border-neon-purple transition-colors glass-card">
                    Выйти
                </a>
            </div>
        </div>

        <!-- Агрегаты -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="glass-card stat-indigo p-5 hover:shadow-xl transition-all duration-300">
                <p class="text-xs uppercase tracking-wide text-muted mb-2">Всего клиентов</p>
                <p class="text-3xl font-bold" style="color:#0f172a;"><?php echo $totalClients; ?></p>
            </div>
            <div class="glass-card stat-blue p-5 hover:shadow-xl transition-all duration-300">
                <p class="text-xs uppercase tracking-wide text-muted mb-2">Средний прогресс</p>
                <p class="text-3xl font-bold" style="color:#0f172a;"><?php echo $avgProgress; ?>%</p>
            </div>
            <div class="glass-card stat-mint p-5 hover:shadow-xl transition-all duration-300">
                <p class="text-xs uppercase tracking-wide text-muted mb-2">Отработано</p>
                <p class="text-3xl font-bold" style="color:#0f172a;"><?php echo $totalHours; ?> ч</p>
            </div>
            <div class="glass-card stat-peach p-5 hover:shadow-xl transition-all duration-300">
                <p class="text-xs uppercase tracking-wide text-muted mb-2">В процессе</p>
                <p class="text-3xl font-bold" style="color:#0f172a;"><?php echo $inProgress; ?></p>
            </div>
            <div class="glass-card stat-green p-5 hover:shadow-xl transition-all duration-300">
                <p class="text-xs uppercase tracking-wide text-muted mb-2">Завершено</p>
                <p class="text-3xl font-bold" style="color:#0f172a;"><?php echo $completed; ?></p>
            </div>
        </div>

        <?php if ($flashSuccess): ?>
            <div class="rounded-lg border border-green-500/40 bg-green-500/10 px-4 py-3 text-green-300 text-sm">
                <?php echo htmlspecialchars($flashSuccess); ?>
            </div>
        <?php endif; ?>

        <?php if ($flashError): ?>
            <div class="rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-red-300 text-sm">
                <?php echo htmlspecialchars($flashError); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($clients)): ?>
            <div class="glass-card rounded-2xl shadow-xl p-10 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-xl text-gray-700 mb-2">Клиенты не найдены</p>
                <p class="text-muted">Измените фильтр или добавьте пользователей.</p>
                <?php if ($query): ?>
                    <a href="/adm/" class="mt-4 inline-flex px-4 py-2 rounded-lg border border-gray-200 text-gray-600 hover:text-neon-purple hover:border-neon-purple transition-colors glass-card">Сбросить поиск</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($clients as $client): 
                $progress = (int)($client['progress_percent'] ?? 0);
                $timeSpent = (int)($client['time_spent_minutes'] ?? 0);
                $hours = round($timeSpent / 60, 1);
                $createdAt = $client['created_at'] ?? '';
                $createdAtTimestamp = $createdAt ? strtotime($createdAt) : false;
                $createdAtFormatted = $createdAtTimestamp ? date('d.m.Y', $createdAtTimestamp) : '';
            ?>
                <a href="/adm/client.php?id=<?php echo (int)$client['id']; ?>" class="glass-card rounded-2xl p-6 hover:shadow-2xl hover:border-neon-purple/40 transition-all duration-300 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-neon-purple transition-colors">
                                <?php echo htmlspecialchars($client['name']); ?>
                            </h3>
                            <p class="text-sm text-muted mt-1"><?php echo htmlspecialchars($client['email']); ?></p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full pill">
                            <?php echo htmlspecialchars($client['role']); ?>
                        </span>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs text-muted">Прогресс</span>
                                <span class="text-sm font-semibold text-gray-900"><?php echo $progress; ?>%</span>
                            </div>
                            <div class="w-full progress-track rounded-full h-2 overflow-hidden">
                                <div class="h-2 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full transition-all duration-300" style="width: <?php echo max(0, min(100, $progress)); ?>%;"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-xs text-muted mb-1">Статус</p>
                                <p class="text-gray-900 font-medium"><?php echo htmlspecialchars($client['status'] ?: 'Не указан'); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-muted mb-1">Этап</p>
                                <p class="text-gray-900 font-medium"><?php echo htmlspecialchars($client['stage'] ?: 'Не указан'); ?></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-xs text-muted mb-1">Время работы</p>
                                <p class="text-gray-900 font-medium"><?php echo $hours; ?> ч</p>
                            </div>
                            <div>
                                <p class="text-xs text-muted mb-1">Создан</p>
                                <p class="text-gray-900 font-medium"><?php echo $createdAtFormatted; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <span class="text-xs text-muted">Нажмите для редактирования</span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
