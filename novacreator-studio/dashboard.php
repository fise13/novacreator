<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/user_service.php';

// Подключаем систему переводов
if (!function_exists('t')) {
    require_once __DIR__ . '/includes/i18n.php';
}

startSecureSession();
requireLogin('/login.php');

$currentLang = getCurrentLanguage();

$user = getAuthenticatedUser();
if (!$user || !isset($user['id'])) {
    header('Location: /login.php');
    exit;
}

$userData = getUserWithProject($user['id']);
if (!$userData) {
    $userData = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role'],
        'created_at' => $user['created_at'],
        'avatar_url' => $user['avatar_url'] ?? null,
        'progress_percent' => 0,
        'status' => t('dashboard.status.waiting'),
        'stage' => t('dashboard.status.soon'),
        'time_spent_minutes' => 0,
        'updated_at' => null,
        'started_at' => null,
        'notes' => null
    ];
} else {
    $userData['avatar_url'] = $userData['avatar_url'] ?? $user['avatar_url'] ?? null;
}

$pageTitle = t('dashboard.title');
$progress = (int)($userData['progress_percent'] ?? 0);
$statusText = $userData['status'] ?? t('dashboard.status.waiting');
$stageText = $userData['stage'] ?? t('dashboard.status.soon');
$timeSpent = (int)($userData['time_spent_minutes'] ?? 0);
$updatedAt = $userData['updated_at'] ?? null;
$startedAt = $userData['started_at'] ?? null;

// Генерируем данные для графиков
$startedAtTimestamp = null;
if ($startedAt) {
    $startedAtTimestamp = strtotime($startedAt);
    if ($startedAtTimestamp === false) {
        $startedAtTimestamp = null;
    }
}
$daysSinceStart = $startedAtTimestamp ? max(1, (int)((time() - $startedAtTimestamp) / 86400)) : 7;
$chartLabels = [];
$chartProgress = [];
$chartTime = [];

for ($i = 0; $i < min(14, $daysSinceStart); $i++) {
    $date = date('d.m', strtotime("-$i days"));
    if ($date === false) {
        $date = date('d.m');
    }
    $chartLabels[] = $date;
    $simulatedProgress = max(0, min(100, $progress - ($i * 5) + rand(-3, 3)));
    $chartProgress[] = max(0, $simulatedProgress);
    $simulatedTime = max(0, $timeSpent - ($i * 30) + rand(-15, 15));
    $chartTime[] = max(0, $simulatedTime);
}

$chartLabels = array_reverse($chartLabels);
$chartProgress = array_reverse($chartProgress);
$chartTime = array_reverse($chartTime);

$daysActive = 0;
if ($startedAtTimestamp) {
    $daysActive = max(0, ceil((time() - $startedAtTimestamp) / 86400));
}

$avgProgressPerDay = $userData['avg_progress_per_day'] ?? null;
if ($avgProgressPerDay === null) {
    $avgProgressPerDay = $daysActive > 0 ? round($progress / $daysActive, 1) : 0;
}

$hoursSpent = round($timeSpent / 60, 1);
$avgHoursPerDay = $userData['avg_hours_per_day'] ?? null;
if ($avgHoursPerDay === null) {
    $avgHoursPerDay = $daysActive > 0 ? round($hoursSpent / $daysActive, 1) : 0;
}

$estimatedCompletion = $userData['estimated_completion_days'] ?? null;
if ($estimatedCompletion === null) {
    $estimatedCompletion = $avgProgressPerDay > 0 ? ceil((100 - $progress) / $avgProgressPerDay) : 0;
}

function minutesToHuman(int $minutes): string
{
    $hours = intdiv($minutes, 60);
    $mins = $minutes % 60;
    if ($hours > 0) {
        return $hours . ' ' . t('dashboard.time.hours') . ' ' . $mins . ' ' . t('dashboard.time.minutes');
    }
    return $mins . ' ' . t('dashboard.time.minutes');
}

