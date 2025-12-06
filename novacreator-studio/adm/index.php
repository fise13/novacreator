<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/user_service.php';

startSecureSession();
requireAdmin();

$pageTitle = 'Админ: клиенты';
$clients = getAllClientsWithProjects();
$flashSuccess = getFlash('success');
$flashError = getFlash('error');

include __DIR__ . '/../includes/header.php';
?>

<main class="min-h-screen bg-gradient-to-b from-dark-bg via-dark-bg/90 to-dark-bg pt-28 pb-16 px-4">
    <div class="container mx-auto max-w-6xl space-y-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-400">Роль: администратор</p>
                <h1 class="text-3xl md:text-4xl font-bold text-gradient">Панель клиентов</h1>
                <p class="text-gray-400 text-sm mt-1">Редактируйте статусы, прогресс и время работы по каждому клиенту.</p>
            </div>
            <a href="/logout.php" class="px-4 py-2 rounded-lg border border-dark-border text-gray-300 hover:text-neon-purple hover:border-neon-purple transition-colors">
                Выйти
            </a>
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

        <div class="bg-dark-surface border border-dark-border rounded-2xl shadow-xl overflow-hidden">
            <div class="hidden lg:block">
                <table class="w-full">
                    <thead class="bg-dark-bg/60 border-b border-dark-border">
                        <tr class="text-left text-sm text-gray-400">
                            <th class="px-6 py-3">Клиент</th>
                            <th class="px-4 py-3">Статус</th>
                            <th class="px-4 py-3">Этап</th>
                            <th class="px-4 py-3">Прогресс</th>
                            <th class="px-4 py-3">Время (мин)</th>
                            <th class="px-4 py-3">Старт</th>
                            <th class="px-4 py-3">Заметки</th>
                            <th class="px-4 py-3 text-right">Сохранить</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-border">
                        <?php foreach ($clients as $client): ?>
                            <tr class="align-top">
                                <td class="px-6 py-4">
                                    <p class="text-white font-semibold"><?php echo htmlspecialchars($client['name']); ?></p>
                                    <p class="text-gray-400 text-sm"><?php echo htmlspecialchars($client['email']); ?></p>
                                    <p class="text-xs text-gray-500 mt-1">Создан: <?php echo htmlspecialchars(date('d.m.Y', strtotime($client['created_at']))); ?></p>
                                    <p class="text-xs text-gray-500">Роль: <?php echo htmlspecialchars($client['role']); ?></p>
                                </td>
                                <td colspan="7" class="px-4 py-4">
                                    <form method="POST" action="/adm/save.php" class="grid grid-cols-12 gap-3 items-start">
                                        <?php echo csrfInput(); ?>
                                        <input type="hidden" name="user_id" value="<?php echo (int)$client['id']; ?>">

                                        <div class="col-span-3">
                                            <input name="status" value="<?php echo htmlspecialchars($client['status']); ?>" placeholder="Напр. Дизайн"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-2">
                                            <input name="stage" value="<?php echo htmlspecialchars($client['stage']); ?>" placeholder="Этап"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-1">
                                            <input type="number" min="0" max="100" name="progress_percent"
                                                   value="<?php echo (int)$client['progress_percent']; ?>"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-1">
                                            <input type="number" min="0" name="time_spent_minutes"
                                                   value="<?php echo (int)$client['time_spent_minutes']; ?>"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-2">
                                            <input type="date" name="started_at"
                                                   value="<?php echo htmlspecialchars($client['started_at'] ? substr($client['started_at'], 0, 10) : ''); ?>"
                                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40">
                                        </div>
                                        <div class="col-span-2">
                                            <textarea name="notes" rows="2" placeholder="Комментарий"
                                                      class="w-full bg-dark-bg border border-dark-border rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/40"><?php echo htmlspecialchars($client['notes']); ?></textarea>
                                        </div>
                                        <div class="col-span-1 text-right">
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
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

