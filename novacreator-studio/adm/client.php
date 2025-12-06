<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/user_service.php';

startSecureSession();
requireAdmin();

$clientId = (int)($_GET['id'] ?? 0);
if ($clientId <= 0) {
    setFlash('error', 'Неверный ID клиента.');
    header('Location: /adm/');
    exit;
}

$client = getUserWithProject($clientId);
if (!$client) {
    setFlash('error', 'Клиент не найден.');
    header('Location: /adm/');
    exit;
}

$pageTitle = 'Редактирование: ' . htmlspecialchars($client['name']);

// Обработка сохранения
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        setFlash('error', 'CSRF токен недействителен. Попробуйте ещё раз.');
    } else {
        $payload = [
            'user_id' => $clientId,
            'status' => trim($_POST['status'] ?? ''),
            'progress_percent' => (int)($_POST['progress_percent'] ?? 0),
            'time_spent_minutes' => (int)($_POST['time_spent_minutes'] ?? 0),
            'stage' => trim($_POST['stage'] ?? ''),
            'notes' => trim($_POST['notes'] ?? ''),
            'started_at' => !empty($_POST['started_at']) ? trim($_POST['started_at']) : null,
            'avg_progress_per_day' => !empty($_POST['avg_progress_per_day']) ? trim($_POST['avg_progress_per_day']) : null,
            'avg_hours_per_day' => !empty($_POST['avg_hours_per_day']) ? trim($_POST['avg_hours_per_day']) : null,
            'estimated_completion_days' => !empty($_POST['estimated_completion_days']) ? trim($_POST['estimated_completion_days']) : null,
        ];
        
        upsertProject($payload);
        setFlash('success', 'Данные сохранены.');
        
        // Обновляем данные клиента
        $client = getUserWithProject($clientId);
    }
}

$progress = (int)($client['progress_percent'] ?? 0);
$statusText = $client['status'] ?? 'Ожидает обновления';
$stageText = $client['stage'] ?? 'Скоро будет обновлено';
$timeSpent = (int)($client['time_spent_minutes'] ?? 0);
$updatedAt = $client['updated_at'] ?? null;
$startedAt = $client['started_at'] ?? null;

// Вычисляем метрики (используем сохраненные значения или вычисляем автоматически)
$startedAtTimestamp = null;
if ($startedAt) {
    $startedAtTimestamp = strtotime($startedAt);
    if ($startedAtTimestamp === false) {
        $startedAtTimestamp = null;
    }
}
$daysActive = 0;
if ($startedAtTimestamp) {
    $daysActive = max(0, ceil((time() - $startedAtTimestamp) / 86400));
}

// Используем сохраненные значения или вычисляем автоматически
$avgProgressPerDay = $client['avg_progress_per_day'] ?? null;
if ($avgProgressPerDay === null) {
    $avgProgressPerDay = $daysActive > 0 ? round($progress / $daysActive, 1) : 0;
}

$avgHoursPerDay = $client['avg_hours_per_day'] ?? null;
if ($avgHoursPerDay === null) {
    $hoursSpent = round($timeSpent / 60, 1);
    $avgHoursPerDay = $daysActive > 0 ? round($hoursSpent / $daysActive, 1) : 0;
} else {
    $hoursSpent = round($timeSpent / 60, 1);
}

$estimatedCompletion = $client['estimated_completion_days'] ?? null;
if ($estimatedCompletion === null) {
    $estimatedCompletion = $avgProgressPerDay > 0 ? ceil((100 - $progress) / $avgProgressPerDay) : 0;
}

function minutesToHuman(int $minutes): string
{
    $hours = intdiv($minutes, 60);
    $mins = $minutes % 60;
    if ($hours > 0) {
        return $hours . ' ч ' . $mins . ' мин';
    }
    return $mins . ' мин';
}

$flashSuccess = getFlash('success');
$flashError = getFlash('error');

include __DIR__ . '/../includes/header.php';
?>