if (!function_exists('getInitials')) {
    function getInitials(string $name): string
    {
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Личный кабинет - минималистичный стиль holymedia.kz -->
<main class="min-h-screen pt-24 pb-16 px-4 md:px-6 lg:px-8" style="background-color: var(--color-bg);">
    <div class="container mx-auto max-w-7xl">
        <!-- Заголовок - большой и простой -->
        <div class="mb-16 md:mb-20 animate-on-scroll">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-4" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('dashboard.title')); ?>
            </h1>
            <p class="text-xl md:text-2xl font-light" style="color: var(--color-text-secondary);">
                <?php echo str_replace(':name', htmlspecialchars($user['name']), t('dashboard.greeting')); ?>
            </p>
        </div>

        <!-- Краткие метрики - минималистичные карточки -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.status.label')); ?></p>
                <p class="text-2xl font-semibold mb-1" style="color: var(--color-text);"><?php echo htmlspecialchars($statusText); ?></p>
                <p class="text-sm" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars($stageText); ?></p>
            </div>
            
            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.progress.label')); ?></p>
                <div class="flex items-center justify-between mb-2">
                    <p class="text-3xl font-bold" style="color: var(--color-text);"><?php echo $progress; ?>%</p>
                </div>
                <div class="w-full h-1 rounded-full overflow-hidden" style="background-color: var(--color-border);">
                    <div class="h-full transition-all duration-1000 ease-out" style="width: <?php echo max(0, min(100, $progress)); ?>%; background-color: var(--color-text);"></div>
                </div>
            </div>
            
            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.time.label')); ?></p>
                <p class="text-3xl font-bold mb-1" style="color: var(--color-text);"><?php echo minutesToHuman($timeSpent); ?></p>
                <?php if ($updatedAt): ?>
                    <p class="text-sm" style="color: var(--color-text-secondary);">
                        <?php 
                        $updatedAtTimestamp = $updatedAt ? strtotime($updatedAt) : false;
                        if ($updatedAtTimestamp) {
                            $dateStr = date('d.m.Y', $updatedAtTimestamp);
                            echo str_replace(':date', htmlspecialchars($dateStr), t('dashboard.time.updated'));
                        }
                        ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.days.active')); ?></p>
                <p class="text-3xl font-bold mb-1" style="color: var(--color-text);"><?php echo $daysActive; ?></p>
                <p class="text-sm" style="color: var(--color-text-secondary);"><?php echo $avgProgressPerDay > 0 ? $avgProgressPerDay . t('dashboard.days.perDay') : t('dashboard.days.noData'); ?></p>
            </div>
        </div>

        <!-- Графики - простые и чистые -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <div class="animate-on-scroll p-8 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.charts.progress.title')); ?></h3>
                <p class="text-base mb-6" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.charts.progress.description')); ?></p>
                <canvas id="progressChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>

            <div class="animate-on-scroll p-8 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.charts.time.title')); ?></h3>
                <p class="text-base mb-6" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.charts.time.description')); ?></p>
                <canvas id="timeChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- Дополнительная статистика -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.stats.avgProgress.label')); ?></p>
                <p class="text-3xl font-bold" style="color: var(--color-text);"><?php echo $avgProgressPerDay; ?>%</p>
                <p class="text-sm mt-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.stats.avgProgress.perDay')); ?></p>
            </div>

            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.stats.avgTime.label')); ?></p>
                <p class="text-3xl font-bold" style="color: var(--color-text);"><?php echo $avgHoursPerDay; ?><?php echo t('dashboard.time.hours'); ?></p>
                <p class="text-sm mt-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.stats.avgTime.perDay')); ?></p>
            </div>

            <div class="animate-on-scroll p-6 border rounded-lg transition-all duration-300 hover:opacity-70" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.stats.estimatedCompletion.label')); ?></p>
                <p class="text-3xl font-bold" style="color: var(--color-text);"><?php echo $estimatedCompletion; ?></p>
                <p class="text-sm mt-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.stats.estimatedCompletion.days')); ?></p>
            </div>
        </div>

        <!-- Форма отправки сообщения -->
        <div class="mb-16 animate-on-scroll p-8 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-bg);">
            <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.message.title')); ?></h3>
            <p class="text-base mb-6" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.message.description')); ?></p>
            
            <form id="messageForm" class="space-y-6">
                <?php echo csrfInput(); ?>
                
                <div>
                    <label class="block text-sm font-medium mb-2" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.message.subject.label')); ?></label>
                    <input type="text" name="subject" id="messageSubject" 
                           class="w-full px-4 py-3 border rounded-lg transition-all duration-200 focus:outline-none focus:opacity-70"
                           style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                           placeholder="<?php echo htmlspecialchars(t('dashboard.message.subject.placeholder')); ?>"
                           value="<?php echo htmlspecialchars(t('dashboard.message.subject.default')); ?>">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.message.text.label')); ?></label>
                    <textarea name="message" id="messageText" rows="5" required
                              class="w-full px-4 py-3 border rounded-lg transition-all duration-200 focus:outline-none focus:opacity-70 resize-none"
                              style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                              placeholder="<?php echo htmlspecialchars(t('dashboard.message.text.placeholder')); ?>"></textarea>
                    <p class="text-sm mt-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.message.text.note')); ?></p>
                </div>
                
                <button type="submit" id="sendMessageBtn" 
                        class="w-full px-6 py-4 text-lg font-semibold rounded-lg transition-all duration-300 hover:opacity-70 active:opacity-50"
                        style="background-color: var(--color-text); color: var(--color-bg);">
                    <?php echo htmlspecialchars(t('dashboard.message.submit')); ?>
                </button>
                
                <div id="messageResult" class="hidden"></div>
            </form>
        </div>

        <!-- Информация о пользователе и проекте -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="animate-on-scroll p-8 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <h3 class="text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.account.title')); ?></h3>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center text-xl font-bold" style="background-color: var(--color-surface); color: var(--color-text);">
                        <?php 
                        $avatarUrl = $userData['avatar_url'] ?? null;
                        if ($avatarUrl): 
                        ?>
                            <img src="<?php echo htmlspecialchars($avatarUrl); ?>" alt="Avatar" class="w-16 h-16 rounded-full object-cover">
                        <?php else: ?>
                            <?php echo getInitials($userData['name'] ?? $user['name']); ?>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="text-xl font-semibold" style="color: var(--color-text);"><?php echo htmlspecialchars($user['name']); ?></p>
                        <p class="text-sm" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>
                <div class="space-y-3 text-sm border-t pt-4" style="border-color: var(--color-border);">
                    <div class="flex items-center justify-between">
                        <span style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.account.role')); ?></span>
                        <span class="font-medium" style="color: var(--color-text);"><?php echo htmlspecialchars($user['role']); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.account.created')); ?></span>
                        <span class="font-medium" style="color: var(--color-text);">
                            <?php 
                            $createdAtTimestamp = isset($user['created_at']) ? strtotime($user['created_at']) : false;
                            echo $createdAtTimestamp ? htmlspecialchars(date('d.m.Y', $createdAtTimestamp)) : htmlspecialchars($user['created_at'] ?? '');
                            ?>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.account.totalHours')); ?></span>
                        <span class="font-medium" style="color: var(--color-text);"><?php echo $hoursSpent; ?><?php echo t('dashboard.time.hours'); ?></span>
                    </div>
                </div>
            </div>

            <div class="animate-on-scroll p-8 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-bg);">
                <h3 class="text-2xl font-bold mb-6" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.project.title')); ?></h3>
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.project.stage.label')); ?></span>
                        </div>
                        <p class="text-xl font-semibold mb-4" style="color: var(--color-text);"><?php echo htmlspecialchars($stageText); ?></p>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.progress.label')); ?></span>
                            <span class="text-sm font-semibold" style="color: var(--color-text);"><?php echo $progress; ?>%</span>
                        </div>
                        <div class="w-full h-2 rounded-full overflow-hidden" style="background-color: var(--color-border);">
                            <div class="h-full transition-all duration-1000 ease-out" style="width: <?php echo $progress; ?>%; background-color: var(--color-text);"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t" style="border-color: var(--color-border);">
                        <div class="p-4 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-surface);">
                            <p class="text-sm mb-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.time.label')); ?></p>
                            <p class="text-xl font-bold" style="color: var(--color-text);"><?php echo minutesToHuman($timeSpent); ?></p>
                        </div>
                        <div class="p-4 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-surface);">
                            <p class="text-sm mb-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.days.active')); ?></p>
                            <p class="text-xl font-bold" style="color: var(--color-text);"><?php echo $daysActive; ?></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.project.comment.label')); ?></p>
                        <p class="text-base leading-relaxed p-4 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-surface); color: var(--color-text);">
                            <?php echo htmlspecialchars($userData['notes'] ?: t('dashboard.project.comment.empty')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Хронология проекта -->
        <div class="animate-on-scroll p-8 border rounded-lg" style="border-color: var(--color-border); background-color: var(--color-bg);">
            <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);"><?php echo htmlspecialchars(t('dashboard.timeline.title')); ?></h3>
            <p class="text-base mb-6" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.timeline.description')); ?></p>

            <?php if (!empty($startedAt)): ?>
                <div class="relative pl-6 space-y-6">
                    <div class="absolute left-0 top-0 bottom-0 w-px" style="background-color: var(--color-border);"></div>
                    
                    <div class="flex items-start gap-4">
                        <div class="relative z-10 w-3 h-3 rounded-full -ml-1.5 mt-1.5" style="background-color: var(--color-text);"></div>
                        <div class="flex-1 pb-6">
                            <p class="text-sm mb-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.timeline.start')); ?></p>
                            <p class="text-lg font-semibold" style="color: var(--color-text);"><?php echo $startedAtTimestamp ? htmlspecialchars(date('d.m.Y', $startedAtTimestamp)) : htmlspecialchars($startedAt); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="relative z-10 w-3 h-3 rounded-full -ml-1.5 mt-1.5" style="background-color: var(--color-text);"></div>
                        <div class="flex-1 pb-6">
                            <p class="text-sm mb-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.project.stage.current')); ?></p>
                            <p class="text-lg font-semibold" style="color: var(--color-text);"><?php echo htmlspecialchars($stageText); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="relative z-10 w-3 h-3 rounded-full -ml-1.5 mt-1.5" style="background-color: var(--color-text);"></div>
                        <div class="flex-1">
                            <p class="text-sm mb-1" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.progress.label')); ?></p>
                            <p class="text-lg font-semibold mb-2" style="color: var(--color-text);"><?php echo $progress; ?>% <?php echo htmlspecialchars(t('dashboard.progress.completed')); ?></p>
                            <div class="w-full h-1 rounded-full overflow-hidden" style="background-color: var(--color-border);">
                                <div class="h-full transition-all duration-1000 ease-out" style="width: <?php echo $progress; ?>%; background-color: var(--color-text);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-lg mb-2" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.timeline.empty.title')); ?></p>
                    <p class="text-sm" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars(t('dashboard.timeline.empty.subtitle')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Данные для графиков
    const progressData = {
        labels: <?php echo json_encode($chartLabels); ?>,
        datasets: [{
            label: <?php echo json_encode(t('dashboard.charts.progress.label')); ?>,
            data: <?php echo json_encode($chartProgress); ?>,
            borderColor: 'var(--color-text)',
            backgroundColor: 'transparent',
            borderWidth: 2,
            fill: false,
            tension: 0.4,
            pointRadius: 4,
            pointHoverRadius: 6,
            pointBackgroundColor: 'var(--color-text)',
            pointBorderColor: 'var(--color-bg)',
            pointBorderWidth: 2
        }]
    };

    const timeData = {
        labels: [<?php echo json_encode(t('dashboard.charts.time.work')); ?>, <?php echo json_encode(t('dashboard.charts.time.waiting')); ?>, <?php echo json_encode(t('dashboard.charts.time.planning')); ?>],
        datasets: [{
            data: [
                <?php echo round($timeSpent * 0.7); ?>,
                <?php echo round($timeSpent * 0.2); ?>,
                <?php echo round($timeSpent * 0.1); ?>
            ],
            backgroundColor: [
                'var(--color-text)',
                'rgba(0, 0, 0, 0.1)',
                'rgba(0, 0, 0, 0.05)'
            ],
            borderWidth: 0
        }]
    };

    // График прогресса
    const progressCtx = document.getElementById('progressChart');
    if (progressCtx) {
        new Chart(progressCtx, {
            type: 'line',
            data: progressData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'var(--color-bg)',
                        titleColor: 'var(--color-text)',
                        bodyColor: 'var(--color-text)',
                        borderColor: 'var(--color-border)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: 'var(--color-border)'
                        },
                        ticks: {
                            color: 'var(--color-text-secondary)',
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'var(--color-text-secondary)'
                        }
                    }
                }
            }
        });
    }

    // Круговой график
    const timeCtx = document.getElementById('timeChart');
    if (timeCtx) {
        new Chart(timeCtx, {
            type: 'doughnut',
            data: timeData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'var(--color-text-secondary)',
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'var(--color-bg)',
                        titleColor: 'var(--color-text)',
                        bodyColor: 'var(--color-text)',
                        borderColor: 'var(--color-border)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const minutes = context.parsed;
                                const hours = Math.floor(minutes / 60);
                                const mins = minutes % 60;
                                return context.label + ': ' + (hours > 0 ? hours + 'ч ' : '') + mins + 'мин';
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }

    // Обработка отправки сообщения
    const messageForm = document.getElementById('messageForm');
    const messageResult = document.getElementById('messageResult');
    const sendMessageBtn = document.getElementById('sendMessageBtn');
    const messageText = document.getElementById('messageText');

    if (messageForm) {
        messageForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(messageForm);
            const submitBtn = sendMessageBtn;
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = <?php echo json_encode(t('dashboard.message.sending')); ?>;
            submitBtn.style.opacity = '0.5';
            
            messageResult.classList.add('hidden');
            
            try {
                const response = await fetch('/backend/send_message.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    messageResult.className = 'p-4 border rounded-lg text-sm';
                    messageResult.style.borderColor = 'var(--color-border)';
                    messageResult.style.backgroundColor = 'var(--color-surface)';
                    messageResult.style.color = 'var(--color-text)';
                    messageResult.textContent = data.message || <?php echo json_encode(t('dashboard.message.success')); ?>;
                    messageResult.classList.remove('hidden');
                    
                    messageText.value = '';
                    
                    setTimeout(() => {
                        messageResult.classList.add('hidden');
                    }, 5000);
                } else {
                    messageResult.className = 'p-4 border rounded-lg text-sm';
                    messageResult.style.borderColor = '#ef4444';
                    messageResult.style.backgroundColor = 'rgba(239, 68, 68, 0.1)';
                    messageResult.style.color = '#ef4444';
                    messageResult.textContent = data.message || <?php echo json_encode(t('dashboard.message.error')); ?>;
                    messageResult.classList.remove('hidden');
                }
            } catch (error) {
                messageResult.className = 'p-4 border rounded-lg text-sm';
                messageResult.style.borderColor = '#ef4444';
                messageResult.style.backgroundColor = 'rgba(239, 68, 68, 0.1)';
                messageResult.style.color = '#ef4444';
                messageResult.textContent = <?php echo json_encode(t('dashboard.message.connectionError')); ?>;
                messageResult.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                submitBtn.style.opacity = '1';
            }
        });
    }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
