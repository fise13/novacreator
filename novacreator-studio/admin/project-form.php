<?php
require_once 'config.php';
checkAuth();
require_once __DIR__ . '/../client/config.php';

$isEdit = isset($project);
$project = $project ?? [
    'id' => time(),
    'name' => '',
    'type' => '',
    'client_id' => '',
    'current_stage' => 'planning',
    'progress' => 0,
    'stages' => [],
    'files' => [],
    'created_at' => date('Y-m-d H:i:s'),
    'deadline' => ''
];

$users = loadUsers();
$stages = getProjectStages();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectData = [
        'id' => (int)($_POST['id'] ?? time()),
        'name' => trim($_POST['name'] ?? ''),
        'type' => trim($_POST['type'] ?? ''),
        'client_id' => (int)($_POST['client_id'] ?? 0),
        'current_stage' => $_POST['current_stage'] ?? 'planning',
        'progress' => (int)($_POST['progress'] ?? 0),
        'stages' => [],
        'files' => [],
        'created_at' => $_POST['created_at'] ?? date('Y-m-d H:i:s'),
        'deadline' => $_POST['deadline'] ?? ''
    ];
    
    foreach ($stages as $stageKey => $stage) {
        if (isset($_POST['stage_notes_' . $stageKey])) {
            $projectData['stages'][$stageKey] = [
                'notes' => trim($_POST['stage_notes_' . $stageKey] ?? ''),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
    }
    
    if (isset($project['files'])) {
        $projectData['files'] = $project['files'];
    }
    
    $projects = loadProjects();
    
    if ($isEdit) {
        foreach ($projects as &$p) {
            if ($p['id'] == $projectData['id']) {
                $p = $projectData;
                break;
            }
        }
    } else {
        $projects[] = $projectData;
    }
    
    saveProjects($projects);
    
    if (file_exists(__DIR__ . '/../client/send-notification-simple.php')) {
        require_once __DIR__ . '/../client/send-notification-simple.php';
    } else {
        require_once __DIR__ . '/../client/send-notification.php';
    }
    
    if (function_exists('sendPushNotification')) {
        sendPushNotification(
            $projectData['client_id'],
            'Обновление проекта',
            'Проект "' . $projectData['name'] . '" обновлен. Текущий этап: ' . ($stages[$projectData['current_stage']]['name'] ?? 'Планирование'),
            '/client/dashboard.php'
        );
    }
    
    header('Location: projects.php?message=' . ($isEdit ? 'updated' : 'created'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEdit ? 'Редактирование' : 'Создание'; ?> проекта - Админ-панель</title>
    <link href="../assets/css/output.css" rel="stylesheet">
</head>
<body class="bg-dark-bg text-white">
    <div class="min-h-screen">
        <nav class="bg-dark-surface border-b border-dark-border">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <h1 class="text-xl font-bold text-gradient"><?php echo $isEdit ? 'Редактирование' : 'Создание'; ?> проекта</h1>
                    <div class="flex items-center space-x-4">
                        <a href="projects.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">← Назад</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
            <form method="POST" class="bg-dark-surface border border-dark-border rounded-2xl p-8 space-y-6">
                <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                <input type="hidden" name="created_at" value="<?php echo $project['created_at']; ?>">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Название проекта</label>
                        <input type="text" name="name" required class="form-input" value="<?php echo htmlspecialchars($project['name']); ?>">
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Тип проекта</label>
                        <select name="type" required class="form-input">
                            <option value="">Выберите тип</option>
                            <option value="Разработка сайта" <?php echo $project['type'] === 'Разработка сайта' ? 'selected' : ''; ?>>Разработка сайта</option>
                            <option value="SEO-продвижение" <?php echo $project['type'] === 'SEO-продвижение' ? 'selected' : ''; ?>>SEO-продвижение</option>
                            <option value="Google Ads" <?php echo $project['type'] === 'Google Ads' ? 'selected' : ''; ?>>Google Ads</option>
                            <option value="Маркетинг" <?php echo $project['type'] === 'Маркетинг' ? 'selected' : ''; ?>>Маркетинг</option>
                            <option value="Комплексное продвижение" <?php echo $project['type'] === 'Комплексное продвижение' ? 'selected' : ''; ?>>Комплексное продвижение</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Клиент</label>
                        <select name="client_id" required class="form-input">
                            <option value="">Выберите клиента</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?php echo $user['id']; ?>" <?php echo $project['client_id'] == $user['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($user['name'] . ' (' . $user['email'] . ')'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Текущий этап</label>
                        <select name="current_stage" required class="form-input">
                            <?php foreach ($stages as $stageKey => $stage): ?>
                                <option value="<?php echo $stageKey; ?>" <?php echo ($project['current_stage'] ?? 'planning') === $stageKey ? 'selected' : ''; ?>>
                                    <?php echo $stage['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Прогресс (%)</label>
                        <input type="number" name="progress" min="0" max="100" required class="form-input" value="<?php echo $project['progress'] ?? 0; ?>">
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-2 font-medium">Срок сдачи</label>
                        <input type="date" name="deadline" class="form-input" value="<?php echo $project['deadline'] ?? ''; ?>">
                    </div>
                </div>
                
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4 text-gradient">Заметки по этапам</h3>
                    <div class="space-y-4">
                        <?php foreach ($stages as $stageKey => $stage): ?>
                            <div>
                                <label class="block text-gray-300 mb-2 font-medium">
                                    <?php echo $stage['icon']; ?> <?php echo $stage['name']; ?>
                                </label>
                                <textarea 
                                    name="stage_notes_<?php echo $stageKey; ?>" 
                                    rows="3" 
                                    class="form-textarea"
                                    placeholder="<?php echo $stage['description']; ?>"
                                ><?php echo htmlspecialchars($project['stages'][$stageKey]['notes'] ?? ''); ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 pt-6">
                    <button type="submit" class="btn-neon">Сохранить</button>
                    <a href="projects.php" class="btn-outline">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