<main class="min-h-screen bg-gradient-to-b from-dark-bg via-dark-bg/90 to-dark-bg pt-28 pb-16 px-4">
    <div class="container mx-auto max-w-7xl space-y-8">
        <!-- Заголовок -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <a href="/adm/" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-neon-purple transition-colors mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Назад к списку клиентов
                </a>
                <h1 class="text-3xl md:text-4xl font-bold text-gradient">Редактирование клиента</h1>
                <p class="text-gray-400 text-sm mt-1"><?php echo htmlspecialchars($client['name']); ?> (<?php echo htmlspecialchars($client['email']); ?>)</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/adm/" class="px-4 py-2 rounded-lg border border-dark-border text-gray-300 hover:text-neon-purple hover:border-neon-purple transition-colors">
                    Список клиентов
                </a>
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

        <form method="POST" action="/adm/save.php" class="space-y-6">
            <?php echo csrfInput(); ?>
            <input type="hidden" name="user_id" value="<?php echo $clientId; ?>">
            <input type="hidden" name="redirect" value="/adm/client.php?id=<?php echo $clientId; ?>">
            
            <!-- Основная информация -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold text-white mb-6">Основная информация</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Имя клиента</label>
                        <input type="text" value="<?php echo htmlspecialchars($client['name']); ?>" disabled
                               class="w-full bg-dark-bg/50 border border-dark-border rounded-lg px-4 py-3 text-white cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">Имя нельзя изменить</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Email</label>
                        <input type="email" value="<?php echo htmlspecialchars($client['email']); ?>" disabled
                               class="w-full bg-dark-bg/50 border border-dark-border rounded-lg px-4 py-3 text-white cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">Email нельзя изменить</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Статус проекта</label>
                        <input type="text" name="status" value="<?php echo htmlspecialchars($statusText); ?>" 
                               placeholder="Например: В разработке"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Текущий этап</label>
                        <input type="text" name="stage" value="<?php echo htmlspecialchars($stageText); ?>" 
                               placeholder="Например: Дизайн макетов"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                    </div>
                </div>
            </div>

            <!-- Прогресс и метрики -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold text-white mb-6">Прогресс и метрики</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Прогресс (%)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="progress_percent" min="0" max="100" value="<?php echo $progress; ?>" 
                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                            <div class="flex flex-col gap-1">
                                <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-progress" data-delta="10">+10</button>
                                <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-progress" data-delta="-10">-10</button>
                            </div>
                        </div>
                        <div class="mt-2 w-full bg-dark-bg border border-dark-border rounded-full h-2 overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full progress-bar" style="width: <?php echo max(0, min(100, $progress)); ?>%;"></div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Время работы (минуты)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="time_spent_minutes" min="0" value="<?php echo $timeSpent; ?>" 
                                   class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                            <div class="flex flex-col gap-1">
                                <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-time" data-delta="60">+60</button>
                                <button type="button" class="px-2 py-1 text-xs rounded bg-dark-bg border border-dark-border text-gray-300 hover:text-neon-purple adjust-time" data-delta="-60">-60</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1"><?php echo minutesToHuman($timeSpent); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Дата начала</label>
                        <input type="date" name="started_at" 
                               value="<?php echo $startedAt ? htmlspecialchars(substr($startedAt, 0, 10)) : ''; ?>" 
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Роль</label>
                        <input type="text" value="<?php echo htmlspecialchars($client['role']); ?>" disabled
                               class="w-full bg-dark-bg/50 border border-dark-border rounded-lg px-4 py-3 text-white cursor-not-allowed">
                    </div>
                </div>
            </div>

            <!-- Дополнительные метрики (редактируемые) -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold text-white mb-6">Дополнительные метрики</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Средний прогресс в день (%)</label>
                        <input type="number" name="avg_progress_per_day" step="0.1" min="0" 
                               value="<?php echo $avgProgressPerDay !== null ? htmlspecialchars($avgProgressPerDay) : ''; ?>" 
                               placeholder="Авто"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                        <p class="text-xs text-gray-500 mt-1">Оставьте пустым для автоматического расчета</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Среднее время в день (часы)</label>
                        <input type="number" name="avg_hours_per_day" step="0.1" min="0" 
                               value="<?php echo $avgHoursPerDay !== null ? htmlspecialchars($avgHoursPerDay) : ''; ?>" 
                               placeholder="Авто"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                        <p class="text-xs text-gray-500 mt-1">Оставьте пустым для автоматического расчета</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Оценка завершения (дней)</label>
                        <input type="number" name="estimated_completion_days" min="0" 
                               value="<?php echo $estimatedCompletion !== null ? htmlspecialchars($estimatedCompletion) : ''; ?>" 
                               placeholder="Авто"
                               class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple">
                        <p class="text-xs text-gray-500 mt-1">Оставьте пустым для автоматического расчета</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Дней активно</label>
                        <input type="text" value="<?php echo $daysActive; ?>" disabled
                               class="w-full bg-dark-bg/50 border border-dark-border rounded-lg px-4 py-3 text-white cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">Вычисляется автоматически</p>
                    </div>
                </div>
            </div>

            <!-- Заметки -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold text-white mb-4">Заметки и комментарии</h2>
                <textarea name="notes" rows="6" 
                          placeholder="Добавьте заметки о проекте..."
                          class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"><?php echo htmlspecialchars($client['notes'] ?? ''); ?></textarea>
            </div>

            <!-- Информация о клиенте -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold text-white mb-4">Информация о клиенте</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400">Дата регистрации</p>
                        <p class="text-white font-medium mt-1">
                            <?php 
                            $createdAtTimestamp = isset($client['created_at']) ? strtotime($client['created_at']) : false;
                            echo $createdAtTimestamp ? htmlspecialchars(date('d.m.Y H:i', $createdAtTimestamp)) : 'Не указано';
                            ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-400">Последнее обновление</p>
                        <p class="text-white font-medium mt-1">
                            <?php 
                            $updatedAtTimestamp = $updatedAt ? strtotime($updatedAt) : false;
                            echo $updatedAtTimestamp ? htmlspecialchars(date('d.m.Y H:i', $updatedAtTimestamp)) : 'Никогда';
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Кнопки действий -->
            <div class="flex items-center justify-between gap-4">
                <a href="/adm/" class="px-6 py-3 rounded-lg border border-dark-border text-gray-300 hover:text-neon-purple hover:border-neon-purple transition-colors">
                    Отмена
                </a>
                <button type="submit" class="px-6 py-3 rounded-lg bg-gradient-to-r from-neon-purple to-neon-blue text-white font-semibold hover:from-neon-purple/90 hover:to-neon-blue/90 transition-all duration-300 shadow-lg shadow-neon-purple/30 hover:shadow-xl">
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Корректировка прогресса
    document.querySelectorAll('.adjust-progress').forEach(btn => {
        btn.addEventListener('click', () => {
            const delta = Number(btn.dataset.delta || 0);
            const input = document.querySelector('input[name="progress_percent"]');
            const bar = document.querySelector('.progress-bar');
            if (!input) return;
            const next = Math.max(0, Math.min(100, Number(input.value || 0) + delta));
            input.value = next;
            if (bar) bar.style.width = `${next}%`;
        });
    });

    // Корректировка времени
    document.querySelectorAll('.adjust-time').forEach(btn => {
        btn.addEventListener('click', () => {
            const delta = Number(btn.dataset.delta || 0);
            const input = document.querySelector('input[name="time_spent_minutes"]');
            if (!input) return;
            const next = Math.max(0, Number(input.value || 0) + delta);
            input.value = next;
        });
    });

    // Обновление прогресс-бара при изменении значения
    const progressInput = document.querySelector('input[name="progress_percent"]');
    const progressBar = document.querySelector('.progress-bar');
    if (progressInput && progressBar) {
        progressInput.addEventListener('input', () => {
            const value = Math.max(0, Math.min(100, Number(progressInput.value || 0)));
            progressBar.style.width = `${value}%`;
        });
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

