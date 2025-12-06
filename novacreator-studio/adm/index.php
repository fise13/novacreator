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

$flashSuccess = getFlash('success');
$flashError = getFlash('error');

include __DIR__ . '/../includes/header.php';
?>

<main class="min-h-screen bg-gradient-to-b from-dark-bg via-dark-bg/90 to-dark-bg pt-28 pb-16 px-4">
    <div class="container mx-auto max-w-6xl space-y-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm text-gray-400">Роль: администратор</p>
                <h1 class="text-3xl md:text-4xl font-bold text-gradient">Панель клиентов</h1>
                <p class="text-gray-400 text-sm mt-1">Редактируйте статусы, прогресс и время работы.</p>
            </div>
            <div class="flex items-center gap-3">
                <form method="GET" class="flex items-center bg-dark-surface border border-dark-border rounded-xl px-3 py-2 shadow-inner">
                    <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                    </svg>
                    <input type="text" name="q" value="<?php echo htmlspecialchars($query); ?>" placeholder="Поиск по имени, email, статусу..." class="bg-transparent text-sm text-gray-200 focus:outline-none" />
                    <?php if ($query): ?>
                        <a href="/adm/" class="text-xs text-gray-400 ml-2 hover:text-neon-purple">Сброс</a>
                    <?php endif; ?>
                </form>
                <a href="/logout.php" class="px-4 py-2 rounded-lg border border-dark-border text-gray-300 hover:text-neon-purple hover:border-neon-purple transition-colors">
                    Выйти
                </a>
            </div>
        </div>

        <!-- Агрегаты -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-neon-purple/10 to-neon-blue/10 border border-neon-purple/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Клиентов</p>
                <p class="text-2xl font-bold text-white"><?php echo $totalClients; ?></p>
            </div>
            <div class="bg-gradient-to-br from-neon-blue/10 to-neon-purple/10 border border-neon-blue/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Средний прогресс</p>
                <p class="text-2xl font-bold text-white"><?php echo $avgProgress; ?>%</p>
            </div>
            <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Отработано</p>
                <p class="text-2xl font-bold text-white"><?php echo $totalHours; ?> ч</p>
            </div>
            <div class="bg-gradient-to-br from-amber-500/10 to-orange-500/10 border border-amber-500/30 rounded-2xl p-4 shadow-lg">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">В процессе</p>
                <p class="text-2xl font-bold text-white"><?php echo $inProgress; ?></p>
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
            <div class="bg-dark-surface border border-dark-border rounded-2xl shadow-xl p-10 text-center">
                <p class="text-xl text-gray-300 mb-2">Клиенты не найдены</p>
                <p class="text-gray-400">Измените фильтр или добавьте пользователей.</p>
                <?php if ($query): ?>
                    <a href="/adm/" class="mt-4 inline-flex px-4 py-2 rounded-lg border border-dark-border text-gray-200 hover:text-neon-purple hover:border-neon-purple transition-colors">Сбросить поиск</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
        <div class="bg-dark-surface border border-dark-border rounded-2xl shadow-xl overflow-hidden">
            <div class="hidden lg:block">
                <table class="w-full">
                    <thead class="bg-dark-bg/60 border-b border-dark-border">
                        <tr class="text-left text-sm text-gray-400">
                            <th class="px-6 py-3">Клиент</th>
                            <th class="px-4 py-3">Статус / Этап</th>
                            <th class="px-4 py-3">Прогресс</th>
                            <th class="px-4 py-3">Время</th>
                            <th class="px-4 py-3">Старт</th>
                            <th class="px-4 py-3">Заметки</th>
                            <th class="px-4 py-3 text-right">Сохранить</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-border">
                        <?php foreach ($clients as $client): ?>
                            <tr class="align-top hover:bg-dark-bg/40 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-white font-semibold"><?php echo htmlspecialchars($client['name']); ?></p>
                                    <p class="text-gray-400 text-sm"><?php echo htmlspecialchars($client['email']); ?></p>
                                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                        <span>Создан: <?php echo htmlspecialchars(date('d.m.Y', strtotime($client['created_at']))); ?></span>
                                        <span class="px-2 py-0.5 rounded-full bg-dark-bg border border-dark-border text-gray-300"><?php echo htmlspecialchars($client['role']); ?></span>
                                    </p>
                                </td>
                                <td colspan="6" class="px-4 py-4">
                                    <form method="POST" action="/adm/save.php" class="grid grid-cols-12 gap-3 items-start">
                                        <?php echo csrfInput(); ?>
                                        <input type="hidden" name="user_id" value="<?php echo (int)$client['id']; ?>">

                                        <div class="col-span-3 space-y-2">
                                            <input name="status" value="<?php echo htmlspecialchars($client['status']); ?>" placeholder="Статус (напр. Дизайн)"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                            <input name="stage" value="<?php echo htmlspecialchars($client['stage']); ?>" placeholder="Этап"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-3 space-y-2">
                                            <div>
                                                <label class="text-xs text-gray-400">Прогресс (%)</label>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <input type="number" min="0" max="100" name="progress_percent"
                                                           value="<?php echo (int)$client['progress_percent']; ?>"
                                                           class="w-24 bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                                    <div class="flex items-center gap-1">
                                                        <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-progress" data-delta="-10">-10</button>
                                                        <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-progress" data-delta="-5">-5</button>
                                                        <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-progress" data-delta="5">+5</button>
                                                        <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-progress" data-delta="10">+10</button>
                                                    </div>
                                                </div>
                                                <?php $progress = (int)$client['progress_percent']; ?>
                                                <div class="mt-2 w-full bg-dark-bg border border-dark-border rounded-full h-2 overflow-hidden">
                                                    <div class="h-2 bg-gradient-to-r from-neon-purple to-neon-blue progress-bar" style="width: <?php echo max(0, min(100, $progress)); ?>%;"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="text-xs text-gray-400">Время (мин)</label>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <input type="number" min="0" name="time_spent_minutes"
                                                           value="<?php echo (int)$client['time_spent_minutes']; ?>"
                                                           class="w-24 bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                                    <div class="flex items-center gap-1">
                                                        <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-time" data-delta="30">+30</button>
                                                        <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-time" data-delta="60">+60</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label class="text-xs text-gray-400">Старт</label>
                                            <input type="date" name="started_at"
                                                   value="<?php echo htmlspecialchars($client['started_at'] ? substr($client['started_at'], 0, 10) : ''); ?>"
                                                   class="w-full mt-1 bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-3">
                                            <label class="text-xs text-gray-400">Заметки</label>
                                            <textarea name="notes" rows="3" placeholder="Комментарий"
                                                      class="w-full mt-1 bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40"><?php echo htmlspecialchars($client['notes']); ?></textarea>
                                        </div>
                                        <div class="col-span-1 text-right flex items-end">
                                            <button type="submit" class="btn-neon px-4 py-2 text-sm w-full">Сохранить</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Мобильные карточки -->
            <div class="lg:hidden divide-y divide-dark-border">
                <?php foreach ($clients as $client): ?>
                    <div class="p-4 space-y-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-white font-semibold"><?php echo htmlspecialchars($client['name']); ?></p>
                                <p class="text-gray-400 text-sm"><?php echo htmlspecialchars($client['email']); ?></p>
                                <p class="text-xs text-gray-500 mt-1">Создан: <?php echo htmlspecialchars(date('d.m.Y', strtotime($client['created_at']))); ?></p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded bg-dark-bg border border-dark-border text-gray-300">
                                <?php echo htmlspecialchars($client['role']); ?>
                            </span>
                        </div>

                        <form method="POST" action="/adm/save.php" class="space-y-3">
                            <?php echo csrfInput(); ?>
                            <input type="hidden" name="user_id" value="<?php echo (int)$client['id']; ?>">

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs text-gray-400">Статус</label>
                                    <input name="status" value="<?php echo htmlspecialchars($client['status']); ?>"
                                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400">Этап</label>
                                    <input name="stage" value="<?php echo htmlspecialchars($client['stage']); ?>"
                                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="text-xs text-gray-400">Прогресс %</label>
                                    <input type="number" min="0" max="100" name="progress_percent"
                                           value="<?php echo (int)$client['progress_percent']; ?>"
                                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400">Время (мин)</label>
                                    <input type="number" min="0" name="time_spent_minutes"
                                           value="<?php echo (int)$client['time_spent_minutes']; ?>"
                                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400">Старт</label>
                                    <input type="date" name="started_at"
                                           value="<?php echo htmlspecialchars($client['started_at'] ? substr($client['started_at'], 0, 10) : ''); ?>"
                                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                </div>
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Заметки</label>
                                <textarea name="notes" rows="2"
                                          class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40"><?php echo htmlspecialchars($client['notes']); ?></textarea>
                            </div>

                            <button type="submit" class="btn-neon w-full py-2 text-sm">Сохранить</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Корректировка прогресса
    document.querySelectorAll('.adjust-progress').forEach(btn => {
        btn.addEventListener('click', () => {
            const delta = Number(btn.dataset.delta || 0);
            const form = btn.closest('form');
            if (!form) return;
            const input = form.querySelector('input[name="progress_percent"]');
            if (!input) return;
            const bar = form.querySelector('.progress-bar');
            const next = Math.max(0, Math.min(100, Number(input.value || 0) + delta));
            input.value = next;
            if (bar) bar.style.width = `${next}%`;
        });
    });

    // Корректировка времени
    document.querySelectorAll('.adjust-time').forEach(btn => {
        btn.addEventListener('click', () => {
            const delta = Number(btn.dataset.delta || 0);
            const form = btn.closest('form');
            if (!form) return;
            const input = form.querySelector('input[name="time_spent_minutes"]');
            if (!input) return;
            const next = Math.max(0, Number(input.value || 0) + delta);
            input.value = next;
        });
    });
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

