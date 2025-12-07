<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/user_service.php';

startSecureSession();
requireLogin('/login.php');

$user = getAuthenticatedUser();
if (!$user || !isset($user['id'])) {
    header('Location: /login.php');
    exit;
}

$userData = getUserWithProject($user['id']);
if (!$userData) {
    // Если данных нет, создаем пустой массив с данными пользователя
    $userData = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role'],
        'created_at' => $user['created_at'],
        'avatar_url' => $user['avatar_url'] ?? null,
        'progress_percent' => 0,
        'status' => 'Ожидает обновления',
        'stage' => 'Скоро будет обновлено',
        'time_spent_minutes' => 0,
        'updated_at' => null,
        'started_at' => null,
        'notes' => null
    ];
} else {
    // Дополняем данными пользователя, если их нет
    $userData['avatar_url'] = $userData['avatar_url'] ?? $user['avatar_url'] ?? null;
}

$pageTitle = 'Личный кабинет';
$progress = (int)($userData['progress_percent'] ?? 0);
$statusText = $userData['status'] ?? 'Ожидает обновления';
$stageText = $userData['stage'] ?? 'Скоро будет обновлено';
$timeSpent = (int)($userData['time_spent_minutes'] ?? 0);
$updatedAt = $userData['updated_at'] ?? null;
$startedAt = $userData['started_at'] ?? null;

// Генерируем данные для графиков (симуляция исторических данных)
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
    // Симулируем прогресс (увеличивается со временем)
    $simulatedProgress = max(0, min(100, $progress - ($i * 5) + rand(-3, 3)));
    $chartProgress[] = max(0, $simulatedProgress);
    // Симулируем время работы
    $simulatedTime = max(0, $timeSpent - ($i * 30) + rand(-15, 15));
    $chartTime[] = max(0, $simulatedTime);
}

$chartLabels = array_reverse($chartLabels);
$chartProgress = array_reverse($chartProgress);
$chartTime = array_reverse($chartTime);

// Вычисляем дополнительные метрики (используем сохраненные значения или вычисляем автоматически)
$daysActive = 0;
if ($startedAtTimestamp) {
    $daysActive = max(0, ceil((time() - $startedAtTimestamp) / 86400));
}

// Используем сохраненные значения или вычисляем автоматически
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
        return $hours . ' ч ' . $mins . ' мин';
    }
    return $mins . ' мин';
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

