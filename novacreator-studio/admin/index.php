<?php
/**
 * Главная страница админ-панели
 * Список всех статей блога
 */
require_once 'config.php';
checkAuth();

$articles = loadArticles();
$message = '';

// Обработка сообщений
if (isset($_GET['message'])) {
    $messages = [
        'saved' => 'Статья успешно сохранена!',
        'deleted' => 'Статья успешно удалена!',
        'created' => 'Новая статья создана!'
    ];
    $message = $messages[$_GET['message']] ?? '';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Управление блогом</title>
    <link href="../assets/css/output.css" rel="stylesheet">
</head>
<body class="bg-dark-bg text-white">
    <div class="min-h-screen">
        <!-- Навигация -->
        <nav class="bg-dark-surface border-b border-dark-border sticky top-0 z-50">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-6">
                        <h1 class="text-xl font-bold text-gradient">Админ-панель</h1>
                        <div class="hidden md:flex items-center space-x-4 border-l border-dark-border pl-6">
                            <a href="index.php" class="text-neon-purple font-semibold text-sm">Блог</a>
                            <a href="chats.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm relative">
                                Чаты
                                <span id="unreadChatsBadge" class="hidden absolute -top-2 -right-2 w-5 h-5 bg-red-500 rounded-full text-xs flex items-center justify-center text-white"></span>
                            </a>
                            <a href="projects.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">Проекты</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="edit.php" class="btn-neon text-sm py-2 px-4">
                            + Новая статья
                        </a>
                        <a href="../blog" target="_blank" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">
                            Просмотр блога
                        </a>
                        <a href="logout.php" class="text-gray-400 hover:text-red-400 transition-colors text-sm">
                            Выйти
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Контент -->
        <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
            <?php if ($message): ?>
                <div class="bg-green-600/20 border border-green-600 rounded-lg p-4 mb-6 text-green-400">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Статистика -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Всего статей</p>
                            <p class="text-3xl font-bold text-gradient"><?php echo count($articles); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 border border-neon-blue/30 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Просмотры</p>
                            <p class="text-3xl font-bold text-gradient"><?php 
                                $totalViews = array_sum(array_column($articles, 'views'));
                                echo number_format($totalViews);
                            ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-neon-blue to-neon-purple rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <a href="chats.php" class="bg-gradient-to-br from-green-600/20 to-emerald-600/20 border border-green-600/30 rounded-xl p-6 hover:border-green-500 transition-colors cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Активные чаты</p>
                            <p class="text-3xl font-bold text-gradient" id="activeChatsCount">-</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gradient">Статьи блога</h2>
            </div>

            <?php if (empty($articles)): ?>
                <div class="bg-dark-surface border border-dark-border rounded-xl p-12 text-center">
                    <p class="text-xl text-gray-400 mb-6">Статьи пока не добавлены</p>
                    <a href="edit.php" class="btn-neon inline-block">
                        Создать первую статью
                    </a>
                </div>
            <?php else: ?>
                <div class="bg-dark-surface border border-dark-border rounded-xl overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-dark-bg border-b border-dark-border">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Заголовок</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Категория</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Дата</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Просмотры</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-300">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                                <tr class="border-b border-dark-border hover:bg-dark-bg/50 transition-colors">
                                    <td class="px-6 py-4 text-gray-400"><?php echo $article['id']; ?></td>
                                    <td class="px-6 py-4">
                                        <a href="../blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" target="_blank" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                                            <?php echo htmlspecialchars($article['title']); ?>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400">
                                        <span class="px-3 py-1 bg-neon-purple/20 text-neon-purple rounded-full text-sm">
                                            <?php echo htmlspecialchars($article['category']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400"><?php echo htmlspecialchars($article['date']); ?></td>
                                    <td class="px-6 py-4 text-gray-400"><?php echo $article['views'] ?? 0; ?></td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="edit.php?id=<?php echo $article['id']; ?>" class="px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-lg hover:bg-neon-purple/30 transition-colors text-sm">
                                                Редактировать
                                            </a>
                                            <a href="delete.php?id=<?php echo $article['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить эту статью?')" class="px-4 py-2 bg-red-600/20 text-red-400 rounded-lg hover:bg-red-600/30 transition-colors text-sm">
                                                Удалить
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        // Загружаем количество активных чатов
        function loadChatsCount() {
            fetch('/backend/chat_api.php?action=get_chats')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const activeChats = data.chats.filter(chat => chat.status === 'active').length;
                        document.getElementById('activeChatsCount').textContent = activeChats;
                        
                        // Обновляем бейдж непрочитанных
                        const badge = document.getElementById('unreadChatsBadge');
                        if (activeChats > 0) {
                            badge.classList.remove('hidden');
                            badge.textContent = activeChats > 9 ? '9+' : activeChats;
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                })
                .catch(error => {
                    console.error('Ошибка загрузки чатов:', error);
                });
        }
        
        // Загружаем при загрузке страницы и обновляем каждые 30 секунд
        loadChatsCount();
        setInterval(loadChatsCount, 30000);
    </script>
</body>
</html>

