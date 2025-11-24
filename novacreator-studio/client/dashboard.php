<?php
require_once 'config.php';
checkClientAuth();

$clientId = $_SESSION['client_id'];
$projects = getClientProjects($clientId);
$stages = getProjectStages();

$pageTitle = 'Личный кабинет';
$pageMetaTitle = 'Личный кабинет - NovaCreator Studio';
$pageMetaDescription = 'Отслеживайте статус ваших проектов в реальном времени';
include '../includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2 text-gradient">Добро пожаловать, <?php echo htmlspecialchars($_SESSION['client_name']); ?>!</h1>
                <p class="text-gray-400">Отслеживайте процесс разработки ваших проектов</p>
            </div>
            <a href="logout.php" class="btn-outline">Выйти</a>
        </div>
        
        <?php if (empty($projects)): ?>
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-12 text-center">
                <div class="w-24 h-24 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-4 text-gradient">У вас пока нет проектов</h2>
                <p class="text-gray-400 mb-8">После создания заявки ваш проект появится здесь</p>
                <a href="/contact" class="btn-neon inline-block">Создать заявку</a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach ($projects as $project): ?>
                    <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold mb-2 text-gradient"><?php echo htmlspecialchars($project['name']); ?></h2>
                                <p class="text-gray-400"><?php echo htmlspecialchars($project['type']); ?></p>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-400 mb-1">Статус</div>
                                <div class="px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-full font-semibold">
                                    <?php 
                                    $currentStage = $project['current_stage'] ?? 'planning';
                                    echo $stages[$currentStage]['name'] ?? 'Планирование';
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-400">Прогресс</span>
                                <span class="text-sm font-semibold text-neon-purple">
                                    <?php 
                                    $progress = $project['progress'] ?? 0;
                                    echo $progress . '%';
                                    ?>
                                </span>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-neon-purple to-neon-blue h-3 rounded-full transition-all duration-500" style="width: <?php echo $progress; ?>%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gradient">Этапы разработки</h3>
                            <div class="space-y-4">
                                <?php 
                                $currentOrder = isset($stages[$currentStage]) ? $stages[$currentStage]['order'] : 0;
                                foreach ($stages as $stageKey => $stage): 
                                    $stageOrder = $stage['order'];
                                    $isCompleted = $stageOrder < $currentOrder;
                                    $isCurrent = $stageOrder == $currentOrder;
                                    $isPending = $stageOrder > $currentOrder;
                                ?>
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <?php if ($isCompleted): ?>
                                                <div class="w-12 h-12 bg-green-600/20 border-2 border-green-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            <?php elseif ($isCurrent): ?>
                                                <div class="w-12 h-12 bg-neon-purple/20 border-2 border-neon-purple rounded-full flex items-center justify-center animate-pulse">
                                                    <span class="text-2xl"><?php echo $stage['icon']; ?></span>
                                                </div>
                                            <?php else: ?>
                                                <div class="w-12 h-12 bg-dark-bg border-2 border-dark-border rounded-full flex items-center justify-center">
                                                    <span class="text-2xl opacity-50"><?php echo $stage['icon']; ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <h4 class="font-semibold <?php echo $isCurrent ? 'text-neon-purple' : ($isCompleted ? 'text-green-400' : 'text-gray-400'); ?>">
                                                    <?php echo $stage['name']; ?>
                                                </h4>
                                                <?php if ($isCurrent): ?>
                                                    <span class="px-2 py-1 bg-neon-purple/20 text-neon-purple rounded text-xs font-semibold">В работе</span>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-sm text-gray-400"><?php echo $stage['description']; ?></p>
                                            <?php if (isset($project['stages'][$stageKey]) && !empty($project['stages'][$stageKey]['notes'])): ?>
                                                <div class="mt-2 p-3 bg-dark-bg rounded-lg">
                                                    <p class="text-sm text-gray-300"><?php echo htmlspecialchars($project['stages'][$stageKey]['notes']); ?></p>
                                                    <?php if (isset($project['stages'][$stageKey]['updated_at'])): ?>
                                                        <p class="text-xs text-gray-500 mt-2">Обновлено: <?php echo date('d.m.Y H:i', strtotime($project['stages'][$stageKey]['updated_at'])); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <?php if (!empty($project['files'])): ?>
                            <div class="mt-6 pt-6 border-t border-dark-border">
                                <h3 class="text-lg font-semibold mb-4 text-gradient">Файлы проекта</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <?php foreach ($project['files'] as $file): ?>
                                        <a href="<?php echo htmlspecialchars($file['url']); ?>" target="_blank" class="flex items-center space-x-3 p-3 bg-dark-bg rounded-lg hover:bg-dark-surface transition-colors">
                                            <svg class="w-6 h-6 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-300 truncate"><?php echo htmlspecialchars($file['name']); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo date('d.m.Y', strtotime($file['uploaded_at'])); ?></p>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-6 pt-6 border-t border-dark-border text-sm text-gray-400">
                            <p>Дата начала: <?php echo date('d.m.Y', strtotime($project['created_at'])); ?></p>
                            <?php if (isset($project['deadline'])): ?>
                                <p>Срок сдачи: <?php echo date('d.m.Y', strtotime($project['deadline'])); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="mt-8 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold mb-2 text-gradient">Получайте уведомления о прогрессе</h3>
                    <p class="text-gray-300">Включите push-уведомления, чтобы быть в курсе всех обновлений проекта</p>
                </div>
                <button id="enableNotifications" class="btn-neon">Включить уведомления</button>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const enableBtn = document.getElementById('enableNotifications');
    
    if ('Notification' in window && 'serviceWorker' in navigator) {
        enableBtn.addEventListener('click', async function() {
            if (Notification.permission === 'granted') {
                await subscribeToPush();
            } else if (Notification.permission === 'default') {
                const permission = await Notification.requestPermission();
                if (permission === 'granted') {
                    await subscribeToPush();
                }
            } else {
                alert('Уведомления заблокированы. Разрешите их в настройках браузера.');
            }
        });
        
        checkSubscriptionStatus();
    } else {
        enableBtn.style.display = 'none';
    }
});

async function subscribeToPush() {
    try {
        const registration = await navigator.serviceWorker.ready;
        const vapidPublicKey = 'BAu829izfGzXhqCafmsCdylgoMCqYTKVdzJSIft7orDyAYBxk0VenPv2GOuyxISF3AaleH8Qb3AokrhwHN4Ecg0';
        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(vapidPublicKey)
        });
        
        const response = await fetch('/client/save-subscription.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                subscription: subscription,
                client_id: <?php echo $clientId; ?>
            })
        });
        
        if (response.ok) {
            document.getElementById('enableNotifications').textContent = 'Уведомления включены';
            document.getElementById('enableNotifications').classList.remove('btn-neon');
            document.getElementById('enableNotifications').classList.add('btn-outline');
        }
    } catch (error) {
        console.error('Ошибка подписки:', error);
    }
}

async function checkSubscriptionStatus() {
    try {
        const registration = await navigator.serviceWorker.ready;
        const subscription = await registration.pushManager.getSubscription();
        
        if (subscription) {
            const response = await fetch('/client/check-subscription.php?client_id=<?php echo $clientId; ?>');
            const data = await response.json();
            
            if (data.subscribed) {
                document.getElementById('enableNotifications').textContent = 'Уведомления включены';
                document.getElementById('enableNotifications').classList.remove('btn-neon');
                document.getElementById('enableNotifications').classList.add('btn-outline');
            }
        }
    } catch (error) {
        console.error('Ошибка проверки подписки:', error);
    }
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');
    
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
</script>

<?php include '../includes/footer.php'; ?>