<main class="min-h-screen bg-gradient-to-b from-dark-bg via-dark-bg/90 to-dark-bg pt-28 pb-16 px-4">
    <div class="container mx-auto max-w-7xl space-y-8">
        <!-- Заголовок с анимацией -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 animate-fade-in">
            <div>
                <p class="text-sm text-gray-400 animate-slide-in-left">Здравствуйте, <span class="text-neon-purple font-semibold"><?php echo htmlspecialchars($user['name']); ?></span></p>
                <h1 class="text-3xl md:text-4xl font-bold text-gradient animate-slide-in-left" style="animation-delay: 0.1s;">Личный кабинет</h1>
                <p class="text-gray-400 text-sm mt-1 animate-slide-in-left" style="animation-delay: 0.2s;">Здесь отображается статус работы над вашим проектом.</p>
            </div>
            <div class="flex items-center gap-3 animate-slide-in-right">
                <a href="/logout.php" class="px-4 py-2 rounded-lg border border-dark-border text-gray-300 hover:text-neon-purple hover:border-neon-purple transition-all duration-300 hover:scale-105 active:scale-95">
                    Выйти
                </a>
            </div>
        </div>

        <!-- Краткие метрики с анимацией -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-neon-purple/10 to-neon-blue/10 border border-neon-purple/30 rounded-2xl p-5 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Статус</p>
                    <svg class="w-5 h-5 text-neon-purple animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-lg font-semibold text-white mb-1"><?php echo htmlspecialchars($statusText); ?></p>
                <p class="text-xs text-gray-500"><?php echo htmlspecialchars($stageText); ?></p>
            </div>
            <div class="bg-gradient-to-br from-neon-blue/10 to-neon-purple/10 border border-neon-blue/30 rounded-2xl p-5 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Прогресс</p>
                    <svg class="w-5 h-5 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-2xl font-bold text-white"><?php echo $progress; ?>%</p>
                    <div class="w-24 bg-dark-bg border border-dark-border rounded-full h-2 overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full progress-bar-animate" style="width: <?php echo max(0, min(100, $progress)); ?>%;"></div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/30 rounded-2xl p-5 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Время работы</p>
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-white"><?php echo minutesToHuman($timeSpent); ?></p>
                <?php if ($updatedAt): ?>
                    <p class="text-xs text-gray-500 mt-1">Обновлено: <?php 
                        $updatedAtTimestamp = $updatedAt ? strtotime($updatedAt) : false;
                        echo $updatedAtTimestamp ? htmlspecialchars(date('d.m.Y', $updatedAtTimestamp)) : htmlspecialchars($updatedAt ?? '');
                    ?></p>
                <?php endif; ?>
            </div>
            <div class="bg-gradient-to-br from-yellow-500/10 to-orange-500/10 border border-yellow-500/30 rounded-2xl p-5 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Дней активно</p>
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-white"><?php echo $daysActive; ?></p>
                <p class="text-xs text-gray-500 mt-1"><?php echo $avgProgressPerDay > 0 ? $avgProgressPerDay . '%/день' : 'Нет данных'; ?></p>
            </div>
        </div>

        <!-- Графики -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- График прогресса -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white">Прогресс проекта</h3>
                        <p class="text-sm text-gray-400">Динамика выполнения за последние дни</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
                <canvas id="progressChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>

            <!-- Круговой график -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white">Распределение времени</h3>
                        <p class="text-sm text-gray-400">Анализ работы над проектом</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-neon-blue to-neon-purple flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                </div>
                <canvas id="timeChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- Дополнительная статистика -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl hover:border-neon-purple/50 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500/20 to-blue-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Средний прогресс</p>
                        <p class="text-2xl font-bold text-white"><?php echo $avgProgressPerDay; ?>%</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500">Прогресс в день</p>
            </div>

            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl hover:border-neon-blue/50 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500/20 to-cyan-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Среднее время</p>
                        <p class="text-2xl font-bold text-white"><?php echo $avgHoursPerDay; ?>ч</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500">Часов в день</p>
            </div>

            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl hover:border-green-500/50 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.7s;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-green-500/20 to-emerald-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Оценка завершения</p>
                        <p class="text-2xl font-bold text-white"><?php echo $estimatedCompletion; ?></p>
                    </div>
                </div>
                <p class="text-xs text-gray-500">Дней до завершения</p>
            </div>
        </div>

        <!-- Форма отправки сообщения -->
        <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-semibold text-white">Отправить сообщение</h3>
                    <p class="text-sm text-gray-400">Свяжитесь с создателем проекта или администратором</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
            </div>
            
            <form id="messageForm" class="space-y-4">
                <?php echo csrfInput(); ?>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Тема сообщения</label>
                    <input type="text" name="subject" id="messageSubject" 
                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple"
                           placeholder="Например: Вопрос по проекту"
                           value="Сообщение из личного кабинета">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Ваше сообщение</label>
                    <textarea name="message" id="messageText" rows="5" required
                              class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-neon-purple/50 focus:border-neon-purple resize-none"
                              placeholder="Напишите ваше сообщение здесь..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Сообщение будет отправлено в Telegram</p>
                </div>
                
                <button type="submit" id="sendMessageBtn" 
                        class="w-full btn-neon py-3 rounded-lg font-semibold flex items-center justify-center space-x-2 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <span>Отправить сообщение</span>
                </button>
                
                <div id="messageResult" class="hidden"></div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Информация о пользователе -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-400">Ваша учётная запись</p>
                        <h2 class="text-xl font-semibold text-white"><?php echo htmlspecialchars($user['name']); ?></h2>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-neon-purple to-neon-blue flex items-center justify-center text-white text-xl font-bold shadow-lg shadow-neon-purple/30">
                        <?php 
                        $avatarUrl = $userData['avatar_url'] ?? null;
                        if ($avatarUrl): 
                        ?>
                            <img src="<?php echo htmlspecialchars($avatarUrl); ?>" alt="Avatar" class="w-16 h-16 rounded-full object-cover">
                        <?php else: ?>
                            <?php echo getInitials($userData['name'] ?? $user['name']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <dl class="space-y-3 text-sm">
                    <div class="flex items-center justify-between py-2 border-b border-dark-border/50">
                        <dt class="text-gray-400">Email</dt>
                        <dd class="font-medium text-white"><?php echo htmlspecialchars($user['email']); ?></dd>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-dark-border/50">
                        <dt class="text-gray-400">Роль</dt>
                        <dd class="font-medium text-white px-3 py-1 rounded-lg bg-neon-purple/20 text-neon-purple"><?php echo htmlspecialchars($user['role']); ?></dd>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-dark-border/50">
                        <dt class="text-gray-400">Создан</dt>
                        <dd class="font-medium text-white"><?php 
                            $createdAtTimestamp = isset($user['created_at']) ? strtotime($user['created_at']) : false;
                            echo $createdAtTimestamp ? htmlspecialchars(date('d.m.Y', $createdAtTimestamp)) : htmlspecialchars($user['created_at'] ?? '');
                        ?></dd>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <dt class="text-gray-400">Всего часов</dt>
                        <dd class="font-medium text-white"><?php echo $hoursSpent; ?>ч</dd>
                    </div>
                </dl>
            </div>

            <!-- Статус проекта -->
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-400">Статус проекта</p>
                        <h2 class="text-xl font-semibold text-white">
                            <?php echo htmlspecialchars($statusText); ?>
                        </h2>
                    </div>
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-neon-blue to-neon-purple flex items-center justify-center text-white shadow-lg shadow-neon-blue/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h10M9 20h6" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5h14l1 5H4l1-5Z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-gray-400">Текущий этап</p>
                            <span class="text-xs text-neon-purple font-semibold">Активно</span>
                        </div>
                        <p class="font-medium text-white text-lg"><?php echo htmlspecialchars($stageText); ?></p>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-gray-400">Прогресс</p>
                            <span class="text-xs text-white font-semibold"><?php echo $progress; ?>%</span>
                        </div>
                        <div class="w-full bg-dark-bg rounded-full h-3 mt-2 overflow-hidden border border-dark-border">
                            <div class="h-3 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full progress-bar-animate" style="width: <?php echo $progress; ?>%;"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="bg-dark-bg/50 rounded-lg p-3 border border-dark-border/50">
                            <p class="text-xs text-gray-400 mb-1">Время работы</p>
                            <p class="text-lg font-bold text-white"><?php echo minutesToHuman($timeSpent); ?></p>
                        </div>
                        <div class="bg-dark-bg/50 rounded-lg p-3 border border-dark-border/50">
                            <p class="text-xs text-gray-400 mb-1">Дней активно</p>
                            <p class="text-lg font-bold text-white"><?php echo $daysActive; ?></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-400 mb-2">Комментарий</p>
                        <p class="font-medium leading-relaxed text-white bg-dark-bg/50 rounded-lg p-3 border border-dark-border/50">
                            <?php echo htmlspecialchars($userData['notes'] ?: 'Пока нет дополнительных комментариев.'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Хронология с улучшенной анимацией -->
        <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.7s;">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-semibold text-white">Хронология проекта</h3>
                    <p class="text-sm text-gray-400">История работы над вашим проектом</p>
                </div>
                <?php if ($updatedAt): ?>
                    <span class="text-sm text-gray-400 bg-dark-bg px-3 py-1 rounded-lg border border-dark-border">
                        Обновлено: <?php 
                            $updatedAtTimestamp2 = $updatedAt ? strtotime($updatedAt) : false;
                            echo $updatedAtTimestamp2 ? htmlspecialchars(date('d.m.Y H:i', $updatedAtTimestamp2)) : htmlspecialchars($updatedAt ?? '');
                        ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (!empty($startedAt)): ?>
                <div class="relative pl-6 space-y-6">
                    <div class="absolute left-0 top-0 bottom-0 w-0.5 bg-gradient-to-b from-neon-purple via-neon-blue to-green-400"></div>
                    
                    <div class="flex items-start gap-4 animate-slide-in-right" style="animation-delay: 0.1s;">
                        <div class="relative z-10 w-4 h-4 rounded-full bg-neon-purple border-4 border-dark-surface shadow-lg shadow-neon-purple/50 animate-pulse"></div>
                        <div class="flex-1 bg-dark-bg/50 rounded-xl p-4 border border-dark-border hover:border-neon-purple/50 transition-all duration-300">
                            <p class="text-xs text-gray-400 mb-1">Старт работ</p>
                            <p class="text-white font-semibold text-lg"><?php echo $startedAtTimestamp ? htmlspecialchars(date('d.m.Y', $startedAtTimestamp)) : htmlspecialchars($startedAt); ?></p>
                            <p class="text-sm text-gray-500 mt-1">Проект был запущен</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 animate-slide-in-right" style="animation-delay: 0.2s;">
                        <div class="relative z-10 w-4 h-4 rounded-full bg-neon-blue border-4 border-dark-surface shadow-lg shadow-neon-blue/50"></div>
                        <div class="flex-1 bg-dark-bg/50 rounded-xl p-4 border border-dark-border hover:border-neon-blue/50 transition-all duration-300">
                            <p class="text-xs text-gray-400 mb-1">Текущий этап</p>
                            <p class="text-white font-semibold text-lg"><?php echo htmlspecialchars($stageText); ?></p>
                            <p class="text-sm text-gray-500 mt-1">Работа продолжается</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 animate-slide-in-right" style="animation-delay: 0.3s;">
                        <div class="relative z-10 w-4 h-4 rounded-full bg-green-400 border-4 border-dark-surface shadow-lg shadow-green-400/50"></div>
                        <div class="flex-1 bg-dark-bg/50 rounded-xl p-4 border border-dark-border hover:border-green-400/50 transition-all duration-300">
                            <p class="text-xs text-gray-400 mb-1">Прогресс</p>
                            <p class="text-white font-semibold text-lg"><?php echo $progress; ?>% выполнено</p>
                            <div class="w-full bg-dark-surface rounded-full h-2 mt-2 overflow-hidden">
                                <div class="h-2 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full progress-bar-animate" style="width: <?php echo $progress; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-400 text-lg">Мы ещё не добавили детали по вашему проекту.</p>
                    <p class="text-gray-500 text-sm mt-2">Как только начнём — здесь появится таймлайн.</p>
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
            label: 'Прогресс (%)',
            data: <?php echo json_encode($chartProgress); ?>,
            borderColor: 'rgb(139, 92, 246)',
            backgroundColor: 'rgba(139, 92, 246, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: 'rgb(139, 92, 246)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverBackgroundColor: 'rgb(167, 139, 250)',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 3
        }]
    };

    const timeData = {
        labels: ['Работа', 'Ожидание', 'Планирование'],
        datasets: [{
            data: [
                <?php echo round($timeSpent * 0.7); ?>,
                <?php echo round($timeSpent * 0.2); ?>,
                <?php echo round($timeSpent * 0.1); ?>
            ],
            backgroundColor: [
                'rgba(139, 92, 246, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(16, 185, 129, 0.8)'
            ],
            borderColor: [
                'rgb(139, 92, 246)',
                'rgb(59, 130, 246)',
                'rgb(16, 185, 129)'
            ],
            borderWidth: 2,
            hoverOffset: 10
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
                    duration: 2000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 15, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgb(139, 92, 246)',
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
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#9CA3AF',
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#9CA3AF'
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
                    duration: 2000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#9CA3AF',
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 15, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgb(139, 92, 246)',
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
                cutout: '60%'
            }
        });
    }

    // Анимация появления элементов
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-fade-in-up').forEach(el => {
        observer.observe(el);
    });

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
            
            // Блокируем кнопку и показываем загрузку
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Отправка...</span>';
            
            // Скрываем предыдущий результат
            messageResult.classList.add('hidden');
            
            try {
                const response = await fetch('/backend/send_message.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Успешная отправка
                    messageResult.className = 'rounded-lg border border-green-500/40 bg-green-500/10 px-4 py-3 text-green-300 text-sm';
                    messageResult.textContent = data.message || 'Сообщение успешно отправлено!';
                    messageResult.classList.remove('hidden');
                    
                    // Очищаем форму
                    messageText.value = '';
                    
                    // Показываем успешное сообщение на 5 секунд
                    setTimeout(() => {
                        messageResult.classList.add('hidden');
                    }, 5000);
                } else {
                    // Ошибка
                    messageResult.className = 'rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-red-300 text-sm';
                    messageResult.textContent = data.message || 'Ошибка при отправке сообщения. Попробуйте позже.';
                    messageResult.classList.remove('hidden');
                }
            } catch (error) {
                // Ошибка сети
                messageResult.className = 'rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-red-300 text-sm';
                messageResult.textContent = 'Ошибка соединения. Проверьте интернет и попробуйте снова.';
                messageResult.classList.remove('hidden');
            } finally {
                // Восстанавливаем кнопку
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }
});
</script>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes progressBar {
    from {
        width: 0;
    }
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

.animate-fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.animate-slide-in-left {
    animation: slideInLeft 0.6s ease-out;
}

.animate-slide-in-right {
    animation: slideInRight 0.6s ease-out;
}

.progress-bar-animate {
    animation: progressBar 1.5s ease-out;
}

@media (prefers-reduced-motion: reduce) {
    .animate-fade-in,
    .animate-fade-in-up,
    .animate-slide-in-left,
    .animate-slide-in-right,
    .progress-bar-animate {
        animation: none;
        opacity: 1;
        transform: none;
    }
}
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>



