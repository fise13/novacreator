<?php
require_once 'config.php';
checkAuth();

require_once __DIR__ . '/../client/config.php';

$projects = loadProjects();
$users = loadUsers();

function getUserName($userId, $users) {
    foreach ($users as $user) {
        if ($user['id'] == $userId) {
            return $user['name'];
        }
    }
    return 'Неизвестный';
}

$message = '';
if (isset($_GET['message'])) {
    $messages = [
        'updated' => 'Проект успешно обновлен!',
        'created' => 'Проект успешно создан!'
    ];
    $message = $messages[$_GET['message']] ?? '';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление проектами - Админ-панель</title>
    <link href="../assets/css/output.css" rel="stylesheet">
</head>
<body class="bg-dark-bg text-white">
    <div class="min-h-screen">
        <nav class="bg-dark-surface border-b border-dark-border">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <h1 class="text-xl font-bold text-gradient">Управление проектами</h1>
                    <div class="flex items-center space-x-4">
                        <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">Блог</a>
                        <a href="projects.php?action=create" class="btn-neon text-sm py-2 px-4">+ Новый проект</a>
                        <a href="../admin/logout.php" class="text-gray-400 hover:text-red-400 transition-colors text-sm">Выйти</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
            <?php if ($message): ?>
                <div class="bg-green-600/20 border border-green-600 rounded-lg p-4 mb-6 text-green-400">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['action']) && $_GET['action'] === 'create'): ?>
                <?php include 'project-form.php'; ?>
            <?php elseif (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])): ?>
                <?php 
                $projectId = (int)$_GET['id'];
                $project = null;
                foreach ($projects as $p) {
                    if ($p['id'] == $projectId) {
                        $project = $p;
                        break;
                    }
                }
                if ($project) {
                    include 'project-form.php';
                } else {
                    header('Location: projects.php');
                    exit;
                }
                ?>
            <?php else: ?>
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gradient">Проекты (<?php echo count($projects); ?>)</h2>
                </div>

                <?php if (empty($projects)): ?>
                    <div class="bg-dark-surface border border-dark-border rounded-xl p-12 text-center">
                        <p class="text-xl text-gray-400 mb-6">Проекты пока не созданы</p>
                        <a href="?action=create" class="btn-neon inline-block">Создать первый проект</a>
                    </div>
                <?php else: ?>
                    <div class="bg-dark-surface border border-dark-border rounded-xl overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-dark-bg border-b border-dark-border">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">ID</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Название</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Клиент</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Тип</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Статус</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Прогресс</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-300">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($projects as $project): ?>
                                    <tr class="border-b border-dark-border hover:bg-dark-bg/50 transition-colors">
                                        <td class="px-6 py-4 text-gray-400"><?php echo $project['id']; ?></td>
                                        <td class="px-6 py-4">
                                            <a href="?action=edit&id=<?php echo $project['id']; ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                                                <?php echo htmlspecialchars($project['name']); ?>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400"><?php echo htmlspecialchars(getUserName($project['client_id'], $users)); ?></td>
                                        <td class="px-6 py-4 text-gray-400"><?php echo htmlspecialchars($project['type']); ?></td>
                                        <td class="px-6 py-4">
                                            <?php 
                                            $stages = getProjectStages();
                                            $currentStage = $project['current_stage'] ?? 'planning';
                                            echo htmlspecialchars($stages[$currentStage]['name'] ?? 'Планирование');
                                            ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-24 bg-dark-bg rounded-full h-2">
                                                    <div class="bg-gradient-to-r from-neon-purple to-neon-blue h-2 rounded-full" style="width: <?php echo $project['progress'] ?? 0; ?>%"></div>
                                                </div>
                                                <span class="text-sm text-gray-400"><?php echo $project['progress'] ?? 0; ?>%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="?action=edit&id=<?php echo $project['id']; ?>" class="px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-lg hover:bg-neon-purple/30 transition-colors text-sm">
                                                Редактировать
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

