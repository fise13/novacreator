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
        <nav class="bg-dark-surface border-b border-dark-border">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <h1 class="text-xl font-bold text-gradient">Админ-панель блога</h1>
                    <div class="flex items-center space-x-4">
                        <a href="edit.php" class="btn-neon text-sm py-2 px-4">
                            + Новая статья
                        </a>
                        <a href="../blog" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">
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

            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gradient">Статьи блога (<?php echo count($articles); ?>)</h2>
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
</body>
</html>

